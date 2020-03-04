<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\DeclaratorId;
use PhpCode\Language\Cpp\Expression\IdExpression;
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
     * Tests that createIdExpression() returns new instances of DeclaratorId.
     */
    public function testCreateIdExpressionReturnsNewInstanceDeclaratorId(): void
    {
        $idExprDummy = $this->prophesize(IdExpression::class)->reveal();
        
        $did1 = DeclaratorId::createIdExpression($idExprDummy);
        $did2 = DeclaratorId::createIdExpression($idExprDummy);
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
        $idExprDummy = $this->prophesize(IdExpression::class)->reveal();
        
        $sut = DeclaratorId::createIdExpression($idExprDummy);
        self::assertSame($idExprDummy, $sut->getIdExpression());
    }
}

