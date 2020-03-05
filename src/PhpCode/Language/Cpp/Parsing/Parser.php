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
     */
    public function parseDeclarator(): Declarator
    {
        if (!$this->tokenIs(Tag::ID)) {
            throw new FormatException(\sprintf('Unexpected "%s", expected identifier.', $this->tkn->getLexeme()));
        }
        
        $id = new Identifier($this->tkn->getLexeme());
        $uid = UnqualifiedId::createIdentifier($id);
        $idExpr = IdExpression::createUnqualifiedId($uid);
        $did = DeclaratorId::createIdExpression($idExpr);
        $noptrDcltor = NoptrDeclarator::createDeclaratorId($did);
        $ptrDcltor = new PtrDeclarator($noptrDcltor);
        $dcltor = Declarator::createPtrDeclarator($ptrDcltor);
        
        return $dcltor;
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

