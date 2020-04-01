<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\PtrAbstractDeclarator;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declarator\PtrAbstractDeclarator} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrAbstractDeclaratorTest extends TestCase
{
    /**
     * Tests that getPtrOperatorSequence() returns:
     * - NULL when instantiated, 
     * - the instance of pointer operator sequence that has been set.
     */
    public function testGetPtrOperatorSequence() :void
    {
        $sut = new PtrAbstractDeclarator();
        
        self::assertNull($sut->getPtrOperatorSequence());
        
        $ptrOpSeq1 = ConceptDoubleBuilder::createPtrOperatorSequence($this)
            ->getDouble();
        $sut->setPtrOperatorSequence($ptrOpSeq1);
        self::assertSame($ptrOpSeq1, $sut->getPtrOperatorSequence());
        
        $ptrOpSeq2 = ConceptDoubleBuilder::createPtrOperatorSequence($this)
            ->getDouble();
        $sut->setPtrOperatorSequence($ptrOpSeq2);
        self::assertSame($ptrOpSeq2, $sut->getPtrOperatorSequence());
    }
    
    /**
     * Tests that hasPtrOperatorSequence() returns a boolean.
     */
    public function testHasPtrOperatorSequenceReturnsBool(): void
    {
        $sut = new PtrAbstractDeclarator();
        
        self::assertFalse($sut->hasPtrOperatorSequence());
        
        $ptrOpSeq1 = ConceptDoubleBuilder::createPtrOperatorSequence($this)
            ->getDouble();
        $sut->setPtrOperatorSequence($ptrOpSeq1);
        self::assertTrue($sut->hasPtrOperatorSequence());
        
        $ptrOpSeq2 = ConceptDoubleBuilder::createPtrOperatorSequence($this)
            ->getDouble();
        $sut->setPtrOperatorSequence($ptrOpSeq2);
        self::assertTrue($sut->hasPtrOperatorSequence());
    }
}

