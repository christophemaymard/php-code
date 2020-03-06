<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Lexical;

/**
 * Represents the interface for a lexical analyzer.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface LexerInterface
{
    /**
     * Returns the N-th next token in the stream without changing of the 
     * position in the stream.
     * 
     * If the end of the stream is reached, it always returns a token with 
     * the {@see PhpCode\Language\Cpp\Lexical\Tag::EOF} tag.
     * 
     * @param   int $n  The number (if it is 1 or less then the next token will be returned; if it is 2 then the token next of the next token will be returned, and so on).
     * @return  TokenInterface
     */
    public function lookAhead(int $n): TokenInterface;
    
    /**
     * Returns the next token in the stream.
     * 
     * If the end of the stream is reached, it always returns a token with 
     * the {@see PhpCode\Language\Cpp\Lexical\Tag::EOF} tag.
     * 
     * @return  TokenInterface
     */
    public function getToken(): TokenInterface;
}

