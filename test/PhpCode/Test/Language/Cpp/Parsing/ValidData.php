<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Parsing;

use PhpCode\Exception\ArgumentException;
use PhpCode\Test\Language\Cpp\ConceptConstraintFactoryInterface;

/**
 * Represents a valid data.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ValidData extends AbstractData
{
    /**
     * The factory of the constraint.
     * @var ConceptConstraintFactoryInterface
     */
    private $constraintFactory;
    
    /**
     * The next token (lexeme and tag) after parsing (default to EOF token).
     * An indexed array where:
     * - [0] is the lexeme of the next token after parsing, and 
     * - [1] is the tag of the next token after parsing.
     * @var array
     */
    private $token = [ '', 0, ];
    
    /**
     * The lexeme of the first token.
     * @var string
     */
    private $firstTokenLexeme;
    
    /**
     * Constructor.
     * 
     * @param   string                              $stream             The stream to set.
     * @param   ConceptConstraintFactoryInterface   $constraintFactory  The constraint factory to set.
     * @param   string                              $firstTokenLexeme   The lexeme of the first token.
     */
    public function __construct(
        string $stream, 
        ConceptConstraintFactoryInterface $constraintFactory, 
        string $firstTokenLexeme
    )
    {
        $this->setStream($stream);
        $this->constraintFactory = $constraintFactory;
        $this->setFirstTokenLexeme($firstTokenLexeme);
    }
    
    /**
     * Returns the factory of the constraint.
     * 
     * @return  ConceptConstraintFactoryInterface
     */
    public function getConstraintFactory(): ConceptConstraintFactoryInterface
    {
        return $this->constraintFactory;
    }
    
    /**
     * Returns the lexeme of the first token.
     * 
     * @return  string
     */
    public function getFirstTokenLexeme(): string
    {
        return $this->firstTokenLexeme;
    }
    
    /**
     * Sets the lexeme of the first token.
     * 
     * @param   string  $lexeme The lexeme to set.
     * 
     * @throws  ArgumentException   When the stream does start with the lexme.
     */
    private function setFirstTokenLexeme(string $lexeme): void
    {
        $this->firstTokenLexeme = $lexeme;
        
        if (\mb_substr($this->getStream(), 0, \mb_strlen($this->firstTokenLexeme)) != $this->firstTokenLexeme) {
            throw new ArgumentException(\sprintf(
                'The stream "%s" must start with the lexeme "%s".', 
                $this->getStream(), 
                $this->firstTokenLexeme
            ));
        }
    }
    
    /**
     * Returns the next token (lexeme and tag) after parsing.
     * 
     * @return  array   An indexed array where:
     *                  [0] is the lexeme of the next token after parsing, and 
     *                  [1] is the tag of the next token after parsing.
     */
    public function getToken(): array
    {
        return $this->token;
    }
    
    /**
     * Sets the next token (lexeme and tag) after parsing.
     * 
     * @param   string  $lexeme The lexeme of the token.
     * @param   int     $tag    The tag fo the token.
     */
    public function setToken(string $lexeme, int $tag): void
    {
        $this->token = [ $lexeme, $tag ];
    }
}

