<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParameterDeclarationClause;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraintDoubleFactory;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationClauseConstraint} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationClauseConstraintDoubleFactory extends AbstractConceptConstraintDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getClassName(): string
    {
        return ParameterDeclarationClauseConstraint::class;
    }
    
    /**
     * Creates a double where matches() can be called.
     * 
     * @param   ParameterDeclarationClause  $prmDeclClause  The value of the first argument when matches() is called.
     * @param   bool                        $return         The value to return when matches() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatches(
        ParameterDeclarationClause $prmDeclClause, 
        bool $return
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        
        $this->buildMatches($prophecy, $prmDeclClause, $return);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where matches() and failureReason() can be called.
     * 
     * @param   ParameterDeclarationClause  $prmDeclClause  The value of the first argument when matches() or failureReason() is called.
     * @param   bool                        $matches        The value to return when matches() is called.
     * @param   string                      $failureReason  The value to return when failureReason() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatchesFailureReason(
        ParameterDeclarationClause $prmDeclClause, 
        bool $matches, 
        string $failureReason
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $this->buildMatches($prophecy, $prmDeclClause, $matches);
        $this->buildFailureReason($prophecy, $prmDeclClause, $failureReason);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where matches() and constraintDescription() can be 
     * called.
     * 
     * @param   ParameterDeclarationClause  $prmDeclClause  The value of the first argument when matches() is called.
     * @param   bool                        $matches        The value to return when matches() is called.
     * @param   string                      $constDesc      The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatchesConstraintDescription(
        ParameterDeclarationClause $prmDeclClause, 
        bool $matches, 
        string $constDesc
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $this->buildMatches($prophecy, $prmDeclClause, $matches);
        $this->buildConstraintDescription($prophecy, $constDesc);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where matches(), failureReason() and 
     * constraintDescription() can be called.
     * 
     * @param   ParameterDeclarationClause  $prmDeclClause  The value of the first argument when matches() or failureReason() is called.
     * @param   bool                        $matches        The value to return when matches() is called.
     * @param   string                      $failureReason  The value to return when failureReason() is called.
     * @param   string                      $constDesc      The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatchesFailureReasonConstraintDescription(
        ParameterDeclarationClause $prmDeclClause, 
        bool $matches, 
        string $failureReason, 
        string $constDesc
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $this->buildMatches($prophecy, $prmDeclClause, $matches);
        $this->buildFailureReason($prophecy, $prmDeclClause, $failureReason);
        $this->buildConstraintDescription($prophecy, $constDesc);
        
        return $prophecy->reveal();
    }
}

