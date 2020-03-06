<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Lexical;

use PhpCode\Language\Cpp\Specification\LanguageContextInterface;

/**
 * Represents the lexical analyzer used to produce tokens from a stream.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class Lexer implements LexerInterface
{
    /**
     * The language context.
     * @var LanguageContextInterface
     */
    private $ctx;
    
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
     * Constructor.
     * 
     * @param   LanguageContextInterface    $ctx
     */
    public function __construct(LanguageContextInterface $ctx)
    {
        $this->ctx = $ctx;
    }

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
    public function lookAhead(int $n): TokenInterface
    {
        $tkn = NULL;
        $max = $n < 1 ? 1 : $n;
        $pos = $this->pos;
        
        for ($i = 0; $i < $max; $i++) {
            $tkn = $this->getToken();
        }
        
        $this->pos = $pos;
        
        return $tkn;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getToken(): TokenInterface
    {
        $remain = \mb_substr($this->stream, $this->pos);
        
        // Skip white spaces (space, CR, LF and HT).
        if (\preg_match("`^([ \r\n\t]+)`", $remain, $matches)) {
            $this->pos += \mb_strlen($matches[1]);
            
            $remain = \mb_substr($this->stream, $this->pos);
        }
        
        // Identifier or keyword token.
        if (\preg_match('`^('.Identifier::PATTERN.')`', $remain, $matches)) {
            $lexeme = $matches[1];
            $this->pos += \mb_strlen($lexeme);
            
            $tag = $this->ctx->getKeywords()->hasToken($lexeme) ? 
                $this->ctx->getKeywords()->getTag($lexeme) : 
                Tag::ID;
            
            return new Token($lexeme, $tag);
        }
        
        // Punctuator token.
        foreach ($this->ctx->getPunctuators()->getLengths() as $length) {
            $lexeme = \mb_substr($remain, 0, $length);
            
            if ($this->ctx->getPunctuators()->hasToken($lexeme)) {
                $this->pos += $length;
                
                return new Token($lexeme, $this->ctx->getPunctuators()->getTag($lexeme));
            }
        }
        
        // Unknown token.
        if ($this->pos < $this->length) {
            return new Token(\mb_substr($this->stream, $this->pos++, 1), Tag::UNKNOWN);
        }
        
        // End of File token.
        return new Token('', Tag::EOF);
    }
}

