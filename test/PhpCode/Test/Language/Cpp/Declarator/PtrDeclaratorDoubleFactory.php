<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\PtrDeclarator;
use PhpCode\Test\AbstractDoubleFactory;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Declarator\PtrDeclarator} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrDeclaratorDoubleFactory extends AbstractDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getClassName(): string
    {
        return PtrDeclarator::class;
    }
}

