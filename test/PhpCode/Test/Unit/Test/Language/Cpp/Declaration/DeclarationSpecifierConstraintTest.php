<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\DeclarationSpecifier;
use PhpCode\Test\Language\Cpp\ConceptConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierConstraint;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierDoubleFactory;
use PhpCode\Test\Language\Cpp\Expression\NestedNameSpecifierDoubleFactory;
use PhpCode\Test\Language\Cpp\Lexical\IdentifierDoubleFactory;
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
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createWCharT().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateWCharT(): void
    {
        $sut = DeclarationSpecifierConstraint::createWCharT();
        self::assertSame(
            "Declaration specifier\n".
            "  Simple type specifier \"wchar_t\"", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createShort().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateShort(): void
    {
        $sut = DeclarationSpecifierConstraint::createShort();
        self::assertSame(
            "Declaration specifier\n".
            "  Simple type specifier \"short\"", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createLong().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateLong(): void
    {
        $sut = DeclarationSpecifierConstraint::createLong();
        self::assertSame(
            "Declaration specifier\n".
            "  Simple type specifier \"long\"", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createSigned().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateSigned(): void
    {
        $sut = DeclarationSpecifierConstraint::createSigned();
        self::assertSame(
            "Declaration specifier\n".
            "  Simple type specifier \"signed\"", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createUnsigned().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateUnsigned(): void
    {
        $sut = DeclarationSpecifierConstraint::createUnsigned();
        self::assertSame(
            "Declaration specifier\n".
            "  Simple type specifier \"unsigned\"", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createDouble().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateDouble(): void
    {
        $sut = DeclarationSpecifierConstraint::createDouble();
        self::assertSame(
            "Declaration specifier\n".
            "  Simple type specifier \"double\"", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createIdentifier().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateIdentifier(): void
    {
        $idConst = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildConstraintDescription('foo Identifier')
            ->getDouble();
        
        $sut = DeclarationSpecifierConstraint::createIdentifier($idConst);
        self::assertSame(
            "Declaration specifier\n".
            "  Simple type specifier \"identifier\"\n".
            "    foo Identifier", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createQualifiedIdentifier().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateQualifiedIdentifier(): void
    {
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->buildConstraintDescription('foo NestedNameSpecifier')
            ->getDouble();
        $idConst = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildConstraintDescription('bar Identifier')
            ->getDouble();
        
        $sut = DeclarationSpecifierConstraint::createQualifiedIdentifier(
            $nnSpecConst, 
            $idConst
        );
        self::assertSame(
            "Declaration specifier\n".
            "  Simple type specifier qualified identifier\n".
            "    foo NestedNameSpecifier\n".
            "    bar Identifier", 
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
     * Tests that matches() returns FALSE when the instance is created by 
     * createWCharT() and not simple type specifier "wchar_t".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierWCharTProvider
     */
    public function testMatchesReturnsFalseWhenCreateWCharTAndNotSimpleTypeSpecifierWCharT(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createWCharT();
        self::assertFalse($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createShort() and not simple type specifier "short".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierShortProvider
     */
    public function testMatchesReturnsFalseWhenCreateShortAndNotSimpleTypeSpecifierShort(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createShort();
        self::assertFalse($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createLong() and not simple type specifier "long".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierLongProvider
     */
    public function testMatchesReturnsFalseWhenCreateLongAndNotSimpleTypeSpecifierLong(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createLong();
        self::assertFalse($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createSigned() and not simple type specifier "signed".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierSignedProvider
     */
    public function testMatchesReturnsFalseWhenCreateSignedAndNotSimpleTypeSpecifierSigned(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createSigned();
        self::assertFalse($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createUnsigned() and not simple type specifier "unsigned".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierUnsignedProvider
     */
    public function testMatchesReturnsFalseWhenCreateUnsignedAndNotSimpleTypeSpecifierUnsigned(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createUnsigned();
        self::assertFalse($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createDouble() and not simple type specifier "double".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierDoubleProvider
     */
    public function testMatchesReturnsFalseWhenCreateDoubleAndNotSimpleTypeSpecifierDouble(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createDouble();
        self::assertFalse($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createIdentifier() and not simple type specifier "identifier".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierIdentifierProvider
     */
    public function testMatchesReturnsFalseWhenCreateIdentifierAndNotSimpleTypeSpecifierIdentifier(
        DeclarationSpecifier $declSpec
    ): void
    {
        $idConst = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->getDouble();
        
        $sut = DeclarationSpecifierConstraint::createIdentifier($idConst);
        self::assertFalse($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createIdentifier() and identifier does not match.
     */
    public function testMatchesReturnsFalseWhenCreateIdentifierAndIdentifierDoesNotMatch(): void
    {
        $id = $this->createIdentifierDoubleFactory()->createDummy();
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createIdentifierSimpleTypeSpecifier($id);
        
        $idConst = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($id, FALSE)
            ->getDouble();
        
        $sut = DeclarationSpecifierConstraint::createIdentifier($idConst);
        self::assertFalse($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createQualifiedIdentifier() and not simple type specifier qualified 
     * identifier.
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierQualifiedIdentifierProvider
     */
    public function testMatchesReturnsFalseWhenCreateQualifiedIdentifierAndNotSimpleTypeSpecifierQualifiedIdentifier(
        DeclarationSpecifier $declSpec
    ): void
    {
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->getDouble();
        $idConst = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->getDouble();
        
        $sut = DeclarationSpecifierConstraint::createQualifiedIdentifier(
            $nnSpecConst, 
            $idConst
        );
        self::assertFalse($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createQualifiedIdentifier() and the nested name specifier is invalid.
     */
    public function testMatchesReturnsFalseWhenCreateQualifiedIdentifierAndNestedNameSpecifierIsInvalid(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()->createDummy();
        $id = $this->createIdentifierDoubleFactory()->createDummy();
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createQualifiedIdentifierSimpleTypeSpecifier($nnSpec, $id);
        
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->buildMatches($nnSpec, FALSE)
            ->getDouble();
        $idConst = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->getDouble();
        
        $sut = DeclarationSpecifierConstraint::createQualifiedIdentifier(
            $nnSpecConst, 
            $idConst
        );
        self::assertFalse($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createQualifiedIdentifier() and the identifier is invalid.
     */
    public function testMatchesReturnsFalseWhenCreateQualifiedIdentifierAndIdentifierIsInvalid(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()->createDummy();
        $id = $this->createIdentifierDoubleFactory()->createDummy();
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createQualifiedIdentifierSimpleTypeSpecifier($nnSpec, $id);
        
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->buildMatches($nnSpec, TRUE)
            ->getDouble();
        $idConst = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($id, FALSE)
            ->getDouble();
        
        $sut = DeclarationSpecifierConstraint::createQualifiedIdentifier(
            $nnSpecConst, 
            $idConst
        );
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
     * Tests that matches() returns TRUE when the instance is created by 
     * createWCharT() and simple type specifier "wchar_t".
     */
    public function testMatchesReturnsTrueWhenCreateWCharTAndSimpleTypeSpecifierWCharT(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createWCharTSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createWCharT();
        self::assertTrue($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createShort() and simple type specifier "short".
     */
    public function testMatchesReturnsTrueWhenCreateShortAndSimpleTypeSpecifierShort(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createShortSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createShort();
        self::assertTrue($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createLong() and simple type specifier "long".
     */
    public function testMatchesReturnsTrueWhenCreateLongAndSimpleTypeSpecifierLong(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createLongSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createLong();
        self::assertTrue($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createSigned() and simple type specifier "signed".
     */
    public function testMatchesReturnsTrueWhenCreateSignedAndSimpleTypeSpecifierSigned(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createSignedSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createSigned();
        self::assertTrue($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createUnsigned() and simple type specifier "unsigned".
     */
    public function testMatchesReturnsTrueWhenCreateUnsignedAndSimpleTypeSpecifierUnsigned(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createUnsignedSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createUnsigned();
        self::assertTrue($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createDouble() and simple type specifier "double".
     */
    public function testMatchesReturnsTrueWhenCreateDoubleAndSimpleTypeSpecifierDouble(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createDoubleSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createDouble();
        self::assertTrue($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createIdentifier() and identifier matches.
     */
    public function testMatchesReturnsTrueWhenCreateIdentifierAndIdentifierMatches(): void
    {
        $id = $this->createIdentifierDoubleFactory()->createDummy();
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createIdentifierSimpleTypeSpecifier($id);
        
        $idConst = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($id, TRUE)
            ->getDouble();
        
        $sut = DeclarationSpecifierConstraint::createIdentifier($idConst);
        self::assertTrue($sut->matches($declSpec));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createQualifiedIdentifier() and the identifier is valid.
     */
    public function testMatchesReturnsTrueWhenCreateQualifiedIdentifierAndIdentifierIsValid(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()->createDummy();
        $id = $this->createIdentifierDoubleFactory()->createDummy();
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createQualifiedIdentifierSimpleTypeSpecifier($nnSpec, $id);
        
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->buildMatches($nnSpec, TRUE)
            ->getDouble();
        $idConst = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($id, TRUE)
            ->getDouble();
        
        $sut = DeclarationSpecifierConstraint::createQualifiedIdentifier(
            $nnSpecConst, 
            $idConst
        );
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
     * created by createWCharT() and is not a simple type specifier "wchar_t".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierWCharTProvider
     */
    public function testFailureReasonReturnsStringWhenCreateWCharTAndNotSimpleTypeSpecifierWCharT(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createWCharT();
        self::assertSame(
            'Declaration specifier: It should be simple type specifier "wchar_t".', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createShort() and is not a simple type specifier "short".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierShortProvider
     */
    public function testFailureReasonReturnsStringWhenCreateShortAndNotSimpleTypeSpecifierShort(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createShort();
        self::assertSame(
            'Declaration specifier: It should be simple type specifier "short".', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createLong() and is not a simple type specifier "long".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierLongProvider
     */
    public function testFailureReasonReturnsStringWhenCreateLongAndNotSimpleTypeSpecifierLong(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createLong();
        self::assertSame(
            'Declaration specifier: It should be simple type specifier "long".', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createSigned() and is not a simple type specifier "signed".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierSignedProvider
     */
    public function testFailureReasonReturnsStringWhenCreateSignedAndNotSimpleTypeSpecifierSigned(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createSigned();
        self::assertSame(
            'Declaration specifier: It should be simple type specifier "signed".', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createUnsigned() and is not a simple type specifier "unsigned".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierUnsignedProvider
     */
    public function testFailureReasonReturnsStringWhenCreateUnsignedAndNotSimpleTypeSpecifierUnsigned(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createUnsigned();
        self::assertSame(
            'Declaration specifier: It should be simple type specifier "unsigned".', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createDouble() and is not a simple type specifier "double".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierDoubleProvider
     */
    public function testFailureReasonReturnsStringWhenCreateDoubleAndNotSimpleTypeSpecifierDouble(
        DeclarationSpecifier $declSpec
    ): void
    {
        $sut = DeclarationSpecifierConstraint::createDouble();
        self::assertSame(
            'Declaration specifier: It should be simple type specifier "double".', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createIdentifier() and is not a simple type specifier 
     * "identifier".
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierIdentifierProvider
     */
    public function testFailureReasonReturnsStringWhenCreateIdentifierAndNotSimpleTypeSpecifierIdentifier(
        DeclarationSpecifier $declSpec
    ): void
    {
        $idConst = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->getDouble();
        
        $sut = DeclarationSpecifierConstraint::createIdentifier($idConst);
        self::assertSame(
            'Declaration specifier: It should be simple type specifier "identifier".', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createIdentifier() and identifier does not match.
     */
    public function testFailureReasonReturnsStringWhenCreateIdentifierAndIdentifierDoesNotMatch(): void
    {
        $id = $this->createIdentifierDoubleFactory()->createDummy();
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createIdentifierSimpleTypeSpecifier($id);
        
        $idConst = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($id, FALSE)
            ->buildFailureReason($id, 'foo reason')
            ->getDouble();
        
        $sut = DeclarationSpecifierConstraint::createIdentifier($idConst);
        self::assertSame(
            "Declaration specifier\n".
            "  foo reason", 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createQualifiedIdentifier() and is not a simple type 
     * specifier qualified identifier.
     * 
     * @param   DeclarationSpecifier    $declSpec   The declaration specifier to test.
     * 
     * @dataProvider    getNotSimpleTypeSpecifierQualifiedIdentifierProvider
     */
    public function testFailureReasonReturnsStringWhenCreateQualifiedIdentifierAndNotSimpleTypeSpecifierQualifiedIdentifier(
        DeclarationSpecifier $declSpec
    ): void
    {
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->getDouble();
        $idConst = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->getDouble();
        
        $sut = DeclarationSpecifierConstraint::createQualifiedIdentifier(
            $nnSpecConst, 
            $idConst
        );
        self::assertSame(
            'Declaration specifier: It should be simple type specifier qualified identifier.', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createQualifiedIdentifier() and the nested name specifier 
     * is invalid.
     */
    public function testFailureReasonReturnsStringWhenCreateQualifiedIdentifierAndNestedNameSpecifierIsInvalid(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()->createDummy();
        $id = $this->createIdentifierDoubleFactory()->createDummy();
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createQualifiedIdentifierSimpleTypeSpecifier($nnSpec, $id);
        
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->buildMatches($nnSpec, FALSE)
            ->buildFailureReason($nnSpec, 'foo reason')
            ->getDouble();
        $idConst = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->getDouble();
        
        $sut = DeclarationSpecifierConstraint::createQualifiedIdentifier(
            $nnSpecConst, 
            $idConst
        );
        self::assertSame(
            "Declaration specifier\n".
            "  foo reason", 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createQualifiedIdentifier() and the identifier is invalid.
     */
    public function testFailureReasonReturnsStringWhenCreateQualifiedIdentifierAndIdentifierIsInvalid(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()->createDummy();
        $id = $this->createIdentifierDoubleFactory()->createDummy();
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createQualifiedIdentifierSimpleTypeSpecifier($nnSpec, $id);
        
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->buildMatches($nnSpec, TRUE)
            ->getDouble();
        $idConst = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($id, FALSE)
            ->buildFailureReason($id, 'bar reason')
            ->getDouble();
        
        $sut = DeclarationSpecifierConstraint::createQualifiedIdentifier(
            $nnSpecConst, 
            $idConst
        );
        self::assertSame(
            "Declaration specifier\n".
            "  bar reason", 
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
     * Tests that failureReason() returns a string when the instance is 
     * created by createWCharT() and is a simple type specifier "wchar_t".
     */
    public function testFailureReasonReturnsStringWhenCreateWCharTAndSimpleTypeSpecifierWCharT(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createWCharTSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createWCharT();
        self::assertSame(
            'Declaration specifier: Unknown reason.', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createShort() and is a simple type specifier "short".
     */
    public function testFailureReasonReturnsStringWhenCreateShortAndSimpleTypeSpecifierShort(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createShortSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createShort();
        self::assertSame(
            'Declaration specifier: Unknown reason.', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createLong() and is a simple type specifier "long".
     */
    public function testFailureReasonReturnsStringWhenCreateLongAndSimpleTypeSpecifierLong(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createLongSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createLong();
        self::assertSame(
            'Declaration specifier: Unknown reason.', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createSigned() and is a simple type specifier "signed".
     */
    public function testFailureReasonReturnsStringWhenCreateSignedAndSimpleTypeSpecifierSigned(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createSignedSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createSigned();
        self::assertSame(
            'Declaration specifier: Unknown reason.', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createUnsigned() and is a simple type specifier "unsigned".
     */
    public function testFailureReasonReturnsStringWhenCreateUnsignedAndSimpleTypeSpecifierUnsigned(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createUnsignedSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createUnsigned();
        self::assertSame(
            'Declaration specifier: Unknown reason.', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createDouble() and is a simple type specifier "double".
     */
    public function testFailureReasonReturnsStringWhenCreateDoubleAndSimpleTypeSpecifierDouble(): void
    {
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createDoubleSimpleTypeSpecifier();
        
        $sut = DeclarationSpecifierConstraint::createDouble();
        self::assertSame(
            'Declaration specifier: Unknown reason.', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createIdentifier() and identifier matches.
     */
    public function testFailureReasonReturnsStringWhenCreateIdentifierAndIdentifierMatches(): void
    {
        $id = $this->createIdentifierDoubleFactory()->createDummy();
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createIdentifierSimpleTypeSpecifier($id);
        
        $idConst = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($id, TRUE)
            ->getDouble();
        
        $sut = DeclarationSpecifierConstraint::createIdentifier($idConst);
        self::assertSame(
            'Declaration specifier: Unknown reason.', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createQualifiedIdentifier() and the identifier is valid.
     */
    public function testFailureReasonReturnsStringWhenCreateQualifiedIdentifierAndIdentifierIsValid(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()->createDummy();
        $id = $this->createIdentifierDoubleFactory()->createDummy();
        $declSpec = $this->createDeclarationSpecifierDoubleFactory()
            ->createQualifiedIdentifierSimpleTypeSpecifier($nnSpec, $id);
        
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->buildMatches($nnSpec, TRUE)
            ->getDouble();
        $idConst = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($id, TRUE)
            ->buildFailureReason($id, 'bar reason')
            ->getDouble();
        
        $sut = DeclarationSpecifierConstraint::createQualifiedIdentifier(
            $nnSpecConst, 
            $idConst
        );
        self::assertSame(
            'Declaration specifier: Unknown reason.', 
            $sut->failureReason($declSpec)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by createInt().
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenCreateInt(): void
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
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by createFloat().
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenCreateFloat(): void
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
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by createBool().
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenCreateBool(): void
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
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by createChar().
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenCreateChar(): void
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
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by createWCharT().
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenCreateWCharT(): void
    {
        $sut = DeclarationSpecifierConstraint::createWCharT();
        
        $pattern = \sprintf(
            "`^\n".
            "Declaration specifier\n".
            "  Simple type specifier \"wchar_t\"\n".
            "\n".
            "Declaration specifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', DeclarationSpecifier::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by createShort().
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenCreateShort(): void
    {
        $sut = DeclarationSpecifierConstraint::createShort();
        
        $pattern = \sprintf(
            "`^\n".
            "Declaration specifier\n".
            "  Simple type specifier \"short\"\n".
            "\n".
            "Declaration specifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', DeclarationSpecifier::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by createLong().
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenCreateLong(): void
    {
        $sut = DeclarationSpecifierConstraint::createLong();
        
        $pattern = \sprintf(
            "`^\n".
            "Declaration specifier\n".
            "  Simple type specifier \"long\"\n".
            "\n".
            "Declaration specifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', DeclarationSpecifier::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by createSigned().
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenCreateSigned(): void
    {
        $sut = DeclarationSpecifierConstraint::createSigned();
        
        $pattern = \sprintf(
            "`^\n".
            "Declaration specifier\n".
            "  Simple type specifier \"signed\"\n".
            "\n".
            "Declaration specifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', DeclarationSpecifier::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by createUnsigned().
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenCreateUnsigned(): void
    {
        $sut = DeclarationSpecifierConstraint::createUnsigned();
        
        $pattern = \sprintf(
            "`^\n".
            "Declaration specifier\n".
            "  Simple type specifier \"unsigned\"\n".
            "\n".
            "Declaration specifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', DeclarationSpecifier::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by createDouble().
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenCreateDouble(): void
    {
        $sut = DeclarationSpecifierConstraint::createDouble();
        
        $pattern = \sprintf(
            "`^\n".
            "Declaration specifier\n".
            "  Simple type specifier \"double\"\n".
            "\n".
            "Declaration specifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', DeclarationSpecifier::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by createIdentifier().
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenCreateIdentifier(): void
    {
        $idConst = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildConstraintDescription('foo description')
            ->getDouble();
        
        $sut = DeclarationSpecifierConstraint::createIdentifier($idConst);
        
        $pattern = \sprintf(
            "`^\n".
            "Declaration specifier\n".
            "  Simple type specifier \"identifier\"\n".
            "    foo description\n".
            "\n".
            "Declaration specifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', DeclarationSpecifier::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by createIdentifier().
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenCreateQualifiedIdentifier(): void
    {
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->buildConstraintDescription('foo description')
            ->getDouble();
        $idConst = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildConstraintDescription('bar description')
            ->getDouble();
        
        $sut = DeclarationSpecifierConstraint::createQualifiedIdentifier(
            $nnSpecConst, 
            $idConst
        );
        
        $pattern = \sprintf(
            "`^\n".
            "Declaration specifier\n".
            "  Simple type specifier qualified identifier\n".
            "    foo description\n".
            "    bar description\n".
            "\n".
            "Declaration specifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', DeclarationSpecifier::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
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
        $idConst = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildConstraintDescription('foo Identifier')
            ->getDouble();
        
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->buildConstraintDescription('bar NestedNameSpecifier')
            ->getDouble();
        
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
            'Simple type specifier "wchar_t"' => [
                DeclarationSpecifierConstraint::createWCharT(), 
            ], 
            'Simple type specifier "short"' => [
                DeclarationSpecifierConstraint::createShort(), 
            ], 
            'Simple type specifier "long"' => [
                DeclarationSpecifierConstraint::createLong(), 
            ], 
            'Simple type specifier "signed"' => [
                DeclarationSpecifierConstraint::createSigned(), 
            ], 
            'Simple type specifier "unsigned"' => [
                DeclarationSpecifierConstraint::createUnsigned(), 
            ], 
            'Simple type specifier "double"' => [
                DeclarationSpecifierConstraint::createDouble(), 
            ], 
            'Simple type specifier "identifier"' => [
                DeclarationSpecifierConstraint::createIdentifier($idConst), 
            ], 
            'Simple type specifier qualified identifier' => [
                DeclarationSpecifierConstraint::createQualifiedIdentifier(
                    $nnSpecConst, 
                    $idConst
                ), 
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
            'Simple type specifier "float"' => [
                $declSpecFactory->createFloatSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "bool"' => [
                $declSpecFactory->createBoolSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "char"' => [
                $declSpecFactory->createCharSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "wchar_t"' => [
                $declSpecFactory->createWCharTSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "short"' => [
                $declSpecFactory->createShortSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "long"' => [
                $declSpecFactory->createLongSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "signed"' => [
                $declSpecFactory->createSignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "unsigned"' => [
                $declSpecFactory->createUnsignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "double"' => [
                $declSpecFactory->createDoubleSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "identifier"' => [
                $declSpecFactory->createIdentifierSimpleTypeSpecifier(
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
            ], 
            'Simple type specifier qualified identifier' => [
                $declSpecFactory->createQualifiedIdentifierSimpleTypeSpecifier(
                    $this->createNestedNameSpecifierDoubleFactory()->createDummy(), 
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
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
            'Simple type specifier "int"' => [
                $declSpecFactory->createIntSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "bool"' => [
                $declSpecFactory->createBoolSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "char"' => [
                $declSpecFactory->createCharSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "wchar_t"' => [
                $declSpecFactory->createWCharTSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "short"' => [
                $declSpecFactory->createShortSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "long"' => [
                $declSpecFactory->createLongSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "signed"' => [
                $declSpecFactory->createSignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "unsigned"' => [
                $declSpecFactory->createUnsignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "double"' => [
                $declSpecFactory->createDoubleSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "identifier"' => [
                $declSpecFactory->createIdentifierSimpleTypeSpecifier(
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
            ], 
            'Simple type specifier qualified identifier' => [
                $declSpecFactory->createQualifiedIdentifierSimpleTypeSpecifier(
                    $this->createNestedNameSpecifierDoubleFactory()->createDummy(), 
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
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
            'Simple type specifier "int"' => [
                $declSpecFactory->createIntSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "float"' => [
                $declSpecFactory->createFloatSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "char"' => [
                $declSpecFactory->createCharSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "wchar_t"' => [
                $declSpecFactory->createWCharTSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "short"' => [
                $declSpecFactory->createShortSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "long"' => [
                $declSpecFactory->createLongSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "signed"' => [
                $declSpecFactory->createSignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "unsigned"' => [
                $declSpecFactory->createUnsignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "double"' => [
                $declSpecFactory->createDoubleSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "identifier"' => [
                $declSpecFactory->createIdentifierSimpleTypeSpecifier(
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
            ], 
            'Simple type specifier qualified identifier' => [
                $declSpecFactory->createQualifiedIdentifierSimpleTypeSpecifier(
                    $this->createNestedNameSpecifierDoubleFactory()->createDummy(), 
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
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
            'Simple type specifier "int"' => [
                $declSpecFactory->createIntSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "float"' => [
                $declSpecFactory->createFloatSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "bool"' => [
                $declSpecFactory->createBoolSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "wchar_t"' => [
                $declSpecFactory->createWCharTSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "short"' => [
                $declSpecFactory->createShortSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "long"' => [
                $declSpecFactory->createLongSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "signed"' => [
                $declSpecFactory->createSignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "unsigned"' => [
                $declSpecFactory->createUnsignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "double"' => [
                $declSpecFactory->createDoubleSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "identifier"' => [
                $declSpecFactory->createIdentifierSimpleTypeSpecifier(
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
            ], 
            'Simple type specifier qualified identifier' => [
                $declSpecFactory->createQualifiedIdentifierSimpleTypeSpecifier(
                    $this->createNestedNameSpecifierDoubleFactory()->createDummy(), 
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
            ], 
        ];
        
        return $dataSet;
    }
    
    /**
     * Returns a set of declaration specifiers that are not simple type 
     * specifier "wchar_t".
     * 
     * @return  array[]
     */
    public function getNotSimpleTypeSpecifierWCharTProvider(): array
    {
        $declSpecFactory = $this->createDeclarationSpecifierDoubleFactory();
        
        $dataSet = [
            'Simple type specifier "int"' => [
                $declSpecFactory->createIntSimpleTypeSpecifier(), 
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
            'Simple type specifier "short"' => [
                $declSpecFactory->createShortSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "long"' => [
                $declSpecFactory->createLongSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "signed"' => [
                $declSpecFactory->createSignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "unsigned"' => [
                $declSpecFactory->createUnsignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "double"' => [
                $declSpecFactory->createDoubleSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "identifier"' => [
                $declSpecFactory->createIdentifierSimpleTypeSpecifier(
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
            ], 
            'Simple type specifier qualified identifier' => [
                $declSpecFactory->createQualifiedIdentifierSimpleTypeSpecifier(
                    $this->createNestedNameSpecifierDoubleFactory()->createDummy(), 
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
            ], 
        ];
        
        return $dataSet;
    }
    
    /**
     * Returns a set of declaration specifiers that are not simple type 
     * specifier "short".
     * 
     * @return  array[]
     */
    public function getNotSimpleTypeSpecifierShortProvider(): array
    {
        $declSpecFactory = $this->createDeclarationSpecifierDoubleFactory();
        
        $dataSet = [
            'Simple type specifier "int"' => [
                $declSpecFactory->createIntSimpleTypeSpecifier(), 
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
            'Simple type specifier "wchar_t"' => [
                $declSpecFactory->createWCharTSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "long"' => [
                $declSpecFactory->createLongSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "signed"' => [
                $declSpecFactory->createSignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "unsigned"' => [
                $declSpecFactory->createUnsignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "double"' => [
                $declSpecFactory->createDoubleSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "identifier"' => [
                $declSpecFactory->createIdentifierSimpleTypeSpecifier(
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
            ], 
            'Simple type specifier qualified identifier' => [
                $declSpecFactory->createQualifiedIdentifierSimpleTypeSpecifier(
                    $this->createNestedNameSpecifierDoubleFactory()->createDummy(), 
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
            ], 
        ];
        
        return $dataSet;
    }
    
    /**
     * Returns a set of declaration specifiers that are not simple type 
     * specifier "long".
     * 
     * @return  array[]
     */
    public function getNotSimpleTypeSpecifierLongProvider(): array
    {
        $declSpecFactory = $this->createDeclarationSpecifierDoubleFactory();
        
        $dataSet = [
            'Simple type specifier "int"' => [
                $declSpecFactory->createIntSimpleTypeSpecifier(), 
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
            'Simple type specifier "wchar_t"' => [
                $declSpecFactory->createWCharTSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "short"' => [
                $declSpecFactory->createShortSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "signed"' => [
                $declSpecFactory->createSignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "unsigned"' => [
                $declSpecFactory->createUnsignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "double"' => [
                $declSpecFactory->createDoubleSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "identifier"' => [
                $declSpecFactory->createIdentifierSimpleTypeSpecifier(
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
            ], 
            'Simple type specifier qualified identifier' => [
                $declSpecFactory->createQualifiedIdentifierSimpleTypeSpecifier(
                    $this->createNestedNameSpecifierDoubleFactory()->createDummy(), 
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
            ], 
        ];
        
        return $dataSet;
    }
    
    /**
     * Returns a set of declaration specifiers that are not simple type 
     * specifier "signed".
     * 
     * @return  array[]
     */
    public function getNotSimpleTypeSpecifierSignedProvider(): array
    {
        $declSpecFactory = $this->createDeclarationSpecifierDoubleFactory();
        
        $dataSet = [
            'Simple type specifier "int"' => [
                $declSpecFactory->createIntSimpleTypeSpecifier(), 
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
            'Simple type specifier "wchar_t"' => [
                $declSpecFactory->createWCharTSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "short"' => [
                $declSpecFactory->createShortSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "long"' => [
                $declSpecFactory->createLongSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "unsigned"' => [
                $declSpecFactory->createUnsignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "double"' => [
                $declSpecFactory->createDoubleSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "identifier"' => [
                $declSpecFactory->createIdentifierSimpleTypeSpecifier(
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
            ], 
            'Simple type specifier qualified identifier' => [
                $declSpecFactory->createQualifiedIdentifierSimpleTypeSpecifier(
                    $this->createNestedNameSpecifierDoubleFactory()->createDummy(), 
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
            ], 
        ];
        
        return $dataSet;
    }
    
    /**
     * Returns a set of declaration specifiers that are not simple type 
     * specifier "unsigned".
     * 
     * @return  array[]
     */
    public function getNotSimpleTypeSpecifierUnsignedProvider(): array
    {
        $declSpecFactory = $this->createDeclarationSpecifierDoubleFactory();
        
        $dataSet = [
            'Simple type specifier "int"' => [
                $declSpecFactory->createIntSimpleTypeSpecifier(), 
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
            'Simple type specifier "wchar_t"' => [
                $declSpecFactory->createWCharTSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "short"' => [
                $declSpecFactory->createShortSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "long"' => [
                $declSpecFactory->createLongSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "signed"' => [
                $declSpecFactory->createSignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "double"' => [
                $declSpecFactory->createDoubleSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "identifier"' => [
                $declSpecFactory->createIdentifierSimpleTypeSpecifier(
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
            ], 
            'Simple type specifier qualified identifier' => [
                $declSpecFactory->createQualifiedIdentifierSimpleTypeSpecifier(
                    $this->createNestedNameSpecifierDoubleFactory()->createDummy(), 
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
            ], 
        ];
        
        return $dataSet;
    }
    
    /**
     * Returns a set of declaration specifiers that are not simple type 
     * specifier "double".
     * 
     * @return  array[]
     */
    public function getNotSimpleTypeSpecifierDoubleProvider(): array
    {
        $declSpecFactory = $this->createDeclarationSpecifierDoubleFactory();
        
        $dataSet = [
            'Simple type specifier "int"' => [
                $declSpecFactory->createIntSimpleTypeSpecifier(), 
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
            'Simple type specifier "wchar_t"' => [
                $declSpecFactory->createWCharTSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "short"' => [
                $declSpecFactory->createShortSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "long"' => [
                $declSpecFactory->createLongSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "signed"' => [
                $declSpecFactory->createSignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "unsigned"' => [
                $declSpecFactory->createUnsignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "identifier"' => [
                $declSpecFactory->createIdentifierSimpleTypeSpecifier(
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
            ], 
            'Simple type specifier qualified identifier' => [
                $declSpecFactory->createQualifiedIdentifierSimpleTypeSpecifier(
                    $this->createNestedNameSpecifierDoubleFactory()->createDummy(), 
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
            ], 
        ];
        
        return $dataSet;
    }
    
    /**
     * Returns a set of declaration specifiers that are not simple type 
     * specifier "identifier".
     * 
     * @return  array[]
     */
    public function getNotSimpleTypeSpecifierIdentifierProvider(): array
    {
        $declSpecFactory = $this->createDeclarationSpecifierDoubleFactory();
        
        $dataSet = [
            'Simple type specifier "int"' => [
                $declSpecFactory->createIntSimpleTypeSpecifier(), 
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
            'Simple type specifier "wchar_t"' => [
                $declSpecFactory->createWCharTSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "short"' => [
                $declSpecFactory->createShortSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "long"' => [
                $declSpecFactory->createLongSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "signed"' => [
                $declSpecFactory->createSignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "unsigned"' => [
                $declSpecFactory->createUnsignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "double"' => [
                $declSpecFactory->createDoubleSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier qualified identifier' => [
                $declSpecFactory->createQualifiedIdentifierSimpleTypeSpecifier(
                    $this->createNestedNameSpecifierDoubleFactory()->createDummy(), 
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
            ], 
        ];
        
        return $dataSet;
    }
    
    /**
     * Returns a set of declaration specifiers that are not simple type 
     * specifier qualified identifier.
     * 
     * @return  array[]
     */
    public function getNotSimpleTypeSpecifierQualifiedIdentifierProvider(): array
    {
        $declSpecFactory = $this->createDeclarationSpecifierDoubleFactory();
        
        $dataSet = [
            'Simple type specifier "int"' => [
                $declSpecFactory->createIntSimpleTypeSpecifier(), 
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
            'Simple type specifier "wchar_t"' => [
                $declSpecFactory->createWCharTSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "short"' => [
                $declSpecFactory->createShortSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "long"' => [
                $declSpecFactory->createLongSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "signed"' => [
                $declSpecFactory->createSignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "unsigned"' => [
                $declSpecFactory->createUnsignedSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "double"' => [
                $declSpecFactory->createDoubleSimpleTypeSpecifier(), 
            ], 
            'Simple type specifier "identifier"' => [
                $declSpecFactory->createIdentifierSimpleTypeSpecifier(
                    $this->createIdentifierDoubleFactory()->createDummy()
                ), 
            ], 
        ];
        
        return $dataSet;
    }
    
    /**
     * Creates a factory of declaration specifier doubles.
     * 
     * @return  DeclarationSpecifierDoubleFactory
     */
    private function createDeclarationSpecifierDoubleFactory(): DeclarationSpecifierDoubleFactory
    {
        return new DeclarationSpecifierDoubleFactory($this);
    }
    
    /**
     * Creates a factory of identifier doubles.
     * 
     * @return  IdentifierDoubleFactory
     */
    private function createIdentifierDoubleFactory(): IdentifierDoubleFactory
    {
        return new IdentifierDoubleFactory($this);
    }
    
    /**
     * Creates a factory of nested name specifier doubles.
     * 
     * @return  NestedNameSpecifierDoubleFactory
     */
    private function createNestedNameSpecifierDoubleFactory(): NestedNameSpecifierDoubleFactory
    {
        return new NestedNameSpecifierDoubleFactory($this);
    }
}

