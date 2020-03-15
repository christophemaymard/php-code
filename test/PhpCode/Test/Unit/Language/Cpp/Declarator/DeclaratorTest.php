<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\Declarator;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
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
     * Tests that __construct() throws an exception.
     */
    public function test__constructThrowsException(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        $sut = new Declarator();
    }
    
    /**
     * Tests that createPtrDeclarator() returns new instances of Declarator.
     */
    public function testCreatePtrDeclaratorReturnsNewInstanceDeclarator(): void
    {
        $ptrDcltor = ConceptDoubleBuilder::createPtrDeclarator($this)->getDouble();
        
        $dcltor1 = Declarator::createPtrDeclarator($ptrDcltor);
        $dcltor2 = Declarator::createPtrDeclarator($ptrDcltor);
        self::assertNotSame($dcltor1, $dcltor2);
    }
    
    /**
     * Tests that getPtrDeclarator() returns the instance of PtrDeclarator 
     * when the instance has been created by createPtrDeclarator().
     */
    public function testGetPtrDeclaratorReturnsPtrDeclaratorWhenCreatePtrDeclarator(): void
    {
        $ptrDcltor = ConceptDoubleBuilder::createPtrDeclarator($this)->getDouble();
        
        $sut = Declarator::createPtrDeclarator($ptrDcltor);
        self::assertSame($ptrDcltor, $sut->getPtrDeclarator());
    }
}

