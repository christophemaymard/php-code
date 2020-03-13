<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\Declarator;
use PhpCode\Test\Language\Cpp\Declarator\PtrDeclaratorDoubleFactory;
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
     * @var PtrDeclaratorDoubleFactory
     */
    private $ptrDeclFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->ptrDeclFactory = new PtrDeclaratorDoubleFactory($this);
    }
    
    /**
     * Tests that createPtrDeclarator() returns new instances of Declarator.
     */
    public function testCreatePtrDeclaratorReturnsNewInstanceDeclarator(): void
    {
        $ptrDecl = $this->ptrDeclFactory->createDummy();
        
        $dcltor1 = Declarator::createPtrDeclarator($ptrDecl);
        $dcltor2 = Declarator::createPtrDeclarator($ptrDecl);
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
        $ptrDecl = $this->ptrDeclFactory->createDummy();
        
        $sut = Declarator::createPtrDeclarator($ptrDecl);
        self::assertSame($ptrDecl, $sut->getPtrDeclarator());
    }
}

