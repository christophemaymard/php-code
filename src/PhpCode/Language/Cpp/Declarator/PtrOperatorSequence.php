<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Declarator;

use PhpCode\Exception\InvalidOperationException;

/**
 * Represents a sequence of pointer operators.
 * 
 * ptr-operator-seq:
 *     ptr-operator ptr-operator-seq[opt]
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrOperatorSequence implements \Countable
{
    private const OP_NONE = 0;
    private const OP_POINTER = 1;
    private const OP_LVALUE = 2;
    private const OP_RVALUE = 3;
    
    /**
     * The type of this sequence (default to PtrOperatorSequence::OP_NONE).
     * @var int
     */
    private $type = self::OP_NONE;
    
    /**
     * The pointer operators.
     * @var PtrOperator[]
     */
    private $ptrOps = [];
    
    /**
     * Adds the specified pointer operator to this sequence.
     * 
     * @param   PtrOperator $ptrOp  The pointer operator to add.
     * 
     * @throws  InvalidOperationException   When adding a reference whereas the sequence is a reference.
     * @throws  InvalidOperationException   When adding a pointer whereas the sequence is a reference.
     */
    public function addPtrOperator(PtrOperator $ptrOp): void
    {
        if ($ptrOp->isLvalue() || $ptrOp->isRvalue()) {
            if ($this->type == self::OP_LVALUE || $this->type == self::OP_RVALUE) {
                throw new InvalidOperationException('Reference to reference is illegal.');
            }
            
            $this->type = $ptrOp->isLvalue() ? self::OP_LVALUE : self::OP_RVALUE;
        } else {
            if ($this->type == self::OP_LVALUE || $this->type == self::OP_RVALUE) {
                throw new InvalidOperationException('Pointer to reference is illegal.');
            }
            
            $this->type = self::OP_POINTER;
        }
        
        $this->ptrOps[] = $ptrOp;
    }
    
    /**
     * Returns all the pointer operators of this sequence.
     * 
     * @return  PtrOperator[]   An indexed array of pointer operators.
     */
    public function getPtrOperators(): array
    {
        return $this->ptrOps;
    }
    
    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        return \count($this->ptrOps);
    }
}

