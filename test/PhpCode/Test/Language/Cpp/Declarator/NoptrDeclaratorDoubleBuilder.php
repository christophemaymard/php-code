<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\DeclaratorId;
use PhpCode\Language\Cpp\Declarator\NoptrDeclarator;
use PhpCode\Language\Cpp\Declarator\ParametersAndQualifiers;
use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents a builder of double for the {@see PhpCode\Language\Cpp\Declarator\NoptrDeclarator} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NoptrDeclaratorDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return NoptrDeclarator::class;
    }
    
    /**
     * Builds a prophecy where getDeclaratorId() can be called.
     * 
     * @param   DeclaratorId    $return The value to return when getDeclaratorId() is called.
     * @return  NoptrDeclaratorDoubleBuilder    This instance.
     */
    public function buildGetDeclaratorId(DeclaratorId $return): self
    {
        $this->getSubjectProphecy()
            ->getDeclaratorId()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds a prophecy where getParametersAndQualifiers() can be called.
     * 
     * @param   ParametersAndQualifiers $return The value to return when getParametersAndQualifiers() is called (optional)(default to NULL).
     * @return  NoptrDeclaratorDoubleBuilder    This instance.
     */
    public function buildGetParametersAndQualifiers(ParametersAndQualifiers $return = NULL): self
    {
        $this->getSubjectProphecy()
            ->getParametersAndQualifiers()
            ->willReturn($return);
        
        return $this;
    }
}

