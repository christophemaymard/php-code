<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Lexical\Identifier;

/**
 * Represents a nested name specifier.
 * 
 * nested-name-specifier:
 *     identifier ::
 *     nested-name-specifier identifier ::
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NestedNameSpecifier implements \Countable
{
    /**
     * The name specifiers.
     * @var Identifier[]
     */
    private $nameSpecs = [];
    
    /**
     * Adds the specified identifier to the name specifiers.
     * 
     * @param   Identifier  $name   The identifier to add.
     */
    public function addNameSpecifier(Identifier $name): void
    {
        $this->nameSpecs[] = $name;
    }
    
    /**
     * Returns all the name specifiers.
     * 
     * @return  Identifier[]    An indexed array of identifiers.
     */
    public function getNameSpecifiers(): array
    {
        return $this->nameSpecs;
    }
    
    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        return \count($this->nameSpecs);
    }
}

