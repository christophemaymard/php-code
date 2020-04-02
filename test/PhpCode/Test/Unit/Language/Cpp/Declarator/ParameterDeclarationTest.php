<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParameterDeclaration;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierSequenceDoubleFactory;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declarator\ParameterDeclaration} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationTest extends TestCase
{
    /**
     * @var DeclarationSpecifierSequenceDoubleFactory
     */
    private $declSpecSeqFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->declSpecSeqFactory = new DeclarationSpecifierSequenceDoubleFactory($this);
    }
    
    /**
     * Tests that __construct() stores DeclarationSpecifierSequence instance.
     */
    public function test__constructStoresDeclarationSpecifierSequence(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        
        $sut = new ParameterDeclaration($declSpecSeq);
        self::assertSame($declSpecSeq, $sut->getDeclarationSpecifierSequence());
    }
    
    /**
     * Tests that getAbstractDeclarator() returns:
     * - NULL when instantiated, 
     * - the instance of an abstract declarator that has been set.
     */
    public function testGetAbstractDeclarator(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        
        $sut = new ParameterDeclaration($declSpecSeq);
        
        self::assertNull($sut->getAbstractDeclarator());
        
        $abstDcltor1 = ConceptDoubleBuilder::createAbstractDeclarator($this)
            ->getDouble();
        
        $sut->setAbstractDeclarator($abstDcltor1);
        self::assertSame($abstDcltor1, $sut->getAbstractDeclarator());
        
        $abstDcltor2 = ConceptDoubleBuilder::createAbstractDeclarator($this)
            ->getDouble();
        
        $sut->setAbstractDeclarator($abstDcltor2);
        self::assertSame($abstDcltor2, $sut->getAbstractDeclarator());
    }
    
    /**
     * Tests that hasAbstractDeclarator() returns a boolean.
     */
    public function testHasAbstractDeclaratorReturnsBool(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        
        $sut = new ParameterDeclaration($declSpecSeq);
        
        self::assertFalse($sut->hasAbstractDeclarator());
            
        $abstDcltor1 = ConceptDoubleBuilder::createAbstractDeclarator($this)
            ->getDouble();
        
        $sut->setAbstractDeclarator($abstDcltor1);
        self::assertTrue($sut->hasAbstractDeclarator());
        
        $abstDcltor2 = ConceptDoubleBuilder::createAbstractDeclarator($this)
            ->getDouble();
        
        $sut->setAbstractDeclarator($abstDcltor2);
        self::assertTrue($sut->hasAbstractDeclarator());
    }
}

