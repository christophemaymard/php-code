<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Parsing;

use PhpCode\Test\Language\Cpp\Declarator\DeclaratorConstraint;
use PhpCode\Test\Language\Cpp\Parsing\DeclaratorProvider;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Parsing\DeclaratorProvider} 
 * class.
 * 
 * @group   declarator
 * @group   parsing
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclaratorProviderTest extends TestCase
{
    /**
     * Tests createValidDataSetProvider() returns an array with at least one 
     * valid data.
     */
    public function testCreateValidDataSetProviderReturnsAtLeastOneValidData(): void
    {
        $dataSet = DeclaratorProvider::createValidDataSetProvider();
        self::assertTrue(\count($dataSet) > 0);
    }
    
    /**
     * Tests that createValidDataSetProvider() returns an array of valid data 
     * that have a constraint factory that creates new instances.
     */
    public function testCreateValidDataSetProviderReturnsValidDataWithFactoryCreatesNewInstances(): void
    {
        $dataSet = DeclaratorProvider::createValidDataSetProvider();
        
        foreach ($dataSet as $data) {
            $factory = $data->getConstraintFactory();
            $const1 = $factory->createConstraint();
            $const2 = $factory->createConstraint();
            self::assertNotSame($const1, $const2);
        }
    }
    
    /**
     * Tests that createValidDataSetProvider() returns an array of valid data 
     * that have a constraint factory that creates instance of 
     * DeclaratorConstraint.
     */
    public function testCreateValidDataSetProviderReturnsValidDataWithFactoryCreatesInstanceDeclaratorConstraint(): void
    {
        $dataSet = DeclaratorProvider::createValidDataSetProvider();
        
        foreach ($dataSet as $data) {
            $factory = $data->getConstraintFactory();
            self::assertInstanceOf(
                DeclaratorConstraint::class, 
                $factory->createConstraint()
            );
            self::assertInstanceOf(
                DeclaratorConstraint::class, 
                $factory->createConstraint()
            );
        }
    }
    
    /**
     * Tests createInvalidDataSetProvider() returns an array with at least 
     * one invalid data.
     */
    public function testCreateInvalidDataSetProviderReturnsAtLeastOneInvalidData(): void
    {
        $dataSet = DeclaratorProvider::createInvalidDataSetProvider();
        self::assertTrue(\count($dataSet) > 0);
    }
}

