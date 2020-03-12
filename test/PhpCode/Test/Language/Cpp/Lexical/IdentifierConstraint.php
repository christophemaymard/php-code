<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Lexical;

use PhpCode\Language\Cpp\Lexical\Identifier;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;

/**
 * Represents the constraint for an identifier.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class IdentifierConstraint extends AbstractConceptConstraint
{
    /**
     * The identifier.
     * @var string
     */
    private $identifier;
    
    /**
     * Constructor.
     * 
     * @param   string  $identifier The identifier.
     */
    public function __construct(string $identifier)
    {
        $this->identifier = $identifier;
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return 'identifier';
    }
    
    /**
     * {@inheritDoc}
     */
    public function constraintDescription(): string
    {
        return \sprintf(
            '%s "%s"', 
            $this->getConceptName(), 
            $this->identifier
        );
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        return $other instanceof Identifier &&
            $other->getIdentifier() === $this->identifier;
    }
    
    /**
     * {@inheritDoc}
     */
    public function failureReason($other): string
    {
        if (!$other instanceof Identifier) {
            return $this->instanceReason(Identifier::class, $other);
        } 
        
        if ($other->getIdentifier() !== $this->identifier) {
            return $this->matchStringReason(
                $this->identifier, 
                $other->getIdentifier(), 
                'identifier'
            );
        }
        
        return $this->failureDefaultReason($other);
    }
    
    /**
     * {@inheritDoc}
     */
    protected function failureDescription($other): string
    {
        return \sprintf(
            '%s is an %s', 
            $this->exporter()->shortenedExport($other), 
            $this->toString()
        );
    }
}

