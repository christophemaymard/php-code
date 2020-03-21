<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\TypeSpecifier;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declaration\TypeSpecifier} 
 * class.
 * 
 * @group   declaration
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TypeSpecifierTest extends TestCase
{
    /**
     * Tests that __construct() throws an exception when instantiated.
     */
    public function test__constructThrowsExceptionWhenInstantiated(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        $sut = new TypeSpecifier();
    }
    
    /**
     * Tests that createSimpleTypeSpecifier() returns new instances of 
     * TypeSpecifier.
     */
    public function testCreateSimpleTypeSpecifierReturnsNewInstanceTypeSpecifier(): void
    {
        $stSpec = ConceptDoubleBuilder::createSimpleTypeSpecifier($this)->getDouble();
        
        $typeSpec1 = TypeSpecifier::createSimpleTypeSpecifier($stSpec);
        $typeSpec2 = TypeSpecifier::createSimpleTypeSpecifier($stSpec);
        self::assertNotSame($typeSpec1, $typeSpec2);
    }
    
    /**
     * Tests that getSimpleTypeSpecifier() returns the instance of 
     * SimpleTypeSpecifier when the instance has been created by 
     * createSimpleTypeSpecifier().
     */
    public function testGetSimpleTypeSpecifierReturnsSimpleTypeSpecifierWhenCreateSimpleTypeSpecifier(): void
    {
        $stSpec = ConceptDoubleBuilder::createSimpleTypeSpecifier($this)->getDouble();
        
        $sut = TypeSpecifier::createSimpleTypeSpecifier($stSpec);
        self::assertSame($stSpec, $sut->getSimpleTypeSpecifier());
    }
}

