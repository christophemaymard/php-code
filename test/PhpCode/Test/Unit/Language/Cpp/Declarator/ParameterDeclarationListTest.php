<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParameterDeclarationList;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationDoubleFactory;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declarator\ParameterDeclarationList} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationListTest extends TestCase
{
    /**
     * The system under test.
     * @var ParameterDeclarationList
     */
    private $sut;
    
    /**
     * @var ParameterDeclarationDoubleFactory
     */
    private $prmDeclFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut =  new ParameterDeclarationList();
        $this->prmDeclFactory =  new ParameterDeclarationDoubleFactory($this);
    }
    
    /**
     * Tests that getParameterDeclarations() returns an indexed array of 
     * ParameterDeclaration.
     */
    public function testGetParameterDeclarationsReturnsArrayParameterDeclaration(): void
    {
        $prmDecls = [];
        
        self::assertSame($prmDecls, $this->sut->getParameterDeclarations());
        
        $prmDecls[] = $this->prmDeclFactory->createDummy();
        $this->sut->addParameterDeclaration($prmDecls[0]);
        self::assertSame($prmDecls, $this->sut->getParameterDeclarations());
        
        $prmDecls[] = $this->prmDeclFactory->createDummy();
        $this->sut->addParameterDeclaration($prmDecls[1]);
        self::assertSame($prmDecls, $this->sut->getParameterDeclarations());
        
        $prmDecls[] = $this->prmDeclFactory->createDummy();
        $this->sut->addParameterDeclaration($prmDecls[2]);
        self::assertSame($prmDecls, $this->sut->getParameterDeclarations());
    }
    
    /**
     * Tests that count() returns an integer.
     */
    public function testCountReturnsInt(): void
    {
        self::assertSame(0, $this->sut->count());
        
        $this->sut->addParameterDeclaration($this->prmDeclFactory->createDummy());
        self::assertSame(1, $this->sut->count());
        
        $this->sut->addParameterDeclaration($this->prmDeclFactory->createDummy());
        self::assertSame(2, $this->sut->count());
        
        $this->sut->addParameterDeclaration($this->prmDeclFactory->createDummy());
        self::assertSame(3, $this->sut->count());
    }
}

