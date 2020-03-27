<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Parsing;

use PhpCode\Test\Language\Cpp\CallableConceptConstraintFactory;
use PhpCode\Test\Language\Cpp\Declarator\DeclaratorConstraint;
use PhpCode\Test\Language\Cpp\Declarator\PtrDeclaratorConstraint;
use PhpCode\Test\Language\Cpp\Declarator\NoptrDeclaratorConstraint;

/**
 * Represents the data provider related to declarators.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclaratorProvider
{
    /**
     * Returns a set of valid data for the provider.
     * 
     * @return  ValidData[]
     */
    public static function createValidDataSetProvider(): array
    {
        $dataSet = [];
        
        $didDataSet = DeclaratorIdProvider::createValidDataSet();
        
        foreach ($didDataSet as $didData) {
            $dataSet[] = self::createNoOpenErrorValidData($didData);
            $dataSet[] = self::createCloseBeforeOpenErrorValidData($didData);
            $dataSet[] = self::createDeclaratorIdIdErrorValidData($didData);
        }
        
        $prmQualDataSet = ParametersAndQualifiersProvider::createValidDataSet();
        
        foreach ($didDataSet as $didData) {
            $dataSet[] = self::createNameValidData($didData);
            
            foreach ($prmQualDataSet as $prmQualData) {
                $dataSet[] = self::createNoptrDcltorValidData($didData, $prmQualData);
            }
        }
        
        return $dataSet;
    }
    
    /**
     * Creates a valid data for the case:
     * No open parenthesis
     * 
     * In other context, it should be an error.
     * 
     * @param   ValidData   $didData    The declarator identifier data used to create the data.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createNoOpenErrorValidData(ValidData $didData): ValidData
    {
        $stream = \sprintf('%s)', $didData->getStream());
        $firstTokenLexeme = $didData->getFirstTokenLexeme();
        
        $didFactory = $didData->getConstraintFactory();
        $callable = function () use ($didFactory) {
            return DeclaratorConstraint::createPtrDeclarator(
                new PtrDeclaratorConstraint(
                    NoptrDeclaratorConstraint::createDeclaratorId(
                        $didFactory->createConstraint()
                    )
                )
            );
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        
        $data->setToken(')', 208000);
        $data->setName('No open parenthesis');
        
        return $data;
    }
    
    /**
     * Creates a valid data for the case:
     * Close parenthesis before open parenthesis
     * 
     * In other context, it should be an error.
     * 
     * @param   ValidData   $didData    The declarator identifier data used to create the data.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createCloseBeforeOpenErrorValidData(ValidData $didData): ValidData
    {
        $stream = \sprintf('%s)(', $didData->getStream());
        $firstTokenLexeme = $didData->getFirstTokenLexeme();
        
        $didFactory = $didData->getConstraintFactory();
        $callable = function () use ($didFactory) {
            return DeclaratorConstraint::createPtrDeclarator(
                new PtrDeclaratorConstraint(
                    NoptrDeclaratorConstraint::createDeclaratorId(
                        $didFactory->createConstraint()
                    )
                )
            );
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        
        $data->setToken(')', 208000);
        $data->setName('Close parenthesis before open parenthesis');
        
        return $data;
    }
    
    /**
     * Creates a valid data for the case:
     * Identifier after declarator identifier
     * 
     * In other context, it should be an error.
     * 
     * @param   ValidData   $didData    The declarator identifier data used to create the data.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createDeclaratorIdIdErrorValidData(ValidData $didData): ValidData
    {
        $stream = \sprintf('%s foo', $didData->getStream());
        $firstTokenLexeme = $didData->getFirstTokenLexeme();
        
        $didFactory = $didData->getConstraintFactory();
        $callable = function () use ($didFactory) {
            return DeclaratorConstraint::createPtrDeclarator(
                new PtrDeclaratorConstraint(
                    NoptrDeclaratorConstraint::createDeclaratorId(
                        $didFactory->createConstraint()
                    )
                )
            );
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        
        $data->setToken('foo', 2);
        $data->setName('Identifier after declarator identifier');
        
        return $data;
    }
    
    /**
     * Creates a valid data for the case:
     * DECLARATOR_ID
     * 
     * @param   ValidData   $didData    The declarator identifier data used to create the data.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createNameValidData(ValidData $didData): ValidData
    {
        $stream = $didData->getStream();
        $firstTokenLexeme = $didData->getFirstTokenLexeme();
        
        $didFactory = $didData->getConstraintFactory();
        $callable = function () use ($didFactory) {
            return DeclaratorConstraint::createPtrDeclarator(
                new PtrDeclaratorConstraint(
                    NoptrDeclaratorConstraint::createDeclaratorId(
                        $didFactory->createConstraint()
                    )
                )
            );
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        $data->setName($didData->getName());
        
        return $data;
    }
    
    /**
     * Creates a valid data for the case:
     * DECLARATOR_ID PARAMETERS_AND_QUALIFIERS
     * 
     * @param   ValidData   $didData        The declarator identifier data used to create the data.
     * @param   ValidData   $prmQualData    The parameters and qualifiers data used to create the data.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createNoptrDcltorValidData(
        ValidData $didData, 
        ValidData $prmQualData
    ): ValidData
    {
        $stream = \sprintf(
            '%s%s', 
            $didData->getStream(), 
            $prmQualData->getStream()
        );
        $firstTokenLexeme = $didData->getFirstTokenLexeme();
        
        $didFactory = $didData->getConstraintFactory();
        $prmQualFactory = $prmQualData->getConstraintFactory();
        $callable = function () use ($didFactory, $prmQualFactory) {
            return DeclaratorConstraint::createPtrDeclarator(
                new PtrDeclaratorConstraint(
                    NoptrDeclaratorConstraint::createDeclaratorIdParametersAndQualifiers(
                        $didFactory->createConstraint(), 
                        $prmQualFactory->createConstraint()
                    )
                )
            );
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        $data->setName(\sprintf(
            '%s %s', 
            $didData->getName(), 
            $prmQualData->getName()
        ));
        
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
        
        foreach (NestedNameSpecifierProvider::createValidDataSet() as $nnSpecData) {
            $dataSet[] = self::createNestedNameSpecifierInvalidData($nnSpecData);
        }
        
        // Add parameters and qualifiers invalid data.
        
        $didDataSet = DeclaratorIdProvider::createValidDataSet();
        $prmQualInvalidDataSet = ParametersAndQualifiersProvider::createInvalidDataSet();
        
        foreach ($didDataSet as $didData) {
            foreach ($prmQualInvalidDataSet as $prmQualInvalidData) {
                $dataSet[] = self::createDIdPrmQualInvalidData($didData, $prmQualInvalidData);
            }
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
        $message = 'Unexpected "", expected identifier.';
        
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
    private static function createNestedNameSpecifierInvalidData(ValidData $nnSpecData): InvalidData
    {
        $stream = $nnSpecData->getStream();
        $message = 'Unexpected "", expected identifier.';
        
        $data = new InvalidData($stream, $message);
        
        $data->setName($nnSpecData->getName());
        
        return $data;
    }
    
    /**
     * Creates an invalid data for the case:
     * DECLARATOR_ID PARAMETERS_AND_QUALIFIERS_INVALID
     * 
     * @param   ValidData   $didData        The declarator identifier data used to create the data.
     * @param   InvalidData $prmQualData    The parameters and qualifiers data used to create the data.
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createDIdPrmQualInvalidData(
        ValidData $didData, 
        InvalidData $prmQualData
    ): InvalidData
    {
        $stream = \sprintf(
            '%s%s', 
            $didData->getStream(), 
            $prmQualData->getStream()
        );
        $message = $prmQualData->getExceptionMessage();
        
        $data = new InvalidData($stream, $message);
        
        $data->setName($prmQualData->getName());
        
        return $data;
    }
}

