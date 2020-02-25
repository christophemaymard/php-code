<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Lexical;

/**
 * Represents a token.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class Token implements TokenInterface
{
    /**
     * The lexeme of this token.
     * @var string
     */
    private $lexeme;
    
    /**
     * The tag of this token.
     * @var int
     */
    private $tag;
    
    /**
     * Constructor.
     * 
     * @param   string  $lexeme The lexeme of the token.
     * @param   int     $tag    The tag of the token.
     */
    public function __construct(string $lexeme, int $tag)
    {
        $this->lexeme = $lexeme;
        $this->tag = $tag;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLexeme(): string
    {
        return $this->lexeme;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getTag(): int
    {
        return $this->tag;
    }
}

