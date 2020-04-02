<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\AbstractDeclarator;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declarator\AbstractDeclarator} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AbstractDeclaratorTest extends TestCase
{
    /**
     * Tests that __construct() throws an exception.
     */
    public function test__constructThrowsException(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        $sut = new AbstractDeclarator();
    }
    
    /**
     * Tests that createPtrAbstractDeclarator() returns new instances of 
     * AbstractDeclarator.
     */
    public function testCreatePointerReturnsNewInstancePtrOperator(): void
    {
        $ptrAbstDcltor = ConceptDoubleBuilder::createPtrAbstractDeclarator($this)
            ->getDouble();
        
        $abstDcltor1 = AbstractDeclarator::createPtrAbstractDeclarator($ptrAbstDcltor);
        $abstDcltor2 = AbstractDeclarator::createPtrAbstractDeclarator($ptrAbstDcltor);
        self::assertNotSame($abstDcltor1, $abstDcltor2);
    }
    
    /**
     * Tests that getPtrAbstractDeclarator() returns the instance of pointer 
     * abstract declarator when the instance has been created by 
     * createPtrAbstractDeclarator().
     */
    public function testGetPtrAbstractDeclaratorReturnsInstancePtrAbstractDeclaratorWhenCreatePtrAbstractDeclarator(): void
    {
        $ptrAbstDcltor = ConceptDoubleBuilder::createPtrAbstractDeclarator($this)
            ->getDouble();
        
        $sut = AbstractDeclarator::createPtrAbstractDeclarator($ptrAbstDcltor);
        self::assertSame($ptrAbstDcltor, $sut->getPtrAbstractDeclarator());
    }
}

