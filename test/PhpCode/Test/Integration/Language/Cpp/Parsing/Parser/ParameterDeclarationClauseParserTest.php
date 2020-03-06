<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Integration\Language\Cpp\Parsing\Parser;

use PhpCode\Language\Cpp\Declarator\ParameterDeclarationClause;
use PhpCode\Language\Cpp\Lexical\Lexer;
use PhpCode\Language\Cpp\Parsing\Parser;
use PhpCode\Language\Cpp\Specification\LanguageContextFactory;
use PHPUnit\Framework\TestCase;

/**
 * Represents the integration tests for the {@see PhpCode\Language\Cpp\Parsing\Parser} 
 * class when calling parseParameterDeclarationClause().
 * 
 * @group   declarator
 * @group   parsing
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationClauseParserTest extends TestCase
{
    /**
     * Tests that parseParameterDeclarationClause() parses nothing.
     * 
     * @param   int $standard   The standard to create the language context for.
     * 
     * @dataProvider    getCpp2003StandardProvider
     * @dataProvider    getCpp2011StandardProvider
     * @dataProvider    getCpp2014StandardProvider
     * @dataProvider    getCpp2017StandardProvider
     */
    public function testParseNothingWhenEmpty(int $standard): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream('        ');
        
        $sut = new Parser($lexer);
        $prmDeclClause = $sut->parseParameterDeclarationClause();
        
        self::assertFalse($prmDeclClause->hasEllipsis());
    }
    
    /**
     * Tests that parseParameterDeclarationClause() parses an ellipsis when 
     * there is only an ellipsis.
     * 
     * @param   int $standard   The standard to create the language context for.
     * 
     * @dataProvider    getCpp2003StandardProvider
     * @dataProvider    getCpp2011StandardProvider
     * @dataProvider    getCpp2014StandardProvider
     * @dataProvider    getCpp2017StandardProvider
     */
    public function testParseEllipsisWhenOnlyEllipsis(int $standard): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream('  ...   ');
        
        $sut = new Parser($lexer);
        $prmDeclClause = $sut->parseParameterDeclarationClause();
        
        self::assertTrue($prmDeclClause->hasEllipsis());
    }
    
    /**
     * Returns a set of standards with only C++ 2003.
     * 
     * @return  array[]
     */
    public function getCpp2003StandardProvider(): array
    {
        return [
            'C++ 2003' => [ 1, ], 
        ];
    }
    
    /**
     * Returns a set of standards with only C++ 2011.
     * 
     * @return  array[]
     */
    public function getCpp2011StandardProvider(): array
    {
        return [
            'C++ 2011' => [ 2, ], 
        ];
    }
    
    /**
     * Returns a set of standards with only C++ 2014.
     * 
     * @return  array[]
     */
    public function getCpp2014StandardProvider(): array
    {
        return [
            'C++ 2014' => [ 4, ], 
        ];
    }
    
    /**
     * Returns a set of standards with only C++ 2017.
     * 
     * @return  array[]
     */
    public function getCpp2017StandardProvider(): array
    {
        return [
            'C++ 2017' => [ 8, ], 
        ];
    }
}

