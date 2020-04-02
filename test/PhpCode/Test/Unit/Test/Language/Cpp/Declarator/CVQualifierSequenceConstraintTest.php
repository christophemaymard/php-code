<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declarator;

use PhpCode\Exception\ArgumentException;
use PhpCode\Language\Cpp\Declarator\CVQualifierSequence;
use PhpCode\Test\Language\Cpp\ConceptConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\CVQualifierConstraint;
use PhpCode\Test\Language\Cpp\Declarator\CVQualifierDoubleFactory;
use PhpCode\Test\Language\Cpp\Declarator\CVQualifierSequenceConstraint;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Declarator\CVQualifierSequenceConstraint} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class CVQualifierSequenceConstraintTest extends TestCase
{
    /**
     * Tests that __construct() throws an exception when the 
     * constant/volatile qualifier contraints are empty.
     */
    public function test__constructThrowsExceptionWhenConstraintsEmpty(): void
    {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('The constant/volatile qualifier constraints are empty.');
        
        $sut = new CVQualifierSequenceConstraint([]);
    }
    
    /**
     * Tests that __construct() throws an exception when one of the 
     * constraints is not an instance of CVQualifierConstraint.
     */
    public function test__constructThrowsExceptionWhenOneConstraintIsNotInstanceCVQualifierConstraint(): void
    {
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->getDouble();
        $consts[] = NULL;
        
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage(\sprintf(
            'The constraint must be an instance of %s.', 
            CVQualifierConstraint::class
        ));
        
        $sut = new CVQualifierSequenceConstraint($consts);
    }
    
    /**
     * Tests that toString() returns a string.
     */
    public function testToStringReturnsString(): void
    {
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->getDouble();
        
        $sut = new CVQualifierSequenceConstraint($consts);
        self::assertSame('constant/volatile qualifier sequence', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string.
     */
    public function testGetConceptNameReturnsString(): void
    {
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->getDouble();
        
        $sut = new CVQualifierSequenceConstraint($consts);
        self::assertSame('Constant/volatile qualifier sequence', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string.
     */
    public function testFailureDefaultReasonReturnsString(): void
    {
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->getDouble();
        
        $sut = new CVQualifierSequenceConstraint($consts);
        self::assertSame(
            'Constant/volatile qualifier sequence: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string.
     */
    public function testConstraintDescriptionReturnsString(): void
    {
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->buildConstraintDescription('foo')
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->buildConstraintDescription('bar')
            ->getDouble();
        
        $sut = new CVQualifierSequenceConstraint($consts);
        self::assertSame(
            "Constant/volatile qualifier sequence (2)\n".
            "  foo\n".
            "  bar", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when not instance of 
     * CVQualifierSequence.
     */
    public function testMatchesReturnsFalseWhenNotInstanceCVQualifierSequence(): void
    {
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->getDouble();
        
        $sut = new CVQualifierSequenceConstraint($consts);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the constraint count is not 
     * equal to the constant/volatile qualifier count of the sequence.
     */
    public function testMatchesReturnsFalseWhenConstraintCountNotEqualCVQualifierCount(): void
    {
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->buildCount(0)
            ->getDouble();
        
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->getDouble();
       
        $sut = new CVQualifierSequenceConstraint($consts);
        self::assertFalse($sut->matches($cvSeq));
    }
    
    /**
     * Tests that matches() returns FALSE when a constant/volatile qualifier 
     * is invalid.
     */
    public function testMatchesReturnsFalseWhenCVQualifierIsInvalid(): void
    {
        $cvFactory = $this->createCVQualifierDoubleFactory();
        
        $cvs = [];
        $cvs[] = $cvFactory->createDummy();
        $cvs[] = $cvFactory->createDummy();
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->buildCount(2)
            ->buildGetCVQualifiers($cvs)
            ->getDouble();
        
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->buildMatches($cvs[0], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->buildMatches($cvs[1], FALSE)
            ->getDouble();
       
        $sut = new CVQualifierSequenceConstraint($consts);
        self::assertFalse($sut->matches($cvSeq));
    }
    
    /**
     * Tests that matches() returns TRUE when all the constant/volatile 
     * qualifiers are valid.
     */
    public function testMatchesReturnsTrueWhenAllCVQualifierAreValid(): void
    {
        $cvFactory = $this->createCVQualifierDoubleFactory();
        
        $cvs = [];
        $cvs[] = $cvFactory->createDummy();
        $cvs[] = $cvFactory->createDummy();
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->buildCount(2)
            ->buildGetCVQualifiers($cvs)
            ->getDouble();
        
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->buildMatches($cvs[0], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->buildMatches($cvs[1], TRUE)
            ->getDouble();
       
        $sut = new CVQualifierSequenceConstraint($consts);
        self::assertTrue($sut->matches($cvSeq));
    }
    
    /**
     * Tests that failureReason() returns a string when not instance of 
     * CVQualifierSequence.
     */
    public function testFailureReasonReturnsStringWhenNotInstanceCVQualifierSequence(): void
    {
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->getDouble();
        
        $sut = new CVQualifierSequenceConstraint($consts);
        $pattern = \sprintf(
            '`^Constant/volatile qualifier sequence: .+ is not an instance of %s\\.$`', 
            \str_replace('\\', '\\\\', CVQualifierSequence::class)
        );
        self::assertRegExp($pattern, $sut->failureReason(NULL));
    }
    
    /**
     * Tests that failureReason() returns a string when the constraint count 
     * is not equal to the constant/volatile qualifier count of the sequence.
     */
    public function testFailureReasonReturnsStringWhenConstraintCountNotEqualCVQualifierCount(): void
    {
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->buildCount(0)
            ->getDouble();
        
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->getDouble();
       
        $sut = new CVQualifierSequenceConstraint($consts);
        self::assertSame(
            'Constant/volatile qualifier sequence: '.
            'constant/volatile qualifier sequence should have 2 constant/volatile qualifier(s), got 0.', 
            $sut->failureReason($cvSeq)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when a constant/volatile 
     * qualifier is invalid.
     */
    public function testFailureReasonReturnsStringWhenCVQualifierIsInvalid(): void
    {
        $cvFactory = $this->createCVQualifierDoubleFactory();
        
        $cvs = [];
        $cvs[] = $cvFactory->createDummy();
        $cvs[] = $cvFactory->createDummy();
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->buildCount(2)
            ->buildGetCVQualifiers($cvs)
            ->getDouble();
        
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->buildMatches($cvs[0], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->buildMatches($cvs[1], FALSE)
            ->buildFailureReason($cvs[1], 'foo reason')
            ->getDouble();
       
        $sut = new CVQualifierSequenceConstraint($consts);
        self::assertSame(
            "Constant/volatile qualifier sequence\n".
            "  foo reason", 
            $sut->failureReason($cvSeq)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when all the 
     * constant/volatile qualifiers are valid.
     */
    public function testFailureReasonReturnsStringWhenAllCVQualifierAreValid(): void
    {
        $cvFactory = $this->createCVQualifierDoubleFactory();
        
        $cvs = [];
        $cvs[] = $cvFactory->createDummy();
        $cvs[] = $cvFactory->createDummy();
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->buildCount(2)
            ->buildGetCVQualifiers($cvs)
            ->getDouble();
        
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->buildMatches($cvs[0], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->buildMatches($cvs[1], TRUE)
            ->getDouble();
       
        $sut = new CVQualifierSequenceConstraint($consts);
        self::assertSame(
            'Constant/volatile qualifier sequence: Unknown reason.', 
            $sut->failureReason($cvSeq)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure.
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReason(): void
    {
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->buildConstraintDescription('foo description')
            ->getDouble();
        
        $sut = new CVQualifierSequenceConstraint($consts);
        $pattern = \sprintf(
            "`^\n".
            "Constant/volatile qualifier sequence \\(1\\)\n".
            "  foo description\n".
            "\n".
            "Constant/volatile qualifier sequence: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', CVQualifierSequence::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that failureDescription() is called  when the value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenValueIsInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a constant/volatile qualifier sequence`');
        
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createCVQualifierConstraint($this)
            ->buildConstraintDescription('foo description')
            ->getDouble();
        
        $sut = new CVQualifierSequenceConstraint($consts);
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

