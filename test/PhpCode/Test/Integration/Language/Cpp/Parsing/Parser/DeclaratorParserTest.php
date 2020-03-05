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
    /**
     * Tests that parseDeclarator() parse an unqualified identifier that is 
     * an identifier.
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
        ];
    }
}

