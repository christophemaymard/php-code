<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\CVQualifier;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declarator\CVQualifier} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class CVQualifierTest extends TestCase
{
    /**
     * Tests that __construct() throws an exception.
     */
    public function test__constructThrowsException(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        $sut = new CVQualifier();
    }
    
    /**
     * Tests that createConst() returns new instances of CVQualifier.
     */
    public function testCreateConstReturnsNewInstanceCVQualifier(): void
    {
        $cv1 = CVQualifier::createConst();
        $cv2 = CVQualifier::createConst();
        self::assertNotSame($cv1, $cv2);
    }
    
    /**
     * Tests that createVolatile() returns new instances of CVQualifier.
     */
    public function testCreateVolatileReturnsNewInstanceCVQualifier(): void
    {
        $cv1 = CVQualifier::createVolatile();
        $cv2 = CVQualifier::createVolatile();
        self::assertNotSame($cv1, $cv2);
    }
    
    /**
     * Tests that isConst() returns TRUE when the instance has been created 
     * by createConst().
     */
    public function testIsConstReturnsTrueWhenCreateConst(): void
    {
        $sut = CVQualifier::createConst();
        self::assertTrue($sut->isConst());
    }
    
    /**
     * Tests that isConst() returns FALSE when the instance has been created 
     * by createVolatile().
     */
    public function testIsConstReturnsFalseWhenCreateVolatile(): void
    {
        $sut = CVQualifier::createVolatile();
        self::assertFalse($sut->isConst());
    }
    
    /**
     * Tests that isVolatile() returns FALSE when the instance has been 
     * created by createConst().
     */
    public function testIsVolatileReturnsFalseWhenCreateConst(): void
    {
        $sut = CVQualifier::createConst();
        self::assertFalse($sut->isVolatile());
    }
    
    /**
     * Tests that isVolatile() returns TRUE when the instance has been 
     * created by createVolatile().
     */
    public function testIsVolatileReturnsTrueWhenCreateVolatile(): void
    {
        $sut = CVQualifier::createVolatile();
        self::assertTrue($sut->isVolatile());
    }
}

