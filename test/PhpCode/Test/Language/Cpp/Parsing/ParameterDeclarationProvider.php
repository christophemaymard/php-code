<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Parsing;

use PhpCode\Test\Language\Cpp\CallableConceptConstraintFactory;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationConstraint;

/**
 * Represents the data provider related to parameter declarations.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationProvider
{
    /**
     * Returns a set of valid data for the provider.
     * 
     * @return  ValidData[]
     */
    public static function createValidDataSetProvider(): array
    {
        $dataSet = [];
        
        foreach (DeclarationSpecifierSequenceProvider::createValidDataSet() as $declSpecSeqData) {
            $dataSet[] = self::createDeclSpecSeqValidData($declSpecSeqData);
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
     * DECL_SPEC_SEQ
     * 
     * @param   ValidData   $declSpecSeqData   The declaration specifier sequence data used to create the data.
     * @param   string      $text       The text used to create a stream.
     * @param   callable    $callable   The callable used to create a constraint.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createDeclSpecSeqValidData(ValidData $declSpecSeqData): ValidData
    {
        $stream = $declSpecSeqData->getStream();
        
        $declSpecSeqFactory = $declSpecSeqData->getConstraintFactory();
        $callable = function() use ($declSpecSeqFactory) {
            return ParameterDeclarationConstraint::create(
                $declSpecSeqFactory->createConstraint()
            );
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory);
        
        $data->setName($declSpecSeqData->getName());
        
        return $data;
    }
}

