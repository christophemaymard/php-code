<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Declaration;

/**
 * Represents a declaration specifier sequence.
 * 
 * decl-specifier-seq:
 *     decl-specifier
 *     decl-specifier decl-specifier-seq
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclarationSpecifierSequence implements \Countable
{
    /**
     * The declaration specifiers.
     * @var DeclarationSpecifier[]
     */
    private $declSpecs = [];
    
    /**
     * Adds the specified declaration specifier to this sequence.
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to add.
     */
    public function addDeclarationSpecifier(DeclarationSpecifier $declSpec): void
    {
        $this->declSpecs[] = $declSpec;
    }
    
    /**
     * Returns all the declaration specifiers.
     * 
     * @return  DeclarationSpecifier[]  An indexed array of declaration specifiers.
     */
    public function getDeclarationSpecifiers(): array
    {
        return $this->declSpecs;
    }
    
    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        return \count($this->declSpecs);
    }
}

