<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Integration\Language\Cpp\Parsing\Parser;

use PhpCode\Language\Cpp\Parsing\Parser;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierConstraint;
use PhpCode\Test\Language\Cpp\Parsing\DeclarationSpecifierProvider;

/**
 * Represents the integration tests for the {@see PhpCode\Language\Cpp\Parsing\Parser} 
 * class when calling parseDeclarationSpecifier().
 * 
 * @group   declaration
 * @group   parsing
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclarationSpecifierParserTest extends AbstractParserTest
{
    /**
     * Tests that parseDeclarationSpecifier() returns an instance of 
     * DeclarationSpecifier.
     * 
     * @param   int                             $standard   The standard to create the language context for.
     * @param   string                          $stream     The stream to test.
     * @param   DeclarationSpecifierConstraint  $constraint The constraint used to assert the declaration specifier.
     * @param   string                          $lexeme     The lexeme of the next token after parsing.
     * @param   int                             $tag        The tag of the next token after parsing.
     * 
     * @dataProvider    getValidStreamsProvider
     */
    public function testParseDeclarationSpecifier(
        int $standard, 
        string $stream, 
        DeclarationSpecifierConstraint $constraint, 
        string $lexeme, 
        int $tag 
    ): void
    {
        $lexer = $this->createLexer($standard, $stream);
        $sut = new Parser($lexer);
        
        $declSpec = $sut->parseDeclarationSpecifier();
        self::assertThat($declSpec, $constraint);
        
        self::assertToken($lexeme, $tag, $lexer->getToken());
    }
    
    /**
     * Tests that parseDeclarationSpecifier() throws an exception when the 
     * stream is invalid.
     * 
     * @param   int     $standard   The standard to create the language context for.
     * @param   string  $stream     The stream to test.
     * @param   string  $exception  The expected name of the exception.
     * @param   string  $message    The expected message of the exception.
     * 
     * @dataProvider    getInvalidStreamsProvider
     */
    public function testParseDeclarationSpecifierThrowsExceptionWhenInvalidStream(
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
        $sut->parseDeclarationSpecifier();
    }
    
    /**
     * Returns a set of valid streams.
     * 
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where:
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the stream to test, 
     *                  [2] is the constraint used to assert the declaration specifier, 
     *                  [3] is the lexeme of the next token after parsing, and 
     *                  [4] is the tag of the next token after parsing.
     */
    public function getValidStreamsProvider(): array
    {
        return $this->createValidStreamsProvider(
            DeclarationSpecifierProvider::createValidDataSetProvider()
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
            DeclarationSpecifierProvider::createInvalidDataSetProvider()
        );
    }
}

