<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence;

/**
 * Represents a parameter declaration.
 * 
 * parameter-declaration:
 *     decl-specifier-seq
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclaration
{
    /**
     * The declaration specifier sequence.
     * @var DeclarationSpecifierSequence
     */
    private $declSpecSeq;
    
    /**
     * Constructor.
     * 
     * @param   DeclarationSpecifierSequence    $declSpecSeq    The declaration specifier sequence.
     */
    public function __construct(DeclarationSpecifierSequence $declSpecSeq)
    {
        $this->declSpecSeq = $declSpecSeq;
    }
    
    /**
     * Returns the declaration specifier sequence.
     * 
     * @return  DeclarationSpecifierSequence
     */
    public function getDeclarationSpecifierSequence(): DeclarationSpecifierSequence
    {
        return $this->declSpecSeq;
    }
}

