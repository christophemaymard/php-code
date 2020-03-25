<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Parsing;

use PhpCode\Test\Language\Cpp\Expression\NestedNameSpecifierConstraint;
use PhpCode\Test\Language\Cpp\Parsing\NestedNameSpecifierProvider;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Parsing\NestedNameSpecifierProvider} 
 * class.
 * 
 * @group   expression
 * @group   parsing
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NestedNameSpecifierProviderTest extends TestCase
{
    /**
     * Tests createValidDataSet() returns an array with at least one valid 
     * data.
     */
    public function testCreateValidDataSetReturnsAtLeastOneValidData(): void
    {
        $dataSet = NestedNameSpecifierProvider::createValidDataSet();
        self::assertTrue(\count($dataSet) > 0);
    }
    
    /**
     * Tests that createValidDataSet() returns an array of valid data that 
     * have a constraint factory that creates new instances.
     */
    public function testCreateValidDataSetReturnsValidDataWithFactoryCreatesNewInstances(): void
    {
        $dataSet = NestedNameSpecifierProvider::createValidDataSet();
        
        foreach ($dataSet as $data) {
            $factory = $data->getConstraintFactory();
            $const1 = $factory->createConstraint();
            $const2 = $factory->createConstraint();
            self::assertNotSame($const1, $const2);
        }
    }
    
    /**
     * Tests that createValidDataSet() returns an array of valid data that 
     * have a constraint factory that creates instance of 
     * NestedNameSpecifierConstraint.
     */
    public function testCreateValidDataSetReturnsValidDataWithFactoryCreatesInstanceNestedNameSpecifierConstraint(): void
    {
        $dataSet = NestedNameSpecifierProvider::createValidDataSet();
        
        foreach ($dataSet as $data) {
            $factory = $data->getConstraintFactory();
            self::assertInstanceOf(
                NestedNameSpecifierConstraint::class, 
                $factory->createConstraint()
            );
            self::assertInstanceOf(
                NestedNameSpecifierConstraint::class, 
                $factory->createConstraint()
            );
        }
    }
}

