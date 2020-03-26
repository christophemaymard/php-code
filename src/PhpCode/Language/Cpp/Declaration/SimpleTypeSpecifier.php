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
 *     char
 *     wchar_t
 *     bool
 *     short
 *     int
 *     long
 *     signed
 *     float
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleTypeSpecifier
{
    private const ST_INT = 1;
    private const ST_FLOAT = 2;
    private const ST_BOOL = 3;
    private const ST_CHAR = 4;
    private const ST_WCHART = 5;
    private const ST_SHORT = 6;
    private const ST_LONG = 7;
    private const ST_SIGNED = 8;
    
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
     * Creates an instance of a simple type specifier defined as "bool".
     * 
     * @return  SimpleTypeSpecifier The created instance of SimpleTypeSpecifier.
     */
    public static function createBool(): self
    {
        $stSpec = new self();
        $stSpec->type = self::ST_BOOL;
        
        return $stSpec;
    }
    
    /**
     * Creates an instance of a simple type specifier defined as "char".
     * 
     * @return  SimpleTypeSpecifier The created instance of SimpleTypeSpecifier.
     */
    public static function createChar(): self
    {
        $stSpec = new self();
        $stSpec->type = self::ST_CHAR;
        
        return $stSpec;
    }
    
    /**
     * Creates an instance of a simple type specifier defined as "wchar_t".
     * 
     * @return  SimpleTypeSpecifier The created instance of SimpleTypeSpecifier.
     */
    public static function createWCharT(): self
    {
        $stSpec = new self();
        $stSpec->type = self::ST_WCHART;
        
        return $stSpec;
    }
    
    /**
     * Creates an instance of a simple type specifier defined as "short".
     * 
     * @return  SimpleTypeSpecifier The created instance of SimpleTypeSpecifier.
     */
    public static function createShort(): self
    {
        $stSpec = new self();
        $stSpec->type = self::ST_SHORT;
        
        return $stSpec;
    }
    
    /**
     * Creates an instance of a simple type specifier defined as "long".
     * 
     * @return  SimpleTypeSpecifier The created instance of SimpleTypeSpecifier.
     */
    public static function createLong(): self
    {
        $stSpec = new self();
        $stSpec->type = self::ST_LONG;
        
        return $stSpec;
    }
    
    /**
     * Creates an instance of a simple type specifier defined as "signed".
     * 
     * @return  SimpleTypeSpecifier The created instance of SimpleTypeSpecifier.
     */
    public static function createSigned(): self
    {
        $stSpec = new self();
        $stSpec->type = self::ST_SIGNED;
        
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
    
    /**
     * Indicates whether this simple type specifier is defined as "bool".
     * 
     * @return  bool    TRUE if this simple type specifier is defined as "bool", otherwise FALSE.
     */
    public function isBool(): bool
    {
        return $this->type == self::ST_BOOL;
    }
    
    /**
     * Indicates whether this simple type specifier is defined as "char".
     * 
     * @return  bool    TRUE if this simple type specifier is defined as "char", otherwise FALSE.
     */
    public function isChar(): bool
    {
        return $this->type == self::ST_CHAR;
    }
    
    /**
     * Indicates whether this simple type specifier is defined as "wchar_t".
     * 
     * @return  bool    TRUE if this simple type specifier is defined as "wchar_t", otherwise FALSE.
     */
    public function isWCharT(): bool
    {
        return $this->type == self::ST_WCHART;
    }
    
    /**
     * Indicates whether this simple type specifier is defined as "short".
     * 
     * @return  bool    TRUE if this simple type specifier is defined as "short", otherwise FALSE.
     */
    public function isShort(): bool
    {
        return $this->type == self::ST_SHORT;
    }
    
    /**
     * Indicates whether this simple type specifier is defined as "long".
     * 
     * @return  bool    TRUE if this simple type specifier is defined as "long", otherwise FALSE.
     */
    public function isLong(): bool
    {
        return $this->type == self::ST_LONG;
    }
    
    /**
     * Indicates whether this simple type specifier is defined as "signed".
     * 
     * @return  bool    TRUE if this simple type specifier is defined as "signed", otherwise FALSE.
     */
    public function isSigned(): bool
    {
        return $this->type == self::ST_SIGNED;
    }
}

