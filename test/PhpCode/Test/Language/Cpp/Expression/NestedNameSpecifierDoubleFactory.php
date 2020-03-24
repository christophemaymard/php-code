<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\NestedNameSpecifier;
use PhpCode\Test\AbstractDoubleFactory;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Expression\NestedNameSpecifier} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NestedNameSpecifierDoubleFactory extends AbstractDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return NestedNameSpecifier::class;
    }
}

