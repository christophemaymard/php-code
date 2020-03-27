<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\SimpleTypeSpecifier;
use PhpCode\Language\Cpp\Expression\NestedNameSpecifier;
use PhpCode\Language\Cpp\Lexical\Identifier;
use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents a double builder of the {@see PhpCode\Language\Cpp\Declaration\SimpleTypeSpecifier} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleTypeSpecifierDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return SimpleTypeSpecifier::class;
    }
    
    /**
     * Builds a prophecy where isInt() can be called.
     * 
     * @param   bool    $return The value to return when isInt() is called.
     * @return  SimpleTypeSpecifierDoubleBuilder    This instance.
     */
    public function buildIsInt(bool $return): self
    {
        $this->getSubjectProphecy()
            ->isInt()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds a prophecy where isFloat() can be called.
     * 
     * @param   bool    $return The value to return when isFloat() is called.
     * @return  SimpleTypeSpecifierDoubleBuilder    This instance.
     */
    public function buildIsFloat(bool $return): self
    {
        $this->getSubjectProphecy()
            ->isFloat()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds a prophecy where isBool() can be called.
     * 
     * @param   bool    $return The value to return when isBool() is called.
     * @return  SimpleTypeSpecifierDoubleBuilder    This instance.
     */
    public function buildIsBool(bool $return): self
    {
        $this->getSubjectProphecy()
            ->isBool()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds a prophecy where isChar() can be called.
     * 
     * @param   bool    $return The value to return when isChar() is called.
     * @return  SimpleTypeSpecifierDoubleBuilder    This instance.
     */
    public function buildIsChar(bool $return): self
    {
        $this->getSubjectProphecy()
            ->isChar()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds a prophecy where isWCharT() can be called.
     * 
     * @param   bool    $return The value to return when isWCharT() is called.
     * @return  SimpleTypeSpecifierDoubleBuilder    This instance.
     */
    public function buildIsWCharT(bool $return): self
    {
        $this->getSubjectProphecy()
            ->isWCharT()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds a prophecy where isShort() can be called.
     * 
     * @param   bool    $return The value to return when isShort() is called.
     * @return  SimpleTypeSpecifierDoubleBuilder    This instance.
     */
    public function buildIsShort(bool $return): self
    {
        $this->getSubjectProphecy()
            ->isShort()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds a prophecy where isLong() can be called.
     * 
     * @param   bool    $return The value to return when isLong() is called.
     * @return  SimpleTypeSpecifierDoubleBuilder    This instance.
     */
    public function buildIsLong(bool $return): self
    {
        $this->getSubjectProphecy()
            ->isLong()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds a prophecy where isSigned() can be called.
     * 
     * @param   bool    $return The value to return when isSigned() is called.
     * @return  SimpleTypeSpecifierDoubleBuilder    This instance.
     */
    public function buildIsSigned(bool $return): self
    {
        $this->getSubjectProphecy()
            ->isSigned()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds a prophecy where isUnsigned() can be called.
     * 
     * @param   bool    $return The value to return when isUnsigned() is called.
     * @return  SimpleTypeSpecifierDoubleBuilder    This instance.
     */
    public function buildIsUnsigned(bool $return): self
    {
        $this->getSubjectProphecy()
            ->isUnsigned()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds a prophecy where isDouble() can be called.
     * 
     * @param   bool    $return The value to return when isDouble() is called.
     * @return  SimpleTypeSpecifierDoubleBuilder    This instance.
     */
    public function buildIsDouble(bool $return): self
    {
        $this->getSubjectProphecy()
            ->isDouble()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds a prophecy where isIdentifier() can be called.
     * 
     * @param   bool    $return The value to return when isIdentifier() is called.
     * @return  SimpleTypeSpecifierDoubleBuilder    This instance.
     */
    public function buildIsIdentifier(bool $return): self
    {
        $this->getSubjectProphecy()
            ->isIdentifier()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds a prophecy where getIdentifier() can be called.
     * 
     * @param   Identifier  $return The value to return when getIdentifier() is called (optional)(default to NULL).
     * @return  SimpleTypeSpecifierDoubleBuilder    This instance.
     */
    public function buildGetIdentifier(Identifier $return = NULL): self
    {
        $this->getSubjectProphecy()
            ->getIdentifier()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds a prophecy where isQualifiedIdentifier() can be called.
     * 
     * @param   bool    $return The value to return when isQualifiedIdentifier() is called.
     * @return  SimpleTypeSpecifierDoubleBuilder    This instance.
     */
    public function buildIsQualifiedIdentifier(bool $return): self
    {
        $this->getSubjectProphecy()
            ->isQualifiedIdentifier()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds a prophecy where getNestedNameSpecifier() can be called.
     * 
     * @param   NestedNameSpecifier $return The value to return when getNestedNameSpecifier() is called (optional)(default to NULL).
     * @return  SimpleTypeSpecifierDoubleBuilder    This instance.
     */
    public function buildGetNestedNameSpecifier(NestedNameSpecifier $return = NULL): self
    {
        $this->getSubjectProphecy()
            ->getNestedNameSpecifier()
            ->willReturn($return);
        
        return $this;
    }
}

