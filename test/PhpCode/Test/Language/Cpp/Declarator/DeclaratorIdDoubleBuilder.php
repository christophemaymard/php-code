<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\DeclaratorId;
use PhpCode\Language\Cpp\Expression\IdExpression;
use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents a double builder of the {@see PhpCode\Language\Cpp\Declarator\DeclaratorId} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclaratorIdDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return DeclaratorId::class;
    }
    
    /**
     * Builds and adds a prophecy where getIdExpression() can be called.
     * 
     * @param   IdExpression    $return The value to return when getIdExpression() is called.
     * @return  DeclaratorIdDoubleBuilder   This instance.
     */
    public function buildGetIdExpression(IdExpression $return): self
    {
        $this->getSubjectProphecy()
            ->getIdExpression()
            ->willReturn($return);
        
        return $this;
    }
}

