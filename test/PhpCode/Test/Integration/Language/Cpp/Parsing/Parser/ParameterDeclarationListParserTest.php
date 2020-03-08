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
 * class when calling parseParameterDeclarationList().
 * 
 * @group   declarator
 * @group   parsing
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationListParserTest extends AbstractParserTest
{
    use TokenAssertionTrait;
    
    /**
     * Tests that parseParameterDeclarationList() parses "int".
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
        $lexer->setStream('  int ');
        
        $sut = new Parser($lexer);
        $prmDeclList = $sut->parseParameterDeclarationList();
        self::assertCount(1, $prmDeclList);
        
        $prmDecls = $prmDeclList->getParameterDeclarations();
        
        // 
        $prmDecl = $prmDecls[0];
        $declSpecSeq = $prmDecl->getDeclarationSpecifierSequence();
        self::assertCount(1, $declSpecSeq);
        
        $declSpec = $declSpecSeq->getDeclarationSpecifiers()[0];
        $stSpec = $declSpec->getDefiningTypeSpecifier()
            ->getTypeSpecifier()
            ->getSimpleTypeSpecifier();
        self::assertTrue($stSpec->isInt());
        
        self::assertEOFToken($lexer->getToken());
    }
    
    /**
     * Tests that parseParameterDeclarationList() parses "int,int,int".
     * 
     * @param   int $standard   The standard to create the language context for.
     * 
     * @dataProvider    getCpp2003StandardProvider
     * @dataProvider    getCpp2011StandardProvider
     * @dataProvider    getCpp2014StandardProvider
     * @dataProvider    getCpp2017StandardProvider
     */
    public function testParseIntCommaIntCommaInt(int $standard): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream('int,int,int');
        
        $sut = new Parser($lexer);
        $prmDeclList = $sut->parseParameterDeclarationList();
        self::assertCount(3, $prmDeclList);
        
        $prmDecls = $prmDeclList->getParameterDeclarations();
        
        // 
        $declSpecSeq1 = $prmDecls[0]->getDeclarationSpecifierSequence();
        self::assertCount(1, $declSpecSeq1);
        
        $declSpec1 = $declSpecSeq1->getDeclarationSpecifiers()[0];
        $stSpec1 = $declSpec1->getDefiningTypeSpecifier()
            ->getTypeSpecifier()
            ->getSimpleTypeSpecifier();
        self::assertTrue($stSpec1->isInt());
        
        // 
        $declSpecSeq2 = $prmDecls[1]->getDeclarationSpecifierSequence();
        self::assertCount(1, $declSpecSeq2);
        
        $declSpec2 = $declSpecSeq2->getDeclarationSpecifiers()[0];
        $stSpec2 = $declSpec2->getDefiningTypeSpecifier()
            ->getTypeSpecifier()
            ->getSimpleTypeSpecifier();
        self::assertTrue($stSpec2->isInt());
        
        // 
        $declSpecSeq3 = $prmDecls[2]->getDeclarationSpecifierSequence();
        self::assertCount(1, $declSpecSeq3);
        
        $declSpec3 = $declSpecSeq3->getDeclarationSpecifiers()[0];
        $stSpec3 = $declSpec3->getDefiningTypeSpecifier()
            ->getTypeSpecifier()
            ->getSimpleTypeSpecifier();
        self::assertTrue($stSpec3->isInt());
        
        self::assertEOFToken($lexer->getToken());
    }
    
    /**
     * Tests that parseParameterDeclarationList() parses "int,int,int,...".
     * 
     * @param   int $standard   The standard to create the language context for.
     * 
     * @dataProvider    getCpp2003StandardProvider
     * @dataProvider    getCpp2011StandardProvider
     * @dataProvider    getCpp2014StandardProvider
     * @dataProvider    getCpp2017StandardProvider
     */
    public function testParseIntCommaIntCommaIntCommaEllipsis(int $standard): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream('int,int,int,...');
        
        $sut = new Parser($lexer);
        $prmDeclList = $sut->parseParameterDeclarationList();
        self::assertCount(3, $prmDeclList);
        
        $prmDecls = $prmDeclList->getParameterDeclarations();
        
        // 
        $declSpecSeq1 = $prmDecls[0]->getDeclarationSpecifierSequence();
        self::assertCount(1, $declSpecSeq1);
        
        $declSpec1 = $declSpecSeq1->getDeclarationSpecifiers()[0];
        $stSpec1 = $declSpec1->getDefiningTypeSpecifier()
            ->getTypeSpecifier()
            ->getSimpleTypeSpecifier();
        self::assertTrue($stSpec1->isInt());
        
        // 
        $declSpecSeq2 = $prmDecls[1]->getDeclarationSpecifierSequence();
        self::assertCount(1, $declSpecSeq2);
        
        $declSpec2 = $declSpecSeq2->getDeclarationSpecifiers()[0];
        $stSpec2 = $declSpec2->getDefiningTypeSpecifier()
            ->getTypeSpecifier()
            ->getSimpleTypeSpecifier();
        self::assertTrue($stSpec2->isInt());
        
        // 
        $declSpecSeq3 = $prmDecls[2]->getDeclarationSpecifierSequence();
        self::assertCount(1, $declSpecSeq3);
        
        $declSpec3 = $declSpecSeq3->getDeclarationSpecifiers()[0];
        $stSpec3 = $declSpec3->getDefiningTypeSpecifier()
            ->getTypeSpecifier()
            ->getSimpleTypeSpecifier();
        self::assertTrue($stSpec3->isInt());
        
        self::assertToken(',', 249000, $lexer->getToken());
    }
    
    /**
     * Tests that parseParameterDeclarationList() parses "int,int,int ...".
     * 
     * @param   int $standard   The standard to create the language context for.
     * 
     * @dataProvider    getCpp2003StandardProvider
     * @dataProvider    getCpp2011StandardProvider
     * @dataProvider    getCpp2014StandardProvider
     * @dataProvider    getCpp2017StandardProvider
     */
    public function testParseIntCommaIntCommaIntEllipsis(int $standard): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream('int,int,int ...');
        
        $sut = new Parser($lexer);
        $prmDeclList = $sut->parseParameterDeclarationList();
        self::assertCount(3, $prmDeclList);
        
        $prmDecls = $prmDeclList->getParameterDeclarations();
        
        // 
        $declSpecSeq1 = $prmDecls[0]->getDeclarationSpecifierSequence();
        self::assertCount(1, $declSpecSeq1);
        
        $declSpec1 = $declSpecSeq1->getDeclarationSpecifiers()[0];
        $stSpec1 = $declSpec1->getDefiningTypeSpecifier()
            ->getTypeSpecifier()
            ->getSimpleTypeSpecifier();
        self::assertTrue($stSpec1->isInt());
        
        // 
        $declSpecSeq2 = $prmDecls[1]->getDeclarationSpecifierSequence();
        self::assertCount(1, $declSpecSeq2);
        
        $declSpec2 = $declSpecSeq2->getDeclarationSpecifiers()[0];
        $stSpec2 = $declSpec2->getDefiningTypeSpecifier()
            ->getTypeSpecifier()
            ->getSimpleTypeSpecifier();
        self::assertTrue($stSpec2->isInt());
        
        // 
        $declSpecSeq3 = $prmDecls[2]->getDeclarationSpecifierSequence();
        self::assertCount(1, $declSpecSeq3);
        
        $declSpec3 = $declSpecSeq3->getDeclarationSpecifiers()[0];
        $stSpec3 = $declSpec3->getDefiningTypeSpecifier()
            ->getTypeSpecifier()
            ->getSimpleTypeSpecifier();
        self::assertTrue($stSpec3->isInt());
        
        self::assertToken('...', 211000, $lexer->getToken());
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
    public function testParseParameterDeclarationListThrowsExceptionWhenInvalidStream(
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
        $sut->parseParameterDeclarationList();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getInvalidStreams(): array
    {
        return [
            'No declaration specifier (empty string)' => [
                [ 1, 2, 4, 8, ],
                '#', 
                'Unexpected "#", expected decl-specifier.', 
            ], 
            '3 parameters ", int, int" first is missing' => [
                [ 1, 2, 4, 8, ],
                ', int, int', 
                'Unexpected ",", expected decl-specifier.', 
            ], 
            '3 parameters "int, , int" second is missing' => [
                [ 1, 2, 4, 8, ],
                'int, , int', 
                'Unexpected ",", expected decl-specifier.', 
            ], 
            '3 parameters "int , , int" third is missing' => [
                [ 1, 2, 4, 8, ],
                'int, int,', 
                'Unexpected "", expected decl-specifier.', 
            ], 
            // parseParameterDeclarationList() must not be called when only ellipsis.
            'Ellipsis' => [
                [ 1, 2, 4, 8, ],
                '...', 
                'Unexpected "...", expected decl-specifier.', 
            ], 
        ];
    }
}

