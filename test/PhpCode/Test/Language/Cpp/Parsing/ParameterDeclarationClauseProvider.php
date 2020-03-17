<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Parsing;

use PhpCode\Test\Language\Cpp\CallableConceptConstraintFactory;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationClauseConstraint;

/**
 * Represents the data provider related to parameter declaration clauses.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationClauseProvider
{
    /**
     * Returns a set of valid data for the provider.
     * 
     * @return  ValidData[]
     */
    public static function createValidDataSetProvider(): array
    {
        $dataSet = [];
        
        $dataSet[] = self::createEmptyStringValidData();
        $dataSet[] = self::createEllipsisValidData();
        
        foreach (ParameterDeclarationListProvider::createValidDataSet() as $data) {
            $dataSet[] = self::createListValidData($data);
            $dataSet[] = self::createListEllipsisValidData($data);
            $dataSet[] = self::createListWSEllipsisValidData($data);
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
     * EMPTY_STRING
     * 
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createEmptyStringValidData(): ValidData
    {
        $stream = '';
        
        $callable = function () {
            return new ParameterDeclarationClauseConstraint();
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        return new ValidData($stream, $factory);
    }
    
    /**
     * Creates a valid data for the case:
     * ELLIPSIS
     * 
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createEllipsisValidData(): ValidData
    {
        $stream = '...';
        
        $callable = function () {
            $const = new ParameterDeclarationClauseConstraint();
            $const->addEllipsis();
            
            return $const;
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory);
        $data->setName('...');
        
        return $data;
    }
    
    /**
     * Creates a valid data for the case:
     * PRM_DECL_LIST
     * 
     * @param   ValidData   $listData   The parameter declaration list data used to create the data.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createListValidData(ValidData $listData): ValidData
    {
        $stream = $listData->getStream();
        
        $listFactory = $listData->getConstraintFactory();
        $callable = function () use ($listFactory) {
            $const = new ParameterDeclarationClauseConstraint();
            $const->setParameterDeclarationListConstraint(
                $listFactory->createConstraint()
            );
            
            return $const;
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory);
        
        $data->setName($listData->getName());
        
        return $data;
    }
    
    /**
     * Creates a valid data for the case:
     * PRM_DECL_LIST COMMA ELLIPSIS
     * 
     * @param   ValidData   $listData   The parameter declaration list data used to create the data.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createListEllipsisValidData(ValidData $listData): ValidData
    {
        $stream = \sprintf('%s, ...', $listData->getStream());
        
        $listFactory = $listData->getConstraintFactory();
        $callable = function () use ($listFactory) {
            $const = new ParameterDeclarationClauseConstraint();
            $const->addEllipsis();
            $const->setParameterDeclarationListConstraint(
                $listFactory->createConstraint()
            );
            
            return $const;
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory);
        
        $data->setName(\sprintf('%s, ...', $listData->getName()));
        
        return $data;
    }
    
    /**
     * Creates a valid data for the case:
     * PRM_DECL_LIST WS ELLIPSIS
     * 
     * @param   ValidData   $listData   The parameter declaration list data used to create the data.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createListWSEllipsisValidData(ValidData $listData): ValidData
    {
        $stream = \sprintf('%s ...', $listData->getStream());
        
        $listFactory = $listData->getConstraintFactory();
        $callable = function () use ($listFactory) {
            $const = new ParameterDeclarationClauseConstraint();
            $const->addEllipsis();
            $const->setParameterDeclarationListConstraint(
                $listFactory->createConstraint()
            );
            
            return $const;
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory);
        
        $data->setName(\sprintf('%s ...', $listData->getName()));
        
        return $data;
    }
}

