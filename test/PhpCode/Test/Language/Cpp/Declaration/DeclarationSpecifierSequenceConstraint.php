<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declaration;

use PhpCode\Exception\ArgumentException;
use PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;

/**
 * Represents the constraint for a declaration specifier sequence.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclarationSpecifierSequenceConstraint extends AbstractConceptConstraint
{
    /**
     * The declaration specifier constraints.
     * @var DeclarationSpecifierConstraint[]
     */
    private $declSpecConsts = [];
    
    /**
     * The number of declaration specifier constraints.
     * @var int
     */
    private $declSpecCount;
    
    /**
     * Creates a constraint for a declaration specifier sequence.
     * 
     * @param   DeclarationSpecifierConstraint[]    $declSpecConsts The declaration specifier constraints.
     * @return  DeclarationSpecifierSequenceConstraint  The created instance of declaration specifier sequence constraint.
     */
    public static function create(array $declSpecConsts): self
    {
        $const = new self();
        $const->setDeclarationSpecifierConstraints($declSpecConsts);
        
        return $const;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * Sets the declaration specifier constraints.
     * 
     * @param   DeclarationSpecifierConstraint[]    $constraints    The declaration specifier constraints to set.
     * 
     * @throws  ArgumentException   When the declaration specifier constraints are empty.
     * @throws  ArgumentException   When a constraint is not an instance of DeclarationSpecifierConstraint.
     */
    private function setDeclarationSpecifierConstraints(array $constraints): void
    {
        $this->declSpecCount = \count($constraints);
        
        if ($this->declSpecCount == 0) {
            throw new ArgumentException('The declaration specifier constraints are empty.');
        }
        
        foreach ($constraints as $constraint) {
            if (!$constraint instanceof DeclarationSpecifierConstraint) {
                throw new ArgumentException(\sprintf(
                    'The constraint must be an instance of %s.', 
                    DeclarationSpecifierConstraint::class
                ));
            }
        }
        
        $this->declSpecConsts = \array_values($constraints);
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return 'declaration specifier sequence';
    }
    
    /**
     * {@inheritDoc}
     */
    public function constraintDescription(): string
    {
        $lines = [];
        $lines[] = \sprintf(
            '%s (%s)', 
            $this->getConceptName(), 
            $this->declSpecCount
        );
        
        foreach ($this->declSpecConsts as $constraint) {
            $lines[] = $this->indent($constraint->constraintDescription());
        }
        
        return \implode("\n", $lines);
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        if (!$other instanceof DeclarationSpecifierSequence) {
            return FALSE;
        }
        
        if (\count($other) !== $this->declSpecCount) {
            return FALSE;
        }
        
        foreach ($other->getDeclarationSpecifiers() as $idx => $declSpec) {
            if (!$this->declSpecConsts[$idx]->matches($declSpec)) {
                return FALSE;
            }
        }
        
        return TRUE;
    }
    
    /**
     * {@inheritDoc}
     */
    public function failureReason($other): string
    {
        if (!$other instanceof DeclarationSpecifierSequence) {
            return $this->instanceReason(DeclarationSpecifierSequence::class, $other);
        } 
        
        if (\count($other) !== $this->declSpecCount) {
            return $this->countReason(
                $this->declSpecCount, 
                \count($other), 
                'declaration specifier(s)'
            );
        }
        
        foreach ($other->getDeclarationSpecifiers() as $idx => $declSpec) {
            if (!$this->declSpecConsts[$idx]->matches($declSpec)) {
                return $this->conceptIndent(
                    $this->declSpecConsts[$idx]->failureReason($declSpec)
                );
            }
        }
        
        return $this->failureDefaultReason($other);
    }
    
    /**
     * {@inheritDoc}
     */
    protected function failureDescription($other): string
    {
        return \sprintf(
            '%s is a %s', 
            $this->exporter()->shortenedExport($other), 
            $this->toString()
        );
    }
}

