<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Lexical;

/**
 * Represents the lexical analyzer used to produce tokens from a stream.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class Lexer implements LexerInterface
{
    /**
     * {@inheritDoc}
     */
    public function getToken(): TokenInterface
    {
        // End of File token.
        return new Token('', Tag::EOF);
    }
}

