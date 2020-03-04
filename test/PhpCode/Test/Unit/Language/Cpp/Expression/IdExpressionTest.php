<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\IdExpression;
use PhpCode\Language\Cpp\Expression\UnqualifiedId;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Expression\IdExpression} 
 * class.
 * 
 * @group   expression
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class IdExpressionTest extends TestCase
{
    /**
     * Tests that createUnqualifiedId() returns new instances of IdExpression.
     */
    public function testCreateUnqualifiedIdReturnsNewInstanceIdExpression(): void
    {
        $uidDummy = $this->prophesize(UnqualifiedId::class)->reveal();
        
        $idExpr1 = IdExpression::createUnqualifiedId($uidDummy);
        $idExpr2 = IdExpression::createUnqualifiedId($uidDummy);
        self::assertNotSame($idExpr1, $idExpr2);
    }
    
    /**
     * Tests that getUnqualifiedId() returns NULL when the class has been 
     * instantiated.
     */
    public function testGetUnqualifiedIdReturnsNullWhenInstantiated(): void
    {
        $sut = new IdExpression();
        self::assertNull($sut->getUnqualifiedId());
    }
    
    /**
     * Tests that getUnqualifiedId() returns the instance of UnqualifiedId 
     * when the instance has been created by createUnqualifiedId().
     */
    public function testGetUnqualifiedIdReturnsUnqualifiedIdWhenCreateUnqualifiedId(): void
    {
        $uidDummy = $this->prophesize(UnqualifiedId::class)->reveal();
        
        $sut = IdExpression::createUnqualifiedId($uidDummy);
        self::assertSame($uidDummy, $sut->getUnqualifiedId());
    }
}

