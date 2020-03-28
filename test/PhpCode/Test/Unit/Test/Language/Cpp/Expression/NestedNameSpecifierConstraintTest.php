<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\NestedNameSpecifier;
use PhpCode\Test\Language\Cpp\ConceptConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\Expression\NestedNameSpecifierConstraint;
use PhpCode\Test\Language\Cpp\Expression\NestedNameSpecifierDoubleFactory;
use PhpCode\Test\Language\Cpp\Lexical\IdentifierDoubleFactory;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Expression\NestedNameSpecifierConstraint} 
 * class.
 * 
 * @group   expression
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NestedNameSpecifierConstraintTest extends TestCase
{
    /**
     * Tests that toString() returns a string.
     * 
     * @param   NestedNameSpecifierConstraint   $sut    The system under test.
     * 
     * @dataProvider    getSutProvider
     */
    public function testToStringReturnsString(NestedNameSpecifierConstraint $sut): void
    {
        self::assertSame('nested name specifier', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string.
     * 
     * @param   NestedNameSpecifierConstraint   $sut    The system under test.
     * 
     * @dataProvider    getSutProvider
     */
    public function testGetConceptNameReturnsString(
        NestedNameSpecifierConstraint $sut
    ): void
    {
        self::assertSame('Nested name specifier', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string.
     * 
     * @param   NestedNameSpecifierConstraint   $sut    The system under test.
     * 
     * @dataProvider    getSutProvider
     */
    public function testFailureDefaultReasonReturnsString(
        NestedNameSpecifierConstraint $sut
    ): void
    {
        self::assertSame(
            'Nested name specifier: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when no constraint 
     * has been added.
     */
    public function testConstraintDescriptionReturnsStringWhenNoConstraint(): void
    {
        $sut = new NestedNameSpecifierConstraint();
        self::assertSame(
            'Nested name specifier (0)', 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when identifier 
     * constraints have been added.
     */
    public function testConstraintDescriptionReturnsStringWhenIdentifierConstraints(): void
    {
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildConstraintDescription('foo')
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildConstraintDescription('bar')
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildConstraintDescription('baz')
            ->getDouble();
        
        $sut = new NestedNameSpecifierConstraint();
        $sut->addNameSpecifierConstraint($consts[0]);
        $sut->addNameSpecifierConstraint($consts[1]);
        $sut->addNameSpecifierConstraint($consts[2]);
        self::assertSame(
            "Nested name specifier (3)\n".
            "  foo\n".
            "  bar\n".
            "  baz"
            , 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when not instance of 
     * NestedNameSpecifier.
     * 
     * @param   NestedNameSpecifierConstraint   $sut    The system under test.
     * 
     * @dataProvider    getSutProvider
     */
    public function testMatchesReturnsFalseWhenNotInstanceNestedNameSpecifier(
        NestedNameSpecifierConstraint $sut
    ): void
    {
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when no constraint has been added 
     * and the constraint count is not equal to the name specifier count.
     */
    public function testMatchesReturnsFalseWhenNoConstraintAndConstraintCountNotEqualNameSpecifierCount(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()
            ->createCount(3);
        
        $sut = new NestedNameSpecifierConstraint();
        self::assertFalse($sut->matches($nnSpec));
    }
    
    /**
     * Tests that matches() returns FALSE when identifier constraints have 
     * been added and the constraint count is not equal to the name 
     * specifier count.
     */
    public function testMatchesReturnsFalseWhenIdentifierConstraintsAndConstraintCountNotEqualNameSpecifierCount(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()
            ->createCount(3);
        
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->getDouble();
        
        $sut = new NestedNameSpecifierConstraint();
        $sut->addNameSpecifierConstraint($consts[0]);
        self::assertFalse($sut->matches($nnSpec));
    }
    
    /**
     * Tests that matches() returns FALSE when identifier constraints have 
     * been added and a name specifier is invalid.
     */
    public function testMatchesReturnsFalseWhenIdentifierConstraintsAndNameSpecifierIsInvalid(): void
    {
        $idFactory = $this->createIdentifierDoubleFactory();
        
        $ids = [];
        $ids[] = $idFactory->createDummy();
        $ids[] = $idFactory->createDummy();
        $ids[] = $idFactory->createDummy();
        
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()
            ->createCountGetNameSpecifiers(3, $ids);
            
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($ids[0], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($ids[1], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($ids[2], FALSE)
            ->getDouble();
        
        $sut = new NestedNameSpecifierConstraint();
        $sut->addNameSpecifierConstraint($consts[0]);
        $sut->addNameSpecifierConstraint($consts[1]);
        $sut->addNameSpecifierConstraint($consts[2]);
        self::assertFalse($sut->matches($nnSpec));
    }
    
    /**
     * Tests that matches() returns TRUE when no constraint has been added 
     * and the nested name specifier is valid.
     */
    public function testMatchesReturnsTrueWhenNoConstraintAndNestedNameSpecifierIsValid(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()
            ->createCountGetNameSpecifiers(0, []);
        
        $sut = new NestedNameSpecifierConstraint();
        self::assertTrue($sut->matches($nnSpec));
    }
    
    /**
     * Tests that matches() returns TRUE when identifier constraints have 
     * been added and the nested name specifier is valid.
     */
    public function testMatchesReturnsTrueWhenIdentifierConstraintsAndNestedNameSpecifierIsValid(): void
    {
        $idFactory = $this->createIdentifierDoubleFactory();
        
        $ids = [];
        $ids[] = $idFactory->createDummy();
        $ids[] = $idFactory->createDummy();
        $ids[] = $idFactory->createDummy();
        
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()
            ->createCountGetNameSpecifiers(3, $ids);
            
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($ids[0], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($ids[1], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($ids[2], TRUE)
            ->getDouble();
        
        $sut = new NestedNameSpecifierConstraint();
        $sut->addNameSpecifierConstraint($consts[0]);
        $sut->addNameSpecifierConstraint($consts[1]);
        $sut->addNameSpecifierConstraint($consts[2]);
        self::assertTrue($sut->matches($nnSpec));
    }
    
    /**
     * Tests that failureReason() returns a string when not instance of 
     * NestedNameSpecifier.
     * 
     * @param   NestedNameSpecifierConstraint   $sut    The system under test.
     * 
     * @dataProvider    getSutProvider
     */
    public function testFailureReasonReturnsStringWhenNotInstanceNestedNameSpecifier(
        NestedNameSpecifierConstraint $sut
    ): void
    {
        self::assertRegExp(
            \sprintf(
                '`^Nested name specifier: .+ is not an instance of %s\\.$`', 
                \str_replace('\\', '\\\\', NestedNameSpecifier::class)
            ), 
            $sut->failureReason(NULL)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when no constraint has 
     * been added and the constraint count is not equal to the name specifier 
     * count.
     */
    public function testFailureReasonReturnsStringWhenNoConstraintAndConstraintCountNotEqualNameSpecifierCount(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()
            ->createCount(3);
        
        $sut = new NestedNameSpecifierConstraint();
        self::assertSame(
            'Nested name specifier: '.
            'nested name specifier should have 0 name specifier(s), got 3.', 
            $sut->failureReason($nnSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when identifier 
     * constraints have been added and the constraint count is not equal to 
     * the name specifier count.
     */
    public function testFailureReasonReturnsStringWhenIdentifierConstraintsAndConstraintCountNotEqualNameSpecifierCount(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()
            ->createCount(3);
        
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->getDouble();
        
        $sut = new NestedNameSpecifierConstraint();
        $sut->addNameSpecifierConstraint($consts[0]);
        self::assertSame(
            'Nested name specifier: '.
            'nested name specifier should have 1 name specifier(s), got 3.', 
            $sut->failureReason($nnSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when identifier 
     * constraints have been added and a name specifier is invalid.
     */
    public function testFailureReasonReturnsStringWhenIdentifierConstraintsAndNameSpecifierIsInvalid(): void
    {
        $idFactory = $this->createIdentifierDoubleFactory();
        
        $ids = [];
        $ids[] = $idFactory->createDummy();
        $ids[] = $idFactory->createDummy();
        $ids[] = $idFactory->createDummy();
        
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()
            ->createCountGetNameSpecifiers(3, $ids);
            
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($ids[0], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($ids[1], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($ids[2], FALSE)
            ->buildFailureReason(
                $ids[2], 
                "foo\n".
                "  bar\n".
                "    baz reason"
            )
            ->getDouble();
        
        $sut = new NestedNameSpecifierConstraint();
        $sut->addNameSpecifierConstraint($consts[0]);
        $sut->addNameSpecifierConstraint($consts[1]);
        $sut->addNameSpecifierConstraint($consts[2]);
        self::assertSame(
            "Nested name specifier\n".
            "  foo\n".
            "    bar\n".
            "      baz reason", 
            $sut->failureReason($nnSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when no constraint has 
     * been added and the nested name specifier is valid.
     */
    public function testFailureReasonReturnsStringWhenNoConstraintAndNestedNameSpecifierIsValid(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()
            ->createCountGetNameSpecifiers(0, []);
        
        $sut = new NestedNameSpecifierConstraint();
        self::assertSame(
            'Nested name specifier: Unknown reason.', 
            $sut->failureReason($nnSpec)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when identifier 
     * constraints have been added and the nested name specifier is valid.
     */
    public function testFailureReasonReturnsStringWhenIdentifierConstraintsAndNestedNameSpecifierIsValid(): void
    {
        $idFactory = $this->createIdentifierDoubleFactory();
        
        $ids = [];
        $ids[] = $idFactory->createDummy();
        $ids[] = $idFactory->createDummy();
        $ids[] = $idFactory->createDummy();
        
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()
            ->createCountGetNameSpecifiers(3, $ids);
            
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($ids[0], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($ids[1], TRUE)
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($ids[2], TRUE)
            ->getDouble();
        
        $sut = new NestedNameSpecifierConstraint();
        $sut->addNameSpecifierConstraint($consts[0]);
        $sut->addNameSpecifierConstraint($consts[1]);
        $sut->addNameSpecifierConstraint($consts[2]);
        self::assertSame(
            'Nested name specifier: Unknown reason.', 
            $sut->failureReason($nnSpec)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when no 
     * constraint has been added and not instance of NestedNameSpecifier.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenNoConstraintAndNotInstanceNestedNameSpecifier(): void
    {
        $sut = new NestedNameSpecifierConstraint();
        $pattern = \sprintf(
            "`^\n".
            "Nested name specifier \\(0\\)\n".
            "\n".
            "Nested name specifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', NestedNameSpecifier::class)
        );

        self::assertRegExp(
            $pattern, 
            $sut->additionalFailureDescription(NULL)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when 
     * identifier constraints have been added and not instance of 
     * NestedNameSpecifier.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenIdentifierConstraintsAndNotInstanceNestedNameSpecifier(): void
    {
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildConstraintDescription('foo')
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildConstraintDescription('bar')
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildConstraintDescription('baz')
            ->getDouble();
        
        $sut = new NestedNameSpecifierConstraint();
        $sut->addNameSpecifierConstraint($consts[0]);
        $sut->addNameSpecifierConstraint($consts[1]);
        $sut->addNameSpecifierConstraint($consts[2]);
        
        $pattern = \sprintf(
            "`^\n".
            "Nested name specifier \\(3\\)\n".
            "  foo\n".
            "  bar\n".
            "  baz\n".
            "\n".
            "Nested name specifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', NestedNameSpecifier::class)
        );

        self::assertRegExp(
            $pattern, 
            $sut->additionalFailureDescription(NULL)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when no 
     * constraint has been added and the constraint count is not equal to the 
     * name specifier count.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenNoConstraintAndConstraintCountNotEqualNameSpecifierCount(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()
            ->createCount(3);
        
        $sut = new NestedNameSpecifierConstraint();
        self::assertSame(
            "\n".
            "Nested name specifier (0)\n".
            "\n".
            "Nested name specifier: ".
            "nested name specifier should have 0 name specifier(s), got 3.", 
            $sut->additionalFailureDescription($nnSpec)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when 
     * identifier constraints have been added and the constraint count is not 
     * equal to the name specifier count.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenIdentifierConstraintsAndConstraintCountNotEqualNameSpecifierCount(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()
            ->createCount(3);
        
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildConstraintDescription('foo')
            ->getDouble();
        
        $sut = new NestedNameSpecifierConstraint();
        $sut->addNameSpecifierConstraint($consts[0]);
        self::assertSame(
            "\n".
            "Nested name specifier (1)\n".
            "  foo\n".
            "\n".
            "Nested name specifier: ".
            "nested name specifier should have 1 name specifier(s), got 3.", 
            $sut->additionalFailureDescription($nnSpec)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when 
     * identifier constraints have been added and a name specifier is invalid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenIdentifierConstraintsAndNameSpecifierIsInvalid(): void
    {
        $idFactory = $this->createIdentifierDoubleFactory();
        
        $ids = [];
        $ids[] = $idFactory->createDummy();
        $ids[] = $idFactory->createDummy();
        $ids[] = $idFactory->createDummy();
        
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()
            ->createCountGetNameSpecifiers(3, $ids);
            
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($ids[0], TRUE)
            ->buildConstraintDescription('foo')
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($ids[1], TRUE)
            ->buildConstraintDescription('bar')
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($ids[2], FALSE)
            ->buildConstraintDescription('baz')
            ->buildFailureReason(
                $ids[2], 
                "qux\n".
                "  foobar reason"
            )
            ->getDouble();
        
        $sut = new NestedNameSpecifierConstraint();
        $sut->addNameSpecifierConstraint($consts[0]);
        $sut->addNameSpecifierConstraint($consts[1]);
        $sut->addNameSpecifierConstraint($consts[2]);
        self::assertSame(
            "\n".
            "Nested name specifier (3)\n".
            "  foo\n".
            "  bar\n".
            "  baz\n".
            "\n".
            "Nested name specifier\n".
            "  qux\n".
            "    foobar reason", 
            $sut->additionalFailureDescription($nnSpec)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when no 
     * constraint has been added and the nested name specifier is valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenNoConstraintAndNestedNameSpecifierIsValid(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()
            ->createCountGetNameSpecifiers(0, []);
        
        $sut = new NestedNameSpecifierConstraint();
        self::assertSame(
            "\n".
            "Nested name specifier (0)\n".
            "\n".
            "Nested name specifier: Unknown reason.", 
            $sut->additionalFailureDescription($nnSpec)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when 
     * identifier constraints have been added and the nested name specifier 
     * is valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenIdentifierConstraintsAndNestedNameSpecifierIsValid(): void
    {
        $idFactory = $this->createIdentifierDoubleFactory();
        
        $ids = [];
        $ids[] = $idFactory->createDummy();
        $ids[] = $idFactory->createDummy();
        $ids[] = $idFactory->createDummy();
        
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()
            ->createCountGetNameSpecifiers(3, $ids);
            
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($ids[0], TRUE)
            ->buildConstraintDescription('foo')
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($ids[1], TRUE)
            ->buildConstraintDescription('bar')
            ->getDouble();
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildMatches($ids[2], TRUE)
            ->buildConstraintDescription('baz')
            ->getDouble();
        
        $sut = new NestedNameSpecifierConstraint();
        $sut->addNameSpecifierConstraint($consts[0]);
        $sut->addNameSpecifierConstraint($consts[1]);
        $sut->addNameSpecifierConstraint($consts[2]);
        self::assertSame(
            "\n".
            "Nested name specifier (3)\n".
            "  foo\n".
            "  bar\n".
            "  baz\n".
            "\n".
            "Nested name specifier: Unknown reason.", 
            $sut->additionalFailureDescription($nnSpec)
        );
    }
    
    /**
     * Tests that failureDescription() is called when no constraint has been 
     * added and the value is invalid.
     */
    public function testFailureDescriptionWhenNoConstraintAndNestedNameSpecifierIsInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a nested name specifier`');
        
        $sut = new NestedNameSpecifierConstraint();
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Tests that failureDescription() is called when identifier constraints 
     * have been added and the value is invalid.
     */
    public function testFailureDescriptionWhenIdentifierConstraintsAndNestedNameSpecifierIsInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a nested name specifier`');
        
        $consts = [];
        $consts[] = ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)
            ->buildConstraintDescription('foo')
            ->getDouble();
        
        $sut = new NestedNameSpecifierConstraint();
        $sut->addNameSpecifierConstraint($consts[0]);
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Returns the set of systems under test.
     * 
     * @return  array[]
     */
    public function getSutProvider(): array
    {
        $idConstSut = new NestedNameSpecifierConstraint();
        $idConstSut->addNameSpecifierConstraint(
            ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)->getDouble()
        );
        $idConstSut->addNameSpecifierConstraint(
            ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)->getDouble()
        );
        $idConstSut->addNameSpecifierConstraint(
            ConceptConstraintDoubleBuilder::createIdentifierConstraint($this)->getDouble()
        );
        
        return [
            'No constraint' => [
                new NestedNameSpecifierConstraint(), 
            ], 
            'Identifier constraints' => [
                $idConstSut, 
            ], 
        ];
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
    
    /**
     * Creates a factory of identifier doubles.
     * 
     * @return  IdentifierDoubleFactory
     */
    private function createIdentifierDoubleFactory(): IdentifierDoubleFactory
    {
        return new IdentifierDoubleFactory($this);
    }
}

