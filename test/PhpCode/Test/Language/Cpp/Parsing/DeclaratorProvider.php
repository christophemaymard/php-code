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
        $prmQualDataSet = ParametersAndQualifiersProvider::createValidDataSet();
        
        $dataSet = [];
        
        foreach (DeclaratorIdProvider::createValidDataSet() as $didData) {
            $dataSet[] = self::createNameValidData($didData);
            
            foreach ($prmQualDataSet as $prmQualData) {
                $dataSet[] = self::createNoptrDcltorValidData($didData, $prmQualData);
            }
        }
        
        return $dataSet;
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
        
        $data = new ValidData($stream, $factory);
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
        
        $data = new ValidData($stream, $factory);
        $data->setName(\sprintf(
            '%s %s', 
            $didData->getName(), 
            $prmQualData->getName()
        ));
        
        return $data;
        
    }
}

