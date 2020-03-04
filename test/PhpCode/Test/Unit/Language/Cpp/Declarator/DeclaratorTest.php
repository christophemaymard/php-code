<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\Declarator;
use PhpCode\Language\Cpp\Declarator\PtrDeclarator;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declarator\Declarator} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclaratorTest extends TestCase
{
    /**
     * Tests that createPtrDeclarator() returns new instances of Declarator.
     */
    public function testCreatePtrDeclaratorReturnsNewInstanceDeclarator(): void
    {
        $ptrDummy = $this->prophesize(PtrDeclarator::class)->reveal();
        
        $dcltor1 = Declarator::createPtrDeclarator($ptrDummy);
        $dcltor2 = Declarator::createPtrDeclarator($ptrDummy);
        self::assertNotSame($dcltor1, $dcltor2);
    }
    
    /**
     * Tests that getPtrDeclarator() returns NULL when the class has been 
     * instantiated.
     */
    public function testGetPtrDeclaratorReturnsNullWhenInstantiated(): void
    {
        $sut = new Declarator();
        self::assertNull($sut->getPtrDeclarator());
    }
    
    /**
     * Tests that getPtrDeclarator() returns the instance of PtrDeclarator 
     * when the instance has been created by createPtrDeclarator().
     */
    public function testGetPtrDeclaratorReturnsPtrDeclaratorWhenCreatePtrDeclarator(): void
    {
        $ptrDummy = $this->prophesize(PtrDeclarator::class)->reveal();
        
        $sut = Declarator::createPtrDeclarator($ptrDummy);
        self::assertSame($ptrDummy, $sut->getPtrDeclarator());
    }
}

