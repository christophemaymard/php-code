<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp;

/**
 * Represents a set of specifications.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class Specification
{
    /**
     * The standard specifications.
     * An associative array where:
     * - the key is the standard, and 
     * - the value is the string representation of the standard.
     * @var string[]   
     */
    public const STANDARDS = [
        1 => 'C++ 2003', 
        2 => 'C++ 2011', 
        4 => 'C++ 2014', 
        8 => 'C++ 2017', 
    ];
    
    /**
     * The keyword specifications.
     * An indexed array of arrays where:
     * - [0] is the lexeme of the keyword, 
     * - [1] is the tag of the keyword, and 
     * - [2] is the standards that support the keyword.
     * @var array[]
     */
    public const KEYWORDS = [
        [ 'alignas', 101000, [ 2, 4, 8, ], ], 
        [ 'alignof', 102000, [ 2, 4, 8, ], ], 
        [ 'and', 103000, [ 1, 2, 4, 8, ], ], 
        [ 'and_eq', 104000, [ 1, 2, 4, 8, ], ], 
        [ 'asm', 105000, [ 1, 2, 4, 8, ], ], 
        [ 'auto', 106000, [ 1, 2, 4, 8, ], ], 
        [ 'bitand', 107000, [ 1, 2, 4, 8, ], ], 
        [ 'bitor', 108000, [ 1, 2, 4, 8, ], ], 
        [ 'bool', 109000, [ 1, 2, 4, 8, ], ], 
        [ 'break', 110000, [ 1, 2, 4, 8, ], ], 
        [ 'case', 111000, [ 1, 2, 4, 8, ], ], 
        [ 'catch', 112000, [ 1, 2, 4, 8, ], ], 
        [ 'char', 113000, [ 1, 2, 4, 8, ], ], 
        [ 'char16_t', 114000, [ 2, 4, 8, ], ], 
        [ 'char32_t', 115000, [ 2, 4, 8, ], ], 
        [ 'class', 116000, [ 1, 2, 4, 8, ], ], 
        [ 'compl', 117000, [ 1, 2, 4, 8, ], ], 
        [ 'concept', 118000, [ 8, ], ], 
        [ 'const', 119000, [ 1, 2, 4, 8, ], ], 
        [ 'const_cast', 120000, [ 1, 2, 4, 8, ], ], 
        [ 'constexpr', 121000, [ 2, 4, 8, ], ], 
        [ 'continue', 122000, [ 1, 2, 4, 8, ], ], 
        [ 'decltype', 123000, [ 2, 4, 8, ], ], 
        [ 'default', 124000, [ 1, 2, 4, 8, ], ], 
        [ 'delete', 125000, [ 1, 2, 4, 8, ], ], 
        [ 'do', 126000, [ 1, 2, 4, 8, ], ], 
        [ 'double', 127000, [ 1, 2, 4, 8, ], ], 
        [ 'dynamic_cast', 128000, [ 1, 2, 4, 8, ], ], 
        [ 'else', 129000, [ 1, 2, 4, 8, ], ], 
        [ 'enum', 130000, [ 1, 2, 4, 8, ], ], 
        [ 'explicit', 131000, [ 1, 2, 4, 8, ], ], 
        [ 'export', 132000, [ 1, 2, 4, 8, ], ], 
        [ 'extern', 133000, [ 1, 2, 4, 8, ], ], 
        [ 'false', 134000, [ 1, 2, 4, 8, ], ], 
        [ 'float', 135000, [ 1, 2, 4, 8, ], ], 
        [ 'for', 136000, [ 1, 2, 4, 8, ], ], 
        [ 'friend', 137000, [ 1, 2, 4, 8, ], ], 
        [ 'goto', 138000, [ 1, 2, 4, 8, ], ], 
        [ 'if', 139000, [ 1, 2, 4, 8, ], ], 
        [ 'inline', 140000, [ 1, 2, 4, 8, ], ], 
        [ 'int', 141000, [ 1, 2, 4, 8, ], ], 
        [ 'long', 142000, [ 1, 2, 4, 8, ], ], 
        [ 'mutable', 143000, [ 1, 2, 4, 8, ], ], 
        [ 'namespace', 144000, [ 1, 2, 4, 8, ], ], 
        [ 'new', 145000, [ 1, 2, 4, 8, ], ], 
        [ 'noexcept', 146000, [ 2, 4, 8, ], ], 
        [ 'not', 147000, [ 1, 2, 4, 8, ], ], 
        [ 'not_eq', 148000, [ 1, 2, 4, 8, ], ], 
        [ 'nullptr', 149000, [ 2, 4, 8, ], ], 
        [ 'operator', 150000, [ 1, 2, 4, 8, ], ], 
        [ 'or', 151000, [ 1, 2, 4, 8, ], ], 
        [ 'or_eq', 152000, [ 1, 2, 4, 8, ], ], 
        [ 'private', 153000, [ 1, 2, 4, 8, ], ], 
        [ 'protected', 154000, [ 1, 2, 4, 8, ], ], 
        [ 'public', 155000, [ 1, 2, 4, 8, ], ], 
        [ 'register', 156000, [ 1, 2, 4, 8, ], ], 
        [ 'reinterpret_cast', 157000, [ 1, 2, 4, 8, ], ], 
        [ 'requires', 158000, [ 8, ], ], 
        [ 'return', 159000, [ 1, 2, 4, 8, ], ], 
        [ 'short', 160000, [ 1, 2, 4, 8, ], ], 
        [ 'signed', 161000, [ 1, 2, 4, 8, ], ], 
        [ 'sizeof', 162000, [ 1, 2, 4, 8, ], ], 
        [ 'static', 163000, [ 1, 2, 4, 8, ], ], 
        [ 'static_assert', 164000, [ 2, 4, 8, ], ], 
        [ 'static_cast', 165000, [ 1, 2, 4, 8, ], ], 
        [ 'struct', 166000, [ 1, 2, 4, 8, ], ], 
        [ 'switch', 167000, [ 1, 2, 4, 8, ], ], 
        [ 'template', 168000, [ 1, 2, 4, 8, ], ], 
        [ 'this', 169000, [ 1, 2, 4, 8, ], ], 
        [ 'thread_local', 170000, [ 2, 4, 8, ], ], 
        [ 'throw', 171000, [ 1, 2, 4, 8, ], ], 
        [ 'true', 172000, [ 1, 2, 4, 8, ], ], 
        [ 'try', 173000, [ 1, 2, 4, 8, ], ], 
        [ 'typedef', 174000, [ 1, 2, 4, 8, ], ], 
        [ 'typeid', 175000, [ 1, 2, 4, 8, ], ], 
        [ 'typename', 176000, [ 1, 2, 4, 8, ], ], 
        [ 'union', 177000, [ 1, 2, 4, 8, ], ], 
        [ 'unsigned', 178000, [ 1, 2, 4, 8, ], ], 
        [ 'using', 179000, [ 1, 2, 4, 8, ], ], 
        [ 'virtual', 180000, [ 1, 2, 4, 8, ], ], 
        [ 'void', 181000, [ 1, 2, 4, 8, ], ], 
        [ 'volatile', 182000, [ 1, 2, 4, 8, ], ], 
        [ 'wchar_t', 183000, [ 1, 2, 4, 8, ], ], 
        [ 'while', 184000, [ 1, 2, 4, 8, ], ], 
        [ 'xor', 185000, [ 1, 2, 4, 8, ], ], 
        [ 'xor_eq', 186000, [ 1, 2, 4, 8, ], ], 
    ];
    
    /**
     * The punctuator specifications.
     * An indexed array of arrays where:
     * - [0] is the lexeme of the punctuator, 
     * - [1] is the tag of the punctuator, and 
     * - [2] is the standards that support the punctuator.
     * @var array[]
     */
    public const PUNCTUATORS = [
        [ '{', 201000, [ 1, 2, 4, 8, ], ], 
        [ '}', 202000, [ 1, 2, 4, 8, ], ], 
        [ '[', 203000, [ 1, 2, 4, 8, ], ], 
        [ ']', 204000, [ 1, 2, 4, 8, ], ], 
        [ '#', 205000, [ 1, 2, 4, 8, ], ], 
        [ '##', 206000, [ 1, 2, 4, 8, ], ], 
        [ '(', 207000, [ 1, 2, 4, 8, ], ], 
        [ ')', 208000, [ 1, 2, 4, 8, ], ], 
        [ ';', 209000, [ 1, 2, 4, 8, ], ], 
        [ ':', 210000, [ 1, 2, 4, 8, ], ], 
        [ '...', 211000, [ 1, 2, 4, 8, ], ], 
        [ '?', 212000, [ 1, 2, 4, 8, ], ], 
        [ '::', 213000, [ 1, 2, 4, 8, ], ], 
        [ '.', 214000, [ 1, 2, 4, 8, ], ], 
        [ '.*', 215000, [ 1, 2, 4, 8, ], ], 
        [ '+', 216000, [ 1, 2, 4, 8, ], ], 
        [ '-', 217000, [ 1, 2, 4, 8, ], ], 
        [ '*', 218000, [ 1, 2, 4, 8, ], ], 
        [ '/', 219000, [ 1, 2, 4, 8, ], ], 
        [ '%', 220000, [ 1, 2, 4, 8, ], ], 
        [ '^', 221000, [ 1, 2, 4, 8, ], ], 
        [ '&', 222000, [ 1, 2, 4, 8, ], ], 
        [ '|', 223000, [ 1, 2, 4, 8, ], ], 
        [ '~', 224000, [ 1, 2, 4, 8, ], ], 
        [ '!', 225000, [ 1, 2, 4, 8, ], ], 
        [ '=', 226000, [ 1, 2, 4, 8, ], ], 
        [ '<', 227000, [ 1, 2, 4, 8, ], ], 
        [ '>', 228000, [ 1, 2, 4, 8, ], ], 
        [ '+=', 229000, [ 1, 2, 4, 8, ], ], 
        [ '-=', 230000, [ 1, 2, 4, 8, ], ], 
        [ '*=', 231000, [ 1, 2, 4, 8, ], ], 
        [ '/=', 232000, [ 1, 2, 4, 8, ], ], 
        [ '%=', 233000, [ 1, 2, 4, 8, ], ], 
        [ '^=', 234000, [ 1, 2, 4, 8, ], ], 
        [ '&=', 235000, [ 1, 2, 4, 8, ], ], 
        [ '|=', 236000, [ 1, 2, 4, 8, ], ], 
        [ '<<', 237000, [ 1, 2, 4, 8, ], ], 
        [ '>>', 238000, [ 1, 2, 4, 8, ], ], 
        [ '<<=', 239000, [ 1, 2, 4, 8, ], ], 
        [ '>>=', 240000, [ 1, 2, 4, 8, ], ], 
        [ '==', 241000, [ 1, 2, 4, 8, ], ], 
        [ '!=', 242000, [ 1, 2, 4, 8, ], ], 
        [ '<=', 243000, [ 1, 2, 4, 8, ], ], 
        [ '>=', 244000, [ 1, 2, 4, 8, ], ], 
        [ '&&', 245000, [ 1, 2, 4, 8, ], ], 
        [ '||', 246000, [ 1, 2, 4, 8, ], ], 
        [ '++', 247000, [ 1, 2, 4, 8, ], ], 
        [ '--', 248000, [ 1, 2, 4, 8, ], ], 
        [ ',', 249000, [ 1, 2, 4, 8, ], ], 
        [ '->*', 250000, [ 1, 2, 4, 8, ], ], 
        [ '->', 251000, [ 1, 2, 4, 8, ], ], 
        [ '<=>', 252000, [ 8, ], ], 
    ];
}

