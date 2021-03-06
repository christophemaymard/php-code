<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Parsing;

use PhpCode\Test\Language\Cpp\CallableConceptConstraintFactory;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierSequenceConstraint;

/**
 * Represents the data provider related to declaration specifier sequences.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclarationSpecifierSequenceProvider
{
    /**
     * Returns a set of valid data for the provider.
     * 
     * @return  ValidData[]
     */
    public static function createValidDataSetProvider(): array
    {
        $dataSet = [];
        
        // Sequence of one declaration specifier.
        foreach (DeclarationSpecifierProvider::createValidDataSet() as $data) {
            $dataSet[] = self::createSeq1ValidData($data);
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
        return self::createValidDataSetProvider();
    }
    
    /**
     * Creates a valid data for the case:
     * DECL_SPEC
     * 
     * @param   ValidData   $declSpecData   The declaration specifier data used to create the data.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createSeq1ValidData(ValidData $declSpecData): ValidData
    {
        $stream = $declSpecData->getStream();
        $firstTokenLexeme = $declSpecData->getFirstTokenLexeme();
        
        $declSpecFactory = $declSpecData->getConstraintFactory();
        $callable = function() use ($declSpecFactory) {
            return DeclarationSpecifierSequenceConstraint::create([
                $declSpecFactory->createConstraint()
            ]);
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        
        $data->setName('DECL_SPEC_SEQ1');
        
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
        
        // Add declaration specifier invalid data.
        
        foreach (DeclarationSpecifierProvider::createInvalidDataSet() as $declSpecInvalidData) {
            $dataSet[] = $declSpecInvalidData;
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
}

