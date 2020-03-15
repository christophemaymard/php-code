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
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierConstraint as DeclSpecConst;

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
        DeclSpecConst $constraint, 
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
     * @param   string  $message    The expected message of the exception.
     * 
     * @dataProvider    getInvalidStreamsProvider
     */
    public function testParseDeclarationSpecifierThrowsExceptionWhenInvalidStream(
        int $standard,
        string $stream,
        string $message
    ): void
    {
        $lexer = $this->createLexer($standard, $stream);
        $sut = new Parser($lexer);
        
        $this->expectException(FormatException::class);
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
        $dataSet = [
            'int' => [
                [ 1, 2, 4, 8, ],
                'int', 
                DeclSpecConst::createInt(), 
                [ '', 0, ], 
            ], 
            'int int' => [
                [ 1, 2, 4, 8, ],
                'int int', 
                DeclSpecConst::createInt(), 
                [ 'int', 141000, ], 
            ], 
            'int foobarbaz' => [
                [ 1, 2, 4, 8, ],
                'int foobarbaz', 
                DeclSpecConst::createInt(), 
                [ 'foobarbaz', 2, ], 
            ], 
        ];
        
        return $this->createValidStreamsProvider($dataSet);
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
            'No declaration specifier (empty string)' => [
                [ 1, 2, 4, 8, ],
                '', 
                'Unexpected "", expected decl-specifier.', 
            ], 
        ];
        
        return $this->createInvalidStreamsProvider($dataSet);
    }
}

