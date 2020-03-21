<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\DefiningTypeSpecifier;
use PhpCode\Language\Cpp\Declaration\TypeSpecifier;
use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents a double builder of the {@see PhpCode\Language\Cpp\Declaration\DefiningTypeSpecifier} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DefiningTypeSpecifierDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getClassInterfaceName(): string
    {
        return DefiningTypeSpecifier::class;
    }
    
    /**
     * Builds a prophecy where getTypeSpecifier() can be called.
     * 
     * @param   TypeSpecifier   $return The value to return when getTypeSpecifier() is called.
     * @return  DefiningTypeSpecifierDoubleBuilder  This instance.
     */
    public function buildGetTypeSpecifier(TypeSpecifier $return): self
    {
        $this->getProphecy()
            ->getTypeSpecifier()
            ->willReturn($return);
        
        return $this;
    }
}

