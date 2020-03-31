<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Exception\InvalidOperationException;
use PhpCode\Language\Cpp\Declarator\PtrOperator;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;

/**
 * Represents the constraint for a pointer operator.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrOperatorConstraint extends AbstractConceptConstraint
{
    private const OP_POINTER = 1;
    private const OP_LVALUE = 2;
    private const OP_RVALUE = 3;
    
    /**
     * The type of this pointer operator constraint.
     * @var int
     */
    private $type;
    
    /**
     * The constant/volatile qualifier sequence constraint.
     * @var CVQualifierSequenceConstraint|NULL
     */
    private $cvSeqConst;
    
    /**
     * Creates a constraint for a pointer operator that is defined as a 
     * pointer.
     * 
     * @return  PtrOperatorConstraint   The created instance of pointer operator constraint.
     */
    public static function createPointer(): self
    {
        $const = new self();
        $const->type = self::OP_POINTER;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a pointer operator that is defined as a 
     * lvalue reference.
     * 
     * @return  PtrOperatorConstraint   The created instance of pointer operator constraint.
     */
    public static function createLvalueReference(): self
    {
        $const = new self();
        $const->type = self::OP_LVALUE;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a pointer operator that is defined as a 
     * rvalue reference.
     * 
     * @return  PtrOperatorConstraint   The created instance of pointer operator constraint.
     */
    public static function createRvalueReference(): self
    {
        $const = new self();
        $const->type = self::OP_RVALUE;
        
        return $const;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * Sets the constant/volatile qualifier sequence constraint.
     * 
     * @param   CVQualifierSequenceConstraint   $cvSeqConst The constant/volatile qualifier sequence constraint to set.
     * 
     * @throws  InvalidOperationException   When this pointer operator constraint is defined as a lvalue reference.
     * @throws  InvalidOperationException   When this pointer operator constraint is defined as a rvalue reference.
     */
    public function setCVQualifierSequenceConstraint(
        CVQualifierSequenceConstraint $cvSeqConst
    ): void
    {
        if ($this->type == self::OP_LVALUE) {
            throw new InvalidOperationException(
                'Lvalue reference cannot have a constant/volatile qualifier sequence constraint.'
            );
        }
        
        if ($this->type == self::OP_RVALUE) {
            throw new InvalidOperationException(
                'Rvalue reference cannot have a constant/volatile qualifier sequence constraint.'
            );
        }
        
        $this->cvSeqConst = $cvSeqConst;
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        if ($this->type == self::OP_POINTER) {
            $type = 'pointer';
        } elseif ($this->type == self::OP_LVALUE) {
            $type = 'lvalue reference';
        } else {
            $type = 'rvalue reference';
        }
        
        return \sprintf('pointer operator (%s)', $type);
    }
    
    /**
     * {@inheritDoc}
     */
    public function constraintDescription(): string
    {
        $lines = [];
        $lines[] = $this->getConceptName();
        
        if ($this->cvSeqConst) {
            $lines[] = $this->indent($this->cvSeqConst->constraintDescription());
        }
        
        return \implode("\n", $lines);
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        if (!$other instanceof PtrOperator) {
            return FALSE;
        }
        
        if ($this->type == self::OP_POINTER) {
            if (!$other->isPointer()) {
                return FALSE;
            }
            
            $cvSeq = $other->getCVQualifierSequence();
            
            if ($this->cvSeqConst) {
                return $this->cvSeqConst->matches($cvSeq);
            } else {
                if ($cvSeq) {
                    return FALSE;
                }
            }
        } elseif ($this->type == self::OP_LVALUE) {
            return $other->isLvalue();
        } else {
            // It is a pointer operator constraint that is defined as a 
            // rvalue reference constraint.
            
            return $other->isRvalue();
        }
        
        return TRUE;
    }
    
    /**
     * {@inheritDoc}
     */
    public function failureReason($other): string
    {
        if (!$other instanceof PtrOperator) {
            return $this->instanceReason(PtrOperator::class, $other);
        }
        
        if ($this->type == self::OP_POINTER) {
            if (!$other->isPointer()) {
                return $this->isReason(TRUE, 'pointer');
            }
            
            $cvSeq = $other->getCVQualifierSequence();
            
            if ($this->cvSeqConst) {
                if (!$cvSeq) {
                    return $this->hasReason(TRUE, 'constant/volatile qualifier sequence');
                }
                
                if (!$this->cvSeqConst->matches($cvSeq)) {
                    return $this->conceptIndent(
                        $this->cvSeqConst->failureReason($cvSeq)
                    );
                }
            } else {
                if ($cvSeq) {
                    return $this->hasReason(FALSE, 'constant/volatile qualifier sequence');
                }
            }
        } elseif ($this->type == self::OP_LVALUE) {
            if (!$other->isLvalue()) {
                return $this->isReason(TRUE, 'lvalue reference');
            }
        } else {
            // It is a pointer operator constraint that is defined as a 
            // rvalue reference constraint.
            
            if (!$other->isRvalue()) {
                return $this->isReason(TRUE, 'rvalue reference');
            }
        }
        
        return $this->failureDefaultReason($other);
    }
    
    /**
     * {@inheritDoc}
     */
    protected function failureDescription($other): string
    {
        return \sprintf(
            '%s is a %s', 
            $this->exporter()->shortenedExport($other), 
            $this->toString()
        );
    }
}

