<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Integration\Language\Cpp\Mangling\ItaniumMangler;

use PhpCode\Exception\FormatException;
use PhpCode\Language\Cpp\Mangling\ItaniumMangler;
use PhpCode\Language\Cpp\Specification\LanguageContextFactory;
use PhpCode\Test\Language\Cpp\Specification;
use PhpCode\Test\Language\Cpp\Parsing\DeclaratorIdProvider;
use PhpCode\Test\Language\Cpp\Parsing\DeclaratorProvider;
use PHPUnit\Framework\TestCase;

/**
 * Represents the base class of integration tests for the {@see PhpCode\Language\Cpp\Mangling\ItaniumMangler} 
 * class when calling mangleFunction().
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class FunctionItaniumManglerTest extends TestCase
{
    /**
     * Tests that mangleFunction() returns a string.
     * 
     * @param   int     $standard       The standard to create the language context for.
     * @param   string  $name           The name to test.
     * @param   string  $mangledName    The expected mangled name.
     * 
     * @dataProvider    getValidNamesProvider
     */
    public function testMangleFunctionReturnsString(
        int $standard, 
        string $name, 
        string $mangledName
    ): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $sut = new ItaniumMangler($ctx);
        self::assertSame($mangledName, $sut->mangleFunction($name));
    }
    
    /**
     * Tests that mangleFunction() throws an exception when the name is 
     * invalid.
     * 
     * @param   int     $standard   The standard to create the language context for.
     * @param   string  $name       The name to test.
     * @param   string  $exception  The expected name of the exception.
     * @param   string  $message    The expected message of the exception.
     * 
     * @dataProvider    getInvalidNamesProvider
     */
    public function testMangleFunctionThrowsExceptionWhenNameIsInvalid(
        int $standard,
        string $name,
        string $exception, 
        string $message
    ): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $sut = new ItaniumMangler($ctx);
        
        $this->expectException($exception);
        $this->expectExceptionMessage($message);
        
        $sut->mangleFunction($name);
    }
    
    /**
     * Returns a set of valid names.
     * 
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where 
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the name to test, and 
     *                  [2] is the expected mangled name.
     */
    public function getValidNamesProvider(): array
    {
        $dataSet = [
            [
                'DCLTOR_ID->ID_EXPR->UNQUAL_ID->ID (  )', 
                'main()', 
                [ 1, 2, 4, 8, ], 
                '_Z4mainv', 
            ], 
            [
                'DCLTOR_ID->ID_EXPR->UNQUAL_ID->ID ( ... )', 
                'main(...)', 
                [ 1, 2, 4, 8, ], 
                '_Z4mainz', 
            ], 
            [
                'DCLTOR_ID->ID_EXPR->UNQUAL_ID->ID ( DECL_SPEC_SEQ1 )', 
                'main(int)', 
                [ 1, 2, 4, 8, ], 
                '_Z4maini', 
            ], 
            [
                'DCLTOR_ID->ID_EXPR->UNQUAL_ID->ID ( DECL_SPEC_SEQ1 , ... )', 
                'main(int,...)', 
                [ 1, 2, 4, 8, ], 
                '_Z4mainiz', 
            ], 
            [
                'DCLTOR_ID->ID_EXPR->UNQUAL_ID->ID ( DECL_SPEC_SEQ1 ... )', 
                'main(int ...)', 
                [ 1, 2, 4, 8, ], 
                '_Z4mainiz', 
            ], 
            [
                'DCLTOR_ID->ID_EXPR->UNQUAL_ID->ID ( DECL_SPEC_SEQ1 , DECL_SPEC_SEQ1 , DECL_SPEC_SEQ1 )', 
                'main(int,int,int)', 
                [ 1, 2, 4, 8, ], 
                '_Z4mainiii', 
            ], 
            [
                'DCLTOR_ID->ID_EXPR->UNQUAL_ID->ID ( DECL_SPEC_SEQ1 , DECL_SPEC_SEQ1 , DECL_SPEC_SEQ1 , ... )', 
                'main(int,int,int,...)', 
                [ 1, 2, 4, 8, ], 
                '_Z4mainiiiz', 
            ], 
            [
                'DCLTOR_ID->ID_EXPR->UNQUAL_ID->ID ( DECL_SPEC_SEQ1 , DECL_SPEC_SEQ1 , DECL_SPEC_SEQ1 ... )', 
                'main(int,int,int ...)', 
                [ 1, 2, 4, 8, ], 
                '_Z4mainiiiz', 
            ], 
        ];
        
        return $this->createValidNamesProvider($dataSet);
    }
    
    /**
     * Returns a set of invalid names.
     * 
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where 
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the name to test, 
     *                  [2] is the expected name of the exception, and 
     *                  [3] is the expected message of the exception.
     */
    public function getInvalidNamesProvider(): array
    {
        $invalidDataSet = [];
        
        $didDataSet = DeclaratorIdProvider::createValidDataSet();
        
        // Name not parsed entirely.
        foreach ($didDataSet as $didData) {
            // No open parenthesis.
            $invalidDataSet[] = [
                'Name not parsed entirely, no open parenthesis', 
                \sprintf('%s)', $didData->getStream()), 
                $didData->getStandards(), 
                FormatException::class, 
                'The name has not been parsed entirely, unexpected ")".', 
            ];
            
            // Close parenthesis before open parenthesis.
            $invalidDataSet[] = [
                'Name not parsed entirely, close parenthesis before open parenthesis', 
                \sprintf('%s)(', $didData->getStream()), 
                $didData->getStandards(), 
                FormatException::class, 
                'The name has not been parsed entirely, unexpected ")".', 
            ];
            
            // Identifier after declarator identifier.
            $invalidDataSet[] = [
                'Name not parsed entirely, identifier after declarator identifier', 
                \sprintf('%s foo', $didData->getStream()), 
                $didData->getStandards(), 
                FormatException::class, 
                'The name has not been parsed entirely, unexpected "foo".', 
            ];
        }
        
        // The declarator does not have parameters-and-qualifiers.
        foreach ($didDataSet as $didData) {
            $invalidDataSet[] = [
                \sprintf('No parameters-and-qualifiers %s', $didData->getName()), 
                $didData->getStream(), 
                $didData->getStandards(), 
                FormatException::class, 
                'The declarator does not have parameters-and-qualifiers.', 
            ];
        }
        
        foreach (DeclaratorProvider::createInvalidDataSetProvider() as $invalidData) {
            $invalidDataSet[] = [
                $invalidData->getName(), 
                $invalidData->getStream(), 
                $invalidData->getStandards(), 
                $invalidData->getExceptionName(), 
                $invalidData->getExceptionMessage(), 
            ];
        }
        
        return $this->createInvalidNamesProvider($invalidDataSet);
    }
    
    /**
     * Creates a set of valid names.
     * 
     * @param   array[] $validDataSet   The data set used to create a set of valid names.
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where:
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the name to test, and 
     *                  [2] is the expected mangled name.
     */
    private function createValidNamesProvider(array $validDataSet): array
    {
        $dataSet = [];
        
        foreach ($validDataSet as list($vdsName, $name, $stds, $mangledName)) {
            $dsNameFmt = "\n%s: NAME \"%s\"\n";
            
            if ($vdsName !== '') {
                $dsNameFmt .= $vdsName."\n";
            }
            
            foreach ($stds as $std) {
                $dsName = \sprintf($dsNameFmt, Specification::STANDARDS[$std], $name);
                
                $dataSet[$dsName] = [
                    $std, 
                    $name, 
                    $mangledName, 
                ];
            }
        }
        
        return $dataSet;
    }
    
    /**
     * Creates a set of invalid names.
     * 
     * @param   array[] $invalidDataSet The data set used to create a set of invalid names.
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where:
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the name to test,  
     *                  [2] is the expected name of the exception, and 
     *                  [3] is the expected message of the exception.
     */
    private function createInvalidNamesProvider(array $invalidDataSet): array
    {
        $dataSet = [];
        
        foreach ($invalidDataSet as list($idsName, $name, $stds, $exceptionName, $exceptionMessage)) {
            $dsNameFmt = "\n%s: NAME \"%s\"\n";
            
            if ($idsName !== '') {
                $dsNameFmt .= $idsName."\n";
            }
            
            foreach ($stds as $std) {
                $dsName = \sprintf($dsNameFmt, Specification::STANDARDS[$std], $name);
                
                $dataSet[$dsName] = [
                    $std, 
                    $name, 
                    $exceptionName, 
                    $exceptionMessage, 
                ];
            }
        }
        
        return $dataSet;
    }
}

