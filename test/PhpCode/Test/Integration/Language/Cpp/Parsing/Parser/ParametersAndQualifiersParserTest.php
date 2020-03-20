<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Integration\Language\Cpp\Parsing\Parser;

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
     * @param   string  $exception  The expected name of the exception.
     * @param   string  $message    The expected message of the exception.
     * 
     * @dataProvider    getInvalidStreamsProvider
     */
    public function testParseParametersAndQualifiersThrowsExceptionWhenInvalidStream(
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
     *                  [1] is the stream to test,  
     *                  [2] is the expected name of the exception, and 
     *                  [3] is the expected message of the exception.
     */
    public function getInvalidStreamsProvider(): array
    {
        return $this->createInvalidStreamsProvider(
            ParametersAndQualifiersProvider::createInvalidDataSetProvider()
        );
    }
}

