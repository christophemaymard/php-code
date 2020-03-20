<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Integration\Language\Cpp\Parsing\Parser;

use PhpCode\Language\Cpp\Lexical\Lexer;
use PhpCode\Language\Cpp\Specification\LanguageContextFactory;
use PhpCode\Test\Language\Cpp\Specification;
use PhpCode\Test\Language\Cpp\Lexical\TokenAssertionTrait;
use PhpCode\Test\Language\Cpp\Parsing\InvalidData;
use PhpCode\Test\Language\Cpp\Parsing\ValidData;
use PHPUnit\Framework\TestCase;

/**
 * Represents the base class of integration tests for the {@see PhpCode\Language\Cpp\Parsing\Parser} 
 * class when parsing a rule.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractParserTest extends TestCase
{
    use TokenAssertionTrait;
    
    /**
     * Creates the lexer used by the system under test.
     * 
     * @param   int     $standard   The standard to create the language context for.
     * @param   string  $stream     The stream for the lexer.
     * @return  Lexer
     */
    protected function createLexer(int $standard, string $stream): Lexer
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $lexer = new Lexer($ctx);
        $lexer->setStream($stream);
        
        return $lexer;
    }
    
    /**
     * Creates a set of valid streams.
     * 
     * @param   ValidData[] $validDataSet   The data set used to create a set of valid streams.
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where:
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the stream to test, 
     *                  [2] is the constraint used to assert the concept, 
     *                  [3] is the lexeme of the next token after parsing, and 
     *                  [4] is the tag of the next token after parsing.
     */
    protected function createValidStreamsProvider(array $validDataSet): array
    {
        $dataSet = [];
        
        foreach ($validDataSet as $data) {
            $stream = $data->getStream();
            list($lexeme, $tag) = $data->getToken();
            $nameFmt = "\n%s: STREAM \"%s\"\n";
            
            if ($data->hasName()) {
                $nameFmt .= $data->getName()."\n";
            }
            
            foreach ($data->getStandards() as $std) {
                $name = \sprintf($nameFmt, Specification::STANDARDS[$std], $stream);
                
                $dataSet[$name] = [
                    $std, 
                    $stream, 
                    $data->getConstraintFactory()->createConstraint(), 
                    $lexeme, 
                    $tag, 
                ];
            }
        }
        
        return $dataSet;
    }
    
    /**
     * Creates a set of invalid streams.
     * 
     * @param   InvalidData[]   $invalidDataSet The data set used to create a set of invalid streams.
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where:
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the stream to test,  
     *                  [2] is the expected name of the exception, and 
     *                  [3] is the expected message of the exception.
     */
    protected function createInvalidStreamsProvider(array $invalidDataSet): array
    {
        $dataSet = [];
        
        foreach ($invalidDataSet as $data) {
            $stream = $data->getStream();
            $nameFmt = "\n%s: STREAM \"%s\"\n";
            
            if ($data->hasName()) {
                $nameFmt .= $data->getName()."\n";
            }
            
            foreach ($data->getStandards() as $std) {
                $name = \sprintf($nameFmt, Specification::STANDARDS[$std], $stream);
                
                $dataSet[$name] = [
                    $std, 
                    $stream, 
                    $data->getExceptionName(), 
                    $data->getExceptionMessage(), 
                ];
            }
        }
        
        return $dataSet;
    }
}

