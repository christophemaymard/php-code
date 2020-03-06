<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Parsing;

use PhpCode\Exception\FormatException;
use PhpCode\Language\Cpp\Declarator\Declarator;
use PhpCode\Language\Cpp\Declarator\DeclaratorId;
use PhpCode\Language\Cpp\Declarator\NoptrDeclarator;
use PhpCode\Language\Cpp\Declarator\ParameterDeclarationClause;
use PhpCode\Language\Cpp\Declarator\ParametersAndQualifiers;
use PhpCode\Language\Cpp\Declarator\PtrDeclarator;
use PhpCode\Language\Cpp\Expression\IdExpression;
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
     * 
     * unqualified-id:
     *     identifier
     * 
     * @return  Declarator
     * 
     * @throws  FormatException When an identifier is expected.
     * @throws  FormatException When an identifier is unexpected.
     */
    public function parseDeclarator(): Declarator
    {
        if (!$this->tokenIs(Tag::ID)) {
            throw new FormatException(\sprintf('Unexpected "%s", expected identifier.', $this->tkn->getLexeme()));
        }
        
        $id = new Identifier($this->tkn->getLexeme());
        $this->move();
        $uid = UnqualifiedId::createIdentifier($id);
        $idExpr = IdExpression::createUnqualifiedId($uid);
        $did = DeclaratorId::createIdExpression($idExpr);
        
        if ($this->tokenIs(Tag::ID)) {
            throw new FormatException(\sprintf('Unexpected identifier "%s".', $this->tkn->getLexeme()));
        }
        
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
     *     ( parameter-declaration-clause )
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
        
        return $prmQual;
    }
    
    /**
     * Parse a parameter declaration clause.
     * 
     * parameter-declaration-clause:
     *     ...[opt]
     * 
     * @return  ParameterDeclarationClause
     */
    public function parseParameterDeclarationClause(): ParameterDeclarationClause
    {
        $prmDeclClause = new ParameterDeclarationClause();
        
        if ($this->moveIf(Tag::PN_ELLIPSIS)) {
            $prmDeclClause->addEllipsis();
        }
        
        return $prmDeclClause;
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
     * Initialize the token to process with the next available token of the 
     * lexer, without being consumed.
     */
    private function initTokenToProcess(): void
    {
        $this->tkn = $this->lexer->lookAhead(1);
    }
}

