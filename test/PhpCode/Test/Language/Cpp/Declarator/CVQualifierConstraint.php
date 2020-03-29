<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\CVQualifier;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;

/**
 * Represents the constraint for a constant/volatile qualifier.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class CVQualifierConstraint extends AbstractConceptConstraint
{
    /**
     * The flag to indicate that the constant/volatile qualifier is defined 
     * as constant.
     * FALSE means that the constant/volatile qualifier is not defined as 
     * constant but volatile.
     * @var bool
     */
    private $isConstant;
    
    /**
     * Creates a constraint for a constant/volatile qualifier that is defined 
     * as constant.
     * 
     * @return  CVQualifierConstraint   The created instance of constant/volatile qualifier constraint.
     */
    public static function createConst(): self
    {
        $const = new self();
        $const->isConstant = TRUE;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a constant/volatile qualifier that is defined 
     * as volatile.
     * 
     * @return  CVQualifierConstraint   The created instance of constant/volatile qualifier constraint.
     */
    public static function createVolatile(): self
    {
        $const = new self();
        $const->isConstant = FALSE;
        
        return $const;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return $this->isConstant ? 'constant CV qualifier' : 'volatile CV qualifier';
    }
    
    /**
     * {@inheritDoc}
     */
    public function constraintDescription(): string
    {
        return $this->getConceptName();
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        if (!$other instanceof CVQualifier) {
            return FALSE;
        }
        
        return $this->isConstant ? $other->isConst() : $other->isVolatile();
    }
    
    /**
     * {@inheritDoc}
     */
    public function failureReason($other): string
    {
        if (!$other instanceof CVQualifier) {
            return $this->instanceReason(CVQualifier::class, $other);
        }
        
        if ($this->isConstant) {
            if (!$other->isConst()) {
                return $this->isReason(TRUE, 'constant');
            }
        } else {
            if (!$other->isVolatile()) {
                return $this->isReason(TRUE, 'volatile');
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

