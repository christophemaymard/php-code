<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Parsing;

use PhpCode\Exception\FormatException;
use PhpCode\Test\Language\Cpp\Parsing\InvalidData;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Parsing\InvalidData} 
 * class.
 * 
 * @group   parsing
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class InvalidDataTest extends TestCase
{
    /**
     * Tests that _construct() stores the stream and the exception message.
     */
    public function test__constructStoresStreamAndMessage(): void
    {
        $sut = new InvalidData('foo', 'Exception message.');
        self::assertSame('foo', $sut->getStream());
        self::assertSame('Exception message.', $sut->getExceptionMessage());
    }
    
    /**
     * Tests that getName() returns a string.
     */
    public function testGetNameReturnsString(): void
    {
        $sut = new InvalidData('foo', 'Exception message.');
        self::assertSame('', $sut->getName());
        
        $sut->setName('bar');
        self::assertSame('bar', $sut->getName());
        
        $sut->setName('baz');
        self::assertSame('baz', $sut->getName());
        
        $sut->setName('');
        self::assertSame('', $sut->getName());
    }
    
    /**
     * Tests that hasName() returns FALSE when the name is not an empty 
     * string, otherwise FALSE.
     */
    public function testHasNameReturnsBool(): void
    {
        $sut = new InvalidData('foo', 'Exception message.');
        self::assertFalse($sut->hasName());
        
        $sut->setName('bar');
        self::assertTrue($sut->hasName());
        
        $sut->setName('baz');
        self::assertTrue($sut->hasName());
        
        $sut->setName('');
        self::assertFalse($sut->hasName());
    }
    
    /**
     * Tests that getStandards() returns an indexed array of integers.
     */
    public function testGetStandardsReturnsArrayInt(): void
    {
        $sut = new InvalidData('foo', 'Exception message.');
        self::assertSame([1, 2, 4, 8], $sut->getStandards());
    }
    
    /**
     * Tests that getExceptionName() returns a string.
     */
    public function testGetExceptionNameReturnsString(): void
    {
        $sut = new InvalidData('foo', 'Exception message.');
        
        self::assertSame(FormatException::class, $sut->getExceptionName());
        
        $sut->setExceptionName('barException');
        self::assertSame('barException', $sut->getExceptionName());
        
        $sut->setExceptionName('bazException');
        self::assertSame('bazException', $sut->getExceptionName());
    }
}

