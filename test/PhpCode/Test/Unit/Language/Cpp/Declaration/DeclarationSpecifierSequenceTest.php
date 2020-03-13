<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierDoubleFactory;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence} 
 * class.
 * 
 * @group   declaration
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclarationSpecifierSequenceTest extends TestCase
{
    /**
     * The system under test.
     * @var DeclarationSpecifierSequence
     */
    private $sut;
    
    /**
     * @var DeclarationSpecifierDoubleFactory
     */
    private $declSpecFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new DeclarationSpecifierSequence();
        $this->declSpecFactory = new DeclarationSpecifierDoubleFactory($this);
    }
    
    /**
     * Tests that getDeclarationSpecifiers() returns an indexed array of 
     * DeclarationSpecifier.
     */
    public function testGetDeclarationSpecifiersReturnsArrayDeclarationSpecifier(): void
    {
        $specs = [];
        
        self::assertSame($specs, $this->sut->getDeclarationSpecifiers());
        
        $specs[] = $this->declSpecFactory->createDummy();
        $this->sut->addDeclarationSpecifier($specs[0]);
        self::assertSame($specs, $this->sut->getDeclarationSpecifiers());
        
        $specs[] = $this->declSpecFactory->createDummy();
        $this->sut->addDeclarationSpecifier($specs[1]);
        self::assertSame($specs, $this->sut->getDeclarationSpecifiers());
        
        $specs[] = $this->declSpecFactory->createDummy();
        $this->sut->addDeclarationSpecifier($specs[2]);
        self::assertSame($specs, $this->sut->getDeclarationSpecifiers());
    }
    
    /**
     * Tests that count() returns an integer.
     */
    public function testCountReturnsInt(): void
    {
        self::assertSame(0, $this->sut->count());
        
        $this->sut->addDeclarationSpecifier($this->declSpecFactory->createDummy());
        self::assertSame(1, $this->sut->count());
        
        $this->sut->addDeclarationSpecifier($this->declSpecFactory->createDummy());
        self::assertSame(2, $this->sut->count());
        
        $this->sut->addDeclarationSpecifier($this->declSpecFactory->createDummy());
        self::assertSame(3, $this->sut->count());
    }
}

