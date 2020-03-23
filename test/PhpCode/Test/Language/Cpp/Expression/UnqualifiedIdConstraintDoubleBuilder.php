<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Expression;

use PhpCode\Test\Language\Cpp\AbstractConceptConstraintDoubleBuilder;

/**
 * Represents a double constraint builder of the {@see PhpCode\Test\Language\Cpp\Expression\UnqualifiedIdConstraint} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class UnqualifiedIdConstraintDoubleBuilder extends AbstractConceptConstraintDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return UnqualifiedIdConstraint::class;
    }
}

