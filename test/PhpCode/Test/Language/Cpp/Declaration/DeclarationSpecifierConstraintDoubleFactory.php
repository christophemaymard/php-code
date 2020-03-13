<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\DeclarationSpecifier;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraintDoubleFactory;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierConstraint} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclarationSpecifierConstraintDoubleFactory extends AbstractConceptConstraintDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getClassName(): string
    {
        return DeclarationSpecifierConstraint::class;
    }
    
    /**
     * Creates a double where matches() can be called.
     * 
     * @param   DeclarationSpecifier    $declSpec   The value of the first argument when matches() is called.
     * @param   bool                    $return     The value to return when matches() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatches(DeclarationSpecifier $declSpec, bool $return): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        
        $this->buildMatches($prophecy, $declSpec, $return);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where matches() and failureReason() can be called.
     * 
     * @param   DeclarationSpecifier    $declSpec       The value of the first argument when matches() or failureReason() is called.
     * @param   bool                    $matches        The value to return when matches() is called.
     * @param   string                  $failureReason  The value to return when failureReason() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatchesFailureReason(
        DeclarationSpecifier $declSpec, 
        bool $matches, 
        string $failureReason
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $this->buildMatches($prophecy, $declSpec, $matches);
        $this->buildFailureReason($prophecy, $declSpec, $failureReason);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where matches() and constraintDescription() can be 
     * called.
     * 
     * @param   DeclarationSpecifier    $declSpec   The value of the first argument when matches() is called.
     * @param   bool                    $matches    The value to return when matches() is called.
     * @param   string                  $constDesc  The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatchesConstraintDescription(
        DeclarationSpecifier $declSpec, 
        bool $matches, 
        string $constDesc
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $this->buildMatches($prophecy, $declSpec, $matches);
        $this->buildConstraintDescription($prophecy, $constDesc);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where matches(), failureReason() and 
     * constraintDescription() can be called.
     * 
     * @param   DeclarationSpecifier    $declSpec       The value of the first argument when matches() or failureReason() is called.
     * @param   bool                    $matches        The value to return when matches() is called.
     * @param   string                  $failureReason  The value to return when failureReason() is called.
     * @param   string                  $constDesc      The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatchesFailureReasonConstraintDescription(
        DeclarationSpecifier $declSpec, 
        bool $matches, 
        string $failureReason, 
        string $constDesc
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $this->buildMatches($prophecy, $declSpec, $matches);
        $this->buildFailureReason($prophecy, $declSpec, $failureReason);
        $this->buildConstraintDescription($prophecy, $constDesc);
        
        return $prophecy->reveal();
    }
    
    /**
     * Builds and adds a prophecy of matches() to the specified prophecy.
     * 
     * @param   ObjectProphecy          $prophecy    The prophecy to build to.
     * @param   DeclarationSpecifier    $declSpec   The value of the first argument when matches() is called.
     * @param   bool                    $return     The value to return when matches() is called.
     */
    private function buildMatches(
        ObjectProphecy $prophecy, 
        DeclarationSpecifier $declSpec, 
        bool $return
    ): void
    {
        $prophecy
            ->matches($declSpec)
            ->willReturn($return);
    }
    
    /**
     * Builds and adds a prophecy of failureReason() to the specified 
     * prophecy.
     * 
     * @param   ObjectProphecy          $prophecy    The prophecy to build to.
     * @param   DeclarationSpecifier    $declSpec   The value of the first argument when failureReason() is called.
     * @param   string                  $return     The value to return when failureReason() is called.
     */
    private function buildFailureReason(
        ObjectProphecy $prophecy, 
        DeclarationSpecifier $declSpec, 
        string $return
    ): void
    {
        $prophecy
            ->failureReason($declSpec)
            ->willReturn($return);
    }
}

