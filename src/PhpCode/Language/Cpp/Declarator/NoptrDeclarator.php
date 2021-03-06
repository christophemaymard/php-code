<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Declarator;

/**
 * Represents a no-pointer declarator.
 * 
 * noptr-declarator:
 *     declarator-id
 *     noptr-declarator parameters-and-qualifiers
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NoptrDeclarator
{
    /**
     * The declarator identifier.
     * @var DeclaratorId
     */
    private $did;
    
    /**
     * The parameters and qualifiers.
     * @var ParametersAndQualifiers|NULL
     */
    private $prmQual;
    
    /**
     * Creates an instance of a no-pointer declarator defined as a declarator 
     * identifier.
     * 
     * @param   DeclaratorId    $did    The declarator identifier.
     * @return  NoptrDeclarator The created instance of no-pointer declarator.
     */
    public static function createDeclaratorId(DeclaratorId $did): self
    {
        $dcltor = new self();
        $dcltor->did = $did;
        
        return $dcltor;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * Returns the declarator identifier.
     * 
     * @return  DeclaratorId
     */
    public function getDeclaratorId(): DeclaratorId
    {
        return $this->did;
    }
    
    /**
     * Returns the parameters and qualifiers.
     * 
     * @return  ParametersAndQualifiers|NULL    The instance of parameters and qualifiers if it has been set, otherwise NULL.
     */
    public function getParametersAndQualifiers(): ?ParametersAndQualifiers
    {
        return $this->prmQual;
    }
    
    /**
     * Sets the parameters and the qualifiers.
     * 
     * @param   ParametersAndQualifiers The parameters and the qualifiers to set.
     */
    public function setParametersAndQualifiers(ParametersAndQualifiers $prmQual): void
    {
        $this->prmQual = $prmQual;
    }
    
    /**
     * Indicates whether this no-pointer declarator has parameters and 
     * qualifiers.
     * 
     * @return  TRUE if this no-pointer declarator has parameters and qualifiers, otherwise FALSE. 
     */
    public function hasParametersAndQualifiers(): bool
    {
        return $this->prmQual !== NULL;
    }
}

