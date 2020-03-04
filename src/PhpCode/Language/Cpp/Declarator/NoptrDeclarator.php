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
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NoptrDeclarator
{
    /**
     * The declarator identifier.
     * @var DeclaratorId|NULL
     */
    private $did;
    
    /**
     * Creates an instance of a no-pointer declarator defined with a declarator identifier.
     * 
     * @param   DeclaratorId    $did    The declarator identifier to use.
     * @return  NoptrDeclarator The created instance of NoptrDeclarator.
     */
    public static function createDeclaratorId(DeclaratorId $did): self
    {
        $dcltor = new self();
        $dcltor->did = $did;
        
        return $dcltor;
    }
    
    /**
     * Returns the declarator identifier.
     * 
     * @return  DeclaratorId|NULL   The instance of the declarator identifier if this no-pointer declarator has been defined with a declarator identifier, otherwise NULL.
     */
    public function getDeclaratorId(): ?DeclaratorId
    {
        return $this->did;
    }
}

