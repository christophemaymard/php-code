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
 * Represents a table of tokens.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TokenTable implements TokenTableInterface
{
    /**
     * The tokens in this table.
     * An associative array where:
     * - the key is the lexeme of the token, and 
     * - the value is the tag of the token.
     * @var int[]
     */
    private $tokens = [];
    
    /**
     * An indexed array of the lengths of the token lexemes (in reverse 
     * order).
     * @var int[]
     */
    private $lengths = [];
    
    /**
     * Adds a token with the specified lexeme and tag.
     * 
     * @param   string  $lexeme The lexeme of the token.
     * @param   int     $tag    The tag of the token.
     * 
     * @throws  InvalidOperationException   When a token, with the specified lexeme, is already present.
     */
    public function addToken(string $lexeme, int $tag): void
    {
        if ($this->hasToken($lexeme)) {
            throw new InvalidOperationException(\sprintf(
                'A token, with the lexeme "%s", is already present.', 
                $lexeme
            ));
        }
        
        $this->tokens[$lexeme] = $tag;
        $this->addLength(\mb_strlen($lexeme));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getTag(string $lexeme): int
    {
        if (!$this->hasToken($lexeme)) {
            throw new InvalidOperationException(\sprintf(
                'There is no token with the lexeme "%s".', 
                $lexeme
            ));
        }
        
        return $this->tokens[$lexeme];
    }
    
    /**
     * {@inheritDoc}
     */
    public function hasToken(string $lexeme): bool
    {
        return \array_key_exists($lexeme, $this->tokens);
    }
    
    /**
     * Adds the specified length.
     * 
     * If the length is already stored, then it is not added.
     * 
     * @param   int $lengh  The length to add.
     */
    private function addLength(int $lengh): void
    {
        if (!\in_array($lengh, $this->lengths, TRUE)) {
            $this->lengths[] = $lengh;
            \rsort($this->lengths);
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLengths(): array
    {
        return $this->lengths;
    }
}

