<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParameterDeclaration;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraintDoubleFactory;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationConstraint} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationConstraintDoubleFactory extends AbstractConceptConstraintDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getClassName(): string
    {
        return ParameterDeclarationConstraint::class;
    }
    
    /**
     * Creates a double where matches() can be called.
     * 
     * @param   ParameterDeclaration    $prmDecl    The value of the first argument when matches() is called.
     * @param   bool                    $return     The value to return when matches() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatches(ParameterDeclaration $prmDecl, bool $return): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        
        $this->buildMatches($prophecy, $prmDecl, $return);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where matches() and failureReason() can be called.
     * 
     * @param   ParameterDeclaration    $prmDecl        The value of the first argument when matches() or failureReason() is called.
     * @param   bool                    $matches        The value to return when matches() is called.
     * @param   string                  $failureReason  The value to return when failureReason() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatchesFailureReason(
        ParameterDeclaration $prmDecl, 
        bool $matches, 
        string $failureReason
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $this->buildMatches($prophecy, $prmDecl, $matches);
        $this->buildFailureReason($prophecy, $prmDecl, $failureReason);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where matches() and constraintDescription() can be 
     * called.
     * 
     * @param   ParameterDeclaration    $prmDecl    The value of the first argument when matches() is called.
     * @param   bool                    $matches    The value to return when matches() is called.
     * @param   string                  $constDesc  The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatchesConstraintDescription(
        ParameterDeclaration $prmDecl, 
        bool $matches, 
        string $constDesc
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $this->buildMatches($prophecy, $prmDecl, $matches);
        $this->buildConstraintDescription($prophecy, $constDesc);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where matches(), failureReason() and 
     * constraintDescription() can be called.
     * 
     * @param   ParameterDeclaration    $prmDecl        The value of the first argument when matches() or failureReason() is called.
     * @param   bool                    $matches        The value to return when matches() is called.
     * @param   string                  $failureReason  The value to return when failureReason() is called.
     * @param   string                  $constDesc      The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatchesFailureReasonConstraintDescription(
        ParameterDeclaration $prmDecl, 
        bool $matches, 
        string $failureReason, 
        string $constDesc
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $this->buildMatches($prophecy, $prmDecl, $matches);
        $this->buildFailureReason($prophecy, $prmDecl, $failureReason);
        $this->buildConstraintDescription($prophecy, $constDesc);
        
        return $prophecy->reveal();
    }
}

