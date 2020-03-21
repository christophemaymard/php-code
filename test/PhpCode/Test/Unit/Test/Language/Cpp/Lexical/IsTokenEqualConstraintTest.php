<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Lexical;

use PhpCode\Test\Language\Cpp\Lexical\IsTokenEqualConstraint;
use PhpCode\Test\Language\Cpp\Lexical\TokenInterfaceDoubleBuilder;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Lexical\IsTokenEqualConstraint} 
 * class.
 * 
 * @group   lexical
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class IsTokenEqualConstraintTest extends TestCase
{
    /**
     * Tests that toString() returns a string.
     */
    public function testToStringReturnsString(): void
    {
        $sut = new IsTokenEqualConstraint('foo', 2);
        self::assertSame(
            'is an instance of TokenInterface with the lexeme "foo" and the tag 2', 
            $sut->toString()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when not instance of TokenInterface.
     */
    public function testMatchesReturnsFalseWhenNotInstanceTokenInterface(): void
    {
        $sut = new IsTokenEqualConstraint('foo', 2);
        self::assertFalse($sut->evaluate(NULL, '', TRUE));
    }
    
    /**
     * Tests that matches() returns FALSE when the lexeme is not the same.
     */
    public function testMatchesReturnsFalseWhenLexemeIsNotSame(): void
    {
        $token = $this->createTokenInterfaceDoubleBuilder()
            ->buildGetLexeme('bar')
            ->getDouble();
        
        $sut = new IsTokenEqualConstraint('foo', 2);
        self::assertFalse($sut->evaluate($token, '', TRUE));
    }
    
    /**
     * Tests that matches() returns FALSE when the tag is not the same.
     */
    public function testMatchesReturnsFalseWhenTagIsNotSame(): void
    {
        $token = $this->createTokenInterfaceDoubleBuilder()
            ->buildGetLexeme('foo')
            ->buildGetTag(9)
            ->getDouble();
        
        $sut = new IsTokenEqualConstraint('foo', 2);
        self::assertFalse($sut->evaluate($token, '', TRUE));
    }
    
    /**
     * Tests that matches() returns TRUE when the token is the same.
     */
    public function testMatchesReturnsTrueWhenTokenIsEqual(): void
    {
        $token = $this->createTokenInterfaceDoubleBuilder()
            ->buildGetLexeme('foo')
            ->buildGetTag(2)
            ->getDouble();
        
        $sut = new IsTokenEqualConstraint('foo', 2);
        self::assertTrue($sut->evaluate($token, '', TRUE));
    }
    
    /**
     * Tests that failureDescription() is called when not instance of 
     * TokenInterface.
     */
    public function testFailureDescriptionIsCalledWhenNotInstanceTokenInterface(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches(
            '` is an instance of TokenInterface with the lexeme "foo" and the tag 2`'
        );
        
        $sut = new IsTokenEqualConstraint('foo', 2);
        self::assertFalse($sut->evaluate(NULL, '', FALSE));
    }
    
    /**
     * Tests that failureDescription() is called when the lexeme is not the 
     * same.
     */
    public function testFailureDescriptionIsCalledWhenLexemeIsNotSame(): void
    {
        $token = $this->createTokenInterfaceDoubleBuilder()
            ->buildGetLexeme('bar')
            ->buildGetTag(9)
            ->getDouble();
        
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches(
            '` the token has the lexeme "foo" and the tag 2, instead it has the lexeme "bar" and the tag 9`'
        );
        
        $sut = new IsTokenEqualConstraint('foo', 2);
        self::assertFalse($sut->evaluate($token, '', FALSE));
    }
    
    /**
     * Tests that failureDescription() is called when the tag is not the same.
     */
    public function testFailureDescriptionIsCalledWhenTagIsNotSame(): void
    {
        $token = $this->createTokenInterfaceDoubleBuilder()
            ->buildGetLexeme('foo')
            ->buildGetTag(9)
            ->getDouble();
        
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches(
            '` the token has the lexeme "foo" and the tag 2, instead it has the lexeme "foo" and the tag 9`'
        );
        
        $sut = new IsTokenEqualConstraint('foo', 2);
        self::assertFalse($sut->evaluate($token, '', FALSE));
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

