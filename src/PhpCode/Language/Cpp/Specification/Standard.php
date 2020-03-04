<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Specification;

/**
 * Represents all the standards.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class Standard
{
    /**
     * C++ 2003.
     * @var int
     */
    public const CPP2003 = 1;
    
    /**
     * C++ 2011.
     * @var int
     */
    public const CPP2011 = 2;
    
    /**
     * C++ 2014.
     * @var int
     */
    public const CPP2014 = 4;
    
    /**
     * C++ 2017.
     * @var int
     */
    public const CPP2017 = 8;
}

