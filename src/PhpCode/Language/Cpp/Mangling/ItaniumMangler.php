<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Mangling;

use PhpCode\Exception\FormatException;
use PhpCode\Language\Cpp\Declarator\Declarator;
use PhpCode\Language\Cpp\Declarator\ParameterDeclaration;
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
     * @param   LanguageContextInterface    $ctx
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
        
        return $this->mangleFunctionDeclarator($dcltor);
    }
    
    /**
     * Mangles a function with the specified declarator.
     * 
     * @param   Declarator  $dcltor The declarator.
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
     * <unqualified-name>
     *     <source-name>
     * 
     * <nested-name>
     *     N <prefix> <unqualified-name> E
     * 
     * <prefix>
     *     <unqualified-name>
     *     <prefix> <unqualified-name>
     * 
     * @param   Declarator  $dcltor The declarator used to mangle.
     * @return  string
     */
    private function mangleFunctionNameDeclarator(Declarator $dcltor): string
    {
        $ptrDcltor = $dcltor->getPtrDeclarator();
        $noptrDcltor = $ptrDcltor->getNoptrDeclarator();
        $did = $noptrDcltor->getDeclaratorId();
        $idExpr = $did->getIdExpression();
        
        // <unscoped-name>
        if ($idExpr->isUnqualifiedId()) {
            // For instance, the parser supports unqualified identifier that 
            // is defined as identifier.
            $id = $idExpr->getUnqualifiedId()->getIdentifier();
            
            return $this->mangleSourceName($id->getIdentifier());
        }
        
        // <nested-name>
        $mangledName = 'N';
        
        $qid = $idExpr->getQualifiedId();
        
        // For instance, the parser supports nested name specifier with 
        // identifier as name specifier.
        foreach ($qid->getNestedNameSpecifier()->getNameSpecifiers() as $id) {
            $mangledName .= $this->mangleSourceName($id->getIdentifier());
        }
        
        // For instance, the parser supports unqualified identifier that is 
        // defined as identifier.
        $id = $qid->getUnqualifiedId()->getIdentifier();
        
        $mangledName .= $this->mangleSourceName($id->getIdentifier());
        $mangledName .= 'E';
        
        return $mangledName;
    }
    
    /**
     * Mangles a bare-function-type with the specified declarator.
     * 
     * @param   Declarator  $dcltor The declarator.
     * @return  string
     * 
     * @throws  FormatException When the declarator does not have parameters-and-qualifiers.
     */
    private function mangleBareFunctionTypeDeclarator(Declarator $dcltor): string
    {
        $ptrDcltor = $dcltor->getPtrDeclarator();
        $noptrDcltor = $ptrDcltor->getNoptrDeclarator();
        
        if (!$noptrDcltor->hasParametersAndQualifiers()) {
            throw new FormatException('The declarator does not have parameters-and-qualifiers.');
        }
        
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
     * @param   ParameterDeclaration    $prmDecl    The parameter declaration to use.
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
        
        if ($stSpec->isInt()) {
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
        
        // It is "short".
        return 's';
    }
    
    /**
     * Mangles a source-name with the specified identifier.
     * 
     * @param   string  $id The identifier.
     * @return  string
     */
    private function mangleSourceName(string $id): string
    {
        return \sprintf('%s%s', \mb_strlen($id), $id);
    }
}

