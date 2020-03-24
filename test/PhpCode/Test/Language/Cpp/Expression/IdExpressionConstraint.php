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
     * @var UnqualifiedIdConstraint|NULL
     */
    private $uidConst;
    
    /**
     * The qualified identifier constraint.
     * @var QualifiedIdConstraint|NULL
     */
    private $qidConst;
    
    /**
     * Creates a constraint for an identifier expression that is an 
     * unqualified identifier.
     * 
     * @param   UnqualifiedIdConstraint $uidConst   The unqualified identifier constraint.
     * @return  IdExpressionConstraint  The created instance of IdExpressionConstraint.
     */
    public static function createUnqualifiedId(
        UnqualifiedIdConstraint $uidConst
    ): self
    {
        $const = new self();
        $const->uidConst = $uidConst;
        
        return $const;
    }
    
    /**
     * Creates a constraint for an identifier expression that is a qualified 
     * identifier.
     * 
     * @param   QualifiedIdConstraint   $qidConst   The qualified identifier constraint.
     * @return  IdExpressionConstraint  The created instance of IdExpressionConstraint.
     */
    public static function createQualifiedId(
        QualifiedIdConstraint $qidConst
    ): self
    {
        $const = new self();
        $const->qidConst = $qidConst;
        
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
        
        $desc = $this->uidConst !== NULL ? 
            $this->uidConst->constraintDescription() : 
            $this->qidConst->constraintDescription();
        
        $lines[] = $this->indent($desc);
        
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
        
        if ($this->uidConst) {
            if (!$this->uidConst->matches($other->getUnqualifiedId())) {
                return FALSE;
            }
        } else {
            if (!$this->qidConst->matches($other->getQualifiedId())) {
                return FALSE;
            }
        }
        
        return TRUE;
    }
    
    /**
     * {@inheritDoc}
     */
    public function failureReason($other): string
    {
        if (!$other instanceof IdExpression) {
            return $this->instanceReason(IdExpression::class, $other);
        }
        
        if ($this->uidConst) {
            if (!$this->uidConst->matches($other->getUnqualifiedId())) {
                return $this->conceptIndent(
                     $this->uidConst->failureReason($other->getUnqualifiedId())
                 );
            }
        } else {
            if (!$this->qidConst->matches($other->getQualifiedId())) {
                return $this->conceptIndent(
                     $this->qidConst->failureReason($other->getQualifiedId())
                 );
            }
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

