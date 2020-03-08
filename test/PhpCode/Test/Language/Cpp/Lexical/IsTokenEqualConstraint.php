<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Lexical;

use PhpCode\Language\Cpp\Lexical\TokenInterface;
use PHPUnit\Framework\Constraint\Constraint;

/**
 * Represents the constraint that asserts a value is an instance of 
 * TokenInterface interface with specific lexeme and tag.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class IsTokenEqualConstraint extends Constraint
{
    /**
     * The expected lexeme.
     * @var string
     */
    private $lexeme;
    
    /**
     * The expected tag.
     * @var int
     */
    private $tag;
    
    /**
     * Constructor.
     * 
     * @param   string  $lexeme The expected lexeme.
     * @param   int     $tag    The expected tag.
     */
    public function __construct(string $lexeme, int $tag)
    {
        $this->lexeme = $lexeme;
        $this->tag = $tag;
    }
    
    /**
     * {@inheritDoc}
     */
    protected function matches($other): bool
    {
        return $other instanceof TokenInterface &&
            $other->getLexeme() == $this->lexeme && 
            $other->getTag() == $this->tag;
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return \sprintf(
            'is an instance of TokenInterface with the lexeme "%s" and the tag %s',
            $this->lexeme, 
            $this->tag
        );
    }
    
    /**
     * {@inheritDoc}
     */
    protected function failureDescription($other): string
    {
        if (!$other instanceof TokenInterface) {
            return \sprintf(
                '%s is an instance of TokenInterface with the lexeme "%s" and the tag %s', 
                $this->exporter()->shortenedExport($other), 
                $this->lexeme, 
                $this->tag
            );
        }
        
        return \sprintf(
            'the token has the lexeme "%s" and the tag %s, instead it has the lexeme "%s" and the tag %s', 
            $this->lexeme, 
            $this->tag, 
            $other->getLexeme(), 
            $other->getTag()
        );
    }
}

