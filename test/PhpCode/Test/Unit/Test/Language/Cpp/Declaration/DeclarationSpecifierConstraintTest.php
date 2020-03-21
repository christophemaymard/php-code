<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\DeclarationSpecifier;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierConstraint;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierDoubleFactory;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierConstraint} 
 * class.
 * 
 * @group   declaration
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclarationSpecifierConstraintTest extends TestCase
{
    /**
     * @var DeclarationSpecifierDoubleFactory
     */
    private $declSpecFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->declSpecFactory = new DeclarationSpecifierDoubleFactory($this);
    }
    
    /**
     * Tests that __construct() throws an exception.
     */
    public function test__constructThrowsException(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        $sut = new DeclarationSpecifierConstraint();
    }
    /**
     * Tests that toString() returns a string when the instance is created 
     * by createInt().
     */
    public function testToStringReturnsStringWhenCreateInt(): void
    {
        $sut = DeclarationSpecifierConstraint::createInt();
        self::assertSame('declaration specifier', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string when the instance is 
     * created by createInt().
     */
    public function testGetConceptNameReturnsStringWhenCreateInt(): void
    {
        $sut = DeclarationSpecifierConstraint::createInt();
        self::assertSame('Declaration specifier', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when the instance 
     * is created by createInt().
     */
    public function testFailureDefaultReasonReturnsStringWhenCreateInt(): void
    {
        $sut = DeclarationSpecifierConstraint::createInt();
        self::assertSame('Declaration specifier: Unknown reason.', $sut->failureDefaultReason(NULL));
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createInt().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateInt(): void
    {
        $sut = DeclarationSpecifierConstraint::createInt();
        self::assertSame(
            "Declaration specifier\n  Simple type specifier \"int\"", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createInt() and not instance of DeclarationSpecifier.
     */
    public function testMatchesReturnsFalseWhenCreateIntAndNotInstanceDeclarationSpecifier(): void
    {
        $sut = DeclarationSpecifierConstraint::createInt();
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createInt() and not simple type specifier "int".
     */
    public function testMatchesReturnsFalseWhenCreateIntAndNotSimpleTypeSpecifierInt(): void
    {
        $declSpec = $this->createDeclarationSpecifierIntDouble(FALSE);
        
        $sut = DeclarationSpecifierConstraint::createInt();
        self::assertFalse($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createInt() and simple type specifier "int".
     */
    public function testMatchesReturnsTrueWhenCreateIntAndSimpleTypeSpecifierInt(): void
    {
        $declSpec = $this->createDeclarationSpecifierIntDouble(TRUE);
        
        $sut = DeclarationSpecifierConstraint::createInt();
        self::assertTrue($sut->matches($declSpec));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createInt() and not instance of DeclarationSpecifier.
     */
    public function testFailureReasonReturnsStringWhenCreateIntAndNotInstanceDeclarationSpecifier(): void
    {
        $sut = DeclarationSpecifierConstraint::createInt();
        self::assertRegExp(
            \sprintf(
                '`^Declaration specifier: .+ is not an instance of %s\\.$`', 
                \str_replace('\\', '\\\\', DeclarationSpecifier::class)
            ), 
            $sut->failureReason(NULL)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createInt() and is not a simple type specifier "int".
     */
    public function testFailureReasonReturnsStringWhenCreateIntAndNotSimpleTypeSpecifierInt(): void
    {
        $declSpec = $this->createDeclarationSpecifierIntDouble(FALSE);
        
        $sut = DeclarationSpecifierConstraint::createInt();
        self::assertSame(
            'Declaration specifier: It should be simple type specifier "int".', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createInt() and is a simple type specifier "int".
     */
    public function testFailureReasonReturnsStringWhenCreateIntAndSimpleTypeSpecifierInt(): void
    {
        $declSpec = $this->createDeclarationSpecifierIntDouble(TRUE);
        
        $sut = DeclarationSpecifierConstraint::createInt();
        self::assertSame(
            'Declaration specifier: Unknown reason.', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createInt() and not instance of 
     * DeclarationSpecifier.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateIntAndNotInstanceDeclarationSpecifier(): void
    {
        $sut = DeclarationSpecifierConstraint::createInt();
        
        $pattern = \sprintf(
            "`^\n".
            "Declaration specifier\n".
            "  Simple type specifier \"int\"\n\n".
            "Declaration specifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', DeclarationSpecifier::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createInt() and is not a simple type specifier 
     * "int".
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateIntAndNotSimpleTypeSpecifierInt(): void
    {
        $declSpec = $this->createDeclarationSpecifierIntDouble(FALSE);
        
        $sut = DeclarationSpecifierConstraint::createInt();
        self::assertSame(
            "\n".
            "Declaration specifier\n".
            "  Simple type specifier \"int\"\n\n".
            'Declaration specifier: It should be simple type specifier "int".', 
            $sut->additionalFailureDescription($declSpec)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createInt() and is a simple type specifier 
     * "int".
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateIntAndSimpleTypeSpecifierInt(): void
    {
        $declSpec = $this->createDeclarationSpecifierIntDouble(TRUE);
        
        $sut = DeclarationSpecifierConstraint::createInt();
        self::assertSame(
            "\n".
            "Declaration specifier\n".
            "  Simple type specifier \"int\"\n\n".
            'Declaration specifier: Unknown reason.', 
            $sut->additionalFailureDescription($declSpec)
        );
    }
    
    /**
     * Tests that failureDescription() is called when the instance is created 
     * by createInt() and a value is invalid.
     */
    public function testFailureDescriptionWhenCreateIntAndInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a declaration specifier`');
        
        $sut = DeclarationSpecifierConstraint::createInt();
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Creates a double of the {@see PhpCode\Language\Cpp\Declaration\DeclarationSpecifier} 
     * class, that is a simple type specifier.
     * 
     * @param   bool    $isInt  The value returned by isInt().
     * @return ProphecySubjectInterface
     */
    private function createDeclarationSpecifierIntDouble(bool $isInt): ProphecySubjectInterface
    {
        $stSpec = ConceptDoubleBuilder::createSimpleTypeSpecifier($this)
            ->buildIsInt($isInt)
            ->getDouble();
        
        $typeSpec = ConceptDoubleBuilder::createTypeSpecifier($this)
            ->buildGetSimpleTypeSpecifier($stSpec)
            ->getDouble();
        
        $defTypeSpec = ConceptDoubleBuilder::createDefiningTypeSpecifier($this)
            ->buildGetTypeSpecifier($typeSpec)
            ->getDouble();
        
        return $this->declSpecFactory->createGetDefiningTypeSpecifier($defTypeSpec);
    }
}

