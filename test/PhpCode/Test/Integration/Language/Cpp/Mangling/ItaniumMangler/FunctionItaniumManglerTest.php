<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Integration\Language\Cpp\Mangling\ItaniumMangler;

use PhpCode\Exception\FormatException;
use PhpCode\Language\Cpp\Mangling\ItaniumMangler;
use PhpCode\Language\Cpp\Specification\LanguageContextFactory;
use PhpCode\Test\Language\Cpp\Specification;
use PHPUnit\Framework\TestCase;

/**
 * Represents the base class of integration tests for the {@see PhpCode\Language\Cpp\Mangling\ItaniumMangler} 
 * class when calling mangleFunction().
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class FunctionItaniumManglerTest extends TestCase
{
    /**
     * Tests that mangleFunction() returns a string.
     * 
     * @param   int     $standard       The standard to create the language context for.
     * @param   string  $name           The name to test.
     * @param   string  $mangledName    The expected mangled name.
     * 
     * @dataProvider    getValidNamesProvider
     */
    public function testMangleFunctionReturnsString(
        int $standard, 
        string $name, 
        string $mangledName
    ): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $sut = new ItaniumMangler($ctx);
        self::assertSame($mangledName, $sut->mangleFunction($name));
    }
    
    /**
     * Tests that mangleFunction() throws an exception when the name is 
     * invalid.
     * 
     * @param   int     $standard   The standard to create the language context for.
     * @param   string  $name       The name to test.
     * @param   string  $message    The expected message of the exception.
     * 
     * @dataProvider    getInvalidNamesProvider
     */
    public function testMangleFunctionThrowsExceptionWhenInvalidStream(
        int $standard,
        string $name,
        string $message
    ): void
    {
        $factory = new LanguageContextFactory();
        $ctx = $factory->create($standard);
        
        $sut = new ItaniumMangler($ctx);
        
        $this->expectException(FormatException::class);
        $this->expectExceptionMessage($message);
        
        $sut->mangleFunction($name);
    }
    
    /**
     * Returns a set of invalid names.
     * 
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where 
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the name to test, and 
     *                  [2] is the expected message of the exception.
     */
    public function getInvalidNamesProvider(): array
    {
        return $this->getDatasetFromCsvFile('function_names_invalid.csv');
    }
    
    /**
     * Returns a set of valid names.
     * 
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where 
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the name to test, and 
     *                  [2] is the expected mangled name.
     */
    public function getValidNamesProvider(): array
    {
        return $this->getDatasetFromCsvFile('function_names_valid.csv');
    }
    
    /**
     * Returns the dataset from the specified CSV file.
     * 
     * @param   string  $fileName   The name of the CSV file to parse.
     * @return  array[] An associative array where the key is the name of the data set and the value is an indexed array where 
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the name to test, and 
     *                  [2] is the expected mangled name (valid names) or the expected message of the exception (invalid names).
     */
    private function getDatasetFromCsvFile(string $fileName): array
    {
        $contents =  \file_get_contents(
            __DIR__.'/../../../../../../../../res/cpp/test/mangling/'.$fileName
        );
        
        $fieldCount = 4;
        $dataset = [];
        
        foreach (\explode("\n", $contents) as $line) {
            $fields = \explode("\t", $line, $fieldCount);
            
            if (\count($fields) != $fieldCount) {
                continue;
            }
            
            list($dsName, $stds, $messageOrMangledName, $name) = $fields;
            
            foreach (\explode(' ', $stds) as $standardString) {
                $standard = (int)$standardString;
                
                $datasetName = \sprintf('%s: %s', Specification::STANDARDS[$standard], $dsName);
                $dataset[$datasetName] = [
                    $standard, 
                    $name, 
                    $messageOrMangledName, 
                ];
            }
        }
        
        return $dataset;
    }
}

