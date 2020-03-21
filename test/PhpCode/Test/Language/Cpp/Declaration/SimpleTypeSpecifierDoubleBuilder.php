<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\SimpleTypeSpecifier;
use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents a double builder of the {@see PhpCode\Language\Cpp\Declaration\SimpleTypeSpecifier} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleTypeSpecifierDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getClassInterfaceName(): string
    {
        return SimpleTypeSpecifier::class;
    }
    
    /**
     * Builds a prophecy where isInt() can be called.
     * 
     * @param   bool    $return The value to return when isInt() is called.
     * @return  SimpleTypeSpecifierDoubleBuilder    This instance.
     */
    public function buildIsInt(bool $return): self
    {
        $this->getProphecy()
            ->isInt()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds a prophecy where isFloat() can be called.
     * 
     * @param   bool    $return The value to return when isFloat() is called.
     * @return  SimpleTypeSpecifierDoubleBuilder    This instance.
     */
    public function buildIsFloat(bool $return): self
    {
        $this->getProphecy()
            ->isFloat()
            ->willReturn($return);
        
        return $this;
    }
}

