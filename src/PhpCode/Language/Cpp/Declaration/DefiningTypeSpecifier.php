<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Declaration;

/**
 * Represents a defining type specifier.
 * 
 * defining-type-specifier:
 *     type-specifier
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DefiningTypeSpecifier
{
    /**
     * The type specifier.
     * @var TypeSpecifier
     */
    private $typeSpec;
    
    /**
     * Creates an instance of a defining type specifier defined as a type 
     * specifier.
     * 
     * @param   TypeSpecifier   $typeSpec   The type specifier.
     * @return  DefiningTypeSpecifier   The created instance of defining type specifier.
     */
    public static function createTypeSpecifier(TypeSpecifier $typeSpec): self
    {
        $defSypeSpec = new self();
        $defSypeSpec->typeSpec = $typeSpec;
        
        return $defSypeSpec;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * Returns the type specifier.
     * 
     * @return  TypeSpecifier
     */
    public function getTypeSpecifier(): TypeSpecifier
    {
        return $this->typeSpec;
    }
}

