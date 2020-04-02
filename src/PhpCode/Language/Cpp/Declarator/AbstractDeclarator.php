<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Declarator;

/**
 * Represents an abstract declarator.
 * 
 * abstract-declarator:
 *     ptr-abstract-declarator
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AbstractDeclarator
{
    /**
     * The pointer abstract declarator.
     * @var PtrAbstractDeclarator
     */
    private $ptrAbstDcltor;
    
    /**
     * Creates an instance of an abstract declarator defined as a pointer 
     * abstract declarator.
     * 
     * @param   PtrAbstractDeclarator   $ptrAbstDcltor  The pointer abstract declarator.
     * @return  AbstractDeclarator  The created instance of abstract declarator.
     */
    public static function createPtrAbstractDeclarator(
        PtrAbstractDeclarator $ptrAbstDcltor
    ): self
    {
        $abstDcltor = new self();
        $abstDcltor->ptrAbstDcltor = $ptrAbstDcltor;
        
        return $abstDcltor;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * Returns the pointer abstract declarator.
     * 
     * @return  PtrAbstractDeclarator
     */
    public function getPtrAbstractDeclarator(): PtrAbstractDeclarator
    {
        return $this->ptrAbstDcltor;
    }
}

