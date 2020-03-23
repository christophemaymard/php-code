<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParameterDeclarationClause;
use PhpCode\Language\Cpp\Declarator\ParameterDeclarationList;
use PhpCode\Test\AbstractDoubleFactory;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Declarator\ParameterDeclarationClause} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationClauseDoubleFactory extends AbstractDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return ParameterDeclarationClause::class;
    }
    
    /**
     * Creates a double where getParameterDeclarationList() can be called.
     * 
     * @param   ParameterDeclarationList    $return The value to return when getParameterDeclarationList() is called.
     * @return  ProphecySubjectInterface
     */
    public function createGetParameterDeclarationList(
        ParameterDeclarationList $return
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        $prophecy
            ->getParameterDeclarationList()
            ->willReturn($return);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where getParameterDeclarationList() and hasEllipsis() 
     * can be called.
     * 
     * @param   bool                        $hasEllipsis    The value to return when hasEllipsis() is called.
     * @param   ParameterDeclarationList    $getPrmDeclList The value to return when getParameterDeclarationList() is called (optional)(default to NULL).
     * @return  ProphecySubjectInterface
     */
    public function createHasEllipsisGetParameterDeclarationList(
        bool $hasEllipsis, 
        ParameterDeclarationList $getPrmDeclList = NULL
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        $prophecy
            ->getParameterDeclarationList()
            ->willReturn($getPrmDeclList);
        
        $prophecy
            ->hasEllipsis()
            ->willReturn($hasEllipsis);
        
        return $prophecy->reveal();
    }
}

