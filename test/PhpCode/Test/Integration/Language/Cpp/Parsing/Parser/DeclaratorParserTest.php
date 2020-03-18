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
use PhpCode\Test\Language\Cpp\Declarator\DeclaratorConstraint;
use PhpCode\Test\Language\Cpp\Parsing\DeclaratorProvider;

/**
 * Represents the integration tests for the {@see PhpCode\Language\Cpp\Parsing\Parser} 
 * class when calling parseDeclarator().
 * 
 * @group   declarator
 * @group   parsing
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclaratorParserTest extends AbstractParserTest
{
    /**
     * Tests that parseDeclarator() returns an instance Declarator.
     * 
     * @param   int                     $standard   The standard to create the language context for.
     * @param   string                  $stream     The stream to test.
     * @param   DeclaratorConstraint    $constraint The constraint used to assert the declarator.
     * @param   string                  $lexeme     The lexeme of the next token after parsing.
     * @param   int                     $tag        The tag of the next token after parsing.
     * 
     * @dataProvider    getValidStreamsProvider
     */
    public function testParseDeclarator(
        int $standard, 
        string  $stream, 
        DeclaratorConstraint $constraint, 
        string $lexeme, 
        int $tag
    ): void
    {
        $lexer = $this->createLexer($standard, $stream);
        $sut = new Parser($lexer);
        
        $dcltor = $sut->parseDeclarator();
        self::assertThat($dcltor, $constraint);
        
        self::assertToken($lexeme, $tag, $lexer->getToken());
    }
    
    /**
     * Tests that parseDeclarator() throws an exception when the stream is 
     * invalid.
     * 
     * @param   int     $standard   The standard to create the language context for.
     * @param   string  $stream     The stream to test.
     * @param   string  $message    The expected message of the exception.
     * 
     * @dataProvider    getInvalidStreamsProvider
     */
    public function testParseDecalaratorThrowsExceptionWhenInvalidStream(
        int $standard,
        string $stream,
        string $message
    ): void
    {
        $lexer = $this->createLexer($standard, $stream);
        $sut = new Parser($lexer);
        
        $this->expectException(FormatException::class);
        $this->expectExceptionMessage($message);
        $sut->parseDeclarator();
    }
    
    /**
     * Returns a set of valid streams.
     * 
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where:
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the stream to test, 
     *                  [2] is the constraint used to assert the declarator, 
     *                  [3] is the lexeme of the next token after parsing, and 
     *                  [4] is the tag of the next token after parsing.
     */
    public function getValidStreamsProvider(): array
    {
        return $this->createValidStreamsProvider(
            DeclaratorProvider::createValidDataSetProvider()
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
                'Unexpected "", expected identifier.', 
            ], 
            'Multiple declarator-id (id-expression -> unqualified-id -> identifier) before parameters-and-qualifiers' => [
                [ 1, 2, 4, 8, ],
                'foo bar()', 
                'Unexpected identifier "bar".', 
            ], 
            
            // Parameter is missing.
            
            '3 parameters "main(, int, int)" first is missing' => [
                [ 1, 2, 4, 8, ], 
                'main(, int, int)', 
                'Missing ")" before ",".', 
            ], 
            '3 parameters "main(int, , int)" second is missing' => [
                [ 1, 2, 4, 8, ], 
                'main(int, , int)', 
                'Unexpected ",", expected decl-specifier.', 
            ], 
            '3 parameters "main(int, int,)" third is missing' => [
                [ 1, 2, 4, 8, ], 
                'main(int, int,)', 
                'Unexpected ")", expected decl-specifier.', 
            ], 
            
            // Position of the ellipsis.
            
            'ELLIPSIS param "main(... int)"' => [
                [ 1, 2, 4, 8, ], 
                'main(... int)', 
                'Missing ")" before "int".', 
            ], 
            'ELLIPSIS COMMA param "main(..., int)"' => [
                [ 1, 2, 4, 8, ], 
                'main(..., int)', 
                'Missing ")" before ",".', 
            ], 
            'Param COMMA ELLIPSIS param "main(int, ... int)"' => [
                [ 1, 2, 4, 8, ], 
                'main(int, ... int)', 
                'Missing ")" before "int".', 
            ], 
            'Param COMMA ELLIPSIS COMMA param "main(int, ..., int)"' => [
                [ 1, 2, 4, 8, ], 
                'main(int, ..., int)', 
                'Missing ")" before ",".', 
            ], 
        ];
        
        return $this->createInvalidStreamsProvider($dataSet);
    }
}

