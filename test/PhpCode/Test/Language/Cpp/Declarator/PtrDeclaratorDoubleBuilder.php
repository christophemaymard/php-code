<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\NoptrDeclarator;
use PhpCode\Language\Cpp\Declarator\PtrDeclarator;
use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents a builder of double for the {@see PhpCode\Language\Cpp\Declarator\PtrDeclarator} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrDeclaratorDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return PtrDeclarator::class;
    }
    
    /**
     * Builds a prophecy where getNoptrDeclarator() can be called.
     * 
     * @param   NoptrDeclarator $return The value to return when getNoptrDeclarator() is called.
     * @return  PtrDeclaratorDoubleBuilder  This instance.
     */
    public function buildGetNoptrDeclarator(NoptrDeclarator $return): self
    {
        $this->getSubjectProphecy()
            ->getNoptrDeclarator()
            ->willReturn($return);
        
        return $this;
    }
}

