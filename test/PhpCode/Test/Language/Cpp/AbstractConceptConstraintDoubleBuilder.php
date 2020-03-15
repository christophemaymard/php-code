<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp;

use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents the base class for a builder of concept constraint double.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractConceptConstraintDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * Builds and adds a prophecy where toString() can be called.
     * 
     * @param   string  $return The value to return when toString() is called.
     * @return  AbstractConceptConstraintDoubleBuilder  This instance.
     */
    public function buildToString(string $return): self
    {
        $this->getProphecy()
            ->toString()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds and adds a prophecy where constraintDescription() can be called.
     * 
     * @param   string  $return The value to return when constraintDescription() is called.
     * @return  AbstractConceptConstraintDoubleBuilder  This instance.
     */
    public function buildConstraintDescription(string $return): self
    {
        $this->getProphecy()
            ->constraintDescription()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds and adds a prophecy where matches() can be called.
     * 
     * @param   mixed   $other  The value of the first argument when matches() is called.
     * @param   bool    $return The value to return when matches() is called.
     * @return  AbstractConceptConstraintDoubleBuilder  This instance.
     */
    public function buildMatches($other, bool $return): self
    {
        $this->getProphecy()
            ->matches($other)
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds and adds a prophecy where failureReason() can be called.
     * 
     * @param   mixed           $other      The value of the first argument when failureReason() is called.
     * @param   string          $return     The value to return when failureReason() is called.
     * @return  AbstractConceptConstraintDoubleBuilder  This instance.
     */
    public function buildFailureReason($other, string $return): self
    {
        $this->getProphecy()
            ->failureReason($other)
            ->willReturn($return);
        
        return $this;
    }
}

