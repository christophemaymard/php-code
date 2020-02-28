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
     * The table of punctuator tokens.
     * @var TokenTableInterface
     */
    private $punctuators;
    
    /**
     * Constructor.
     * 
     * @param   TokenTableInterface $keywords       The table of keyword tokens.
     * @param   TokenTableInterface $punctuators    The table of punctuator tokens.
     */
    public function __construct(TokenTableInterface $keywords, TokenTableInterface $punctuators)
    {
        $this->keywords = $keywords;
        $this->punctuators = $punctuators;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getKeywords(): TokenTableInterface
    {
        return $this->keywords;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getPunctuators(): TokenTableInterface
    {
        return $this->punctuators;
    }
}

