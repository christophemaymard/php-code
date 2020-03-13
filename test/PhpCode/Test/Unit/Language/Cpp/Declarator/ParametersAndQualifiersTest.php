<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParametersAndQualifiers;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationClauseDoubleFactory;
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
     * @var ParameterDeclarationClauseDoubleFactory
     */
    private $prmDeclClauseFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->prmDeclClauseFactory = new ParameterDeclarationClauseDoubleFactory($this);
    }
    
    /**
     * Tests that __construct() stores the instance of 
     * ParameterDeclarationClause.
     */
    public function test__constructStoresParameterDeclarationClause(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        
        $sut = new ParametersAndQualifiers($prmDeclClause);
        self::assertSame($prmDeclClause, $sut->getParameterDeclarationClause());
    }
}

