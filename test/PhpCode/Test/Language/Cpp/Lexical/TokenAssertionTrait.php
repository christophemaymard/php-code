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
     * @param   TokenInterface  $tkn        The token to assert.
     * @param   string          $message    The message (default to an empty string).
     */
    public static function assertEOFToken(TokenInterface $tkn, string $message = ''): void
    {
        self::assertToken('', 0, $tkn, $message);
    }
    
    /**
     * Asserts the specified token.
     * 
     * @param   string          $lexeme     The expected lexeme.
     * @param   int             $tag        The expected tag.
     * @param   TokenInterface  $tkn        The token to assert.
     * @param   string          $message    The message (default to an empty string).
     */
    public static function assertToken(
        string $lexeme, 
        int $tag, 
        TokenInterface $tkn, 
        string $message = ''
    ): void
    {
        static::assertThat(
            $tkn, 
            new IsTokenEqualConstraint($lexeme, $tag), 
            $message
        );
    }
}

