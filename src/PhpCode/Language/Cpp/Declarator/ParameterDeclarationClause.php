<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Declarator;

/**
 * Represents a parameter declaration clause.
 * 
 * parameter-declaration-clause:
 *     parameter-declaration-list[opt] ...[opt]
 *     parameter-declaration-list , ...
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationClause
{
    /**
     * The parameter declaration list.
     * @var ParameterDeclarationList|NULL
     */
    private $prmDeclList;
    
    /**
     * The ellipsis flag (default to FALSE).
     * @var bool
     */
    private $ellipsis = FALSE;
    
    /**
     * Adds an ellipsis.
     */
    public function addEllipsis(): void
    {
        $this->ellipsis = TRUE;
    }
    
    /**
     * Indicates whether this parameter declaration clause has an ellipsis.
     * 
     * @return  bool    TRUE if this parameter declaration clause has an ellipsis, otherwise FALSE.
     */
    public function hasEllipsis(): bool
    {
        return $this->ellipsis;
    }
    
    /**
     * Returns the parameter declaration list.
     * 
     * @return  ParameterDeclarationList|NULL   The instance of parameter declaration list if it has been set, otherwise NULL.
     */
    public function getParameterDeclarationList(): ?ParameterDeclarationList
    {
        return $this->prmDeclList;
    }
    
    /**
     * Sets the parameter declaration list.
     * 
     * @param   ParameterDeclarationList    $prmDeclList    The parameter declaration list to set.
     */
    public function setParameterDeclarationList(ParameterDeclarationList $prmDeclList): void
    {
        $this->prmDeclList = $prmDeclList;
    }
    
    /**
     * Indicates whether this parameter declaration clause has a parameter 
     * declaration list.
     * 
     * @return  bool    TRUE if this parameter declaration clause has a parameter declaration list, otherwise FALSE.
     */
    public function hasParameterDeclarationList(): bool
    {
        return $this->prmDeclList !== NULL;
    }
}

