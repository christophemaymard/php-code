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
 *     decl-specifier-seq abstract-declarator[opt]
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
     * The abstract declarator.
     * @var AbstractDeclarator|NULL
     */
    private $abstDcltor;
    
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
    
    /**
     * Returns the abstract declarator.
     * 
     * @return  AbstractDeclarator  The instance of an abstract declarator if it has been set, otherwise NULL.
     */
    public function getAbstractDeclarator(): ?AbstractDeclarator
    {
        return $this->abstDcltor;
    }
    
    /**
     * Sets the abstract declarator.
     * 
     * @param   AbstractDeclarator  $abstDcltor The abstract declarator to set.
     */
    public function setAbstractDeclarator(AbstractDeclarator $abstDcltor): void
    {
        $this->abstDcltor = $abstDcltor;
    }
    
    /**
     * Indicates whether this parameter declaration has an abstract 
     * declarator.
     * 
     * @return  bool    TRUE if this this parameter declaration has an abstract declarator, otherwise FALSE.
     */
    public function hasAbstractDeclarator(): bool
    {
        return $this->abstDcltor !== NULL;
    }
}

