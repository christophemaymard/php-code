<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Parsing;

use PhpCode\Test\Language\Cpp\CallableConceptConstraintFactory;
use PhpCode\Test\Language\Cpp\Declarator\ParametersAndQualifiersConstraint;

/**
 * Represents the data provider related to parameters and qualifiers.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParametersAndQualifiersProvider
{
    /**
     * Returns a set of valid data for the provider.
     * 
     * @return  ValidData[]
     */
    public static function createValidDataSetProvider(): array
    {
        $dataSet = [];
        
        foreach (ParameterDeclarationClauseProvider::createValidDataSet() as $data) {
            $dataSet[] = self::createPrmDeclClauseValidData($data);
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
     * ( PRM_DECL_CLAUSE )
     * 
     * @param   ValidData   $clauseData The parameter declaration clause data used to create the data.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createPrmDeclClauseValidData(ValidData $clauseData): ValidData
    {
        $stream = \sprintf('(%s)', $clauseData->getStream());
        $firstTokenLexeme = '(';
        
        $clauseFactory = $clauseData->getConstraintFactory();
        $callable = function () use ($clauseFactory) {
            return new ParametersAndQualifiersConstraint(
                $clauseFactory->createConstraint()
            );
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        $data->setName(\sprintf(
            '( %s )', 
            $clauseData->getName()
        ));
        
        return $data;
    }
}

