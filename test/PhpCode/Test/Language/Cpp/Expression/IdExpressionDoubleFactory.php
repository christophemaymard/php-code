<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\IdExpression;
use PhpCode\Language\Cpp\Expression\QualifiedId;
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
    protected function getSubjectName(): string
    {
        return IdExpression::class;
    }
    
    /**
     * Creates a double where the identifier expression is defined as an 
     * unqualified identifier.
     * 
     * @param   UnqualifiedId   $return The value to return when getUnqualifiedId() is called.
     * @return  ProphecySubjectInterface
     */
    public function createUnqualifiedId(UnqualifiedId $return): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        $prophecy
            ->getUnqualifiedId()
            ->willReturn($return);
        $prophecy
            ->getQualifiedId()
            ->willReturn(NULL);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where the identifier expression is defined as a 
     * qualified identifier.
     * 
     * @param   QualifiedId $return The value to return when getQualifiedId() is called.
     * @return  ProphecySubjectInterface
     */
    public function createQualifiedId(QualifiedId $return): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        $prophecy
            ->getUnqualifiedId()
            ->willReturn(NULL);
        $prophecy
            ->getQualifiedId()
            ->willReturn($return);
        
        return $prophecy->reveal();
    }
}

