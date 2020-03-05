<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Parsing;

use PhpCode\Language\Cpp\Lexical\LexerInterface;
use PhpCode\Language\Cpp\Lexical\TokenInterface;
use PhpCode\Language\Cpp\Parsing\Parser;
use PHPUnit\Framework\TestCase;

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
     * Tests that __construct() calls LexerInterface::getToken().
     */
    public function test__constructCallsGetToken(): void
    {
        $tokenDummy = $this->prophesize(TokenInterface::class)->reveal();
        
        $lexerProphecy = $this->prophesize(LexerInterface::class);
        $lexerProphecy
            ->getToken()
            ->willReturn($tokenDummy)
            ->shouldBeCalled();
        $lexer = $lexerProphecy->reveal();
        
        $sut = new Parser($lexer);
    }
}

