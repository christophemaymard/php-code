<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Integration\Language\Cpp\Parsing\Parser;

use PhpCode\Exception\FormatException;
use PhpCode\Language\Cpp\Parsing\Parser;
use PhpCode\Test\Language\Cpp\Declarator\ParametersAndQualifiersConstraint;
use PhpCode\Test\Language\Cpp\Parsing\ParametersAndQualifiersProvider;

/**
 * Represents the integration tests for the {@see PhpCode\Language\Cpp\Parsing\Parser} 
 * class when calling parseParametersAndQualifiers().
 * 
 * @group   declarator
 * @group   parsing
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParametersAndQualifiersParserTest extends AbstractParserTest
{
    /**
     * Tests that parseParametersAndQualifiers() returns an instance of 
     * ParametersAndQualifiers.
     * 
     * @param   int                                 $standard   The standard to create the language context for.
     * @param   string                              $stream     The stream to test.
     * @param   ParametersAndQualifiersConstraint   $constraint The constraint used to assert parameters and qualifiers.
     * @param   string                              $lexeme     The lexeme of the next token after parsing.
     * @param   int                                 $tag        The tag of the next token after parsing.
     * 
     * @dataProvider    getValidStreamsProvider
     */
    public function testParseParametersAndQualifiers(
        int $standard, 
        string $stream, 
        ParametersAndQualifiersConstraint $constraint, 
        string $lexeme, 
        int $tag
    ): void
    {
        $lexer = $this->createLexer($standard, $stream);
        $sut = new Parser($lexer);
        
        $prmQual = $sut->parseParametersAndQualifiers();
        self::assertThat($prmQual, $constraint);
        
        self::assertToken($lexeme, $tag, $lexer->getToken());
    }
    
    /**
     * Tests that parseParametersAndQualifiers() throws an exception when 
     * the stream is invalid.
     * 
     * @param   int     $standard   The standard to create the language context for.
     * @param   string  $stream     The stream to test.
     * @param   string  $message    The expected message of the exception.
     * 
     * @dataProvider    getInvalidStreamsProvider
     */
    public function testParseParametersAndQualifiersThrowsExceptionWhenInvalidStream(
        int $standard,
        string $stream,
        string $message
    ): void
    {
        $lexer = $this->createLexer($standard, $stream);
        $sut = new Parser($lexer);
        
        $this->expectException(FormatException::class);
        $this->expectExceptionMessage($message);
        $sut->parseParametersAndQualifiers();
    }
    
    /**
     * Returns a set of valid streams.
     * 
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where:
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the stream to test, 
     *                  [2] is the constraint used to assert parameters and qualifiers, 
     *                  [3] is the lexeme of the next token after parsing, and 
     *                  [4] is the tag of the next token after parsing.
     */
    public function getValidStreamsProvider(): array
    {
        return $this->createValidStreamsProvider(
            ParametersAndQualifiersProvider::createValidDataSetProvider()
        );
   }
    
    /**
     * Returns a set of invalid streams.
     * 
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where:
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the stream to test, and 
     *                  [2] is the expected message of the exception.
     */
    public function getInvalidStreamsProvider(): array
    {
        $dataSet = [
            // General.
            
            'Empty string' => [
                [ 1, 2, 4, 8, ],
                '', 
                'Missing "(" before "".', 
            ], 
            'No close parenthesis' => [
                [ 1, 2, 4, 8, ],
                '(', 
                'Missing ")" before "".', 
            ], 
            'No open parenthesis' => [
                [ 1, 2, 4, 8, ],
                ')', 
                'Missing "(" before ")".', 
            ], 
            'Close parenthesis before open parenthesis' => [
                [ 1, 2, 4, 8, ],
                ')(', 
                'Missing "(" before ")".', 
            ], 
            
            // Parameter is missing.
            
            '3 parameters "(, int, int)" first is missing' => [
                [ 1, 2, 4, 8, ], 
                '(, int, int)', 
                'Missing ")" before ",".', 
            ], 
            '3 parameters "(int, , int)" second is missing' => [
                [ 1, 2, 4, 8, ], 
                '(int, , int)', 
                'Unexpected ",", expected decl-specifier.', 
            ], 
            '3 parameters "(int, int,)" third is missing' => [
                [ 1, 2, 4, 8, ], 
                '(int, int,)', 
                'Unexpected ")", expected decl-specifier.', 
            ], 
            
            // Position of the ellipsis.
            
            'ELLIPSIS param "(... int)"' => [
                [ 1, 2, 4, 8, ], 
                '(... int)', 
                'Missing ")" before "int".', 
            ], 
            'ELLIPSIS COMMA param "(..., int)"' => [
                [ 1, 2, 4, 8, ], 
                '(..., int)', 
                'Missing ")" before ",".', 
            ], 
            'Param COMMA ELLIPSIS param "(int, ... int)"' => [
                [ 1, 2, 4, 8, ], 
                '(int, ... int)', 
                'Missing ")" before "int".', 
            ], 
            'Param COMMA ELLIPSIS COMMA param "(int, ..., int)"' => [
                [ 1, 2, 4, 8, ], 
                '(int, ..., int)', 
                'Missing ")" before ",".', 
            ], 
        ];
        
        return $this->createInvalidStreamsProvider($dataSet);
    }
}

