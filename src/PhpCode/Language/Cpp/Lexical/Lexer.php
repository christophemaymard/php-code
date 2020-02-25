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
     * The stream used to produce tokens (default to an empty string).
     * @var string
     */
    private $stream = '';
    
    /**
     * The length of the stream, in number of characters (default to 0).
     * @var int
     */
    private $length = 0;
    
    /**
     * The current position in the stream (default to 0, the beginning).
     * @var int
     */
    private $pos = 0;
    
    /**
     * Sets the stream used to produce tokens.
     * 
     * @param   string  $stream The stream to use.
     */
    public function setStream(string $stream): void
    {
        $this->stream = $stream;
        $this->length = \mb_strlen($stream);
        $this->pos = 0;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getToken(): TokenInterface
    {
        // Skip white spaces (space, CR, LF and HT).
        if (\preg_match("`^([ \r\n\t]+)`", \mb_substr($this->stream, $this->pos), $matches)) {
            $this->pos += \mb_strlen($matches[1]);
        }
        
        // Unknown token.
        if ($this->pos < $this->length) {
            return new Token(\mb_substr($this->stream, $this->pos++, 1), Tag::UNKNOWN);
        }
        
        // End of File token.
        return new Token('', Tag::EOF);
    }
}

