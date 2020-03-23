<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParameterDeclarationClause;
use PhpCode\Language\Cpp\Declarator\ParametersAndQualifiers;
use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents a double builder of the {@see PhpCode\Language\Cpp\Declarator\ParametersAndQualifiers} 
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
}

