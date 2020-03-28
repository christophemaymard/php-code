<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\UnqualifiedId;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;
use PhpCode\Test\Language\Cpp\Lexical\IdentifierConstraint;

/**
 * Represents the constraint for an unqualified identifier.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class UnqualifiedIdConstraint extends AbstractConceptConstraint
{
    /**
     * The identifier constraint.
     * @var IdentifierConstraint
     */
    private $idConst;
    
    /**
     * Creates a constraint for an unqualified identifier that is defined as 
     * an identifier.
     * 
     * @param   IdentifierConstraint    $idConst   The identifier constraint.
     * @return  UnqualifiedIdConstraint The created instance of unqualified identifier constraint.
     */
    public static function createIdentifier(
        IdentifierConstraint $idConst
    ): self
    {
        $const = new self();
        $const->idConst = $idConst;
        
        return $const;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return 'unqualified identifier';
    }
    
    /**
     * {@inheritDoc}
     */
    public function constraintDescription(): string
    {
        $lines = [];
        $lines[] = $this->getConceptName();
        $lines[] = $this->indent($this->idConst->constraintDescription());
        
        return \implode("\n", $lines);
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        if (!$other instanceof UnqualifiedId) {
            return FALSE;
        }
        
        return $this->idConst->matches($other->getIdentifier());
    }
    
    /**
     * {@inheritDoc}
     */
    public function failureReason($other): string
    {
        if (!$other instanceof UnqualifiedId) {
            return $this->instanceReason(UnqualifiedId::class, $other);
        }
        
        if (!$this->idConst->matches($other->getIdentifier())) {
            return $this->conceptIndent(
                $this->idConst->failureReason($other->getIdentifier())
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

