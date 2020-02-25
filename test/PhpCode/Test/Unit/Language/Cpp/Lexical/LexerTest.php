<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Lexical;

use PhpCode\Language\Cpp\Lexical\Lexer;
use PhpCode\Language\Cpp\Lexical\TokenInterface;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Lexical\Lexer} 
 * class.
 * 
 * @group   lexical
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class LexerTest extends TestCase
{
    /**
     * Asserts that the specified token is EOF.
     * 
     * @param   TokenInterface  $tkn    The token to assert.
     */
    private static function assertEOFToken(TokenInterface $tkn): void
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
    private static function assertToken(TokenInterface $tkn, string $lexeme, int $tag): void
    {
        self::assertSame($tag, $tkn->getTag(), 'Tag.');
        self::assertSame($lexeme, $tkn->getLexeme(), 'Lexeme.');
    }
    
    /**
     * Tests that getToken() returns new instances of token with an empty 
     * lexeme and the EOF tag when instantiated to indicate the end of the 
     * stream.
     */
    public function testGetTokenReturnsNewInstanceEOFTokenWhenInstantiated(): void
    {
        $sut = new Lexer();
        
        $tkn1 = $sut->getToken();
        self::assertEOFToken($tkn1);
        
        $tkn2 = $sut->getToken();
        self::assertEOFToken($tkn2);
        
        self::assertNotSame($tkn1, $tkn2);
    }
    
    /**
     * Tests that getToken() returns an instance of token.
     * 
     * @param   string  $stream The stream to set.
     * @param   array[] $tokens The array of the expected tokens.
     * 
     * @dataProvider    getStreamsProvider
     */
    public function testGetTokenReturnsToken(string $stream, array $tokens): void
    {
        $sut = new Lexer();
        $sut->setStream($stream);
        
        foreach ($tokens as list($lexeme, $tag)) {
            self::assertToken($sut->getToken(), $lexeme, $tag);
        }
        
        self::assertEOFToken($sut->getToken(), 'The last token must be the EOF token.');
    }
    
    /**
     * Returns a set of streams with the expected tokens that must be 
     * produced (except the last one that is always an EOF token).
     * 
     * @return  array[]
     */
    public function getStreamsProvider(): array
    {
        return [
            'Unknown tokens' => [
                'éè', 
                [['é', 1], ['è', 1]], 
            ], 
            'White spaces are skipped' => [
                " \t \r \n  \t \r \n    \t \r \n ", 
                [], 
            ], 
            'White spaces are skipped before' => [
                " \t \r \n é  \t \r \n è  \t \r \n ", 
                [['é', 1], ['è', 1]], 
            ], 
            'Identifier starts with underscore' => [
                '_', 
                [['_', 2],], 
            ], 
            'Identifier starts with lower case letter' => [
                'a', 
                [['a', 2],], 
            ], 
            'Identifier starts with upper case letter' => [
                'Z', 
                [['Z', 2],], 
            ], 
            'Identifier contains digit' => [
                'c0123456789', 
                [['c0123456789', 2],], 
            ], 
            'Identifier starts with digit' => [
                '0t', 
                [['0', 1], ['t', 2],], 
            ], 
            'Identifiers with white spaces' => [
                " _foo1\tbar2\rbaz3\n ", 
                [['_foo1', 2], ['bar2', 2], ['baz3', 2],], 
            ], 
        ];
    }
}

