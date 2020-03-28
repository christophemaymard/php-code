<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParameterDeclaration;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierSequenceConstraint;

/**
 * Represents the constraint for a parameter declaration.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationConstraint extends AbstractConceptConstraint
{
    /**
     * The declaration specifier sequence constraint.
     * @var DeclarationSpecifierSequenceConstraint
     */
    private $declSpecSeqConst;
    
    /**
     * Constructor.
     * 
     * @param   DeclarationSpecifierSequenceConstraint  $declSpecSeqConst   The declaration specifier sequence constraint.
     */
    public function __construct(DeclarationSpecifierSequenceConstraint $declSpecSeqConst)
    {
        $this->declSpecSeqConst = $declSpecSeqConst;
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return 'parameter declaration';
    }
    
    /**
     * {@inheritDoc}
     */
    public function constraintDescription(): string
    {
        $lines = [];
        $lines[] = $this->getConceptName();
        $lines[] = $this->indent($this->declSpecSeqConst->constraintDescription());
        
        return \implode("\n", $lines);
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        if (!$other instanceof ParameterDeclaration) {
            return FALSE;
        }
        
        $declSpecSeq = $other->getDeclarationSpecifierSequence();
        
        if (!$this->declSpecSeqConst->matches($declSpecSeq)) {
            return FALSE;
        }
        
        return TRUE;
    }
    
    /**
     * {@inheritDoc}
     */
    public function failureReason($other): string
    {
        if (!$other instanceof ParameterDeclaration) {
            return $this->instanceReason(ParameterDeclaration::class, $other);
        } 
        
        $declSpecSeq = $other->getDeclarationSpecifierSequence();
        
        if (!$this->declSpecSeqConst->matches($declSpecSeq)) {
            return $this->conceptIndent(
                $this->declSpecSeqConst->failureReason($declSpecSeq)
            );
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

