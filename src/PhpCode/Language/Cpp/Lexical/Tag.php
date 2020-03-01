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
    
    /** Keyword: "alignas". */
    public const KW_ALIGNAS = 101000;
    /** Keyword: "alignof". */
    public const KW_ALIGNOF = 102000;
    /** Keyword: "and". */
    public const KW_AND = 103000;
    /** Keyword: "and_eq". */
    public const KW_AND_EQ = 104000;
    /** Keyword: "asm". */
    public const KW_ASM = 105000;
    /** Keyword: "auto". */
    public const KW_AUTO = 106000;
    /** Keyword: "bitand". */
    public const KW_BITAND = 107000;
    /** Keyword: "bitor". */
    public const KW_BITOR = 108000;
    /** Keyword: "bool". */
    public const KW_BOOL = 109000;
    /** Keyword: "break". */
    public const KW_BREAK = 110000;
    /** Keyword: "case". */
    public const KW_CASE = 111000;
    /** Keyword: "catch". */
    public const KW_CATCH = 112000;
    /** Keyword: "char". */
    public const KW_CHAR = 113000;
    /** Keyword: "char16_t". */
    public const KW_CHAR16_T = 114000;
    /** Keyword: "char32_t". */
    public const KW_CHAR32_T = 115000;
    /** Keyword: "class". */
    public const KW_CLASS = 116000;
    /** Keyword: "compl". */
    public const KW_COMPL = 117000;
    /** Keyword: "concept". */
    public const KW_CONCEPT = 118000;
    /** Keyword: "const". */
    public const KW_CONST = 119000;
    /** Keyword: "const_cast". */
    public const KW_CONST_CAST = 120000;
    /** Keyword: "constexpr". */
    public const KW_CONSTEXPR = 121000;
    /** Keyword: "continue". */
    public const KW_CONTINUE = 122000;
    /** Keyword: "decltype". */
    public const KW_DECLTYPE = 123000;
    /** Keyword: "default". */
    public const KW_DEFAULT = 124000;
    /** Keyword: "delete". */
    public const KW_DELETE = 125000;
    /** Keyword: "do". */
    public const KW_DO = 126000;
    /** Keyword: "double". */
    public const KW_DOUBLE = 127000;
    /** Keyword: "dynamic_cast". */
    public const KW_DYNAMIC_CAST = 128000;
    /** Keyword: "else". */
    public const KW_ELSE = 129000;
    /** Keyword: "enum". */
    public const KW_ENUM = 130000;
    /** Keyword: "explicit". */
    public const KW_EXPLICIT = 131000;
    /** Keyword: "export". */
    public const KW_EXPORT = 132000;
    /** Keyword: "extern". */
    public const KW_EXTERN = 133000;
    /** Keyword: "false". */
    public const KW_FALSE = 134000;
    /** Keyword: "float". */
    public const KW_FLOAT = 135000;
    /** Keyword: "for". */
    public const KW_FOR = 136000;
    /** Keyword: "friend". */
    public const KW_FRIEND = 137000;
    /** Keyword: "goto". */
    public const KW_GOTO = 138000;
    /** Keyword: "if". */
    public const KW_IF = 139000;
    /** Keyword: "inline". */
    public const KW_INLINE = 140000;
    /** Keyword: "int". */
    public const KW_INT = 141000;
    /** Keyword: "long". */
    public const KW_LONG = 142000;
    /** Keyword: "mutable". */
    public const KW_MUTABLE = 143000;
    /** Keyword: "namespace". */
    public const KW_NAMESPACE = 144000;
    /** Keyword: "new". */
    public const KW_NEW = 145000;
    /** Keyword: "noexcept". */
    public const KW_NOEXCEPT = 146000;
    /** Keyword: "not". */
    public const KW_NOT = 147000;
    /** Keyword: "not_eq". */
    public const KW_NOT_EQ = 148000;
    /** Keyword: "nullptr". */
    public const KW_NULLPTR = 149000;
    /** Keyword: "operator". */
    public const KW_OPERATOR = 150000;
    /** Keyword: "or". */
    public const KW_OR = 151000;
    /** Keyword: "or_eq". */
    public const KW_OR_EQ = 152000;
    /** Keyword: "private". */
    public const KW_PRIVATE = 153000;
    /** Keyword: "protected". */
    public const KW_PROTECTED = 154000;
    /** Keyword: "public". */
    public const KW_PUBLIC = 155000;
    /** Keyword: "register". */
    public const KW_REGISTER = 156000;
    /** Keyword: "reinterpret_cast". */
    public const KW_REINTERPRET_CAST = 157000;
    /** Keyword: "requires". */
    public const KW_REQUIRES = 158000;
    /** Keyword: "return". */
    public const KW_RETURN = 159000;
    /** Keyword: "short". */
    public const KW_SHORT = 160000;
    /** Keyword: "signed". */
    public const KW_SIGNED = 161000;
    /** Keyword: "sizeof". */
    public const KW_SIZEOF = 162000;
    /** Keyword: "static". */
    public const KW_STATIC = 163000;
    /** Keyword: "static_assert". */
    public const KW_STATIC_ASSERT = 164000;
    /** Keyword: "static_cast". */
    public const KW_STATIC_CAST = 165000;
    /** Keyword: "struct". */
    public const KW_STRUCT = 166000;
    /** Keyword: "switch". */
    public const KW_SWITCH = 167000;
    /** Keyword: "template". */
    public const KW_TEMPLATE = 168000;
    /** Keyword: "this". */
    public const KW_THIS = 169000;
    /** Keyword: "thread_local". */
    public const KW_THREAD_LOCAL = 170000;
    /** Keyword: "throw". */
    public const KW_THROW = 171000;
    /** Keyword: "true". */
    public const KW_TRUE = 172000;
    /** Keyword: "try". */
    public const KW_TRY = 173000;
    /** Keyword: "typedef". */
    public const KW_TYPEDEF = 174000;
    /** Keyword: "typeid". */
    public const KW_TYPEID = 175000;
    /** Keyword: "typename". */
    public const KW_TYPENAME = 176000;
    /** Keyword: "union". */
    public const KW_UNION = 177000;
    /** Keyword: "unsigned". */
    public const KW_UNSIGNED = 178000;
    /** Keyword: "using". */
    public const KW_USING = 179000;
    /** Keyword: "virtual". */
    public const KW_VIRTUAL = 180000;
    /** Keyword: "void". */
    public const KW_VOID = 181000;
    /** Keyword: "volatile". */
    public const KW_VOLATILE = 182000;
    /** Keyword: "wchar_t". */
    public const KW_WCHAR_T = 183000;
    /** Keyword: "while". */
    public const KW_WHILE = 184000;
    /** Keyword: "xor". */
    public const KW_XOR = 185000;
    /** Keyword: "xor_eq". */
    public const KW_XOR_EQ = 186000;
}

