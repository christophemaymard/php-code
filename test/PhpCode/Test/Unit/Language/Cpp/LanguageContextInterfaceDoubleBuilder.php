<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp;

use PhpCode\Language\Cpp\Lexical\TokenTableInterface;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a builder of double for the {@see PhpCode\Language\Cpp\LanguageContextInterface} 
 * interface.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class LanguageContextInterfaceDoubleBuilder
{
    /**
     * The prophecy of a {@see PhpCode\Language\Cpp\LanguageContextInterface} 
     * interface.
     * @var ObjectProphecy
     */
    private $prophecy;
    
    /**
     * Constructor.
     * 
     * @param   ObjectProphecy  $prophecy   The prophecy of a PhpCode\Language\Cpp\LanguageContextInterface interface.
     */
    public function __construct(ObjectProphecy $prophecy)
    {
        $this->prophecy = $prophecy;
    }
    
    /**
     * Builds and adds a prophecy for the getKeywords() method that will 
     * return the specified return value and is expected to be called.
     * 
     * @param   TokenTableInterface $return The value (a token table) that will be returned.
     * @return  LanguageContextInterfaceDoubleBuilder   This instance.
     */
    public function buildGetKeywordsCall(TokenTableInterface $return): self
    {
        $this->prophecy
            ->getKeywords()
            ->willReturn($return)
            ->shouldBeCalled();
        
        return $this;
    }
    
    /**
     * Builds and adds a prophecy for the getPunctuators() method that will 
     * return the specified return value and is expected to be called.
     * 
     * @param   TokenTableInterface $return The value (a token table) that will be returned.
     * @return  LanguageContextInterfaceDoubleBuilder   This instance.
     */
    public function buildGetPunctuatorsCall(TokenTableInterface $return): self
    {
        $this->prophecy
            ->getPunctuators()
            ->willReturn($return)
            ->shouldBeCalled();
        
        return $this;
    }
    
    /**
     * Returns the double that has been built.
     * 
     * @return  ProphecySubjectInterface
     */
    public function getDouble(): ProphecySubjectInterface
    {
        return $this->prophecy->reveal();
    }
}
