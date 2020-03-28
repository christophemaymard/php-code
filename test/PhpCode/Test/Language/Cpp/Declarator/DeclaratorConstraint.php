<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\Declarator;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;

/**
 * Represents the constraint for a declarator.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclaratorConstraint extends AbstractConceptConstraint
{
    /**
     * The pointer declarator constraint.
     * @var PtrDeclaratorConstraint
     */
    private $ptrDcltorConst;
    
    /**
     * Creates a constraint for a declarator that is defined as a pointer 
     * declarator.
     * 
     * @param   PtrDeclaratorConstraint $ptrDcltorConst The pointer declarator constraint.
     * @return  DeclaratorConstraint    The created instance of declarator constraint.
     */
    public static function createPtrDeclarator(
        PtrDeclaratorConstraint $ptrDcltorConst
    ): self
    {
        $const = new self();
        $const->ptrDcltorConst = $ptrDcltorConst;
        
        return $const;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return 'declarator';
    }
    
    /**
     * {@inheritDoc}
     */
    public function constraintDescription(): string
    {
        $lines = [];
        $lines[] = $this->getConceptName();
        $lines[] = $this->indent($this->ptrDcltorConst->constraintDescription());
        
        return \implode("\n", $lines);
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        return $other instanceof Declarator && 
            $this->ptrDcltorConst->matches($other->getPtrDeclarator());
    }
    
    /**
     * {@inheritDoc}
     */
    public function failureReason($other): string
    {
        if (!$other instanceof Declarator) {
            return $this->instanceReason(Declarator::class, $other);
        } 
        
        $ptrDcltor = $other->getPtrDeclarator();
        
        if (!$this->ptrDcltorConst->matches($ptrDcltor)) {
            return $this->conceptIndent(
                $this->ptrDcltorConst->failureReason($ptrDcltor)
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

