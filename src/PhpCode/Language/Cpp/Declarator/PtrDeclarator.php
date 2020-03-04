<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Declarator;

/**
 * Represents a pointer declarator.
 * 
 * ptr-declarator:
 *     noptr-declarator
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrDeclarator
{
    /**
     * The no-pointer declarator.
     * @var NoptrDeclarator
     */
    private $noptr;
    
    /**
     * Constructor.
     * 
     * @param   NoptrDeclarator $noptr  The no-pointer declarator.
     */
    public function __construct(NoptrDeclarator $noptr)
    {
        $this->noptr = $noptr;
    }
    
    /**
     * Returns the no-pointer declarator.
     * 
     * @return  NoptrDeclarator
     */
    public function getNoptrDeclarator(): NoptrDeclarator
    {
        return $this->noptr;
    }
}

