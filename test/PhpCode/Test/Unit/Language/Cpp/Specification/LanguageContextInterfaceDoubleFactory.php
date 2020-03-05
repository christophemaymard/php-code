<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Specification;

use PhpCode\Language\Cpp\Lexical\TokenTableInterface;
use PhpCode\Language\Cpp\Specification\LanguageContextInterface;
use PhpCode\Test\ProphecyFactory;
use PhpCode\Test\Language\Cpp\Lexical\TokenTableInterfaceDoubleBuilder;
use PhpCode\Test\Language\Cpp\Specification\LanguageContextInterfaceDoubleBuilder;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of double for the {@see PhpCode\Language\Cpp\Specification\LanguageContextInterface} 
 * interface.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class LanguageContextInterfaceDoubleFactory
{
    /**
     * The factory of prophecies.
     * @var ProphecyFactory
     */
    private $prophecyFactory;
    
    /**
     * Constructor.
     * 
     * @param   ProphecyFactory $prophecyFactory    The factory of prophecies.
     */
    public function __construct(ProphecyFactory $prophecyFactory)
    {
        $this->prophecyFactory = $prophecyFactory;
    }
    
    /**
     * Creates a double of the {@see PhpCode\Language\Cpp\Specification\LanguageContextInterface} 
     * interface.
     * 
     * @param   array[] $keywords           The keywords.
     * @param   array[] $punctuators        The punctuators.
     * @param   int[]   $punctuatorLengths  The punctuator lengths.
     * @return  ProphecySubjectInterface
     */
    public function createDouble(
        array $keywords, 
        array $punctuators, 
        array $punctuatorLengths
    ): ProphecySubjectInterface
    {
        $builder = new LanguageContextInterfaceDoubleBuilder(
            $this->prophecyFactory->createProphecy(LanguageContextInterface::class)
        );
        
        $keywordTable = $this->createKeywordsDouble($keywords);
        $builder->buildGetKeywords($keywordTable);
        
        $punctuatorTable = $this->createPunctuatorsDouble($punctuators, $punctuatorLengths);
        $builder->buildGetPunctuators($punctuatorTable);
        
        return $builder->getDouble();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Language\Cpp\Lexical\TokenTableInterface} 
     * interface for the keywords.
     * 
     * @param   array[] $keywords   The keywords.
     * 
     * @return  ProphecySubjectInterface
     */
    private function createKeywordsDouble(array $keywords): ProphecySubjectInterface
    {
        $builder = new TokenTableInterfaceDoubleBuilder(
            $this->prophecyFactory->createProphecy(TokenTableInterface::class)
        );
        
        foreach ($keywords as list($lexeme, $tag)) {
            $builder
                ->buildHasToken($lexeme, TRUE)
                ->buildGetTag($lexeme, $tag);
        }
        
        $builder
            ->buildHasTokenAnyReturnsFalse()
            ->buildGetLengthsNotCall();
        
        return $builder->getDouble();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Language\Cpp\Lexical\TokenTableInterface} 
     * interface for the punctuators.
     * 
     * @param   array[] $punctuators        The punctuators.
     * @param   int[]   $punctuatorLengths  The punctuator lengths.
     * 
     * @return  ProphecySubjectInterface
     */
    private function createPunctuatorsDouble(
        array $punctuators, 
        array $punctuatorLengths
    ): ProphecySubjectInterface
    {
        $builder = new TokenTableInterfaceDoubleBuilder(
            $this->prophecyFactory->createProphecy(TokenTableInterface::class)
        );
        
        foreach ($punctuators as list($lexeme, $tag)) {
            $builder
                ->buildHasToken($lexeme, TRUE)
                ->buildGetTag($lexeme, $tag);
        }
        
        $builder
            ->buildHasTokenAnyReturnsFalse()
            ->buildGetLengths($punctuatorLengths);
        
        return $builder->getDouble();
    }
}

