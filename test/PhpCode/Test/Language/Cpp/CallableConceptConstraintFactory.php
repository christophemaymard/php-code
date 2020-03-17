<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp;

/**
 * Represents a factory of concept constraints that uses a callable to create 
 * a constraint.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class CallableConceptConstraintFactory implements ConceptConstraintFactoryInterface
{
    /**
     * The callable used to create a constraint.
     * @var callable
     */
    private $callable;
    
    /**
     * Constructor.
     * 
     * @param   callable    $callable   The callable used to create a constraint.
     */
    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }
    
    /**
     * {@inheritDoc}
     */
    public function createConstraint()
    {
        return ($this->callable)();
    }
}

