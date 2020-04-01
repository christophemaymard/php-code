<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Exception\ArgumentException;
use PhpCode\Language\Cpp\Declarator\PtrOperatorSequence;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;

/**
 * Represents the constraint for a pointer operator.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrOperatorSequenceConstraint extends AbstractConceptConstraint
{
    /**
     * The pointer operator constraints.
     * @var PtrOperatorConstraint[]
     */
    private $ptrOpConsts = [];
    
    /**
     * Constructor.
     * 
     * @param   PtrOperatorConstraint[] $ptrOpConsts    The pointer operator constraints to set.
     */
    public function __construct(array $ptrOpConsts)
    {
        $this->setPtrOperatorConstraints($ptrOpConsts);
    }
    
    /**
     * Sets the pointer operator constraints.
     * 
     * @param   PtrOperatorConstraint[] $ptrOpConsts    The pointer operator constraints to set.
     * 
     * @throws  ArgumentException   When the pointer operator constraints are empty.
     * @throws  ArgumentException   When a pointer operator constraint is not an instance of PtrOperatorConstraint.
     */
    private function setPtrOperatorConstraints(array $ptrOpConsts): void
    {
        if (\count($ptrOpConsts) == 0) {
            throw new ArgumentException('The pointer operator constraints are empty.');
        }
        
        foreach ($ptrOpConsts as $ptrOpConst) {
            if (!$ptrOpConst instanceof PtrOperatorConstraint) {
                throw new ArgumentException(\sprintf(
                    'The constraint must be an instance of %s.', 
                    PtrOperatorConstraint::class
                ));
            }
        }
        
        $this->ptrOpConsts = \array_values($ptrOpConsts);
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return 'pointer operator sequence';
    }
    
    /**
     * {@inheritDoc}
     */
    public function constraintDescription(): string
    {
        $lines = [];
        $lines[] = \sprintf(
            '%s (%s)', 
            $this->getConceptName(), 
            \count($this->ptrOpConsts)
        );
        
        foreach ($this->ptrOpConsts as $ptrOpConst) {
            $lines[] = $this->indent($ptrOpConst->constraintDescription());
        }
        
        return \implode("\n", $lines);
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        if (!$other instanceof PtrOperatorSequence) {
            return FALSE;
        }
        
        if (\count($this->ptrOpConsts) != \count($other)) {
            return FALSE;
        }
        
        foreach ($other->getPtrOperators() as $idx => $ptrOp) {
            if (!$this->ptrOpConsts[$idx]->matches($ptrOp)) {
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
        if (!$other instanceof PtrOperatorSequence) {
            return $this->instanceReason(PtrOperatorSequence::class, $other);
        } 
        
        if (\count($this->ptrOpConsts) != \count($other)) {
            return $this->countReason(
                \count($this->ptrOpConsts), 
                \count($other), 
                'pointer operator(s)'
            );
        }
        
        foreach ($other->getPtrOperators() as $idx => $ptrOp) {
            if (!$this->ptrOpConsts[$idx]->matches($ptrOp)) {
                return $this->conceptIndent(
                    $this->ptrOpConsts[$idx]->failureReason($ptrOp)
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
            '%s is a %s', 
            $this->exporter()->shortenedExport($other), 
            $this->toString()
        );
    }
}

