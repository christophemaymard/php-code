<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\IdExpression;
use PhpCode\Test\Language\Cpp\Expression\QualifiedIdDoubleFactory;
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
        $uid = $this->createUnqualifiedIdDoubleFactory()->createDummy();
        
        $idExpr1 = IdExpression::createUnqualifiedId($uid);
        $idExpr2 = IdExpression::createUnqualifiedId($uid);
        self::assertNotSame($idExpr1, $idExpr2);
    }
    
    /**
     * Tests that createQualifiedId() returns new instances of IdExpression.
     */
    public function testCreateQualifiedIdReturnsNewInstanceIdExpression(): void
    {
        $qid = $this->createQualifiedIdDoubleFactory()->createDummy();
        
        $idExpr1 = IdExpression::createQualifiedId($qid);
        $idExpr2 = IdExpression::createQualifiedId($qid);
        self::assertNotSame($idExpr1, $idExpr2);
    }
    
    /**
     * Tests that getUnqualifiedId() returns the instance of UnqualifiedId 
     * when the instance has been created by createUnqualifiedId().
     */
    public function testGetUnqualifiedIdReturnsUnqualifiedIdWhenCreateUnqualifiedId(): void
    {
        $uid = $this->createUnqualifiedIdDoubleFactory()->createDummy();
        
        $sut = IdExpression::createUnqualifiedId($uid);
        self::assertSame($uid, $sut->getUnqualifiedId());
    }
    
    /**
     * Tests that getUnqualifiedId() returns NULL when the instance has been 
     * created by createQualifiedId().
     */
    public function testGetUnqualifiedIdReturnsNullWhenCreateQualifiedId(): void
    {
        $qid = $this->createQualifiedIdDoubleFactory()->createDummy();
        
        $sut = IdExpression::createQualifiedId($qid);
        self::assertNull($sut->getUnqualifiedId());
    }
    
    /**
     * Tests that getQualifiedId() returns the instance of QualifiedId when 
     * the instance has been created by createQualifiedId().
     */
    public function testGetQualifiedIdReturnsQualifiedIdWhenCreateQualifiedId(): void
    {
        $qid = $this->createQualifiedIdDoubleFactory()->createDummy();
        
        $sut = IdExpression::createQualifiedId($qid);
        self::assertSame($qid, $sut->getQualifiedId());
    }
    
    /**
     * Tests that getQualifiedId() returns NULL when the instance has been 
     * created by createUnqualifiedId().
     */
    public function testGetQualifiedIdReturnsNullWhenCreateUnqualifiedId(): void
    {
        $uid = $this->createUnqualifiedIdDoubleFactory()->createDummy();
        
        $sut = IdExpression::createUnqualifiedId($uid);
        self::assertNull($sut->getQualifiedId());
    }
    
    /**
     * Tests that isUnqualifiedId() returns TRUE when the instance has been 
     * created by createQualifiedId().
     */
    public function testIsUnqualifiedIdReturnsTrueWhenCreateUnqualifiedId(): void
    {
        $uid = $this->createUnqualifiedIdDoubleFactory()->createDummy();
        
        $sut = IdExpression::createUnqualifiedId($uid);
        self::assertTrue($sut->isUnqualifiedId());
    }
    
    /**
     * Tests that isUnqualifiedId() returns FALSE when the instance has been 
     * created by createQualifiedId().
     */
    public function testIsUnqualifiedIdReturnsFalseWhenCreateQualifiedId(): void
    {
        $qid = $this->createQualifiedIdDoubleFactory()->createDummy();
        
        $sut = IdExpression::createQualifiedId($qid);
        self::assertFalse($sut->isUnqualifiedId());
    }
    
    /**
     * Tests that isQualifiedId() returns TRUE when the instance has been 
     * created by createQualifiedId().
     */
    public function testIsQualifiedIdReturnsTrueWhenCreateQualifiedId(): void
    {
        $qid = $this->createQualifiedIdDoubleFactory()->createDummy();
        
        $sut = IdExpression::createQualifiedId($qid);
        self::assertTrue($sut->isQualifiedId());
    }
    
    /**
     * Tests that isQualifiedId() returns FALSE when the instance has been 
     * created by createUnqualifiedId().
     */
    public function testIsQualifiedIdReturnsFalseWhenCreateUnqualifiedId(): void
    {
        $uid = $this->createUnqualifiedIdDoubleFactory()->createDummy();
        
        $sut = IdExpression::createUnqualifiedId($uid);
        self::assertFalse($sut->isQualifiedId());
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
    
    /**
     * Creates a factory of qualified identifier doubles.
     * 
     * @return  QualifiedIdDoubleFactory    The created instance of QualifiedIdDoubleFactory.
     */
    private function createQualifiedIdDoubleFactory(): QualifiedIdDoubleFactory
    {
        return new QualifiedIdDoubleFactory($this);
    }
}

