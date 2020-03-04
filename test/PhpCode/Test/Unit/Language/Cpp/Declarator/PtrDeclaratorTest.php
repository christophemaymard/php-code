<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\NoptrDeclarator;
use PhpCode\Language\Cpp\Declarator\PtrDeclarator;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declarator\PtrDeclarator} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrDeclaratorTest extends TestCase
{
    /**
     * Tests that __construct() stores NoptrDeclarator instance.
     */
    public function test__constructStoresNoptrDeclarator(): void
    {
        $noptrDummy = $this->prophesize(NoptrDeclarator::class)->reveal();
        
        $sut = new PtrDeclarator($noptrDummy);
        self::assertSame($noptrDummy, $sut->getNoptrDeclarator());
    }
}

