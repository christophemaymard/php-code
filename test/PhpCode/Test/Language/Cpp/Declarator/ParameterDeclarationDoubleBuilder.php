<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence;
use PhpCode\Language\Cpp\Declarator\AbstractDeclarator;
use PhpCode\Language\Cpp\Declarator\ParameterDeclaration;
use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents a builder of double for the {@see PhpCode\Language\Cpp\Declarator\ParameterDeclaration} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return ParameterDeclaration::class;
    }
    
    /**
     * Builds and adds a prophecy where getDeclarationSpecifierSequence() can 
     * be called.
     * 
     * @param   DeclarationSpecifierSequence    $return The value to return when getDeclarationSpecifierSequence() is called.
     * @return  ParameterDeclarationDoubleBuilder   This instance.
     */
    public function buildGetDeclarationSpecifierSequence(
        DeclarationSpecifierSequence $return
    ): self
    {
        $this->getSubjectProphecy()
            ->getDeclarationSpecifierSequence()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds and adds a prophecy where getAbstractDeclarator() can 
     * be called.
     * 
     * @param   AbstractDeclarator  $return The value to return when getAbstractDeclarator() is called (optional)(default to NULL).
     * @return  ParameterDeclarationDoubleBuilder   This instance.
     */
    public function buildGetAbstractDeclarator(AbstractDeclarator $return = NULL): self
    {
        $this->getSubjectProphecy()
            ->getAbstractDeclarator()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds and adds a prophecy where hasAbstractDeclarator() can be called.
     * 
     * @param   bool    $return The value to return when hasAbstractDeclarator() is called.
     * @return  ParameterDeclarationDoubleBuilder   This instance.
     */
    public function buildHasAbstractDeclarator(bool $return): self
    {
        $this->getSubjectProphecy()
            ->hasAbstractDeclarator()
            ->willReturn($return);
        
        return $this;
    }
}

