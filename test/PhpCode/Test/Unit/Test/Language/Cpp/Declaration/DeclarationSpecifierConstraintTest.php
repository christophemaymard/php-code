<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\DeclarationSpecifier;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierConstraint;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierDoubleFactory;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

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
     * Tests that __construct() throws an exception.
     */
    public function test__constructThrowsException(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        $sut = new DeclarationSpecifierConstraint();
    }
    
    /**
     * Tests that toString() returns a string.
     * 
     * @param   DeclarationSpecifierConstraint  $sut    The system under test.
     * 
     * @dataProvider    getSutProvider
     */
    public function testToStringReturnsString(
        DeclarationSpecifierConstraint $sut
    ): void
    {
        self::assertSame('declaration specifier', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string.
     * 
     * @param   DeclarationSpecifierConstraint  $sut    The system under test.
     * 
     * @dataProvider    getSutProvider
     */
    public function testGetConceptNameReturnsString(
        DeclarationSpecifierConstraint $sut
    ): void
    {
        self::assertSame('Declaration specifier', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string.
     * 
     * @param   DeclarationSpecifierConstraint  $sut    The system under test.
     * 
     * @dataProvider    getSutProvider
     */
    public function testFailureDefaultReasonReturnsString(
        DeclarationSpecifierConstraint $sut
    ): void
    {
        self::assertSame(
            'Declaration specifier: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createInt().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateInt(): void
    {
        $sut = DeclarationSpecifierConstraint::createInt();
        self::assertSame(
            "Declaration specifier\n".
            "  Simple type specifier \"int\"", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createFloat().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateFloat(): void
    {
        $sut = DeclarationSpecifierConstraint::createFloat();
        self::assertSame(
            "Declaration specifier\n".
            "  Simple type specifier \"float\"", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createBool().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateBool(): void
    {
        $sut = DeclarationSpecifierConstraint::createBool();
        self::assertSame(
            "Declaration specifier\n".
            "  Simple type specifier \"bool\"", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createChar().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateChar(): void
    {
        $sut = DeclarationSpecifierConstraint::createChar();
        self::assertSame(
            "Declaration specifier\n".
            "  Simple type specifier \"char\"", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when not instance of 
     * DeclarationSpecifier.
     * 
     * @param   DeclarationSpecifierConstraint  $sut    The system under test.
     * 
     * @dataProvider    getSutProvider
     */
    public function testMatchesReturnsFalseWhenNotInstanceDeclarationSpecifier(
        DeclarationSpecifierConstraint $sut
    ): void
    {
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createInt() and not simple type specifier "int".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierIntProvider
     */
    public function testMatchesReturnsFalseWhenCreateIntAndNotSimpleTypeSpecifierInt(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createInt();
        self::assertFalse($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createFloat() and not simple type specifier "float".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierFloatProvider
     */
    public function testMatchesReturnsFalseWhenCreateFloatAndNotSimpleTypeSpecifierFloat(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createFloat();
        self::assertFalse($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createBool() and not simple type specifier "bool".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierBoolProvider
     */
    public function testMatchesReturnsFalseWhenCreateBoolAndNotSimpleTypeSpecifierBool(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createBool();
        self::assertFalse($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createChar() and not simple type specifier "char".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierCharProvider
     */
    public function testMatchesReturnsFalseWhenCreateCharAndNotSimpleTypeSpecifierChar(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createChar();
        self::assertFalse($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createInt() and simple type specifier "int".
     */
    public function testMatchesReturnsTrueWhenCreateIntAndSimpleTypeSpecifierInt(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createIntSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createInt();
        self::assertTrue($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createFloat() and simple type specifier "float".
     */
    public function testMatchesReturnsTrueWhenCreateFloatAndSimpleTypeSpecifierFloat(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createFloatSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createFloat();
        self::assertTrue($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createBool() and simple type specifier "bool".
     */
    public function testMatchesReturnsTrueWhenCreateBoolAndSimpleTypeSpecifierBool(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createBoolSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createBool();
        self::assertTrue($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createChar() and simple type specifier "char".
     */
    public function testMatchesReturnsTrueWhenCreateCharAndSimpleTypeSpecifierChar(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createCharSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createChar();
        self::assertTrue($sut->matches($declSpec));
    }
    
    /**
     * Tests that failureReason() returns a string when not instance of 
     * DeclarationSpecifier.
     * 
     * @param   DeclarationSpecifierConstraint  $sut    The system under test.
     * 
     * @dataProvider    getSutProvider
     */
    public function testFailureReasonReturnsStringWhenNotInstanceDeclarationSpecifier(
        DeclarationSpecifierConstraint $sut
    ): void
    {
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
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierIntProvider
     */
    public function testFailureReasonReturnsStringWhenCreateIntAndNotSimpleTypeSpecifierInt(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createInt();
        self::assertSame(
            'Declaration specifier: It should be simple type specifier "int".', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createFloat() and is not a simple type specifier "float".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierFloatProvider
     */
    public function testFailureReasonReturnsStringWhenCreateFloatAndNotSimpleTypeSpecifierFloat(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createFloat();
        self::assertSame(
            'Declaration specifier: It should be simple type specifier "float".', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createBool() and is not a simple type specifier "bool".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierBoolProvider
     */
    public function testFailureReasonReturnsStringWhenCreateBoolAndNotSimpleTypeSpecifierBool(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createBool();
        self::assertSame(
            'Declaration specifier: It should be simple type specifier "bool".', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createChar() and is not a simple type specifier "char".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierCharProvider
     */
    public function testFailureReasonReturnsStringWhenCreateCharAndNotSimpleTypeSpecifierChar(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createChar();
        self::assertSame(
            'Declaration specifier: It should be simple type specifier "char".', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createInt() and is a simple type specifier "int".
     */
    public function testFailureReasonReturnsStringWhenCreateIntAndSimpleTypeSpecifierInt(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createIntSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createInt();
        self::assertSame(
            'Declaration specifier: Unknown reason.', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createFloat() and is a simple type specifier "float".
     */
    public function testFailureReasonReturnsStringWhenCreateFloatAndSimpleTypeSpecifierFloat(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createFloatSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createFloat();
        self::assertSame(
            'Declaration specifier: Unknown reason.', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createBool() and is a simple type specifier "bool".
     */
    public function testFailureReasonReturnsStringWhenCreateBoolAndSimpleTypeSpecifierBool(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createBoolSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createBool();
        self::assertSame(
            'Declaration specifier: Unknown reason.', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createChar() and is a simple type specifier "char".
     */
    public function testFailureReasonReturnsStringWhenCreateCharAndSimpleTypeSpecifierChar(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createCharSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createChar();
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
            "  Simple type specifier \"int\"\n".
            "\n".
            "Declaration specifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', DeclarationSpecifier::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createFloat() and not instance of 
     * DeclarationSpecifier.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateFloatAndNotInstanceDeclarationSpecifier(): void
    {
        $sut = DeclarationSpecifierConstraint::createFloat();
        
        $pattern = \sprintf(
            "`^\n".
            "Declaration specifier\n".
            "  Simple type specifier \"float\"\n".
            "\n".
            "Declaration specifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', DeclarationSpecifier::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createBool() and not instance of 
     * DeclarationSpecifier.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateBoolAndNotInstanceDeclarationSpecifier(): void
    {
        $sut = DeclarationSpecifierConstraint::createBool();
        
        $pattern = \sprintf(
            "`^\n".
            "Declaration specifier\n".
            "  Simple type specifier \"bool\"\n".
            "\n".
            "Declaration specifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', DeclarationSpecifier::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createChar() and not instance of 
     * DeclarationSpecifier.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateCharAndNotInstanceDeclarationSpecifier(): void
    {
        $sut = DeclarationSpecifierConstraint::createChar();
        
        $pattern = \sprintf(
            "`^\n".
            "Declaration specifier\n".
            "  Simple type specifier \"char\"\n".
            "\n".
            "Declaration specifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', DeclarationSpecifier::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createInt() and is not a simple type specifier 
     * "int".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierIntProvider
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateIntAndNotSimpleTypeSpecifierInt(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createInt();
        self::assertSame(
            "\n".
            "Declaration specifier\n".
            "  Simple type specifier \"int\"\n".
            "\n".
            "Declaration specifier: It should be simple type specifier \"int\".", 
            $sut->additionalFailureDescription($declSpec)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createFloat() and is not a simple type specifier 
     * "float".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierFloatProvider
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateFloatAndNotSimpleTypeSpecifierFloat(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createFloat();
        self::assertSame(
            "\n".
            "Declaration specifier\n".
            "  Simple type specifier \"float\"\n".
            "\n".
            "Declaration specifier: It should be simple type specifier \"float\".", 
            $sut->additionalFailureDescription($declSpec)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createBool() and is not a simple type specifier 
     * "bool".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierBoolProvider
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateBoolAndNotSimpleTypeSpecifierBool(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createBool();
        self::assertSame(
            "\n".
            "Declaration specifier\n".
            "  Simple type specifier \"bool\"\n".
            "\n".
            "Declaration specifier: It should be simple type specifier \"bool\".", 
            $sut->additionalFailureDescription($declSpec)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createChar() and is not a simple type specifier 
     * "char".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierCharProvider
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateCharAndNotSimpleTypeSpecifierChar(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createChar();
        self::assertSame(
            "\n".
            "Declaration specifier\n".
            "  Simple type specifier \"char\"\n".
            "\n".
            "Declaration specifier: It should be simple type specifier \"char\".", 
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
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createIntSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createInt();
        self::assertSame(
            "\n".
            "Declaration specifier\n".
            "  Simple type specifier \"int\"\n".
            "\n".
            "Declaration specifier: Unknown reason.", 
            $sut->additionalFailureDescription($declSpec)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createFloat() and is a simple type specifier 
     * "float".
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateFloatAndSimpleTypeSpecifierFloat(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createFloatSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createFloat();
        self::assertSame(
            "\n".
            "Declaration specifier\n".
            "  Simple type specifier \"float\"\n".
            "\n".
            "Declaration specifier: Unknown reason.", 
            $sut->additionalFailureDescription($declSpec)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createBool() and is a simple type specifier 
     * "bool".
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateBoolAndSimpleTypeSpecifierBool(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createBoolSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createBool();
        self::assertSame(
            "\n".
            "Declaration specifier\n".
            "  Simple type specifier \"bool\"\n".
            "\n".
            "Declaration specifier: Unknown reason.", 
            $sut->additionalFailureDescription($declSpec)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createChar() and is a simple type specifier 
     * "char".
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateCharAndSimpleTypeSpecifierChar(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createCharSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createChar();
        self::assertSame(
            "\n".
            "Declaration specifier\n".
            "  Simple type specifier \"char\"\n".
            "\n".
            "Declaration specifier: Unknown reason.", 
            $sut->additionalFailureDescription($declSpec)
        );
    }
    
    /**
     * Tests that failureDescription() is called when the value is invalid.
     * 
     * @param   DeclarationSpecifierConstraint  $sut    The system under test.
     * 
     * @dataProvider    getSutProvider
     */
    public function testFailureDescriptionWhenInvalid(
        DeclarationSpecifierConstraint $sut
    ): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a declaration specifier`');
        
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Returns the set of systems under test.
     * 
     * @return  array[]
     */
    public function getSutProvider(): array
    {
        return [
            'Simple type specifier "int"' => [
                DeclarationSpecifierConstraint::createInt(), 
            ], 
            'Simple type specifier "float"' => [
                DeclarationSpecifierConstraint::createFloat(), 
            ], 
            'Simple type specifier "bool"' => [
                DeclarationSpecifierConstraint::createBool(), 
            ], 
            'Simple type specifier "char"' => [
                DeclarationSpecifierConstraint::createChar(), 
            ], 
        ];
    }
    
    /**
     * Returns a set of declaration specifiers that are not simple type 
     * specifier "int".
     * 
     * @return  array[]
     */
    public function getNotSimpleTypeSpecifierIntProvider(): array
    {
        $declSpecFactory = $this->createDeclarationSpecifierDoubleFactory();
        
        $dataSet = [
            'Simple type specifier NONE' => [
                $declSpecFactory->createNoneSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "float"' => [
                $declSpecFactory->createFloatSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "bool"' => [
                $declSpecFactory->createBoolSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "char"' => [
                $declSpecFactory->createCharSimpleTypeSpecifier(), 
            ], 
        ];
        
        return $dataSet;
    }
    
    /**
     * Returns a set of declaration specifiers that are not simple type 
     * specifier "float".
     * 
     * @return  array[]
     */
    public function getNotSimpleTypeSpecifierFloatProvider(): array
    {
        $declSpecFactory = $this->createDeclarationSpecifierDoubleFactory();
        
        $dataSet = [
            'Simple type specifier NONE' => [
                $declSpecFactory->createNoneSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "int"' => [
                $declSpecFactory->createIntSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "bool"' => [
                $declSpecFactory->createBoolSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "char"' => [
                $declSpecFactory->createCharSimpleTypeSpecifier(), 
            ], 
        ];
        
        return $dataSet;
    }
    
    /**
     * Returns a set of declaration specifiers that are not simple type 
     * specifier "bool".
     * 
     * @return  array[]
     */
    public function getNotSimpleTypeSpecifierBoolProvider(): array
    {
        $declSpecFactory = $this->createDeclarationSpecifierDoubleFactory();
        
        $dataSet = [
            'Simple type specifier NONE' => [
                $declSpecFactory->createNoneSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "int"' => [
                $declSpecFactory->createIntSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "float"' => [
                $declSpecFactory->createFloatSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "char"' => [
                $declSpecFactory->createCharSimpleTypeSpecifier(), 
            ], 
        ];
        
        return $dataSet;
    }
    
    /**
     * Returns a set of declaration specifiers that are not simple type 
     * specifier "char".
     * 
     * @return  array[]
     */
    public function getNotSimpleTypeSpecifierCharProvider(): array
    {
        $declSpecFactory = $this->createDeclarationSpecifierDoubleFactory();
        
        $dataSet = [
            'Simple type specifier NONE' => [
                $declSpecFactory->createNoneSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "int"' => [
                $declSpecFactory->createIntSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "float"' => [
                $declSpecFactory->createFloatSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "bool"' => [
                $declSpecFactory->createBoolSimpleTypeSpecifier(), 
            ], 
        ];
        
        return $dataSet;
    }
    
    /**
     * Creates a factory of declaration specifier doubles.
     * 
     * @return  DeclarationSpecifierDoubleFactory   The created instance of DeclarationSpecifierDoubleFactory.
     */
    private function createDeclarationSpecifierDoubleFactory(): DeclarationSpecifierDoubleFactory
    {
        return new DeclarationSpecifierDoubleFactory($this);
    }
}

