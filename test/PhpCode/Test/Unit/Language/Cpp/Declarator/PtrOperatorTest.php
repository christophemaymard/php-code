<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Exception\InvalidOperationException;
use PhpCode\Language\Cpp\Declarator\PtrOperator;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declarator\PtrOperator} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrOperatorTest extends TestCase
{
    /**
     * Tests that __construct() throws an exception.
     */
    public function test__constructThrowsException(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        $sut = new PtrOperator();
    }
    
    /**
     * Tests that createPointer() returns new instances of PtrOperator.
     */
    public function testCreatePointerReturnsNewInstancePtrOperator(): void
    {
        $ptrOp1 = PtrOperator::createPointer();
        $ptrOp2 = PtrOperator::createPointer();
        self::assertNotSame($ptrOp1, $ptrOp2);
    }
    
    /**
     * Tests that createLvalueReference() returns new instances of 
     * PtrOperator.
     */
    public function testCreateLvalueReferenceReturnsNewInstancePtrOperator(): void
    {
        $ptrOp1 = PtrOperator::createLvalueReference();
        $ptrOp2 = PtrOperator::createLvalueReference();
        self::assertNotSame($ptrOp1, $ptrOp2);
    }
    
    /**
     * Tests that createRvalueReference() returns new instances of 
     * PtrOperator.
     */
    public function testCreateRvalueReferenceReturnsNewInstancePtrOperator(): void
    {
        $ptrOp1 = PtrOperator::createRvalueReference();
        $ptrOp2 = PtrOperator::createRvalueReference();
        self::assertNotSame($ptrOp1, $ptrOp2);
    }
    
    /**
     * Tests that isPointer() returns TRUE when the instance is created by 
     * createPointer().
     */
    public function testIsPointerReturnsTrueWhenCreatePointer(): void
    {
        $sut = PtrOperator::createPointer();
        self::assertTrue($sut->isPointer());
    }
    
    /**
     * Tests that isPointer() returns FALSE when the instance is created by 
     * createLvalueReference().
     */
    public function testIsPointerReturnsFalseWhenCreateLvalueReference(): void
    {
        $sut = PtrOperator::createLvalueReference();
        self::assertFalse($sut->isPointer());
    }
    
    /**
     * Tests that isPointer() returns FALSE when the instance is created by 
     * createRvalueReference().
     */
    public function testIsPointerReturnsFalseWhenCreateRvalueReference(): void
    {
        $sut = PtrOperator::createRvalueReference();
        self::assertFalse($sut->isPointer());
    }
    
    /**
     * Tests that isLvalue() returns FALSE when the instance is created by 
     * createPointer().
     */
    public function testIsLvalueReturnsFalseWhenCreatePointer(): void
    {
        $sut = PtrOperator::createPointer();
        self::assertFalse($sut->isLvalue());
    }
    
    /**
     * Tests that isLvalue() returns TRUE when the instance is created by 
     * createLvalueReference().
     */
    public function testIsLvalueReturnsTrueWhenCreateLvalueReference(): void
    {
        $sut = PtrOperator::createLvalueReference();
        self::assertTrue($sut->isLvalue());
    }
    
    /**
     * Tests that isLvalue() returns FALSE when the instance is created by 
     * createRvalueReference().
     */
    public function testIsLvalueReturnsFalseWhenCreateRvalueReference(): void
    {
        $sut = PtrOperator::createRvalueReference();
        self::assertFalse($sut->isLvalue());
    }
    
    /**
     * Tests that isRvalue() returns FALSE when the instance is created by 
     * createPointer().
     */
    public function testIsRvalueReturnsFalseWhenCreatePointer(): void
    {
        $sut = PtrOperator::createPointer();
        self::assertFalse($sut->isRvalue());
    }
    
    /**
     * Tests that isRvalue() returns FALSE when the instance is created by 
     * createLvalueReference().
     */
    public function testIsRvalueReturnsFalseWhenCreateLvalueReference(): void
    {
        $sut = PtrOperator::createLvalueReference();
        self::assertFalse($sut->isRvalue());
    }
    
    /**
     * Tests that isRvalue() returns TRUE when the instance is created by 
     * createRvalueReference().
     */
    public function testIsRvalueReturnsTrueWhenCreateRvalueReference(): void
    {
        $sut = PtrOperator::createRvalueReference();
        self::assertTrue($sut->isRvalue());
    }
    
    /**
     * Tests that getCVQualifierSequence(), when the instance is 
     * created by createPointer(), returns:
     * - NULL when instantiated, 
     * - the instance of constant/volatile qualifier sequence that has been 
     * set.
     */
    public function testGetCVQualifierSequenceWhenCreatePointer(): void
    {
        $sut = PtrOperator::createPointer();
        
        self::assertNull($sut->getCVQualifierSequence());
        
        $cvSeq1 = ConceptDoubleBuilder::createCVQualifierSequence($this)->getDouble();
        $sut->setCVQualifierSequence($cvSeq1);
        self::assertSame($cvSeq1, $sut->getCVQualifierSequence());
        
        $cvSeq2 = ConceptDoubleBuilder::createCVQualifierSequence($this)->getDouble();
        $sut->setCVQualifierSequence($cvSeq2);
        self::assertSame($cvSeq2, $sut->getCVQualifierSequence());
    }
    
    /**
     * Tests that getCVQualifierSequence() returns NULL when the instance is 
     * created by createLvalueReference().
     */
    public function testGetCVQualifierSequenceReturnsNullWhenCreateLvalueReference(): void
    {
        $sut = PtrOperator::createLvalueReference();
        self::assertNull($sut->getCVQualifierSequence());
    }
    
    /**
     * Tests that getCVQualifierSequence() returns NULL when the instance is 
     * created by createRvalueReference().
     */
    public function testGetCVQualifierSequenceReturnsNullWhenCreateRvalueReference(): void
    {
        $sut = PtrOperator::createRvalueReference();
        self::assertNull($sut->getCVQualifierSequence());
    }
    
    /**
     * Tests that setCVQualifierSequence() throws an exception when the 
     * instance is created by createLvalueReference().
     */
    public function testSetCVQualifierSequenceThrowsExceptionWhenCreateLvalueReference(): void
    {
        $sut = PtrOperator::createLvalueReference();
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)->getDouble();
        
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Lvalue reference cannot have a constant/volatile qualifier sequence.');
        
        $sut->setCVQualifierSequence($cvSeq);
    }
    
    /**
     * Tests that setCVQualifierSequence() throws an exception when the 
     * instance is created by createRvalueReference().
     */
    public function testSetCVQualifierSequenceThrowsExceptionWhenCreateRvalueReference(): void
    {
        $sut = PtrOperator::createRvalueReference();
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)->getDouble();
        
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Rvalue reference cannot have a constant/volatile qualifier sequence.');
        
        $sut->setCVQualifierSequence($cvSeq);
    }
    
    /**
     * Tests that hasCVQualifierSequence() returns a boolean when the 
     * instance is created by createPointer().
     */
    public function testHasCVQualifierSequenceReturnsBoolWhenCreatePointer(): void
    {
        $sut = PtrOperator::createPointer();
        
        self::assertFalse($sut->hasCVQualifierSequence());
        
        $cvSeq1 = ConceptDoubleBuilder::createCVQualifierSequence($this)->getDouble();
        $sut->setCVQualifierSequence($cvSeq1);
        self::assertTrue($sut->hasCVQualifierSequence());
        
        $cvSeq2 = ConceptDoubleBuilder::createCVQualifierSequence($this)->getDouble();
        $sut->setCVQualifierSequence($cvSeq2);
        self::assertTrue($sut->hasCVQualifierSequence());
    }
    
    /**
     * Tests that hasCVQualifierSequence() returns FALSE when the instance is 
     * created by createLvalueReference().
     */
    public function testHasCVQualifierSequenceReturnsFalseWhenCreateLvalueReference(): void
    {
        $sut = PtrOperator::createLvalueReference();
        self::assertFalse($sut->hasCVQualifierSequence());
    }
    
    /**
     * Tests that hasCVQualifierSequence() returns FALSE when the instance is 
     * created by createRvalueReference().
     */
    public function testHasCVQualifierSequenceReturnsFalseWhenCreateRvalueReference(): void
    {
        $sut = PtrOperator::createRvalueReference();
        self::assertFalse($sut->hasCVQualifierSequence());
    }
}

