<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\DeclaratorId;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;
use PhpCode\Test\Language\Cpp\Expression\IdExpressionConstraint;

/**
 * Represents the constraint for a declarator identifier.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclaratorIdConstraint extends AbstractConceptConstraint
{
    /**
     * The identifier expression constraint.
     * @var IdExpressionConstraint
     */
    private $idExprConst;
    
    /**
     * Constructor.
     * 
     * @param   IdExpressionConstraint  $idExprConst    The identifier expression constraint.
     */
    public function __construct(IdExpressionConstraint $idExprConst)
    {
        $this->idExprConst = $idExprConst;
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return 'declarator identifier';
    }
    
    /**
     * {@inheritDoc}
     */
    public function constraintDescription(): string
    {
        $lines = [];
        $lines[] = $this->getConceptName();
        $lines[] = $this->indent($this->idExprConst->constraintDescription());
        
        return \implode("\n", $lines);
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        return $other instanceof DeclaratorId && 
            $this->idExprConst->matches($other->getIdExpression());
    }
    
    /**
     * {@inheritDoc}
     */
    public function failureReason($other): string
    {
        if (!$other instanceof DeclaratorId) {
            return $this->instanceReason(DeclaratorId::class, $other);
        }
        
        if (!$this->idExprConst->matches($other->getIdExpression())) {
            return $this->conceptIndent(
                $this->idExprConst->failureReason($other->getIdExpression())
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

