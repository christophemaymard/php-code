<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Parsing;

use PhpCode\Exception\ArgumentException;
use PhpCode\Test\Language\Cpp\ConceptConstraintFactoryInterface;
use PhpCode\Test\Language\Cpp\Parsing\ValidData;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Parsing\ValidData} 
 * class.
 * 
 * @group   parsing
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ValidDataTest extends TestCase
{
    /**
     * Tests that _construct() throws an exception when the stream does not 
     * start with the first token lexeme.
     */
    public function test__constructThrowsExceptionWhenStreamDoesNotStartWithFirstTokenLexeme(): void
    {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('The stream "foo" must start with the lexeme "bar".');
        $constraintFactory = $this->prophesize(ConceptConstraintFactoryInterface::class)->reveal();
        
        $sut = new ValidData('foo', $constraintFactory, 'bar');
    }
    
    /**
     * Tests that _construct() stores the stream and the factory of 
     * constraints.
     */
    public function test__construct(): void
    {
        $constraintFactory = $this->prophesize(ConceptConstraintFactoryInterface::class)->reveal();
        
        $sut = new ValidData('foo', $constraintFactory, 'foo');
        self::assertSame('foo', $sut->getStream());
        self::assertSame($constraintFactory, $sut->getConstraintFactory());
        self::assertSame('foo', $sut->getFirstTokenLexeme());
    }
    
    /**
     * Tests that getName() returns a string.
     */
    public function testGetNameReturnsString(): void
    {
        $constraintFactory = $this->prophesize(ConceptConstraintFactoryInterface::class)->reveal();
        
        $sut = new ValidData('foo', $constraintFactory, 'foo');
        self::assertSame('', $sut->getName());
        
        $sut->setName('bar');
        self::assertSame('bar', $sut->getName());
        
        $sut->setName('baz');
        self::assertSame('baz', $sut->getName());
        
        $sut->setName('');
        self::assertSame('', $sut->getName());
    }
    
    /**
     * Tests that hasName() returns FALSE when the name is not an empty 
     * string, otherwise FALSE.
     */
    public function testHasNameReturnsBool(): void
    {
        $constraintFactory = $this->prophesize(ConceptConstraintFactoryInterface::class)->reveal();
        
        $sut = new ValidData('foo', $constraintFactory, 'foo');
        self::assertFalse($sut->hasName());
        
        $sut->setName('bar');
        self::assertTrue($sut->hasName());
        
        $sut->setName('baz');
        self::assertTrue($sut->hasName());
        
        $sut->setName('');
        self::assertFalse($sut->hasName());
    }
    
    /**
     * Tests that getStandards() returns an indexed array of integers.
     */
    public function testGetStandardsReturnsArrayInt(): void
    {
        $constraintFactory = $this->prophesize(ConceptConstraintFactoryInterface::class)->reveal();
        
        $sut = new ValidData('foo', $constraintFactory, 'foo');
        self::assertSame([1, 2, 4, 8], $sut->getStandards());
    }
    
    /**
     * Tests that getToken() returns an indexed array with 2 elements.
     */
    public function testGetTokenReturnsArray(): void
    {
        $constraintFactory = $this->prophesize(ConceptConstraintFactoryInterface::class)->reveal();
        
        $sut = new ValidData('foo', $constraintFactory, 'foo');
        self::assertSame(['', 0], $sut->getToken());
        
        $sut->setToken('bar', 2);
        self::assertSame(['bar', 2], $sut->getToken());
        
        $sut->setToken('baz', 9);
        self::assertSame(['baz', 9], $sut->getToken());
    }
}

