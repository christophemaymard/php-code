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
    
    /**
     * Returns a set of invalid data for the provider.
     * 
     * @return  InvalidData[]
     */
    public static function createInvalidDataSetProvider(): array
    {
        $dataSet = [];
        
        $dataSet[] = self::createEmptyInvalidData();
        $dataSet[] = self::createNoCloseInvalidData();
        $dataSet[] = self::createNoOpenInvalidData();
        $dataSet[] = self::createCloseBeforeOpenInvalidData();
        
        $prmDeclDataSet = ParameterDeclarationProvider::createValidDataSet();
        
        foreach ($prmDeclDataSet as $prmDeclData) {
            $dataSet[] = self::createFirstParamMissingInvalidData($prmDeclData);
            $dataSet[] = self::createSecondParamMissingInvalidData($prmDeclData);
            $dataSet[] = self::createLastParamMissingInvalidData($prmDeclData);
        }
        
        foreach ($prmDeclDataSet as $prmDeclData) {
            $dataSet[] = self::createEllipsisParamInvalidData($prmDeclData);
            $dataSet[] = self::createEllipsisCommaParamInvalidData($prmDeclData);
            
            $dataSet[] = self::createParamEllipsisParamInvalidData($prmDeclData);
            $dataSet[] = self::createParamEllipsisCommaParamInvalidData($prmDeclData);
            
            $dataSet[] = self::createParamCommaEllipsisParamInvalidData($prmDeclData);
            $dataSet[] = self::createParamCommaEllipsisCommaParamInvalidData($prmDeclData);
        }
        
        // Qualified name where identifier is missing.
        
        $nnSpecDataSet = NestedNameSpecifierProvider::createValidDataSet();
        
        foreach ($nnSpecDataSet as $nnSpecData) {
            $dataSet[] = self::createNestedNameInvalidData($nnSpecData);
        }
        
        foreach ($prmDeclDataSet as $prmDeclData) {
            foreach ($nnSpecDataSet as $nnSpecData) {
                $dataSet[] = self::createParamNestedNameInvalidData(
                    $prmDeclData, 
                    $nnSpecData
                );
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
        $message = 'Missing "(" before "".';
        
        $data = new InvalidData($stream, $message);
        
        $data->setName('Empty string');
        
        return $data;
    }
    
    /**
     * Creates an invalid data for the case:
     * No close parenthesis
     * 
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createNoCloseInvalidData(): InvalidData
    {
        $stream = '(';
        $message = 'Missing ")" before "".';
        
        $data = new InvalidData($stream, $message);
        
        $data->setName('No close parenthesis');
        
        return $data;
    }
    
    /**
     * Creates an invalid data for the case:
     * No open parenthesis
     * 
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createNoOpenInvalidData(): InvalidData
    {
        $stream = ')';
        $message = 'Missing "(" before ")".';
        
        $data = new InvalidData($stream, $message);
        
        $data->setName('No open parenthesis');
        
        return $data;
    }
    
    /**
     * Creates an invalid data for the case:
     * Close parenthesis before open parenthesis
     * 
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createCloseBeforeOpenInvalidData(): InvalidData
    {
        $stream = ')(';
        $message = 'Missing "(" before ")".';
        
        $data = new InvalidData($stream, $message);
        
        $data->setName('Close parenthesis before open parenthesis');
        
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
            '(,%s,%s)', 
            $prmDeclData->getStream(), 
            $prmDeclData->getStream()
        );
        $message = 'Missing ")" before ",".';
        
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
            '(%s,,%s)', 
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
            '(%s,%s,)', 
            $prmDeclData->getStream(), 
            $prmDeclData->getStream()
        );
        $message = 'Unexpected ")", expected decl-specifier.';
        
        $data = new InvalidData($stream, $message);
        
        $data->setName('Last parameter is missing');
        
        return $data;
    }
    
    /**
     * Creates an invalid data for the case:
     * Parameter after ellipsis
     * 
     * @param   ValidData   $prmDeclData    The parameter declaration data use to create the data.
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createEllipsisParamInvalidData(
        ValidData $prmDeclData
    ): InvalidData
    {
        $stream = \sprintf('(... %s)', $prmDeclData->getStream());
        $message = \sprintf(
            'Missing ")" before "%s".', 
            $prmDeclData->getFirstTokenLexeme()
        );
        
        $data = new InvalidData($stream, $message);
        
        $data->setName('Parameter after ellipsis');
        
        return $data;
    }
    
    /**
     * Creates an invalid data for the case:
     * Parameter after ellipsis and comma
     * 
     * @param   ValidData   $prmDeclData    The parameter declaration data use to create the data.
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createEllipsisCommaParamInvalidData(
        ValidData $prmDeclData
    ): InvalidData
    {
        $stream = \sprintf('(...,%s)', $prmDeclData->getStream());
        $message = 'Missing ")" before ",".';
        
        $data = new InvalidData($stream, $message);
        
        $data->setName('Parameter after ellipsis and comma');
        
        return $data;
    }
    
    /**
     * Creates an invalid data for the case:
     * Parameter after parameter and ellipsis
     * 
     * @param   ValidData   $prmDeclData    The parameter declaration data use to create the data.
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createParamEllipsisParamInvalidData(
        ValidData $prmDeclData
    ): InvalidData
    {
        $stream = \sprintf(
            '(%s ... %s)', 
            $prmDeclData->getStream(), 
            $prmDeclData->getStream()
        );
        $message = \sprintf(
            'Missing ")" before "%s".', 
            $prmDeclData->getFirstTokenLexeme()
        );
        
        $data = new InvalidData($stream, $message);
        
        $data->setName('Parameter after parameter and ellipsis');
        
        return $data;
    }
    
    /**
     * Creates an invalid data for the case:
     * Parameter after parameter, ellipsis and comma
     * 
     * @param   ValidData   $prmDeclData    The parameter declaration data use to create the data.
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createParamEllipsisCommaParamInvalidData(
        ValidData $prmDeclData
    ): InvalidData
    {
        $stream = \sprintf(
            '(%s ...,%s)', 
            $prmDeclData->getStream(), 
            $prmDeclData->getStream()
        );
        $message = 'Missing ")" before ",".';
        
        $data = new InvalidData($stream, $message);
        
        $data->setName('Parameter after parameter, ellipsis and comma');
        
        return $data;
    }
    
    /**
     * Creates an invalid data for the case:
     * Parameter after parameter, comma and ellipsis
     * 
     * @param   ValidData   $prmDeclData    The parameter declaration data use to create the data.
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createParamCommaEllipsisParamInvalidData(
        ValidData $prmDeclData
    ): InvalidData
    {
        $stream = \sprintf(
            '(%s,... %s)', 
            $prmDeclData->getStream(), 
            $prmDeclData->getStream()
        );
        $message = \sprintf(
            'Missing ")" before "%s".', 
            $prmDeclData->getFirstTokenLexeme()
        );
        
        $data = new InvalidData($stream, $message);
        
        $data->setName('Parameter after parameter, comma and ellipsis');
        
        return $data;
    }
    
    /**
     * Creates an invalid data for the case:
     * Parameter after parameter, comma, ellipsis and comma
     * 
     * @param   ValidData   $prmDeclData    The parameter declaration data use to create the data.
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createParamCommaEllipsisCommaParamInvalidData(
        ValidData $prmDeclData
    ): InvalidData
    {
        $stream = \sprintf(
            '(%s,...,%s)', 
            $prmDeclData->getStream(), 
            $prmDeclData->getStream()
        );
        $message = 'Missing ")" before ",".';
        
        $data = new InvalidData($stream, $message);
        
        $data->setName('Parameter after parameter, comma, ellipsis and comma');
        
        return $data;
    }
    
    /**
     * Creates an invalid data for the case:
     * ( NESTED_NAME_SPECIFIER )
     * 
     * @param   ValidData   $nnSpecData The nested name specifier data used to create the data.
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createNestedNameInvalidData(
        ValidData $nnSpecData
    ): InvalidData
    {
        $stream = \sprintf('(%s)', $nnSpecData->getStream());
        $message = 'Unexpected ")", expected identifier.';
        
        $data = new InvalidData($stream, $message);
        
        $data->setName('Qualified name with nested name specifier and no identifier');
        
        return $data;
    }
    
    /**
     * Creates an invalid data for the case:
     * ( PRM_DECL , NESTED_NAME_SPECIFIER )
     * 
     * @param   ValidData   $prmDeclData    The parameter declaration data used to create the data.
     * @param   ValidData   $nnSpecData     The nested name specifier data used to create the data.
     * @return  InvalidData The created instance of InvalidData.
     */
    private static function createParamNestedNameInvalidData(
        ValidData $prmDeclData, 
        ValidData $nnSpecData
    ): InvalidData
    {
        $stream = \sprintf('(%s,%s)', 
            $prmDeclData->getStream(), 
            $nnSpecData->getStream()
        );
        $message = 'Unexpected ")", expected identifier.';
        
        $data = new InvalidData($stream, $message);
        
        $data->setName('Qualified name with nested name specifier and no identifier');
        
        return $data;
    }
}

