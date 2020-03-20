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
            '%s, %s, %s', 
            $prmDeclName, 
            $prmDeclName, 
            $prmDeclName, 
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
}

