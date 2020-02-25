<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp;

use PhpCode\Language\Cpp\LanguageContext;
use PhpCode\Language\Cpp\Lexical\TokenTableInterface;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\LanguageContext} 
 * class.
 * 
 * @group   lexical
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class LanguageContextTest extends TestCase
{
    /**
     * Tests that __construct() stores the table of keyword tokens.
     */
    public function test__constructStoresKeywords(): void
    {
        $keywordsDummy = $this->prophesize(TokenTableInterface::class)->reveal();
        
        $sut = new LanguageContext($keywordsDummy);
        self::assertSame($keywordsDummy, $sut->getKeywords());
    }
}

