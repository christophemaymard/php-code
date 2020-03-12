<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence;
use PhpCode\Language\Cpp\Declarator\ParameterDeclaration;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierSequenceConstraint;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationConstraint;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationConstraint} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationConstraintTest extends TestCase
{
    /**
     * Tests that __construct() throws an exception.
     */
    public function test__constructThrowsException(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        
        $sut = new ParameterDeclarationConstraint();
    }
    
    /**
     * Tests that toString() returns a string when the instance is created 
     * by create().
     */
    public function testToStringReturnsStringWhenCreate(): void
    {
        $declSpecSeqConst = $this->createDeclarationSpecifierSequenceConstraintDummy();
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertSame('parameter declaration', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string when the instance is 
     * created by create().
     */
    public function testGetConceptNameReturnsStringWhenCreate(): void
    {
        $declSpecSeqConst = $this->createDeclarationSpecifierSequenceConstraintDummy();
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertSame('Parameter declaration', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when the instance 
     * is created by create().
     */
    public function testFailureDefaultReasonReturnsStringWhenCreate(): void
    {
        $declSpecSeqConst = $this->createDeclarationSpecifierSequenceConstraintDummy();
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertSame('Parameter declaration: Unknown reason.', $sut->failureDefaultReason(NULL));
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by create().
     */
    public function testConstraintDescriptionReturnsStringWhenCreate(): void
    {
        $declSpecSeqConst = $this->createDeclarationSpecifierSequenceConstraintDoubleConstraintDescription(
            "foo DeclarationSpecifierSequence\n  bar DeclarationSpecifier"
        );
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertSame(
            "Parameter declaration\n".
            "  foo DeclarationSpecifierSequence\n".
            "    bar DeclarationSpecifier", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * create() and not instance of ParameterDeclaration.
     */
    public function testMatchesReturnsFalseWhenCreateAndNotInstanceParameterDeclaration(): void
    {
        $declSpecSeqConst = $this->createDeclarationSpecifierSequenceConstraintDummy();
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * create() and the declaration specifier sequence is invalid.
     */
    public function testMatchesReturnsFalseWhenCreateAndDeclarationSpecifierSequenceIsInvalid(): void
    {
        $declSpecSeq = $this->createDeclarationSpecifierSequenceDummy();
        $prmDecl = $this->createParameterDeclarationDoubleGetDeclarationSpecifierSequence(
            $declSpecSeq
        );
        $declSpecSeqConst = $this->createDeclarationSpecifierSequenceConstraintDoubleMatches(
            $declSpecSeq, 
            FALSE
        );
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertFalse($sut->matches($prmDecl));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * create() and the parameter declaration is valid.
     */
    public function testMatchesReturnsTrueWhenCreateAndParameterDeclarationIsValid(): void
    {
        $declSpecSeq = $this->createDeclarationSpecifierSequenceDummy();
        $prmDecl = $this->createParameterDeclarationDoubleGetDeclarationSpecifierSequence(
            $declSpecSeq
        );
        $declSpecSeqConst = $this->createDeclarationSpecifierSequenceConstraintDoubleMatches(
            $declSpecSeq, 
            TRUE
        );
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertTrue($sut->matches($prmDecl));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by create() and not instance of ParameterDeclaration.
     */
    public function testFailureReasonReturnsStringWhenCreateAndNotInstanceParameterDeclaration(): void
    {
        $declSpecSeqConst = $this->createDeclarationSpecifierSequenceConstraintDummy();
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertRegExp(
            \sprintf(
                '`^Parameter declaration: .+ is not an instance of %s\\.$`', 
                \str_replace('\\', '\\\\', ParameterDeclaration::class)
            ), 
            $sut->failureReason(NULL)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by create() and the declaration specifier sequence is invalid.
     */
    public function testFailureReasonReturnsStringWhenCreateAndDeclarationSpecifierSequenceIsInvalid(): void
    {
        $declSpecSeq = $this->createDeclarationSpecifierSequenceDummy();
        $prmDecl = $this->createParameterDeclarationDoubleGetDeclarationSpecifierSequence(
            $declSpecSeq
        );
        
        $declSpecSeqConst = $this->createDeclarationSpecifierSequenceConstraintDoubleMatchesFailureReason(
            $declSpecSeq, 
            FALSE,
            "foo DeclarationSpecifierSequence\n".
            "  bar DeclarationSpecifier"
        );
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertSame(
            "Parameter declaration\n".
            "  foo DeclarationSpecifierSequence\n".
            "    bar DeclarationSpecifier", 
            $sut->failureReason($prmDecl)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by create() and the parameter declaration is valid.
     */
    public function testFailureReasonReturnsStringWhenCreateAndParameterDeclarationIsValid(): void
    {
        $declSpecSeq = $this->createDeclarationSpecifierSequenceDummy();
        $prmDecl = $this->createParameterDeclarationDoubleGetDeclarationSpecifierSequence(
            $declSpecSeq
        );
        $declSpecSeqConst = $this->createDeclarationSpecifierSequenceConstraintDoubleMatches(
            $declSpecSeq, 
            TRUE
        );
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertSame(
            'Parameter declaration: Unknown reason.', 
            $sut->failureReason($prmDecl)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by create() and not instance of 
     * ParameterDeclaration.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateAndNotInstanceParameterDeclaration(): void
    {
        $declSpecSeqConst = $this->createDeclarationSpecifierSequenceConstraintDoubleConstraintDescription(
            "foo DeclarationSpecifierSequence\n".
            "  bar DeclarationSpecifier"
        );
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        $pattern = \sprintf(
            "`^\n".
            "Parameter declaration\n". 
            "  foo DeclarationSpecifierSequence\n". 
            "    bar DeclarationSpecifier\n". 
            "\n".
            "Parameter declaration: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', ParameterDeclaration::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by create() and the declaration specifier sequence 
     * is invalid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateAndDeclarationSpecifierSequenceIsInvalid(): void
    {
        $declSpecSeq = $this->createDeclarationSpecifierSequenceDummy();
        $prmDecl = $this->createParameterDeclarationDoubleGetDeclarationSpecifierSequence(
            $declSpecSeq
        );
        
        $declSpecSeqConst = $this->createDeclarationSpecifierSequenceConstraintDoubleMatchesFailureReasonConstraintDescription(
            $declSpecSeq, 
            FALSE,
            "foo\n".
            "  bar reason", 
            "foo description\n".
            "  bar description"
        );
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertSame(
            "\n".
            "Parameter declaration\n".
            "  foo description\n".
            "    bar description\n".
            "\n".
            "Parameter declaration\n".
            "  foo\n". 
            "    bar reason", 
            $sut->additionalFailureDescription($prmDecl)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by create() and the parameter declaration is valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateAndParameterDeclarationIsValid(): void
    {
        $declSpecSeq = $this->createDeclarationSpecifierSequenceDummy();
        $prmDecl = $this->createParameterDeclarationDoubleGetDeclarationSpecifierSequence(
            $declSpecSeq
        );
        $declSpecSeqConst = $this->createDeclarationSpecifierSequenceConstraintDoubleMatchesConstraintDescription(
            $declSpecSeq, 
            TRUE, 
            "foo description\n".
            "  bar description"
        );
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertSame(
            "\n".
            "Parameter declaration\n".
            "  foo description\n".
            "    bar description\n".
            "\n".
            "Parameter declaration: Unknown reason.", 
            $sut->additionalFailureDescription($prmDecl)
        );
    }
    
    /**
     * Tests that failureDescription() is called when the instance is created 
     * by create() and a value is invalid.
     */
    public function testFailureDescriptionWhenCreateAndInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a parameter declaration`');
        
        $declSpecSeqConst = $this->createDeclarationSpecifierSequenceConstraintDoubleConstraintDescription(
                'foo description'
        );
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Creates a dummy of the {@see PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    private function createDeclarationSpecifierSequenceDummy(): ProphecySubjectInterface
    {
        return $this->prophesize(DeclarationSpecifierSequence::class)->reveal();
    }
    
    /**
     * Creates a dummy of the {@see PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierSequenceConstraint} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    private function createDeclarationSpecifierSequenceConstraintDummy(): ProphecySubjectInterface
    {
        return $this->prophesize(DeclarationSpecifierSequenceConstraint::class)->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierSequenceConstraint} 
     * class where constraintDescription() can be called.
     * 
     * @param   string  $return The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    private function createDeclarationSpecifierSequenceConstraintDoubleConstraintDescription(
        string $return
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize(DeclarationSpecifierSequenceConstraint::class);
        $prophecy
            ->constraintDescription()
            ->willReturn($return);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierSequenceConstraint} 
     * class where matches() can be called.
     * 
     * @param   DeclarationSpecifierSequence    $declSpecSeq    The first argument when matches() is called.
     * @param   bool                            $return         The value to return when matches() is called.
     * @return  ProphecySubjectInterface
     */
    private function createDeclarationSpecifierSequenceConstraintDoubleMatches(
        DeclarationSpecifierSequence $declSpecSeq, 
        bool $return
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize(DeclarationSpecifierSequenceConstraint::class);
        $prophecy
            ->matches($declSpecSeq)
            ->willReturn($return);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierSequenceConstraint} 
     * class where matches() and failureReason() can be called.
     * 
     * @param   DeclarationSpecifierSequence    $declSpecSeq            The first argument when matches() or failureReason() is called.
     * @param   bool                            $returnMatches          The value to return when matches() is called.
     * @param   string                          $returnFailureReason    The value to return when failureReason() is called.
     * @return  ProphecySubjectInterface
     */
    private function createDeclarationSpecifierSequenceConstraintDoubleMatchesFailureReason(
        DeclarationSpecifierSequence $declSpecSeq, 
        bool $returnMatches, 
        string $returnFailureReason
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize(DeclarationSpecifierSequenceConstraint::class);
        $prophecy
            ->matches($declSpecSeq)
            ->willReturn($returnMatches);
        
        $prophecy
            ->failureReason($declSpecSeq)
            ->willReturn($returnFailureReason);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierSequenceConstraint} 
     * class where matches(), failureReason() and constraintDescription can 
     * be called.
     * 
     * @param   DeclarationSpecifierSequence    $declSpecSeq            The first argument when matches() or failureReason() is called.
     * @param   bool                            $returnMatches          The value to return when matches() is called.
     * @param   string                          $returnFailureReason    The value to return when failureReason() is called.
     * @param   string                          $returnConstDesc        The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    private function createDeclarationSpecifierSequenceConstraintDoubleMatchesFailureReasonConstraintDescription(
        DeclarationSpecifierSequence $declSpecSeq, 
        bool $returnMatches, 
        string $returnFailureReason, 
        string $returnConstDesc
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize(DeclarationSpecifierSequenceConstraint::class);
        $prophecy
            ->matches($declSpecSeq)
            ->willReturn($returnMatches);
        
        $prophecy
            ->failureReason($declSpecSeq)
            ->willReturn($returnFailureReason);
        
        $prophecy
            ->constraintDescription()
            ->willReturn($returnConstDesc);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierSequenceConstraint} 
     * class where matches() and constraintDescription() can be called.
     * 
     * @param   DeclarationSpecifierSequence    $declSpecSeq        The first argument when matches() is called.
     * @param   bool                            $returnMatches      The value to return when matches() is called.
     * @param   string                          $returnConstDesc    The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    private function createDeclarationSpecifierSequenceConstraintDoubleMatchesConstraintDescription(
        DeclarationSpecifierSequence $declSpecSeq, 
        bool $returnMatches, 
        string $returnConstDesc
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize(DeclarationSpecifierSequenceConstraint::class);
        $prophecy
            ->matches($declSpecSeq)
            ->willReturn($returnMatches);
        
        $prophecy
            ->constraintDescription()
            ->willReturn($returnConstDesc);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Language\Cpp\Declarator\ParameterDeclaration} 
     * class where getDeclarationSpecifierSequence() can be called.
     * 
     * @param   DeclarationSpecifierSequence    $return The value to return when getDeclarationSpecifierSequence() is called.
     * @return  ProphecySubjectInterface
     */
    private function createParameterDeclarationDoubleGetDeclarationSpecifierSequence(
        DeclarationSpecifierSequence $return
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize(ParameterDeclaration::class);
        $prophecy
            ->getDeclarationSpecifierSequence()
            ->willReturn($return);
        
        return $prophecy->reveal();
    }
}

