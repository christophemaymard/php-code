<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\DeclarationSpecifier;
use PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ProphecySubjectInterface;

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
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new DeclarationSpecifierSequence();
    }
    
    /**
     * Tests that getDeclarationSpecifiers() returns an indexed array of 
     * DeclarationSpecifier.
     */
    public function testGetDeclarationSpecifiersReturnsArrayDeclarationSpecifier(): void
    {
        $specs = [];
        
        self::assertSame($specs, $this->sut->getDeclarationSpecifiers());
        
        $specs[] = $this->createDeclarationSpecifierDummy();
        $this->sut->addDeclarationSpecifier($specs[0]);
        self::assertSame($specs, $this->sut->getDeclarationSpecifiers());
        
        $specs[] = $this->createDeclarationSpecifierDummy();
        $this->sut->addDeclarationSpecifier($specs[1]);
        self::assertSame($specs, $this->sut->getDeclarationSpecifiers());
        
        $specs[] = $this->createDeclarationSpecifierDummy();
        $this->sut->addDeclarationSpecifier($specs[2]);
        self::assertSame($specs, $this->sut->getDeclarationSpecifiers());
    }
    
    /**
     * Tests that count() returns an integer.
     */
    public function testCountReturnsInt(): void
    {
        self::assertSame(0, $this->sut->count());
        
        $this->sut->addDeclarationSpecifier($this->createDeclarationSpecifierDummy());
        self::assertSame(1, $this->sut->count());
        
        $this->sut->addDeclarationSpecifier($this->createDeclarationSpecifierDummy());
        self::assertSame(2, $this->sut->count());
        
        $this->sut->addDeclarationSpecifier($this->createDeclarationSpecifierDummy());
        self::assertSame(3, $this->sut->count());
    }
    
    /**
     * Creates a dummy of the {@see PhpCode\Language\Cpp\Declaration\DeclarationSpecifier} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    private function createDeclarationSpecifierDummy(): ProphecySubjectInterface
    {
        return $this->prophesize(DeclarationSpecifier::class)->reveal();
    }
}

