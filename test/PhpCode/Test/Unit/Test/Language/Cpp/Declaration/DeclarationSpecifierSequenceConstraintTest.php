<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declaration;

use PhpCode\Exception\ArgumentException;
use PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierConstraint;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierConstraintDoubleFactory;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierDoubleFactory;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierSequenceConstraint;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierSequenceDoubleFactory;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

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
     * @var DeclarationSpecifierDoubleFactory
     */
    private $declSpecFactory;
    
    /**
     * @var DeclarationSpecifierSequenceDoubleFactory
     */
    private $declSpecSeqFactory;
    
    /**
     * @var DeclarationSpecifierConstraintDoubleFactory
     */
    private $declSpecConstFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->declSpecFactory = new DeclarationSpecifierDoubleFactory($this);
        $this->declSpecSeqFactory = new DeclarationSpecifierSequenceDoubleFactory($this);
        $this->declSpecConstFactory = new DeclarationSpecifierConstraintDoubleFactory($this);
    }
    
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
        $consts[] = $this->declSpecConstFactory->createDummy();
        $consts[] = $this->declSpecConstFactory->createDummy();
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
        $consts[] = $this->declSpecConstFactory->createDummy();
        
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
        $consts[] = $this->declSpecConstFactory->createDummy();
        
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
        $consts[] = $this->declSpecConstFactory->createDummy();
        
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
        $consts[] = $this->declSpecConstFactory->createConstraintDescription('foo');
        $consts[] = $this->declSpecConstFactory->createConstraintDescription('bar');
        $consts[] = $this->declSpecConstFactory->createConstraintDescription('baz');
        
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
        $consts[] = $this->declSpecConstFactory->createDummy();
        
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
        $declSpecSeq = $this->declSpecSeqFactory->createCount(0);
        
        $consts = [];
        $consts[] = $this->declSpecConstFactory->createDummy();
        $consts[] = $this->declSpecConstFactory->createDummy();
        $consts[] = $this->declSpecConstFactory->createDummy();
        
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
        $declSpecs[] = $this->declSpecFactory->createDummy();
        $declSpecs[] = $this->declSpecFactory->createDummy();
        $declSpecs[] = $this->declSpecFactory->createDummy();
        $declSpecSeq = $this->declSpecSeqFactory->createCountGetDeclarationSpecifiers(3, $declSpecs);
        
        $consts = [];
        $consts[] = $this->declSpecConstFactory->createMatches($declSpecs[0], TRUE);
        $consts[] = $this->declSpecConstFactory->createMatches($declSpecs[1], TRUE);
        $consts[] = $this->declSpecConstFactory->createMatches($declSpecs[2], FALSE);
        
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
        $declSpecs[] = $this->declSpecFactory->createDummy();
        $declSpecs[] = $this->declSpecFactory->createDummy();
        $declSpecs[] = $this->declSpecFactory->createDummy();
        $declSpecSeq = $this->declSpecSeqFactory->createCountGetDeclarationSpecifiers(3, $declSpecs);
        
        $consts = [];
        $consts[] = $this->declSpecConstFactory->createMatches($declSpecs[0], TRUE);
        $consts[] = $this->declSpecConstFactory->createMatches($declSpecs[1], TRUE);
        $consts[] = $this->declSpecConstFactory->createMatches($declSpecs[2], TRUE);
        
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
        $consts[] = $this->declSpecConstFactory->createDummy();
        
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
        $declSpecSeq = $this->declSpecSeqFactory->createCount(0);
        
        $consts = [];
        $consts[] = $this->declSpecConstFactory->createDummy();
        $consts[] = $this->declSpecConstFactory->createDummy();
        $consts[] = $this->declSpecConstFactory->createDummy();
        
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
        $declSpecs[] = $this->declSpecFactory->createDummy();
        $declSpecs[] = $this->declSpecFactory->createDummy();
        $declSpecs[] = $this->declSpecFactory->createDummy();
        $declSpecSeq = $this->declSpecSeqFactory->createCountGetDeclarationSpecifiers(3, $declSpecs);
        
        $consts = [];
        $consts[] = $this->declSpecConstFactory->createMatches($declSpecs[0], TRUE);
        $consts[] = $this->declSpecConstFactory->createMatches($declSpecs[1], TRUE);
        $consts[] = $this->declSpecConstFactory->createMatchesFailureReason(
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
        $declSpecs[] = $this->declSpecFactory->createDummy();
        $declSpecs[] = $this->declSpecFactory->createDummy();
        $declSpecs[] = $this->declSpecFactory->createDummy();
        $declSpecSeq = $this->declSpecSeqFactory->createCountGetDeclarationSpecifiers(3, $declSpecs);
        
        $consts = [];
        $consts[] = $this->declSpecConstFactory->createMatches($declSpecs[0], TRUE);
        $consts[] = $this->declSpecConstFactory->createMatches($declSpecs[1], TRUE);
        $consts[] = $this->declSpecConstFactory->createMatches($declSpecs[2], TRUE);
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
        self::assertSame(
            'Declaration specifier sequence: Unknown reason.', 
            $sut->failureReason($declSpecSeq)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by create().
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenCreate(): void
    {
        $consts = [];
        $consts[] = $this->declSpecConstFactory->createConstraintDescription("foo\n  foo sub");
        $consts[] = $this->declSpecConstFactory->createConstraintDescription("bar\n  bar sub");
        $consts[] = $this->declSpecConstFactory->createConstraintDescription("baz\n  baz sub");
        
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
     * Tests that failureDescription() is called when the instance is created 
     * by create() and a value is invalid.
     */
    public function testFailureDescriptionWhenCreateAndInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a declaration specifier sequence`');
        
        $consts = [];
        $consts[] = $this->declSpecConstFactory->createConstraintDescription('foo description');
        
        $sut = DeclarationSpecifierSequenceConstraint::create($consts);
        $sut->evaluate(NULL, '', FALSE);
    }
}

