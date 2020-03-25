<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\SimpleTypeSpecifier;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declaration\SimpleTypeSpecifier} 
 * class.
 * 
 * @group   declaration
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleTypeSpecifierTest extends TestCase
{
    /**
     * Tests that __construct() throws an exception when instantiated.
     */
    public function test__constructThrowsExceptionWhenInstantiated(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        $sut = new SimpleTypeSpecifier();
    }
    
    /**
     * Tests that createInt() returns new instances of SimpleTypeSpecifier.
     */
    public function testCreateIntReturnsNewInstanceSimpleTypeSpecifier(): void
    {
        $stSpec1 = SimpleTypeSpecifier::createInt();
        $stSpec2 = SimpleTypeSpecifier::createInt();
        self::assertNotSame($stSpec1, $stSpec2);
    }
    
    /**
     * Tests that createFloat() returns new instances of SimpleTypeSpecifier.
     */
    public function testCreateFloatReturnsNewInstanceSimpleTypeSpecifier(): void
    {
        $stSpec1 = SimpleTypeSpecifier::createFloat();
        $stSpec2 = SimpleTypeSpecifier::createFloat();
        self::assertNotSame($stSpec1, $stSpec2);
    }
    
    /**
     * Tests that createBool() returns new instances of SimpleTypeSpecifier.
     */
    public function testCreateBoolReturnsNewInstanceSimpleTypeSpecifier(): void
    {
        $stSpec1 = SimpleTypeSpecifier::createBool();
        $stSpec2 = SimpleTypeSpecifier::createBool();
        self::assertNotSame($stSpec1, $stSpec2);
    }
    
    /**
     * Tests that createChar() returns new instances of SimpleTypeSpecifier.
     */
    public function testCreateCharReturnsNewInstanceSimpleTypeSpecifier(): void
    {
        $stSpec1 = SimpleTypeSpecifier::createChar();
        $stSpec2 = SimpleTypeSpecifier::createChar();
        self::assertNotSame($stSpec1, $stSpec2);
    }
    
    /**
     * Tests that isInt() returns TRUE when the instance has been created by 
     * createInt().
     */
    public function testIsIntReturnsTrueWhenCreateInt(): void
    {
        $sut = SimpleTypeSpecifier::createInt();
        self::assertTrue($sut->isInt());
    }
    
    /**
     * Tests that isInt() returns FALSE when the instance has been created by 
     * createFloat().
     */
    public function testIsIntReturnsFalseWhenCreateFloat(): void
    {
        $sut = SimpleTypeSpecifier::createFloat();
        self::assertFalse($sut->isInt());
    }
    
    /**
     * Tests that isInt() returns FALSE when the instance has been created by 
     * createBool().
     */
    public function testIsIntReturnsFalseWhenCreateBool(): void
    {
        $sut = SimpleTypeSpecifier::createBool();
        self::assertFalse($sut->isInt());
    }
    
    /**
     * Tests that isInt() returns FALSE when the instance has been created by 
     * createChar().
     */
    public function testIsIntReturnsFalseWhenCreateChar(): void
    {
        $sut = SimpleTypeSpecifier::createChar();
        self::assertFalse($sut->isInt());
    }
    
    /**
     * Tests that isFloat() returns FALSE when the instance has been created by 
     * createInt().
     */
    public function testIsFloatReturnsFalseWhenCreateInt(): void
    {
        $sut = SimpleTypeSpecifier::createInt();
        self::assertFalse($sut->isFloat());
    }
    
    /**
     * Tests that isFloat() returns TRUE when the instance has been created by 
     * createFloat().
     */
    public function testIsFloatReturnsTrueWhenCreateFloat(): void
    {
        $sut = SimpleTypeSpecifier::createFloat();
        self::assertTrue($sut->isFloat());
    }
    
    /**
     * Tests that isFloat() returns FALSE when the instance has been created by 
     * createBool().
     */
    public function testIsFloatReturnsFalseWhenCreateBool(): void
    {
        $sut = SimpleTypeSpecifier::createBool();
        self::assertFalse($sut->isFloat());
    }
    
    /**
     * Tests that isFloat() returns FALSE when the instance has been created by 
     * createChar().
     */
    public function testIsFloatReturnsFalseWhenCreateChar(): void
    {
        $sut = SimpleTypeSpecifier::createChar();
        self::assertFalse($sut->isFloat());
    }
    
    /**
     * Tests that isBool() returns FALSE when the instance has been created 
     * by createInt().
     */
    public function testIsBoolReturnsFalseWhenCreateInt(): void
    {
        $sut = SimpleTypeSpecifier::createInt();
        self::assertFalse($sut->isBool());
    }
    
    /**
     * Tests that isBool() returns FALSE when the instance has been created 
     * by createFloat().
     */
    public function testIsBoolReturnsFalseWhenCreateFloat(): void
    {
        $sut = SimpleTypeSpecifier::createFloat();
        self::assertFalse($sut->isBool());
    }
    
    /**
     * Tests that isBool() returns TRUE when the instance has been created 
     * by createBool().
     */
    public function testIsBoolReturnsTrueWhenCreateBool(): void
    {
        $sut = SimpleTypeSpecifier::createBool();
        self::assertTrue($sut->isBool());
    }
    
    /**
     * Tests that isBool() returns FALSE when the instance has been created 
     * by createChar().
     */
    public function testIsBoolReturnsFalseWhenCreateChar(): void
    {
        $sut = SimpleTypeSpecifier::createChar();
        self::assertFalse($sut->isBool());
    }
    
    /**
     * Tests that isChar() returns FALSE when the instance has been created 
     * by createInt().
     */
    public function testIsCharReturnsFalseWhenCreateInt(): void
    {
        $sut = SimpleTypeSpecifier::createInt();
        self::assertFalse($sut->isChar());
    }
    
    /**
     * Tests that isChar() returns FALSE when the instance has been created 
     * by createFloat().
     */
    public function testIsCharReturnsFalseWhenCreateFloat(): void
    {
        $sut = SimpleTypeSpecifier::createFloat();
        self::assertFalse($sut->isChar());
    }
    
    /**
     * Tests that isChar() returns FALSE when the instance has been created 
     * by createBool().
     */
    public function testIsCharReturnsFalseWhenCreateBool(): void
    {
        $sut = SimpleTypeSpecifier::createBool();
        self::assertFalse($sut->isChar());
    }
    
    /**
     * Tests that isChar() returns TRUE when the instance has been created 
     * by createChar().
     */
    public function testIsCharReturnsTrueWhenCreateChar(): void
    {
        $sut = SimpleTypeSpecifier::createChar();
        self::assertTrue($sut->isChar());
    }
}

