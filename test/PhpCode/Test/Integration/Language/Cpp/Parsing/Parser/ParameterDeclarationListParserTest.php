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
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationListConstraint;
use PhpCode\Test\Language\Cpp\Parsing\ParameterDeclarationListProvider;

/**
 * Represents the integration tests for the {@see PhpCode\Language\Cpp\Parsing\Parser} 
 * class when calling parseParameterDeclarationList().
 * 
 * @group   declarator
 * @group   parsing
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationListParserTest extends AbstractParserTest
{
    /**
     * Tests that parseParameterDeclarationList() returns an instance of 
     * ParameterDeclarationList.
     * 
     * @param   int                                 $standard   The standard to create the language context for.
     * @param   string                              $stream     The stream to test.
     * @param   ParameterDeclarationListConstraint  $constraint The constraint used to assert the parameter declaration list.
     * @param   string                              $lexeme     The lexeme of the next token after parsing.
     * @param   int                                 $tag        The tag of the next token after parsing.
     * 
     * @dataProvider    getValidStreamsProvider
     */
    public function testParseParameterDeclarationList(
        int $standard, 
        string $stream, 
        ParameterDeclarationListConstraint $constraint, 
        string $lexeme, 
        int $tag 
    ): void
    {
        $lexer = $this->createLexer($standard, $stream);
        $sut = new Parser($lexer);
        
        $prmDeclList = $sut->parseParameterDeclarationList();
        self::assertThat($prmDeclList, $constraint);
        
        self::assertToken($lexeme, $tag, $lexer->getToken());
    }
    
    /**
     * Tests that parseParameterDeclarationList() throws an exception when 
     * the stream is invalid.
     * 
     * @param   int     $standard   The standard to create the language context for.
     * @param   string  $stream     The stream to test.
     * @param   string  $message    The expected message of the exception.
     * 
     * @dataProvider    getInvalidStreamsProvider
     */
    public function testParseParameterDeclarationListThrowsExceptionWhenInvalidStream(
        int $standard,
        string $stream,
        string $message
    ): void
    {
        $lexer = $this->createLexer($standard, $stream);
        $sut = new Parser($lexer);
        
        $this->expectException(FormatException::class);
        $this->expectExceptionMessage($message);
        $sut->parseParameterDeclarationList();
    }
    
    /**
     * Returns a set of valid streams.
     * 
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where:
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the stream to test,  
     *                  [2] is the constraint used to assert the parameter declaration list, 
     *                  [3] is the lexeme of the next token after parsing, and 
     *                  [4] is the tag of the next token after parsing.
     */
    public function getValidStreamsProvider(): array
    {
        return $this->createValidStreamsProvider(
            ParameterDeclarationListProvider::createValidDataSetProvider()
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
            
            'No declaration specifier (empty string)' => [
                [ 1, 2, 4, 8, ],
                '', 
                'Unexpected "", expected decl-specifier.', 
            ], 
            
            // Parameter is missing.
            
           '3 parameters ", int, int" first is missing' => [
                [ 1, 2, 4, 8, ],
                ',int,int', 
                'Unexpected ",", expected decl-specifier.', 
            ], 
            '3 parameters "int, , int" second is missing' => [
                [ 1, 2, 4, 8, ],
                'int,,int', 
                'Unexpected ",", expected decl-specifier.', 
            ], 
            '3 parameters "int , , int" third is missing' => [
                [ 1, 2, 4, 8, ],
                'int,int,', 
                'Unexpected "", expected decl-specifier.', 
            ], 
            
            // parseParameterDeclarationList() must not be called when only ellipsis.
            'Ellipsis' => [
                [ 1, 2, 4, 8, ],
                '...', 
                'Unexpected "...", expected decl-specifier.', 
            ], 
        ];
        
        return $this->createInvalidStreamsProvider($dataSet);
    }
}

