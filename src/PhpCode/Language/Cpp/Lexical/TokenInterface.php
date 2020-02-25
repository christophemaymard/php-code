<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Lexical;

/**
 * Represents the interface for a token.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface TokenInterface
{
    /**
     * Returns the lexeme of this token.
     * 
     * @return  string
     */
    public function getLexeme(): string;
    
    /**
     * Returns the tag of this token.
     * 
     * @return  int
     */
    public function getTag(): int;
}

