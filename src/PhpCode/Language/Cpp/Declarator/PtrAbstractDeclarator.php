<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Declarator;

/**
 * Represents a pointer abstract declarator.
 * 
 * ptr-abstract-declarator:
 *     ptr-operator ptr-abstract-declarator[opt]
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrAbstractDeclarator
{
    /**
     * The pointer operator sequence.
     * @var PtrOperatorSequence|NULL
     */
    private $ptrOpSeq;
    
    /**
     * Returns the pointer operator sequence.
     * 
     * @return  PtrOperatorSequence|NULL    The instance of pointer operator sequence if it has been set, otherwise NULL.
     */
    public function getPtrOperatorSequence(): ?PtrOperatorSequence
    {
        return $this->ptrOpSeq;
    }
    
    /**
     * Sets the pointer operator sequence.
     * 
     * @param   PtrOperatorSequence $ptrOpSeq   The pointer operator sequence to set.
     */
    public function setPtrOperatorSequence(PtrOperatorSequence $ptrOpSeq): void
    {
        $this->ptrOpSeq = $ptrOpSeq;
    }
    
    /**
     * Indicates whether this pointer abstract declarator has a pointer 
     * operator sequence.
     * 
     * @return  bool    TRUE if this pointer abstract declarator has a pointer operator sequence, otherwise FALSE.
     */
    public function hasPtrOperatorSequence(): bool
    {
        return $this->ptrOpSeq !== NULL;
    }
}

