<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Integration\Language\Cpp\Parsing\Parser;

use PhpCode\Test\Language\Cpp\Specification;
use PHPUnit\Framework\TestCase;

/**
 * Represents the base class of integration tests for the {@see PhpCode\Language\Cpp\Parsing\Parser} 
 * class when parsing a rule.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractParserTest extends TestCase
{
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
    abstract protected function getInvalidStreams(): array;
}

