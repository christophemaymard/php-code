<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\CVQualifierSequence;
use PhpCode\Language\Cpp\Declarator\PtrOperator;
use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents a builder of double for the {@see PhpCode\Language\Cpp\Declarator\PtrOperator} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrOperatorDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return PtrOperator::class;
    }
    
    /**
     * Builds and adds a prophecy where isPointer() can be called.
     * 
     * @param   bool    $return The value to return when isPointer() is called.
     * @return  PtrOperatorDoubleBuilder    This instance.
     */
    public function buildIsPointer(bool $return): self
    {
        $this->getSubjectProphecy()
            ->isPointer()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds and adds a prophecy where isLvalue() can be called.
     * 
     * @param   bool    $return The value to return when isLvalue() is called.
     * @return  PtrOperatorDoubleBuilder    This instance.
     */
    public function buildIsLvalue(bool $return): self
    {
        $this->getSubjectProphecy()
            ->isLvalue()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds and adds a prophecy where isRvalue() can be called.
     * 
     * @param   bool    $return The value to return when isRvalue() is called.
     * @return  PtrOperatorDoubleBuilder    This instance.
     */
    public function buildIsRvalue(bool $return): self
    {
        $this->getSubjectProphecy()
            ->isRvalue()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds and adds a prophecy where getCVQualifierSequence() can be 
     * called.
     * 
     * @param   CVQualifierSequence $return The value to return when getCVQualifierSequence() is called (optional)(default to NULL).
     * @return  PtrOperatorDoubleBuilder    This instance.
     */
    public function buildGetCVQualifierSequence(CVQualifierSequence $return = NULL): self
    {
        $this->getSubjectProphecy()
            ->getCVQualifierSequence()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds and adds a prophecy where hasCVQualifierSequence() can be called.
     * 
     * @param   bool    $return The value to return when hasCVQualifierSequence() is called.
     * @return  PtrOperatorDoubleBuilder    This instance.
     */
    public function buildHasCVQualifierSequence(bool $return): self
    {
        $this->getSubjectProphecy()
            ->hasCVQualifierSequence()
            ->willReturn($return);
        
        return $this;
    }
}

