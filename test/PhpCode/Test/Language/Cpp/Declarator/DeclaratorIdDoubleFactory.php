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
use PhpCode\Test\AbstractDoubleFactory;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Declarator\DeclaratorId} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclaratorIdDoubleFactory extends AbstractDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getClassName(): string
    {
        return DeclaratorId::class;
    }
    
    /**
     * Creates a double where getIdExpression() can be called.
     * 
     * @param   IdExpression    $return The value to return when getIdExpression() is called.
     * @return  ProphecySubjectInterface
     */
    public function createGetIdExpression(IdExpression $return): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $prophecy
            ->getIdExpression()
            ->willReturn($return);
        
        return $prophecy->reveal();
    }
}

