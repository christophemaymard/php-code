<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Declarator;

/**
 * Represents a constant/volatile qualifier.
 * 
 * cv-qualifier:
 *     const
 *     volatile
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class CVQualifier
{
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
     * Creates an instance of a constant/volatile qualifier defined as 
     * constant.
     * 
     * @return  CVQualifier The created instance of constant/volatile qualifier.
     */
    public static function createConst(): self
    {
        $cv = new self();
        $cv->constant = TRUE;
        
        return $cv;
    }
    
    /**
     * Creates an instance of a constant/volatile qualifier defined as 
     * volatile.
     * 
     * @return  CVQualifier The created instance of constant/volatile qualifier.
     */
    public static function createVolatile(): self
    {
        $cv = new self();
        $cv->volatile = TRUE;
        
        return $cv;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * Indicates whether this constant/volatile qualifier is defined as 
     * constant.
     * 
     * @return  bool    TRUE if this constant/volatile qualifier is defined as constant, otherwise FALSE.
     */
    public function isConst(): bool
    {
        return $this->constant;
    }
    
    /**
     * Indicates whether this constant/volatile qualifier is defined as 
     * volatile.
     * 
     * @return  bool    TRUE if this constant/volatile qualifier is defined as volatile, otherwise FALSE.
     */
    public function isVolatile(): bool
    {
        return $this->volatile;
    }
}

