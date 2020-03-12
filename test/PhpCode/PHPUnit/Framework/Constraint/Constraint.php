<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\PHPUnit\Framework\Constraint;

use PHPUnit\Framework\Constraint\Constraint as PHPUnitConstraint;

/**
 * Represents the base class for constraints which can be applied to any 
 * value.
 * 
 * Additionally, it provides a description of the constraint and the reason 
 * of the failure.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class Constraint extends PHPUnitConstraint
{
    /**
     * Returns the description of this constraint.
     * 
     * @return  string
     */
    public function constraintDescription(): string
    {
        return '';
    }
    
    /**
     * Returns the reason of the failure.
     * 
     * @param   mixed   $other  The evaluated value or object.
     * @return  string
     */
    public function failureReason($other): string
    {
        return $this->failureDefaultReason($other);
    }
    
    /**
     * Returns the default reason of the failure.
     * 
     * @param   mixed   $other  The evaluated value or object.
     * @return  string
     */
    public function failureDefaultReason($other): string
    {
        return '';
    }
    
    /**
     * {@inheritDoc}
     */
    public function additionalFailureDescription($other): string
    {
        $lines = [];
        
        if ('' !== $constDesc = $this->constraintDescription()) {
            $lines[] = '';
            $lines[] = $constDesc;
        }
        
        if ('' !== $reason = $this->failureReason($other)) {
            $lines[] = '';
            $lines[] = $reason;
        }
        
        return \implode("\n", $lines);
    }
}

