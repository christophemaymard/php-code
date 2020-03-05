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
use PhpCode\Test\Language\Cpp\Specification;
use PHPUnit\Framework\TestCase;

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
class DeclaratorParserTest extends TestCase
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
    
    /**
     * Returns a set of invalid streams.
     * 
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where 
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the stream to test, and 
     *                  [2] is the expected message of the exception.
     */
    public function getInvalidStreamsProvider(): array
    {
        $dataset = [];
        
        foreach ($this->getInvalidStreams() as $name => list($standards, $stream, $message)) {
            foreach ($standards as $standard) {
                $datasetName = \sprintf('%s: %s', Specification::STANDARDS[$standard], $name);
                $dataset[$datasetName] = [
                    $standard, 
                    $stream, 
                    $message, 
                ];
            }
        }
        
        return $dataset;
    }
    
    /**
     * Returns a set of invalid streams.
     * 
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where 
     *                  [0] is the standards to create the language context for, 
     *                  [1] is the stream to test, and 
     *                  [2] is the expected message of the exception.
     */
    private function getInvalidStreams(): array
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

