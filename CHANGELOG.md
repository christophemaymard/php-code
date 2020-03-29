# CHANGELOG

* [0.1.0](#010---2020-03-29)

## 0.1.0 - 2020-03-29

### Added

#### C++

##### Declaration

* Declaration specifier can be defined as defining type specifier.
* Declaration specifier sequence contains zero or more declaration specifiers with no restriction.
* Defining type specifier can be defined as type specifier.
* Simple type specifier can be defined as identifier, qualified identifier, char, wchar_t, bool, short, int, long, signed, unsigned, float or double.
* Type specifier can be defined as simple type specifier.

##### Declarator

* Declarator can be defined as pointer declarator.
* Declarator identifier can be defined as identifier expression.
* No-pointer declarator can be defined as declarator identifier.
* No-pointer declarator can have an optional parameters and qualifiers.
* Parameter declaration has one declaration specifier sequence.
* Parameter declaration clause can have an optional parameter declaration list.
* Parameter declaration clause can have an optional ellipsis.
* Parameter declaration list can have zero or more parameter declarations.
* Parameters and qualifiers has one parameter declaration clause.
* Pointer declarator can be defined as no-pointer declarator.

##### Expression

* Identifier expression can be defined as unqualified identifier or qualified identifier.
* Nested name specifier can have zero or more name specifiers.
* In nested name specifier, name specifiers are identifiers.
* Qualified identifier has one nested name specifier and one unqualified identifier.
* Unqualified identifier can be defined as identifier.

##### Lexical

* Identifier only accepts lower case letters (a-z), upper case letters (A-Z), underscore and numbers (0-9).
* Lexer skips white spaces.
* Lexer supports all C++ 2003, C++ 2011, C++ 2014 and C++ 2017 keywords.
* Lexer supports all C++ 2003, C++ 2011, C++ 2014 and C++ 2017 punctuators.
* Lexer produces identifier, keyword, punctuator and unknown tokens.
* Lexer produces the N-th token without moving the position.

##### Mangling

* [ItaniumMangler] Mangle a function.
* [ItaniumMangler][Function] Mangle function with a name and zero or more parameters.
* [ItaniumMangler][Function] Mangle function from a declarator.
* [ItaniumMangler][Function] Mangle function name from a declarator.
* [ItaniumMangler][Function] Mangle function name based on an unqualified identifier or qualified identifier.
* [ItaniumMangler][Function] Mangle bare function type from a declarator.
* [ItaniumMangler][Function] Mangle bare function type with no parameter declaration list and no ellipsis.
* [ItaniumMangler][Function] Mangle bare function type with a parameter declaration list.
* [ItaniumMangler][Function] Mangle bare function type with an ellipsis.
* [ItaniumMangler][Function] Mangle bare function type with a parameter declaration list and an ellipsis.
* [ItaniumMangler][Function] Mangle type from a parameter declaration.
* [ItaniumMangler][Function] Mangle a declaration specifier sequence of one simple type specifier in a parameter declaration type.
* [ItaniumMangler][Function] Mangle identifier, qualified identifier, char, wchar_t, bool, short, int, long, signed, unsigned, float and double in a parameter declaration type.

##### Parsing

* [Parser] Parse a declarator as a pointer declarator.
* [Parser] Parse a pointer declarator as a no-pointer declarator.
* [Parser] Parse a no-pointer declarator as a declarator identifier with optional parameters and qualifiers.
* [Parser] Parse a declarator identifier as an identifier expression.
* [Parser] Parse an identifier expression as an unqualified identifier or a qualified identifier.
* [Parser] Parse an unqualified identifier as an identifier.
* [Parser] Parse a qualified identifier with a nested name specifier and an unqualified identifier.
* [Parser] Parse parameters and qualifiers with a parameter declaration clause.
* [Parser] Parse a parameter declaration clause with no parameter declaration list and no ellipsis.
* [Parser] Parse a parameter declaration clause with a parameter declaration list.
* [Parser] Parse a parameter declaration clause with an ellipsis.
* [Parser] Parse a parameter declaration clause with a parameter declaration list, a comma and an ellipsis.
* [Parser] Parse a parameter declaration clause with a parameter declaration list and an ellipsis.
* [Parser] Parse a parameter declaration list with one or more parameter declarations.
* [Parser] Parse a parameter declaration with a declaration specifier sequence.
* [Parser] Parse a declaration specifier sequence with one declaration specifier.
* [Parser] Parse a declaration specifier as a defining type specifier.
* [Parser] Parse a defining type specifier as a type specifier.
* [Parser] Parse a type specifier as a simple type specifier.
* [Parser] Parse a simple type specifier as an identifier, a qualified identifier, char, wchar_t, bool, short, int, long, signed, unsigned, float or double.

##### Specification

* Language context has a table for the keyword tokens and a table for the punctuator tokens.
* `LanguageContextFactory` class creates `LanguageContext` instances for C++ 2003, C++ 2011, C++ 2014 and C++ 2017 standards.

