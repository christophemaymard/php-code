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
 *     ( parameter-declaration-clause ) cv-qualifier-seq[opt]
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
     * The constant/volatile qualifier sequence.
     * @var CVQualifierSequence|NULL
     */
    private $cvSeq;
    
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
    
    /**
     * Returns the constant/volatile qualifier sequence.
     * 
     * @return  CVQualifierSequence|NULL    The instance of constant/volatile qualifier sequence if it has been set, otherwise NULL.
     */
    public function getCVQualifierSequence(): ? CVQualifierSequence
    {
        return $this->cvSeq;
    }
    
    /**
     * Sets the constant/volatile qualifier sequence.
     * 
     * @param   CVQualifierSequence $cvSeq  The constant/volatile qualifier sequence to set.
     */
    public function setCVQualifierSequence(CVQualifierSequence $cvSeq): void
    {
        $this->cvSeq = $cvSeq;
    }
    
    /**
     * Indicates whether these parameters and qualifiers has a 
     * constant/volatile qualifier sequence.
     * 
     * @return  bool    TRUE if these parameters and qualifiers has a constant/volatile qualifier sequence, otherwise FALSE.
     */
    public function hasCVQualifierSequence(): bool
    {
        return $this->cvSeq !== NULL;
    }
}

