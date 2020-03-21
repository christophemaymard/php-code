<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Parsing;

use PhpCode\Test\Language\Cpp\CallableConceptConstraintFactory;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationListConstraint;

/**
 * Represents the data provider related to parameter declaration lists.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationListProvider
{
    /**
     * Returns a set of valid data for the provider.
     * 
     * @return  ValidData[]
     */
    public static function createValidDataSetProvider(): array
    {
        $dataSet = [];
        
        foreach (ParameterDeclarationProvider::createValidDataSet() as $data) {
            $dataSet[] = self::createPrmDeclValidData($data);
            $dataSet[] = self::create3PrmDeclValidData($data);
            
            $dataSet[] = self::create3PrmDeclEllipsisValidData($data);
            $dataSet[] = self::create3PrmDeclWSEllipsisValidData($data);
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
        
        foreach (ParameterDeclarationProvider::createValidDataSet() as $data) {
            $dataSet[] = self::createPrmDeclValidData($data);
            $dataSet[] = self::create3PrmDeclValidData($data);
        }
        
        return $dataSet;
    }
    
    /**
     * Creates a valid data for the case:
     * PRM_DECL
     * 
     * @param   ValidData   $prmDeclData    The parameter declaration data used to create the data.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createPrmDeclValidData(ValidData $prmDeclData): ValidData
    {
        $stream = $prmDeclData->getStream();
        $firstTokenLexeme = $prmDeclData->getFirstTokenLexeme();
        
        $prmDeclFactory = $prmDeclData->getConstraintFactory();
        $callable = function () use ($prmDeclFactory) {
            return new ParameterDeclarationListConstraint([
                $prmDeclFactory->createConstraint()
            ]);
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        
        $data->setName($prmDeclData->getName());
        
        return $data;
    }
    
    /**
     * Creates a valid data for the case:
     * PRM_DECL COMMA PRM_DECL COMMA PRM_DECL
     * 
     * @param   ValidData   $prmDeclData    The parameter declaration data used to create the data.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function create3PrmDeclValidData(ValidData $prmDeclData): ValidData
    {
        $prmDeclStream = $prmDeclData->getStream();
        
        $stream = \sprintf('%s,%s,%s', 
            $prmDeclStream, 
            $prmDeclStream, 
            $prmDeclStream
        );
        $firstTokenLexeme = $prmDeclData->getFirstTokenLexeme();
        
        $prmDeclFactory = $prmDeclData->getConstraintFactory();
        $callable = function () use ($prmDeclFactory) {
            return new ParameterDeclarationListConstraint([
                $prmDeclFactory->createConstraint(), 
                $prmDeclFactory->createConstraint(), 
                $prmDeclFactory->createConstraint(), 
            ]);
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        
        $prmDeclName = $prmDeclData->getName();
        $data->setName(\sprintf(
            '%s , %s , %s', 
            $prmDeclName, 
            $prmDeclName, 
            $prmDeclName
        ));
        
        return $data;
    }
    
    /**
     * Creates a valid data for the case:
     * PRM_DECL COMMA PRM_DECL COMMA PRM_DECL COMMA ELLIPSIS
     * 
     * @param   ValidData   $prmDeclData    The parameter declaration data used to create the data.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function create3PrmDeclEllipsisValidData(ValidData $prmDeclData): ValidData
    {
        $prmDeclStream = $prmDeclData->getStream();
        $stream = \sprintf('%s,%s,%s,...', 
            $prmDeclStream, 
            $prmDeclStream, 
            $prmDeclStream
        );
        $firstTokenLexeme = $prmDeclData->getFirstTokenLexeme();
        
        $prmDeclFactory = $prmDeclData->getConstraintFactory();
        $callable = function () use ($prmDeclFactory) {
            return new ParameterDeclarationListConstraint([
                $prmDeclFactory->createConstraint(), 
                $prmDeclFactory->createConstraint(), 
                $prmDeclFactory->createConstraint(), 
            ]);
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        
        $data->setToken(',', 249000);
        
        return $data;
    }
    
    /**
     * Creates a valid data for the case:
     * PRM_DECL COMMA PRM_DECL COMMA PRM_DECL WS ELLIPSIS
     * 
     * @param   ValidData   $prmDeclData    The parameter declaration data used to create the data.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function create3PrmDeclWSEllipsisValidData(ValidData $prmDeclData): ValidData
    {
        $prmDeclStream = $prmDeclData->getStream();
        $stream = \sprintf('%s,%s,%s ...', 
            $prmDeclStream, 
            $prmDeclStream, 
            $prmDeclStream
        );
        $firstTokenLexeme = $prmDeclData->getFirstTokenLexeme();
        
        $prmDeclFactory = $prmDeclData->getConstraintFactory();
        $callable = function () use ($prmDeclFactory) {
            return new ParameterDeclarationListConstraint([
                $prmDeclFactory->createConstraint(), 
                $prmDeclFactory->createConstraint(), 
                $prmDeclFactory->createConstraint(), 
            ]);
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        
        $data->setToken('...', 211000);
        
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
        
        foreach (ParameterDeclarationProvider::createValidDataSet() as $prmDeclData) {
            $dataSet[] = self::createFirstParamMissingInvalidData($prmDeclData);
            $dataSet[] = self::createSecondParamMissingInvalidData($prmDeclData);
            $dataSet[] = self::createLastParamMissingInvalidData($prmDeclData);
        }
        
        $dataSet[] = self::createEllipsisInvalidData();
        
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
     * The first parameter is missing
     * 
     * @param   ValidData   $prmDeclData    The parameter declaration data use to create the data.
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createFirstParamMissingInvalidData(
        ValidData $prmDeclData
    ): InvalidData
    {
        $stream = \sprintf(
            ',%s,%s', 
            $prmDeclData->getStream(), 
            $prmDeclData->getStream()
        );
        $message = 'Unexpected ",", expected decl-specifier.';
        
        $data = new InvalidData($stream, $message);
        
        $data->setName('First parameter is missing');
        
        return $data;
    }
    
    /**
     * Creates an invalid data for the case:
     * The second parameter is missing
     * 
     * @param   ValidData   $prmDeclData    The parameter declaration data use to create the data.
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createSecondParamMissingInvalidData(
        ValidData $prmDeclData
    ): InvalidData
    {
        $stream = \sprintf(
            '%s,,%s', 
            $prmDeclData->getStream(), 
            $prmDeclData->getStream()
        );
        $message = 'Unexpected ",", expected decl-specifier.';
        
        $data = new InvalidData($stream, $message);
        
        $data->setName('Second parameter is missing');
        
        return $data;
    }
    
    /**
     * Creates an invalid data for the case:
     * The last parameter is missing
     * 
     * @param   ValidData   $prmDeclData    The parameter declaration data use to create the data.
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createLastParamMissingInvalidData(
        ValidData $prmDeclData
    ): InvalidData
    {
        $stream = \sprintf(
            '%s,%s,', 
            $prmDeclData->getStream(), 
            $prmDeclData->getStream()
        );
        $message = 'Unexpected "", expected decl-specifier.';
        
        $data = new InvalidData($stream, $message);
        
        $data->setName('Last parameter is missing');
        
        return $data;
    }
    
    /**
     * Creates an invalid data for the case:
     * Ellipsis, parseParameterDeclarationList() must not be called when 
     * only ellipsis
     * 
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createEllipsisInvalidData(): InvalidData
    {
        $stream = '...';
        $message = 'Unexpected "...", expected decl-specifier.';
        
        $data = new InvalidData($stream, $message);
        
        $data->setName('Ellipsis, parseParameterDeclarationList() must not be called when only ellipsis');
        
        return $data;
    }
}

