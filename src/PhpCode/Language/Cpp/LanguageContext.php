<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp;

use PhpCode\Language\Cpp\Lexical\TokenTableInterface;

/**
 * Represents the language context.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class LanguageContext implements LanguageContextInterface
{
    /**
     * The table of keyword tokens.
     * @var TokenTableInterface
     */
    private $keywords;
    
    /**
     * Constructor.
     * 
     * @param   TokenTableInterface $keywords   The table of keyword tokens.
     */
    public function __construct(TokenTableInterface $keywords)
    {
        $this->keywords = $keywords;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getKeywords(): TokenTableInterface
    {
        return $this->keywords;
    }
}

