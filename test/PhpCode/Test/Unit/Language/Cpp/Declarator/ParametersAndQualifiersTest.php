<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParameterDeclarationClause;
use PhpCode\Language\Cpp\Declarator\ParametersAndQualifiers;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declarator\ParametersAndQualifiers} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParametersAndQualifiersTest extends TestCase
{
    /**
     * Tests that __construct() stores the instance of 
     * ParameterDeclarationClause.
     */
    public function test__constructStoresParameterDeclarationClause(): void
    {
        $prmDeclClause = $this->prophesize(ParameterDeclarationClause::class)->reveal();
        
        $sut = new ParametersAndQualifiers($prmDeclClause);
        self::assertSame($prmDeclClause, $sut->getParameterDeclarationClause());
    }
}

