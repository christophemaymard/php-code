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
 * Represents a sequence of constant/volatile qualifiers.
 * 
 * cv-qualifier-seq:
 *     cv-qualifier cv-qualifier-seq[opt]
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class CVQualifierSequence
{
    /**
     * The constant/volatile qualifiers.
     * @var CVQualifier[]
     */
    private $cvs = [];
    
    /**
     * The constant flag (default to FALSE).
     * @var bool
     */
    private $constant = FALSE;
    
    /**
     * The volatile flag (default to FALSE).
     * @var bool
     */
    private $volatile = FALSE;
    
    /**
     * Adds the specified constant/volatile qualifier to this sequence.
     * 
     * @param   CVQualifier $cv The constant/volatile qualifier to add.
     * 
     * @throws  InvalidOperationException   When adding a qualifier defined as constant whereas a previous qualifier defined as constant has been added.
     * @throws  InvalidOperationException   When adding a qualifier defined as volatile whereas a previous qualifier defined as volatile has been added.
     */
    public function addCVQualifier(CVQualifier $cv): void
    {
        if ($cv->isConst()) {
            if ($this->constant) {
                throw new InvalidOperationException(
                    'Duplicate constant/volatile qualifier defined as constant.'
                );
            }
            
            $this->constant = TRUE;
        } else {
            if ($this->volatile) {
                throw new InvalidOperationException(
                    'Duplicate constant/volatile qualifier defined as volatile.'
                );
            }
            
            $this->volatile = TRUE;
        }
        
        $this->cvs[] = $cv;
    }
    
    /**
     * Returns all the constant/volatile qualifiers of this sequence.
     * 
     * @return  CVQualifier[]   An indexed array of constant/volatile qualifiers.
     */
    public function getCVQualifiers(): array
    {
        return $this->cvs;
    }
}

