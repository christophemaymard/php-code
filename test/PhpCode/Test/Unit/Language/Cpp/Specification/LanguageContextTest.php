<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Specification;

use PhpCode\Language\Cpp\Lexical\TokenTableInterface;
use PhpCode\Language\Cpp\Specification\LanguageContext;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Specification\LanguageContext} 
 * class.
 * 
 * @group   specification
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class LanguageContextTest extends TestCase
{
    /**
     * Tests that __construct() stores the table of keyword tokens and the 
     * table of punctuator tokens.
     */
    public function test__constructStoresKeywordsPunctuators(): void
    {
        $keywordsDummy = $this->prophesize(TokenTableInterface::class)->reveal();
        $punctuatorsDummy = $this->prophesize(TokenTableInterface::class)->reveal();
        
        $sut = new LanguageContext($keywordsDummy, $punctuatorsDummy);
        self::assertSame($keywordsDummy, $sut->getKeywords());
        self::assertSame($punctuatorsDummy, $sut->getPunctuators());
    }
}

