<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\DeclaratorId;
use PhpCode\Test\Language\Cpp\Expression\IdExpressionDoubleFactory;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declarator\DeclaratorId} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclaratorIdTest extends TestCase
{
    /**
     * @var IdExpressionDoubleFactory
     */
    private $idExprFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->idExprFactory = new IdExpressionDoubleFactory($this);
    }
    
    /**
     * Tests that __construct() stores the identifier expression.
     */
    public function test__constructStoresIdExpression(): void
    {
        $idExpr = $this->idExprFactory->createDummy();
        
        $sut = new DeclaratorId($idExpr);
        self::assertSame($idExpr, $sut->getIdExpression());
    }
}

