<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Parsing;

use PhpCode\Language\Cpp\Lexical\LexerInterface;
use PhpCode\Language\Cpp\Parsing\Parser;
use PhpCode\Test\Language\Cpp\Lexical\TokenInterfaceDoubleBuilder;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Parsing\Parser} 
 * class.
 * 
 * @group   parsing
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParserTest extends TestCase
{
    /**
     * Tests that __construct() calls LexerInterface::lookAhead().
     */
    public function test__constructCallsLookAhead(): void
    {
        $token = $this->createTokenInterfaceDoubleBuilder()->getDouble();
        
        $lexerProphecy = $this->prophesize(LexerInterface::class);
        $lexerProphecy
            ->lookAhead(Argument::is(1))
            ->willReturn($token)
            ->shouldBeCalled();
        $lexer = $lexerProphecy->reveal();
        
        $sut = new Parser($lexer);
    }
    
    /**
     * Creates a builder of TokenInterface double.
     * 
     * @return  TokenInterfaceDoubleBuilder
     */
    private function createTokenInterfaceDoubleBuilder(): TokenInterfaceDoubleBuilder
    {
        return new TokenInterfaceDoubleBuilder($this);
    }
}

