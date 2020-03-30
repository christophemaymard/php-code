<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Exception\ArgumentException;
use PhpCode\Language\Cpp\Declarator\CVQualifierSequence;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;

/**
 * Represents the constraint for a constant/volatile qualifier sequence.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class CVQualifierSequenceConstraint extends AbstractConceptConstraint
{
    /**
     * The constant/volatile qualifier constraints.
     * @var CVQualifierConstraint[]
     */
    private $cvConsts = [];
    
    /**
     * Constructor.
     * 
     * @param   CVQualifierConstraint[] $cvConsts   The constant/volatile qualifier constraints to set.
     */
    public function __construct(array $cvConsts)
    {
        $this->setCVQualifierConstraints($cvConsts);
    }
    
    /**
     * Sets the constant/volatile qualifier constraints.
     * 
     * @param   CVQualifierConstraint[] $cvConsts   The constant/volatile qualifier constraints to set.
     * 
     * @throws  ArgumentException   When the constant/volatile qualifier constraints are empty.
     * @throws  ArgumentException   When the constant/volatile qualifier constraints are empty.
     */
    private function setCVQualifierConstraints(array $cvConsts): void
    {
        if (\count($cvConsts) == 0) {
            throw new ArgumentException('The constant/volatile qualifier constraints are empty.');
        }
        
        foreach ($cvConsts as $cvConst) {
            if (!$cvConst instanceof CVQualifierConstraint) {
                throw new ArgumentException(\sprintf(
                    'The constraint must be an instance of %s.', 
                    CVQualifierConstraint::class
                ));
            }
            
            $this->cvConsts[] = $cvConst;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return 'constant/volatile qualifier sequence';
    }
    
    /**
     * {@inheritDoc}
     */
    public function constraintDescription(): string
    {
        $lines = [];
        $lines[] = \sprintf('%s (%s)', $this->getConceptName(), \count($this->cvConsts));
        
        foreach ($this->cvConsts as $cvConst) {
            $lines[] = $this->indent($cvConst->constraintDescription());
        }
        
        return \implode("\n", $lines);
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        if (!$other instanceof CVQualifierSequence) {
            return FALSE;
        }
        
        if (\count($other) != \count($this->cvConsts)) {
            return FALSE;
        }
        
        foreach ($other->getCVQualifiers() as $idx => $cv) {
            if (!$this->cvConsts[$idx]->matches($cv)) {
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
        if (!$other instanceof CVQualifierSequence) {
            return $this->instanceReason(CVQualifierSequence::class, $other);
        }
        
        if (\count($other) != \count($this->cvConsts)) {
            return $this->countReason(
                \count($this->cvConsts), 
                \count($other), 
                'constant/volatile qualifier(s)'
            );
        }
        
        foreach ($other->getCVQualifiers() as $idx => $cv) {
            if (!$this->cvConsts[$idx]->matches($cv)) {
                return $this->conceptIndent($this->cvConsts[$idx]->failureReason($cv));
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

