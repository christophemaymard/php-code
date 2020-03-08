<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Lexical;

use PhpCode\Language\Cpp\Lexical\TokenInterface;

/**
 * Represents a trait to assert tokens.
 * 
 * It must be used in a class that extends the {@see PHPUnit\Framework\TestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait TokenAssertionTrait
{
    /**
     * Asserts that the specified token is EOF.
     * 
     * @param   TokenInterface  $tkn    The token to assert.
     */
    public static function assertEOFToken(TokenInterface $tkn): void
    {
        self::assertToken($tkn, '', 0);
    }
    
    /**
     * Asserts the specified token.
     * 
     * @param   TokenInterface  $tkn    The token to assert.
     * @param   string          $lexeme The expected lexeme.
     * @param   int             $tag    The expected tag.
     */
    public static function assertToken(TokenInterface $tkn, string $lexeme, int $tag): void
    {
        self::assertSame($tag, $tkn->getTag(), 'Tag.');
        self::assertSame($lexeme, $tkn->getLexeme(), 'Lexeme.');
    }
}

