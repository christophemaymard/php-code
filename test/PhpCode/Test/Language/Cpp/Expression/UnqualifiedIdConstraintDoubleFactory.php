<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\UnqualifiedId;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraintDoubleFactory;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Test\Language\Cpp\Expression\UnqualifiedIdConstraint} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class UnqualifiedIdConstraintDoubleFactory extends AbstractConceptConstraintDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getClassName(): string
    {
        return UnqualifiedIdConstraint::class;
    }
    
    /**
     * Creates a double where matches() can be called.
     * 
     * @param   UnqualifiedId   $uid    The value of the first argument when matches() is called.
     * @param   bool            $return The value to return when matches() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatches(UnqualifiedId $uid, bool $return): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        
        $this->buildMatches($prophecy, $uid, $return);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where matches() and failureReason() can be called.
     * 
     * @param   UnqualifiedId   $uid            The value of the first argument when matches() or failureReason() is called.
     * @param   bool            $matches        The value to return when matches() is called.
     * @param   string          $failureReason  The value to return when failureReason() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatchesFailureReason(
        UnqualifiedId $uid, 
        bool $matches, 
        string $failureReason
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $this->buildMatches($prophecy, $uid, $matches);
        $this->buildFailureReason($prophecy, $uid, $failureReason);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where matches() and constraintDescription() can be 
     * called.
     * 
     * @param   UnqualifiedId   $uid        The value of the first argument when matches() is called.
     * @param   bool            $matches    The value to return when matches() is called.
     * @param   string          $constDesc  The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatchesConstraintDescription(
        UnqualifiedId $uid, 
        bool $matches, 
        string $constDesc
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $this->buildMatches($prophecy, $uid, $matches);
        $this->buildConstraintDescription($prophecy, $constDesc);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where matches(), failureReason() and 
     * constraintDescription() can be called.
     * 
     * @param   UnqualifiedId   $uid            The value of the first argument when matches() or failureReason() is called.
     * @param   bool            $matches        The value to return when matches() is called.
     * @param   string          $failureReason  The value to return when failureReason() is called.
     * @param   string          $constDesc      The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatchesFailureReasonConstraintDescription(
        UnqualifiedId $uid, 
        bool $matches, 
        string $failureReason, 
        string $constDesc
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $this->buildMatches($prophecy, $uid, $matches);
        $this->buildFailureReason($prophecy, $uid, $failureReason);
        $this->buildConstraintDescription($prophecy, $constDesc);
        
        return $prophecy->reveal();
    }
}

