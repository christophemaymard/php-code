<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\DeclarationSpecifier;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declaration\DeclarationSpecifier} 
 * class.
 * 
 * @group   declaration
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclarationSpecifierTest extends TestCase
{
    /**
     * Tests that __construct() throws an exception when instantiated.
     */
    public function test__constructThrowsExceptionWhenInstantiated(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        $sut = new DeclarationSpecifier();
    }
    
    /**
     * Tests that createDefiningTypeSpecifier() returns new instances of 
     * DeclarationSpecifier.
     */
    public function testCreateDefiningTypeSpecifierReturnsNewInstanceDeclarationSpecifier(): void
    {
        $defTypeSpec = ConceptDoubleBuilder::createDefiningTypeSpecifier($this)->getDouble();
        
        $declSpec1 = DeclarationSpecifier::createDefiningTypeSpecifier($defTypeSpec);
        $declSpec2 = DeclarationSpecifier::createDefiningTypeSpecifier($defTypeSpec);
        self::assertNotSame($declSpec1, $declSpec2);
    }
    
    /**
     * Tests that getDefiningTypeSpecifier() returns the instance of 
     * DefiningTypeSpecifier when the instance has been created by 
     * createDefiningTypeSpecifier().
     */
    public function testGetDefiningTypeSpecifierReturnsDefiningTypeSpecifierWhenCreateDefiningTypeSpecifier(): void
    {
        $defTypeSpec = ConceptDoubleBuilder::createDefiningTypeSpecifier($this)->getDouble();
        
        $sut = DeclarationSpecifier::createDefiningTypeSpecifier($defTypeSpec);
        self::assertSame($defTypeSpec, $sut->getDefiningTypeSpecifier());
    }
}

