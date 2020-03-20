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
        $data->setName('DCLTOR_ID->ID_EXPR->UNQUAL_ID->ID');
        
        return $data;
    }
}

