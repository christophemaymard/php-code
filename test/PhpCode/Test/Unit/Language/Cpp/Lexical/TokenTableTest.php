<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Lexical;

use PhpCode\Exception\InvalidOperationException;
use PhpCode\Language\Cpp\Lexical\TokenTable;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Lexical\TokenTable} 
 * class.
 * 
 * @group   lexical
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TokenTableTest extends TestCase
{
    /**
     * The system under test.
     * @var TokenTable
     */
    private $sut;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new TokenTable();
    }
    
    /**
     * Tests that hasToken() returns a boolean.
     */
    public function testHasTokenReturnsBool(): void
    {
        self::assertSame(FALSE, $this->sut->hasToken('foo'));
        
        $this->sut->addToken('bar', 2);
        self::assertSame(TRUE, $this->sut->hasToken('bar'));
    }
    
    /**
     * Tests that addToken() throws an exception when a token with the 
     * specified lexeme is already present.
     * 
     * @param   string  $lexeme The lexeme to use.
     * 
     * @dataProvider    getLexemesProvider()
     */
    public function testAddTokenThrowsExceptionWhenTokenWithLexemeIsAlreadyPresent(string $lexeme): void
    {
        $this->sut->addToken($lexeme, 1);
        
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage(\sprintf(
            'A token, with the lexeme "%s", is already present.', 
            $lexeme
        ));
        
        $this->sut->addToken($lexeme, 2);
    }
    
    /**
     * Tests that getTag() returns the tag of the token with th specified 
     * lexeme.
     */
    public function testGetTagReturnsIntWhenTokenIsPresent(): void
    {
        $this->sut->addToken('foo', 2);
        self::assertSame(2, $this->sut->getTag('foo'));
        
        $this->sut->addToken('bar', 9);
        self::assertSame(9, $this->sut->getTag('bar'));
        
        // Same tag as 'bar'.
        $this->sut->addToken('baz', 9);
        self::assertSame(9, $this->sut->getTag('baz'));
    }
    
    /**
     * Tests that getTag() throws an exception when there is no token with 
     * specified lexeme.
     * 
     * @param   string  $lexeme The lexeme to use.
     * 
     * @dataProvider    getLexemesProvider()
     */
    public function testGetTagThrowsExceptionWhenNoTokenWithLexemePresent(string $lexeme): void
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage(\sprintf(
            'There is no token with the lexeme "%s".', 
            $lexeme
        ));
        
        $this->sut->getTag($lexeme);
    }
    
    /**
     * Returns a set of lexemes.
     * 
     * @return  array[]
     */
    public function getLexemesProvider(): array
    {
        return [
            [ 'foo', ], 
            [ 'bar', ], 
        ];
    }
}

