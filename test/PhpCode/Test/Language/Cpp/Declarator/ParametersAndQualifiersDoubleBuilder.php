<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\CVQualifierSequence;
use PhpCode\Language\Cpp\Declarator\ParameterDeclarationClause;
use PhpCode\Language\Cpp\Declarator\ParametersAndQualifiers;
use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents a builder of double for the {@see PhpCode\Language\Cpp\Declarator\ParametersAndQualifiers} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParametersAndQualifiersDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return ParametersAndQualifiers::class;
    }
    
    /**
     * Builds and adds a prophecy where getParameterDeclarationClause() can 
     * be called.
     * 
     * @param   ParameterDeclarationClause  $return The value to return when getParameterDeclarationClause() is called.
     * @return  ParametersAndQualifiersDoubleBuilder    This instance.
     */
    public function buildGetParameterDeclarationClause(
        ParameterDeclarationClause $return
    ): self
    {
        $this->getSubjectProphecy()
            ->getParameterDeclarationClause()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds and adds a prophecy where getCVQualifierSequence() can be 
     * called.
     * 
     * @param   CVQualifierSequence $return The value to return when getCVQualifierSequence() is called (optional)(default to NULL).
     * @return  ParametersAndQualifiersDoubleBuilder    This instance.
     */
    public function buildGetCVQualifierSequence(
        CVQualifierSequence $return = NULL
    ): self
    {
        $this->getSubjectProphecy()
            ->getCVQualifierSequence()
            ->willReturn($return);
        
        return $this;
    }
}

