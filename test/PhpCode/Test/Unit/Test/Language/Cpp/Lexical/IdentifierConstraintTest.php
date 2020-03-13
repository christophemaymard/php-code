<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Lexical;

use PhpCode\Language\Cpp\Lexical\Identifier;
use PhpCode\Test\Language\Cpp\Lexical\IdentifierConstraint;
use PhpCode\Test\Language\Cpp\Lexical\IdentifierDoubleFactory;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Lexical\IdentifierConstraint} 
 * class.
 * 
 * @group   lexical
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class IdentifierConstraintTest extends TestCase
{
    /**
     * @var IdentifierDoubleFactory
     */
    private $idFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->idFactory =  new IdentifierDoubleFactory($this);
    }
    
    /**
     * Tests that toString() returns a string.
     */
    public function testToStringReturnsString(): void
    {
        $sut = new IdentifierConstraint('foo');
        self::assertSame('identifier', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string.
     */
    public function testGetConceptNameReturnsString(): void
    {
        $sut = new IdentifierConstraint('foo');
        self::assertSame('Identifier', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string.
     */
    public function testFailureDefaultReasonReturnsString(): void
    {
        $sut = new IdentifierConstraint('foo');
        self::assertSame('Identifier: Unknown reason.', $sut->failureDefaultReason(NULL));
    }
    
    /**
     * Tests that constraintDescription() returns a string.
     */
    public function testConstraintDescriptionReturnsString(): void
    {
        $sut = new IdentifierConstraint('foo');
        self::assertSame('Identifier "foo"', $sut->constraintDescription());
    }
    
    /**
     * Tests that matches() returns FALSE when not instance of Identifier.
     */
    public function testMatchesReturnsFalseWhenNotInstanceIdentifier(): void
    {
        $sut = new IdentifierConstraint('foo');
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when not same identifier.
     */
    public function testMatchesReturnsFalseWhenNotSameIdentifier(): void
    {
        $id = $this->idFactory->createGetIdentifier('bar');
        
        $sut = new IdentifierConstraint('foo');
        self::assertFalse($sut->matches($id));
    }
    
    /**
     * Tests that matches() returns TRUE when same identifier.
     */
    public function testMatchesReturnsTrueWhenSameIdentifier(): void
    {
        $id = $this->idFactory->createGetIdentifier('foo');
        
        $sut = new IdentifierConstraint('foo');
        self::assertTrue($sut->matches($id));
    }
    
    /**
     * Tests that failureReason() returns a string when not instance of 
     * Identifier.
     */
    public function testFailureReasonReturnsStringWhenNotInstanceIdentifier(): void
    {
        $sut = new IdentifierConstraint('foo');
        self::assertRegExp(
            \sprintf(
                '`^Identifier: .+ is not an instance of %s\\.$`', 
                \str_replace('\\', '\\\\', Identifier::class)
            ), 
            $sut->failureReason(NULL)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when not same identifier.
     */
    public function testFailureReasonReturnsStringWhenNotSameIdentifier(): void
    {
        $id = $this->idFactory->createGetIdentifier('bar');
        
        $sut = new IdentifierConstraint('foo');
        self::assertSame(
            'Identifier: "bar" does not match identifier "foo".', 
            $sut->failureReason($id)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when same identifier.
     */
    public function testFailureReasonReturnsStringWhenSameIdentifier(): void
    {
        $id = $this->idFactory->createGetIdentifier('foo');
        
        $sut = new IdentifierConstraint('foo');
        self::assertSame('Identifier: Unknown reason.', $sut->failureReason($id));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when not 
     * instance of Identifier.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenNotInstanceIdentifier(): void
    {
        $sut = new IdentifierConstraint('foo');
        
        $pattern = \sprintf(
            "`^\nIdentifier \"foo\"\n\nIdentifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', Identifier::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when not 
     * same identifier.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenNotSameIdentifier(): void
    {
        $id = $this->idFactory->createGetIdentifier('bar');
        
        $sut = new IdentifierConstraint('foo');
        self::assertSame(
            "\nIdentifier \"foo\"\n\nIdentifier: \"bar\" does not match identifier \"foo\".", 
            $sut->additionalFailureDescription($id)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when same 
     * identifier.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenSameIdentifier(): void
    {
        $id = $this->idFactory->createGetIdentifier('foo');
        
        $sut = new IdentifierConstraint('foo');
        self::assertSame(
            "\nIdentifier \"foo\"\n\nIdentifier: Unknown reason.", 
            $sut->additionalFailureDescription($id)
        );
    }
    
    /**
     * Tests that failureDescription() is called when a value is invalid.
     */
    public function testFailureDescriptionWhenInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is an identifier`');
        
        $sut = new IdentifierConstraint('foo');
        $sut->evaluate(NULL, '', FALSE);
    }
}

