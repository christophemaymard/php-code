<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Declaration;

/**
 * Represents a simple type specifier.
 * 
 * simple-type-specifier:
 *     int
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleTypeSpecifier
{
    /**
     * Creates an instance of a simple type specifier defined as "int".
     * 
     * @return  SimpleTypeSpecifier The created instance of SimpleTypeSpecifier.
     */
    public static function createInt(): self
    {
        $stSpec = new self();
        
        return $stSpec;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * Indicates whether this simple type specifier is defined as "int".
     * 
     * @return  bool    TRUE if this simple type specifier is defined as "int", otherwise FALSE.
     */
    public function isInt(): bool
    {
        return TRUE;
    }
}

