<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Expression\NestedNameSpecifier;
use PhpCode\Language\Cpp\Lexical\Identifier;

/**
 * Represents a simple type specifier.
 * 
 * simple-type-specifier:
 *     nested-name-specifier[opt] identifier
 *     char
 *     wchar_t
 *     bool
 *     short
 *     int
 *     long
 *     signed
 *     unsigned
 *     float
 *     double
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
    private const ST_UNSIGNED = 9;
    private const ST_DOUBLE = 10;
    private const ST_ID = 11;
    private const ST_QUALIFIED_ID = 12;
    
    /**
     * The type of this simple type specifier.
     * @var int
     */
    private $type;
    
    /**
     * The identifier of this simple type specifier if it has been defined 
     * as "identifier" or a qualified identifier.
     * @var Identifier|NULL
     */
    private $id;
    
    /**
     * The nested name specifier of this simple type specifier if it has been 
     * defined as a qualified identifier.
     * @var NestedNameSpecifier|NULL
     */
    private $nnSpec;
    
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
     * Creates an instance of a simple type specifier defined as "unsigned".
     * 
     * @return  SimpleTypeSpecifier The created instance of SimpleTypeSpecifier.
     */
    public static function createUnsigned(): self
    {
        $stSpec = new self();
        $stSpec->type = self::ST_UNSIGNED;
        
        return $stSpec;
    }
    
    /**
     * Creates an instance of a simple type specifier defined as "double".
     * 
     * @return  SimpleTypeSpecifier The created instance of SimpleTypeSpecifier.
     */
    public static function createDouble(): self
    {
        $stSpec = new self();
        $stSpec->type = self::ST_DOUBLE;
        
        return $stSpec;
    }
    
    /**
     * Creates an instance of a simple type specifier defined as "identifier".
     * 
     * @param   Identifier  $id The identifier.
     * @return  SimpleTypeSpecifier The created instance of SimpleTypeSpecifier.
     */
    public static function createIdentifier(Identifier $id): self
    {
        $stSpec = new self();
        $stSpec->type = self::ST_ID;
        $stSpec->id = $id;
        
        return $stSpec;
    }
    
    /**
     * Creates an instance of a simple type specifier defined as a qualified 
     * identifier.
     * 
     * @param   NestedNameSpecifier $nnSpec The nested name specifier.
     * @param   Identifier          $id     The identifier.
     * @return  SimpleTypeSpecifier The created instance of SimpleTypeSpecifier.
     */
    public static function createQualifiedIdentifier(
        NestedNameSpecifier $nnSpec, 
        Identifier $id
    ): self
    {
        $stSpec = new self();
        $stSpec->type = self::ST_QUALIFIED_ID;
        $stSpec->nnSpec = $nnSpec;
        $stSpec->id = $id;
        
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
    
    /**
     * Indicates whether this simple type specifier is defined as "unsigned".
     * 
     * @return  bool    TRUE if this simple type specifier is defined as "unsigned", otherwise FALSE.
     */
    public function isUnsigned(): bool
    {
        return $this->type == self::ST_UNSIGNED;
    }
    
    /**
     * Indicates whether this simple type specifier is defined as "double".
     * 
     * @return  bool    TRUE if this simple type specifier is defined as "double", otherwise FALSE.
     */
    public function isDouble(): bool
    {
        return $this->type == self::ST_DOUBLE;
    }
    
    /**
     * Indicates whether this simple type specifier is defined as "identifier".
     * 
     * @return  bool    TRUE if this simple type specifier is defined as "identifier", otherwise FALSE.
     */
    public function isIdentifier(): bool
    {
        return $this->type == self::ST_ID;
    }
    
    /**
     * Indicates whether this simple type specifier is defined as a qualified 
     * identifier.
     * 
     * @return  bool    TRUE if this simple type specifier is defined as a qualified identifier, otherwise FALSE.
     */
    public function isQualifiedIdentifier(): bool
    {
        return $this->type == self::ST_QUALIFIED_ID;
    }
    
    /**
     * Returns the identifier.
     * 
     * @return  Identifier|NULL The instance of Identifier if this simple type specifier is defined as "identifier" or a qualified identifier, otherwise NULL.
     */
    public function getIdentifier(): ?Identifier
    {
        return $this->id;
    }
    
    /**
     * Returns the nested name specifier.
     * 
     * @return  NestedNameSpecifier|NULL    The instance of NestedNameSpecifier if this simple type specifier is defined as a qualified identifier, otherwise NULL.
     */
    public function getNestedNameSpecifier(): ?NestedNameSpecifier
    {
        return $this->nnSpec;
    }
}

