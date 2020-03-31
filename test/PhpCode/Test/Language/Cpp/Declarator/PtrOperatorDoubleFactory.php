<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\CVQualifierSequence;
use PhpCode\Language\Cpp\Declarator\PtrOperator;
use PhpCode\Test\AbstractDoubleFactory;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Declarator\PtrOperator} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrOperatorDoubleFactory extends AbstractDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return PtrOperator::class;
    }
    
    /**
     * Creates a double of a pointer operator defined as a pointer.
     * 
     * @param   CVQualifierSequence $cvSeq  The constant/volatile qualifier sequence to set (optional)(default to NULL).
     * @return  PtrOperator
     */
    public function createPointer(CVQualifierSequence $cvSeq = NULL): PtrOperator
    {
        return ConceptDoubleBuilder::createPtrOperator($this->getTestCase())
            ->buildIsPointer(TRUE)
            ->buildIsLvalue(FALSE)
            ->buildIsRvalue(FALSE)
            ->buildGetCVQualifierSequence($cvSeq)
            ->buildHasCVQualifierSequence($cvSeq instanceof CVQualifierSequence)
            ->getDouble();        
    }
    
    /**
     * Creates a double of a pointer operator defined as a lvalue reference.
     * 
     * @return  PtrOperator
     */
    public function createLvalue(): PtrOperator
    {
        return ConceptDoubleBuilder::createPtrOperator($this->getTestCase())
            ->buildIsPointer(FALSE)
            ->buildIsLvalue(TRUE)
            ->buildIsRvalue(FALSE)
            ->buildGetCVQualifierSequence()
            ->buildHasCVQualifierSequence(FALSE)
            ->getDouble();
    }
    
    /**
     * Creates a double of a pointer operator defined as a rvalue reference.
     * 
     * @return  PtrOperator
     */
    public function createRvalue(): PtrOperator
    {
        return ConceptDoubleBuilder::createPtrOperator($this->getTestCase())
            ->buildIsPointer(FALSE)
            ->buildIsLvalue(FALSE)
            ->buildIsRvalue(TRUE)
            ->buildGetCVQualifierSequence()
            ->buildHasCVQualifierSequence(FALSE)
            ->getDouble();
    }
}

