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
     * Returns the next token in the stream.
     * 
     * If the end of the stream is reached, it always returns a token with 
     * the {@see PhpCode\Language\Cpp\Lexical\Tag::EOF} tag.
     * 
     * @return  TokenInterface
     */
    public function getToken(): TokenInterface;
}

