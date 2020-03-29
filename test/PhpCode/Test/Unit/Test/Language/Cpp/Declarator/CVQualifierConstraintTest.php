<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\CVQualifier;
use PhpCode\Test\Language\Cpp\Declarator\CVQualifierConstraint;
use PhpCode\Test\Language\Cpp\Declarator\CVQualifierDoubleFactory;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Declarator\CVQualifierConstraint} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class CVQualifierConstraintTest extends TestCase
{
    /**
     * Tests that __construct() throws an exception.
     */
    public function test__constructThrowsException(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        
        $sut = new CVQualifierConstraint();
    }
    
    /**
     * Tests that toString() returns a string when the instance has been 
     * created by createConst().
     */
    public function testToStringReturnsStringWhenCreateConst(): void
    {
        $sut = CVQualifierConstraint::createConst();
        self::assertSame('constant CV qualifier', $sut->toString());
    }
    
    /**
     * Tests that toString() returns a string when the instance has been 
     * created by createVolatile().
     */
    public function testToStringReturnsStringWhenCreateVolatile(): void
    {
        $sut = CVQualifierConstraint::createVolatile();
        self::assertSame('volatile CV qualifier', $sut->toString());
    }
    
    /**
     *  Tests that getConceptName() returns a string when the instance has 
     * been created by createConst().
     */
    public function testGetConceptNameReturnsStringWhenCreateConst(): void
    {
        $sut = CVQualifierConstraint::createConst();
        self::assertSame('Constant CV qualifier', $sut->getConceptName());
    }
    
    /**
     *  Tests that getConceptName() returns a string when the instance has 
     * been created by createVolatile().
     */
    public function testGetConceptNameReturnsStringWhenCreateVolatile(): void
    {
        $sut = CVQualifierConstraint::createVolatile();
        self::assertSame('Volatile CV qualifier', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when the instance 
     * has been created by createConst().
     */
    public function testFailureDefaultReasonReturnsStringWhenCreateConst(): void
    {
        $sut = CVQualifierConstraint::createConst();
        self::assertSame(
            'Constant CV qualifier: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when the instance 
     * has been created by createVolatile().
     */
    public function testFailureDefaultReasonReturnsStringWhenCreateVolatile(): void
    {
        $sut = CVQualifierConstraint::createVolatile();
        self::assertSame(
            'Volatile CV qualifier: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * has been created by createConst().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateConst(): void
    {
        $sut = CVQualifierConstraint::createConst();
        self::assertSame('Constant CV qualifier', $sut->constraintDescription());
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * has been created by createVolatile().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateVolatile(): void
    {
        $sut = CVQualifierConstraint::createVolatile();
        self::assertSame('Volatile CV qualifier', $sut->constraintDescription());
    }
    
    /**
     * Tests that matches() returns FALSE when the instance has been created 
     * by createConst() and not instance of CVQualifier.
     */
    public function testMatchesReturnsFalseWhenCreateConstAndNotInstanceCVQualifier(): void
    {
        $sut = CVQualifierConstraint::createConst();
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance has been created 
     * by createVolatile() and not instance of CVQualifier.
     */
    public function testMatchesReturnsFalseWhenCreateVolatileAndNotInstanceCVQualifier(): void
    {
        $sut = CVQualifierConstraint::createVolatile();
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance has been created 
     * by createConst() and the constant/volatile qualifier is defined as 
     * volatile.
     */
    public function testMatchesReturnsFalseWhenCreateConstAndQualifierIsVolatile(): void
    {
        $cv = $this->createCVQualifierDoubleFactory()->createVolatile();
        
        $sut = CVQualifierConstraint::createConst();
        self::assertFalse($sut->matches($cv));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance has been created 
     * by createVolatile() and the constant/volatile qualifier is defined as 
     * constant.
     */
    public function testMatchesReturnsFalseWhenCreateVolatileAndQualifierIsConstant(): void
    {
        $cv = $this->createCVQualifierDoubleFactory()->createConstant();
        
        $sut = CVQualifierConstraint::createVolatile();
        self::assertFalse($sut->matches($cv));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance has been created 
     * by createConst() and the constant/volatile qualifier is defined as 
     * constant.
     */
    public function testMatchesReturnsTrueWhenCreateConstAndQualifierIsConstant(): void
    {
        $cv = $this->createCVQualifierDoubleFactory()->createConstant();
        
        $sut = CVQualifierConstraint::createConst();
        self::assertTrue($sut->matches($cv));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance has been created 
     * by createVolatile() and the constant/volatile qualifier is defined as 
     * volatile.
     */
    public function testMatchesReturnsTrueWhenCreateVolatileAndQualifierIsVolatile(): void
    {
        $cv = $this->createCVQualifierDoubleFactory()->createVolatile();
        
        $sut = CVQualifierConstraint::createVolatile();
        self::assertTrue($sut->matches($cv));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance has been 
     * created by createConst() and not instance of CVQualifier.
     */
    public function testFailureReasonReturnsStringWhenCreateConstAndNotInstanceCVQualifier(): void
    {
        $sut = CVQualifierConstraint::createConst();
        $pattern = \sprintf(
            '`^Constant CV qualifier: .+ is not an instance of %s\\.$`', 
            \str_replace('\\', '\\\\', CVQualifier::class)
        );
        self::assertRegExp($pattern, $sut->failureReason(NULL));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance has been 
     * created by createVolatile() and not instance of CVQualifier.
     */
    public function testFailureReasonReturnsStringWhenCreateVolatileAndNotInstanceCVQualifier(): void
    {
        $sut = CVQualifierConstraint::createVolatile();
        $pattern = \sprintf(
            '`^Volatile CV qualifier: .+ is not an instance of %s\\.$`', 
            \str_replace('\\', '\\\\', CVQualifier::class)
        );
        self::assertRegExp($pattern, $sut->failureReason(NULL));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance has been 
     * created by createConst() and the constant/volatile qualifier is 
     * defined as volatile.
     */
    public function testFailureReasonReturnsStringWhenCreateConstAndQualifierIsVolatile(): void
    {
        $cv = $this->createCVQualifierDoubleFactory()->createVolatile();
        
        $sut = CVQualifierConstraint::createConst();
        self::assertSame(
            'Constant CV qualifier: It should be constant.', 
            $sut->failureReason($cv)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance has been 
     * created by createVolatile() and the constant/volatile qualifier is 
     * defined as constant.
     */
    public function testFailureReasonReturnsStringWhenCreateVolatileAndQualifierIsConstant(): void
    {
        $cv = $this->createCVQualifierDoubleFactory()->createConstant();
        
        $sut = CVQualifierConstraint::createVolatile();
        self::assertSame(
            'Volatile CV qualifier: It should be volatile.', 
            $sut->failureReason($cv)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance has been 
     * created by createConst() and the constant/volatile qualifier is 
     * defined as constant.
     */
    public function testFailureReasonReturnsStringWhenCreateConstAndQualifierIsConstant(): void
    {
        $cv = $this->createCVQualifierDoubleFactory()->createConstant();
        
        $sut = CVQualifierConstraint::createConst();
        self::assertSame(
            'Constant CV qualifier: Unknown reason.', 
            $sut->failureReason($cv)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance has been 
     * created by createVolatile() and the constant/volatile qualifier is 
     * defined as volatile.
     */
    public function testFailureReasonReturnsStringWhenCreateVolatileAndQualifierIsVolatile(): void
    {
        $cv = $this->createCVQualifierDoubleFactory()->createVolatile();
        
        $sut = CVQualifierConstraint::createVolatile();
        self::assertSame(
            'Volatile CV qualifier: Unknown reason.', 
            $sut->failureReason($cv)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance has been created by createConst() and not instance of 
     * CVQualifier.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateConstAndNotInstanceCVQualifier(): void
    {
        $sut = CVQualifierConstraint::createConst();
        $pattern = \sprintf(
            "`^\n".
            "Constant CV qualifier\n".
            "\n".
            "Constant CV qualifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', CVQualifier::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance has been created by createVolatile() and not instance of 
     * CVQualifier.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateVolatileAndNotInstanceCVQualifier(): void
    {
        $sut = CVQualifierConstraint::createVolatile();
        $pattern = \sprintf(
            "`^\n".
            "Volatile CV qualifier\n".
            "\n".
            "Volatile CV qualifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', CVQualifier::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance has been created by createConst() and the constant/volatile 
     * qualifier is defined as volatile.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateConstAndQualifierIsVolatile(): void
    {
        $cv = $this->createCVQualifierDoubleFactory()->createVolatile();
        
        $sut = CVQualifierConstraint::createConst();
        self::assertSame(
            "\n".
            "Constant CV qualifier\n".
            "\n".
            "Constant CV qualifier: It should be constant.", 
            $sut->additionalFailureDescription($cv)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance has been created by createVolatile() and the 
     * constant/volatile qualifier is defined as constant.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateVolatileAndQualifierIsConstant(): void
    {
        $cv = $this->createCVQualifierDoubleFactory()->createConstant();
        
        $sut = CVQualifierConstraint::createVolatile();
        self::assertSame(
            "\n".
            "Volatile CV qualifier\n".
            "\n".
            "Volatile CV qualifier: It should be volatile.", 
            $sut->additionalFailureDescription($cv)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance has been created by createConst() and the constant/volatile 
     * qualifier is defined as constant.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateConstAndQualifierIsConstant(): void
    {
        $cv = $this->createCVQualifierDoubleFactory()->createConstant();
        
        $sut = CVQualifierConstraint::createConst();
        self::assertSame(
            "\n".
            "Constant CV qualifier\n".
            "\n".
            "Constant CV qualifier: Unknown reason.", 
            $sut->additionalFailureDescription($cv)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance has been created by createVolatile() and the 
     * constant/volatile qualifier is defined as volatile.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateVolatileAndQualifierIsVolatile(): void
    {
        $cv = $this->createCVQualifierDoubleFactory()->createVolatile();
        
        $sut = CVQualifierConstraint::createVolatile();
        self::assertSame(
            "\n".
            "Volatile CV qualifier\n".
            "\n".
            "Volatile CV qualifier: Unknown reason.", 
            $sut->additionalFailureDescription($cv)
        );
    }
    
    /**
     * Tests that failureDescription() is called  when the instance has been 
     * created by createConst() and the value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenCreateConstAndValueIsInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a constant CV qualifier`');
        
        $sut = CVQualifierConstraint::createConst();
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Tests that failureDescription() is called  when the instance has been 
     * created by createVolatile() and the value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenCreateVolatileAndValueIsInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a volatile CV qualifier`');
        
        $sut = CVQualifierConstraint::createVolatile();
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Creates a factory of constant/volatile qualifier doubles.
     * 
     * @return  CVQualifierDoubleFactory
     */
    private function createCVQualifierDoubleFactory(): CVQualifierDoubleFactory
    {
        return new CVQualifierDoubleFactory($this);
    }
}

