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
 * Represents a builder of constraint double for the {@see PhpCode\Test\Language\Cpp\Expression\IdExpressionConstraint} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class IdExpressionConstraintDoubleBuilder extends AbstractConceptConstraintDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return IdExpressionConstraint::class;
    }
}

