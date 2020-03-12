<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp;

use PhpCode\PHPUnit\Framework\Constraint\Constraint;

/**
 * Represents the base class a concept constraint.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractConceptConstraint extends Constraint
{
    /**
     * Returns the name of the concept.
     * 
     * @return  string
     */
    public function getConceptName(): string
    {
        return \ucfirst($this->toString());
    }
    
    /**
     * {@inheritDoc}
     */
    public function failureDefaultReason($other): string
    {
        return \sprintf('%s: Unknown reason.', $this->getConceptName());
    }
    
    /**
     * Formats the reason, like:
     * "CONCEPT: OTHER is not an instance of CLASS_OR_INTERFACE."
     * 
     * @param   string  $classOrInterface   The expected class or interface name.
     * @param   mixed   $other              The evaluated value or object.
     * @return  string
     */
    protected function instanceReason(string $classOrInterface, $other): string
    {
        return \sprintf(
            '%s: %s is not an instance of %s.', 
            $this->getConceptName(), 
            $this->exporter()->shortenedExport($other), 
            $classOrInterface
        );
    }
    
    /**
     * Formats the reason, like:
     * "CONCEPT: "ACTUAL" does not match [SUBJECT] "EXPECTED"."
     * 
     * @param   string  $expected   The expected string.
     * @param   string  $actual     The actual string.
     * @param   string  $subject    The subject. Does not appear when it is an empty string (optional)(default to empty string).
     * @return  string
     */
    protected function matchStringReason(
        string $expected, 
        string $actual, 
        string $subject = ''
    ): string
    {
        return \sprintf(
            '%s: "%s" does not match%s "%s".', 
            $this->getConceptName(), 
            $actual, 
            $subject === '' ? '' : ' '.$subject,
            $expected
        );
    }
}

