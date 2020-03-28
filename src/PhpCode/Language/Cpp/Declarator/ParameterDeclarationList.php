<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Declarator;

/**
 * Represents a parameter declaration list.
 * 
 * parameter-declaration-list:
 *     parameter-declaration
 *     parameter-declaration-list , parameter-declaration
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationList implements \Countable
{
    /**
     * The parameter declarations.
     * @var ParameterDeclaration[]
     */
    private $prmDecls = [];
    
    /**
     * Adds the specified parameter declaration to this list.
     * 
     * @param   ParameterDeclaration    $prmDecl    The parameter declaration to add.
     */
    public function addParameterDeclaration(ParameterDeclaration $prmDecl): void
    {
        $this->prmDecls[] = $prmDecl;
    }
    
    /**
     * Returns all the parameter declarations.
     * 
     * @return  ParameterDeclaration[]  An indexed array of parameter declarations.
     */
    public function getParameterDeclarations(): array
    {
        return $this->prmDecls;
    }
    
    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        return \count($this->prmDecls);
    }
}

