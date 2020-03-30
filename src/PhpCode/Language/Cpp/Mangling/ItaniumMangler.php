<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Mangling;

use PhpCode\Exception\FormatException;
use PhpCode\Language\Cpp\Declarator\CVQualifierSequence;
use PhpCode\Language\Cpp\Declarator\Declarator;
use PhpCode\Language\Cpp\Declarator\ParameterDeclaration;
use PhpCode\Language\Cpp\Expression\NestedNameSpecifier;
use PhpCode\Language\Cpp\Lexical\Identifier;
use PhpCode\Language\Cpp\Lexical\Lexer;
use PhpCode\Language\Cpp\Lexical\Tag;
use PhpCode\Language\Cpp\Parsing\Parser;
use PhpCode\Language\Cpp\Specification\LanguageContextInterface;

/**
 * Represents the Itanium mangler.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ItaniumMangler
{
    /**
     * The language context.
     * @var LanguageContextInterface
     */
    private $ctx;
    
    /**
     * The lexer.
     * @var Lexer
     */
    private $lexer;
    
    /**
     * Constructor.
     * 
     * @param   LanguageContextInterface    $ctx    The language context.
     */
    public function __construct(LanguageContextInterface $ctx)
    {
        $this->init($ctx);
    }
    
    /**
     * Initializes this mangler with the specified language context.
     * 
     * @param   LanguageContextInterface    $ctx    The language context.
     */
    private function init(LanguageContextInterface $ctx): void
    {
        $this->ctx = $ctx;
        $this->lexer = new Lexer($this->ctx);
    }
    
    /**
     * Mangles the specified function name.
     * 
     * @param   string  $name   The function name to mangle.
     * @return  string  The mangled name.
     * 
     * @throws  FormatException When the name has not been parsed entirely.
     * @throws  FormatException When the declarator does not have parameters-and-qualifiers.
     */
    public function mangleFunction(string $name): string
    {
        $this->lexer->setStream($name);
        $parser = new Parser($this->lexer);
        $dcltor = $parser->parseDeclarator();
        
        $tkn = $this->lexer->getToken();
        
        if ($tkn->getTag() !== Tag::EOF) {
            throw new FormatException(\sprintf(
                'The name has not been parsed entirely, unexpected "%s".', 
                $tkn->getLexeme()
            ));
        }
        
        $noptrDcltor = $dcltor->getPtrDeclarator()->getNoptrDeclarator();
        
        if (!$noptrDcltor->hasParametersAndQualifiers()) {
            throw new FormatException('The declarator does not have parameters-and-qualifiers.');
        }
        
        return $this->mangleFunctionDeclarator($dcltor);
    }
    
    /**
     * Mangles a function from the specified declarator.
     * 
     * @param   Declarator  $dcltor The declarator used to mangle.
     * @return  string
     */
    private function mangleFunctionDeclarator(Declarator $dcltor): string
    {
        $mangledName = '_Z';
        $mangledName .= $this->mangleFunctionNameDeclarator($dcltor);
        $mangledName .= $this->mangleBareFunctionTypeDeclarator($dcltor);
        
        return $mangledName;
    }
    
    /**
     * Mangles a function name from the specified declarator.
     * 
     * <name>
     *     <nested-name>
     *     <unscoped-name>
     * 
     * <unscoped-name>
     *     <unqualified-name>
     * 
     * @param   Declarator  $dcltor The declarator used to mangle.
     * @return  string
     */
    private function mangleFunctionNameDeclarator(Declarator $dcltor): string
    {
        $noptrDcltor = $dcltor->getPtrDeclarator()->getNoptrDeclarator();
        $idExpr = $noptrDcltor->getDeclaratorId()->getIdExpression();
        
        $cvSeq = $noptrDcltor->getParametersAndQualifiers()->getCVQualifierSequence();
        
        // <unscoped-name>
        if ($idExpr->isUnqualifiedId()) {
            // For instance, the parser supports unqualified identifier that 
            // is defined as identifier.
            $id = $idExpr->getUnqualifiedId()->getIdentifier();
            
            return $cvSeq ? 
                $this->mangleNestedNameIdentifier(NULL, $id, $cvSeq) :
                $this->mangleUnqualifiedNameIdentifier($id);
        }
        
        // <nested-name>
        
        $qid = $idExpr->getQualifiedId();
        
        // For instance, the parser supports unqualified identifier that is 
        // defined as identifier.
        $id = $qid->getUnqualifiedId()->getIdentifier();
        
        return $this->mangleNestedNameIdentifier(
            $qid->getNestedNameSpecifier(), 
            $id, 
            $cvSeq
        );
    }
    
    /**
     * Mangles a bare-function-type from the specified declarator.
     * 
     * @param   Declarator  $dcltor The declarator used to mangle.
     * @return  string
     */
    private function mangleBareFunctionTypeDeclarator(Declarator $dcltor): string
    {
        $noptrDcltor = $dcltor->getPtrDeclarator()->getNoptrDeclarator();
        $prmQual = $noptrDcltor->getParametersAndQualifiers();
        $prmDeclClause = $prmQual->getParameterDeclarationClause();
        
        $mangledName = '';
        
        if ($prmDeclClause->hasParameterDeclarationList()) {
            $prmDeclList = $prmDeclClause->getParameterDeclarationList();
            
            foreach ($prmDeclList->getParameterDeclarations() as $prmDecl) {
                $mangledName .= $this->mangleTypeParameterDeclaration($prmDecl);
            }
            
            if ($prmDeclClause->hasEllipsis()) {
                $mangledName .= 'z';
            }
        } elseif ($prmDeclClause->hasEllipsis()) {
            $mangledName = 'z';
        } else {
            $mangledName = 'v';
        }
        
        return $mangledName;
    }
    
    /**
     * Mangles a type from the specified parameter declaration.
     * 
     * @param   ParameterDeclaration    $prmDecl    The parameter declaration used to mangle.
     * @return  string
     */
    private function mangleTypeParameterDeclaration(ParameterDeclaration $prmDecl): string
    {
        // For instance, the parser only supports declaration specifier 
        // sequence of one declaration specifier.
        $declSpec = $prmDecl->getDeclarationSpecifierSequence()->getDeclarationSpecifiers()[0];
        
        // For instance, the parser only supports declaration specifier that 
        // is defined as a simple type specifier.
        $stSpec = $declSpec->getDefiningTypeSpecifier()->getTypeSpecifier()->getSimpleTypeSpecifier();
        
        // It is "int" or "signed".
        // According to C++ specifications, "signed" is "int".
        if ($stSpec->isInt() || $stSpec->isSigned()) {
            return 'i';
        }
        
        if ($stSpec->isFloat()) {
            return 'f';
        }
        
        if ($stSpec->isBool()) {
            return 'b';
        }
        
        if ($stSpec->isChar()) {
            return 'c';
        }
        
        if ($stSpec->isWCharT()) {
            return 'w';
        }
        
        if ($stSpec->isShort()) {
            return 's';
        }
        
        if ($stSpec->isLong()) {
            return 'l';
        }
        
        if ($stSpec->isUnsigned()) {
            return 'j';
        }
        
        if ($stSpec->isDouble()) {
            return 'd';
        }
        
        if ($stSpec->isIdentifier()) {
            return $this->mangleUnqualifiedNameIdentifier($stSpec->getIdentifier());
        }
        
        // It is a qualified identifier.
        return $this->mangleNestedNameIdentifier(
            $stSpec->getNestedNameSpecifier(), 
            $stSpec->getIdentifier(), 
            NULL
        );
    }
    
    /**
     * Mangles a nested-name from the specified nested name specifier, 
     * identifier and  constant/volatile qualifier sequence.
     * 
     * <nested-name>
     *     N [<CV-qualifiers>] [<prefix>] <unqualified-name> E
     * 
     * @param   NestedNameSpecifier|NULL    $nnSpec The nested name specifier used to mangle (optional); the prefix is not mangled if NULL.
     * @param   Identifier                  $id     The identifier used to mangle.
     * @param   CVQualifierSequence|NULL    $cvSeq  The constant/volatile qualifier sequence used to mangle (optional); the CV-qualifiers is not mangled if NULL.
     * @return  string
     */
    private function mangleNestedNameIdentifier($nnSpec, Identifier $id, $cvSeq): string
    {
        $mangledName = 'N';
        
        // <CV-qualifiers>
        if ($cvSeq instanceof CVQualifierSequence) {
            $mangledName .= $this->mangleCVQualifiers($cvSeq);
        }
        
        // <prefix>
        if ($nnSpec instanceof NestedNameSpecifier) {
            $mangledName .= $this->manglePrefix($nnSpec);
        }
        
        // <unqualified-name>
        $mangledName .= $this->mangleUnqualifiedNameIdentifier($id);
        
        $mangledName .= 'E';
        
        return $mangledName;
    }
    
    /**
     * Mangles a prefix from the specified nested name specifier.
     * 
     * <prefix>
     *     <unqualified-name>
     *     <prefix> <unqualified-name>
     * 
     * @param   NestedNameSpecifier $nnSpec The nested name specifier used to mangle.
     * @return  string
     */
    private function manglePrefix(NestedNameSpecifier $nnSpec): string
    {
        $mangledName = '';
        
        // For instance, the parser supports nested name specifier with 
        // identifier as name specifier.
        foreach ($nnSpec->getNameSpecifiers() as $nameSpec) {
            $mangledName .= $this->mangleUnqualifiedNameIdentifier($nameSpec);
        }
        
        return $mangledName;
    }
    
    /**
     * Mangles an unqualified-name from the specified identifier.
     * 
     * <unqualified-name>
     *     <source-name>
     * 
     * @param   Identifier  $id The identifier used to mangle.
     * @return  string
     */
    private function mangleUnqualifiedNameIdentifier(Identifier $id): string
    {
        return $this->mangleSourceName($id->getIdentifier());
    }
    
    /**
     * Mangles a source-name from the specified name.
     * 
     * @param   string  $name   The name used to mangle.
     * @return  string
     */
    private function mangleSourceName(string $name): string
    {
        return \sprintf('%s%s', \mb_strlen($name), $name);
    }
    
    /**
     * Mangles CV-qualifiers from the specified constant/volatile qualifier 
     * sequence.
     * 
     * <CV-qualifiers>
     *     [V] [K]
     * 
     * @param   CVQualifierSequence $cvSeq  The constant/volatile qualifier sequence used to mangle.
     * @return  string
     */
    private function mangleCVQualifiers(CVQualifierSequence $cvSeq): string
    {
        $mangledName = '';
        
        // Mangles the qualifiers according to the "Clockwise/Spiral Rule".
        foreach (\array_reverse($cvSeq->getCVQualifiers()) as $cv) {
            $mangledName .= $cv->isConst() ? 'K' : 'V';
        }
        
        return $mangledName;
    }
}

