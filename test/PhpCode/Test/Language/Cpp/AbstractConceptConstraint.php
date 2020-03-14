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
    
    /**
     * Formats the reason, like:
     * "CONCEPT: Unexpected SUBJECT."
     * 
     * @param   string  $subject    The subject.
     * @return  string
     */
    protected function unexpectedReason(string $subject): string
    {
        return \sprintf(
            '%s: Unexpected %s.', 
            $this->getConceptName(), 
            $subject
        );
    }
    
    /**
     * Formats the reason, like:
     * "CONCEPT: SUBJECT present|absent whereas it should be present|absent."
     * 
     * @param   bool    $expected   TRUE means that it should be present, otherwise it should be absent.
     * @param   string  $subject    The subject.
     * @return  string
     */
    protected function hasReason(bool $expected, string $subject): string
    {
        return \sprintf(
            '%s: %s %s whereas it should be %s.', 
            $this->getConceptName(), 
            $subject, 
            !$expected ? 'present' : 'absent',
            $expected ? 'present' : 'absent'
        );
    }
    
    /**
     * Formats the reason, like:
     * "CONCEPT: It should [not] be SUBJECT."
     * 
     * @param   bool    $expected   TRUE means that it should be, otherwise it should not be (not appears).
     * @param   string  $subject    The subject.
     * @return  string
     */
    protected function isReason(bool $expected, string $subject): string
    {
        return \sprintf(
            '%s: It should%s be %s.', 
            $this->getConceptName(), 
            !$expected ? ' not' : '', 
            $subject
        );
    }
    
    /**
     * Formats the reason, like:
     * "CONCEPT: CONCEPT_TO_STRING should have EXPECTED SUBJECT, got ACTUAL."
     * 
     * @param   int     $expected   The expected count.
     * @param   int     $actual     The actual count.
     * @param   string  $subject    The name of an element (plural).
     * @return  string
     */
    protected function countReason(
        int $expected, 
        int $actual, 
        string $subject
    ): string
    {
        return \sprintf(
            '%s: %s should have %s %s, got %s.', 
            $this->getConceptName(), 
            $this->toString(), 
            $expected, 
            $subject, 
            $actual
        );
    }
    
    /**
     * Returns a text with name of the concept (in the first line) followed 
     * by the specified text (that is indented).
     * 
     * @param   string  $text   The text to indent.
     * @return  string
     */
    protected function conceptIndent(string $text): string
    {
        return \sprintf(
            "%s\n%s", 
            $this->getConceptName(), 
            $this->indent($text)
        );
    }
    
    /**
     * Prepends two spaces to each lines of the specified text.
     * 
     * @param   string  $text   The text to indent.
     * @return  string
     */
    protected function indent(string $text): string
    {
        $lines = [];
        
        foreach (\explode("\n", $text) as $line) {
            $lines[] = '  '.$line;
        }
        
        return \implode("\n", $lines);
    }
}

