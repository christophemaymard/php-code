<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Lexical;

use PhpCode\Language\Cpp\Lexical\TokenInterface;
use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents a builder of double for the {@see PhpCode\Language\Cpp\Lexical\TokenInterface} 
 * interface.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TokenInterfaceDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return TokenInterface::class;
    }
    
    /**
     * Builds a prophecy where getLexeme() can be called.
     * 
     * @param   string  $return The value to return when getLexeme() is called.
     * @return  TokenInterfaceDoubleBuilder This instance.
     */
    public function buildGetLexeme(string $return): self
    {
        $this->getSubjectProphecy()
            ->getLexeme()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds a prophecy where getTag() can be called.
     * 
     * @param   int $return The value to return when getTag() is called.
     * @return  TokenInterfaceDoubleBuilder This instance.
     */
    public function buildGetTag(int $return): self
    {
        $this->getSubjectProphecy()
            ->getTag()
            ->willReturn($return);
        
        return $this;
    }
}

