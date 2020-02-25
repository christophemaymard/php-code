<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Lexical;

/**
 * Represents all the tags that identify tokens.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class Tag
{
    /** End of File. */
    public const EOF = 0;
    /** Unknown. */
    public const UNKNOWN = 1;
    /** Identifier. */
    public const ID = 2;
}

