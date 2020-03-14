<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParameterDeclarationClause;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;

/**
 * Represents the constraint for a parameter declaration clause.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationClauseConstraint extends AbstractConceptConstraint
{
    /**
     * The parameter declaration list constraint.
     * @var ParameterDeclarationListConstraint|NULL
     */
    private $prmDeclListConst;
    
    /**
     * The flag to indicate whether an ellipsis is present (default to FALSE).
     * @var bool
     */
    private $hasEllipsis = FALSE;
    
    /**
     * Sets the parameter declaration list constraint.
     * 
     * @param   ParameterDeclarationListConstraint  $prmDeclListConst   The parameter declaration list constraint to set.
     * @return  ParameterDeclarationClauseConstraint    This instance.
     */
    public function setParameterDeclarationListConstraint(
        ParameterDeclarationListConstraint $prmDeclListConst
    ): self
    {
        $this->prmDeclListConst = $prmDeclListConst;
        
        return $this;
    }
    
    /**
     * Indicates that an ellipsis is present.
     * 
     * @return  ParameterDeclarationClauseConstraint    This instance.
     */
    public function addEllipsis(): self
    {
        $this->hasEllipsis = TRUE;
        
        return $this;
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        $has = [];
        
        if ($this->prmDeclListConst) {
            $has[] = 'a parameter declaration list';
        }
        
        if ($this->hasEllipsis) {
            $has[] = 'an ellipsis';
        }
        
        return \sprintf(
            'parameter declaration clause%s', 
            empty($has) ? '' : ' with '.\implode(' and ', $has)
        );
    }
    
    /**
     * {@inheritDoc}
     */
    public function constraintDescription(): string
    {
        $lines = [];
        $lines[] = $this->getConceptName();
        
        if ($this->prmDeclListConst) {
            $lines[] = $this->indent($this->prmDeclListConst->constraintDescription());
        }
        
        return \implode("\n", $lines);
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        if (!$other instanceof ParameterDeclarationClause) {
            return FALSE;
        }
        
        $prmDeclList = $other->getParameterDeclarationList();
        
        if ($prmDeclList && !$this->prmDeclListConst) {
            return FALSE;
        }
        
        if ($this->prmDeclListConst && !$this->prmDeclListConst->matches($prmDeclList)) {
            return FALSE;
        }
        
        if ($other->hasEllipsis() !== $this->hasEllipsis) {
            return FALSE;
        }
        
        return TRUE;
    }
    
    /**
     * {@inheritDoc}
     */
    public function failureReason($other): string
    {
        if (!$other instanceof ParameterDeclarationClause) {
            return $this->instanceReason(ParameterDeclarationClause::class, $other);
        } 
        
        $prmDeclList = $other->getParameterDeclarationList();
        
        if ($prmDeclList && !$this->prmDeclListConst) {
            return $this->unexpectedReason('parameter declaration list');
        }
        
        if ($this->prmDeclListConst && !$this->prmDeclListConst->matches($prmDeclList)) {
            return $this->conceptIndent(
                $this->prmDeclListConst->failureReason($prmDeclList)
            );
        }
        
        if ($other->hasEllipsis() !== $this->hasEllipsis) {
            return $this->hasReason($this->hasEllipsis, 'ellipsis');
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

