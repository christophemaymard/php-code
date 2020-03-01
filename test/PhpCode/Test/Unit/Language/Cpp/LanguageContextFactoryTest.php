<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp;

use PhpCode\Language\Cpp\LanguageContextFactory;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\LanguageContextFactory} 
 * class.
 * 
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
     * @param   string  $lexeme     The lexeme of the keyword.
     * @param   bool    $hasToken
     * 
     * @dataProvider    getKeywordAvailabilitiesProvider
     */
    public function testCreateGetKeywordsHasTokenReturnsBool(
        int $standard, 
        string $lexeme, 
        bool $hasToken
    ): void
    {
        $ctx = $this->sut->create($standard);
        
        self::assertSame($hasToken, $ctx->getKeywords()->hasToken($lexeme));
    }
    
    /**
     * Tests that getTag(), of the instance retrieved by getKeywords(), 
     * returns an integer.
     * 
     * @param   int     $standard   The standard to create the language context for.
     * @param   string  $lexeme     The lexeme of the keyword.
     * @param   int     $tag        The expected tag of the keyword.
     * 
     * @dataProvider    getKeywordTagsProvider
     */
    public function testCreateGetKeywordsGetTagReturnsInt(
        int $standard, 
        string $lexeme, 
        int $tag
    ): void
    {
        $ctx = $this->sut->create($standard);
        
        self::assertSame($tag, $ctx->getKeywords()->getTag($lexeme));
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
     * @param   string  $lexeme     The lexeme of the punctuator.
     * @param   bool    $hasToken
     * 
     * @dataProvider    getPunctuatorAvailabilitiesProvider
     */
    public function testCreateGetPunctuatorsHasTokenReturnsBool(
        int $standard, 
        string $lexeme, 
        bool $hasToken
    ): void
    {
        $ctx = $this->sut->create($standard);
        
        self::assertSame($hasToken, $ctx->getPunctuators()->hasToken($lexeme));
    }
    
    /**
     * Tests that getTag(), of the instance retrieved by getPunctuators(), 
     * returns an integer.
     * 
     * @param   int     $standard   The standard to create the language context for.
     * @param   string  $lexeme     The lexeme of the punctuator.
     * @param   int     $tag        The expected tag of the punctuator.
     * 
     * @dataProvider    getPunctuatorTagsProvider
     */
    public function testCreateGetPunctuatorsGetTagReturnsInt(
        int $standard, 
        string $lexeme, 
        int $tag
    ): void
    {
        $ctx = $this->sut->create($standard);
        
        self::assertSame($tag, $ctx->getPunctuators()->getTag($lexeme));
    }
    
    /**
     * Returns a data set of standards.
     * 
     * @return  array[] An indexed array of arrays where
     *                  [0] is the standard to create the language context for.
     */
    public function getStandardsProvider(): array
    {
        $dataset = [];
        
        foreach ($this->getStandards() as $standard) {
            $dataset[] = [ $standard ];
        }
        
        return $dataset;
    }
    
    /**
     * Returns a data set of a standard and the number of keywords.
     * 
     * @return  array[] An indexed array of arrays where
     *                  [0] is the standard to create the language context for, and 
     *                  [1] is the expected number of keywords.
     */
    public function getKeywordCountsProvider(): array
    {
        return [
            [ 1, 0, ], 
            [ 2, 0, ], 
            [ 4, 0, ], 
            [ 8, 0, ], 
        ];
    }
    
    /**
     * Returns a data set of a standard, a keyword lexeme and a flag that 
     * indicates the lexeme is present.
     * 
     * @return  array[] An indexed array of arrays where
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the lexeme of the keyword, and 
     *                  [2] is a flag that indicates the lexeme is present.
     */
    public function getKeywordAvailabilitiesProvider(): array
    {
        $dataset = [];
        $standards = $this->getStandards();
        
        foreach ($this->getKeywords() as list($lexeme, $tag, $keywordStandards)) {
            foreach ($standards as $standard) {
                $dataset[] = [
                    $standard, 
                    $lexeme, 
                    \in_array($standard, $keywordStandards, TRUE), 
                ];
            }
        }
        
        return $dataset;
    }
    
    /**
     * Returns a data set of a standard, a keyword lexeme and a keyword tag.
     * 
     * @return  array[] An indexed array of arrays where
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the lexeme of the keyword, and 
     *                  [2] is the expected tag of the keyword.
     */
    public function getKeywordTagsProvider(): array
    {
        $dataset = [];
        $standards = $this->getStandards();
        
        foreach ($this->getKeywords() as list($lexeme, $tag, $keywordStandards)) {
            foreach ($standards as $standard) {
                if (\in_array($standard, $keywordStandards, TRUE)) {
                    $dataset[] = [ $standard, $lexeme, $tag, ];
                }
            }
        }
        
        return $dataset;
    }
    
    /**
     * Returns a data set of a standard and the number of punctuators.
     * 
     * @return  array[] An indexed array of arrays where
     *                  [0] is the standard to create the language context for, and 
     *                  [1] is the expected number of punctuators.
     */
    public function getPunctuatorCountsProvider(): array
    {
        return [
            [ 1, 0, ], 
            [ 2, 0, ], 
            [ 4, 0, ], 
            [ 8, 0, ], 
        ];
    }
    
    /**
     * Returns a data set of a standard, a punctuator lexeme and a flag that 
     * indicates the lexeme is present.
     * 
     * @return  array[] An indexed array of arrays where
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the lexeme of the punctuator, and 
     *                  [2] is a flag that indicates the lexeme is present.
     */
    public function getPunctuatorAvailabilitiesProvider(): array
    {
        $dataset = [];
        $standards = $this->getStandards();
        
        foreach ($this->getPunctuators() as list($lexeme, $tag, $punctuatorStandards)) {
            foreach ($standards as $standard) {
                $dataset[] = [
                    $standard, 
                    $lexeme, 
                    \in_array($standard, $punctuatorStandards, TRUE), 
                ];
            }
        }
        
        return $dataset;
    }
    
    /**
     * Returns a data set of a standard, a punctuator lexeme and a punctuator 
     * tag.
     * 
     * @return  array[] An indexed array of arrays where
     *                  [0] is the standard to create the language context for, 
     *                  [1] is the lexeme of the punctuator, and 
     *                  [2] is the expected tag of the punctuator.
     */
    public function getPunctuatorTagsProvider(): array
    {
        $dataset = [];
        $standards = $this->getStandards();
        
        foreach ($this->getPunctuators() as list($lexeme, $tag, $punctuatorStandards)) {
            foreach ($standards as $standard) {
                if (\in_array($standard, $punctuatorStandards, TRUE)) {
                    $dataset[] = [ $standard, $lexeme, $tag, ];
                }
            }
        }
        
        return $dataset;
    }
    
    /**
     * Returns all the standards.
     * 
     * @return  int[]
     */
    private function getStandards(): array
    {
        return [
            1,  // C++ 2003
            2,  // C++ 2011
            4,  // C++ 2014
            8,  // C++ 2017
        ];
    }
    
    /**
     * Returns all the keyword specifications.
     * 
     * @return  array[] An indexed array of arrays where
     *                  [0] is the lexeme of the keyword, 
     *                  [1] is the tag of the keyword, and 
     *                  [2] is the standards that support the keyword. 
     */
    private function getKeywords(): array
    {
        return [
        ];
    }
    
    /**
     * Returns all the punctuator specifications.
     * 
     * @return  array[] An indexed array of arrays where
     *                  [0] is the lexeme of the punctuator, 
     *                  [1] is the tag of the punctuator, and 
     *                  [2] is the standards that support the punctuator.
     */
    private function getPunctuators(): array
    {
        return [
        ];
    }
}

