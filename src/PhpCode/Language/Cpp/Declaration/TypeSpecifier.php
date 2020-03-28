<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Declaration;

/**
 * Represents a type specifier.
 * 
 * type-specifier:
 *     simple-type-specifier
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TypeSpecifier
{
    /**
     * The simple type specifier.
     * @var SimpleTypeSpecifier
     */
    private $stSpec;
    
    /**
     * Creates an instance of a type specifier defined as a simple type 
     * specifier.
     * 
     * @param   SimpleTypeSpecifier $stSpec The simple type specifier.
     * @return  TypeSpecifier   The created instance of type specifier.
     */
    public static function createSimpleTypeSpecifier(SimpleTypeSpecifier $stSpec): self
    {
        $typeSpec = new self();
        $typeSpec->stSpec = $stSpec;
        
        return $typeSpec;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * Returns the simple type specifier.
     * 
     * @return  SimpleTypeSpecifier
     */
    public function getSimpleTypeSpecifier(): SimpleTypeSpecifier
    {
        return $this->stSpec;
    }
}

