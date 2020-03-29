<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp;

use PhpCode\Test\Language\Cpp\Declaration\DefiningTypeSpecifierDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declaration\SimpleTypeSpecifierDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declaration\TypeSpecifierDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\CVQualifierSequenceDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\DeclaratorIdDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\DeclaratorDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\NoptrDeclaratorDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\PtrDeclaratorDoubleBuilder;
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
     * Creates a double builder of the {@see PhpCode\Language\Cpp\Declarator\Declarator} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  DeclaratorDoubleBuilder The created instance of DeclaratorDoubleBuilder.
     */
    public static function createDeclarator(TestCase $testCase): DeclaratorDoubleBuilder
    {
        return new DeclaratorDoubleBuilder($testCase);
    }
    
    /**
     * Creates a double builder of the {@see PhpCode\Language\Cpp\Declarator\PtrDeclarator} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  PtrDeclaratorDoubleBuilder  The created instance of PtrDeclaratorDoubleBuilder.
     */
    public static function createPtrDeclarator(TestCase $testCase): PtrDeclaratorDoubleBuilder
    {
        return new PtrDeclaratorDoubleBuilder($testCase);
    }
    
    /**
     * Creates a double builder of the {@see PhpCode\Language\Cpp\Declarator\NoptrDeclarator} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  NoptrDeclaratorDoubleBuilder    The created instance of NoptrDeclaratorDoubleBuilder.
     */
    public static function createNoptrDeclarator(TestCase $testCase): NoptrDeclaratorDoubleBuilder
    {
        return new NoptrDeclaratorDoubleBuilder($testCase);
    }
    
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
    
    /**
     * Creates a double builder of the {@see PhpCode\Language\Cpp\Declarator\CVQualifierSequence} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  CVQualifierSequenceDoubleBuilder    The created instance of CVQualifierSequenceDoubleBuilder.
     */
    public static function createCVQualifierSequence(TestCase $testCase): CVQualifierSequenceDoubleBuilder
    {
        return new CVQualifierSequenceDoubleBuilder($testCase);
    }
    
    /**
     * Creates a double builder of the {@see PhpCode\Language\Cpp\Declaration\DefiningTypeSpecifier} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  DefiningTypeSpecifierDoubleBuilder  The created instance of DefiningTypeSpecifierDoubleBuilder.
     */
    public static function createDefiningTypeSpecifier(TestCase $testCase): DefiningTypeSpecifierDoubleBuilder
    {
        return new DefiningTypeSpecifierDoubleBuilder($testCase);
    }
    
    /**
     * Creates a double builder of the {@see PhpCode\Language\Cpp\Declaration\TypeSpecifier} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  TypeSpecifierDoubleBuilder  The created instance of TypeSpecifierDoubleBuilder.
     */
    public static function createTypeSpecifier(TestCase $testCase): TypeSpecifierDoubleBuilder
    {
        return new TypeSpecifierDoubleBuilder($testCase);
    }
    
    /**
     * Creates a double builder of the {@see PhpCode\Language\Cpp\Declaration\SimpleTypeSpecifier} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  SimpleTypeSpecifierDoubleBuilder    The created instance of SimpleTypeSpecifierDoubleBuilder.
     */
    public static function createSimpleTypeSpecifier(TestCase $testCase): SimpleTypeSpecifierDoubleBuilder
    {
        return new SimpleTypeSpecifierDoubleBuilder($testCase);
    }
}

