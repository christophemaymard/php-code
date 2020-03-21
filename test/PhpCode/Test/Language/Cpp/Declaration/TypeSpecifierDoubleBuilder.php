<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\SimpleTypeSpecifier;
use PhpCode\Language\Cpp\Declaration\TypeSpecifier;
use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents a double builder of the {@see PhpCode\Language\Cpp\Declaration\TypeSpecifier} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TypeSpecifierDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getClassInterfaceName(): string
    {
        return TypeSpecifier::class;
    }
    
    /**
     * Builds a prophecy where getSimpleTypeSpecifier() can be called.
     * 
     * @param   SimpleTypeSpecifier $return The value to return when getSimpleTypeSpecifier() is called.
     * @return  TypeSpecifierDoubleBuilder  This instance.
     */
    public function buildGetSimpleTypeSpecifier(SimpleTypeSpecifier $return): self
    {
        $this->getProphecy()
            ->getSimpleTypeSpecifier()
            ->willReturn($return);
        
        return $this;
    }
}

