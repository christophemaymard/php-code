<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Integration\Language\Cpp\Parsing\Parser;

use PhpCode\Language\Cpp\Parsing\Parser;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationConstraint;
use PhpCode\Test\Language\Cpp\Parsing\ParameterDeclarationProvider;

/**
 * Represents the integration tests for the {@see PhpCode\Language\Cpp\Parsing\Parser} 
 * class when calling parseParameterDeclaration().
 * 
 * @group   declarator
 * @group   parsing
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationParserTest extends AbstractParserTest
{
    /**
     * Tests that parseParameterDeclaration() parses returns an instance of 
     * ParameterDeclaration.
     * 
     * @param   int                             $standard   The standard to create the language context for.
     * @param   string                          $stream     The stream to test.
     * @param   ParameterDeclarationConstraint  $constraint The constraint used to assert the parameter declaration.
     * @param   string                          $lexeme     The lexeme of the next token after parsing.
     * @param   int                             $tag        The tag of the next token after parsing.
     * 
     * @dataProvider    getValidStreamsProvider
     */
    public function testParseParameterDeclaration(
        int $standard, 
        string $stream, 
        ParameterDeclarationConstraint $constraint, 
        string $lexeme, 
        int $tag
    ): void
    {
        $lexer = $this->createLexer($standard, $stream);
        $sut = new Parser($lexer);
        
        $prmDecl = $sut->parseParameterDeclaration();
        self::assertThat($prmDecl, $constraint);
        
        self::assertToken($lexeme, $tag, $lexer->getToken());
    }
    
    /**
     * Tests that parseParameterDeclaration() throws an exception when the 
     * stream is invalid.
     * 
     * @param   int     $standard   The standard to create the language context for.
     * @param   string  $stream     The stream to test.
     * @param   string  $exception  The expected name of the exception.
     * @param   string  $message    The expected message of the exception.
     * 
     * @dataProvider    getInvalidStreamsProvider
     */
    public function testParseParameterDeclarationThrowsExceptionWhenInvalidStream(
        int $standard,
        string $stream,
        string $exception, 
        string $message
    ): void
    {
        $lexer = $this->createLexer($standard, $stream);
        $sut = new Parser($lexer);
        
        $this->expectException($exception);
        $this->expectExceptionMessage($message);
        $sut->parseParameterDeclaration();
    }
    
    /**
     * Returns a set of valid streams.
     * 
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where:
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the stream to test, 
     *                  [2] is the constraint used to assert the parameter declaration, 
     *                  [3] is the lexeme of the next token after parsing, and 
     *                  [4] is the tag of the next token after parsing.
     */
    public function getValidStreamsProvider(): array
    {
        return $this->createValidStreamsProvider(
            ParameterDeclarationProvider::createValidDataSetProvider()
        );
    }
    
    /**
     * Returns a set of invalid streams.
     * 
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where:
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the stream to test,  
     *                  [2] is the expected name of the exception, and 
     *                  [3] is the expected message of the exception.
     */
    public function getInvalidStreamsProvider(): array
    {
        return $this->createInvalidStreamsProvider(
            ParameterDeclarationProvider::createInvalidDataSetProvider()
        );
    }
}

