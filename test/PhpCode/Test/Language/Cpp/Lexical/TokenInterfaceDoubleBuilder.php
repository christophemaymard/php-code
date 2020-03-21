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
 * Represents a double builder of the {@see PhpCode\Language\Cpp\Lexical\TokenInterface} 
 * interface.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TokenInterfaceDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getClassInterfaceName(): string
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
        $this->getProphecy()
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
        $this->getProphecy()
            ->getTag()
            ->willReturn($return);
        
        return $this;
    }
}

