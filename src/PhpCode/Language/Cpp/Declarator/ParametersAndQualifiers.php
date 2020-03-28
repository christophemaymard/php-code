<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Declarator;

/**
 * Represents parameters and qualifiers.
 * 
 * parameters-and-qualifiers:
 *     ( parameter-declaration-clause )
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParametersAndQualifiers
{
    /**
     * The parameter declaration clause.
     * @var ParameterDeclarationClause
     */
    private $prmDeclClause;
    
    /**
     * Constructor.
     * 
     * @param   ParameterDeclarationClause  $prmDeclClause  The parameter declaration clause.
     */
    public function __construct(ParameterDeclarationClause $prmDeclClause)
    {
        $this->prmDeclClause = $prmDeclClause;
    }
    
    /**
     * Returns the parameter declaration clause.
     * 
     * @return  ParameterDeclarationClause
     */
    public function getParameterDeclarationClause(): ParameterDeclarationClause
    {
        return $this->prmDeclClause;
    }
}

