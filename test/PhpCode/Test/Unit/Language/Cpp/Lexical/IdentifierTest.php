<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Lexical;

use PhpCode\Language\Cpp\Lexical\Identifier;
use PhpCode\Exception\InvalidValueException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Lexical\Identifier} 
 * class.
 * 
 * @group   lexical
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class IdentifierTest extends TestCase
{
    /**
     * Tests that __construct() throws an exception when the specified 
     * identifier is invalid.
     * 
     * @param   string  $id The identifier to test.
     * 
     * @dataProvider    getInvalidIdentifiersProvider
     */
    public function test__constructThrowsExceptionWhenIdentifierIsInvalid(string $id): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            \sprintf('"%s" is an invalid identifier.', $id)
        );
        
        $sut = new Identifier($id);
    }
    
    /**
     * Tests that __construct() stores the identifier when the specified 
     * identifier is valid.
     * 
     * @param   string  $id The identifier to test.
     * 
     * @dataProvider    getValidIdentifiersProvider
     */
    public function test__constructStoresIdentifierWhenIdentifierIsValid(string $id): void
    {
        $sut = new Identifier($id);
        self::assertSame($id, $sut->getIdentifier());
    }
    
    /**
     * Returns a set of invalid identifiers.
     * 
     * @return  array[]
     */
    public function getInvalidIdentifiersProvider(): array
    {
        return [
            'Empty string' => [ '', ], 
            'Starts with invalid character' => [ 'é', ], 
            'Starts with digit' => [ '0foo', ], 
            'Contains invalid character' => [ 'fooé', ], 
        ];
    }
    
    /**
     * Returns a set of valid identifiers.
     * 
     * @return  array[]
     */
    public function getValidIdentifiersProvider(): array
    {
        return [
            '_' => [ '_', ], 
            '1 letter (lower case)' => [ 'c', ], 
            '1 letter (upper case)' => [ 'M', ], 
            'Contains digit after the first character' => [ 'f9', ], 
        ];
    }
}

