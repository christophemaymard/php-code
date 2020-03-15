<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp;

use PhpCode\Test\Language\Cpp\Declarator\DeclaratorIdConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\NoptrDeclaratorConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\ParametersAndQualifiersConstraintDoubleBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Represents a factory of concept constraint double builders.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ConceptConstraintDoubleBuilder
{
    /**
     * Creates a double constraint builder of the {@see PhpCode\Test\Language\Cpp\Declarator\NoptrDeclaratorConstraint} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  NoptrDeclaratorConstraintDoubleBuilder  The created instance of NoptrDeclaratorConstraintDoubleBuilder.
     */
    public static function createNoptrDeclaratorConstraint(TestCase $testCase): NoptrDeclaratorConstraintDoubleBuilder
    {
        return new NoptrDeclaratorConstraintDoubleBuilder($testCase);
    }
    
    /**
     * Creates a double constraint builder of the {@see PhpCode\Test\Language\Cpp\Declarator\DeclaratorIdConstraint} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  DeclaratorIdConstraintDoubleBuilder The created instance of DeclaratorIdConstraintDoubleBuilder.
     */
    public static function createDeclaratorIdConstraint(TestCase $testCase): DeclaratorIdConstraintDoubleBuilder
    {
        return new DeclaratorIdConstraintDoubleBuilder($testCase);
    }
    
    /**
     * Creates a double constraint builder of the {@see PhpCode\Test\Language\Cpp\Declarator\ParametersAndQualifiersConstraint} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  ParametersAndQualifiersConstraintDoubleBuilder  The created instance of ParametersAndQualifiersConstraintDoubleBuilder.
     */
    public static function createParametersAndQualifiersConstraint(TestCase $testCase): ParametersAndQualifiersConstraintDoubleBuilder
    {
        return new ParametersAndQualifiersConstraintDoubleBuilder($testCase);
    }
}

