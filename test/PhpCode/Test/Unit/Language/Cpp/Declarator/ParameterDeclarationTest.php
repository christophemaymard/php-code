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
}

