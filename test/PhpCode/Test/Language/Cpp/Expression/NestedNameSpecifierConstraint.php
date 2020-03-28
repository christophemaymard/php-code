<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\NestedNameSpecifier;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;
use PhpCode\Test\Language\Cpp\Lexical\IdentifierConstraint;

/**
 * Represents the constraint for a nested name specifier.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NestedNameSpecifierConstraint extends AbstractConceptConstraint
{
    /**
     * The name specifier constraints.
     * @var IdentifierConstraint[]
     */
    private $nameSpecConsts = [];
    
    /**
     * Adds the specified identifier constraint to the name specifier 
     * constraints.
     * 
     * @param   IdentifierConstraint    $constraint The identifier constraint to add.
     */
    public function addNameSpecifierConstraint(IdentifierConstraint $constraint): void
    {
        $this->nameSpecConsts[] = $constraint;
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return 'nested name specifier';
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
            \count($this->nameSpecConsts)
        );
        
        foreach ($this->nameSpecConsts as $constraint) {
            $lines[] = $this->indent($constraint->constraintDescription());
        }
        
        return \implode("\n", $lines);
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        if (!$other instanceof NestedNameSpecifier) {
            return FALSE;
        }
        
        if (\count($other) != \count($this->nameSpecConsts)) {
            return FALSE;
        }
        
        foreach ($other->getNameSpecifiers() as $idx => $nameSpec) {
            if (!$this->nameSpecConsts[$idx]->matches($nameSpec)) {
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
        if (!$other instanceof NestedNameSpecifier) {
            return $this->instanceReason(NestedNameSpecifier::class, $other);
        }
        
        $nameSpecConstCount = \count($this->nameSpecConsts);
        $otherCount = \count($other);
        
        if ($otherCount != $nameSpecConstCount) {
            return $this->countReason(
                $nameSpecConstCount, 
                $otherCount, 
                'name specifier(s)'
            );
        }
        
        foreach ($other->getNameSpecifiers() as $idx => $nameSpec) {
            if (!$this->nameSpecConsts[$idx]->matches($nameSpec)) {
                return $this->conceptIndent(
                    $this->nameSpecConsts[$idx]->failureReason($nameSpec)
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

