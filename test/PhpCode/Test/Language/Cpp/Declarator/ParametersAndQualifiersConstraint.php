<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParametersAndQualifiers;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;

/**
 * Represents the constraint for parameters and qualifiers.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParametersAndQualifiersConstraint extends AbstractConceptConstraint
{
    /**
     * The parameter declaration clause constraint.
     * @var ParameterDeclarationClauseConstraint
     */
    private $prmDeclClauseConst;
    
    /**
     * The constant/volatile qualifier sequence constraint.
     * @var CVQualifierSequenceConstraint|NULL
     */
    private $cvSeqConst;
    
    /**
     * Constructor.
     * 
     * @param   ParameterDeclarationClauseConstraint    $prmDeclClauseConst The parameter declaration clause constraint.
     */
    public function __construct(
        ParameterDeclarationClauseConstraint $prmDeclClauseConst
    )
    {
        $this->prmDeclClauseConst = $prmDeclClauseConst;
    }
    
    /**
     * Sets the constant/volatile qualifier sequence constraint.
     * 
     * @param   CVQualifierSequenceConstraint   $cvSeqConst The constant/volatile qualifier sequence constraint to set.
     */
    public function setCVQualifierSequenceConstraint(
        CVQualifierSequenceConstraint $cvSeqConst
    ): void
    {
        $this->cvSeqConst = $cvSeqConst;
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return 'parameters and qualifiers';
    }
    
    /**
     * {@inheritDoc}
     */
    public function constraintDescription(): string
    {
        $lines = [];
        $lines[] = $this->getConceptName();
        $lines[] = $this->indent($this->prmDeclClauseConst->constraintDescription());
        
        if ($this->cvSeqConst) {
            $lines[] = $this->indent($this->cvSeqConst->constraintDescription());
        }
        
        return \implode("\n", $lines);
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        if (!$other instanceof ParametersAndQualifiers) {
            return FALSE;
        }
        
        $prmDeclClause = $other->getParameterDeclarationClause();
        
        if (!$this->prmDeclClauseConst->matches($prmDeclClause)) {
            return FALSE;
        }
        
        $cvSeq = $other->getCVQualifierSequence();
        
        if (!$cvSeq && $this->cvSeqConst || $cvSeq && !$this->cvSeqConst) {
            return FALSE;
        }
        
        if ($this->cvSeqConst && !$this->cvSeqConst->matches($cvSeq)) {
            return FALSE;
        }
        
        return TRUE;
    }
    
    /**
     * {@inheritDoc}
     */
    public function failureReason($other): string
    {
        if (!$other instanceof ParametersAndQualifiers) {
            return $this->instanceReason(ParametersAndQualifiers::class, $other);
        } 
        
        $prmDeclClause = $other->getParameterDeclarationClause();
        
        if (!$this->prmDeclClauseConst->matches($prmDeclClause)) {
            return $this->conceptIndent(
                $this->prmDeclClauseConst->failureReason($prmDeclClause)
            );
        }
        
        $cvSeq = $other->getCVQualifierSequence();
        
        if (!$cvSeq && $this->cvSeqConst) {
            return $this->hasReason(TRUE, 'constant/volatile qualifier sequence');
        }
        
        if ($cvSeq && !$this->cvSeqConst) {
            return $this->hasReason(FALSE, 'constant/volatile qualifier sequence');
        }
        
        if ($this->cvSeqConst && !$this->cvSeqConst->matches($cvSeq)) {
            return $this->conceptIndent(
                $this->cvSeqConst->failureReason($cvSeq)
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
            '%s are %s', 
            $this->exporter()->shortenedExport($other), 
            $this->toString()
        );
    }
}

