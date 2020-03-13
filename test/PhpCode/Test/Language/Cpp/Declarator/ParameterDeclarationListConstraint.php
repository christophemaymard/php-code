<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Exception\ArgumentException;
use PhpCode\Language\Cpp\Declarator\ParameterDeclarationList;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;

/**
 * Represents the constraint for a parameter declaration list.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationListConstraint extends AbstractConceptConstraint
{
    /**
     * The parameter declaration constraints.
     * @var ParameterDeclarationConstraint[]
     */
    private $prmDeclConsts = [];
    
    /**
     * The number of parameter declaration constraints.
     * @var int
     */
    private $prmDeclCount;
    
    /**
     * Constructor.
     * 
     * @param   ParameterDeclarationConstraint[]    $prmDeclConsts  The parameter declaration constraints.
     */
    public function __construct(array $prmDeclConsts)
    {
        $this->setParameterDeclarationConstraints($prmDeclConsts);
    }
    
    /**
     * Sets the parameter declaration constraints.
     * 
     * @param   ParameterDeclarationConstraint[]    $prmDeclConsts  The parameter declaration constraints to set.
     * 
     * @throws  ArgumentException   When the parameter declaration constraints are empty.
     * @throws  ArgumentException   When a constraint is not an instance of ParameterDeclarationConstraint.
     */
    private function setParameterDeclarationConstraints(array $prmDeclConsts): void
    {
        $this->prmDeclCount = \count($prmDeclConsts);
        
        if ($this->prmDeclCount == 0) {
            throw new ArgumentException('The parameter declaration constraints are empty.');
        }
        
        foreach ($prmDeclConsts as $constraint) {
            if (!$constraint instanceof ParameterDeclarationConstraint) {
                throw new ArgumentException(\sprintf(
                    'The constraint must be an instance of %s.', 
                    ParameterDeclarationConstraint::class
                ));
            }
        }
        
        $this->prmDeclConsts = \array_values($prmDeclConsts);
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return 'parameter declaration list';
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
            $this->prmDeclCount
        );
        
        foreach ($this->prmDeclConsts as $constraint) {
            $lines[] = $this->indent($constraint->constraintDescription());
        }
        
        return \implode("\n", $lines);
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        if (!$other instanceof ParameterDeclarationList) {
            return FALSE;
        }
        
        if (\count($other) !== $this->prmDeclCount) {
            return FALSE;
        }
        
        foreach ($other->getParameterDeclarations() as $idx => $prmDecl) {
            if (!$this->prmDeclConsts[$idx]->matches($prmDecl)) {
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
        if (!$other instanceof ParameterDeclarationList) {
            return $this->instanceReason(ParameterDeclarationList::class, $other);
        } 
        
        if (\count($other) !== $this->prmDeclCount) {
            return $this->countReason(
                $this->prmDeclCount, 
                \count($other), 
                'parameter declaration(s)'
            );
        }
        
        foreach ($other->getParameterDeclarations() as $idx => $prmDecl) {
            if (!$this->prmDeclConsts[$idx]->matches($prmDecl)) {
                return $this->conceptIndent(
                    $this->prmDeclConsts[$idx]->failureReason($prmDecl)
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

