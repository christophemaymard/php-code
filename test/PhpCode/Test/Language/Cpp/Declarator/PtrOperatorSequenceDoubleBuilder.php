<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\PtrOperator;
use PhpCode\Language\Cpp\Declarator\PtrOperatorSequence;
use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents a builder of double for the {@see PhpCode\Language\Cpp\Declarator\PtrOperatorSequence} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrOperatorSequenceDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return PtrOperatorSequence::class;
    }
    
    /**
     * Builds and adds a prophecy where getPtrOperators() can be called.
     * 
     * @param   PtrOperator[]   $return The value to return when getPtrOperators() is called.
     * @return  PtrOperatorSequenceDoubleBuilder    This instance.
     */
    public function buildGetPtrOperators(array $return): self
    {
        $this->getSubjectProphecy()
            ->getPtrOperators()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds and adds a prophecy where count() can be called.
     * 
     * @param   int $return The value to return when count() is called.
     * @return  PtrOperatorSequenceDoubleBuilder    This instance.
     */
    public function buildCount(int $return): self
    {
        $this->getSubjectProphecy()
            ->count()
            ->willReturn($return);
        
        return $this;
    }
}

