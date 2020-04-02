<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\PtrAbstractDeclarator;
use PhpCode\Test\Language\Cpp\ConceptConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\PtrAbstractDeclaratorConstraint;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Declarator\PtrAbstractDeclaratorConstraint} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrAbstractDeclaratorConstraintTest extends TestCase
{
    /**
     * Tests that toString() returns a string when instantiated.
     */
    public function testToStringReturnsStringWhenInstantiated(): void
    {
        $sut = new PtrAbstractDeclaratorConstraint();
        self::assertSame('pointer abstract declarator', $sut->toString());
    }
    
    /**
     * Tests that toString() returns a string when instantiated and a pointer 
     * operator sequence constraint has been set.
     */
    public function testToStringReturnsStringWhenInstantiatedAndPtrOperatorSequenceConstraintIsSet(): void
    {
        $ptrOpSeqConst = ConceptConstraintDoubleBuilder::createPtrOperatorSequenceConstraint($this)
            ->getDouble();
        
        $sut = new PtrAbstractDeclaratorConstraint();
        $sut->setPtrOperatorSequenceConstraint($ptrOpSeqConst);
        self::assertSame('pointer abstract declarator', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string when instantiated.
     */
    public function testGetConceptNameReturnsStringWhenInstantiated(): void
    {
        $sut = new PtrAbstractDeclaratorConstraint();
        self::assertSame('Pointer abstract declarator', $sut->getConceptName());
    }
    
    /**
     * Tests that getConceptName() returns a string when instantiated and a 
     * pointer operator sequence constraint has been set.
     */
    public function testGetConceptNameReturnsStringWhenInstantiatedAndPtrOperatorSequenceConstraintIsSet(): void
    {
        $ptrOpSeqConst = ConceptConstraintDoubleBuilder::createPtrOperatorSequenceConstraint($this)
            ->getDouble();
        
        $sut = new PtrAbstractDeclaratorConstraint();
        $sut->setPtrOperatorSequenceConstraint($ptrOpSeqConst);
        self::assertSame('Pointer abstract declarator', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when instantiated.
     */
    public function testFailureDefaultReasonReturnsStringWhenInstantiated(): void
    {
        $sut = new PtrAbstractDeclaratorConstraint();
        self::assertSame(
            'Pointer abstract declarator: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when instantiated 
     * and a pointer operator sequence constraint has been set.
     */
    public function testFailureDefaultReasonReturnsStringWhenInstantiatedAndPtrOperatorSequenceConstraintIsSet(): void
    {
        $ptrOpSeqConst = ConceptConstraintDoubleBuilder::createPtrOperatorSequenceConstraint($this)
            ->getDouble();
        
        $sut = new PtrAbstractDeclaratorConstraint();
        $sut->setPtrOperatorSequenceConstraint($ptrOpSeqConst);
        self::assertSame(
            'Pointer abstract declarator: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when instantiated.
     */
    public function testConstraintDescriptionReturnsStringWhenInstantiated(): void
    {
        $sut = new PtrAbstractDeclaratorConstraint();
        self::assertSame('Pointer abstract declarator', $sut->constraintDescription());
    }
    
    /**
     * Tests that constraintDescription() returns a string when instantiated 
     * and a pointer operator sequence constraint has been set.
     */
    public function testConstraintDescriptionReturnsStringWhenInstantiatedAndPtrOperatorSequenceConstraintIsSet(): void
    {
        $ptrOpSeqConst = ConceptConstraintDoubleBuilder::createPtrOperatorSequenceConstraint($this)
            ->buildConstraintDescription('pointer operator sequence constraint description')
            ->getDouble();
        
        $sut = new PtrAbstractDeclaratorConstraint();
        $sut->setPtrOperatorSequenceConstraint($ptrOpSeqConst);
        self::assertSame(
            "Pointer abstract declarator\n".
            "  pointer operator sequence constraint description", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when instantiated and not instance 
     * of PtrAbstractDeclarator.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndNotInstancePtrAbstractDeclarator(): void
    {
        $sut = new PtrAbstractDeclaratorConstraint();
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when:
     * - instantiated, 
     * - a pointer operator sequence constraint has been set, and 
     * - not instance of PtrAbstractDeclarator.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndPtrOperatorSequenceConstraintIsSetAndNotInstancePtrAbstractDeclarator(): void
    {
        $ptrOpSeqConst = ConceptConstraintDoubleBuilder::createPtrOperatorSequenceConstraint($this)
            ->getDouble();
        
        $sut = new PtrAbstractDeclaratorConstraint();
        $sut->setPtrOperatorSequenceConstraint($ptrOpSeqConst);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when instantiated and the pointer 
     * abstract declarator has a pointer operator sequence.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndHasPtrOperatorSequence(): void
    {
        $ptrOpSeq = ConceptDoubleBuilder::createPtrOperatorSequence($this)
            ->getDouble();
        $ptrAbstDcltor =  ConceptDoubleBuilder::createPtrAbstractDeclarator($this)
            ->buildGetPtrOperatorSequence($ptrOpSeq)
            ->getDouble();
        
        $sut = new PtrAbstractDeclaratorConstraint();
        self::assertFalse($sut->matches($ptrAbstDcltor));
    }
    
    /**
     * Tests that matches() returns FALSE when:
     * - instantiated, 
     * - a pointer operator sequence constraint has been set, 
     * - the pointer abstract declarator has a pointer operator sequence, and 
     * - the pointer operator sequence is invalid.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndPtrOperatorSequenceConstraintIsSetAndPtrOperatorSequenceIsInvalid(): void
    {
        $ptrOpSeq = ConceptDoubleBuilder::createPtrOperatorSequence($this)
            ->getDouble();
        $ptrAbstDcltor =  ConceptDoubleBuilder::createPtrAbstractDeclarator($this)
            ->buildGetPtrOperatorSequence($ptrOpSeq)
            ->getDouble();
        
        $ptrOpSeqConst = ConceptConstraintDoubleBuilder::createPtrOperatorSequenceConstraint($this)
            ->buildMatches($ptrOpSeq, FALSE)
            ->getDouble();
        
        $sut = new PtrAbstractDeclaratorConstraint();
        $sut->setPtrOperatorSequenceConstraint($ptrOpSeqConst);
        self::assertFalse($sut->matches($ptrAbstDcltor));
    }
    
    /**
     * Tests that matches() returns TRUE when instantiated and the pointer 
     * abstract declarator has no pointer operator sequence.
     */
    public function testMatchesReturnsTrueWhenInstantiatedAndHasNoPtrOperatorSequence(): void
    {
        $ptrAbstDcltor =  ConceptDoubleBuilder::createPtrAbstractDeclarator($this)
            ->getDouble();
        
        $sut = new PtrAbstractDeclaratorConstraint();
        self::assertTrue($sut->matches($ptrAbstDcltor));
    }
    
    /**
     * Tests that matches() returns TRUE when:
     * - instantiated, 
     * - a pointer operator sequence constraint has been set, 
     * - the pointer abstract declarator has a pointer operator sequence, and 
     * - the pointer operator sequence is valid.
     */
    public function testMatchesReturnsTrueWhenInstantiatedAndPtrOperatorSequenceConstraintIsSetAndPtrOperatorSequenceIsValid(): void
    {
        $ptrOpSeq = ConceptDoubleBuilder::createPtrOperatorSequence($this)
            ->getDouble();
        $ptrAbstDcltor =  ConceptDoubleBuilder::createPtrAbstractDeclarator($this)
            ->buildGetPtrOperatorSequence($ptrOpSeq)
            ->getDouble();
        
        $ptrOpSeqConst = ConceptConstraintDoubleBuilder::createPtrOperatorSequenceConstraint($this)
            ->buildMatches($ptrOpSeq, TRUE)
            ->getDouble();
        
        $sut = new PtrAbstractDeclaratorConstraint();
        $sut->setPtrOperatorSequenceConstraint($ptrOpSeqConst);
        self::assertTrue($sut->matches($ptrAbstDcltor));
    }
    
    /**
     * Tests that failureReason() returns a string when instantiated and not 
     * instance of PtrAbstractDeclarator.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndNotInstancePtrAbstractDeclarator(): void
    {
        $sut = new PtrAbstractDeclaratorConstraint();
        
        $pattern = \sprintf(
            '`^Pointer abstract declarator: .+ is not an instance of %s\\.$`', 
            \str_replace('\\', '\\\\', PtrAbstractDeclarator::class)
        );
        self::assertRegExp($pattern, $sut->failureReason(NULL));
    }
    
    /**
     * Tests that failureReason() returns a string when:
     * - instantiated, 
     * - a pointer operator sequence constraint has been set, and 
     * - not instance of PtrAbstractDeclarator.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndPtrOperatorSequenceConstraintIsSetAndNotInstancePtrAbstractDeclarator(): void
    {
        $ptrOpSeqConst = ConceptConstraintDoubleBuilder::createPtrOperatorSequenceConstraint($this)
            ->getDouble();
        
        $sut = new PtrAbstractDeclaratorConstraint();
        $sut->setPtrOperatorSequenceConstraint($ptrOpSeqConst);
        
        $pattern = \sprintf(
            '`^Pointer abstract declarator: .+ is not an instance of %s\\.$`', 
            \str_replace('\\', '\\\\', PtrAbstractDeclarator::class)
        );
        self::assertRegExp($pattern, $sut->failureReason(NULL));
    }
    
    /**
     * Tests that failureReason() returns a string when instantiated and the 
     * pointer abstract declarator has a pointer operator sequence.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndHasPtrOperatorSequence(): void
    {
        $ptrOpSeq = ConceptDoubleBuilder::createPtrOperatorSequence($this)
            ->getDouble();
        $ptrAbstDcltor =  ConceptDoubleBuilder::createPtrAbstractDeclarator($this)
            ->buildGetPtrOperatorSequence($ptrOpSeq)
            ->getDouble();
        
        $sut = new PtrAbstractDeclaratorConstraint();
        self::assertSame(
            'Pointer abstract declarator: '.
            'pointer operator sequence present whereas it should be absent.', 
            $sut->failureReason($ptrAbstDcltor)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when:
     * - instantiated, 
     * - a pointer operator sequence constraint has been set, 
     * - the pointer abstract declarator has a pointer operator sequence, and 
     * - the pointer operator sequence is invalid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndPtrOperatorSequenceConstraintIsSetAndPtrOperatorSequenceIsInvalid(): void
    {
        $ptrOpSeq = ConceptDoubleBuilder::createPtrOperatorSequence($this)
            ->getDouble();
        $ptrAbstDcltor =  ConceptDoubleBuilder::createPtrAbstractDeclarator($this)
            ->buildGetPtrOperatorSequence($ptrOpSeq)
            ->getDouble();
        
        $ptrOpSeqConst = ConceptConstraintDoubleBuilder::createPtrOperatorSequenceConstraint($this)
            ->buildMatches($ptrOpSeq, FALSE)
            ->buildFailureReason($ptrOpSeq, 'pointer operator sequence reason')
            ->getDouble();
        
        $sut = new PtrAbstractDeclaratorConstraint();
        $sut->setPtrOperatorSequenceConstraint($ptrOpSeqConst);
        self::assertSame(
            "Pointer abstract declarator\n".
            "  pointer operator sequence reason", 
            $sut->failureReason($ptrAbstDcltor)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when instantiated and the 
     * pointer abstract declarator has no pointer operator sequence.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndHasNoPtrOperatorSequence(): void
    {
        $ptrAbstDcltor =  ConceptDoubleBuilder::createPtrAbstractDeclarator($this)
            ->getDouble();
        
        $sut = new PtrAbstractDeclaratorConstraint();
        self::assertSame(
            'Pointer abstract declarator: Unknown reason.', 
            $sut->failureReason($ptrAbstDcltor)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when:
     * - instantiated, 
     * - a pointer operator sequence constraint has been set, 
     * - the pointer abstract declarator has a pointer operator sequence, and 
     * - the pointer operator sequence is valid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndPtrOperatorSequenceConstraintIsSetAndPtrOperatorSequenceIsValid(): void
    {
        $ptrOpSeq = ConceptDoubleBuilder::createPtrOperatorSequence($this)
            ->getDouble();
        $ptrAbstDcltor =  ConceptDoubleBuilder::createPtrAbstractDeclarator($this)
            ->buildGetPtrOperatorSequence($ptrOpSeq)
            ->getDouble();
        
        $ptrOpSeqConst = ConceptConstraintDoubleBuilder::createPtrOperatorSequenceConstraint($this)
            ->buildMatches($ptrOpSeq, TRUE)
            ->getDouble();
        
        $sut = new PtrAbstractDeclaratorConstraint();
        $sut->setPtrOperatorSequenceConstraint($ptrOpSeqConst);
        self::assertSame(
            'Pointer abstract declarator: Unknown reason.', 
            $sut->failureReason($ptrAbstDcltor)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is the 
     * constraint description followed by the reason of the failure when 
     * instantiated.
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenInstantiated(): void
    {
        $sut = new PtrAbstractDeclaratorConstraint();
        
        $pattern = \sprintf(
            "`^\n".
            "Pointer abstract declarator\n".
            "\n".
            "Pointer abstract declarator: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', PtrAbstractDeclarator::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is the 
     * constraint description followed by the reason of the failure when:
     * - instantiated, and 
     * - a pointer operator sequence constraint has been set.
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenInstantiatedAndPtrOperatorSequenceConstraintIsSet(): void
    {
        $ptrOpSeqConst = ConceptConstraintDoubleBuilder::createPtrOperatorSequenceConstraint($this)
            ->buildConstraintDescription('pointer operator sequence constraint description')
            ->getDouble();
        
        $sut = new PtrAbstractDeclaratorConstraint();
        $sut->setPtrOperatorSequenceConstraint($ptrOpSeqConst);
        
        $pattern = \sprintf(
            "`^\n".
            "Pointer abstract declarator\n".
            "  pointer operator sequence constraint description\n".
            "\n".
            "Pointer abstract declarator: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', PtrAbstractDeclarator::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that failureDescription() is called when instantiated and the 
     * value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenInstantiatedAndValueIsInvalid(): void
    {
        $sut = new PtrAbstractDeclaratorConstraint();
        
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a pointer abstract declarator`');
        
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Tests that failureDescription() is called when:
     * - instantiated, 
     * - a pointer operator sequence constraint has been set, and 
     * - the value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenInstantiatedAndPtrOperatorSequenceConstraintIsSetAndValueIsInvalid(): void
    {
        $ptrOpSeqConst = ConceptConstraintDoubleBuilder::createPtrOperatorSequenceConstraint($this)
            ->buildConstraintDescription('pointer operator sequence constraint description')
            ->getDouble();
        
        $sut = new PtrAbstractDeclaratorConstraint();
        $sut->setPtrOperatorSequenceConstraint($ptrOpSeqConst);
        
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a pointer abstract declarator`');
        
        $sut->evaluate(NULL, '', FALSE);
    }
}

