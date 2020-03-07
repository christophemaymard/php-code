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
     * Tests that isInt() returns TRUE when the instance has been created by 
     * createInt().
     */
    public function testIsIntReturnsTrueWhenCreateInt(): void
    {
        $sut = SimpleTypeSpecifier::createInt();
        self::assertTrue($sut->isInt());
    }
}

