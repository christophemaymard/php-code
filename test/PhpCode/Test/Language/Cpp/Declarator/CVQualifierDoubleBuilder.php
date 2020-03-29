<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\CVQualifier;
use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents a builder of double for the {@see PhpCode\Language\Cpp\Declarator\CVQualifier} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class CVQualifierDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return CVQualifier::class;
    }
    
    /**
     * Builds a prophecy where isConst() can be called.
     * 
     * @param   bool    $return The value to return when isConst() is called.
     * @return  CVQualifierDoubleBuilder    This instance.
     */
    public function buildIsConst(bool $return): self
    {
        $this->getSubjectProphecy()
            ->isConst()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds a prophecy where isVolatile() can be called.
     * 
     * @param   bool    $return The value to return when isVolatile() is called.
     * @return  CVQualifierDoubleBuilder    This instance.
     */
    public function buildIsVolatile(bool $return): self
    {
        $this->getSubjectProphecy()
            ->isVolatile()
            ->willReturn($return);
        
        return $this;
    }
}

