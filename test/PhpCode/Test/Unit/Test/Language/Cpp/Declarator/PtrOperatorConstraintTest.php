<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declarator;

use PhpCode\Exception\InvalidOperationException;
use PhpCode\Language\Cpp\Declarator\PtrOperator;
use PhpCode\Test\Language\Cpp\ConceptConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\PtrOperatorConstraint;
use PhpCode\Test\Language\Cpp\Declarator\PtrOperatorDoubleFactory;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Declarator\PtrOperatorConstraint} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrOperatorConstraintTest extends TestCase
{
    /**
     * Tests that __construct() throws an exception.
     */
    public function test__constructThrowsException(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        
        $sut = new PtrOperatorConstraint();
    }
    
    /**
     * Tests that createPointer() returns new instances of 
     * PtrOperatorConstraint.
     */
    public function testCreatePointerReturnsNewInstancePtrOperatorConstraint(): void
    {
        $const1 = PtrOperatorConstraint::createPointer();
        $const2 = PtrOperatorConstraint::createPointer();
        self::assertNotSame($const1, $const2);
    }
    
    /**
     * Tests that createLvalueReference() returns new instances of 
     * PtrOperatorConstraint.
     */
    public function testCreateLvalueReferenceReturnsNewInstancePtrOperatorConstraint(): void
    {
        $const1 = PtrOperatorConstraint::createLvalueReference();
        $const2 = PtrOperatorConstraint::createLvalueReference();
        self::assertNotSame($const1, $const2);
    }
    
    /**
     * Tests that createRvalueReference() returns new instances of 
     * PtrOperatorConstraint.
     */
    public function testCreateRvalueReferenceReturnsNewInstancePtrOperatorConstraint(): void
    {
        $const1 = PtrOperatorConstraint::createRvalueReference();
        $const2 = PtrOperatorConstraint::createRvalueReference();
        self::assertNotSame($const1, $const2);
    }
    
    /**
     * Tests that setCVQualifierSequenceConstraint() throws an exception when the 
     * instance is created by createLvalueReference().
     */
    public function testSetCVQualifierSequenceConstraintThrowsExceptionWhenCreateLvalueReference(): void
    {
        $sut = PtrOperatorConstraint::createLvalueReference();
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->getDouble();
        
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Lvalue reference cannot have a constant/volatile qualifier sequence constraint.');
        
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
    }
    
    /**
     * Tests that setCVQualifierSequenceConstraint() throws an exception when the 
     * instance is created by createRvalueReference().
     */
    public function testSetCVQualifierSequenceConstraintThrowsExceptionWhenCreateRvalueReference(): void
    {
        $sut = PtrOperatorConstraint::createRvalueReference();
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->getDouble();
        
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Rvalue reference cannot have a constant/volatile qualifier sequence constraint.');
        
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
    }
    
    /**
     * Tests that toString() returns a string when the instance is created by 
     * createPointer().
     */
    public function testToStringReturnsStringWhenCreatePointer(): void
    {
        $sut = PtrOperatorConstraint::createPointer();
        self::assertSame('pointer operator (pointer)', $sut->toString());
    }
    
    /**
     * Tests that toString() returns a string when the instance is created by 
     * createPointer() and a constant/volatile qualifier sequence constraint 
     * has been set.
     */
    public function testToStringReturnsStringWhenCreatePointerAndCVQualifierSequenceSet(): void
    {
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->getDouble();
        
        $sut = PtrOperatorConstraint::createPointer();
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame('pointer operator (pointer)', $sut->toString());
    }
    
    /**
     * Tests that toString() returns a string when the instance is created by 
     * createLvalueReference().
     */
    public function testToStringReturnsStringWhenCreateLvalueReference(): void
    {
        $sut = PtrOperatorConstraint::createLvalueReference();
        self::assertSame('pointer operator (lvalue reference)', $sut->toString());
    }
    
    /**
     * Tests that toString() returns a string when the instance is created by 
     * createRvalueReference().
     */
    public function testToStringReturnsStringWhenCreateRvalueReference(): void
    {
        $sut = PtrOperatorConstraint::createRvalueReference();
        self::assertSame('pointer operator (rvalue reference)', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string when the instance is 
     * created by createPointer().
     */
    public function testGetConceptNameReturnsStringWhenCreatePointer(): void
    {
        $sut = PtrOperatorConstraint::createPointer();
        self::assertSame('Pointer operator (pointer)', $sut->getConceptName());
    }
    
    /**
     * Tests that getConceptName() returns a string when the instance is 
     * created by createPointer() and a constant/volatile qualifier sequence 
     * constraint has been set.
     */
    public function testGetConceptNameReturnsStringWhenCreatePointerAndCVQualifierSequenceSet(): void
    {
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->getDouble();
        
        $sut = PtrOperatorConstraint::createPointer();
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame('Pointer operator (pointer)', $sut->getConceptName());
    }
    
    /**
     * Tests that getConceptName() returns a string when the instance is 
     * created by createLvalueReference().
     */
    public function testGetConceptNameReturnsStringWhenCreateLvalueReference(): void
    {
        $sut = PtrOperatorConstraint::createLvalueReference();
        self::assertSame('Pointer operator (lvalue reference)', $sut->getConceptName());
    }
    
    /**
     * Tests that getConceptName() returns a string when the instance is 
     * created by createRvalueReference().
     */
    public function testGetConceptNameReturnsStringWhenCreateRvalueReference(): void
    {
        $sut = PtrOperatorConstraint::createRvalueReference();
        self::assertSame('Pointer operator (rvalue reference)', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when the instance 
     * is created by createPointer().
     */
    public function testFailureDefaultReasonReturnsStringWhenCreatePointer(): void
    {
        $sut = PtrOperatorConstraint::createPointer();
        self::assertSame(
            'Pointer operator (pointer): Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when the instance 
     * is created by createPointer() and a constant/volatile qualifier 
     * sequence constraint has been set.
     */
    public function testFailureDefaultReasonReturnsStringWhenCreatePointerAndCVQualifierSequenceSet(): void
    {
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->getDouble();
        
        $sut = PtrOperatorConstraint::createPointer();
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame(
            'Pointer operator (pointer): Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when the instance 
     * is created by createLvalueReference().
     */
    public function testFailureDefaultReasonReturnsStringWhenCreateLvalueReference(): void
    {
        $sut = PtrOperatorConstraint::createLvalueReference();
        self::assertSame(
            'Pointer operator (lvalue reference): Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when the instance 
     * is created by createRvalueReference().
     */
    public function testFailureDefaultReasonReturnsStringWhenCreateRvalueReference(): void
    {
        $sut = PtrOperatorConstraint::createRvalueReference();
        self::assertSame(
            'Pointer operator (rvalue reference): Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createPointer().
     */
    public function testConstraintDescriptionReturnsStringWhenCreatePointer(): void
    {
        $sut = PtrOperatorConstraint::createPointer();
        self::assertSame('Pointer operator (pointer)', $sut->constraintDescription());
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createPointer() and a constant/volatile qualifier 
     * sequence constraint has been set.
     */
    public function testConstraintDescriptionReturnsStringWhenCreatePointerAndCVQualifierSequenceSet(): void
    {
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildConstraintDescription('constant/volatile qualifier sequence constraint description')
            ->getDouble();
        
        $sut = PtrOperatorConstraint::createPointer();
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame(
            "Pointer operator (pointer)\n".
            "  constant/volatile qualifier sequence constraint description", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createLvalueReference().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateLvalueReference(): void
    {
        $sut = PtrOperatorConstraint::createLvalueReference();
        self::assertSame('Pointer operator (lvalue reference)', $sut->constraintDescription());
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createRvalueReference().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateRvalueReference(): void
    {
        $sut = PtrOperatorConstraint::createRvalueReference();
        self::assertSame('Pointer operator (rvalue reference)', $sut->constraintDescription());
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createPointer() and not instance of PtrOperator.
     */
    public function testMatchesReturnsFalseWhenCreatePointerAndNotInstancePtrOperator(): void
    {
        $sut = PtrOperatorConstraint::createPointer();
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when:
     * - the instance is created by createPointer(), 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - not instance of PtrOperator.
     */
    public function testMatchesReturnsFalseWhenCreatePointerAndCVQualifierSequenceSetAndNotInstancePtrOperator(): void
    {
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->getDouble();
        
        $sut = PtrOperatorConstraint::createPointer();
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createLvalueReference() and not instance of PtrOperator.
     */
    public function testMatchesReturnsFalseWhenCreateLvalueReferenceAndNotInstancePtrOperator(): void
    {
        $sut = PtrOperatorConstraint::createLvalueReference();
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createRvalueReference() and not instance of PtrOperator.
     */
    public function testMatchesReturnsFalseWhenCreateRvalueReferenceAndNotInstancePtrOperator(): void
    {
        $sut = PtrOperatorConstraint::createRvalueReference();
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createPointer() and the pointer operator is not defined as a pointer.
     * 
     * @param   PtrOperator $ptrOp  The pointer operator to test.
     * 
     * @dataProvider    getNotPointerProvider
     */
    public function testMatchesReturnsFalseWhenCreatePointerAndNotPointer(
        PtrOperator $ptrOp
    ): void
    {
        $sut = PtrOperatorConstraint::createPointer();
        self::assertFalse($sut->matches($ptrOp));
    }
    
    /**
     * Tests that matches() returns FALSE when:
     * - the instance is created by createPointer(), 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - the pointer operator is not defined as a pointer.
     * 
     * @param   PtrOperator $ptrOp  The pointer operator to test.
     * 
     * @dataProvider    getNotPointerProvider
     */
    public function testMatchesReturnsFalseWhenCreatePointerAndCVQualifierSequenceSetAndNotPointer(
        PtrOperator $ptrOp
    ): void
    {
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->getDouble();
        
        $sut = PtrOperatorConstraint::createPointer();
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertFalse($sut->matches($ptrOp));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createLvalueReference() and the pointer operator is not defined as a 
     * lvalue reference.
     * 
     * @param   PtrOperator $ptrOp  The pointer operator to test.
     * 
     * @dataProvider    getNotLvalueProvider
     */
    public function testMatchesReturnsFalseWhenCreateLvalueReferenceAndNotLvalue(
        PtrOperator $ptrOp
    ): void
    {
        $sut = PtrOperatorConstraint::createLvalueReference();
        self::assertFalse($sut->matches($ptrOp));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createRvalueReference() and the pointer operator is not defined as a 
     * rvalue reference.
     * 
     * @param   PtrOperator $ptrOp  The pointer operator to test.
     * 
     * @dataProvider    getNotRvalueProvider
     */
    public function testMatchesReturnsFalseWhenCreateRvalueReferenceAndNotRvalue(
        PtrOperator $ptrOp
    ): void
    {
        $sut = PtrOperatorConstraint::createRvalueReference();
        self::assertFalse($sut->matches($ptrOp));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createPointer() and the pointer operator has a constant/volatile 
     * qualifier sequence.
     */
    public function testMatchesReturnsFalseWhenCreatePointerAndHasCVQualifierSequence(): void
    {
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->getDouble();
        $ptrOp = $this->createPtrOperatorDoubleFactory()->createPointer($cvSeq);
        
        $sut = PtrOperatorConstraint::createPointer();
        self::assertFalse($sut->matches($ptrOp));
    }
    
    /**
     * Tests that matches() returns FALSE when:
     * - the instance is created by createPointer(), 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - the pointer operator has no constant/volatile qualifier sequence.
     */
    public function testMatchesReturnsFalseWhenCreatePointerAndCVQualifierSequenceSetAndHasNoCVQualifierSequence(): void
    {
        $ptrOp = $this->createPtrOperatorDoubleFactory()->createPointer();
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildMatches(NULL, FALSE)
            ->getDouble();
        
        $sut = PtrOperatorConstraint::createPointer();
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertFalse($sut->matches($ptrOp));
    }
    
    /**
     * Tests that matches() returns FALSE when:
     * - the instance is created by createPointer(), 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - the pointer operator has a constant/volatile qualifier sequence that 
     * is invalid.
     */
    public function testMatchesReturnsFalseWhenCreatePointerAndCVQualifierSequenceSetAndCVQualifierSequenceIsInvalid(): void
    {
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->getDouble();
        $ptrOp = $this->createPtrOperatorDoubleFactory()->createPointer($cvSeq);
        
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildMatches($cvSeq, FALSE)
            ->getDouble();
        
        $sut = PtrOperatorConstraint::createPointer();
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertFalse($sut->matches($ptrOp));
    }
    
    /**
     * Tests that matches() returns TRUE when:
     * - the instance is created by createPointer(), 
     * - the pointer operator is defined as a pointer, and 
     * - the pointer operator has no constant/volatile qualifier sequence.
     */
    public function testMatchesReturnsTrueWhenCreatePointerAndPointerAndHasNoCVQualifierSequence(): void
    {
        $ptrOp = $this->createPtrOperatorDoubleFactory()->createPointer();
        
        $sut = PtrOperatorConstraint::createPointer();
        self::assertTrue($sut->matches($ptrOp));
    }
    
    /**
     * Tests that matches() returns TRUE when:
     * - the instance is created by createPointer(), 
     * - a constant/volatile qualifier sequence constraint has been set,  
     * - the pointer operator is defined as a pointer, 
     * - the pointer operator has a constant/volatile qualifier sequence that 
     * is valid.
     */
    public function testMatchesReturnsTrueWhenCreatePointerAndCVQualifierSequenceSetAndCVQualifierSequenceIsValid(): void
    {
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->getDouble();
        $ptrOp = $this->createPtrOperatorDoubleFactory()->createPointer($cvSeq);
        
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildMatches($cvSeq, TRUE)
            ->getDouble();
        
        $sut = PtrOperatorConstraint::createPointer();
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertTrue($sut->matches($ptrOp));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createLvalueReference() and the pointer operator is defined as a 
     * lvalue reference.
     */
    public function testMatchesReturnsTrueWhenCreateLvalueReferenceAndLvalue(): void
    {
        $ptrOp = $this->createPtrOperatorDoubleFactory()->createLvalue();
        
        $sut = PtrOperatorConstraint::createLvalueReference();
        self::assertTrue($sut->matches($ptrOp));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createRvalueReference() and the pointer operator is defined as a 
     * rvalue reference.
     */
    public function testMatchesReturnsTrueWhenCreateRvalueReferenceAndRvalue(): void
    {
        $ptrOp = $this->createPtrOperatorDoubleFactory()->createRvalue();
        
        $sut = PtrOperatorConstraint::createRvalueReference();
        self::assertTrue($sut->matches($ptrOp));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createPointer() and not instance of PtrOperator.
     */
    public function testFailureReasonReturnsStringWhenCreatePointerAndNotInstancePtrOperator(): void
    {
        $sut = PtrOperatorConstraint::createPointer();
        $pattern = \sprintf(
            '`^Pointer operator \\(pointer\\): .+ is not an instance of %s\\.$`', 
            \str_replace('\\', '\\\\', PtrOperator::class)
        );
        self::assertRegExp($pattern, $sut->failureReason(NULL));
    }
    
    /**
     * Tests that failureReason() returns a string when:
     * - the instance is created by createPointer(), 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - not instance of PtrOperator.
     */
    public function testFailureReasonReturnsStringWhenCreatePointerAndCVQualifierSequenceSetAndNotInstancePtrOperator(): void
    {
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->getDouble();
        
        $sut = PtrOperatorConstraint::createPointer();
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        $pattern = \sprintf(
            '`^Pointer operator \\(pointer\\): .+ is not an instance of %s\\.$`', 
            \str_replace('\\', '\\\\', PtrOperator::class)
        );
        self::assertRegExp($pattern, $sut->failureReason(NULL));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createLvalueReference() and not instance of PtrOperator.
     */
    public function testFailureReasonReturnsStringWhenCreateLvalueReferenceAndNotInstancePtrOperator(): void
    {
        $sut = PtrOperatorConstraint::createLvalueReference();
        $pattern = \sprintf(
            '`^Pointer operator \\(lvalue reference\\): .+ is not an instance of %s\\.$`', 
            \str_replace('\\', '\\\\', PtrOperator::class)
        );
        self::assertRegExp($pattern, $sut->failureReason(NULL));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createRvalueReference() and not instance of PtrOperator.
     */
    public function testFailureReasonReturnsStringWhenCreateRvalueReferenceAndNotInstancePtrOperator(): void
    {
        $sut = PtrOperatorConstraint::createRvalueReference();
        $pattern = \sprintf(
            '`^Pointer operator \\(rvalue reference\\): .+ is not an instance of %s\\.$`', 
            \str_replace('\\', '\\\\', PtrOperator::class)
        );
        self::assertRegExp($pattern, $sut->failureReason(NULL));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createPointer() and the pointer operator is not defined as 
     * a pointer.
     * 
     * @param   PtrOperator $ptrOp  The pointer operator to test.
     * 
     * @dataProvider    getNotPointerProvider
     */
    public function testFailureReasonReturnsStringWhenCreatePointerAndNotPointer(
        PtrOperator $ptrOp
    ): void
    {
        $sut = PtrOperatorConstraint::createPointer();
        self::assertSame(
            'Pointer operator (pointer): It should be pointer.', 
            $sut->failureReason($ptrOp)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when:
     * - the instance is created by createPointer(), 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - the pointer operator is not defined as a pointer.
     * 
     * @param   PtrOperator $ptrOp  The pointer operator to test.
     * 
     * @dataProvider    getNotPointerProvider
     */
    public function testFailureReasonReturnsStringWhenCreatePointerAndCVQualifierSequenceSetAndNotPointer(
        PtrOperator $ptrOp
    ): void
    {
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->getDouble();
        
        $sut = PtrOperatorConstraint::createPointer();
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame(
            'Pointer operator (pointer): It should be pointer.', 
            $sut->failureReason($ptrOp)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createLvalueReference() and the pointer operator is not 
     * defined as a lvalue reference.
     * 
     * @param   PtrOperator $ptrOp  The pointer operator to test.
     * 
     * @dataProvider    getNotLvalueProvider
     */
    public function testFailureReasonReturnsStringWhenCreateLvalueReferenceAndNotLvalue(
        PtrOperator $ptrOp
    ): void
    {
        $sut = PtrOperatorConstraint::createLvalueReference();
        self::assertSame(
            'Pointer operator (lvalue reference): It should be lvalue reference.', 
            $sut->failureReason($ptrOp)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createRvalueReference() and the pointer operator is not 
     * defined as a rvalue reference.
     * 
     * @param   PtrOperator $ptrOp  The pointer operator to test.
     * 
     * @dataProvider    getNotRvalueProvider
     */
    public function testFailureReasonReturnsStringWhenCreateRvalueReferenceAndNotRvalue(
        PtrOperator $ptrOp
    ): void
    {
        $sut = PtrOperatorConstraint::createRvalueReference();
        self::assertSame(
            'Pointer operator (rvalue reference): It should be rvalue reference.', 
            $sut->failureReason($ptrOp)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is created by 
     * createPointer() and the pointer operator has a constant/volatile 
     * qualifier sequence.
     */
    public function testFailureReasonReturnsStringWhenCreatePointerAndHasCVQualifierSequence(): void
    {
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->getDouble();
        $ptrOp = $this->createPtrOperatorDoubleFactory()->createPointer($cvSeq);
        
        $sut = PtrOperatorConstraint::createPointer();
        self::assertSame(
            'Pointer operator (pointer): constant/volatile qualifier sequence present whereas it should be absent.', 
            $sut->failureReason($ptrOp)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when:
     * - the instance is created by createPointer(), 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - the pointer operator has no constant/volatile qualifier sequence.
     */
    public function testFailureReasonReturnsStringWhenCreatePointerAndCVQualifierSequenceSetAndHasNoCVQualifierSequence(): void
    {
        $ptrOp = $this->createPtrOperatorDoubleFactory()->createPointer();
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildMatches(NULL, FALSE)
            ->getDouble();
        
        $sut = PtrOperatorConstraint::createPointer();
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame(
            'Pointer operator (pointer): constant/volatile qualifier sequence absent whereas it should be present.', 
            $sut->failureReason($ptrOp)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when:
     * - the instance is created by createPointer(), 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - the pointer operator has a constant/volatile qualifier sequence that 
     * is invalid.
     */
    public function testFailureReasonReturnsStringWhenCreatePointerAndCVQualifierSequenceSetAndCVQualifierSequenceIsInvalid(): void
    {
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->getDouble();
        $ptrOp = $this->createPtrOperatorDoubleFactory()->createPointer($cvSeq);
        
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildMatches($cvSeq, FALSE)
            ->buildFailureReason($cvSeq, 'constant/volatile qualifier sequence reason')
            ->getDouble();
        
        $sut = PtrOperatorConstraint::createPointer();
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame(
            "Pointer operator (pointer)\n".
            "  constant/volatile qualifier sequence reason", 
            $sut->failureReason($ptrOp)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when:
     * - the instance is created by createPointer(), 
     * - the pointer operator is defined as a pointer, and 
     * - the pointer operator has no constant/volatile qualifier sequence.
     */
    public function testFailureReasonReturnsStringWhenCreatePointerAndPointerAndHasNoCVQualifierSequence(): void
    {
        $ptrOp = $this->createPtrOperatorDoubleFactory()->createPointer();
        
        $sut = PtrOperatorConstraint::createPointer();
        self::assertSame(
            'Pointer operator (pointer): Unknown reason.', 
            $sut->failureReason($ptrOp)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when:
     * - the instance is created by createPointer(), 
     * - a constant/volatile qualifier sequence constraint has been set,  
     * - the pointer operator is defined as a pointer, 
     * - the pointer operator has a constant/volatile qualifier sequence that 
     * is valid.
     */
    public function testFailureReasonReturnsStringWhenCreatePointerAndCVQualifierSequenceSetAndCVQualifierSequenceIsValid(): void
    {
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->getDouble();
        $ptrOp = $this->createPtrOperatorDoubleFactory()->createPointer($cvSeq);
        
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildMatches($cvSeq, TRUE)
            ->getDouble();
        
        $sut = PtrOperatorConstraint::createPointer();
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame(
            'Pointer operator (pointer): Unknown reason.', 
            $sut->failureReason($ptrOp)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createLvalueReference() and the pointer operator is defined 
     * as a lvalue reference.
     */
    public function testFailureReasonReturnsStringWhenCreateLvalueReferenceAndLvalue(): void
    {
        $ptrOp = $this->createPtrOperatorDoubleFactory()->createLvalue();
        
        $sut = PtrOperatorConstraint::createLvalueReference();
        self::assertSame(
            'Pointer operator (lvalue reference): Unknown reason.', 
            $sut->failureReason($ptrOp)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createRvalueReference() and the pointer operator is defined 
     * as a rvalue reference.
     */
    public function testFailureReasonReturnsStringWhenCreateRvalueReferenceAndRvalue(): void
    {
        $ptrOp = $this->createPtrOperatorDoubleFactory()->createRvalue();
        
        $sut = PtrOperatorConstraint::createRvalueReference();
        self::assertSame(
            'Pointer operator (rvalue reference): Unknown reason.', 
            $sut->failureReason($ptrOp)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by createPointer().
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenCreatePointer(): void
    {
        $sut = PtrOperatorConstraint::createPointer();
        $pattern = \sprintf(
            "`^\n".
            "Pointer operator \\(pointer\\)\n".
            "\n".
            "Pointer operator \\(pointer\\): .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', PtrOperator::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when:
     * - the instance is created by createPointer(), 
     * - a constant/volatile qualifier sequence constraint has been set.
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenCreatePointerAndCVQualifierSequenceSet(): void
    {
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildConstraintDescription('constant/volatile qualifier sequence constraint description')
            ->getDouble();
        
        $sut = PtrOperatorConstraint::createPointer();
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        $pattern = \sprintf(
            "`^\n".
            "Pointer operator \\(pointer\\)\n".
            "  constant/volatile qualifier sequence constraint description\n".
            "\n".
            "Pointer operator \\(pointer\\): .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', PtrOperator::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by createLvalueReference().
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenCreateLvalueReference(): void
    {
        $sut = PtrOperatorConstraint::createLvalueReference();
        $pattern = \sprintf(
            "`^\n".
            "Pointer operator \\(lvalue reference\\)\n".
            "\n".
            "Pointer operator \\(lvalue reference\\): .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', PtrOperator::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by createRvalueReference().
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenCreateRvalueReference(): void
    {
        $sut = PtrOperatorConstraint::createRvalueReference();
        $pattern = \sprintf(
            "`^\n".
            "Pointer operator \\(rvalue reference\\)\n".
            "\n".
            "Pointer operator \\(rvalue reference\\): .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', PtrOperator::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that failureDescription() is called when the instance has been 
     * created by createPointer() and the value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenCreatePointerAndValueIsInvalid(): void
    {
        $sut = PtrOperatorConstraint::createPointer();
        
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a pointer operator \\(pointer\\)`');
        
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Tests that failureDescription() is called when:
     * - the instance is created by createPointer(), 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - the value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenCreatePointerAndCVQualifierSequenceSetAndValueIsInvalid(): void
    {
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildConstraintDescription('constant/volatile qualifier sequence constraint description')
            ->getDouble();
        
        $sut = PtrOperatorConstraint::createPointer();
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a pointer operator \\(pointer\\)`');
        
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Tests that failureDescription() is called when the instance is created 
     * by createLvalueReference() and the value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenCreateLvalueReferenceAndValueIsInvalid(): void
    {
        $sut = PtrOperatorConstraint::createLvalueReference();
        
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a pointer operator \\(lvalue reference\\)`');
        
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Tests that failureDescription() is called when the instance is created 
     * by createRvalueReference() and the value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenCreateRvalueReferenceAndValueIsInvalid(): void
    {
        $sut = PtrOperatorConstraint::createRvalueReference();
        
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a pointer operator \\(rvalue reference\\)`');
        
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Returns a set of pointer operators that are not defined as a pointer.
     * 
     * @return  array[]
     */
    public function getNotPointerProvider(): array
    {
        $dataSet = [];
        
        $ptrOpFactory = $this->createPtrOperatorDoubleFactory();
        
        // Lvalue reference.
        $dataSet['Lvalue reference'] = [
            $ptrOpFactory->createLvalue(), 
        ];
        
        // Rvalue reference.
        $dataSet['Rvalue reference'] = [
            $ptrOpFactory->createRvalue(), 
        ];
        
        return $dataSet;
    }
    
    /**
     * Returns a set of pointer operators that are not defined as a lvalue 
     * reference.
     * 
     * @return  array[]
     */
    public function getNotLvalueProvider(): array
    {
        $dataSet = [];
        
        $ptrOpFactory = $this->createPtrOperatorDoubleFactory();
        
        // Pointer.
        $dataSet['Pointer'] = [
            $ptrOpFactory->createPointer(), 
        ];
        
        // Pointer with constant/volatile qualifier sequence.
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->getDouble();
        $dataSet['Pointer with constant/volatile qualifier sequence'] = [
            $ptrOpFactory->createPointer($cvSeq), 
        ];
        
        // Rvalue reference.
        $dataSet['Rvalue reference'] = [
            $ptrOpFactory->createRvalue(), 
        ];
        
        return $dataSet;
    }
    
    /**
     * Returns a set of pointer operators that are not defined as a rvalue 
     * reference.
     * 
     * @return  array[]
     */
    public function getNotRvalueProvider(): array
    {
        $dataSet = [];
        
        $ptrOpFactory = $this->createPtrOperatorDoubleFactory();
        
        // Pointer.
        $dataSet['Pointer'] = [
            $ptrOpFactory->createPointer(), 
        ];
        
        // Pointer with constant/volatile qualifier sequence.
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->getDouble();
        $dataSet['Pointer with constant/volatile qualifier sequence'] = [
            $ptrOpFactory->createPointer($cvSeq), 
        ];
        
        // Lvalue reference.
        $dataSet['Lvalue reference'] = [
            $ptrOpFactory->createLvalue(), 
        ];
        
        return $dataSet;
    }
    
    /**
     * Creates a factory of pointer operator doubles.
     * 
     * @return  PtrOperatorDoubleFactory
     */
    private function createPtrOperatorDoubleFactory(): PtrOperatorDoubleFactory
    {
        return new PtrOperatorDoubleFactory($this);
    }
}

