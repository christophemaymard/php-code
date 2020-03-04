<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Specification;

use PhpCode\Language\Cpp\Lexical\TokenTableInterface;

/**
 * Represents the interface for a language context.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface LanguageContextInterface
{
    /**
     * Returns the table of keyword tokens.
     * 
     * @return  TokenTableInterface
     */
    public function getKeywords(): TokenTableInterface;
    
    /**
     * Returns the table of punctuator tokens.
     * 
     * @return  TokenTableInterface
     */
    public function getPunctuators(): TokenTableInterface;
}

