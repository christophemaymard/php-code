<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\PtrDeclarator;
use PhpCode\Test\Language\Cpp\ConceptConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\PtrDeclaratorConstraint;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Declarator\PtrDeclaratorConstraint} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrDeclaratorConstraintTest extends TestCase
{
    /**
     * Tests that toString() returns a string when instantiated.
     */
    public function testToStringReturnsStringWhenInstantiated(): void
    {
        $noptrDcltorConst = ConceptConstraintDoubleBuilder::createNoptrDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = new PtrDeclaratorConstraint($noptrDcltorConst);
        self::assertSame('pointer declarator', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string when instantiated.
     */
    public function testGetConceptNameReturnsStringWhenInstantiated(): void
    {
        $noptrDcltorConst = ConceptConstraintDoubleBuilder::createNoptrDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = new PtrDeclaratorConstraint($noptrDcltorConst);
        self::assertSame('Pointer declarator', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when instantiated.
     */
    public function testFailureDefaultReasonReturnsStringWhenInstantiated(): void
    {
        $noptrDcltorConst = ConceptConstraintDoubleBuilder::createNoptrDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = new PtrDeclaratorConstraint($noptrDcltorConst);
        self::assertSame(
            'Pointer declarator: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when instantiated.
     */
    public function testConstraintDescriptionReturnsStringWhenInstantiated(): void
    {
        $noptrDcltorConst = ConceptConstraintDoubleBuilder::createNoptrDeclaratorConstraint($this)
            ->buildConstraintDescription(
                "foo NoptrDeclaratorConstraint\n".
                "  foo DeclaratorId"
            )
            ->getDouble();
        
        $sut = new PtrDeclaratorConstraint($noptrDcltorConst);
        self::assertSame(
            "Pointer declarator\n".
            "  foo NoptrDeclaratorConstraint\n".
            "    foo DeclaratorId", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when instantiated and not instance 
     * of PtrDeclarator.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndNotInstancePtrDeclarator(): void
    {
        $noptrDcltorConst = ConceptConstraintDoubleBuilder::createNoptrDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = new PtrDeclaratorConstraint($noptrDcltorConst);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when instantiated and the 
     * no-pointer declarator is invalid.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndNoptrDeclaratorIsInvalid(): void
    {
        $noptrDcltor = ConceptDoubleBuilder::createNoptrDeclarator($this)
            ->getDouble();
        $ptrDcltor = ConceptDoubleBuilder::createPtrDeclarator($this)
            ->buildGetNoptrDeclarator($noptrDcltor)
            ->getDouble();
        
        $noptrDcltorConst = ConceptConstraintDoubleBuilder::createNoptrDeclaratorConstraint($this)
            ->buildMatches($noptrDcltor, FALSE)
            ->getDouble();
        
        $sut = new PtrDeclaratorConstraint($noptrDcltorConst);
        self::assertFalse($sut->matches($ptrDcltor));
    }
    
    /**
     * Tests that matches() returns TRUE when instantiated and the pointer 
     * declarator is valid.
     */
    public function testMatchesReturnsTrueWhenInstantiatedAndPtrDeclaratorIsValid(): void
    {
        $noptrDcltor = ConceptDoubleBuilder::createNoptrDeclarator($this)
            ->getDouble();
        $ptrDcltor = ConceptDoubleBuilder::createPtrDeclarator($this)
            ->buildGetNoptrDeclarator($noptrDcltor)
            ->getDouble();
        
        $noptrDcltorConst = ConceptConstraintDoubleBuilder::createNoptrDeclaratorConstraint($this)
            ->buildMatches($noptrDcltor, TRUE)
            ->getDouble();
        
        $sut = new PtrDeclaratorConstraint($noptrDcltorConst);
        self::assertTrue($sut->matches($ptrDcltor));
    }
    
    /**
     * Tests that failureReason() returns a string when instantiated and not 
     * instance of PtrDeclarator.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndNotInstancePtrDeclarator(): void
    {
        $noptrDcltorConst = ConceptConstraintDoubleBuilder::createNoptrDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = new PtrDeclaratorConstraint($noptrDcltorConst);
            $pattern = \sprintf(
            '`^Pointer declarator: .+ is not an instance of %s\\.$`', 
            \str_replace('\\', '\\\\', PtrDeclarator::class)
        );
        self::assertRegExp($pattern, $sut->failureReason(NULL));
    }
    
    /**
     * Tests that failureReason() returns a string when instantiated and the 
     * no-pointer declarator is invalid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndNoptrDeclaratorIsInvalid(): void
    {
        $noptrDcltor = ConceptDoubleBuilder::createNoptrDeclarator($this)
            ->getDouble();
        $ptrDcltor = ConceptDoubleBuilder::createPtrDeclarator($this)
            ->buildGetNoptrDeclarator($noptrDcltor)
            ->getDouble();
        
        $noptrDcltorConst = ConceptConstraintDoubleBuilder::createNoptrDeclaratorConstraint($this)
            ->buildMatches($noptrDcltor, FALSE)
            ->buildFailureReason($noptrDcltor, 'foo reason')
            ->getDouble();
        
        $sut = new PtrDeclaratorConstraint($noptrDcltorConst);
        self::assertSame(
            "Pointer declarator\n".
            "  foo reason",
            $sut->failureReason($ptrDcltor)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when instantiated and the 
     * pointer declarator is valid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndPtrDeclaratorIsValid(): void
    {
        $noptrDcltor = ConceptDoubleBuilder::createNoptrDeclarator($this)
            ->getDouble();
        $ptrDcltor = ConceptDoubleBuilder::createPtrDeclarator($this)
            ->buildGetNoptrDeclarator($noptrDcltor)
            ->getDouble();
        
        $noptrDcltorConst = ConceptConstraintDoubleBuilder::createNoptrDeclaratorConstraint($this)
            ->buildMatches($noptrDcltor, TRUE)
            ->getDouble();
        
        $sut = new PtrDeclaratorConstraint($noptrDcltorConst);
        self::assertSame(
            'Pointer declarator: Unknown reason.', 
            $sut->failureReason($ptrDcltor)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * instantiated.
     */
    public function testAdditionalFailureReasonReturnsConstraintDescriptionAndFailureReasonWhenInstantiated(): void
    {
        $noptrDcltorConst = ConceptConstraintDoubleBuilder::createNoptrDeclaratorConstraint($this)
            ->buildConstraintDescription('foo no-pointer declarator description')
            ->getDouble();
        
        $sut = new PtrDeclaratorConstraint($noptrDcltorConst);
            $pattern = \sprintf(
            "`^\n".
            "Pointer declarator\n".
            "  foo no-pointer declarator description\n".
            "\n". 
            "Pointer declarator: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', PtrDeclarator::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that failureDescription() is called when instantiated and the 
     * value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenInstantiatedAndAndValueIsInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches(
            '` is a pointer declarator`'
        );
        
        $noptrDcltorConst = ConceptConstraintDoubleBuilder::createNoptrDeclaratorConstraint($this)
            ->buildConstraintDescription('foo no-pointer declarator description')
            ->getDouble();
        
        $sut = new PtrDeclaratorConstraint($noptrDcltorConst);
        $sut->evaluate(NULL, '', FALSE);
    }
}

