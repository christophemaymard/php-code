<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\DeclaratorId;
use PhpCode\Language\Cpp\Declarator\NoptrDeclarator;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declarator\NoptrDeclarator} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NoptrDeclaratorTest extends TestCase
{
    /**
     * Tests that createDeclaratorId() returns new instances of NoptrDeclarator.
     */
    public function testCreateDeclaratorIdReturnsNewInstanceNoptrDeclarator(): void
    {
        $didDummy = $this->prophesize(DeclaratorId::class)->reveal();
        
        $dcltor1 = NoptrDeclarator::createDeclaratorId($didDummy);
        $dcltor2 = NoptrDeclarator::createDeclaratorId($didDummy);
        self::assertNotSame($dcltor1, $dcltor2);
    }
    
    /**
     * Tests that getDeclaratorId() returns NULL when the class has been 
     * instantiated.
     */
    public function testGetDeclaratorIdReturnsNullWhenInstantiated(): void
    {
        $sut = new NoptrDeclarator();
        self::assertNull($sut->getDeclaratorId());
    }
    
    /**
     * Tests that getDeclaratorId() returns the instance of DeclaratorId when 
     * the instance has been created by createDeclaratorId().
     */
    public function testGetDeclaratorIdReturnsDeclaratorIdWhenCreateDeclaratorId(): void
    {
        $didDummy = $this->prophesize(DeclaratorId::class)->reveal();
        
        $sut = NoptrDeclarator::createDeclaratorId($didDummy);
        self::assertSame($didDummy, $sut->getDeclaratorId());
    }
}

