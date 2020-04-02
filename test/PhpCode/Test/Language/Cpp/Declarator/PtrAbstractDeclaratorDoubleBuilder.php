<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\PtrAbstractDeclarator;
use PhpCode\Language\Cpp\Declarator\PtrOperatorSequence;
use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents a builder of double for the {@see PhpCode\Language\Cpp\Declarator\PtrAbstractDeclarator} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrAbstractDeclaratorDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return PtrAbstractDeclarator::class;
    }
    
    /**
     * Builds and adds a prophecy where getPtrOperatorSequence() can be 
     * called.
     * 
     * @param   PtrOperatorSequence $return The value to return when getPtrOperatorSequence() is called (optional)(default to NULL).
     * @return  PtrAbstractDeclaratorDoubleBuilder  This instance.
     */
    public function buildGetPtrOperatorSequence(PtrOperatorSequence $return = NULL): self
    {
        $this->getSubjectProphecy()
            ->getPtrOperatorSequence()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds and adds a prophecy where hasPtrOperatorSequence() can be called.
     * 
     * @param   bool    $return The value to return when hasPtrOperatorSequence() is called.
     * @return  PtrAbstractDeclaratorDoubleBuilder  This instance.
     */
    public function buildHasPtrOperatorSequence(bool $return): self
    {
        $this->getSubjectProphecy()
            ->hasPtrOperatorSequence()
            ->willReturn($return);
        
        return $this;
    }
}

