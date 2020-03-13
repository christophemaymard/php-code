<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\NoptrDeclarator;
use PhpCode\Test\Language\Cpp\Declarator\DeclaratorIdDoubleFactory;
use PhpCode\Test\Language\Cpp\Declarator\ParametersAndQualifiersDoubleFactory;
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
     * @var DeclaratorIdDoubleFactory
     */
    private $didFactory;
    
    /**
     * @var ParametersAndQualifiersDoubleFactory
     */
    private $prmQualFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->didFactory = new DeclaratorIdDoubleFactory($this);
        $this->prmQualFactory = new ParametersAndQualifiersDoubleFactory($this);
    }
    
    /**
     * Tests that createDeclaratorId() returns new instances of NoptrDeclarator.
     */
    public function testCreateDeclaratorIdReturnsNewInstanceNoptrDeclarator(): void
    {
        $did = $this->didFactory->createDummy();
        
        $dcltor1 = NoptrDeclarator::createDeclaratorId($did);
        $dcltor2 = NoptrDeclarator::createDeclaratorId($did);
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
        $did = $this->didFactory->createDummy();
        
        $sut = NoptrDeclarator::createDeclaratorId($did);
        self::assertSame($did, $sut->getDeclaratorId());
    }
    
    /**
     * Tests that getParametersAndQualifiers() returns the instance of 
     * ParametersAndQualifiers if the parameters and the qualifiers have been 
     * set, otherwise NULL.
     */
    public function testGetParametersAndQualifiers(): void
    {
        $sut = new NoptrDeclarator();
        
        self::assertNull($sut->getParametersAndQualifiers());
        
        $prmQual = $this->prmQualFactory->createDummy();
        $sut->setParametersAndQualifiers($prmQual);
        self::assertSame($prmQual, $sut->getParametersAndQualifiers());
    }
    
    /**
     * Tests that hasParametersAndQualifiers() returns TRUE if the parameters 
     * and the qualifiers have been set, otherwise FALSE.
     */
    public function testHasParametersAndQualifiersReturnsBool(): void
    {
        $sut = new NoptrDeclarator();
        
        self::assertFalse($sut->hasParametersAndQualifiers());
        
        $prmQual = $this->prmQualFactory->createDummy();
        $sut->setParametersAndQualifiers($prmQual);
        
        self::assertTrue($sut->hasParametersAndQualifiers());
    }
}

