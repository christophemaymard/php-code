<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParameterDeclaration;
use PhpCode\Language\Cpp\Declarator\ParameterDeclarationList;
use PhpCode\Test\AbstractDoubleFactory;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Declarator\ParameterDeclarationList} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationListDoubleFactory extends AbstractDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return ParameterDeclarationList::class;
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
     * Creates a double where count() and getParameterDeclarations() can be 
     * called.
     * 
     * @param   int                     $count      The value to return when count() is called.
     * @param   ParameterDeclaration[]  $prmDecls   The value to return when getParameterDeclarations() is called.
     * @return  ProphecySubjectInterface
     */
    public function createCountGetParameterDeclarations(
        int $count, 
        array $prmDecls
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        $this->buildCount($prophecy, $count);
        
        $prophecy
            ->getParameterDeclarations()
            ->willReturn($prmDecls);
        
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

