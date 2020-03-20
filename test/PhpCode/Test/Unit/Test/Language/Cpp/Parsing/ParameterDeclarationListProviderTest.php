<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Parsing;

use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationListConstraint;
use PhpCode\Test\Language\Cpp\Parsing\ParameterDeclarationListProvider;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Parsing\ParameterDeclarationListProvider} 
 * class.
 * 
 * @group   declarator
 * @group   parsing
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationListProviderTest extends TestCase
{
    /**
     * Tests createValidDataSetProvider() returns an array with at least one 
     * valid data.
     */
    public function testCreateValidDataSetProviderReturnsAtLeastOneValidData(): void
    {
        $dataSet = ParameterDeclarationListProvider::createValidDataSetProvider();
        self::assertTrue(\count($dataSet) > 0);
    }
    
    /**
     * Tests that createValidDataSetProvider() returns an array of valid data 
     * that have a constraint factory that creates new instances.
     */
    public function testCreateValidDataSetProviderReturnsValidDataWithFactoryCreatesNewInstances(): void
    {
        $dataSet = ParameterDeclarationListProvider::createValidDataSetProvider();
        
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
     * ParameterDeclarationListConstraint.
     */
    public function testCreateValidDataSetProviderReturnsValidDataWithFactoryCreatesInstanceParameterDeclarationListConstraint(): void
    {
        $dataSet = ParameterDeclarationListProvider::createValidDataSetProvider();
        
        foreach ($dataSet as $data) {
            $factory = $data->getConstraintFactory();
            self::assertInstanceOf(
                ParameterDeclarationListConstraint::class, 
                $factory->createConstraint()
            );
            self::assertInstanceOf(
                ParameterDeclarationListConstraint::class, 
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
        $dataSet = ParameterDeclarationListProvider::createValidDataSet();
        self::assertTrue(\count($dataSet) > 0);
    }
    
    /**
     * Tests that createValidDataSet() returns an array of valid data that 
     * have a constraint factory that creates new instances.
     */
    public function testCreateValidDataSetReturnsValidDataWithFactoryCreatesNewInstances(): void
    {
        $dataSet = ParameterDeclarationListProvider::createValidDataSet();
        
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
     * ParameterDeclarationListConstraint.
     */
    public function testCreateValidDataSetReturnsValidDataWithFactoryCreatesInstanceParameterDeclarationListConstraint(): void
    {
        $dataSet = ParameterDeclarationListProvider::createValidDataSet();
        
        foreach ($dataSet as $data) {
            $factory = $data->getConstraintFactory();
            self::assertInstanceOf(
                ParameterDeclarationListConstraint::class, 
                $factory->createConstraint()
            );
            self::assertInstanceOf(
                ParameterDeclarationListConstraint::class, 
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
        $dataSet = ParameterDeclarationListProvider::createInvalidDataSetProvider();
        self::assertTrue(\count($dataSet) > 0);
    }
}

