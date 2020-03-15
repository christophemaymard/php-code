<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp;

use PhpCode\Test\Language\Cpp\Declarator\DeclaratorIdDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\ParametersAndQualifiersDoubleBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Represents a factory of concept double builders.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ConceptDoubleBuilder
{
    /**
     * Creates a double builder of the {@see PhpCode\Language\Cpp\Declarator\DeclaratorId} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  DeclaratorIdDoubleBuilder   The created instance of DeclaratorIdDoubleBuilder.
     */
    public static function createDeclaratorId(TestCase $testCase): DeclaratorIdDoubleBuilder
    {
        return new DeclaratorIdDoubleBuilder($testCase);
    }
    
    /**
     * Creates a double builder of the {@see PhpCode\Language\Cpp\Declarator\ParametersAndQualifiers} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  ParametersAndQualifiersDoubleBuilder    The created instance of ParametersAndQualifiersDoubleBuilder.
     */
    public static function createParametersAndQualifiers(TestCase $testCase): ParametersAndQualifiersDoubleBuilder
    {
        return new ParametersAndQualifiersDoubleBuilder($testCase);
    }
}

