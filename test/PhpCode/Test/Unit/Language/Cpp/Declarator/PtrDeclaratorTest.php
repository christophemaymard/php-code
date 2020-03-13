<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\PtrDeclarator;
use PhpCode\Test\Language\Cpp\Declarator\NoptrDeclaratorDoubleFactory;
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
     * @var NoptrDeclaratorDoubleFactory
     */
    private $noptrDeclFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->noptrDeclFactory = new NoptrDeclaratorDoubleFactory($this);
    }
    
    /**
     * Tests that __construct() stores NoptrDeclarator instance.
     */
    public function test__constructStoresNoptrDeclarator(): void
    {
        $noptr = $this->noptrDeclFactory->createDummy();
        
        $sut = new PtrDeclarator($noptr);
        self::assertSame($noptr, $sut->getNoptrDeclarator());
    }
}

