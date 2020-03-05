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
     * The current token.
     * @var TokenInterface
     */
    private $tkn;
    
    /**
     * Constructor.
     * 
     * Once the lexer is set, the current token is initialized with the next 
     * available token of the lexer.
     * 
     * @param   LexerInterface  $lexer  The lexer used to parse.
     */
    public function __construct(LexerInterface $lexer)
    {
        $this->setLexer($lexer);
    }
    
    /**
     * Sets lexer used to parse and initialize the current token with the 
     * next available token of the lexer.
     * 
     * @param   LexerInterface  $lexer  The lexer used to parse.
     */
    private function setLexer(LexerInterface $lexer): void
    {
        $this->lexer = $lexer;
        $this->move();
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
     *     ( )
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
        
        if (!$this->moveIf(Tag::PN_PAREN_R)) {
            throw new FormatException(\sprintf('Missing ")" before "%s".', $this->tkn->getLexeme()));
        }
        
        $prmQual = new ParametersAndQualifiers();
        
        return $prmQual;
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
     * Updates the current token with the next available token of the lexer.
     */
    private function move(): void
    {
        $this->tkn = $this->lexer->getToken();
    }
    
    /**
     * Indicates whether the current token matches the specified tag.
     * 
     * @param   int $tag    The tag to match.
     * @return  bool    TRUE if the current token matches the specified tag, otherwise FALSE.
     */
    private function tokenIs(int $tag): bool
    {
        return $this->tkn->getTag() === $tag;
    }
}

