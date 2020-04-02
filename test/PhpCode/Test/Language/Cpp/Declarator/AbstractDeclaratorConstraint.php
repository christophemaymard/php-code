<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\AbstractDeclarator;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;

/**
 * Represents the constraint for an abstract declarator.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AbstractDeclaratorConstraint extends AbstractConceptConstraint
{
    /**
     * The constant/volatile qualifier sequence constraint.
     * @var PtrAbstractDeclaratorConstraint|NULL
     */
    private $ptrAbstDcltorConst;
    
    /**
     * Creates a constraint for an abstract declarator that is defined as a 
     * pointer abstract declarator.
     * 
     * @param   PtrAbstractDeclaratorConstraint $ptrAbstDcltorConst The pointer abstract declarator.
     * @return  AbstractDeclaratorConstraint    The created instance of abstract declarator constraint.
     */
    public static function createPtrAbstractDeclarator(
        PtrAbstractDeclaratorConstraint $ptrAbstDcltorConst
    ): self
    {
        $const = new self();
        $const->ptrAbstDcltorConst = $ptrAbstDcltorConst;
        
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
        return 'abstract declarator';
    }
    
    /**
     * {@inheritDoc}
     */
    public function constraintDescription(): string
    {
        $lines = [];
        $lines[] = $this->getConceptName();
        $lines[] = $this->indent($this->ptrAbstDcltorConst->constraintDescription());
        
        return \implode("\n", $lines);
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        if (!$other instanceof AbstractDeclarator) {
            return FALSE;
        }
        
        return $this->ptrAbstDcltorConst->matches($other->getPtrAbstractDeclarator());
    }
    
    /**
     * {@inheritDoc}
     */
    public function failureReason($other): string
    {
        if (!$other instanceof AbstractDeclarator) {
            return $this->instanceReason(AbstractDeclarator::class, $other);
        }
        
        $ptrAbstDcltor = $other->getPtrAbstractDeclarator();
        
        if (!$this->ptrAbstDcltorConst->matches($ptrAbstDcltor)) {
            return $this->conceptIndent(
                $this->ptrAbstDcltorConst->failureReason($ptrAbstDcltor)
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
            '%s is an %s', 
            $this->exporter()->shortenedExport($other), 
            $this->toString()
        );
    }
}

