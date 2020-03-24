<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\QualifiedId;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;

/**
 * Represents the constraint for a qualified identifier.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class QualifiedIdConstraint extends AbstractConceptConstraint
{
    /**
     * The nested name specifier constraint.
     * @var NestedNameSpecifierConstraint
     */
    private $nnSpecConst;
    
    /**
     * The unqualified identifier constraint.
     * @var UnqualifiedIdConstraint
     */
    private $uidConst;
    
    /**
     * Constructor.
     * 
     * @param   NestedNameSpecifierConstraint   $nnSpecConst    The nested name specifier constraint.
     * @param   UnqualifiedIdConstraint         $uidConst       The unqualified identifier constraint.
     */
    public function __construct(
        NestedNameSpecifierConstraint $nnSpecConst, 
        UnqualifiedIdConstraint $uidConst
    )
    {
        $this->nnSpecConst = $nnSpecConst;
        $this->uidConst = $uidConst;
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return 'qualified identifier';
    }
    
    /**
     * {@inheritDoc}
     */
    public function constraintDescription(): string
    {
        $lines = [];
        $lines[] = $this->getConceptName();
        $lines[] = $this->indent($this->nnSpecConst->constraintDescription());
        $lines[] = $this->indent($this->uidConst->constraintDescription());
        
        return \implode("\n", $lines);
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        if (!$other instanceof QualifiedId) {
            return FALSE;
        }
        
        if (!$this->nnSpecConst->matches($other->getNestedNameSpecifier())) {
            return FALSE;
        }
        
        if (!$this->uidConst->matches($other->getUnqualifiedId())) {
            return FALSE;
        }
        
        return TRUE;
    }
    
    /**
     * {@inheritDoc}
     */
    public function failureReason($other): string
    {
        if (!$other instanceof QualifiedId) {
            return $this->instanceReason(QualifiedId::class, $other);
        }
        
        if (!$this->nnSpecConst->matches($other->getNestedNameSpecifier())) {
            return $this->conceptIndent(
                $this->nnSpecConst->failureReason($other->getNestedNameSpecifier())
            );
        }
        
        if (!$this->uidConst->matches($other->getUnqualifiedId())) {
            return $this->conceptIndent(
                $this->uidConst->failureReason($other->getUnqualifiedId())
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

