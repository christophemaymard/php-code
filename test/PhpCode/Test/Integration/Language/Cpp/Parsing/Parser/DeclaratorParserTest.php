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
 * class when calling parseDeclarator().
 * 
 * @group   declarator
 * @group   parsing
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclaratorParserTest extends AbstractParserTest
{
    use TokenAssertionTrait;
    
    /**
     * Tests that parseDeclarator() parse "main".
     * 
     * @param   int $standard   The standard to create the language context for.
     * 
     * @dataProvider    getCpp2003StandardProvider
     * @dataProvider    getCpp2011StandardProvider
     * @dataProvider    getCpp2014StandardProvider
     * @dataProvider    getCpp2017StandardProvider
     */
    public function testParseUnqualifiedIdIdentifier(int $standard): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream('main');
        
        $sut = new Parser($lexer);
        $dcltor = $sut->parseDeclarator();
        
        $ptrDcltor = $dcltor->getPtrDeclarator();
        $noptrDcltor = $ptrDcltor->getNoptrDeclarator();
        self::assertFalse($noptrDcltor->hasParametersAndQualifiers());
        $did = $noptrDcltor->getDeclaratorId();
        $idExpr = $did->getIdExpression();
        $uid = $idExpr->getUnqualifiedId();
        $id = $uid->getIdentifier();
        
        self::assertSame('main', $id->getIdentifier());
        
        self::assertEOFToken($lexer->getToken());
    }
    
    /**
     * Tests that parseDeclarator() parse "main()".
     * 
     * @param   int $standard   The standard to create the language context for.
     * 
     * @dataProvider    getCpp2003StandardProvider
     * @dataProvider    getCpp2011StandardProvider
     * @dataProvider    getCpp2014StandardProvider
     * @dataProvider    getCpp2017StandardProvider
     */
    public function testParseUnqualifiedIdIdentifierEmptyParametersAndQualifiers(
        int $standard
    ): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream('main()');
        
        $sut = new Parser($lexer);
        $dcltor = $sut->parseDeclarator();
        
        $ptrDcltor = $dcltor->getPtrDeclarator();
        $noptrDcltor = $ptrDcltor->getNoptrDeclarator();
        
        $prmQual = $noptrDcltor->getParametersAndQualifiers();
        $prmDeclClause = $prmQual->getParameterDeclarationClause();
        self::assertFalse($prmDeclClause->hasParameterDeclarationList());
        self::assertFalse($prmDeclClause->hasEllipsis());
        
        // 
        $did = $noptrDcltor->getDeclaratorId();
        $idExpr = $did->getIdExpression();
        $uid = $idExpr->getUnqualifiedId();
        $id = $uid->getIdentifier();
        
        self::assertSame('main', $id->getIdentifier());
        
        self::assertEOFToken($lexer->getToken());
    }
    
    /**
     * Tests that parseDeclarator() parse "main(...)".
     * 
     * @param   int $standard   The standard to create the language context for.
     * 
     * @dataProvider    getCpp2003StandardProvider
     * @dataProvider    getCpp2011StandardProvider
     * @dataProvider    getCpp2014StandardProvider
     * @dataProvider    getCpp2017StandardProvider
     */
    public function testParseIdentifierParameterDeclarationClauseEllipsis(
        int $standard
    ): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream('main(...)');
        
        $sut = new Parser($lexer);
        $dcltor = $sut->parseDeclarator();
        
        $ptrDcltor = $dcltor->getPtrDeclarator();
        $noptrDcltor = $ptrDcltor->getNoptrDeclarator();
        
        $prmQual = $noptrDcltor->getParametersAndQualifiers();
        $prmDeclClause = $prmQual->getParameterDeclarationClause();
        self::assertFalse($prmDeclClause->hasParameterDeclarationList());
        self::assertTrue($prmDeclClause->hasEllipsis());
        
        // 
        $did = $noptrDcltor->getDeclaratorId();
        $idExpr = $did->getIdExpression();
        $uid = $idExpr->getUnqualifiedId();
        $id = $uid->getIdentifier();
        
        self::assertSame('main', $id->getIdentifier());
        
        self::assertEOFToken($lexer->getToken());
    }
    
    /**
     * Tests that parseDeclarator() parses "main(int)".
     * 
     * @param   int $standard   The standard to create the language context for.
     * 
     * @dataProvider    getCpp2003StandardProvider
     * @dataProvider    getCpp2011StandardProvider
     * @dataProvider    getCpp2014StandardProvider
     * @dataProvider    getCpp2017StandardProvider
     */
    public function testParseUnqualifiedIdPAQInt(int $standard): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream('main(int)');
        
        $sut = new Parser($lexer);
        $dcltor = $sut->parseDeclarator();
        
        $ptrDcltor = $dcltor->getPtrDeclarator();
        $noptrDcltor = $ptrDcltor->getNoptrDeclarator();
        
        $prmQual = $noptrDcltor->getParametersAndQualifiers();
        $prmDeclClause = $prmQual->getParameterDeclarationClause();
        
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
        
        // 
        $did = $noptrDcltor->getDeclaratorId();
        $idExpr = $did->getIdExpression();
        $uid = $idExpr->getUnqualifiedId();
        $id = $uid->getIdentifier();
        
        self::assertSame('main', $id->getIdentifier());
        
        self::assertEOFToken($lexer->getToken());
    }
    
    /**
     * Tests that parseDeclarator() parses "main(int ...)".
     * 
     * @param   int $standard   The standard to create the language context for.
     * 
     * @dataProvider    getCpp2003StandardProvider
     * @dataProvider    getCpp2011StandardProvider
     * @dataProvider    getCpp2014StandardProvider
     * @dataProvider    getCpp2017StandardProvider
     */
    public function testParseUnqualifiedIdPAQIntEllipsis(int $standard): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream('main(int ...)');
        
        $sut = new Parser($lexer);
        $dcltor = $sut->parseDeclarator();
        
        $ptrDcltor = $dcltor->getPtrDeclarator();
        $noptrDcltor = $ptrDcltor->getNoptrDeclarator();
        
        $prmQual = $noptrDcltor->getParametersAndQualifiers();
        $prmDeclClause = $prmQual->getParameterDeclarationClause();
        
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
        
        // 
        $did = $noptrDcltor->getDeclaratorId();
        $idExpr = $did->getIdExpression();
        $uid = $idExpr->getUnqualifiedId();
        $id = $uid->getIdentifier();
        
        self::assertSame('main', $id->getIdentifier());
        
        self::assertEOFToken($lexer->getToken());
    }
    
    /**
     * Tests that parseDeclarator() parses "main(int, ...)".
     * 
     * @param   int $standard   The standard to create the language context for.
     * 
     * @dataProvider    getCpp2003StandardProvider
     * @dataProvider    getCpp2011StandardProvider
     * @dataProvider    getCpp2014StandardProvider
     * @dataProvider    getCpp2017StandardProvider
     */
    public function testParseUnqualifiedIdPAQIntCommaEllipsis(int $standard): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream('main(int, ...)');
        
        $sut = new Parser($lexer);
        $dcltor = $sut->parseDeclarator();
        
        $ptrDcltor = $dcltor->getPtrDeclarator();
        $noptrDcltor = $ptrDcltor->getNoptrDeclarator();
        
        $prmQual = $noptrDcltor->getParametersAndQualifiers();
        $prmDeclClause = $prmQual->getParameterDeclarationClause();
        
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
        
        // 
        $did = $noptrDcltor->getDeclaratorId();
        $idExpr = $did->getIdExpression();
        $uid = $idExpr->getUnqualifiedId();
        $id = $uid->getIdentifier();
        
        self::assertSame('main', $id->getIdentifier());
        
        self::assertEOFToken($lexer->getToken());
    }
    
    /**
     * Tests that parseDeclarator() throws an exception when the stream is 
     * invalid.
     * 
     * @param   int     $standard   The standard to create the language context for.
     * @param   string  $stream     The stream to test.
     * @param   string  $message    The expected message of the exception.
     * 
     * @dataProvider    getInvalidStreamsProvider
     */
    public function testParseDecalaratorThrowsExceptionWhenInvalidStream(
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
        $sut->parseDeclarator();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getInvalidStreams(): array
    {
        return [
            'Empty string' => [
                [ 1, 2, 4, 8, ],
                '', 
                'Unexpected "", expected identifier.', 
            ], 
            'Multiple declarator-id (id-expression -> unqualified-id -> identifier) before parameters-and-qualifiers' => [
                [ 1, 2, 4, 8, ],
                'foo bar()', 
                'Unexpected identifier "bar".', 
            ], 
            // 
            'ELLIPSIS param "main(... int)"' => [
                [ 1, 2, 4, 8, ], 
                'main(... int)', 
                'Missing ")" before "int".', 
            ], 
            'ELLIPSIS COMMA param "main(..., int)"' => [
                [ 1, 2, 4, 8, ], 
                'main(..., int)', 
                'Missing ")" before ",".', 
            ], 
            'Param COMMA ELLIPSIS param "main(int, ... int)"' => [
                [ 1, 2, 4, 8, ], 
                'main(int, ... int)', 
                'Missing ")" before "int".', 
            ], 
            'Param COMMA ELLIPSIS COMMA param "main(int, ..., int)"' => [
                [ 1, 2, 4, 8, ], 
                'main(int, ..., int)', 
                'Missing ")" before ",".', 
            ], 
            // 
            '3 parameters "main(, int, int)" first is missing' => [
                [ 1, 2, 4, 8, ], 
                'main(, int, int)', 
                'Missing ")" before ",".', 
            ], 
            '3 parameters "main(int, , int)" second is missing' => [
                [ 1, 2, 4, 8, ], 
                'main(int, , int)', 
                'Unexpected ",", expected decl-specifier.', 
            ], 
            '3 parameters "main(int, int,)" third is missing' => [
                [ 1, 2, 4, 8, ], 
                'main(int, int,)', 
                'Unexpected ")", expected decl-specifier.', 
            ], 
        ];
    }
}

