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
use PhpCode\Test\Language\Cpp\Lexical\IdentifierConstraint;

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
        
        foreach (self::getSpecifications() as list($text, $callable, $firstTokenLexeme)) {
            $dataSet[] = self::createDeclSpecValidData($text, $callable, $firstTokenLexeme);
            $dataSet[] = self::createDeclSpecWSPunctuatorValidData($text, $callable, $firstTokenLexeme);
            $dataSet[] = self::createDeclSpecWSIdentifierValidData($text, $callable, $firstTokenLexeme);
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
        
        foreach (self::getSpecifications() as list($text, $callable, $firstTokenLexeme)) {
            $dataSet[] = self::createDeclSpecValidData($text, $callable, $firstTokenLexeme);
        }
        
        return $dataSet;
    }
    
    /**
     * Returns the declaration specifier specifications.
     * 
     * @return  array[] An indexed array of arrays where:
     *                  [0] is the text used to create a stream, 
     *                  [1] is the callable used to create the constraint, and 
     *                  [2] is the lexeme of the first token.
     */
    private static function getSpecifications(): array
    {
        $specifications = [
            [ 
                'int', 
                function() {
                    return DeclarationSpecifierConstraint::createInt();
                }, 
                'int', 
            ], 
            [ 
                'float', 
                function() {
                    return DeclarationSpecifierConstraint::createFloat();
                }, 
                'float', 
            ], 
            [
                'bool', 
                function() {
                    return DeclarationSpecifierConstraint::createBool();
                }, 
                'bool', 
            ], 
            [
                'char', 
                function() {
                    return DeclarationSpecifierConstraint::createChar();
                }, 
                'char', 
            ], 
            [
                'wchar_t', 
                function() {
                    return DeclarationSpecifierConstraint::createWCharT();
                }, 
                'wchar_t', 
            ], 
            [
                'short', 
                function() {
                    return DeclarationSpecifierConstraint::createShort();
                }, 
                'short', 
            ], 
            [
                'long', 
                function() {
                    return DeclarationSpecifierConstraint::createLong();
                }, 
                'long', 
            ], 
            [
                'signed', 
                function() {
                    return DeclarationSpecifierConstraint::createSigned();
                }, 
                'signed', 
            ], 
            [
                'unsigned', 
                function() {
                    return DeclarationSpecifierConstraint::createUnsigned();
                }, 
                'unsigned', 
            ], 
            [
                'double', 
                function() {
                    return DeclarationSpecifierConstraint::createDouble();
                }, 
                'double', 
            ], 
            [
                'declspec_id1', 
                function() {
                    return DeclarationSpecifierConstraint::createIdentifier(
                        new IdentifierConstraint('declspec_id1')
                    );
                }, 
                'declspec_id1', 
            ], 
        ];
        
        // Qualified identifiers.
        foreach (NestedNameSpecifierProvider::createValidDataSet() as $nnSpecData) {
            $stream = \sprintf('%squal_id', $nnSpecData->getStream());
            $firstTokenLexeme = $nnSpecData->getFirstTokenLexeme();
            
            $nnSpecFactory = $nnSpecData->getConstraintFactory();
            $callable = function() use ($nnSpecFactory) {
                return DeclarationSpecifierConstraint::createQualifiedIdentifier(
                    $nnSpecFactory->createConstraint(), 
                    new IdentifierConstraint('qual_id')
                );
            };
            
            $specifications[] = [
                $stream, 
                $callable, 
                $firstTokenLexeme, 
            ];
        }
        
        return $specifications;
    }
    
    /**
     * Creates a valid data for the case:
     * DECL_SPEC
     * 
     * @param   string      $text               The text used to create a stream.
     * @param   callable    $callable           The callable used to create a constraint.
     * @param   string      $firstTokenLexeme   The lexeme of the first token.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createDeclSpecValidData(
        string $text, 
        callable $callable, 
        string $firstTokenLexeme
    ): ValidData
    {
        $stream = $text;
        $factory = new CallableConceptConstraintFactory($callable);
        
        return new ValidData($stream, $factory, $firstTokenLexeme);
    }
    
    /**
     * Creates a valid data for the case:
     * DECL_SPEC WS PUNCTUATOR
     * 
     * @param   string      $text               The text used to create a stream.
     * @param   callable    $callable           The callable used to create a constraint.
     * @param   string      $firstTokenLexeme   The lexeme of the first token.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createDeclSpecWSPunctuatorValidData(
        string $text, 
        callable $callable, 
        string $firstTokenLexeme
    ): ValidData
    {
        $stream = \sprintf('%s #', $text);
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        $data->setToken('#', 205000);

        return $data;
    }
    
    /**
     * Creates a valid data for the case:
     * DECL_SPEC WS IDENTIFIER
     * 
     * @param   string      $text               The text used to create a stream.
     * @param   callable    $callable           The callable used to create a constraint.
     * @param   string      $firstTokenLexeme   The lexeme of the first token.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createDeclSpecWSIdentifierValidData(
        string $text, 
        callable $callable, 
        string $firstTokenLexeme
    ): ValidData
    {
        $stream = \sprintf('%s foobarbaz', $text);
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        $data->setToken('foobarbaz', 2);
        
        return $data;
    }
    
    /**
     * Returns a set of invalid data for the provider.
     * 
     * @return  InvalidData[]
     */
    public static function createInvalidDataSetProvider(): array
    {
        $dataSet = [];
        
        $dataSet[] = self::createEmptyInvalidData();
        
        foreach (self::createInvalidDataSet() as $invalidData) {
            $dataSet[] = $invalidData;
        }
        
        return $dataSet;
    }
    
    /**
     * Returns a set of invalid data.
     * 
     * @return  InvalidData[]
     */
    public static function createInvalidDataSet(): array
    {
        $dataSet = [];
        
        foreach (NestedNameSpecifierProvider::createValidDataSet() as $nnSpecData) {
            $dataSet[] = self::createNestedNameInvalidData($nnSpecData);
        }
        
        return $dataSet;
    }
    
    /**
     * Creates an invalid data for the case:
     * Empty string
     * 
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createEmptyInvalidData(): InvalidData
    {
        $stream = '';
        $message = 'Unexpected "", expected decl-specifier.';
        
        $data = new InvalidData($stream, $message);
        
        $data->setName('Empty string');
        
        return $data;
    }
    
    /**
     * Creates an invalid data for the case:
     * NESTED_NAME_SPECIFIER
     * 
     * @param   ValidData   $nnSpecData The nested name specifier data used to create the data.
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createNestedNameInvalidData(
        ValidData $nnSpecData
    ): InvalidData
    {
        $stream = $nnSpecData->getStream();
        $message = 'Unexpected "", expected identifier.';
        
        $data = new InvalidData($stream, $message);
        
        $data->setName('Qualified name with nested name specifier and no identifier');
        
        return $data;
    }
}

