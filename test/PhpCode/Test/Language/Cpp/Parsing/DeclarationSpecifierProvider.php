<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Parsing;

use PhpCode\Test\Language\Cpp\CallableConceptConstraintFactory;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierConstraint;

/**
 * Represents the data provider related to declaration specifiers.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclarationSpecifierProvider
{
    /**
     * Returns a set of valid data for the provider.
     * 
     * @return  ValidData[]
     */
    public static function createValidDataSetProvider(): array
    {
        $dataSet = [];
        
        foreach (self::getSpecifications() as list($text, $callable)) {
            $dataSet[] = self::createDeclSpecValidData($text, $callable);
            $dataSet[] = self::createDeclSpecWSPunctuatorValidData($text, $callable);
            $dataSet[] = self::createDeclSpecWSIdentifierValidData($text, $callable);
        }
        
        return $dataSet;
    }
    
    /**
     * Returns a set of valid data.
     * 
     * @return  ValidData[]
     */
    public static function createValidDataSet(): array
    {
        $dataSet = [];
        
        foreach (self::getSpecifications() as list($text, $callable)) {
            $dataSet[] = self::createDeclSpecValidData($text, $callable);
        }
        
        return $dataSet;
    }
    
    /**
     * Returns the declaration specifier specifications.
     * 
     * @return  array[] An indexed array of arrays where:
     *                  [0] is the text used to create a stream, and 
     *                  [1] is the callable used to create the constraint.
     */
    private static function getSpecifications(): array
    {
        return [
            [ 
                'int', 
                function() {
                    return DeclarationSpecifierConstraint::createInt();
                }, 
            ], 
        ];
    }
    
    /**
     * Creates a valid data for the case:
     * DECL_SPEC
     * 
     * @param   string      $text       The text used to create a stream.
     * @param   callable    $callable   The callable used to create a constraint.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createDeclSpecValidData(string $text, callable $callable): ValidData
    {
        $stream = $text;
        $factory = new CallableConceptConstraintFactory($callable);
        
        return new ValidData($stream, $factory);
    }
    
    /**
     * Creates a valid data for the case:
     * DECL_SPEC WS PUNCTUATOR
     * 
     * @param   string      $text       The text used to create a stream.
     * @param   callable    $callable   The callable used to create a constraint.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createDeclSpecWSPunctuatorValidData(
        string $text, 
        callable $callable
    ): ValidData
    {
        $stream = \sprintf('%s #', $text);
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory);
        $data->setToken('#', 205000);

        return $data;
    }
    
    /**
     * Creates a valid data for the case:
     * DECL_SPEC WS IDENTIFIER
     * 
     * @param   string      $text       The text used to create a stream.
     * @param   callable    $callable   The callable used to create a constraint.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createDeclSpecWSIdentifierValidData(
        string $text, 
        callable $callable
    ): ValidData
    {
        $stream = \sprintf('%s foobarbaz', $text);
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory);
        $data->setToken('foobarbaz', 2);
        
        return $data;
    }
}

