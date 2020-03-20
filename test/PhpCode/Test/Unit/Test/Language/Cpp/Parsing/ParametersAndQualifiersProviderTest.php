<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Parsing;

use PhpCode\Test\Language\Cpp\Declarator\ParametersAndQualifiersConstraint;
use PhpCode\Test\Language\Cpp\Parsing\ParametersAndQualifiersProvider;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Parsing\ParametersAndQualifiersProvider} 
 * class.
 * 
 * @group   declarator
 * @group   parsing
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParametersAndQualifiersProviderTest extends TestCase
{
    /**
     * Tests createValidDataSetProvider() returns an array with at least one 
     * valid data.
     */
    public function testCreateValidDataSetProviderReturnsAtLeastOneValidData(): void
    {
        $dataSet = ParametersAndQualifiersProvider::createValidDataSetProvider();
        self::assertTrue(\count($dataSet) > 0);
    }
    
    /**
     * Tests that createValidDataSetProvider() returns an array of valid data 
     * that have a constraint factory that creates new instances.
     */
    public function testCreateValidDataSetProviderReturnsValidDataWithFactoryCreatesNewInstances(): void
    {
        $dataSet = ParametersAndQualifiersProvider::createValidDataSetProvider();
        
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
     * ParametersAndQualifiersConstraint.
     */
    public function testCreateValidDataSetProviderReturnsValidDataWithFactoryCreatesInstanceParametersAndQualifiersConstraint(): void
    {
        $dataSet = ParametersAndQualifiersProvider::createValidDataSetProvider();
        
        foreach ($dataSet as $data) {
            $factory = $data->getConstraintFactory();
            self::assertInstanceOf(
                ParametersAndQualifiersConstraint::class, 
                $factory->createConstraint()
            );
            self::assertInstanceOf(
                ParametersAndQualifiersConstraint::class, 
                $factory->createConstraint()
            );
        }
    }
    
    /**
     * Tests createValidDataSet() returns an array with at least one valid 
     * data.
     */
    public function testCreateValidDataSetReturnsAtLeastOneValidData(): void
    {
        $dataSet = ParametersAndQualifiersProvider::createValidDataSet();
        self::assertTrue(\count($dataSet) > 0);
    }
    
    /**
     * Tests that createValidDataSet() returns an array of valid data that 
     * have a constraint factory that creates new instances.
     */
    public function testCreateValidDataSetReturnsValidDataWithFactoryCreatesNewInstances(): void
    {
        $dataSet = ParametersAndQualifiersProvider::createValidDataSet();
        
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
     * ParametersAndQualifiersConstraint.
     */
    public function testCreateValidDataSetReturnsValidDataWithFactoryCreatesInstanceParametersAndQualifiersConstraint(): void
    {
        $dataSet = ParametersAndQualifiersProvider::createValidDataSet();
        
        foreach ($dataSet as $data) {
            $factory = $data->getConstraintFactory();
            self::assertInstanceOf(
                ParametersAndQualifiersConstraint::class, 
                $factory->createConstraint()
            );
            self::assertInstanceOf(
                ParametersAndQualifiersConstraint::class, 
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
        $dataSet = ParametersAndQualifiersProvider::createInvalidDataSetProvider();
        self::assertTrue(\count($dataSet) > 0);
    }
}

