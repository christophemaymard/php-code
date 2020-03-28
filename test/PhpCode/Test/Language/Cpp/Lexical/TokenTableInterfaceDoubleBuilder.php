<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Lexical;

use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a builder of double for the {@see PhpCode\Language\Cpp\Lexical\TokenTableInterface} 
 * interface.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TokenTableInterfaceDoubleBuilder
{
    /**
     * The prophecy of a TokenTableInterface interface.
     * @var ObjectProphecy
     */
    private $prophecy;
    
    /**
     * Constructor.
     * 
     * @param   ObjectProphecy  $prophecy   The prophecy of a TokenTableInterface interface.
     */
    public function __construct(ObjectProphecy $prophecy)
    {
        $this->prophecy = $prophecy;
    }
    
    /**
     * Builds and adds a prophecy for the hasToken() method, with the 
     * specified lexeme as first argument, that will return the specified 
     * return value.
     * 
     * @param   string  $lexeme The lexeme (the first argument).
     * @param   bool    $return The value that will be returned.
     * @return  TokenTableInterfaceDoubleBuilder    This instance.
     */
    public function buildHasToken(string $lexeme, bool $return): self
    {
        $this->prophecy
            ->hasToken(Argument::is($lexeme))
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds and adds a prophecy for the hasToken() method, with any lexeme 
     * as first argument, that will return FALSE.
     * 
     * @return  TokenTableInterfaceDoubleBuilder    This instance.
     */
    public function buildHasTokenAnyReturnsFalse(): self
    {
        $this->prophecy
            ->hasToken(Argument::any())
            ->willReturn(FALSE);
        
        return $this;
    }
    
    /**
     * Builds and adds a prophecy for the getTag() method, with the specified 
     * lexeme as first argument, that will return the specified return value.
     * 
     * @param   string  $lexeme The lexeme (the first argument).
     * @param   int     $return The value (a tag) that will be returned.
     * @return  TokenTableInterfaceDoubleBuilder    This instance.
     */
    public function buildGetTag(string $lexeme, int $return): self
    {
        $this->prophecy
            ->getTag(Argument::is($lexeme))
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds and adds a prophecy for the getLengths() method that will 
     * return the specified return value.
     * 
     * @param   int[]   $return The value (an indexed array of lengths in reverse order) that will be returned.
     * @return  TokenTableInterfaceDoubleBuilder    This instance.
     */
    public function buildGetLengths(array $return): self
    {
        $this->prophecy
            ->getLengths()
            ->willReturn($return);
        
        return $this;
    }
    
    /**
     * Builds and adds a prophecy for the getLengths() method that is not 
     * expected to be called.
     * 
     * @return  TokenTableInterfaceDoubleBuilder    This instance.
     */
    public function buildGetLengthsNotCall(): self
    {
        $this->prophecy
            ->getLengths()
            ->shouldNotBeCalled();
        
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

