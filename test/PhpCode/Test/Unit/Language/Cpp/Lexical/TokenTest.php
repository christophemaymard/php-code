<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Lexical;

use PhpCode\Language\Cpp\Lexical\Token;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Lexical\Token} 
 * class.
 * 
 * @group   lexical
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TokenTest extends TestCase
{
    /**
     * Tests that __construct() stores the lexeme and the tag.
     */
    public function test__constructStoresLexemeAndTag(): void
    {
        $sut = new Token('foo', 209);
        self::assertSame('foo', $sut->getLexeme());
        self::assertSame(209, $sut->getTag());
    }
}

