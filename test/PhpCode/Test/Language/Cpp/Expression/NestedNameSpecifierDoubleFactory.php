<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\NestedNameSpecifier;
use PhpCode\Language\Cpp\Lexical\Identifier;
use PhpCode\Test\AbstractDoubleFactory;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Expression\NestedNameSpecifier} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NestedNameSpecifierDoubleFactory extends AbstractDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return NestedNameSpecifier::class;
    }
    
    /**
     * Creates a double where count() can be called.
     * 
     * @param   int $count    The value to return when count() is called.
     * @return  ProphecySubjectInterface
     */
    public function createCount(int $count): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        $this->buildCount($prophecy, $count);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where count() and getNameSpecifiers() can be called.
     * 
     * @param   int             $count  The value to return when count() is called.
     * @param   Identifier[]    $ids    The value to return when getNameSpecifiers() is called.
     * @return  ProphecySubjectInterface
     */
    public function createCountGetNameSpecifiers(
        int $count, 
        array $ids
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        $this->buildCount($prophecy, $count);
        
        $prophecy
            ->getNameSpecifiers()
            ->willReturn($ids);
        
        return $prophecy->reveal();
    }
    
    /**
     * Builds and adds a prophecy of count() to the specified prophecy.
     * 
     * @param   ObjectProphecy  $prophecy   The prophecy to build to.
     * @param   int             $return     The value to return when count() is called.
     */
    private function buildCount(
        ObjectProphecy $prophecy, 
        int $return
    ): void
    {
        $prophecy
            ->count()
            ->willReturn($return);
    }
}

