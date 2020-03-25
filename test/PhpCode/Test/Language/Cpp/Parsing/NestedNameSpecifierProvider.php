<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Parsing;

use PhpCode\Test\Language\Cpp\CallableConceptConstraintFactory;
use PhpCode\Test\Language\Cpp\Expression\NestedNameSpecifierConstraint;
use PhpCode\Test\Language\Cpp\Lexical\IdentifierConstraint;

/**
 * Represents the data provider related to nested name specifiers.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NestedNameSpecifierProvider
{
    /**
     * Returns a set of valid data.
     * 
     * @return  ValidData[]
     */
    public static function createValidDataSet(): array
    {
        $dataSet = [];
        
        $dataSet[] = self::createIdScopeValidData();
        $dataSet[] = self::createIdScopeIdScopeValidData();
        
        return $dataSet;
    }
    
    /**
     * Creates a valid data for the case:
     * ID ::
     * 
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createIdScopeValidData(): ValidData
    {
        $stream = 'nns_id1::';
        $firstTokenLexeme = 'nns_id1';
        
        $callable = function(){
            $nnSpecConst = new NestedNameSpecifierConstraint();
            $nnSpecConst->addIdentifierConstraint(new IdentifierConstraint('nns_id1'));
            
            return $nnSpecConst;
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        $data->setName('ID ::');
        
        return $data;
    }
    
    /**
     * Creates a valid data for the case:
     * ID :: ID ::
     * 
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createIdScopeIdScopeValidData(): ValidData
    {
        $stream = 'nns_id1::nns_id2::';
        $firstTokenLexeme = 'nns_id1';
        
        $callable = function(){
            $nnSpecConst = new NestedNameSpecifierConstraint();
            $nnSpecConst->addIdentifierConstraint(new IdentifierConstraint('nns_id1'));
            $nnSpecConst->addIdentifierConstraint(new IdentifierConstraint('nns_id2'));
            
            return $nnSpecConst;
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        $data->setName('ID :: ID ::');
        
        return $data;
    }
}

