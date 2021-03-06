# Itanium C++ mangling

Table of contents

1. [General Structure](#general-structure)
2. [Operator Encodings](#operator-encodings)
3. [Other Special Functions and Entities](#other-special-functions-and-entities)
4. [Type encodings](#type-encodings)
5. [Expressions](#expressions)
6. [Scope Encoding](#scope-encoding)
7. [Closure Types (Lambdas)](#closure-types-lambdas)
8. [Compression](#compression)
9. [Index of rules](#index-of-rules)



Source: [Itanium C++ ABI](https://itanium-cxx-abi.github.io/cxx-abi/abi.html)


## **General Structure**



### mangled-name

| Rule             | Definitions                  |
|:-----------------|:-----------------------------|
| **mangled-name** | **_Z** [encoding](#encoding) |



### encoding

| Rule         | Definitions                                             |
|:-------------|:--------------------------------------------------------|
| **encoding** | [name](#name) [bare-function-type](#bare-function-type) |



### name

| Rule     | Definitions                     |
|:---------|:--------------------------------|
| **name** | [nested-name](#nested-name) |
|          | [unscoped-name](#unscoped-name) |



### unscoped-name

| Rule              | Definitions                           |
|:------------------|:--------------------------------------|
| **unscoped-name** | [unqualified-name](#unqualified-name) |



### nested-name

| Rule            | Definitions                                                                                         |
|:----------------|:----------------------------------------------------------------------------------------------------|
| **nested-name** | **N** [[CV-qualifiers](#CV-qualifiers)] [prefix](#prefix) [unqualified-name](#unqualified-name) **E** |



### prefix

| Rule       | Definitions                                             |
|:-----------|:--------------------------------------------------------|
| **prefix** | [unqualified-name](#unqualified-name)                   |
|            | [prefix](#prefix) [unqualified-name](#unqualified-name) |



### unqualified-name

| Rule                 | Definitions                 |
|:---------------------|:----------------------------|
| **unqualified-name** | [source-name](#source-name) |



### source-name

| Rule            | Definitions                                        |
|:----------------|:---------------------------------------------------|
| **source-name** | *positive-length-number* [identifier](#identifier) |



### identifier

| Rule           | Definitions                          | Comments                                                                                                                                    |
|:---------------|:-------------------------------------|:--------------------------------------------------------------------------------------------------------------------------------------------|
| **identifier** | *unqualified-source-code-identifier* | [identifier](#identifier) is a pseudo-terminal representing the characters in the unqualified identifier for the entity in the source code. |



## **Operator Encodings**



## **Other Special Functions and Entities**



## **Type encodings**



### type

| Rule     | Definitions                         |
|:---------|:------------------------------------|
| **type** | [builtin-type](#builtin-type)       |
|          | [class-enum-type](#class-enum-type) |
|          | [nested-name](#nested-name)         |



### CV-qualifiers

| Rule              | Definitions     |Comments          |
|:------------------|:----------------|:-----------------|
| **CV-qualifiers** | [**V**] [**K**] | Volatile, const. |



### builtin-type

| Rule             | Definitions | Comments     |
|:-----------------|:------------|:-------------|
| **builtin-type** | **v**       | void         |
|                  | **w**       | wchar_t      |
|                  | **b**       | bool         |
|                  | **c**       | char         |
|                  | **s**       | short        |
|                  | **i**       | int          |
|                  | **j**       | unsigned int |
|                  | **l**       | long         |
|                  | **f**       | float        |
|                  | **d**       | double       |
|                  | **z**       | ellipsis     |



### bare-function-type

| Rule                   | Definitions       |
|:-----------------------|:------------------|
| **bare-function-type** | [type](#type) *+* |



### class-enum-type

| Rule                | Definitions                     | Comments                                                                       |
|:--------------------|:--------------------------------|:-------------------------------------------------------------------------------|
| **class-enum-type** | [unscoped-name](#unscoped-name) | Non-dependent type name, dependent type name, or dependent typename-specifier. |



## **Expressions**



## **Scope Encoding**



## **Closure Types (Lambdas)**



## **Compression**



## **Index of rules**



- **B**
  - [bare-function-type](#bare-function-type)
  - [builtin-type](#builtin-type)
- **C**
  - [class-enum-type](#class-enum-type)
  - [CV-qualifiers](#CV-qualifiers)
- **E**
  - [encoding](#encoding)
- **I**
  - [identifier](#identifier)
- **M**
  - [mangled-name](#mangled-name)
- **N**
  - [name](#name)
  - [nested-name](#nested-name)
- **P**
  - [prefix](#prefix)
- **S**
  - [source-name](#source-name)
- **T**
  - [type](#type)
- **U**
  - [unqualified-name](#unqualified-name)
  - [unscoped-name](#unscoped-name)



