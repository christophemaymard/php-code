<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp;

use PhpCode\Test\AbstractDoubleFactory;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the base class for a factory of concept constraint doubles.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractConceptConstraintDoubleFactory extends AbstractDoubleFactory
{
    /**
     * Creates a double where constraintDescription() can be called.
     * 
     * @param   string  $return The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    public function createConstraintDescription(string $return): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $this->buildConstraintDescription($prophecy, $return);
        
        return $prophecy->reveal();
    }
    
    /**
     * Builds and adds a prophecy of constraintDescription() to the 
     * specified prophecy.
     * 
     * @param   ObjectProphecy  $prophecy   The prophecy to build to.
     * @param   string          $return     The value to return when constraintDescription() is called.
     */
    protected function buildConstraintDescription(
        ObjectProphecy $prophecy, 
        string $return
    ): void
    {
        $prophecy
            ->constraintDescription()
            ->willReturn($return);
    }
    
    /**
     * Builds and adds a prophecy of matches() to the specified prophecy.
     * 
     * @param   ObjectProphecy  $prophecy   The prophecy to build to.
     * @param   mixed           $other      The value of the first argument when matches() is called.
     * @param   bool            $return     The value to return when matches() is called.
     */
    protected function buildMatches(
        ObjectProphecy $prophecy, 
        $other, 
        bool $return
    ): void
    {
        $prophecy
            ->matches($other)
            ->willReturn($return);
    }
    
    /**
     * Builds and adds a prophecy of failureReason() to the specified 
     * prophecy.
     * 
     * @param   ObjectProphecy  $prophecy   The prophecy to build to.
     * @param   mixed           $other      The value of the first argument when failureReason() is called.
     * @param   string          $return     The value to return when failureReason() is called.
     */
    protected function buildFailureReason(
        ObjectProphecy $prophecy, 
        $other, 
        string $return
    ): void
    {
        $prophecy
            ->failureReason($other)
            ->willReturn($return);
    }
}

