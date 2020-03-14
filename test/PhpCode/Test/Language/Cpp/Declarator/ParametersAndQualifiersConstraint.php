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
        
        return $this->prmDeclClauseConst->matches($prmDeclClause);
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
        
        return $this->failureDefaultReason($other);
    }
    
    /**
     * {@inheritDoc}
     */
    protected function failureDescription($other): string
    {
        return \sprintf(
            '%s is %s', 
            $this->exporter()->shortenedExport($other), 
            $this->toString()
        );
    }
}

