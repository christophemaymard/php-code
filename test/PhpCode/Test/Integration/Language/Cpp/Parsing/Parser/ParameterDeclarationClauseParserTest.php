<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Integration\Language\Cpp\Parsing\Parser;

use PhpCode\Exception\FormatException;
use PhpCode\Language\Cpp\Lexical\Lexer;
use PhpCode\Language\Cpp\Parsing\Parser;
use PhpCode\Language\Cpp\Specification\LanguageContextFactory;
use PhpCode\Test\Language\Cpp\Lexical\TokenAssertionTrait;

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
class ParameterDeclarationClauseParserTest extends AbstractParserTest
{
    use TokenAssertionTrait;
    
    /**
     * Tests that parseParameterDeclarationClause() parses "        ".
     * 
     * @param   int $standard   The standard to create the language context for.
     * 
     * @dataProvider    getCpp2003StandardProvider
     * @dataProvider    getCpp2011StandardProvider
     * @dataProvider    getCpp2014StandardProvider
     * @dataProvider    getCpp2017StandardProvider
     */
    public function testParseEmpty(int $standard): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream('        ');
        
        $sut = new Parser($lexer);
        $prmDeclClause = $sut->parseParameterDeclarationClause();
        
        self::assertFalse($prmDeclClause->hasParameterDeclarationList());
        self::assertFalse($prmDeclClause->hasEllipsis());
        
        self::assertEOFToken($lexer->getToken());
    }
    
    /**
     * Tests that parseParameterDeclarationClause() parses "  ...   ".
     * 
     * @param   int $standard   The standard to create the language context for.
     * 
     * @dataProvider    getCpp2003StandardProvider
     * @dataProvider    getCpp2011StandardProvider
     * @dataProvider    getCpp2014StandardProvider
     * @dataProvider    getCpp2017StandardProvider
     */
    public function testParseEllipsis(int $standard): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream('  ...   ');
        
        $sut = new Parser($lexer);
        $prmDeclClause = $sut->parseParameterDeclarationClause();
        
        self::assertFalse($prmDeclClause->hasParameterDeclarationList());
        self::assertTrue($prmDeclClause->hasEllipsis());
        
        self::assertEOFToken($lexer->getToken());
    }
    
    /**
     * Tests that parseParameterDeclarationClause() parses "int".
     * 
     * @param   int $standard   The standard to create the language context for.
     * 
     * @dataProvider    getCpp2003StandardProvider
     * @dataProvider    getCpp2011StandardProvider
     * @dataProvider    getCpp2014StandardProvider
     * @dataProvider    getCpp2017StandardProvider
     */
    public function testParseInt(int $standard): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream('int');
        
        $sut = new Parser($lexer);
        $prmDeclClause = $sut->parseParameterDeclarationClause();
        
        // 
        $prmDeclList = $prmDeclClause->getParameterDeclarationList();
        self::assertCount(1, $prmDeclList);
        
        $prmDecl = $prmDeclList->getParameterDeclarations()[0];
        $declSpecSeq = $prmDecl->getDeclarationSpecifierSequence();
        self::assertCount(1, $declSpecSeq);
        
        $declSpec = $declSpecSeq->getDeclarationSpecifiers()[0];
        $stSpec = $declSpec->getDefiningTypeSpecifier()
            ->getTypeSpecifier()
            ->getSimpleTypeSpecifier();
        self::assertTrue($stSpec->isInt());
        
        // 
        self::assertFalse($prmDeclClause->hasEllipsis());
        
        self::assertEOFToken($lexer->getToken());
    }
    
    /**
     * Tests that parseParameterDeclarationClause() parses "int ...".
     * 
     * @param   int $standard   The standard to create the language context for.
     * 
     * @dataProvider    getCpp2003StandardProvider
     * @dataProvider    getCpp2011StandardProvider
     * @dataProvider    getCpp2014StandardProvider
     * @dataProvider    getCpp2017StandardProvider
     */
    public function testParseIntEllipsis(int $standard): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream('int ...');
        
        $sut = new Parser($lexer);
        $prmDeclClause = $sut->parseParameterDeclarationClause();
        
        // 
        $prmDeclList = $prmDeclClause->getParameterDeclarationList();
        self::assertCount(1, $prmDeclList);
        
        $prmDecl = $prmDeclList->getParameterDeclarations()[0];
        $declSpecSeq = $prmDecl->getDeclarationSpecifierSequence();
        self::assertCount(1, $declSpecSeq);
        
        $declSpec = $declSpecSeq->getDeclarationSpecifiers()[0];
        $stSpec = $declSpec->getDefiningTypeSpecifier()
            ->getTypeSpecifier()
            ->getSimpleTypeSpecifier();
        self::assertTrue($stSpec->isInt());
        
        // 
        self::assertTrue($prmDeclClause->hasEllipsis());
        
        self::assertEOFToken($lexer->getToken());
    }
    
    /**
     * Tests that parseParameterDeclarationClause() parses "int, ...".
     * 
     * @param   int $standard   The standard to create the language context for.
     * 
     * @dataProvider    getCpp2003StandardProvider
     * @dataProvider    getCpp2011StandardProvider
     * @dataProvider    getCpp2014StandardProvider
     * @dataProvider    getCpp2017StandardProvider
     */
    public function testParseIntCommaEllipsis(int $standard): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream('int, ...');
        
        $sut = new Parser($lexer);
        $prmDeclClause = $sut->parseParameterDeclarationClause();
        
        // 
        $prmDeclList = $prmDeclClause->getParameterDeclarationList();
        self::assertCount(1, $prmDeclList);
        
        $prmDecl = $prmDeclList->getParameterDeclarations()[0];
        $declSpecSeq = $prmDecl->getDeclarationSpecifierSequence();
        self::assertCount(1, $declSpecSeq);
        
        $declSpec = $declSpecSeq->getDeclarationSpecifiers()[0];
        $stSpec = $declSpec->getDefiningTypeSpecifier()
            ->getTypeSpecifier()
            ->getSimpleTypeSpecifier();
        self::assertTrue($stSpec->isInt());
        
        // 
        self::assertTrue($prmDeclClause->hasEllipsis());
        
        self::assertEOFToken($lexer->getToken());
    }
    
    /**
     * Tests that parseParameterDeclarationList() throws an exception when 
     * the stream is invalid.
     * 
     * @param   int     $standard   The standard to create the language context for.
     * @param   string  $stream     The stream to test.
     * @param   string  $message    The expected message of the exception.
     * 
     * @dataProvider    getInvalidStreamsProvider
     */
    public function testParseParameterDeclarationClauseThrowsExceptionWhenInvalidStream(
        int $standard,
        string $stream,
        string $message
    ): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream($stream);
        
        $sut = new Parser($lexer);
        
        $this->expectException(FormatException::class);
        $this->expectExceptionMessage($message);
        $sut->parseParameterDeclarationClause();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getInvalidStreams(): array
    {
        return [
            // 
            '3 parameters "int, , int" second is missing' => [
                [ 1, 2, 4, 8, ], 
                'int, , int', 
                'Unexpected ",", expected decl-specifier.', 
            ], 
            '3 parameters "int, int," third is missing' => [
                [ 1, 2, 4, 8, ], 
                'int, int,', 
                'Unexpected "", expected decl-specifier.', 
            ], 
        ];
    }
}

