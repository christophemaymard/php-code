<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Parsing;

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
     * Constructor.
     * 
     * @param   string                              $stream             The stream to set.
     * @param   ConceptConstraintFactoryInterface   $constraintFactory  The constraint factory to set.
     */
    public function __construct(
        string $stream, 
        ConceptConstraintFactoryInterface $constraintFactory
    )
    {
        $this->setStream($stream);
        $this->constraintFactory = $constraintFactory;
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

