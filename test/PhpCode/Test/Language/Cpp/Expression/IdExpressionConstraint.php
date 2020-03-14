<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\IdExpression;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;

/**
 * Represents the constraint for an identifier expression.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class IdExpressionConstraint extends AbstractConceptConstraint
{
    /**
     * The unqualified identifier constraint.
     * @var UnqualifiedIdConstraint
     */
    private $unqualifiedIdConst;
    
    /**
     * Creates a constraint for an identifier expression that is an 
     * unqualified identifier.
     * 
     * @param   UnqualifiedIdConstraint $unqualifiedIdConst The unqualified identifier constraint.
     * @return  IdExpressionConstraint  The created instance of IdExpressionConstraint.
     */
    public static function createUnqualifiedId(
        UnqualifiedIdConstraint $unqualifiedIdConst
    ): self
    {
        $const = new self();
        $const->unqualifiedIdConst = $unqualifiedIdConst;
        
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
        return 'identifier expression';
    }
    
    /**
     * {@inheritDoc}
     */
    public function constraintDescription(): string
    {
        $lines = [];
        $lines[] = $this->getConceptName();
        $lines[] = $this->indent($this->unqualifiedIdConst->constraintDescription());
        
        return \implode("\n", $lines);
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        if (!$other instanceof IdExpression) {
            return FALSE;
        }
        
        return $this->unqualifiedIdConst->matches($other->getUnqualifiedId());
    }
    
    /**
     * {@inheritDoc}
     */
    public function failureReason($other): string
    {
        if (!$other instanceof IdExpression) {
            return $this->instanceReason(IdExpression::class, $other);
        }
        
        if (!$this->unqualifiedIdConst->matches($other->getUnqualifiedId())) {
            return $this->conceptIndent(
                $this->unqualifiedIdConst->failureReason($other->getUnqualifiedId())
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

