<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\NestedNameSpecifier;
use PhpCode\Language\Cpp\Expression\QualifiedId;
use PhpCode\Language\Cpp\Expression\UnqualifiedId;
use PhpCode\Test\AbstractDoubleFactory;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Expression\QualifiedId} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class QualifiedIdDoubleFactory extends AbstractDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return QualifiedId::class;
    }
    
    /**
     * Creates a double where getNestedNameSpecifier() can be called.
     * 
     * @param   NestedNameSpecifier $return The value to return when getNestedNameSpecifier() is called.
     * @return  ProphecySubjectInterface
     */
    public function createGetNestedNameSpecifier( 
        NestedNameSpecifier $return
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        $this->buildGetNestedNameSpecifier($prophecy, $return);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where getNestedNameSpecifier() and getUnqualifiedId() 
     * can be called.
     * 
     * @param   NestedNameSpecifier $nnSpec The value to return when getNestedNameSpecifier() is called.
     * @param   UnqualifiedId       $uid    The value to return when getUnqualifiedId() is called.
     * @return  ProphecySubjectInterface
     */
    public function createGetNestedNameSpecifierGetUnqualifiedId( 
        NestedNameSpecifier $nnSpec, 
        UnqualifiedId $uid
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        
        $this->buildGetNestedNameSpecifier($prophecy, $nnSpec);
        
        $prophecy
            ->getUnqualifiedId()
            ->willReturn($uid);
        
        return $prophecy->reveal();
    }
    
    /**
     * Builds and adds a prophecy of getNestedNameSpecifier() to the 
     * specified prophecy.
     * 
     * @param   ObjectProphecy      $prophecy   The prophecy to build to.
     * @param   NestedNameSpecifier $return     The value to return when getNestedNameSpecifier() is called.
     */
    private function buildGetNestedNameSpecifier(
        ObjectProphecy $prophecy, 
        NestedNameSpecifier $return
    ): void
    {
        $prophecy
            ->getNestedNameSpecifier()
            ->willReturn($return);
    }
}

