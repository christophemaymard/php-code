<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Parsing;

use PhpCode\Exception\InvalidOperationException;
use PhpCode\Test\Language\Cpp\CallableConceptConstraintFactory;
use PhpCode\Test\Language\Cpp\Declarator\CVQualifierConstraint;
use PhpCode\Test\Language\Cpp\Declarator\CVQualifierSequenceConstraint;

/**
 * Represents the data provider related to constant/volatile qualifier 
 * sequences.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class CVQualifierSequenceProvider
{
    /**
     * Returns a set of valid data.
     * 
     * @return  ValidData[]
     */
    public static function createValidDataSet(): array
    {
        $dataSet = [];
        $dataSet[] = self::createConstValidData();
        $dataSet[] = self::createVolatileValidData();
        $dataSet[] = self::createConstVolatileValidData();
        $dataSet[] = self::createVolatileConstValidData();
        
        return $dataSet;
    }
    
    /**
     * Creates a valid data for the case:
     * const
     * 
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createConstValidData(): ValidData
    {
        $stream = 'const';
        $firstTokenLexeme = 'const';
        
        $callable = function () {
            return new CVQualifierSequenceConstraint([
                CVQualifierConstraint::createConst(), 
            ]);
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        $data->setName('CV_QUAL_SEQ');
        
        return $data;
    }
    
    /**
     * Creates a valid data for the case:
     * volatile
     * 
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createVolatileValidData(): ValidData
    {
        $stream = 'volatile';
        $firstTokenLexeme = 'volatile';
        
        $callable = function () {
            return new CVQualifierSequenceConstraint([
                CVQualifierConstraint::createVolatile(), 
            ]);
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        $data->setName('CV_QUAL_SEQ');
        
        return $data;
    }
    
    /**
     * Creates a valid data for the case:
     * const volatile
     * 
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createConstVolatileValidData(): ValidData
    {
        $stream = 'const volatile';
        $firstTokenLexeme = 'const';
        
        $callable = function () {
            return new CVQualifierSequenceConstraint([
                CVQualifierConstraint::createConst(), 
                CVQualifierConstraint::createVolatile(), 
            ]);
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        $data->setName('CV_QUAL_SEQ');
        
        return $data;
    }
    
    /**
     * Creates a valid data for the case:
     * volatile const
     * 
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createVolatileConstValidData(): ValidData
    {
        $stream = 'volatile const';
        $firstTokenLexeme = 'volatile';
        
        $callable = function () {
            return new CVQualifierSequenceConstraint([
                CVQualifierConstraint::createVolatile(), 
                CVQualifierConstraint::createConst(), 
            ]);
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        $data->setName('CV_QUAL_SEQ');
        
        return $data;
    }
    
    /**
     * Returns a set of invalid data.
     * 
     * @return  InvalidData[]
     */
    public static function createInvalidDataSet(): array
    {
        $dataSet = [];
        
        $dataSet[] = self::createDupConstConstConstInvalidData();
        $dataSet[] = self::createDupConstConstVolatileConstInvalidData();
        
        $dataSet[] = self::createDupVolatileVolatileVolatileInvalidData();
        $dataSet[] = self::createDupVolatileVolatileConstVolatileInvalidData();
        
        return $dataSet;
    }
    
    /**
     * Creates an invalid data for the case:
     * const const
     * 
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createDupConstConstConstInvalidData(): InvalidData
    {
        $stream = 'const const';
        $message = 'Duplicate constant/volatile qualifier defined as constant.';
        
        $data = new InvalidData($stream, $message);
        $data->setExceptionName(InvalidOperationException::class);
        
        $data->setName('Duplicate const');
        
        return $data;
    }
    
    /**
     * Creates an invalid data for the case:
     * const volatile const
     * 
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createDupConstConstVolatileConstInvalidData(): InvalidData
    {
        $stream = 'const volatile const';
        $message = 'Duplicate constant/volatile qualifier defined as constant.';
        
        $data = new InvalidData($stream, $message);
        $data->setExceptionName(InvalidOperationException::class);
        
        $data->setName('Duplicate const');
        
        return $data;
    }
    
    /**
     * Creates an invalid data for the case:
     * volatile volatile
     * 
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createDupVolatileVolatileVolatileInvalidData(): InvalidData
    {
        $stream = 'volatile volatile';
        $message = 'Duplicate constant/volatile qualifier defined as volatile.';
        
        $data = new InvalidData($stream, $message);
        $data->setExceptionName(InvalidOperationException::class);
        
        $data->setName('Duplicate volatile');
        
        return $data;
    }
    
    /**
     * Creates an invalid data for the case:
     * volatile const volatile
     * 
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createDupVolatileVolatileConstVolatileInvalidData(): InvalidData
    {
        $stream = 'volatile const volatile';
        $message = 'Duplicate constant/volatile qualifier defined as volatile.';
        
        $data = new InvalidData($stream, $message);
        $data->setExceptionName(InvalidOperationException::class);
        
        $data->setName('Duplicate volatile');
        
        return $data;
    }
}

