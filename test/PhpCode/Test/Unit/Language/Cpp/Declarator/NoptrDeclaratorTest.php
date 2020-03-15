<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\NoptrDeclarator;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
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
     * Tests that __construct() throws an exception.
     */
    public function test__constructThrowsException(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        $sut = new NoptrDeclarator();
    }
    
    /**
     * Tests that createDeclaratorId() returns new instances of NoptrDeclarator.
     */
    public function testCreateDeclaratorIdReturnsNewInstanceNoptrDeclarator(): void
    {
        $did = ConceptDoubleBuilder::createDeclaratorId($this)->getDouble();
        
        $dcltor1 = NoptrDeclarator::createDeclaratorId($did);
        $dcltor2 = NoptrDeclarator::createDeclaratorId($did);
        self::assertNotSame($dcltor1, $dcltor2);
    }
    
    /**
     * Tests that getDeclaratorId() returns the instance of DeclaratorId when 
     * the instance has been created by createDeclaratorId().
     */
    public function testGetDeclaratorIdReturnsDeclaratorIdWhenCreateDeclaratorId(): void
    {
        $did = ConceptDoubleBuilder::createDeclaratorId($this)->getDouble();
        
        $sut = NoptrDeclarator::createDeclaratorId($did);
        self::assertSame($did, $sut->getDeclaratorId());
    }
    
    /**
     * Tests that getParametersAndQualifiers() returns the instance of 
     * ParametersAndQualifiers when the instance has been created by 
     * createDeclaratorId() and if the parameters and the qualifiers have 
     * been set, otherwise NULL.
     */
    public function testGetParametersAndQualifiersWhenCreateDeclaratorId(): void
    {
        $did = ConceptDoubleBuilder::createDeclaratorId($this)->getDouble();
        $sut = NoptrDeclarator::createDeclaratorId($did);
        
        self::assertNull($sut->getParametersAndQualifiers());
        
        $prmQual1 = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->getDouble();
        $sut->setParametersAndQualifiers($prmQual1);
        self::assertSame($prmQual1, $sut->getParametersAndQualifiers());
        
        $prmQual2 = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->getDouble();
        $sut->setParametersAndQualifiers($prmQual2);
        self::assertSame($prmQual2, $sut->getParametersAndQualifiers());
    }
    
    /**
     * Tests that hasParametersAndQualifiers() returns TRUE when the 
     * instance has been created by createDeclaratorId() and if the 
     * parameters and the qualifiers have been set, otherwise FALSE.
     */
    public function testHasParametersAndQualifiersReturnsBoolWhenCreateDeclaratorId(): void
    {
        $did = ConceptDoubleBuilder::createDeclaratorId($this)->getDouble();
        $sut = NoptrDeclarator::createDeclaratorId($did);
        
        self::assertFalse($sut->hasParametersAndQualifiers());
        
        $prmQual1 = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->getDouble();
        $sut->setParametersAndQualifiers($prmQual1);
        
        self::assertTrue($sut->hasParametersAndQualifiers());
        
        $prmQual2 = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->getDouble();
        $sut->setParametersAndQualifiers($prmQual2);
        
        self::assertTrue($sut->hasParametersAndQualifiers());
    }
}

