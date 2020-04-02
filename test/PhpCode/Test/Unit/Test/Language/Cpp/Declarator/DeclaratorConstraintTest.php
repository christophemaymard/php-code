<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\Declarator;
use PhpCode\Test\Language\Cpp\ConceptConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\DeclaratorConstraint;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Declarator\DeclaratorConstraint} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclaratorConstraintTest extends TestCase
{
    /**
     * Tests that toString() returns a string when the instance is created 
     * by createPtrDeclarator().
     */
    public function testToStringReturnsStringWhenCreatePtrDeclarator(): void
    {
        $ptrDcltorConst = ConceptConstraintDoubleBuilder::createPtrDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = DeclaratorConstraint::createPtrDeclarator($ptrDcltorConst);
        self::assertSame('declarator', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string when the instance is 
     * created by createPtrDeclarator().
     */
    public function testGetConceptNameReturnsStringWhenCreatePtrDeclarator(): void
    {
        $ptrDcltorConst = ConceptConstraintDoubleBuilder::createPtrDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = DeclaratorConstraint::createPtrDeclarator($ptrDcltorConst);
        self::assertSame('Declarator', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when the instance 
     * is created by createPtrDeclarator().
     */
    public function testFailureDefaultReasonReturnsStringWhenCreatePtrDeclarator(): void
    {
        $ptrDcltorConst = ConceptConstraintDoubleBuilder::createPtrDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = DeclaratorConstraint::createPtrDeclarator($ptrDcltorConst);
        self::assertSame(
            'Declarator: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createPtrDeclarator().
     */
    public function testConstraintDescriptionReturnsStringWhenCreatePtrDeclarator(): void
    {
        $ptrDcltorConst = ConceptConstraintDoubleBuilder::createPtrDeclaratorConstraint($this)
            ->buildConstraintDescription(
                "foo PtrDeclaratorConstraint\n".
                "  foo NoptrDeclaratorConstraint"
            )
            ->getDouble();
        
        $sut = DeclaratorConstraint::createPtrDeclarator($ptrDcltorConst);
        self::assertSame(
            "Declarator\n".
            "  foo PtrDeclaratorConstraint\n".
            "    foo NoptrDeclaratorConstraint", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createPtrDeclarator() and not instance of Declarator.
     */
    public function testMatchesReturnsFalseWhenCreatePtrDeclaratorAndNotInstanceDeclarator(): void
    {
        $ptrDcltorConst = ConceptConstraintDoubleBuilder::createPtrDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = DeclaratorConstraint::createPtrDeclarator($ptrDcltorConst);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createPtrDeclarator() and the pointer declarator is invalid.
     */
    public function testMatchesReturnsFalseWhenCreatePtrDeclaratorAndPtrDeclaratorIsInvalid(): void
    {
        $ptrDcltor = ConceptDoubleBuilder::createPtrDeclarator($this)
            ->getDouble();
        $dcltor = ConceptDoubleBuilder::createDeclarator($this)
            ->buildGetPtrDeclarator($ptrDcltor)
            ->getDouble();
        
        $ptrDcltorConst = ConceptConstraintDoubleBuilder::createPtrDeclaratorConstraint($this)
            ->buildMatches($ptrDcltor, FALSE)
            ->getDouble();
        
        $sut = DeclaratorConstraint::createPtrDeclarator($ptrDcltorConst);
        self::assertFalse($sut->matches($dcltor));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createPtrDeclarator() and the declarator is valid.
     */
    public function testMatchesReturnsTrueWhenCreatePtrDeclaratorAndDeclaratorIsValid(): void
    {
        $ptrDcltor = ConceptDoubleBuilder::createPtrDeclarator($this)
            ->getDouble();
        $dcltor = ConceptDoubleBuilder::createDeclarator($this)
            ->buildGetPtrDeclarator($ptrDcltor)
            ->getDouble();
        
        $ptrDcltorConst = ConceptConstraintDoubleBuilder::createPtrDeclaratorConstraint($this)
            ->buildMatches($ptrDcltor, TRUE)
            ->getDouble();
        
        $sut = DeclaratorConstraint::createPtrDeclarator($ptrDcltorConst);
        self::assertTrue($sut->matches($dcltor));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createPtrDeclarator() and not instance of Declarator.
     */
    public function testFailureReasonReturnsStringWhenCreatePtrDeclaratorAndNotInstanceDeclarator(): void
    {
        $ptrDcltorConst = ConceptConstraintDoubleBuilder::createPtrDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = DeclaratorConstraint::createPtrDeclarator($ptrDcltorConst);
            $pattern = \sprintf(
            '`^Declarator: .+ is not an instance of %s\\.$`', 
            \str_replace('\\', '\\\\', Declarator::class)
        );
        self::assertRegExp($pattern, $sut->failureReason(NULL));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createPtrDeclarator() and the pointer declarator is 
     * invalid.
     */
    public function testFailureReasonReturnsStringWhenCreatePtrDeclaratorAndPtrDeclaratorIsInvalid(): void
    {
        $ptrDcltor = ConceptDoubleBuilder::createPtrDeclarator($this)
            ->getDouble();
        $dcltor = ConceptDoubleBuilder::createDeclarator($this)
            ->buildGetPtrDeclarator($ptrDcltor)
            ->getDouble();
        
        $ptrDcltorConst = ConceptConstraintDoubleBuilder::createPtrDeclaratorConstraint($this)
            ->buildMatches($ptrDcltor, FALSE)
            ->buildFailureReason($ptrDcltor, 'foo reason')
            ->getDouble();
        
        $sut = DeclaratorConstraint::createPtrDeclarator($ptrDcltorConst);
        self::assertSame(
            "Declarator\n".
            "  foo reason",
            $sut->failureReason($dcltor)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createPtrDeclarator() and the declarator is valid.
     */
    public function testFailureReasonReturnsStringWhenCreatePtrDeclaratorAndDeclaratorIsValid(): void
    {
        $ptrDcltor = ConceptDoubleBuilder::createPtrDeclarator($this)
            ->getDouble();
        $dcltor = ConceptDoubleBuilder::createDeclarator($this)
            ->buildGetPtrDeclarator($ptrDcltor)
            ->getDouble();
        
        $ptrDcltorConst = ConceptConstraintDoubleBuilder::createPtrDeclaratorConstraint($this)
            ->buildMatches($ptrDcltor, TRUE)
            ->getDouble();
        
        $sut = DeclaratorConstraint::createPtrDeclarator($ptrDcltorConst);
        self::assertSame(
            'Declarator: Unknown reason.', 
            $sut->failureReason($dcltor)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by createPtrDeclarator().
     */
    public function testAdditionalFailureReasonReturnsConstraintDescriptionAndFailureReasonWhenCreatePtrDeclarator(): void
    {
        $ptrDcltorConst = ConceptConstraintDoubleBuilder::createPtrDeclaratorConstraint($this)
            ->buildConstraintDescription('foo pointer declarator description')
            ->getDouble();
        
        $sut = DeclaratorConstraint::createPtrDeclarator($ptrDcltorConst);
            $pattern = \sprintf(
            "`^\n".
            "Declarator\n".
            "  foo pointer declarator description\n".
            "\n". 
            "Declarator: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', Declarator::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that failureDescription() is called when the instance is created 
     * by createPtrDeclarator() and the value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenCreatePtrDeclaratorAndAndValueIsInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches(
            '` is a declarator`'
        );
        
        $ptrDcltorConst = ConceptConstraintDoubleBuilder::createPtrDeclaratorConstraint($this)
            ->buildConstraintDescription('foo no-pointer declarator description')
            ->getDouble();
        
        $sut = DeclaratorConstraint::createPtrDeclarator($ptrDcltorConst);
        $sut->evaluate(NULL, '', FALSE);
    }
}

