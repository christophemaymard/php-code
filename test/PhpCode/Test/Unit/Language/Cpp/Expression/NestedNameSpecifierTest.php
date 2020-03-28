<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\NestedNameSpecifier;
use PhpCode\Test\Language\Cpp\Lexical\IdentifierDoubleFactory;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Expression\NestedNameSpecifier} 
 * class.
 * 
 * @group   expression
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NestedNameSpecifierTest extends TestCase
{
    /**
     * Tests that getNameSpecifiers() returns an indexed array of Identifier 
     * instances when using addNameSpecifier().
     */
    public function testGetNameSpecifiersReturnsArrayIdentifierWhenAddNameSpecifier(): void
    {
        $idFactory = $this->createIdentifierDoubleFactory();
        $nameSpecs = [];
        
        $sut = new NestedNameSpecifier();
        self::assertSame($nameSpecs, $sut->getNameSpecifiers());
        
        $nameSpecs[] = $idFactory->createDummy();
        $sut->addNameSpecifier($nameSpecs[0]);
        self::assertSame($nameSpecs, $sut->getNameSpecifiers());
        
        $nameSpecs[] = $idFactory->createDummy();
        $sut->addNameSpecifier($nameSpecs[1]);
        self::assertSame($nameSpecs, $sut->getNameSpecifiers());
        
        $nameSpecs[] = $idFactory->createDummy();
        $sut->addNameSpecifier($nameSpecs[2]);
        self::assertSame($nameSpecs, $sut->getNameSpecifiers());
    }
    
    /**
     * Tests that count() returns an integer.
     */
    public function testCountReturnsInt(): void
    {
        $idFactory = $this->createIdentifierDoubleFactory();
        $sut = new NestedNameSpecifier();
        
        self::assertCount(0, $sut);
        
        $sut->addNameSpecifier($idFactory->createDummy());
        self::assertCount(1, $sut);
        
        $sut->addNameSpecifier($idFactory->createDummy());
        self::assertCount(2, $sut);
        
        $sut->addNameSpecifier($idFactory->createDummy());
        self::assertCount(3, $sut);
    }
    
    /**
     * Creates a factory of identifier doubles.
     * 
     * @return  IdentifierDoubleFactory The created instance of IdentifierDoubleFactory.
     */
    private function createIdentifierDoubleFactory(): IdentifierDoubleFactory
    {
        return new IdentifierDoubleFactory($this);
    }
}

