<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp;

use PhpCode\Test\Language\Cpp\Declarator\CVQualifierConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\CVQualifierSequenceConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\DeclaratorIdConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\NoptrDeclaratorConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\ParametersAndQualifiersConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\PtrDeclaratorConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\PtrOperatorConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\Expression\IdExpressionConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\Expression\NestedNameSpecifierConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\Expression\QualifiedIdConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\Expression\UnqualifiedIdConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\Lexical\IdentifierConstraintDoubleBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Represents a factory of concept constraint double builders.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ConceptConstraintDoubleBuilder
{
    /**
     * Creates a double constraint builder of the {@see PhpCode\Test\Language\Cpp\Declarator\PtrDeclaratorConstraint} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  PtrDeclaratorConstraintDoubleBuilder    The created instance of PtrDeclaratorConstraintDoubleBuilder.
     */
    public static function createPtrDeclaratorConstraint(TestCase $testCase): PtrDeclaratorConstraintDoubleBuilder
    {
        return new PtrDeclaratorConstraintDoubleBuilder($testCase);
    }
    
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
    
    /**
     * Creates a double constraint builder of the {@see PhpCode\Test\Language\Cpp\Declarator\PtrOperatorConstraint} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  PtrOperatorConstraintDoubleBuilder  The created instance of PtrOperatorConstraintDoubleBuilder.
     */
    public static function createPtrOperatorConstraint(TestCase $testCase): PtrOperatorConstraintDoubleBuilder
    {
        return new PtrOperatorConstraintDoubleBuilder($testCase);
    }
    
    /**
     * Creates a double constraint builder of the {@see PhpCode\Test\Language\Cpp\Declarator\CVQualifierSequenceConstraint} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  CVQualifierSequenceConstraintDoubleBuilder  The created instance of CVQualifierSequenceConstraintDoubleBuilder.
     */
    public static function createCVQualifierSequenceConstraint(TestCase $testCase): CVQualifierSequenceConstraintDoubleBuilder
    {
        return new CVQualifierSequenceConstraintDoubleBuilder($testCase);
    }
    
    /**
     * Creates a double constraint builder of the {@see PhpCode\Test\Language\Cpp\Declarator\CVQualifierConstraint} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  CVQualifierConstraintDoubleBuilder  The created instance of CVQualifierConstraintDoubleBuilder.
     */
    public static function createCVQualifierConstraint(TestCase $testCase): CVQualifierConstraintDoubleBuilder
    {
        return new CVQualifierConstraintDoubleBuilder($testCase);
    }
    
    /**
     * Creates a double constraint builder of the {@see PhpCode\Test\Language\Cpp\Expression\UnqualifiedIdConstraint} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  IdExpressionConstraintDoubleBuilder The created instance of IdExpressionConstraintDoubleBuilder.
     */
    public static function createIdExpressionConstraint(TestCase $testCase): IdExpressionConstraintDoubleBuilder
    {
        return new IdExpressionConstraintDoubleBuilder($testCase);
    }
    
    /**
     * Creates a double constraint builder of the {@see PhpCode\Test\Language\Cpp\Expression\UnqualifiedIdConstraint} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  UnqualifiedIdConstraintDoubleBuilder    The created instance of UnqualifiedIdConstraintDoubleBuilder.
     */
    public static function createUnqualifiedIdConstraint(TestCase $testCase): UnqualifiedIdConstraintDoubleBuilder
    {
        return new UnqualifiedIdConstraintDoubleBuilder($testCase);
    }
    
    /**
     * Creates a double constraint builder of the {@see PhpCode\Test\Language\Cpp\Expression\QualifiedIdConstraint} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  QualifiedIdConstraintDoubleBuilder  The created instance of QualifiedIdConstraintDoubleBuilder.
     */
    public static function createQualifiedIdConstraint(TestCase $testCase): QualifiedIdConstraintDoubleBuilder
    {
        return new QualifiedIdConstraintDoubleBuilder($testCase);
    }
    
    /**
     * Creates a double constraint builder of the {@see PhpCode\Test\Language\Cpp\Expression\NestedNameSpecifierConstraint} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  NestedNameSpecifierConstraintDoubleBuilder  The created instance of NestedNameSpecifierConstraintDoubleBuilder.
     */
    public static function createNestedNameSpecifierConstraint(TestCase $testCase): NestedNameSpecifierConstraintDoubleBuilder
    {
        return new NestedNameSpecifierConstraintDoubleBuilder($testCase);
    }
    
    /**
     * Creates a double constraint builder of the {@see PhpCode\Test\Language\Cpp\Lexical\IdentifierConstraint} 
     * class.
     * 
     * @param   TestCase    $testCase   The test case used to prophesize a class or an interface.
     * @return  IdentifierConstraintDoubleBuilder   The created instance of IdentifierConstraintDoubleBuilder.
     */
    public static function createIdentifierConstraint(TestCase $testCase): IdentifierConstraintDoubleBuilder
    {
        return new IdentifierConstraintDoubleBuilder($testCase);
    }
}

