<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declarator;

use PhpCode\Exception\ArgumentException;
use PhpCode\Language\Cpp\Declarator\PtrOperatorSequence;
use PhpCode\Test\Language\Cpp\ConceptConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\PtrOperatorConstraint;
use PhpCode\Test\Language\Cpp\Declarator\PtrOperatorSequenceConstraint;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Declarator\PtrOperatorSequenceConstraint} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrOperatorSequenceConstraintTest extends TestCase
{
    /**
     * Tests that __construct() throws an exception when constraints are empty.
     */
    public function test__constructThrowsExceptionWhenConstraintsEmpty(): void
    {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('The pointer operator constraints are empty.');
        
        $sut = new PtrOperatorSequenceConstraint([]);
    }
    
    /**
     * Tests that __construct() throws an exception when one of the 
     * constraints is not an instance of PtrOperatorConstraint.
     */
    public function test__constructThrowsExeptionWhenOneOfContraintIsNotInstancePtrOperatorConstraint(): void
    {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage(\sprintf(
            'The constraint must be an instance of %s.', 
            PtrOperatorConstraint::class
        ));
        
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->getDouble();
        $consts[] = NULL;
        
        $sut = new PtrOperatorSequenceConstraint($consts);
    }
    
    /**
     * Tests that toString() returns a string.
     */
    public function testToStringReturnsString(): void
    {
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->getDouble();
        
        $sut = new PtrOperatorSequenceConstraint($consts);
        self::assertSame('pointer operator sequence', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string.
     */
    public function testGetConceptNameReturnsString(): void
    {
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->getDouble();
        
        $sut = new PtrOperatorSequenceConstraint($consts);
        self::assertSame('Pointer operator sequence', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string.
     */
    public function testFailureDefaultReasonReturnsString(): void
    {
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->getDouble();
        
        $sut = new PtrOperatorSequenceConstraint($consts);
        self::assertSame(
            'Pointer operator sequence: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string.
     */
    public function testConstraintDescriptionReturnsString(): void
    {
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->buildConstraintDescription('foo')
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->buildConstraintDescription('bar')
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->buildConstraintDescription('baz')
            ->getDouble();
        
        $sut = new PtrOperatorSequenceConstraint($consts);
        self::assertSame(
            "Pointer operator sequence (3)\n".
            "  foo\n".
            "  bar\n".
            "  baz", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when not instance of 
     * PtrOperatorSequence.
     */
    public function testMatchesReturnsFalseWhenNotInstancePtrOperatorSequence(): void
    {
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->getDouble();
        
        $sut = new PtrOperatorSequenceConstraint($consts);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the constraint count is not 
     * equal to the pointer operator count of the sequence.
     */
    public function testMatchesReturnsFalseWhenConstraintCountNotEqualPtrOperatorCount(): void
    {
        $ptrOpSeq = ConceptDoubleBuilder::createPtrOperatorSequence($this)
            ->buildCount(0)
            ->getDouble();
        
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->getDouble();
        
        $sut = new PtrOperatorSequenceConstraint($consts);
        self::assertFalse($sut->matches($ptrOpSeq));
    }
    
    /**
     * Tests that matches() returns FALSE when a pointer operator is invalid.
     */
    public function testMatchesReturnsFalseWhenPtrOperatorIsInvalid(): void
    {
        $ptrOps = [];
        $ptrOps[] = ConceptDoubleBuilder::createPtrOperator($this)->getDouble();
        $ptrOps[] = ConceptDoubleBuilder::createPtrOperator($this)->getDouble();
        $ptrOps[] = ConceptDoubleBuilder::createPtrOperator($this)->getDouble();
        $ptrOpSeq = ConceptDoubleBuilder::createPtrOperatorSequence($this)
            ->buildCount(3)
            ->buildGetPtrOperators($ptrOps)
            ->getDouble();
        
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->buildMatches($ptrOps[0], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->buildMatches($ptrOps[1], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->buildMatches($ptrOps[2], FALSE)
            ->getDouble();
        
        $sut = new PtrOperatorSequenceConstraint($consts);
        self::assertFalse($sut->matches($ptrOpSeq));
    }
    
    /**
     * Tests that matches() returns TRUE when all the pointer operators are 
     * valid.
     */
    public function testMatchesReturnsTrueWhenPtrOperatorsAreValid(): void
    {
        $ptrOps = [];
        $ptrOps[] = ConceptDoubleBuilder::createPtrOperator($this)->getDouble();
        $ptrOps[] = ConceptDoubleBuilder::createPtrOperator($this)->getDouble();
        $ptrOps[] = ConceptDoubleBuilder::createPtrOperator($this)->getDouble();
        $ptrOpSeq = ConceptDoubleBuilder::createPtrOperatorSequence($this)
            ->buildCount(3)
            ->buildGetPtrOperators($ptrOps)
            ->getDouble();
        
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->buildMatches($ptrOps[0], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->buildMatches($ptrOps[1], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->buildMatches($ptrOps[2], TRUE)
            ->getDouble();
        
        $sut = new PtrOperatorSequenceConstraint($consts);
        self::assertTrue($sut->matches($ptrOpSeq));
    }
    
    /**
     * Tests that failureReason() returns a string when not instance of 
     * PtrOperatorSequence.
     */
    public function testFailureReasonReturnsStringWhenNotInstancePtrOperatorSequence(): void
    {
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->getDouble();
        
        $sut = new PtrOperatorSequenceConstraint($consts);
        $pattern = \sprintf(
            '`^Pointer operator sequence: .+ is not an instance of %s\\.$`', 
            \str_replace('\\', '\\\\', PtrOperatorSequence::class)
        );
        self::assertRegExp($pattern, $sut->failureReason(NULL));
    }
    
    /**
     * Tests that failureReason() returns a string when the constraint count 
     * is not equal to the pointer operator count of the sequence.
     */
    public function testFailureReasonReturnsStringWhenConstraintCountNotEqualPtrOperatorCount(): void
    {
        $ptrOpSeq = ConceptDoubleBuilder::createPtrOperatorSequence($this)
            ->buildCount(0)
            ->getDouble();
        
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->getDouble();
        
        $sut = new PtrOperatorSequenceConstraint($consts);
        self::assertSame(
            'Pointer operator sequence: pointer operator sequence should have 3 pointer operator(s), got 0.', 
            $sut->failureReason($ptrOpSeq)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when a pointer operator is 
     * invalid.
     */
    public function testFailureReasonReturnsStringWhenPtrOperatorIsInvalid(): void
    {
        $ptrOps = [];
        $ptrOps[] = ConceptDoubleBuilder::createPtrOperator($this)->getDouble();
        $ptrOps[] = ConceptDoubleBuilder::createPtrOperator($this)->getDouble();
        $ptrOps[] = ConceptDoubleBuilder::createPtrOperator($this)->getDouble();
        $ptrOpSeq = ConceptDoubleBuilder::createPtrOperatorSequence($this)
            ->buildCount(3)
            ->buildGetPtrOperators($ptrOps)
            ->getDouble();
        
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->buildMatches($ptrOps[0], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->buildMatches($ptrOps[1], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->buildMatches($ptrOps[2], FALSE)
            ->buildFailureReason($ptrOps[2], 'pointer operator reason')
            ->getDouble();
        
        $sut = new PtrOperatorSequenceConstraint($consts);
        self::assertSame(
            "Pointer operator sequence\n".
            "  pointer operator reason", 
            $sut->failureReason($ptrOpSeq)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when all the pointer 
     * operators are valid.
     */
    public function testFailureReasonReturnsStringWhenPtrOperatorsAreValid(): void
    {
        $ptrOps = [];
        $ptrOps[] = ConceptDoubleBuilder::createPtrOperator($this)->getDouble();
        $ptrOps[] = ConceptDoubleBuilder::createPtrOperator($this)->getDouble();
        $ptrOps[] = ConceptDoubleBuilder::createPtrOperator($this)->getDouble();
        $ptrOpSeq = ConceptDoubleBuilder::createPtrOperatorSequence($this)
            ->buildCount(3)
            ->buildGetPtrOperators($ptrOps)
            ->getDouble();
        
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->buildMatches($ptrOps[0], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->buildMatches($ptrOps[1], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->buildMatches($ptrOps[2], TRUE)
            ->getDouble();
        
        $sut = new PtrOperatorSequenceConstraint($consts);
        self::assertSame(
            'Pointer operator sequence: Unknown reason.', 
            $sut->failureReason($ptrOpSeq)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure.
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReason(): void
    {
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->buildConstraintDescription('foo')
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->buildConstraintDescription('bar')
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->buildConstraintDescription('baz')
            ->getDouble();
        
        $sut = new PtrOperatorSequenceConstraint($consts);
        $pattern = \sprintf(
            "`^\n".
            "Pointer operator sequence \\(3\\)\n".
            "  foo\n".
            "  bar\n".
            "  baz\n".
            "\n".
            "Pointer operator sequence: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', PtrOperatorSequence::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that failureDescription() is called when the value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenValueIsInvalid(): void
    {
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createPtrOperatorConstraint($this)
            ->buildConstraintDescription('foo')
            ->getDouble();
        
        $sut = new PtrOperatorSequenceConstraint($consts);
        
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a pointer operator sequence`');
        
        $sut->evaluate(NULL, '', FALSE);
    }
}

