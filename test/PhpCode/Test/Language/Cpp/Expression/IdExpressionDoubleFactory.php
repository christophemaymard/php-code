<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\IdExpression;
use PhpCode\Language\Cpp\Expression\UnqualifiedId;
use PhpCode\Test\AbstractDoubleFactory;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Expression\IdExpression} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class IdExpressionDoubleFactory extends AbstractDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getClassName(): string
    {
        return IdExpression::class;
    }
    
    /**
     * Creates a double where getUnqualifiedId() can be called.
     * 
     * @param   UnqualifiedId   $return The value to return when getUnqualifiedId() is called (optional)(default to NULL).
     * @return  ProphecySubjectInterface
     */
    public function createGetUnqualifiedId(UnqualifiedId $return = NULL): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $prophecy
            ->getUnqualifiedId()
            ->willReturn($return);
        
        return $prophecy->reveal();
    }
}

