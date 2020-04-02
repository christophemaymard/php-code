<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\AbstractDeclarator;
use PhpCode\Language\Cpp\Declarator\PtrAbstractDeclarator;
use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents a builder of double for the {@see PhpCode\Language\Cpp\Declarator\AbstractDeclarator} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AbstractDeclaratorDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return AbstractDeclarator::class;
    }
    
    /**
     * Builds and adds a prophecy where getPtrAbstractDeclarator() can be 
     * called.
     * 
     * @param   PtrAbstractDeclarator   $return The value to return when getPtrAbstractDeclarator() is called.
     * @return  AbstractDeclaratorDoubleBuilder This instance.
     */
    public function buildGetPtrAbstractDeclarator(PtrAbstractDeclarator $return): self
    {
        $this->getSubjectProphecy()
            ->getPtrAbstractDeclarator()
            ->willReturn($return);
        
        return $this;
    }
}

