<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraintDoubleFactory;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierSequenceConstraint} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclarationSpecifierSequenceConstraintDoubleFactory extends AbstractConceptConstraintDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return DeclarationSpecifierSequenceConstraint::class;
    }
    
    /**
     * Creates a double where matches() can be called.
     * 
     * @param   DeclarationSpecifierSequence    $declSpecSeq    The value of the first argument when matches() is called.
     * @param   bool                            $return         The value to return when matches() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatches(
        DeclarationSpecifierSequence $declSpecSeq, 
        bool $return
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        
        $this->buildMatches($prophecy, $declSpecSeq, $return);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where matches() and failureReason() can be called.
     * 
     * @param   DeclarationSpecifierSequence    $declSpecSeq    The value of the first argument when matches() or failureReason() is called.
     * @param   bool                            $matches        The value to return when matches() is called.
     * @param   string                          $failureReason  The value to return when failureReason() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatchesFailureReason(
        DeclarationSpecifierSequence $declSpecSeq, 
        bool $matches, 
        string $failureReason
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        $this->buildMatches($prophecy, $declSpecSeq, $matches);
        $this->buildFailureReason($prophecy, $declSpecSeq, $failureReason);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where matches() and constraintDescription() can be 
     * called.
     * 
     * @param   DeclarationSpecifierSequence    $declSpecSeq   The value of the first argument when matches() is called.
     * @param   bool                            $matches       The value to return when matches() is called.
     * @param   string                          $constDesc      The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatchesConstraintDescription(
        DeclarationSpecifierSequence $declSpecSeq, 
        bool $matches, 
        string $constDesc
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        $this->buildMatches($prophecy, $declSpecSeq, $matches);
        $this->buildConstraintDescription($prophecy, $constDesc);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where matches(), failureReason() and 
     * constraintDescription() can be called.
     * 
     * @param   DeclarationSpecifierSequence    $declSpecSeq    The value of the first argument when matches() or failureReason() is called.
     * @param   bool                            $matches        The value to return when matches() is called.
     * @param   string                          $failureReason  The value to return when failureReason() is called.
     * @param   string                          $constDesc      The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    public function createMatchesFailureReasonConstraintDescription(
        DeclarationSpecifierSequence $declSpecSeq, 
        bool $matches, 
        string $failureReason, 
        string $constDesc
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        $this->buildMatches($prophecy, $declSpecSeq, $matches);
        $this->buildFailureReason($prophecy, $declSpecSeq, $failureReason);
        $this->buildConstraintDescription($prophecy, $constDesc);
        
        return $prophecy->reveal();
    }
}

