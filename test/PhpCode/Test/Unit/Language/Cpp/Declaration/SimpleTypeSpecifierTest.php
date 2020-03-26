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
     * Tests that createWCharT() returns new instances of SimpleTypeSpecifier.
     */
    public function testCreateWCharTReturnsNewInstanceSimpleTypeSpecifier(): void
    {
        $stSpec1 = SimpleTypeSpecifier::createWCharT();
        $stSpec2 = SimpleTypeSpecifier::createWCharT();
        self::assertNotSame($stSpec1, $stSpec2);
    }
    
    /**
     * Tests that createShort() returns new instances of SimpleTypeSpecifier.
     */
    public function testCreateShortReturnsNewInstanceSimpleTypeSpecifier(): void
    {
        $stSpec1 = SimpleTypeSpecifier::createShort();
        $stSpec2 = SimpleTypeSpecifier::createShort();
        self::assertNotSame($stSpec1, $stSpec2);
    }
    
    /**
     * Tests that isInt() returns FALSE when the instance is not created by 
     * createInt().
     * 
     * @param   SimpleTypeSpecifier $sut    The system under test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierIntProvider
     */
    public function testIsIntReturnsFalseWhenNotCreateInt(
        SimpleTypeSpecifier $sut
    ): void
    {
        self::assertFalse($sut->isInt());
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
     * Tests that isFloat() returns FALSE when the instance is not created by 
     * createFloat().
     * 
     * @param   SimpleTypeSpecifier $sut    The system under test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierFloatProvider
     */
    public function testIsFloatReturnsFalseWhenNotCreateFloat(
        SimpleTypeSpecifier $sut
    ): void
    {
        self::assertFalse($sut->isFloat());
    }
    
    /**
     * Tests that isFloat() returns TRUE when the instance has been created 
     * by createFloat().
     */
    public function testIsFloatReturnsTrueWhenCreateFloat(): void
    {
        $sut = SimpleTypeSpecifier::createFloat();
        self::assertTrue($sut->isFloat());
    }
    
    /**
     * Tests that isBool() returns FALSE when the instance is not created by 
     * createBool().
     * 
     * @param   SimpleTypeSpecifier $sut    The system under test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierBoolProvider
     */
    public function testIsBoolReturnsFalseWhenNotCreateBool(
        SimpleTypeSpecifier $sut
    ): void
    {
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
     * Tests that isChar() returns FALSE when the instance is not created by 
     * createChar().
     * 
     * @param   SimpleTypeSpecifier $sut    The system under test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierCharProvider
     */
    public function testIsCharReturnsFalseWhenNotCreateChar(
        SimpleTypeSpecifier $sut
    ): void
    {
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
    
    /**
     * Tests that isWCharT() returns FALSE when the instance is not created 
     * by createWCharT().
     * 
     * @param   SimpleTypeSpecifier $sut    The system under test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierWCharTProvider
     */
    public function testIsWCharTReturnsFalseWhenNotCreateWCharT(
        SimpleTypeSpecifier $sut
    ): void
    {
        self::assertFalse($sut->isWCharT());
    }
    
    /**
     * Tests that isWCharT() returns TRUE when the instance has been created 
     * by createWCharT().
     */
    public function testIsWCharTReturnsTrueWhenCreateWCharT(): void
    {
        $sut = SimpleTypeSpecifier::createWCharT();
        self::assertTrue($sut->isWCharT());
    }
    
    /**
     * Tests that isShort() returns FALSE when the instance is not created by 
     * createShort().
     * 
     * @param   SimpleTypeSpecifier $sut    The system under test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierShortProvider
     */
    public function testIsShortReturnsFalseWhenNotCreateShort(
        SimpleTypeSpecifier $sut
    ): void
    {
        self::assertFalse($sut->isShort());
    }
    
    /**
     * Tests that isShort() returns TRUE when the instance has been created 
     * by createShort().
     */
    public function testIsShortReturnsTrueWhenCreateShort(): void
    {
        $sut = SimpleTypeSpecifier::createShort();
        self::assertTrue($sut->isShort());
    }
    
    /**
     * Returns a set of systems under test that are not simple type 
     * specifier "int".
     * 
     * @return  array[]
     */
    public function getNotSimpleTypeSpecifierIntProvider(): array
    {
        return [
            'Simple type specifier "float"' => [
                SimpleTypeSpecifier::createFloat(), 
            ], 
            'Simple type specifier "bool"' => [
                SimpleTypeSpecifier::createBool(), 
            ], 
            'Simple type specifier "char"' => [
                SimpleTypeSpecifier::createChar(), 
            ], 
            'Simple type specifier "wchar_t"' => [
                SimpleTypeSpecifier::createWCharT(), 
            ], 
            'Simple type specifier "short"' => [
                SimpleTypeSpecifier::createShort(), 
            ], 
        ];
    }
    
    /**
     * Returns a set of systems under test that are not simple type 
     * specifier "float".
     * 
     * @return  array[]
     */
    public function getNotSimpleTypeSpecifierFloatProvider(): array
    {
        return [
            'Simple type specifier "int"' => [
                SimpleTypeSpecifier::createInt(), 
            ], 
            'Simple type specifier "bool"' => [
                SimpleTypeSpecifier::createBool(), 
            ], 
            'Simple type specifier "char"' => [
                SimpleTypeSpecifier::createChar(), 
            ], 
            'Simple type specifier "wchar_t"' => [
                SimpleTypeSpecifier::createWCharT(), 
            ], 
            'Simple type specifier "short"' => [
                SimpleTypeSpecifier::createShort(), 
            ], 
        ];
    }
    
    /**
     * Returns a set of systems under test that are not simple type 
     * specifier "bool".
     * 
     * @return  array[]
     */
    public function getNotSimpleTypeSpecifierBoolProvider(): array
    {
        return [
            'Simple type specifier "int"' => [
                SimpleTypeSpecifier::createInt(), 
            ], 
            'Simple type specifier "float"' => [
                SimpleTypeSpecifier::createFloat(), 
            ], 
            'Simple type specifier "char"' => [
                SimpleTypeSpecifier::createChar(), 
            ], 
            'Simple type specifier "wchar_t"' => [
                SimpleTypeSpecifier::createWCharT(), 
            ], 
            'Simple type specifier "short"' => [
                SimpleTypeSpecifier::createShort(), 
            ], 
        ];
    }
    
    /**
     * Returns a set of systems under test that are not simple type 
     * specifier "char".
     * 
     * @return  array[]
     */
    public function getNotSimpleTypeSpecifierCharProvider(): array
    {
        return [
            'Simple type specifier "int"' => [
                SimpleTypeSpecifier::createInt(), 
            ], 
            'Simple type specifier "float"' => [
                SimpleTypeSpecifier::createFloat(), 
            ], 
            'Simple type specifier "bool"' => [
                SimpleTypeSpecifier::createBool(), 
            ], 
            'Simple type specifier "wchar_t"' => [
                SimpleTypeSpecifier::createWCharT(), 
            ], 
            'Simple type specifier "short"' => [
                SimpleTypeSpecifier::createShort(), 
            ], 
        ];
    }
    
    /**
     * Returns a set of systems under test that are not simple type 
     * specifier "wchar_t".
     * 
     * @return  array[]
     */
    public function getNotSimpleTypeSpecifierWCharTProvider(): array
    {
        return [
            'Simple type specifier "int"' => [
                SimpleTypeSpecifier::createInt(), 
            ], 
            'Simple type specifier "float"' => [
                SimpleTypeSpecifier::createFloat(), 
            ], 
            'Simple type specifier "bool"' => [
                SimpleTypeSpecifier::createBool(), 
            ], 
            'Simple type specifier "char"' => [
                SimpleTypeSpecifier::createChar(), 
            ], 
            'Simple type specifier "short"' => [
                SimpleTypeSpecifier::createShort(), 
            ], 
        ];
    }
    
    /**
     * Returns a set of systems under test that are not simple type 
     * specifier "short".
     * 
     * @return  array[]
     */
    public function getNotSimpleTypeSpecifierShortProvider(): array
    {
        return [
            'Simple type specifier "int"' => [
                SimpleTypeSpecifier::createInt(), 
            ], 
            'Simple type specifier "float"' => [
                SimpleTypeSpecifier::createFloat(), 
            ], 
            'Simple type specifier "bool"' => [
                SimpleTypeSpecifier::createBool(), 
            ], 
            'Simple type specifier "char"' => [
                SimpleTypeSpecifier::createChar(), 
            ], 
            'Simple type specifier "wchar_t"' => [
                SimpleTypeSpecifier::createWCharT(), 
            ], 
        ];
    }
}

