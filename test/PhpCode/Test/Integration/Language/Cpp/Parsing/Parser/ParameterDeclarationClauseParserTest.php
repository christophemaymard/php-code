<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Integration\Language\Cpp\Parsing\Parser;

use PhpCode\Language\Cpp\Parsing\Parser;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationClauseConstraint;
use PhpCode\Test\Language\Cpp\Parsing\ParameterDeclarationClauseProvider;

/**
 * Represents the integration tests for the {@see PhpCode\Language\Cpp\Parsing\Parser} 
 * class when calling parseParameterDeclarationClause().
 * 
 * @group   declarator
 * @group   parsing
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationClauseParserTest extends AbstractParserTest
{
    /**
     * Tests that parseParameterDeclarationClause() returns an instance of 
     * ParameterDeclarationClause.
     * 
     * @param   int                                     $standard   The standard to create the language context for.
     * @param   string                                  $stream     The stream to test.
     * @param   ParameterDeclarationClauseConstraint    $constraint The constraint used to assert the parameter declaration clause.
     * @param   string                                  $lexeme     The lexeme of the next token after parsing.
     * @param   int                                     $tag        The tag of the next token after parsing.
     * 
     * @dataProvider    getValidStreamsProvider
     */
    public function testParseParameterDeclarationClause(
        int $standard, 
        string $stream, 
        ParameterDeclarationClauseConstraint $constraint, 
        string $lexeme, 
        int $tag
    ): void
    {
        $lexer = $this->createLexer($standard, $stream);
        $sut = new Parser($lexer);
        
        $prmDeclClause = $sut->parseParameterDeclarationClause();
        self::assertThat($prmDeclClause, $constraint);
        
        self::assertToken($lexeme, $tag, $lexer->getToken());
    }
    
    /**
     * Tests that parseParameterDeclarationClause() throws an exception when 
     * the stream is invalid.
     * 
     * @param   int     $standard   The standard to create the language context for.
     * @param   string  $stream     The stream to test.
     * @param   string  $exception  The expected name of the exception.
     * @param   string  $message    The expected message of the exception.
     * 
     * @dataProvider    getInvalidStreamsProvider
     */
    public function testParseParameterDeclarationClauseThrowsExceptionWhenInvalidStream(
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
        $sut->parseParameterDeclarationClause();
    }
    
    /**
     * Returns a set of valid streams.
     * 
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where:
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the stream to test, 
     *                  [2] is the constraint used to assert the parameter declaration clause, 
     *                  [3] is the lexeme of the next token after parsing, and 
     *                  [4] is the tag of the next token after parsing.
     */
    public function getValidStreamsProvider(): array
    {
        return $this->createValidStreamsProvider(
            ParameterDeclarationClauseProvider::createValidDataSetProvider()
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
            ParameterDeclarationClauseProvider::createInvalidDataSetProvider()
        );
    }
}

