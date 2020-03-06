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
     * Mangles a function name with the specified declarator.
     * 
     * @param   Declarator  $dcltor The declarator.
     * @return  string
     */
    private function mangleFunctionNameDeclarator(Declarator $dcltor): string
    {
        $ptrDcltor = $dcltor->getPtrDeclarator();
        $noptrDcltor = $ptrDcltor->getNoptrDeclarator();
        $did = $noptrDcltor->getDeclaratorId();
        $idExpr = $did->getIdExpression();
        $uid = $idExpr->getUnqualifiedId();
        $id = $uid->getIdentifier();
        
        $mangledName = $this->mangleSourceName($id->getIdentifier());
        
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
        
        if ($prmDeclClause->hasEllipsis()) {
            $mangledName = 'z';
        } else {
            $mangledName = 'v';
        }
        
        
        return $mangledName;
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

