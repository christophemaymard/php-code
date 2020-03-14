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
use PhpCode\Test\AbstractDoubleFactory;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Declarator\ParametersAndQualifiers} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParametersAndQualifiersDoubleFactory extends AbstractDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getClassName(): string
    {
        return ParametersAndQualifiers::class;
    }
    
    /**
     * Creates a double where getParameterDeclarationClause() can be called.
     * 
     * @param   ParameterDeclarationClause  $return The value to return when getParameterDeclarationClause() is called.
     * @return  ProphecySubjectInterface
     */
    public function createGetParameterDeclarationClause(
        ParameterDeclarationClause $return
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $prophecy
            ->getParameterDeclarationClause()
            ->willReturn($return);
        
        return $prophecy->reveal();
    }
}

