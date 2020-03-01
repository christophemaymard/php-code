<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp;

use PhpCode\Language\Cpp\Lexical\TokenTable;

/**
 * Represents a factory of language contexts.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class LanguageContextFactory
{
    /**
     * The keyword specifications.
     * An associative array where:
     * - the key is lexeme of the keyword, and 
     * - the value is an indexed array where
     *     [0] is the tag of the keyword, and 
     *     [1] is the standards that support the keyword.
     * @var array[]
     */
    private const KEYWORDS = [
    ];
    
    /**
     * The punctuator specifications.
     * An associative array where:
     * - the key is lexeme of the punctuator, and 
     * - the value is an indexed array where
     *     [0] is the tag of the punctuator, and 
     *     [1] is the standards that support the punctuator.
     * @var array[]
     */
    private const PUNCTUATORS = [
    ];
    
    /**
     * Creates a language context for the specified standard.
     * 
     * @param   int $standard   The standard to create the language context for.
     * @return  LanguageContextInterface    The created instance.
     */
    public function create(int $standard): LanguageContextInterface
    {
        $keywords = $this->createKeywordTable($standard);
        $punctuators = $this->createPunctuatorTable($standard);
        
        return new LanguageContext($keywords, $punctuators);
    }
    
    /**
     * Creates a token table for the keywords of the specified standard.
     * 
     * @param   int $standard   The standard to create the keyword token table for.
     * @return  TokenTable  The created instance.
     */
    private function createKeywordTable(int $standard): TokenTable
    {
        $keywords = new TokenTable();
        
        foreach (self::KEYWORDS as $lexeme => list($tag, $standards)) {
            if (\in_array($standard, $standards, TRUE)) {
                $keywords->addToken($lexeme, $tag);
            }
        }
        
        return $keywords;
    }
    
    /**
     * Creates a token table for the punctuators of the specified standard.
     * 
     * @param   int $standard   The standard to create the punctuator token table for.
     * @return  TokenTable  The created instance.
     */
    private function createPunctuatorTable(int $standard): TokenTable
    {
        $punctuators = new TokenTable();
        
        foreach (self::PUNCTUATORS as $lexeme => list($tag, $standards)) {
            if (\in_array($standard, $standards, TRUE)) {
                $punctuators->addToken($lexeme, $tag);
            }
        }
        
        return $punctuators;
    }
}

