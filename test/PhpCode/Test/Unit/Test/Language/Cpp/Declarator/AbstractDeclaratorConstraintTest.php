<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\AbstractDeclarator;
use PhpCode\Test\Language\Cpp\ConceptConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\AbstractDeclaratorConstraint;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Declarator\AbstractDeclaratorConstraint} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AbstractDeclaratorConstraintTest extends TestCase
{
    /**
     * Tests that __construct() throws an exception.
     */
    public function test__constructThrowsException(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        
        $sut = new AbstractDeclaratorConstraint();
    }
    
    /**
     * Tests that createPtrAbstractDeclarator() returns new instances of 
     * AbstractDeclaratorConstraint.
     */
    public function testCreatePointerReturnsNewInstancePtrOperatorConstraint(): void
    {
        $ptrAbstDcltorConst = ConceptConstraintDoubleBuilder::createPtrAbstractDeclaratorConstraint($this)
            ->getDouble();
        
        $const1 = AbstractDeclaratorConstraint::createPtrAbstractDeclarator($ptrAbstDcltorConst);
        $const2 = AbstractDeclaratorConstraint::createPtrAbstractDeclarator($ptrAbstDcltorConst);
        self::assertNotSame($const1, $const2);
    }
    
    /**
     * Tests that toString() returns a string when the instance is created by 
     * createPtrAbstractDeclarator().
     */
    public function testToStringReturnsStringWhenCreatePtrAbstractDeclarator(): void
    {
        $ptrAbstDcltorConst = ConceptConstraintDoubleBuilder::createPtrAbstractDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = AbstractDeclaratorConstraint::createPtrAbstractDeclarator($ptrAbstDcltorConst);
        self::assertSame('abstract declarator', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string when the instance is 
     * created by createPtrAbstractDeclarator().
     */
    public function testGetConceptNameReturnsStringWhenCreatePtrAbstractDeclarator(): void
    {
        $ptrAbstDcltorConst = ConceptConstraintDoubleBuilder::createPtrAbstractDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = AbstractDeclaratorConstraint::createPtrAbstractDeclarator($ptrAbstDcltorConst);
        self::assertSame('Abstract declarator', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when the instance 
     * is created by createPtrAbstractDeclarator().
     */
    public function testFailureDefaultReasonReturnsStringWhenCreatePtrAbstractDeclarator(): void
    {
        $ptrAbstDcltorConst = ConceptConstraintDoubleBuilder::createPtrAbstractDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = AbstractDeclaratorConstraint::createPtrAbstractDeclarator($ptrAbstDcltorConst);
        self::assertSame(
            'Abstract declarator: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createPtrAbstractDeclarator().
     */
    public function testConstraintDescriptionReturnsStringWhenCreatePtrAbstractDeclarator(): void
    {
        $ptrAbstDcltorConst = ConceptConstraintDoubleBuilder::createPtrAbstractDeclaratorConstraint($this)
            ->buildConstraintDescription('pointer abstract declarator description')
            ->getDouble();
        
        $sut = AbstractDeclaratorConstraint::createPtrAbstractDeclarator($ptrAbstDcltorConst);
        self::assertSame(
            "Abstract declarator\n".
            "  pointer abstract declarator description", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createPtrAbstractDeclarator() and not instance of AbstractDeclarator.
     */
    public function testMatchesReturnsFalseWhenCreatePtrAbstractDeclaratorAndNotInstanceAbstractDeclarator(): void
    {
        $ptrAbstDcltorConst = ConceptConstraintDoubleBuilder::createPtrAbstractDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = AbstractDeclaratorConstraint::createPtrAbstractDeclarator($ptrAbstDcltorConst);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createPtrAbstractDeclarator() and the pointer abstract declarator is 
     * invalid.
     */
    public function testMatchesReturnsFalseWhenCreatePtrAbstractDeclaratorAndPtrAbstractDeclaratorIsInvalid(): void
    {
        $ptrAbstDcltor = ConceptDoubleBuilder::createPtrAbstractDeclarator($this)
            ->getDouble();
        $abstDcltor = ConceptDoubleBuilder::createAbstractDeclarator($this)
            ->buildGetPtrAbstractDeclarator($ptrAbstDcltor)
            ->getDouble();
            
        $ptrAbstDcltorConst = ConceptConstraintDoubleBuilder::createPtrAbstractDeclaratorConstraint($this)
            ->buildMatches($ptrAbstDcltor, FALSE)
            ->getDouble();
        
        $sut = AbstractDeclaratorConstraint::createPtrAbstractDeclarator($ptrAbstDcltorConst);
        self::assertFalse($sut->matches($abstDcltor));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createPtrAbstractDeclarator() and the pointer abstract declarator is 
     * valid.
     */
    public function testMatchesReturnsTrueWhenCreatePtrAbstractDeclaratorAndPtrAbstractDeclaratorIsValid(): void
    {
        $ptrAbstDcltor = ConceptDoubleBuilder::createPtrAbstractDeclarator($this)
            ->getDouble();
        $abstDcltor = ConceptDoubleBuilder::createAbstractDeclarator($this)
            ->buildGetPtrAbstractDeclarator($ptrAbstDcltor)
            ->getDouble();
            
        $ptrAbstDcltorConst = ConceptConstraintDoubleBuilder::createPtrAbstractDeclaratorConstraint($this)
            ->buildMatches($ptrAbstDcltor, TRUE)
            ->getDouble();
        
        $sut = AbstractDeclaratorConstraint::createPtrAbstractDeclarator($ptrAbstDcltorConst);
        self::assertTrue($sut->matches($abstDcltor));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createPtrAbstractDeclarator() and not instance of 
     * AbstractDeclarator.
     */
    public function testFailureReasonReturnsStringWhenCreatePtrAbstractDeclaratorAndNotInstanceAbstractDeclarator(): void
    {
        $ptrAbstDcltorConst = ConceptConstraintDoubleBuilder::createPtrAbstractDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = AbstractDeclaratorConstraint::createPtrAbstractDeclarator($ptrAbstDcltorConst);
        $pattern = \sprintf(
            '`^Abstract declarator: .+ is not an instance of %s\\.$`', 
            \str_replace('\\', '\\\\', AbstractDeclarator::class)
        );
        self::assertRegExp($pattern, $sut->failureReason(NULL));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createPtrAbstractDeclarator() and the pointer abstract 
     * declarator is invalid.
     */
    public function testFailureReasonReturnsStringWhenCreatePtrAbstractDeclaratorAndPtrAbstractDeclaratorIsInvalid(): void
    {
        $ptrAbstDcltor = ConceptDoubleBuilder::createPtrAbstractDeclarator($this)
            ->getDouble();
        $abstDcltor = ConceptDoubleBuilder::createAbstractDeclarator($this)
            ->buildGetPtrAbstractDeclarator($ptrAbstDcltor)
            ->getDouble();
            
        $ptrAbstDcltorConst = ConceptConstraintDoubleBuilder::createPtrAbstractDeclaratorConstraint($this)
            ->buildMatches($ptrAbstDcltor, FALSE)
            ->buildFailureReason($ptrAbstDcltor, 'pointer abstract declarator reason')
            ->getDouble();
        
        $sut = AbstractDeclaratorConstraint::createPtrAbstractDeclarator($ptrAbstDcltorConst);
        self::assertSame(
            "Abstract declarator\n".
            "  pointer abstract declarator reason", 
            $sut->failureReason($abstDcltor)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createPtrAbstractDeclarator() and the pointer abstract 
     * declarator is valid.
     */
    public function testFailureReasonReturnsStringWhenCreatePtrAbstractDeclaratorAndPtrAbstractDeclaratorIsValid(): void
    {
        $ptrAbstDcltor = ConceptDoubleBuilder::createPtrAbstractDeclarator($this)
            ->getDouble();
        $abstDcltor = ConceptDoubleBuilder::createAbstractDeclarator($this)
            ->buildGetPtrAbstractDeclarator($ptrAbstDcltor)
            ->getDouble();
            
        $ptrAbstDcltorConst = ConceptConstraintDoubleBuilder::createPtrAbstractDeclaratorConstraint($this)
            ->buildMatches($ptrAbstDcltor, TRUE)
            ->getDouble();
        
        $sut = AbstractDeclaratorConstraint::createPtrAbstractDeclarator($ptrAbstDcltorConst);
        self::assertSame(
            'Abstract declarator: Unknown reason.', 
            $sut->failureReason($abstDcltor)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by createPtrAbstractDeclarator().
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenCreatePtrAbstractDeclarator(): void
    {
        $ptrAbstDcltorConst = ConceptConstraintDoubleBuilder::createPtrAbstractDeclaratorConstraint($this)
            ->buildConstraintDescription('pointer abstract declarator description')
            ->getDouble();
        
        $sut = AbstractDeclaratorConstraint::createPtrAbstractDeclarator($ptrAbstDcltorConst);
        $pattern = \sprintf(
            "`^\n".
            "Abstract declarator\n".
            "  pointer abstract declarator description\n".
            "\n".
            "Abstract declarator: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', AbstractDeclarator::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that failureDescription() is called when the instance has been 
     * created by createPointer() and the value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenCreatePointerAndValueIsInvalid(): void
    {
        $ptrAbstDcltorConst = ConceptConstraintDoubleBuilder::createPtrAbstractDeclaratorConstraint($this)
            ->buildConstraintDescription('pointer abstract declarator description')
            ->getDouble();
        
        $sut = AbstractDeclaratorConstraint::createPtrAbstractDeclarator($ptrAbstDcltorConst);
        
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is an abstract declarator`');
        
        $sut->evaluate(NULL, '', FALSE);
    }
}

