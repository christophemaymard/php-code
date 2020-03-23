<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\Declarator;
use PhpCode\Language\Cpp\Declarator\PtrDeclarator;
use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents a double builder of the {@see PhpCode\Language\Cpp\Declarator\Declarator} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclaratorDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return Declarator::class;
    }
    
    /**
     * Builds a prophecy where getPtrDeclarator() can be called.
     * 
     * @param   PtrDeclarator   $return The value to return when getPtrDeclarator() is called (optional)(default to NULL).
     * @return  DeclaratorDoubleBuilder  This instance.
     */
    public function buildGetPtrDeclarator(PtrDeclarator $return = NULL): self
    {
        $this->getSubjectProphecy()
            ->getPtrDeclarator()
            ->willReturn($return);
        
        return $this;
    }
}

