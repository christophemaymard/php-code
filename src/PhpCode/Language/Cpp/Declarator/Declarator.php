<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Declarator;

/**
 * Represents a declarator.
 * 
 * declarator:
 *     ptr-declarator
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class Declarator
{
    /**
     * The pointer declarator.
     * @var PtrDeclarator|NULL
     */
    private $ptrDcltor;
    
    /**
     * Creates an instance of a declarator defined with a pointer declarator.
     * 
     * @param   PtrDeclarator   $ptrDcltor  The pointer declarator to use.
     * @return  Declarator  The created instance of Declarator.
     */
    public static function createPtrDeclarator(PtrDeclarator $ptrDcltor): self
    {
        $dcltor = new self();
        $dcltor->ptrDcltor = $ptrDcltor;
        
        return $dcltor;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * Returns the pointer declarator.
     * 
     * @return  PtrDeclarator|NULL  The instance of the pointer declarator if this declarator has been defined with a pointer declarator, otherwise NULL.
     */
    public function getPtrDeclarator(): ?PtrDeclarator
    {
        return $this->ptrDcltor;
    }
}

