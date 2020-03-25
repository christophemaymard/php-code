<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Parsing;

use PhpCode\Test\Language\Cpp\CallableConceptConstraintFactory;
use PhpCode\Test\Language\Cpp\Declarator\DeclaratorIdConstraint;
use PhpCode\Test\Language\Cpp\Expression\IdExpressionConstraint;
use PhpCode\Test\Language\Cpp\Expression\QualifiedIdConstraint;
use PhpCode\Test\Language\Cpp\Expression\UnqualifiedIdConstraint;
use PhpCode\Test\Language\Cpp\Lexical\IdentifierConstraint;

/**
 * Represents the data provider related to declarator identifiers.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclaratorIdProvider
{
    /**
     * Returns a set of valid data.
     * 
     * @return  ValidData[]
     */
    public static function createValidDataSet(): array
    {
        $dataSet = [];
        
        $dataSet[] = self::createIdValidData();
        
        foreach (NestedNameSpecifierProvider::createValidDataSet() as $nnSpecData) {
            $dataSet[] = self::createNestedNameSpecifierIdValidData($nnSpecData);
        }
        
        return $dataSet;
    }
    
    /**
     * Creates a valid data for the case:
     * ID
     * 
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createIdValidData(): ValidData
    {
        $stream = 'main';
        $firstTokenLexeme = $stream;
        
        $callable = function() use ($stream) {
            return new DeclaratorIdConstraint(
                IdExpressionConstraint::createUnqualifiedId(
                    UnqualifiedIdConstraint::createIdentifier(
                        new IdentifierConstraint($stream)
                    )
                )
            );
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        $data->setName('ID');
        
        return $data;
    }
    
    /**
     * Creates a valid data for the case:
     * NESTED_NAME_SPECIFIER ID
     * 
     * @param   ValidData   $nnSpecData The nested name specifier data use to create the data.
     * @return  ValidData   The created instance of ValidData.
     */
    private static function createNestedNameSpecifierIdValidData(
        ValidData $nnSpecData
    ): ValidData
    {
        $stream = \sprintf(
            '%suid_id1', 
            $nnSpecData->getStream()
        );
        $firstTokenLexeme = $nnSpecData->getFirstTokenLexeme();
        
        $callable = function() use ($nnSpecData) {
            return new DeclaratorIdConstraint(
                IdExpressionConstraint::createQualifiedId(
                    new QualifiedIdConstraint(
                        $nnSpecData->getConstraintFactory()->createConstraint(), 
                        UnqualifiedIdConstraint::createIdentifier(
                            new IdentifierConstraint('uid_id1')
                        )                        
                    )
                )
            );
        };
        $factory = new CallableConceptConstraintFactory($callable);
        
        $data = new ValidData($stream, $factory, $firstTokenLexeme);
        
        $data->setName(\sprintf(
            '%s ID', 
            $nnSpecData->getName()
        ));
        
        return $data;
    }
}

