<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\NoptrDeclarator;
use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents a double builder of the {@see PhpCode\Language\Cpp\Declarator\NoptrDeclarator} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NoptrDeclaratorDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getClassInterfaceName(): string
    {
        return NoptrDeclarator::class;
    }
}

