<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declaration;

use PhpCode\Exception\ArgumentException;
use PhpCode\Language\Cpp\Declaration\DeclarationSpecifier;
use PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierConstraint;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierSequenceConstraint;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierSequenceConstraint} 
 * class.
 * 
 * @group   declaration
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclarationSpecifierSequenceConstraintTest extends TestCase
{
    /**
     * Tests that __construct() throws an exception.
     */
    public function test__constructThrowsException(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        
        $sut = new DeclarationSpecifierSequenceConstraint();
    }
    
    /**
     * Tests that create() throws an exception when the instance is created 
     * by create() and the constraints are empty.
     */
    public function testCreateThrowsExceptionWhenCreateAndConstraintsEmpty(): void
    {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('The declaration specifier constraints are empty.');
        
        $sut = DeclarationSpecifierSequenceConstraint::create([]);
    }
    
    /**
     * Tests that create() throws an exception when the instance is created 
     * by create() and one of the constraints is not an instance of 
     * DeclarationSpecifierConstraint.
     */
    public function testCreateThrowsExceptionWhenCreateAndOneOfConstraintIsNotDeclarationSpecifierConstraint(): void
    {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage(\sprintf(
            'The constraint must be an instance of %s.', 
            DeclarationSpecifierConstraint::class
        ));
        
        $consts = [];
        $consts[] = $this->createDeclarationSpecifierConstraintDummy();
        $consts[] = $this->createDeclarationSpecifierConstraintDummy();
        $consts[] = NULL;
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
    }
    
    /**
     * Tests that toString() returns a string when the instance is created by 
     * create().
     */
    public function testToStringReturnsStringWhenCreate(): void
    {
        $consts = [];
        $consts[] = $this->createDeclarationSpecifierConstraintDummy();
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
        self::assertSame('declaration specifier sequence', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string when the instance is 
     * created by create().
     */
    public function testGetConceptNameReturnsStringWhenCreate(): void
    {
        $consts = [];
        $consts[] = $this->createDeclarationSpecifierConstraintDummy();
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
        self::assertSame('Declaration specifier sequence', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when the instance 
     * is created by create().
     */
    public function testFailureDefaultReasonReturnsStringWhenCreate(): void
    {
        $consts = [];
        $consts[] = $this->createDeclarationSpecifierConstraintDummy();
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
        self::assertSame('Declaration specifier sequence: Unknown reason.', $sut->failureDefaultReason(NULL));
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by create().
     */
    public function testConstraintDescriptionReturnsStringWhenCreate(): void
    {
        $consts = [];
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleConstraintDescription('foo');
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleConstraintDescription('bar');
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleConstraintDescription('baz');
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
        self::assertSame(
            "Declaration specifier sequence (3)\n  foo\n  bar\n  baz", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * create() and not instance of DeclarationSpecifierSequence.
     */
    public function testMatchesReturnsFalseWhenCreateAndNotInstanceDeclarationSpecifierSequence(): void
    {
        $consts = [];
        $consts[] = $this->createDeclarationSpecifierConstraintDummy();
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * create() and the constraint count is not equal to the declaration 
     * specifier count of the sequence.
     */
    public function testMatchesReturnsFalseWhenCreateAndConstraintCountNotEqualDeclarationSpecifierCount(): void
    {
        $declSpecSeq = $this->createDeclarationSpecifierSequenceDoubleCount(0);
        
        $consts = [];
        $consts[] = $this->createDeclarationSpecifierConstraintDummy();
        $consts[] = $this->createDeclarationSpecifierConstraintDummy();
        $consts[] = $this->createDeclarationSpecifierConstraintDummy();
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
        self::assertFalse($sut->matches($declSpecSeq));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * create() and a declaration specifier is not valid.
     */
    public function testMatchesReturnsFalseWhenCreateAndDeclarationSpecifierIsNotValid(): void
    {
        $declSpecs = [];
        $declSpecs[] = $this->createDeclarationSpecifierDummy();
        $declSpecs[] = $this->createDeclarationSpecifierDummy();
        $declSpecs[] = $this->createDeclarationSpecifierDummy();
        $declSpecSeq = $this->createDeclarationSpecifierSequenceDoubleCountGetDeclarationSpecifiers(
            3, 
            $declSpecs
        );
        
        $consts = [];
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleMatches($declSpecs[0], TRUE);
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleMatches($declSpecs[1], TRUE);
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleMatches($declSpecs[2], FALSE);
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
        self::assertFalse($sut->matches($declSpecSeq));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * create() and the declaration specifier sequence is valid.
     */
    public function testMatchesReturnsTrueWhenCreateAndDeclarationSpecifierSequenceIsValid(): void
    {
        $declSpecs = [];
        $declSpecs[] = $this->createDeclarationSpecifierDummy();
        $declSpecs[] = $this->createDeclarationSpecifierDummy();
        $declSpecs[] = $this->createDeclarationSpecifierDummy();
        $declSpecSeq = $this->createDeclarationSpecifierSequenceDoubleCountGetDeclarationSpecifiers(
            3, 
            $declSpecs
        );
        
        $consts = [];
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleMatches($declSpecs[0], TRUE);
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleMatches($declSpecs[1], TRUE);
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleMatches($declSpecs[2], TRUE);
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
        self::assertTrue($sut->matches($declSpecSeq));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by create() and not instance of DeclarationSpecifierSequence.
     */
    public function testFailureReasonReturnsStringWhenCreateAndNotInstanceDeclarationSpecifierSequence(): void
    {
        $consts = [];
        $consts[] = $this->createDeclarationSpecifierConstraintDummy();
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
        self::assertRegExp(
            \sprintf(
                '`^Declaration specifier sequence: .+ is not an instance of %s\\.$`', 
                \str_replace('\\', '\\\\', DeclarationSpecifierSequence::class)
            ), 
            $sut->failureReason(NULL)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by create() and the constraint count is not equal to the 
     * declaration specifier count of the sequence.
     */
    public function testFailureReasonReturnsStringWhenCreateAndConstraintCountNotEqualDeclarationSpecifierCount(): void
    {
        $declSpecSeq = $this->createDeclarationSpecifierSequenceDoubleCount(0);
        
        $consts = [];
        $consts[] = $this->createDeclarationSpecifierConstraintDummy();
        $consts[] = $this->createDeclarationSpecifierConstraintDummy();
        $consts[] = $this->createDeclarationSpecifierConstraintDummy();
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
        self::assertSame(
            'Declaration specifier sequence: '.
            'declaration specifier sequence should have 3 declaration specifier(s), got 0.', 
            $sut->failureReason($declSpecSeq)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by create() and a declaration specifier is not valid.
     */
    public function testFailureReasonReturnsStringWhenCreateAndDeclarationSpecifierIsNotValid(): void
    {
        $declSpecs = [];
        $declSpecs[] = $this->createDeclarationSpecifierDummy();
        $declSpecs[] = $this->createDeclarationSpecifierDummy();
        $declSpecs[] = $this->createDeclarationSpecifierDummy();
        $declSpecSeq = $this->createDeclarationSpecifierSequenceDoubleCountGetDeclarationSpecifiers(
            3, 
            $declSpecs
        );
        
        $consts = [];
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleMatches($declSpecs[0], TRUE);
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleMatches($declSpecs[1], TRUE);
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleMatchesFailureReason(
            $declSpecs[2], 
            FALSE, 
            'foo reason.'
        );
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
        self::assertSame(
            "Declaration specifier sequence\n".
            "  foo reason.", 
            $sut->failureReason($declSpecSeq)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by create() and the declaration specifier sequence is valid.
     */
    public function testFailureReasonReturnsStringWhenCreateAndDeclarationSpecifierSequenceIsValid(): void
    {
        $declSpecs = [];
        $declSpecs[] = $this->createDeclarationSpecifierDummy();
        $declSpecs[] = $this->createDeclarationSpecifierDummy();
        $declSpecs[] = $this->createDeclarationSpecifierDummy();
        $declSpecSeq = $this->createDeclarationSpecifierSequenceDoubleCountGetDeclarationSpecifiers(
            3, 
            $declSpecs
        );
        
        $consts = [];
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleMatches($declSpecs[0], TRUE);
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleMatches($declSpecs[1], TRUE);
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleMatches($declSpecs[2], TRUE);
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
        self::assertSame(
            'Declaration specifier sequence: Unknown reason.', 
            $sut->failureReason($declSpecSeq)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by create() and not instance of 
     * DeclarationSpecifierSequence.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateAndNotInstanceDeclarationSpecifierSequence(): void
    {
        $consts = [];
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleConstraintDescription("foo\n  foo sub");
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleConstraintDescription("bar\n  bar sub");
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleConstraintDescription("baz\n  baz sub");
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
        self::assertRegExp(
            \sprintf(
                "`^\n".
                "Declaration specifier sequence \\(3\\)\n".
                "  foo\n".
                "    foo sub\n".
                "  bar\n".
                "    bar sub\n".
                "  baz\n".
                "    baz sub\n".
                "\n".
                "Declaration specifier sequence: null is not an instance of %s\\.$`", 
                \str_replace('\\', '\\\\', DeclarationSpecifierSequence::class)
            ), 
            $sut->additionalFailureDescription(NULL)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by create() and the constraint count is not equal 
     * to the declaration specifier count of the sequence.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateAndConstraintCountNotEqualDeclarationSpecifierCount(): void
    {
        $declSpecSeq = $this->createDeclarationSpecifierSequenceDoubleCount(0);
        
        $consts = [];
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleConstraintDescription("foo\n  foo sub");
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
        self::assertSame(
            "\n".
            "Declaration specifier sequence (1)\n".
            "  foo\n". 
            "    foo sub\n".
            "\n".
            "Declaration specifier sequence: ".
            "declaration specifier sequence should have 1 declaration specifier(s), got 0.", 
            $sut->additionalFailureDescription($declSpecSeq)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by create() and a declaration specifier is not 
     * valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateAndDeclarationSpecifierIsNotValid(): void
    {
        $declSpecs = [];
        $declSpecs[] = $this->createDeclarationSpecifierDummy();
        $declSpecSeq = $this->createDeclarationSpecifierSequenceDoubleCountGetDeclarationSpecifiers(
            1, 
            $declSpecs
        );
        
        $consts = [];
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleMatchesFailureReasonConstraintDescription(
            $declSpecs[0], 
            FALSE, 
            "foo reason", 
            'foo description'
        );
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
        self::assertSame(
            "\n".
            "Declaration specifier sequence (1)\n".
            "  foo description\n".
            "\n".
            "Declaration specifier sequence\n".
            "  foo reason", 
            $sut->additionalFailureDescription($declSpecSeq)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by create() and the declaration specifier sequence 
     * is valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateAndDeclarationSpecifierSequenceIsValid(): void
    {
        $declSpecs = [];
        $declSpecs[] = $this->createDeclarationSpecifierDummy();
        $declSpecSeq = $this->createDeclarationSpecifierSequenceDoubleCountGetDeclarationSpecifiers(
            1, 
            $declSpecs
        );
        
        $consts = [];
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleMatchesConstraintDescription(
            $declSpecs[0], 
            TRUE, 
            'foo description'
        );
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
        self::assertSame(
            "\n".
            "Declaration specifier sequence (1)\n".
            "  foo description\n".
            "\n".
            "Declaration specifier sequence: Unknown reason.",
            $sut->additionalFailureDescription($declSpecSeq)
        );
    }
    
    /**
     * Tests that failureDescription() is called when the instance is created 
     * by create() and a value is invalid.
     */
    public function testFailureDescriptionWhenCreateAndInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a declaration specifier sequence`');
        
        $consts = [];
        $consts[] = $this->createDeclarationSpecifierConstraintDoubleConstraintDescription(
            'foo description'
        );
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Creates a dummy of the {@see PhpCode\Language\Cpp\Declaration\DeclarationSpecifier} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    private function createDeclarationSpecifierDummy(): ProphecySubjectInterface
    {
        return $this->prophesize(DeclarationSpecifier::class)->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence} 
     * class where count() can be called.
     * 
     * @param   int $count  The value to return when count() is called.
     * @return  ProphecySubjectInterface
     */
    private function createDeclarationSpecifierSequenceDoubleCount(
        int $count
    ): ProphecySubjectInterface
    {
        $declSpecSeqProphecy = $this->prophesize(DeclarationSpecifierSequence::class);
        $declSpecSeqProphecy
            ->count()
            ->willReturn($count);
        
        return $declSpecSeqProphecy->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence} 
     * class where count() and getDeclarationSpecifiers() can be called.
     * 
     * @param   int                     $count      The value to return when count() is called.
     * @param   DeclarationSpecifier[]  $declSpecs  The value to return when getDeclarationSpecifiers() is called.
     * @return  ProphecySubjectInterface
     */
    private function createDeclarationSpecifierSequenceDoubleCountGetDeclarationSpecifiers(
        int $count, 
        array $declSpecs
    ): ProphecySubjectInterface
    {
        $declSpecSeqProphecy = $this->prophesize(DeclarationSpecifierSequence::class);
        $declSpecSeqProphecy
            ->count()
            ->willReturn($count);
        
        $declSpecSeqProphecy
            ->getDeclarationSpecifiers()
            ->willReturn($declSpecs);
        
        return $declSpecSeqProphecy->reveal();
    }
    
    /**
     * Creates a dummy of the {@see PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierConstraint} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    private function createDeclarationSpecifierConstraintDummy(): ProphecySubjectInterface
    {
        return $this->prophesize(DeclarationSpecifierConstraint::class)->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierConstraint} 
     * class where constraintDescription() can be called.
     * 
     * @param   string  $return The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    private function createDeclarationSpecifierConstraintDoubleConstraintDescription(
        string $return
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize(DeclarationSpecifierConstraint::class);
        $prophecy
            ->constraintDescription()
            ->willReturn($return);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierConstraint} 
     * class where matches() can be called.
     * 
     * @param   DeclarationSpecifier    $declSpec   The value of the first argument when matches() is called.
     * @param   bool                    $return     The value to return when matches() is called.
     * @return  ProphecySubjectInterface
     */
    private function createDeclarationSpecifierConstraintDoubleMatches(
        DeclarationSpecifier $declSpec, 
        bool $return
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize(DeclarationSpecifierConstraint::class);
        $prophecy
            ->matches($declSpec)
            ->willReturn($return);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierConstraint} 
     * class where matches() and failureReason() can be called.
     * 
     * @param   DeclarationSpecifier    $declSpec               The value of the first argument when matches() or failureReason() is called.
     * @param   bool                    $returnMatches          The value to return when matches() is called.
     * @param   string                  $returnFailureReason    The value to return when failureReason() is called.
     * @return  ProphecySubjectInterface
     */
    private function createDeclarationSpecifierConstraintDoubleMatchesFailureReason(
        DeclarationSpecifier $declSpec, 
        bool $returnMatches, 
        string $returnFailureReason
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize(DeclarationSpecifierConstraint::class);
        $prophecy
            ->matches($declSpec)
            ->willReturn($returnMatches);
        
        $prophecy
            ->failureReason($declSpec)
            ->willReturn($returnFailureReason);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierConstraint} 
     * class where matches() and constraintDescription() can be called.
     * 
     * @param   DeclarationSpecifier    $declSpec               The value of the first argument when matches() is called.
     * @param   bool                    $returnMatches          The value to return when matches() is called.
     * @param   string                  $returnConstraintDesc   The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    private function createDeclarationSpecifierConstraintDoubleMatchesConstraintDescription(
        DeclarationSpecifier $declSpec, 
        bool $returnMatches, 
        string $returnConstraintDesc
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize(DeclarationSpecifierConstraint::class);
        $prophecy
            ->matches($declSpec)
            ->willReturn($returnMatches);
        
        $prophecy
            ->constraintDescription()
            ->willReturn($returnConstraintDesc);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierConstraint} 
     * class where matches(), failureReason() and constraintDescription() 
     * can be called.
     * 
     * @param   DeclarationSpecifier    $declSpec               The value of the first argument when matches() or failureReason() is called.
     * @param   bool                    $returnMatches          The value to return when matches() is called.
     * @param   string                  $returnFailureReason    The value to return when failureReason() is called.
     * @param   string                  $returnConstraintDesc   The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    private function createDeclarationSpecifierConstraintDoubleMatchesFailureReasonConstraintDescription(
        DeclarationSpecifier $declSpec, 
        bool $returnMatches, 
        string $returnFailureReason, 
        string $returnConstraintDesc
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize(DeclarationSpecifierConstraint::class);
        $prophecy
            ->matches($declSpec)
            ->willReturn($returnMatches);
        
        $prophecy
            ->failureReason($declSpec)
            ->willReturn($returnFailureReason);
        
        $prophecy
            ->constraintDescription()
            ->willReturn($returnConstraintDesc);
        
        return $prophecy->reveal();
    }
}

