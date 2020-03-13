<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\DeclarationSpecifier;
use PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence;
use PhpCode\Test\AbstractDoubleFactory;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclarationSpecifierSequenceDoubleFactory extends AbstractDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getClassName(): string
    {
        return DeclarationSpecifierSequence::class;
    }
    
    /**
     * Creates a double where count() can be called.
     * 
     * @param   int $count    The value to return when count() is called.
     * @return  ProphecySubjectInterface
     */
    public function createCount(int $count): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $this->buildCount($prophecy, $count);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where count() and getDeclarationSpecifiers() can be 
     * called.
     * 
     * @param   int                     $count      The value to return when count() is called.
     * @param   DeclarationSpecifier[]  $declSpecs  The value to return when getDeclarationSpecifiers() is called.
     * @return  ProphecySubjectInterface
     */
    public function createCountGetDeclarationSpecifiers(
        int $count, 
        array $declSpecs
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $this->buildCount($prophecy, $count);
        
        $prophecy
            ->getDeclarationSpecifiers()
            ->willReturn($declSpecs);
        
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

