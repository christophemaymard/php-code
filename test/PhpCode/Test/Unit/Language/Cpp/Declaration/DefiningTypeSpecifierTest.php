<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\DefiningTypeSpecifier;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declaration\DefiningTypeSpecifier} 
 * class.
 * 
 * @group   declaration
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DefiningTypeSpecifierTest extends TestCase
{
    /**
     * Tests that __construct() throws an exception when instantiated.
     */
    public function test__constructThrowsExceptionWhenInstantiated(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        $sut = new DefiningTypeSpecifier();
    }
    
    /**
     * Tests that createTypeSpecifier() returns new instances of 
     * DefiningTypeSpecifier.
     */
    public function testCreateTypeSpecifierReturnsNewInstanceDefiningTypeSpecifier(): void
    {
        $typeSpec = ConceptDoubleBuilder::createTypeSpecifier($this)->getDouble();
        
        $defSypeSpec1 = DefiningTypeSpecifier::createTypeSpecifier($typeSpec);
        $defSypeSpec2 = DefiningTypeSpecifier::createTypeSpecifier($typeSpec);
        self::assertNotSame($defSypeSpec1, $defSypeSpec2);
    }
    
    /**
     * Tests that getTypeSpecifier() returns the instance of 
     * TypeSpecifier when the instance has been created by 
     * createTypeSpecifier().
     */
    public function testGetTypeSpecifierReturnsTypeSpecifierWhenCreateTypeSpecifier(): void
    {
        $typeSpec = ConceptDoubleBuilder::createTypeSpecifier($this)->getDouble();
        
        $sut = DefiningTypeSpecifier::createTypeSpecifier($typeSpec);
        self::assertSame($typeSpec, $sut->getTypeSpecifier());
    }
}

