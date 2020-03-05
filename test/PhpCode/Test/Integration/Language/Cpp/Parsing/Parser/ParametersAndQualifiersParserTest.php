<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Integration\Language\Cpp\Parsing\Parser;

use PhpCode\Exception\FormatException;
use PhpCode\Language\Cpp\Declarator\ParametersAndQualifiers;
use PhpCode\Language\Cpp\Lexical\Lexer;
use PhpCode\Language\Cpp\Parsing\Parser;
use PhpCode\Language\Cpp\Specification\LanguageContextFactory;

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
     * Tests that parseParametersAndQualifiers() parse open and close 
     * parenthesis.
     * 
     * @param   int $standard   The standard to create the language context for.
     * 
     * @dataProvider    getCpp2003StandardProvider
     * @dataProvider    getCpp2011StandardProvider
     * @dataProvider    getCpp2014StandardProvider
     * @dataProvider    getCpp2017StandardProvider
     */
    public function testParseOpenCloseParenthesis(int $standard): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream('()');
        
        $sut = new Parser($lexer);
        $prmQual = $sut->parseParametersAndQualifiers();
        
        self::assertInstanceOf(ParametersAndQualifiers::class, $prmQual);
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
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream($stream);
        
        $sut = new Parser($lexer);
        
        $this->expectException(FormatException::class);
        $this->expectExceptionMessage($message);
        $sut->parseParametersAndQualifiers();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getInvalidStreams(): array
    {
        return [
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
        ];
    }
}

