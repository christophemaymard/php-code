<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\PtrDeclarator;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;

/**
 * Represents the constraint for a pointer declarator.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrDeclaratorConstraint extends AbstractConceptConstraint
{
    /**
     * The no-pointer declarator constraint.
     * @var NoptrDeclaratorConstraint
     */
    private $noptrDcltorConst;
    
    /**
     * Constructor.
     * 
     * @param   NoptrDeclaratorConstraint   $noptrDcltorConst   The no-pointer declarator constraint.
     */
    public function __construct(NoptrDeclaratorConstraint $noptrDcltorConst)
    {
        $this->noptrDcltorConst = $noptrDcltorConst;
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return 'pointer declarator';
    }
    
    /**
     * {@inheritDoc}
     */
    public function constraintDescription(): string
    {
        $lines = [];
        $lines[] = $this->getConceptName();
        $lines[] = $this->indent($this->noptrDcltorConst->constraintDescription());
        
        return \implode("\n", $lines);
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        return $other instanceof PtrDeclarator && 
            $this->noptrDcltorConst->matches($other->getNoptrDeclarator());
    }
    
    /**
     * {@inheritDoc}
     */
    public function failureReason($other): string
    {
        if (!$other instanceof PtrDeclarator) {
            return $this->instanceReason(PtrDeclarator::class, $other);
        } 
        
        $noptrDcltor = $other->getNoptrDeclarator();
        
        if (!$this->noptrDcltorConst->matches($noptrDcltor)) {
            return $this->conceptIndent(
                $this->noptrDcltorConst->failureReason($noptrDcltor)
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

