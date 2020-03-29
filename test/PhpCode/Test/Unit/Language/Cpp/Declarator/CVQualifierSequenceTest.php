<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Exception\InvalidOperationException;
use PhpCode\Language\Cpp\Declarator\CVQualifierSequence;
use PhpCode\Test\Language\Cpp\Declarator\CVQualifierDoubleFactory;
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
        
        $sut->addCVQualifier(
            $this->createCVQualifierDoubleFactory()->createConstant()
        );
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
        
        $sut->addCVQualifier(
            $this->createCVQualifierDoubleFactory()->createVolatile()
        );
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
        
        $cvs[] = $this->createCVQualifierDoubleFactory()->createConstant();
        $sut->addCVQualifier($cvs[0]);
        self::assertSame($cvs, $sut->getCVQualifiers());
        
        $cvs[] = $this->createCVQualifierDoubleFactory()->createVolatile();
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
        $cvFactory = $this->createCVQualifierDoubleFactory();
        
        return [
            'const' => [
                [
                    $cvFactory->createConstant(), 
                ], 
            ], 
            'const volatile' => [
                [
                    $cvFactory->createConstant(), 
                    $cvFactory->createVolatile(), 
                ], 
            ], 
            'volatile const' => [
                [
                    $cvFactory->createVolatile(), 
                    $cvFactory->createConstant(), 
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
        $cvFactory = $this->createCVQualifierDoubleFactory();
        
        return [
            'volatile' => [
                [
                    $cvFactory->createVolatile(), 
                ], 
            ], 
            'volatile const' => [
                [
                    $cvFactory->createVolatile(), 
                    $cvFactory->createConstant(), 
                ], 
            ], 
            'const volatile' => [
                [
                    $cvFactory->createConstant(), 
                    $cvFactory->createVolatile(), 
                ], 
            ], 
        ];
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

