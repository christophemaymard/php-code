<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp;

/**
 * Represents the interface for a factory of concept constraints.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface ConceptConstraintFactoryInterface
{
    /**
     * Creates a concept constraint.
     * 
     * @return  object  The created instance of the concept constraint.
     */
    public function createConstraint();
}

