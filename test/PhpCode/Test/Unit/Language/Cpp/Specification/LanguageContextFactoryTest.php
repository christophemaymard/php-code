<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Specification;

use PhpCode\Language\Cpp\Specification\LanguageContextFactory;
use PhpCode\Test\Language\Cpp\Specification;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Specification\LanguageContextFactory} 
 * class.
 * 
 * @group   specification
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class LanguageContextFactoryTest extends TestCase
{
    /**
     * The system under test.
     * @var LanguageContextFactory
     */
    private $sut;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new LanguageContextFactory();
    }
    
    /**
     * Tests that create() returns new instances of language context.
     * 
     * @param   int $standard   The standard to create the language context for.
     * 
     * @dataProvider    getStandardsProvider
     */
    public function testCreateReturnsNewInstance(int $standard): void
    {
        $ctx1 = $this->sut->create($standard);
        $ctx2 = $this->sut->create($standard);
        
        self::assertNotSame($ctx1, $ctx2);
        self::assertNotSame($ctx1->getKeywords(), $ctx2->getKeywords());
        self::assertNotSame($ctx1->getPunctuators(), $ctx2->getPunctuators());
    }
    
    /**
     * Tests that count(), of the instance retrieved by getKeywords(), 
     * returns an integer.
     * 
     * @param   int $standard   The standard to create the language context for.
     * @param   int $count      The expected number of keywords.
     * 
     * @dataProvider    getKeywordCountsProvider
     */
    public function testCreateGetKeywordsCountReturnsInt(
        int $standard, 
        int $count
    ): void
    {
        $ctx = $this->sut->create($standard);
        
        self::assertSame($count, $ctx->getKeywords()->count());
    }
    
    /**
     * Tests that hasToken(), of the instance retrieved by getKeywords(), 
     * returns a boolean.
     * 
     * @param   int     $standard   The standard to create the language context for.
     * @param   array[] $tokens     An associative array where the key is the lexeme of the keyword and the value is the expected flag that indicates whether the keyword is present.
     * 
     * @dataProvider    getKeywordAvailabilitiesProvider
     */
    public function testCreateGetKeywordsHasTokenReturnsBool(
        int $standard, 
        array $tokens
    ): void
    {
        $ctx = $this->sut->create($standard);
        $keywords = $ctx->getKeywords();
        
        foreach ($tokens as $lexeme => $hasToken) {
            self::assertSame($hasToken, $keywords->hasToken($lexeme));
        }
    }
    
    /**
     * Tests that getTag(), of the instance retrieved by getKeywords(), 
     * returns an integer.
     * 
     * @param   int     $standard   The standard to create the language context for.
     * @param   array[] $tokens     An associative array where the key is the lexeme of the keyword and the value is the expected tag of the keyword.
     * 
     * @dataProvider    getKeywordTagsProvider
     */
    public function testCreateGetKeywordsGetTagReturnsInt(
        int $standard, 
        array $tokens
    ): void
    {
        $ctx = $this->sut->create($standard);
        $keywords = $ctx->getKeywords();
        
        foreach ($tokens as $lexeme => $tag) {
            self::assertSame($tag, $keywords->getTag($lexeme));
        }
    }
    
    /**
     * Tests that count(), of the instance retrieved by getPunctuators(), 
     * returns an integer.
     * 
     * @param   int $standard   The standard to create the language context for.
     * @param   int $count      The expected number of punctuators.
     * 
     * @dataProvider    getPunctuatorCountsProvider
     */
    public function testCreateGetPunctuatorsCountReturnsInt(
        int $standard, 
        int $count
    ): void
    {
        $ctx = $this->sut->create($standard);
        
        self::assertSame($count, $ctx->getPunctuators()->count());
    }
    
    /**
     * Tests that hasToken(), of the instance retrieved by getPunctuators(), 
     * returns a boolean.
     * 
     * @param   int     $standard   The standard to create the language context for.
     * @param   array[] $tokens     An associative array where the key is the lexeme of the punctuator and the value is the expected flag that indicates whether the punctuator is present.
     * 
     * @dataProvider    getPunctuatorAvailabilitiesProvider
     */
    public function testCreateGetPunctuatorsHasTokenReturnsBool(
        int $standard, 
        array $tokens
    ): void
    {
        $ctx = $this->sut->create($standard);
        $punctuators = $ctx->getPunctuators();
        
        foreach ($tokens as $lexeme => $hasToken) {
            self::assertSame($hasToken, $punctuators->hasToken($lexeme));
        }
    }
    
    /**
     * Tests that getTag(), of the instance retrieved by getPunctuators(), 
     * returns an integer.
     * 
     * @param   int     $standard   The standard to create the language context for.
     * @param   array[] $tokens     An associative array where the key is the lexeme of the punctuator and the value is the expected tag of the punctuator.
     * 
     * @dataProvider    getPunctuatorTagsProvider
     */
    public function testCreateGetPunctuatorsGetTagReturnsInt(
        int $standard, 
        array $tokens
    ): void
    {
        $ctx = $this->sut->create($standard);
        $punctuators = $ctx->getPunctuators();
        
        foreach ($tokens as $lexeme => $tag) {
            self::assertSame($tag, $punctuators->getTag($lexeme));
        }
    }
    
    /**
     * Returns a data set of standards.
     * 
     * @return  array[] An associative array where the key is the data set name and the value is an indexed array where 
     *                  [0] is the standard to create the language context for.
     */
    public function getStandardsProvider(): array
    {
        $dataset = [];
        
        foreach (Specification::STANDARDS as $standard => $name) {
            $dataset[$name] = [ $standard ];
        }
        
        return $dataset;
    }
    
    /**
     * Returns a data set of a standard and the number of keywords.
     * 
     * @return  array[] An associative array where the key is the data set name and the value is an indexed array where 
     *                  [0] is the standard to create the language context for, and 
     *                  [1] is the expected number of keywords.
     */
    public function getKeywordCountsProvider(): array
    {
        return [
            'C++ 2003' => [ 1, 74, ], 
            'C++ 2011' => [ 2, 84, ], 
            'C++ 2014' => [ 4, 84, ], 
            'C++ 2017' => [ 8, 86, ], 
        ];
    }
    
    /**
     * Returns a data set of a standard, a keyword lexeme and a flag that 
     * indicates the lexeme is present.
     * 
     * @return  array[] An associative array where the key is the data set name and the value is an indexed array where 
     *                  [0] is the standard to create the language context for, and 
     *                  [1] is an indexed array of associative arrays where the key is the lexeme of the keyword and the value is the expected flag that indicates whether the keyword is present.
     */
    public function getKeywordAvailabilitiesProvider(): array
    {
        $dataset = [];
        
        foreach (Specification::STANDARDS as $standard => $name) {
            $tokens = [];
            
            foreach (Specification::KEYWORDS as list($lexeme, $tag, $keywordStandards)) {
                $tokens[$lexeme] = \in_array($standard, $keywordStandards, TRUE);
            }
            
            $dataset[$name] = [ $standard, $tokens, ];
        }
        
        return $dataset;
    }
    
    /**
     * Returns a data set of a standard, a keyword lexeme and a keyword tag.
     * 
     * @return  array[] An associative array where the key is the data set name and the value is an indexed array where 
     *                  [0] is the standard to create the language context for, and 
     *                  [1] is an indexed array of associative arrays where the key is the lexeme of the keyword and the value is the expected tag of the keyword.
     */
    public function getKeywordTagsProvider(): array
    {
        $dataset = [];
        
        foreach (Specification::STANDARDS as $standard => $name) {
            $tokens = [];
            
            foreach (Specification::KEYWORDS as list($lexeme, $tag, $keywordStandards)) {
                if (\in_array($standard, $keywordStandards, TRUE)) {
                    $tokens[$lexeme] = $tag;
                }
            }
            
            $dataset[$name] = [ $standard, $tokens, ];
        }
        
        return $dataset;
    }
    
    /**
     * Returns a data set of a standard and the number of punctuators.
     * 
     * @return  array[] An associative array where the key is the data set name and the value is an indexed array where 
     *                  [0] is the standard to create the language context for, and 
     *                  [1] is the expected number of punctuators.
     */
    public function getPunctuatorCountsProvider(): array
    {
        return [
            'C++ 2003' => [ 1, 51, ], 
            'C++ 2011' => [ 2, 51, ], 
            'C++ 2014' => [ 4, 51, ], 
            'C++ 2017' => [ 8, 52, ], 
        ];
    }
    
    /**
     * Returns a data set of a standard, a punctuator lexeme and a flag that 
     * indicates the lexeme is present.
     * 
     * @return  array[] An associative array where the key is the data set name and the value is an indexed array where 
     *                  [0] is the standard to create the language context for, and 
     *                  [1] is an indexed array of associative arrays where the key is the lexeme of the punctuator and the value is the expected flag that indicates whether the punctuator is present.
     */
    public function getPunctuatorAvailabilitiesProvider(): array
    {
        $dataset = [];
        
        foreach (Specification::STANDARDS as $standard => $name) {
            $tokens = [];
            
            foreach (Specification::PUNCTUATORS as list($lexeme, $tag, $punctuatorStandards)) {
                $tokens[$lexeme] = \in_array($standard, $punctuatorStandards, TRUE);
            }
            
            $dataset[$name] = [ $standard, $tokens, ];
        }
        
        return $dataset;
    }
    
    /**
     * Returns a data set of a standard, a punctuator lexeme and a punctuator 
     * tag.
     * 
     * @return  array[] An associative array where the key is the data set name and the value is an indexed array where 
     *                  [0] is the standard to create the language context for, and 
     *                  [1] is an indexed array of associative arrays where the key is the lexeme of the punctuator and the value is the expected tag of the punctuator.
     */
    public function getPunctuatorTagsProvider(): array
    {
        $dataset = [];
        
        foreach (Specification::STANDARDS as $standard => $name) {
            $tokens = [];
            
            foreach (Specification::PUNCTUATORS as list($lexeme, $tag, $punctuatorStandards)) {
                if (\in_array($standard, $punctuatorStandards, TRUE)) {
                    $tokens[$lexeme] = $tag;
                }
            }
            
            $dataset[$name] = [ $standard, $tokens, ];
        }
        
        return $dataset;
    }
}

