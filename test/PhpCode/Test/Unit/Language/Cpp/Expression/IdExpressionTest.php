<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\IdExpression;
use PhpCode\Test\Language\Cpp\Expression\UnqualifiedIdDoubleFactory;
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
     * @var UnqualifiedIdDoubleFactory
     */
    private $uidFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->uidFactory = new UnqualifiedIdDoubleFactory($this);
    }
    
    /**
     * Tests that __construct() throws an exception.
     */
    public function test__constructThrowsException(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        $sut = new IdExpression();
    }
    
    /**
     * Tests that createUnqualifiedId() returns new instances of IdExpression.
     */
    public function testCreateUnqualifiedIdReturnsNewInstanceIdExpression(): void
    {
        $uid = $this->uidFactory->createDummy();
        
        $idExpr1 = IdExpression::createUnqualifiedId($uid);
        $idExpr2 = IdExpression::createUnqualifiedId($uid);
        self::assertNotSame($idExpr1, $idExpr2);
    }
    
    /**
     * Tests that getUnqualifiedId() returns the instance of UnqualifiedId 
     * when the instance has been created by createUnqualifiedId().
     */
    public function testGetUnqualifiedIdReturnsUnqualifiedIdWhenCreateUnqualifiedId(): void
    {
        $uid = $this->uidFactory->createDummy();
        
        $sut = IdExpression::createUnqualifiedId($uid);
        self::assertSame($uid, $sut->getUnqualifiedId());
    }
}

