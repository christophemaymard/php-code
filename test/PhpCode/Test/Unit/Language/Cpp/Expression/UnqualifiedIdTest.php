<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\UnqualifiedId;
use PhpCode\Test\Language\Cpp\Lexical\IdentifierDoubleFactory;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Expression\UnqualifiedId} 
 * class.
 * 
 * @group   expression
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class UnqualifiedIdTest extends TestCase
{
    /**
     * @var IdentifierDoubleFactory
     */
    private $idFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->idFactory =  new IdentifierDoubleFactory($this);
    }
    
    /**
     * Tests that createIdentifier() returns new instances of UnqualifiedId.
     */
    public function testCreateIdentifierReturnsNewInstanceUnqualifiedId(): void
    {
        $id = $this->idFactory->createDummy();
        
        $uid1 = UnqualifiedId::createIdentifier($id);
        $uid2 = UnqualifiedId::createIdentifier($id);
        self::assertNotSame($uid1, $uid2);
    }
    
    /**
     * Tests that getIdentifier() returns NULL when the class has been 
     * instantiated.
     */
    public function testGetIdentifierReturnsNullWhenInstantiated(): void
    {
        $sut = new UnqualifiedId();
        self::assertNull($sut->getIdentifier());
    }
    
    /**
     * Tests that getIdentifier() returns the instance of Identifier when the 
     * instance has been created by createIdentifier().
     */
    public function testGetIdentifierReturnsIdentifierWhenCreateIdentifier(): void
    {
        $id = $this->idFactory->createDummy();
        
        $sut = UnqualifiedId::createIdentifier($id);
        self::assertSame($id, $sut->getIdentifier());
    }
}

