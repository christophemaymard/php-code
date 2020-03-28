<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\NoptrDeclarator;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;

/**
 * Represents the constraint for a no-pointer declarator.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NoptrDeclaratorConstraint extends AbstractConceptConstraint
{
    /**
     * The declarator identifier constraint.
     * @var DeclaratorIdConstraint
     */
    private $didConst;
    
    /**
     * The parameters and qualifiers constraint.
     * @var ParametersAndQualifiersConstraint|NULL
     */
    private $prmQualConst;
    
    /**
     * Creates a constraint for a no-pointer declarator that is defined as an 
     * declarator identifier.
     * 
     * @param   DeclaratorIdConstraint  $didConst   The declarator identifier constraint.
     * @return  NoptrDeclaratorConstraint   The created instance of no-pointer declarator constraint.
     */
    public static function createDeclaratorId(DeclaratorIdConstraint $didConst): self
    {
        $const = new self();
        $const->didConst = $didConst;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a no-pointer declarator that is defined as an 
     * declarator identifier with parameters and qualifiers.
     * 
     * @param   DeclaratorIdConstraint              $didConst       The declarator identifier constraint.
     * @param   ParametersAndQualifiersConstraint   $prmQualConst   The parameters and qualifiers constraint.
     * @return  NoptrDeclaratorConstraint   The created instance of no-pointer declarator constraint.
     */
    public static function createDeclaratorIdParametersAndQualifiers(
        DeclaratorIdConstraint $didConst, 
        ParametersAndQualifiersConstraint $prmQualConst
    ): self
    {
        $const = new self();
        $const->didConst = $didConst;
        $const->prmQualConst = $prmQualConst;
        
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
        $contains = [];
        $contains[] = $this->didConst->toString();
        
        if ($this->prmQualConst) {
            $contains[] = $this->prmQualConst->toString();
        }
        
        return \sprintf(
            'no-pointer declarator with %s', 
            \implode(' and ', $contains)
        );
    }
    
    /**
     * {@inheritDoc}
     */
    public function constraintDescription(): string
    {
        $lines = [];
        $lines[] = $this->getConceptName();
        $lines[] = $this->indent($this->didConst->constraintDescription());
        
        if ($this->prmQualConst) {
            $lines[] = $this->indent($this->prmQualConst->constraintDescription());
        }
        
        return \implode("\n", $lines);
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        if (!$other instanceof NoptrDeclarator) {
            return FALSE;
        }
        
        if (!$this->didConst->matches($other->getDeclaratorId())) {
            return FALSE;
        }
        
        $prmQual = $other->getParametersAndQualifiers();
        
        if ($prmQual && !$this->prmQualConst) {
            return FALSE;
        }
        
        if ($this->prmQualConst && !$this->prmQualConst->matches($prmQual)) {
            return FALSE;
        }
        
        return TRUE;
    }
    
    /**
     * {@inheritDoc}
     */
    public function failureReason($other): string
    {
        if (!$other instanceof NoptrDeclarator) {
            return $this->instanceReason(NoptrDeclarator::class, $other);
        } 
        
        if (!$this->didConst->matches($other->getDeclaratorId())) {
            return $this->conceptIndent(
                $this->didConst->failureReason($other->getDeclaratorId())
            );
        }
        
        $prmQual = $other->getParametersAndQualifiers();
        
        if ($prmQual && !$this->prmQualConst) {
            return $this->unexpectedReason('parameters and qualifiers');
        }
        
        if ($this->prmQualConst && !$this->prmQualConst->matches($prmQual)) {
            return $this->conceptIndent(
                $this->prmQualConst->failureReason($prmQual)
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

