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
     * Tests that createIdExpression() returns new instances of DeclaratorId.
     */
    public function testCreateIdExpressionReturnsNewInstanceDeclaratorId(): void
    {
        $idExpr = $this->idExprFactory->createDummy();
        
        $did1 = DeclaratorId::createIdExpression($idExpr);
        $did2 = DeclaratorId::createIdExpression($idExpr);
        self::assertNotSame($did1, $did2);
    }
    
    /**
     * Tests that getIdExpression() returns NULL when the class has been 
     * instantiated.
     */
    public function testGetIdExpressionReturnsNullWhenInstantiated(): void
    {
        $sut = new DeclaratorId();
        self::assertNull($sut->getIdExpression());
    }
    
    /**
     * Tests that getIdExpression() returns the instance of IdExpression when 
     * the instance has been created by createIdExpression().
     */
    public function testGetIdExpressionReturnsIdExpressionWhenCreateIdExpression(): void
    {
        $idExpr = $this->idExprFactory->createDummy();
        
        $sut = DeclaratorId::createIdExpression($idExpr);
        self::assertSame($idExpr, $sut->getIdExpression());
    }
}

