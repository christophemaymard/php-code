<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence;
use PhpCode\Language\Cpp\Declarator\ParameterDeclaration;
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
     * Tests that __construct() stores DeclarationSpecifierSequence instance.
     */
    public function test__constructStoresDeclarationSpecifierSequence(): void
    {
        $declSpecSeq = $this->prophesize(DeclarationSpecifierSequence::class)->reveal();
        
        $sut = new ParameterDeclaration($declSpecSeq);
        self::assertSame($declSpecSeq, $sut->getDeclarationSpecifierSequence());
    }
}

