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
            [ 1, 74, ], 
            [ 2, 84, ], 
            [ 4, 84, ], 
            [ 8, 86, ], 
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
            [ 'alignas', 101000, [ 2, 4, 8, ], ], 
            [ 'alignof', 102000, [ 2, 4, 8, ], ], 
            [ 'and', 103000, [ 1, 2, 4, 8, ], ], 
            [ 'and_eq', 104000, [ 1, 2, 4, 8, ], ], 
            [ 'asm', 105000, [ 1, 2, 4, 8, ], ], 
            [ 'auto', 106000, [ 1, 2, 4, 8, ], ], 
            [ 'bitand', 107000, [ 1, 2, 4, 8, ], ], 
            [ 'bitor', 108000, [ 1, 2, 4, 8, ], ], 
            [ 'bool', 109000, [ 1, 2, 4, 8, ], ], 
            [ 'break', 110000, [ 1, 2, 4, 8, ], ], 
            [ 'case', 111000, [ 1, 2, 4, 8, ], ], 
            [ 'catch', 112000, [ 1, 2, 4, 8, ], ], 
            [ 'char', 113000, [ 1, 2, 4, 8, ], ], 
            [ 'char16_t', 114000, [ 2, 4, 8, ], ], 
            [ 'char32_t', 115000, [ 2, 4, 8, ], ], 
            [ 'class', 116000, [ 1, 2, 4, 8, ], ], 
            [ 'compl', 117000, [ 1, 2, 4, 8, ], ], 
            [ 'concept', 118000, [ 8, ], ], 
            [ 'const', 119000, [ 1, 2, 4, 8, ], ], 
            [ 'const_cast', 120000, [ 1, 2, 4, 8, ], ], 
            [ 'constexpr', 121000, [ 2, 4, 8, ], ], 
            [ 'continue', 122000, [ 1, 2, 4, 8, ], ], 
            [ 'decltype', 123000, [ 2, 4, 8, ], ], 
            [ 'default', 124000, [ 1, 2, 4, 8, ], ], 
            [ 'delete', 125000, [ 1, 2, 4, 8, ], ], 
            [ 'do', 126000, [ 1, 2, 4, 8, ], ], 
            [ 'double', 127000, [ 1, 2, 4, 8, ], ], 
            [ 'dynamic_cast', 128000, [ 1, 2, 4, 8, ], ], 
            [ 'else', 129000, [ 1, 2, 4, 8, ], ], 
            [ 'enum', 130000, [ 1, 2, 4, 8, ], ], 
            [ 'explicit', 131000, [ 1, 2, 4, 8, ], ], 
            [ 'export', 132000, [ 1, 2, 4, 8, ], ], 
            [ 'extern', 133000, [ 1, 2, 4, 8, ], ], 
            [ 'false', 134000, [ 1, 2, 4, 8, ], ], 
            [ 'float', 135000, [ 1, 2, 4, 8, ], ], 
            [ 'for', 136000, [ 1, 2, 4, 8, ], ], 
            [ 'friend', 137000, [ 1, 2, 4, 8, ], ], 
            [ 'goto', 138000, [ 1, 2, 4, 8, ], ], 
            [ 'if', 139000, [ 1, 2, 4, 8, ], ], 
            [ 'inline', 140000, [ 1, 2, 4, 8, ], ], 
            [ 'int', 141000, [ 1, 2, 4, 8, ], ], 
            [ 'long', 142000, [ 1, 2, 4, 8, ], ], 
            [ 'mutable', 143000, [ 1, 2, 4, 8, ], ], 
            [ 'namespace', 144000, [ 1, 2, 4, 8, ], ], 
            [ 'new', 145000, [ 1, 2, 4, 8, ], ], 
            [ 'noexcept', 146000, [ 2, 4, 8, ], ], 
            [ 'not', 147000, [ 1, 2, 4, 8, ], ], 
            [ 'not_eq', 148000, [ 1, 2, 4, 8, ], ], 
            [ 'nullptr', 149000, [ 2, 4, 8, ], ], 
            [ 'operator', 150000, [ 1, 2, 4, 8, ], ], 
            [ 'or', 151000, [ 1, 2, 4, 8, ], ], 
            [ 'or_eq', 152000, [ 1, 2, 4, 8, ], ], 
            [ 'private', 153000, [ 1, 2, 4, 8, ], ], 
            [ 'protected', 154000, [ 1, 2, 4, 8, ], ], 
            [ 'public', 155000, [ 1, 2, 4, 8, ], ], 
            [ 'register', 156000, [ 1, 2, 4, 8, ], ], 
            [ 'reinterpret_cast', 157000, [ 1, 2, 4, 8, ], ], 
            [ 'requires', 158000, [ 8, ], ], 
            [ 'return', 159000, [ 1, 2, 4, 8, ], ], 
            [ 'short', 160000, [ 1, 2, 4, 8, ], ], 
            [ 'signed', 161000, [ 1, 2, 4, 8, ], ], 
            [ 'sizeof', 162000, [ 1, 2, 4, 8, ], ], 
            [ 'static', 163000, [ 1, 2, 4, 8, ], ], 
            [ 'static_assert', 164000, [ 2, 4, 8, ], ], 
            [ 'static_cast', 165000, [ 1, 2, 4, 8, ], ], 
            [ 'struct', 166000, [ 1, 2, 4, 8, ], ], 
            [ 'switch', 167000, [ 1, 2, 4, 8, ], ], 
            [ 'template', 168000, [ 1, 2, 4, 8, ], ], 
            [ 'this', 169000, [ 1, 2, 4, 8, ], ], 
            [ 'thread_local', 170000, [ 2, 4, 8, ], ], 
            [ 'throw', 171000, [ 1, 2, 4, 8, ], ], 
            [ 'true', 172000, [ 1, 2, 4, 8, ], ], 
            [ 'try', 173000, [ 1, 2, 4, 8, ], ], 
            [ 'typedef', 174000, [ 1, 2, 4, 8, ], ], 
            [ 'typeid', 175000, [ 1, 2, 4, 8, ], ], 
            [ 'typename', 176000, [ 1, 2, 4, 8, ], ], 
            [ 'union', 177000, [ 1, 2, 4, 8, ], ], 
            [ 'unsigned', 178000, [ 1, 2, 4, 8, ], ], 
            [ 'using', 179000, [ 1, 2, 4, 8, ], ], 
            [ 'virtual', 180000, [ 1, 2, 4, 8, ], ], 
            [ 'void', 181000, [ 1, 2, 4, 8, ], ], 
            [ 'volatile', 182000, [ 1, 2, 4, 8, ], ], 
            [ 'wchar_t', 183000, [ 1, 2, 4, 8, ], ], 
            [ 'while', 184000, [ 1, 2, 4, 8, ], ], 
            [ 'xor', 185000, [ 1, 2, 4, 8, ], ], 
            [ 'xor_eq', 186000, [ 1, 2, 4, 8, ], ], 
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

