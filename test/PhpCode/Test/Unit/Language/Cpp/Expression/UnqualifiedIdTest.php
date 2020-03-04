<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\UnqualifiedId;
use PhpCode\Language\Cpp\Lexical\Identifier;
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
     * Tests that createIdentifier() returns new instances of UnqualifiedId.
     */
    public function testCreateIdentifierReturnsNewInstanceUnqualifiedId(): void
    {
        $idDummy = $this->prophesize(Identifier::class)->reveal();
        
        $uid1 = UnqualifiedId::createIdentifier($idDummy);
        $uid2 = UnqualifiedId::createIdentifier($idDummy);
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
        $idDummy = $this->prophesize(Identifier::class)->reveal();
        
        $sut = UnqualifiedId::createIdentifier($idDummy);
        self::assertSame($idDummy, $sut->getIdentifier());
    }
}

