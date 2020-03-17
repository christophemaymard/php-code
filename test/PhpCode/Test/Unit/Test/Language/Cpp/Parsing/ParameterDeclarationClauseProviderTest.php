<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Parsing;

use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationClauseConstraint;
use PhpCode\Test\Language\Cpp\Parsing\ParameterDeclarationClauseProvider;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Parsing\ParameterDeclarationClauseProvider} 
 * class.
 * 
 * @group   declarator
 * @group   parsing
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationClauseProviderTest extends TestCase
{
    /**
     * Tests createValidDataSetProvider() returns an array with at least one 
     * valid data.
     */
    public function testCreateValidDataSetProviderReturnsAtLeastOneValidData(): void
    {
        $dataSet = ParameterDeclarationClauseProvider::createValidDataSetProvider();
        self::assertTrue(\count($dataSet) > 0);
    }
    
    /**
     * Tests that createValidDataSetProvider() returns an array of valid data 
     * that have a constraint factory that creates new instances.
     */
    public function testCreateValidDataSetProviderReturnsValidDataWithFactoryCreatesNewInstances(): void
    {
        $dataSet = ParameterDeclarationClauseProvider::createValidDataSetProvider();
        
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
     * ParameterDeclarationClauseConstraint.
     */
    public function testCreateValidDataSetProviderReturnsValidDataWithFactoryCreatesInstanceParameterDeclarationClauseConstraint(): void
    {
        $dataSet = ParameterDeclarationClauseProvider::createValidDataSetProvider();
        
        foreach ($dataSet as $data) {
            $factory = $data->getConstraintFactory();
            self::assertInstanceOf(
                ParameterDeclarationClauseConstraint::class, 
                $factory->createConstraint()
            );
            self::assertInstanceOf(
                ParameterDeclarationClauseConstraint::class, 
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
        $dataSet = ParameterDeclarationClauseProvider::createValidDataSet();
        self::assertTrue(\count($dataSet) > 0);
    }
    
    /**
     * Tests that createValidDataSet() returns an array of valid data that 
     * have a constraint factory that creates new instances.
     */
    public function testCreateValidDataSetReturnsValidDataWithFactoryCreatesNewInstances(): void
    {
        $dataSet = ParameterDeclarationClauseProvider::createValidDataSet();
        
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
     * ParameterDeclarationClauseConstraint.
     */
    public function testCreateValidDataSetReturnsValidDataWithFactoryCreatesInstanceParameterDeclarationClauseConstraint(): void
    {
        $dataSet = ParameterDeclarationClauseProvider::createValidDataSet();
        
        foreach ($dataSet as $data) {
            $factory = $data->getConstraintFactory();
            self::assertInstanceOf(
                ParameterDeclarationClauseConstraint::class, 
                $factory->createConstraint()
            );
            self::assertInstanceOf(
                ParameterDeclarationClauseConstraint::class, 
                $factory->createConstraint()
            );
        }
    }
}

