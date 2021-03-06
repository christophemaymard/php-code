<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Parsing;

use PhpCode\Exception\FormatException;
use PhpCode\Language\Cpp\Declaration\DeclarationSpecifier;
use PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence;
use PhpCode\Language\Cpp\Declaration\DefiningTypeSpecifier;
use PhpCode\Language\Cpp\Declaration\SimpleTypeSpecifier;
use PhpCode\Language\Cpp\Declaration\TypeSpecifier;
use PhpCode\Language\Cpp\Declarator\CVQualifier;
use PhpCode\Language\Cpp\Declarator\CVQualifierSequence;
use PhpCode\Language\Cpp\Declarator\Declarator;
use PhpCode\Language\Cpp\Declarator\DeclaratorId;
use PhpCode\Language\Cpp\Declarator\NoptrDeclarator;
use PhpCode\Language\Cpp\Declarator\ParameterDeclaration;
use PhpCode\Language\Cpp\Declarator\ParameterDeclarationClause;
use PhpCode\Language\Cpp\Declarator\ParameterDeclarationList;
use PhpCode\Language\Cpp\Declarator\ParametersAndQualifiers;
use PhpCode\Language\Cpp\Declarator\PtrDeclarator;
use PhpCode\Language\Cpp\Expression\IdExpression;
use PhpCode\Language\Cpp\Expression\NestedNameSpecifier;
use PhpCode\Language\Cpp\Expression\QualifiedId;
use PhpCode\Language\Cpp\Expression\UnqualifiedId;
use PhpCode\Language\Cpp\Lexical\Identifier;
use PhpCode\Language\Cpp\Lexical\LexerInterface;
use PhpCode\Language\Cpp\Lexical\Tag;
use PhpCode\Language\Cpp\Lexical\TokenInterface;

