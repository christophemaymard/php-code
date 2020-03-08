<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Lexical;

use PhpCode\Language\Cpp\Lexical\Lexer;
use PhpCode\Test\ProphecyFactory;
use PhpCode\Test\Language\Cpp\Lexical\TokenAssertionTrait;
use PhpCode\Test\Language\Cpp\Specification\LanguageContextInterfaceDoubleFactory;
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
    use TokenAssertionTrait;
    
    /**
     * @var LanguageContextInterfaceDoubleFactory
     */
    private $lciDoubleFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->lciDoubleFactory = new LanguageContextInterfaceDoubleFactory(
            new ProphecyFactory($this)
        );
    }
    
    /**
     * Tests that getToken() returns new instances of token with an empty 
     * lexeme and the EOF tag when instantiated to indicate the end of the 
     * stream.
     */
    public function testGetTokenReturnsNewInstanceEOFTokenWhenInstantiated(): void
    {
        $languageContext = $this->lciDoubleFactory->createDouble([], [], []);
        
        $sut = new Lexer($languageContext);
        
        $tkn1 = $sut->getToken();
        self::assertEOFToken($tkn1);
        
        $tkn2 = $sut->getToken();
        self::assertEOFToken($tkn2);
        
        self::assertNotSame($tkn1, $tkn2);
    }
    
    /**
     * Tests that getToken() returns an instance of token.
     * 
     * @param   string      $stream             The stream to set.
     * @param   array[]     $tokens             The expected tokens.
     * @param   array[]     $keywords           The keywords.
     * @param   array[]     $punctuators        The punctuators.
     * @param   int[]       $punctuatorLengths  The punctuator lengths.
     * 
     * @dataProvider    getStreamsProvider
     */
    public function testGetTokenReturnsToken(
        string $stream, 
        array $tokens, 
        array $keywords, 
        array $punctuators, 
        array $punctuatorLengths
    ): void
    {
        $languageContext = $this->lciDoubleFactory->createDouble(
            $keywords, 
            $punctuators, 
            $punctuatorLengths
        );
        
        $sut = new Lexer($languageContext);
        $sut->setStream($stream);
        
        foreach ($tokens as list($lexeme, $tag)) {
            self::assertToken($sut->getToken(), $lexeme, $tag);
        }
        
        self::assertEOFToken($sut->getToken(), 'The last token must be the EOF token.');
    }
    
    /**
     * Tests that lookAhead() returns the instance of the next available 
     * token, without changing the current position.
     * 
     * @param   int $n
     * 
     * @dataProvider    getNextTokenLookAheadNsProvider
     */
    public function testLookAheadReturnsNextToken(int $n): void
    {
        $languageContext = $this->lciDoubleFactory->createDouble([], [], []);
        
        $sut = new Lexer($languageContext);
        $sut->setStream('foo bar baz');
        
        self::assertToken($sut->lookAhead($n), 'foo', 2);
        self::assertEOFToken($sut->lookAhead(4));
        self::assertEOFToken($sut->lookAhead(10));
        self::assertToken($sut->getToken(), 'foo', 2);
    }
    
    /**
     * Tests that lookAhead() returns the instance of the N-th available 
     * token without changing the current position.
     */
    public function testLookAheadReturnsNthTokenWhenNth(): void
    {
        $languageContext = $this->lciDoubleFactory->createDouble([], [], []);
        
        $sut = new Lexer($languageContext);
        $sut->setStream('foo bar baz');
        
        self::assertToken($sut->lookAhead(3), 'baz', 2);
        self::assertEOFToken($sut->lookAhead(4));
        self::assertEOFToken($sut->lookAhead(10));
        self::assertToken($sut->getToken(), 'foo', 2);
    }
    
    /**
     * Returns a set of streams with the expected tokens that must be 
     * produced (except the last one that is always an EOF token).
     * 
     * @return  array[] An indexed array of arrays where
     *                  [0] is the stream, 
     *                  [1] is the expected tokens,
     *                  [2] is the keywords, 
     *                  [3] is the punctuators.
     *                  [4] is the punctuator lengths, 
     */
    public function getStreamsProvider(): array
    {
        return [
            'Unknown tokens' => [
                'éè', 
                [['é', 1], ['è', 1]], 
                [], 
                [], 
                [], 
            ], 
            'White spaces are skipped' => [
                " \t \r \n  \t \r \n    \t \r \n ", 
                [], 
                [], 
                [], 
                [], 
            ], 
            'White spaces are skipped before' => [
                " \t \r \n é  \t \r \n è  \t \r \n ", 
                [['é', 1], ['è', 1]], 
                [], 
                [], 
                [], 
            ], 
            'Identifier starts with underscore' => [
                '_', 
                [['_', 2],], 
                [], 
                [], 
                [], 
            ], 
            'Identifier starts with lower case letter' => [
                'a', 
                [['a', 2],], 
                [], 
                [], 
                [], 
            ], 
            'Identifier starts with upper case letter' => [
                'Z', 
                [['Z', 2],], 
                [], 
                [], 
                [], 
            ], 
            'Identifier contains digit' => [
                'c0123456789', 
                [['c0123456789', 2],], 
                [], 
                [], 
                [], 
            ], 
            'Identifier starts with digit' => [
                '0t', 
                [['0', 1], ['t', 2],], 
                [], 
                [], 
                [], 
            ], 
            'Identifiers with white spaces' => [
                " _foo1\tbar2\rbaz3\n ", 
                [['_foo1', 2], ['bar2', 2], ['baz3', 2],], 
                [], 
                [], 
                [], 
            ], 
            'Keyword foo' => [
                'foo', 
                [['foo', 100000]], 
                [['foo', 100000]], 
                [], 
                [], 
            ], 
            'Keyword foo with white spaces' => [
                "  \tfoo\n  \r  ", 
                [['foo', 100000]], 
                [['foo', 100000]], 
                [], 
                [], 
            ], 
            'Punctuator <<<' => [
                '<<<', 
                [['<<<', 200000]], 
                [], 
                [['<<<', 200000]], 
                [3], 
            ], 
            'Punctuator priority (the longest first)' => [
                '<<<', 
                [['<<<', 200000]], 
                [], 
                [['<', 300000], ['<<<', 200000]], 
                [3, 1], 
            ], 
            'Punctuator <<< with white spaces' => [
                "  \t<<<\n  \r  ", 
                [['<<<', 200000]], 
                [], 
                [['<<<', 200000]], 
                [3], 
            ], 
            'Identifier foo, keyword bar, punctuator <<< and unknown é with white spaces' => [
                " foo \tbar é\n <<< \r  ", 
                [['foo', 2], ['bar', 100000], ['é', 1], ['<<<', 200000]], 
                [['bar', 100000]], 
                [['<<<', 200000]], 
                [3], 
            ], 
        ];
    }
    
    /**
     * Returns a data set of parameter values that will return the next 
     * token when calling lookAhead().
     * 
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where 
     *                  [0] is the n parameter.
     */
    public function getNextTokenLookAheadNsProvider(): array
    {
        return [
            'Negative' => [
                -1, 
            ], 
            'Zero' => [
                0, 
            ], 
            'One' => [
                1, 
            ], 
        ];
    }
}

