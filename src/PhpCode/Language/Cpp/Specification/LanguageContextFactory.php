<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Specification;

use PhpCode\Language\Cpp\Lexical\Tag;
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
        'alignas' => [ Tag::KW_ALIGNAS, [ Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'alignof' => [ Tag::KW_ALIGNOF, [ Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'and' => [ Tag::KW_AND, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'and_eq' => [ Tag::KW_AND_EQ, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'asm' => [ Tag::KW_ASM, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'auto' => [ Tag::KW_AUTO, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'bitand' => [ Tag::KW_BITAND, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'bitor' => [ Tag::KW_BITOR, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'bool' => [ Tag::KW_BOOL, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'break' => [ Tag::KW_BREAK, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'case' => [ Tag::KW_CASE, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'catch' => [ Tag::KW_CATCH, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'char' => [ Tag::KW_CHAR, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'char16_t' => [ Tag::KW_CHAR16_T, [ Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'char32_t' => [ Tag::KW_CHAR32_T, [ Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'class' => [ Tag::KW_CLASS, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'compl' => [ Tag::KW_COMPL, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'concept' => [ Tag::KW_CONCEPT, [ Standard::CPP2017, ], ], 
        'const' => [ Tag::KW_CONST, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'const_cast' => [ Tag::KW_CONST_CAST, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'constexpr' => [ Tag::KW_CONSTEXPR, [ Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'continue' => [ Tag::KW_CONTINUE, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'decltype' => [ Tag::KW_DECLTYPE, [ Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'default' => [ Tag::KW_DEFAULT, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'delete' => [ Tag::KW_DELETE, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'do' => [ Tag::KW_DO, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'double' => [ Tag::KW_DOUBLE, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'dynamic_cast' => [ Tag::KW_DYNAMIC_CAST, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'else' => [ Tag::KW_ELSE, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'enum' => [ Tag::KW_ENUM, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'explicit' => [ Tag::KW_EXPLICIT, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'export' => [ Tag::KW_EXPORT, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'extern' => [ Tag::KW_EXTERN, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'false' => [ Tag::KW_FALSE, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'float' => [ Tag::KW_FLOAT, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'for' => [ Tag::KW_FOR, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'friend' => [ Tag::KW_FRIEND, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'goto' => [ Tag::KW_GOTO, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'if' => [ Tag::KW_IF, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'inline' => [ Tag::KW_INLINE, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'int' => [ Tag::KW_INT, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'long' => [ Tag::KW_LONG, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'mutable' => [ Tag::KW_MUTABLE, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'namespace' => [ Tag::KW_NAMESPACE, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'new' => [ Tag::KW_NEW, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'noexcept' => [ Tag::KW_NOEXCEPT, [ Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'not' => [ Tag::KW_NOT, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'not_eq' => [ Tag::KW_NOT_EQ, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'nullptr' => [ Tag::KW_NULLPTR, [ Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'operator' => [ Tag::KW_OPERATOR, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'or' => [ Tag::KW_OR, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'or_eq' => [ Tag::KW_OR_EQ, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'private' => [ Tag::KW_PRIVATE, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'protected' => [ Tag::KW_PROTECTED, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'public' => [ Tag::KW_PUBLIC, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'register' => [ Tag::KW_REGISTER, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'reinterpret_cast' => [ Tag::KW_REINTERPRET_CAST, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'requires' => [ Tag::KW_REQUIRES, [ Standard::CPP2017, ], ], 
        'return' => [ Tag::KW_RETURN, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'short' => [ Tag::KW_SHORT, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'signed' => [ Tag::KW_SIGNED, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'sizeof' => [ Tag::KW_SIZEOF, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'static' => [ Tag::KW_STATIC, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'static_assert' => [ Tag::KW_STATIC_ASSERT, [ Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'static_cast' => [ Tag::KW_STATIC_CAST, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'struct' => [ Tag::KW_STRUCT, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'switch' => [ Tag::KW_SWITCH, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'template' => [ Tag::KW_TEMPLATE, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'this' => [ Tag::KW_THIS, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'thread_local' => [ Tag::KW_THREAD_LOCAL, [ Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'throw' => [ Tag::KW_THROW, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'true' => [ Tag::KW_TRUE, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'try' => [ Tag::KW_TRY, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'typedef' => [ Tag::KW_TYPEDEF, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'typeid' => [ Tag::KW_TYPEID, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'typename' => [ Tag::KW_TYPENAME, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'union' => [ Tag::KW_UNION, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'unsigned' => [ Tag::KW_UNSIGNED, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'using' => [ Tag::KW_USING, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'virtual' => [ Tag::KW_VIRTUAL, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'void' => [ Tag::KW_VOID, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'volatile' => [ Tag::KW_VOLATILE, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'wchar_t' => [ Tag::KW_WCHAR_T, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'while' => [ Tag::KW_WHILE, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'xor' => [ Tag::KW_XOR, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        'xor_eq' => [ Tag::KW_XOR_EQ, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
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
        '{' => [ Tag::PN_BRACE_L, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '}' => [ Tag::PN_BRACE_R, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '[' => [ Tag::PN_SQUARE_L, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        ']' => [ Tag::PN_SQUARE_R, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '#' => [ Tag::PN_HASH, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '##' => [ Tag::PN_HASH_HASH, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '(' => [ Tag::PN_PAREN_L, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        ')' => [ Tag::PN_PAREN_R, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        ';' => [ Tag::PN_SEMI, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        ':' => [ Tag::PN_COLON, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '...' => [ Tag::PN_ELLIPSIS, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '?' => [ Tag::PN_QUESTION, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '::' => [ Tag::PN_COLON_COLON, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '.' => [ Tag::PN_PERIOD, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '.*' => [ Tag::PN_PERIOD_STAR, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '+' => [ Tag::PN_PLUS, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '-' => [ Tag::PN_MINUS, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '*' => [ Tag::PN_STAR, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '/' => [ Tag::PN_SLASH, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '%' => [ Tag::PN_PERCENT, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '^' => [ Tag::PN_CARET, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '&' => [ Tag::PN_AMP, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '|' => [ Tag::PN_PIPE, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '~' => [ Tag::PN_TILDE, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '!' => [ Tag::PN_EXCLAIM, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '=' => [ Tag::PN_EQ, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '<' => [ Tag::PN_LT, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '>' => [ Tag::PN_GT, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '+=' => [ Tag::PN_PLUS_EQ, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '-=' => [ Tag::PN_MINUS_EQ, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '*=' => [ Tag::PN_STAR_EQ, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '/=' => [ Tag::PN_SLASH_EQ, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '%=' => [ Tag::PN_PERCENT_EQ, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '^=' => [ Tag::PN_CARET_EQ, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '&=' => [ Tag::PN_AMP_EQ, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '|=' => [ Tag::PN_PIPE_EQ, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '<<' => [ Tag::PN_LT_LT, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '>>' => [ Tag::PN_GT_GT, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '<<=' => [ Tag::PN_LT_LT_EQ, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '>>=' => [ Tag::PN_GT_GT_EQ, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '==' => [ Tag::PN_EQ_EQ, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '!=' => [ Tag::PN_EXCLAIM_EQ, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '<=' => [ Tag::PN_LT_EQ, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '>=' => [ Tag::PN_GT_EQ, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '&&' => [ Tag::PN_AMP_AMP, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '||' => [ Tag::PN_PIPE_PIPE, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '++' => [ Tag::PN_PLUS_PLUS, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '--' => [ Tag::PN_MINUS_MINUS, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        ',' => [ Tag::PN_COMMA, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '->*' => [ Tag::PN_ARROW_STAR, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '->' => [ Tag::PN_ARROW, [ Standard::CPP2003, Standard::CPP2011, Standard::CPP2014, Standard::CPP2017, ], ], 
        '<=>' => [ Tag::PN_LT_EQ_GT, [ Standard::CPP2017, ], ], 
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

