<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Exception\InvalidOperationException;
use PhpCode\Language\Cpp\Declarator\CVQualifier;
use PhpCode\Language\Cpp\Declarator\CVQualifierSequence;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declarator\CVQualifierSequence} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class CVQualifierSequenceTest extends TestCase
{
    /**
     * Tests that addCVQualifier() throws an exception when adding a 
     * qualifier defined as constant whereas a previous qualifier defined as 
     * constant has been added.
     * 
     * @param   array[] $cvs    The constant/volatile qualifiers to add to the sequence before adding a constant qualifier.
     * 
     * @dataProvider    getDuplicateConstProvider
     */
    public function testAddCVQualifierThrowsExceptionWhenDuplicateConst(array $cvs): void
    {
        $sut = new CVQualifierSequence();
        
        foreach ($cvs as $cv) {
            $sut->addCVQualifier($cv);
        }
        
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Duplicate constant/volatile qualifier defined as constant.');
        
        $sut->addCVQualifier($this->createConstCVQualifier());
    }
    /**
     * Tests that addCVQualifier() throws an exception when adding a 
     * qualifier defined as volatile whereas a previous qualifier defined as 
     * volatile has been added.
     * 
     * @param   array[] $cvs    The constant/volatile qualifiers to add to the sequence before adding a volatile qualifier.
     * 
     * @dataProvider    getDuplicateVolatileProvider
     */
    public function testAddCVQualifierThrowsExceptionWhenDuplicateVolatile(array $cvs): void
    {
        $sut = new CVQualifierSequence();
        
        foreach ($cvs as $cv) {
            $sut->addCVQualifier($cv);
        }
        
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Duplicate constant/volatile qualifier defined as volatile.');
        
        $sut->addCVQualifier($this->createVolatileCVQualifier());
    }
    
    /**
     * Tests that getCVQualifiers() returns an indexed array of CVQualifier 
     * instances.
     */
    public function testGetCVQualifiersReturnsArrayCVQualifiers(): void
    {
        $sut = new CVQualifierSequence();
        
        $cvs = [];
        self::assertSame($cvs, $sut->getCVQualifiers());
        
        $cvs[] = $this->createConstCVQualifier();
        $sut->addCVQualifier($cvs[0]);
        self::assertSame($cvs, $sut->getCVQualifiers());
        
        $cvs[] = $this->createVolatileCVQualifier();
        $sut->addCVQualifier($cvs[1]);
        self::assertSame($cvs, $sut->getCVQualifiers());
    }
    
    /**
     * Returns a set of constant/volatile qualifiers to add to the system 
     * under test before adding a constant qualifier.
     * 
     * @return  array[]
     */
    public function getDuplicateConstProvider(): array
    {
        return [
            'const' => [
                [
                    $this->createConstCVQualifier(), 
                ], 
            ], 
            'const volatile' => [
                [
                    $this->createConstCVQualifier(), 
                    $this->createVolatileCVQualifier(), 
                ], 
            ], 
            'volatile const' => [
                [
                $this->createVolatileCVQualifier(), 
                $this->createConstCVQualifier(), 
                ], 
            ], 
        ];
    }
    
    /**
     * Returns a set of constant/volatile qualifiers to add to the system 
     * under test before adding a volatile qualifier.
     * 
     * @return  array[]
     */
    public function getDuplicateVolatileProvider(): array
    {
        return [
            'volatile' => [
                [
                    $this->createVolatileCVQualifier(), 
                ], 
            ], 
            'volatile const' => [
                [
                $this->createVolatileCVQualifier(), 
                $this->createConstCVQualifier(), 
                ], 
            ], 
            'const volatile' => [
                [
                    $this->createConstCVQualifier(), 
                    $this->createVolatileCVQualifier(), 
                ], 
            ], 
        ];
    }
    
    /**
     * Creates a constant/volatile qualifier defined as constant.
     * 
     * @return  CVQualifier
     */
    private function createConstCVQualifier(): CVQualifier
    {
        return ConceptDoubleBuilder::createCVQualifier($this)
            ->buildIsConst(TRUE)
            ->buildIsVolatile(FALSE)
            ->getDouble();        
    }
    
    /**
     * Creates a constant/volatile qualifier defined as volatile.
     * 
     * @return  CVQualifier
     */
    private function createVolatileCVQualifier(): CVQualifier
    {
        return ConceptDoubleBuilder::createCVQualifier($this)
            ->buildIsConst(FALSE)
            ->buildIsVolatile(TRUE)
            ->getDouble();        
    }
}

