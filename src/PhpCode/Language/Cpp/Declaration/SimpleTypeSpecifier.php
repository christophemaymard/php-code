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
 *     float
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleTypeSpecifier
{
    private const ST_INT = 1;
    private const ST_FLOAT = 2;
    
    /**
     * The type of this simple type specifier.
     * @var int
     */
    private $type;
    
    /**
     * Creates an instance of a simple type specifier defined as "int".
     * 
     * @return  SimpleTypeSpecifier The created instance of SimpleTypeSpecifier.
     */
    public static function createInt(): self
    {
        $stSpec = new self();
        $stSpec->type = self::ST_INT;
        
        return $stSpec;
    }
    
    /**
     * Creates an instance of a simple type specifier defined as "float".
     * 
     * @return  SimpleTypeSpecifier The created instance of SimpleTypeSpecifier.
     */
    public static function createFloat(): self
    {
        $stSpec = new self();
        $stSpec->type = self::ST_FLOAT;
        
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
        return $this->type == self::ST_INT;
    }
    
    /**
     * Indicates whether this simple type specifier is defined as "float".
     * 
     * @return  bool    TRUE if this simple type specifier is defined as "float", otherwise FALSE.
     */
    public function isFloat(): bool
    {
        return $this->type == self::ST_FLOAT;
    }
}

