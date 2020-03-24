<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\QualifiedId;
use PhpCode\Test\Language\Cpp\Expression\NestedNameSpecifierDoubleFactory;
use PhpCode\Test\Language\Cpp\Expression\UnqualifiedIdDoubleFactory;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Expression\QualifiedId} 
 * class.
 * 
 * @group   expression
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class QualifiedIdTest extends TestCase
{
    /**
     * Tests that __construct() stores nested name specifier and unqualified 
     * identifier instances.
     */
    public function test__constructStoresNestedNameSpecifierAndUnqualifiedIdentifier(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()->createDummy();
        $unqualId = $this->createUnqualifiedIdDoubleFactory()->createDummy();
        $sut = new QualifiedId($nnSpec, $unqualId);
        self::assertSame($nnSpec, $sut->getNestedNameSpecifier());
        self::assertSame($unqualId, $sut->getUnqualifiedId());
    }
    
    /**
     * Creates a factory of nested name specifier doubles.
     * 
     * @return  NestedNameSpecifierDoubleFactory    The created instance of NestedNameSpecifierDoubleFactory.
     */
    private function createNestedNameSpecifierDoubleFactory(): NestedNameSpecifierDoubleFactory
    {
        return new NestedNameSpecifierDoubleFactory($this);
    }
    
    /**
     * Creates a factory of unqualified identifier doubles.
     * 
     * @return  UnqualifiedIdDoubleFactory  The created instance of UnqualifiedIdDoubleFactory.
     */
    private function createUnqualifiedIdDoubleFactory(): UnqualifiedIdDoubleFactory
    {
        return new UnqualifiedIdDoubleFactory($this);
    }
}

