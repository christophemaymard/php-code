<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Declaration;

/**
 * Represents a declaration specifier.
 * 
 * decl-specifier:
 *     defining-type-specifier
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclarationSpecifier
{
    /**
     * The defining type specifier.
     * @var DefiningTypeSpecifier
     */
    private $defTypeSpec;
    
    /**
     * Creates an instance of a declaration specifier defined as a defining 
     * type specifier.
     * 
     * @param   DefiningTypeSpecifier   $defTypeSpec    The defining type specifier.
     * @return  DeclarationSpecifier    The created instance of declaration specifier.
     */
    public static function createDefiningTypeSpecifier(DefiningTypeSpecifier $defTypeSpec): self
    {
        $declSpec = new self();
        $declSpec->defTypeSpec = $defTypeSpec;
        
        return $declSpec;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * Returns the defining type specifier.
     * 
     * @return  DefiningTypeSpecifier
     */
    public function getDefiningTypeSpecifier(): DefiningTypeSpecifier
    {
        return $this->defTypeSpec;
    }
}