/**
 * Represents a parser.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class Parser
{
    /**
     * The lexer used to parse.
     * @var LexerInterface
     */
    private $lexer;
    
    /**
     * The token to process.
     * It is the next available token, without being consumed, of the lexer.
     * @var TokenInterface
     */
    private $tkn;
    
    /**
     * Constructor.
     * 
     * Once the lexer is set, the token to process is initialized with the 
     * next available token of the lexer, without being consumed.
     * 
     * @param   LexerInterface  $lexer  The lexer used to parse.
     */
    public function __construct(LexerInterface $lexer)
    {
        $this->setLexer($lexer);
    }
    
    /**
     * Sets lexer used to parse and initialize the token to process with the 
     * next available token of the lexer, without being consumed.
     * 
     * @param   LexerInterface  $lexer  The lexer used to parse.
     */
    private function setLexer(LexerInterface $lexer): void
    {
        $this->lexer = $lexer;
        $this->initTokenToProcess();
    }
    
    /**
     * Parse a declarator.
     * 
     * declarator:
     *     ptr-declarator
     * 
     * ptr-declarator:
     *     noptr-declarator
     * 
     * noptr-declarator:
     *     declarator-id
     *     noptr-declarator parameters-and-qualifiers
     * 
     * declarator-id:
     *     id-expression
     * 
     * id-expression:
     *     unqualified-id
     *     qualified-id
     * 
     * unqualified-id:
     *     identifier
     * 
     * qualified-id:
     *     nested-name-specifier unqualified-id
     * 
     * nested-name-specifier:
     *     identifier ::
     *     nested-name-specifier identifier ::
     * 
     * @return  Declarator
     * 
     * @throws  FormatException When an identifier is expected.
     */
    public function parseDeclarator(): Declarator
    {
        $nnSpec = new NestedNameSpecifier();
        
        while ($this->tokenIs(Tag::ID) && $this->lookAhead(1)->getTag() == TAG::PN_COLON_COLON) {
            $nnSpec->addNameSpecifier(new Identifier($this->tkn->getLexeme()));
            
            // Consume the identifier and the scope.
            $this->move();
            $this->move();
        }
        
        if (!$this->tokenIs(Tag::ID)) {
            throw new FormatException(\sprintf('Unexpected "%s", expected identifier.', $this->tkn->getLexeme()));
        }
        
        $id = new Identifier($this->tkn->getLexeme());
        $this->move();
        
        $uid = UnqualifiedId::createIdentifier($id);
        
        if (\count($nnSpec) > 0) {
            $idExpr = IdExpression::createQualifiedId(new QualifiedId($nnSpec, $uid));
        } else {
            $idExpr = IdExpression::createUnqualifiedId($uid);
        }
        
        $did = new DeclaratorId($idExpr);
        $noptrDcltor = NoptrDeclarator::createDeclaratorId($did);
        
        if ($this->tokenIs(Tag::PN_PAREN_L)) {
            $prmQual = $this->parseParametersAndQualifiers();
            $noptrDcltor->setParametersAndQualifiers($prmQual);
        }
        
        $ptrDcltor = new PtrDeclarator($noptrDcltor);
        $dcltor = Declarator::createPtrDeclarator($ptrDcltor);
        
        return $dcltor;
    }
    
    /**
     * Parse parameters and qualifiers.
     * 
     * parameters-and-qualifiers:
     *     ( parameter-declaration-clause ) cv-qualifier-seq[opt]
     * 
     * @return  ParametersAndQualifiers
     * 
     * @throws  FormatException When "(" is missing before token.
     * @throws  FormatException When ")" is missing before token.
     */
    public function parseParametersAndQualifiers(): ParametersAndQualifiers
    {
        if (!$this->moveIf(Tag::PN_PAREN_L)) {
            throw new FormatException(\sprintf('Missing "(" before "%s".', $this->tkn->getLexeme()));
        }
        
        $prmDeclClause = $this->parseParameterDeclarationClause();
        
        if (!$this->moveIf(Tag::PN_PAREN_R)) {
            throw new FormatException(\sprintf('Missing ")" before "%s".', $this->tkn->getLexeme()));
        }
        
        $prmQual = new ParametersAndQualifiers($prmDeclClause);
        
        // Check if a constant/volatile qualifier sequence is present.
        if ($this->tokenIsOneOf([Tag::KW_CONST, Tag::KW_VOLATILE])) {
            $cvSeq = new CVQualifierSequence();
            
            while ($this->tokenIsOneOf([Tag::KW_CONST, Tag::KW_VOLATILE])) {
                $cv = $this->tokenIs(Tag::KW_CONST) ? 
                    CVQualifier::createConst() : 
                    CVQualifier::createVolatile();
                
                // In cases of duplicated constant/volatile qualifiers, the 
                // constant/volatile qualifier sequence throws an exception 
                // when adding the constant/volatile qualifier.
                $cvSeq->addCVQualifier($cv);
                
                // Consume the constant/volatile qualifier.
                $this->move();
            }
            
            $prmQual->setCVQualifierSequence($cvSeq);
        }
        
        return $prmQual;
    }
    
    /**
     * Parse a parameter declaration clause.
     * 
     * parameter-declaration-clause:
     *     parameter-declaration-list[opt] ...[opt]
     *     parameter-declaration-list , ...
     * 
     * @return  ParameterDeclarationClause
     */
    public function parseParameterDeclarationClause(): ParameterDeclarationClause
    {
        $prmDeclClause = new ParameterDeclarationClause();
        
        if (!$this->tokenIsSimpleTypeSpecifier() && 
            !$this->tokenIs(Tag::PN_ELLIPSIS)) {
            return $prmDeclClause;
        }
        
        if (!$this->tokenIs(Tag::PN_ELLIPSIS)) {
            $prmDeclList = $this->parseParameterDeclarationList();
            $prmDeclClause->setParameterDeclarationList($prmDeclList);
        }

        if ($this->tokenIs(Tag::PN_COMMA) && 
            $this->lookAhead(1)->getTag() == Tag::PN_ELLIPSIS) {
            // Connsume the comma and the ellipsis.
            $this->move();
            $this->move();

            $prmDeclClause->addEllipsis();
        } elseif ($this->moveIf(Tag::PN_ELLIPSIS)) {
            $prmDeclClause->addEllipsis();
        }
        
        return $prmDeclClause;
    }
    
    /**
     * Parse a parameter declaration list.
     * 
     * parameter-declaration-list:
     *     parameter-declaration
     *     parameter-declaration-list , parameter-declaration
     * 
     * @return  ParameterDeclarationList
     */
    public function parseParameterDeclarationList(): ParameterDeclarationList
    {
        $prmDeclList = new ParameterDeclarationList();
        
        $prmDecl = $this->parseParameterDeclaration();
        $prmDeclList->addParameterDeclaration($prmDecl);
        
        while ($this->tokenIs(Tag::PN_COMMA)) {
            if ($this->lookAhead(1)->getTag() == Tag::PN_ELLIPSIS) {
                // Do not consume the comma and the ellipsis.
                break;
            }
            
            // Consume the comma.
            $this->move();
            
            $prmDecl = $this->parseParameterDeclaration();
            $prmDeclList->addParameterDeclaration($prmDecl);
        }
        
        return $prmDeclList;
    }
    
    /**
     * Parse a parameter declaration.
     * 
     * parameter-declaration:
     *     decl-specifier-seq
     * 
     * @return  ParameterDeclaration
     */
    public function parseParameterDeclaration(): ParameterDeclaration
    {
        $declSpecSeq = $this->parseDeclarationSpecifierSequence();
        $prmDecl = new ParameterDeclaration($declSpecSeq);
        
        return $prmDecl;
    }
    
    /**
     * Parse a declaration specifier sequence.
     * 
     * decl-specifier-seq:
     *     decl-specifier
     * 
     * @return  DeclarationSpecifierSequence
     */
    public function parseDeclarationSpecifierSequence(): DeclarationSpecifierSequence
    {
        $declSpecSeq = new DeclarationSpecifierSequence();
        
        $declSpec = $this->parseDeclarationSpecifier();
        $declSpecSeq->addDeclarationSpecifier($declSpec);
        
        return $declSpecSeq;
    }
    
    /**
     * Parse a declaration specifier.
     * 
     * decl-specifier:
     *     defining-type-specifier
     * 
     * defining-type-specifier:
     *     type-specifier
     * 
     * type-specifier:
     *     simple-type-specifier
     * 
     * @return  DeclarationSpecifier
     * 
     * @throws  FormatException When no declaration specifier has been parsed.
     */
    public function parseDeclarationSpecifier(): DeclarationSpecifier
    {
        if ($this->tokenIsSimpleTypeSpecifier()) {
            $stSpec = $this->parseSimpleTypeSpecifier();
            
            return DeclarationSpecifier::createDefiningTypeSpecifier(
                DefiningTypeSpecifier::createTypeSpecifier(
                    TypeSpecifier::createSimpleTypeSpecifier($stSpec)
                )
            );
        }
        
        throw new FormatException(\sprintf(
            'Unexpected "%s", expected decl-specifier.', 
            $this->tkn->getLexeme()
        ));
    }
    
    /**
     * Parse a simple type specifier.
     * 
     * simple-type-specifier:
     *     nested-name-specifier[opt] identifier
     *     char
     *     wchar_t
     *     bool
     *     short
     *     int
     *     long
     *     signed
     *     unsigned
     *     float
     *     double
     * 
     * @return  SimpleTypeSpecifier
     * 
     * @throws  FormatException When an identifier is expected.
     */
    private function parseSimpleTypeSpecifier(): SimpleTypeSpecifier
    {
        if ($this->moveIf(Tag::KW_CHAR)) {
            return SimpleTypeSpecifier::createChar();
        }
        
        if ($this->moveIf(Tag::KW_WCHAR_T)) {
            return SimpleTypeSpecifier::createWCharT();
        }
        
        if ($this->moveIf(Tag::KW_BOOL)) {
            return SimpleTypeSpecifier::createBool();
        }
        
        if ($this->moveIf(Tag::KW_SHORT)) {
            return SimpleTypeSpecifier::createShort();
        }
        
        if ($this->moveIf(Tag::KW_INT)) {
            return SimpleTypeSpecifier::createInt();
        }
        
        if ($this->moveIf(Tag::KW_LONG)) {
            return SimpleTypeSpecifier::createLong();
        }
        
        if ($this->moveIf(Tag::KW_SIGNED)) {
            return SimpleTypeSpecifier::createSigned();
        }
        
        if ($this->moveIf(Tag::KW_UNSIGNED)) {
            return SimpleTypeSpecifier::createUnsigned();
        }
        
        if ($this->moveIf(Tag::KW_FLOAT)) {
            return SimpleTypeSpecifier::createFloat();
        }
        
        if ($this->moveIf(Tag::KW_DOUBLE)) {
            return SimpleTypeSpecifier::createDouble();
        }
        
        // The token to process is an identifier.
        
        $nnSpec = new NestedNameSpecifier();
        
        while ($this->tokenIs(Tag::ID) && $this->lookAhead(1)->getTag() == TAG::PN_COLON_COLON) {
            $nnSpec->addNameSpecifier(new Identifier($this->tkn->getLexeme()));
            
            // Consume the identifier and the scope.
            $this->move();
            $this->move();
        }
        
        if (!$this->tokenIs(Tag::ID)) {
            throw new FormatException(\sprintf('Unexpected "%s", expected identifier.', $this->tkn->getLexeme()));
        }
        
        $id = new Identifier($this->tkn->getLexeme());
        $this->move();
        
        return (\count($nnSpec) > 0) ?
            SimpleTypeSpecifier::createQualifiedIdentifier($nnSpec, $id) : 
            SimpleTypeSpecifier::createIdentifier($id);
    }
    
    /**
     * Updates the current token with the next available token of the lexer 
     * if the current token matches the specified tag.
     * 
     * @param   int $tag    The tag to match.
     * @return  bool    TRUE if if the current token matches the specified tag, otherwise FALSE.
     */
    private function moveIf(int $tag): bool
    {
        if (!$this->tokenIs($tag)) {
            return FALSE;
        }
        
        $this->move();
        
        return TRUE;
    }
    
    /**
     * Consumes the token to process and update it with the next available 
     * token of the lexer, without being consumed.
     */
    private function move(): void
    {
        // Consume the next token, that is the current to process.
        $this->lexer->getToken();
        
        $this->initTokenToProcess();
    }
    
    /**
     * Indicates whether the token to process matches one of the tags of a 
     * simple type specifier.
     * 
     * @return  bool    TRUE if the token to process matches one of the tags of a simple type specifier, otherwise FALSE.
     */
    private function tokenIsSimpleTypeSpecifier(): bool
    {
        return $this->tokenIsOneOf([
            Tag::ID, 
            Tag::KW_CHAR, 
            Tag::KW_WCHAR_T, 
            Tag::KW_BOOL, 
            Tag::KW_SHORT, 
            Tag::KW_INT, 
            Tag::KW_LONG, 
            Tag::KW_SIGNED, 
            Tag::KW_UNSIGNED, 
            Tag::KW_FLOAT, 
            Tag::KW_DOUBLE, 
        ]);
    }
    
    /**
     * Indicates whether the token to process matches the specified tag.
     * 
     * @param   int $tag    The tag to match.
     * @return  bool    TRUE if the token to process matches the specified tag, otherwise FALSE.
     */
    private function tokenIs(int $tag): bool
    {
        return $this->tkn->getTag() === $tag;
    }
    
    /**
     * Indicates whether the token to process matches one of the specified tags.
     * 
     * @param   int[]   $tags   One of the tags to match.
     * @return  bool    TRUE if the token to process matches one of the specified tags, otherwise FALSE.
     */
    private function tokenIsOneOf(array $tags): bool
    {
        return \in_array($this->tkn->getTag(), $tags, TRUE);
    }
    
    /**
     * Returns the N-th next token in the stream without changing of the 
     * position in the stream.
     * 
     * If the end of the stream is reached, it always returns a token with 
     * the {@see PhpCode\Language\Cpp\Lexical\Tag::EOF} tag.
     * 
     * @param   int $n  The number (if it is 1 or less then the next token will be returned; if it is 2 then the token next of the next token will be returned, and so on).
     * @return  TokenInterface
     */
    private function lookAhead(int $n): TokenInterface
    {
        return $this->lexer->lookAhead($n + 1);
    }
    
    /**
     * Initialize the token to process with the next available token of the 
     * lexer, without being consumed.
     */
    private function initTokenToProcess(): void
    {
        $this->tkn = $this->lexer->lookAhead(1);
    }
}

