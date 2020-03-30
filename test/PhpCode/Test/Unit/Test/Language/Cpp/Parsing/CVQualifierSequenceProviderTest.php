<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Parsing;

use PhpCode\Test\Language\Cpp\Declarator\CVQualifierSequenceConstraint;
use PhpCode\Test\Language\Cpp\Parsing\CVQualifierSequenceProvider;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Parsing\CVQualifierSequenceProvider} 
 * class.
 * 
 * @group   declarator
 * @group   parsing
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class CVQualifierSequenceProviderTest extends TestCase
{
    /**
     * Tests createValidDataSet() returns an array with at least one valid 
     * data.
     */
    public function testCreateValidDataSetReturnsAtLeastOneValidData(): void
    {
        $dataSet = CVQualifierSequenceProvider::createValidDataSet();
        self::assertTrue(\count($dataSet) > 0);
    }
    
    /**
     * Tests that createValidDataSet() returns an array of valid data that 
     * have a constraint factory that creates new instances.
     */
    public function testCreateValidDataSetReturnsValidDataWithFactoryCreatesNewInstances(): void
    {
        $dataSet = CVQualifierSequenceProvider::createValidDataSet();
        
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
     * CVQualifierSequenceConstraint.
     */
    public function testCreateValidDataSetReturnsValidDataWithFactoryCreatesInstanceCVQualifierSequenceConstraint(): void
    {
        $dataSet = CVQualifierSequenceProvider::createValidDataSet();
        
        foreach ($dataSet as $data) {
            $factory = $data->getConstraintFactory();
            self::assertInstanceOf(
                CVQualifierSequenceConstraint::class, 
                $factory->createConstraint()
            );
            self::assertInstanceOf(
                CVQualifierSequenceConstraint::class, 
                $factory->createConstraint()
            );
        }
    }
    
    /**
     * Tests createInvalidDataSet() returns an array with at least one 
     * invalid data.
     */
    public function testCreateInvalidDataSetReturnsAtLeastOneInvalidData(): void
    {
        $dataSet = CVQualifierSequenceProvider::createInvalidDataSet();
        self::assertTrue(\count($dataSet) > 0);
    }
}

