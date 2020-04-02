<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\PtrAbstractDeclarator;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;

/**
 * Represents the constraint for a pointer abstract declarator.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrAbstractDeclaratorConstraint extends AbstractConceptConstraint
{
    /**
     * The pointer operator sequence constraint.
     * @var PtrOperatorSequenceConstraint|NULL
     */
    private $ptrOpSeqConst;
    
    /**
     * Sets the pointer operator sequence constraint.
     * 
     * @param   PtrOperatorSequenceConstraint   $ptrOpSeqConst  The pointer operator sequence constraint to set.
     */
    public function setPtrOperatorSequenceConstraint(
        PtrOperatorSequenceConstraint $ptrOpSeqConst
    ): void
    {
        $this->ptrOpSeqConst = $ptrOpSeqConst;
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return 'pointer abstract declarator';
    }
    
    /**
     * {@inheritDoc}
     */
    public function constraintDescription(): string
    {
        $lines = [];
        $lines[] = $this->getConceptName();
        
        if ($this->ptrOpSeqConst) {
            $lines[] = $this->indent($this->ptrOpSeqConst->constraintDescription());
        }
        
        return \implode("\n", $lines);
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        if (!$other instanceof PtrAbstractDeclarator) {
            return FALSE;
        }
        
        $ptrOpSeq = $other->getPtrOperatorSequence();
        
        if (!$this->ptrOpSeqConst && $ptrOpSeq) {
            return FALSE;
        }
        
        if ($this->ptrOpSeqConst && !$this->ptrOpSeqConst->matches($ptrOpSeq)) {
            return FALSE;
        }
        
        return TRUE;
    }
    
    /**
     * {@inheritDoc}
     */
    public function failureReason($other): string
    {
        if (!$other instanceof PtrAbstractDeclarator) {
            return $this->instanceReason(PtrAbstractDeclarator::class, $other);
        }
        
        $ptrOpSeq = $other->getPtrOperatorSequence();
        
        if (!$this->ptrOpSeqConst && $ptrOpSeq) {
            return $this->hasReason(FALSE, 'pointer operator sequence');
        }
        
        if ($this->ptrOpSeqConst && !$this->ptrOpSeqConst->matches($ptrOpSeq)) {
            return $this->conceptIndent(
                $this->ptrOpSeqConst->failureReason($ptrOpSeq)
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
            '%s is a %s', 
            $this->exporter()->shortenedExport($other), 
            $this->toString()
        );
    }
}

