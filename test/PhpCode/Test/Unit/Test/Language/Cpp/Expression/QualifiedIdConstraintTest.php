<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\QualifiedId;
use PhpCode\Test\Language\Cpp\ConceptConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\Expression\NestedNameSpecifierDoubleFactory;
use PhpCode\Test\Language\Cpp\Expression\QualifiedIdConstraint;
use PhpCode\Test\Language\Cpp\Expression\QualifiedIdDoubleFactory;
use PhpCode\Test\Language\Cpp\Expression\UnqualifiedIdDoubleFactory;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Expression\QualifiedIdConstraint} 
 * class.
 * 
 * @group   expression
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class QualifiedIdConstraintTest extends TestCase
{
    /**
     * Tests that toString() returns a string.
     */
    public function testToStringReturnsString(): void
    {
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->getDouble();
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->getDouble();
        
        $sut = new QualifiedIdConstraint($nnSpecConst, $uidConst);
        self::assertSame('qualified identifier', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string.
     */
    public function testGetConceptNameReturnsString(): void
    {
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->getDouble();
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->getDouble();
        
        $sut = new QualifiedIdConstraint($nnSpecConst, $uidConst);
        self::assertSame('Qualified identifier', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string.
     */
    public function testFailureDefaultReasonReturnsString(): void
    {
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->getDouble();
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->getDouble();
        
        $sut = new QualifiedIdConstraint($nnSpecConst, $uidConst);
        self::assertSame(
            'Qualified identifier: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string.
     */
    public function testConstraintDescriptionReturnsString(): void
    {
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->buildConstraintDescription(
                "foo\n".
                "  bar"
            )
            ->getDouble();
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->buildConstraintDescription(
                "baz\n".
                "  qux"
            )
            ->getDouble();
        
        $sut = new QualifiedIdConstraint($nnSpecConst, $uidConst);
        self::assertSame(
            "Qualified identifier\n".
            "  foo\n".
            "    bar\n".
            "  baz\n".
            "    qux", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when not instance of QualifiedId.
     */
    public function testMatchesReturnsFalseWhenNotInstanceQualifiedId(): void
    {
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->getDouble();
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->getDouble();
        
        $sut = new QualifiedIdConstraint($nnSpecConst, $uidConst);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the nested name specifier is 
     * invalid.
     */
    public function testMatchesReturnsFalseWhenNestedNameSpecifierIsInvalid(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()->createDummy();
        $qid = $this->createQualifiedIdDoubleFactory()
            ->createGetNestedNameSpecifier($nnSpec);
        
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->buildMatches($nnSpec, FALSE)
            ->getDouble();
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->getDouble();
        
        $sut = new QualifiedIdConstraint($nnSpecConst, $uidConst);
        self::assertFalse($sut->matches($qid));
    }
    
    /**
     * Tests that matches() returns FALSE when the unqualified identifier is 
     * invalid.
     */
    public function testMatchesReturnsFalseWhenUnqualifiedIdIsInvalid(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()->createDummy();
        $uid = $this->createUnqualifiedIdDoubleFactory()->createDummy();
        $qid = $this->createQualifiedIdDoubleFactory()
            ->createGetNestedNameSpecifierGetUnqualifiedId($nnSpec, $uid);
        
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->buildMatches($nnSpec, TRUE)
            ->getDouble();
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->buildMatches($uid, FALSE)
            ->getDouble();
        
        $sut = new QualifiedIdConstraint($nnSpecConst, $uidConst);
        self::assertFalse($sut->matches($qid));
    }
    
    /**
     * Tests that matches() returns TRUE when the qualified identifier is 
     * valid.
     */
    public function testMatchesReturnsTrueWhenQualifiedIdIsValid(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()->createDummy();
        $uid = $this->createUnqualifiedIdDoubleFactory()->createDummy();
        $qid = $this->createQualifiedIdDoubleFactory()
            ->createGetNestedNameSpecifierGetUnqualifiedId($nnSpec, $uid);
        
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->buildMatches($nnSpec, TRUE)
            ->getDouble();
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->buildMatches($uid, TRUE)
            ->getDouble();
        
        $sut = new QualifiedIdConstraint($nnSpecConst, $uidConst);
        self::assertTrue($sut->matches($qid));
    }
    
    /**
     * Tests that failureReason() returns a string when not instance of 
     * QualifiedId.
     */
    public function testFailureReasonReturnsStringNotInstanceQualifiedId(): void
    {
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->getDouble();
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->getDouble();
        
        $sut = new QualifiedIdConstraint($nnSpecConst, $uidConst);
        self::assertRegExp(
            \sprintf(
                '`^Qualified identifier: .+ is not an instance of %s\\.$`', 
                \str_replace('\\', '\\\\', QualifiedId::class)
            ), 
            $sut->failureReason(NULL)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the nested name 
     * specifier is invalid.
     */
    public function testFailureReasonReturnsStringWhenNestedNameSpecifierIsInvalid(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()->createDummy();
        $qid = $this->createQualifiedIdDoubleFactory()
            ->createGetNestedNameSpecifier($nnSpec);
        
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->buildMatches($nnSpec, FALSE)
            ->buildFailureReason(
                $nnSpec, 
                "foo\n".
                "  bar reason"
            )
            ->getDouble();
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->getDouble();
        
        $sut = new QualifiedIdConstraint($nnSpecConst, $uidConst);
        self::assertSame(
            "Qualified identifier\n".
            "  foo\n".
            "    bar reason", 
            $sut->failureReason($qid)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the unqualified 
     * identifier is invalid.
     */
    public function testFailureReasonReturnsStringWhenUnqualifiedIdIsInvalid(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()->createDummy();
        $uid = $this->createUnqualifiedIdDoubleFactory()->createDummy();
        $qid = $this->createQualifiedIdDoubleFactory()
            ->createGetNestedNameSpecifierGetUnqualifiedId($nnSpec, $uid);
        
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->buildMatches($nnSpec, TRUE)
            ->getDouble();
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->buildMatches($uid, FALSE)
            ->buildFailureReason(
                $uid, 
                "baz\n".
                "  qux reason"
            )
            ->getDouble();
        
        $sut = new QualifiedIdConstraint($nnSpecConst, $uidConst);
        self::assertSame(
            "Qualified identifier\n".
            "  baz\n".
            "    qux reason", 
            $sut->failureReason($qid)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the qualified 
     * identifier is valid.
     */
    public function testFailureReasonReturnsStringWhenQualifiedIdIsValid(): void
    {
        $nnSpec = $this->createNestedNameSpecifierDoubleFactory()->createDummy();
        $uid = $this->createUnqualifiedIdDoubleFactory()->createDummy();
        $qid = $this->createQualifiedIdDoubleFactory()
            ->createGetNestedNameSpecifierGetUnqualifiedId($nnSpec, $uid);
        
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->buildMatches($nnSpec, TRUE)
            ->getDouble();
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->buildMatches($uid, TRUE)
            ->getDouble();
        
        $sut = new QualifiedIdConstraint($nnSpecConst, $uidConst);
        self::assertSame(
            'Qualified identifier: Unknown reason.', 
            $sut->failureReason($qid)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure.
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReason(): void
    {
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->buildConstraintDescription(
                "foo\n".
                "  bar"
            )
            ->getDouble();
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->buildConstraintDescription(
                "baz\n".
                "  qux"
            )
            ->getDouble();
        
        $sut = new QualifiedIdConstraint($nnSpecConst, $uidConst);
        $pattern = \sprintf(
            "`^\n".
            "Qualified identifier\n". 
            "  foo\n". 
            "    bar\n". 
            "  baz\n". 
            "    qux\n". 
            "\n". 
            "Qualified identifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', QualifiedId::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that failureDescription() is called when the value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenValueIsInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a qualified identifier`');
        
        $nnSpecConst = ConceptConstraintDoubleBuilder::createNestedNameSpecifierConstraint($this)
            ->buildConstraintDescription('Nested name specifier description')
            ->getDouble();
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->buildConstraintDescription('Unqualified identifier description')
            ->getDouble();
        
        $sut = new QualifiedIdConstraint($nnSpecConst, $uidConst);
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Creates a factory of qualified identifier doubles.
     * 
     * @return  QualifiedIdDoubleFactory
     */
    private function createQualifiedIdDoubleFactory(): QualifiedIdDoubleFactory
    {
        return new QualifiedIdDoubleFactory($this);
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
     * Creates a factory of unqualified identifier doubles.
     * 
     * @return  UnqualifiedIdDoubleFactory
     */
    private function createUnqualifiedIdDoubleFactory(): UnqualifiedIdDoubleFactory
    {
        return new UnqualifiedIdDoubleFactory($this);
    }
}

