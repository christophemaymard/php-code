<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Lexical;

use PhpCode\Exception\InvalidOperationException;

/**
 * Represents the interface for a table of tokens.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface TokenTableInterface extends \Countable
{
    /**
     * Returns the tag of the token with the specified lexeme.
     * 
     * @param   string  $lexeme The lexeme of the token.
     * @return  int The tag of the token.
     * 
     * @throws  InvalidOperationException   When there is no token with the specified lexeme.
     */
    public function getTag(string $lexeme): int;
    
    /**
     * Indicates whether a token with the specified lexeme is present.
     * 
     * @param   string  $lexeme The lexeme of the token.
     * @return  bool    TRUE if a token with the specified lexeme is present, otherwise FALSE.
     */
    public function hasToken(string $lexeme): bool;
    
    /**
     * Returns all the different lengths of the token lexemes.
     * 
     * @return  int[]   An indexed array of the lengths (in reverse order).
     */
    public function getLengths(): array;
}

