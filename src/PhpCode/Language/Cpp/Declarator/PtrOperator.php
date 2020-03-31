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
 * Represents a pointer operator.
 * 
 * ptr-operator:
 *     * cv-qualifier-seq[opt]
 *     &
 *     &&
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrOperator
{
    private const OP_POINTER = 1;
    private const OP_LVALUE = 2;
    private const OP_RVALUE = 3;
    
    /**
     * The type of this pointer operator.
     * @var int
     */
    private $type;
    
    /**
     * The constant/volatile qualifier sequence.
     * @var CVQualifierSequence|NULL
     */
    private $cvSeq;
    
    /**
     * Creates an instance of a pointer operator defined as a pointer.
     * 
     * @return  PtrOperator The created instance of pointer operator.
     */
    public static function createPointer(): self
    {
        $ptrOp = new self();
        $ptrOp->type = self::OP_POINTER;
        
        return $ptrOp;
    }
    
    /**
     * Creates an instance of a pointer operator defined as a lvalue 
     * reference.
     * 
     * @return  PtrOperator The created instance of pointer operator.
     */
    public static function createLvalueReference(): self
    {
        $ptrOp = new self();
        $ptrOp->type = self::OP_LVALUE;
        
        return $ptrOp;
    }
    
    /**
     * Creates an instance of a pointer operator defined as a rvalue 
     * reference.
     * 
     * @return  PtrOperator The created instance of pointer operator.
     */
    public static function createRvalueReference(): self
    {
        $ptrOp = new self();
        $ptrOp->type = self::OP_RVALUE;
        
        return $ptrOp;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * Indicates whether this pointer operator is defined as a pointer.
     * 
     * @return  bool    TRUE if this pointer operator is defined as a pointer, otherwise FALSE.
     */
    public function isPointer(): bool
    {
        return $this->type == self::OP_POINTER;
    }
    
    /**
     * Indicates whether this pointer operator is defined as a lvalue 
     * reference.
     * 
     * @return  bool    TRUE if this pointer operator is defined as a lvalue reference, otherwise FALSE.
     */
    public function isLvalue(): bool
    {
        return $this->type == self::OP_LVALUE;
    }
    
    /**
     * Indicates whether this pointer operator is defined as a lvalue 
     * reference.
     * 
     * @return  bool    TRUE if this pointer operator is defined as a rvalue reference, otherwise FALSE.
     */
    public function isRvalue(): bool
    {
        return $this->type == self::OP_RVALUE;
    }
    
    /**
     * Returns the constant/volatile qualifier sequence.
     * 
     * @return  CVQualifierSequence|NULL    The instance of constant/volatile qualifier sequence if it has been set, otherwise NULL.
     */
    public function getCVQualifierSequence(): ?CVQualifierSequence
    {
        return $this->cvSeq;
    }
    
    /**
     * Sets the constant/volatile qualifier sequence.
     * 
     * @param   CVQualifierSequence $cvSeq  The constant/volatile qualifier sequence to set.
     * 
     * @throws  InvalidOperationException   When this pointer operator is defined as a lvalue reference.
     * @throws  InvalidOperationException   When this pointer operator is defined as a rvalue reference.
     */
    public function setCVQualifierSequence(CVQualifierSequence $cvSeq): void
    {
        if ($this->isLvalue()) {
            throw new InvalidOperationException(
                'Lvalue reference cannot have a constant/volatile qualifier sequence.'
            );
        }
        
        if ($this->isRvalue()) {
            throw new InvalidOperationException(
                'Rvalue reference cannot have a constant/volatile qualifier sequence.'
            );
        }
        
        $this->cvSeq = $cvSeq;
    }
    
    /**
     * Indicates whether this pointer operator has a constant/volatile 
     * qualifier sequence.
     * 
     * @return  bool    TRUE if this pointer operator has a constant/volatile qualifier sequence, otherwise FALSE.
     */
    public function hasCVQualifierSequence(): bool
    {
        return $this->cvSeq !== NULL;
    }
}

