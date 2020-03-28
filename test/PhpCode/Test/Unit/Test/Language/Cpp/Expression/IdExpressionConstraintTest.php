<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\IdExpression;
use PhpCode\Test\Language\Cpp\ConceptConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\Expression\IdExpressionConstraint;
use PhpCode\Test\Language\Cpp\Expression\IdExpressionDoubleFactory;
use PhpCode\Test\Language\Cpp\Expression\QualifiedIdDoubleFactory;
use PhpCode\Test\Language\Cpp\Expression\UnqualifiedIdDoubleFactory;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Expression\IdExpressionConstraint} 
 * class.
 * 
 * @group   expression
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class IdExpressionConstraintTest extends TestCase
{
    /**
     * Tests that __construct() throws an exception.
     */
    public function test__constructThrowsException(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        
        $sut = new IdExpressionConstraint();
    }
    
    /**
     * Tests that toString() returns a string.
     * 
     * @param   IdExpressionConstraint  $sut    The system under test.
     * 
     * @dataProvider    getSutProvider
     */
    public function testToStringReturnsString(
        IdExpressionConstraint $sut
    ): void
    {
        self::assertSame('identifier expression', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string.
     * 
     * @param   IdExpressionConstraint  $sut    The system under test.
     * 
     * @dataProvider    getSutProvider
     */
    public function testGetConceptNameReturnsString(
        IdExpressionConstraint $sut
    ): void
    {
        self::assertSame('Identifier expression', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string.
     * 
     * @param   IdExpressionConstraint  $sut    The system under test.
     * 
     * @dataProvider    getSutProvider
     */
    public function testFailureDefaultReasonReturnsString(
        IdExpressionConstraint $sut
    ): void
    {
        self::assertSame(
            'Identifier expression: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createUnqualifiedId().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateUnqualifiedId(): void
    {
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->buildConstraintDescription(
                "foo UnqualifiedId\n".
                "  bar Identifier"
            )
            ->getDouble();
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
        self::assertSame(
            "Identifier expression\n".
            "  foo UnqualifiedId\n".
            "    bar Identifier", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createQualifiedId().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateQualifiedId(): void
    {
        $qidConst = ConceptConstraintDoubleBuilder::createQualifiedIdConstraint($this)
            ->buildConstraintDescription(
                "foo QualifiedId\n".
                "  bar NestedNameSpecifier\n".
                "  baz UnqualifiedId"
            )
            ->getDouble();
        
        $sut = IdExpressionConstraint::createQualifiedId($qidConst);
        self::assertSame(
            "Identifier expression\n".
            "  foo QualifiedId\n".
            "    bar NestedNameSpecifier\n".
            "    baz UnqualifiedId",
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when not instance of IdExpression.
     * 
     * @param   IdExpressionConstraint  $sut    The system under test.
     * 
     * @dataProvider    getSutProvider
     */
    public function testMatchesReturnsFalseWhenNotInstanceIdExpression(
        IdExpressionConstraint $sut
    ): void
    {
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createUnqualifiedId() and the unqualified identifier is invalid.
     */
    public function testMatchesReturnsFalseWhenCreateUnqualifiedIdAndUnqualifiedIdIsInvalid(): void
    {
        $uid = $this->createUnqualifiedIdDoubleFactory()->createDummy();
        $idExpr = $this->createIdExpressionDoubleFactory()
            ->createUnqualifiedId($uid);
        
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->buildMatches($uid, FALSE)
            ->getDouble();
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
        self::assertFalse($sut->matches($idExpr));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createQualifiedId() and the qualified identifier is invalid.
     */
    public function testMatchesReturnsFalseWhenCreateQualifiedIdAndQualifiedIdIsInvalid(): void
    {
        $qid = $this->createQualifiedIdDoubleFactory()->createDummy();
        $idExpr = $this->createIdExpressionDoubleFactory()
            ->createQualifiedId($qid);
        
        $qidConst = ConceptConstraintDoubleBuilder::createQualifiedIdConstraint($this)
            ->buildMatches($qid, FALSE)
            ->getDouble();
        
        $sut = IdExpressionConstraint::createQualifiedId($qidConst);
        self::assertFalse($sut->matches($idExpr));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createUnqualifiedId() and the identifier expression is defined as a 
     * qualified identifier.
     */
    public function testMatchesReturnsFalseWhenCreateUnqualifiedIdAndQualifiedId(): void
    {
        $qid = $this->createQualifiedIdDoubleFactory()->createDummy();
        $idExpr = $this->createIdExpressionDoubleFactory()
            ->createQualifiedId($qid);
        
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->buildMatches(NULL, FALSE)
            ->getDouble();
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
        self::assertFalse($sut->matches($idExpr));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createQualifiedId() and the identifier expression is defined as an 
     * unqualified identifier.
     */
    public function testMatchesReturnsFalseWhenCreateQualifiedIdAndUnqualifiedId(): void
    {
        $uid = $this->createUnqualifiedIdDoubleFactory()->createDummy();
        $idExpr = $this->createIdExpressionDoubleFactory()
            ->createUnqualifiedId($uid);
        
        $qidConst = ConceptConstraintDoubleBuilder::createQualifiedIdConstraint($this)
            ->buildMatches(NULL, FALSE)
            ->getDouble();
        
        $sut = IdExpressionConstraint::createQualifiedId($qidConst);
        self::assertFalse($sut->matches($idExpr));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createUnqualifiedId() and the identifier expression is valid.
     */
    public function testMatchesReturnsTrueWhenCreateUnqualifiedIdAndIdExpressionIsValid(): void
    {
        $uid = $this->createUnqualifiedIdDoubleFactory()->createDummy();
        $idExpr = $this->createIdExpressionDoubleFactory()
            ->createUnqualifiedId($uid);
        
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->buildMatches($uid, TRUE)
            ->getDouble();
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
        self::assertTrue($sut->matches($idExpr));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createQualifiedId() and the identifier expression is valid.
     */
    public function testMatchesReturnsTrueWhenCreateQualifiedIdAndIdExpressionIsValid(): void
    {
        $qid = $this->createQualifiedIdDoubleFactory()->createDummy();
        $idExpr = $this->createIdExpressionDoubleFactory()
            ->createQualifiedId($qid);
        
        $qidConst = ConceptConstraintDoubleBuilder::createQualifiedIdConstraint($this)
            ->buildMatches($qid, TRUE)
            ->getDouble();
        
        $sut = IdExpressionConstraint::createQualifiedId($qidConst);
        self::assertTrue($sut->matches($idExpr));
    }
    
    /**
     * Tests that failureReason() returns a string when not instance of 
     * IdExpression.
     * 
     * @param   IdExpressionConstraint  $sut    The system under test.
     * 
     * @dataProvider    getSutProvider
     */
    public function testFailureReasonReturnsStringWhenNotInstanceIdExpression(
        IdExpressionConstraint $sut
    ): void
    {
        self::assertRegExp(
            \sprintf(
                '`^Identifier expression: .+ is not an instance of %s\\.$`', 
                \str_replace('\\', '\\\\', IdExpression::class)
            ), 
            $sut->failureReason(NULL)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createUnqualifiedId() and the unqualified identifier is 
     * invalid.
     */
    public function testFailureReasonReturnsStringWhenCreateUnqualifiedIdAndUnqualifiedIdIsInvalid(): void
    {
        $uid = $this->createUnqualifiedIdDoubleFactory()->createDummy();
        $idExpr = $this->createIdExpressionDoubleFactory()
            ->createUnqualifiedId($uid);
        
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->buildMatches($uid, FALSE)
            ->buildFailureReason(
                $uid, 
                "foo UnqualifiedId\n".
                "  bar Identifier"
            )
            ->getDouble();
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
        self::assertSame(
            "Identifier expression\n".
            "  foo UnqualifiedId\n".
            "    bar Identifier", 
            $sut->failureReason($idExpr)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createQualifiedId() and the qualified identifier is invalid.
     */
    public function testFailureReasonReturnsStringWhenCreateQualifiedIdAndQualifiedIdIsInvalid(): void
    {
        $qid = $this->createQualifiedIdDoubleFactory()->createDummy();
        $idExpr = $this->createIdExpressionDoubleFactory()
            ->createQualifiedId($qid);
        
        $qidConst = ConceptConstraintDoubleBuilder::createQualifiedIdConstraint($this)
            ->buildMatches($qid, FALSE)
            ->buildFailureReason(
                $qid, 
                "foo QualifiedId\n".
                "  bar reason"
            )
            ->getDouble();
        
        $sut = IdExpressionConstraint::createQualifiedId($qidConst);
        self::assertSame(
            "Identifier expression\n".
            "  foo QualifiedId\n".
            "    bar reason", 
            $sut->failureReason($idExpr)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createUnqualifiedId() and the identifier expression is 
     * defined as a qualified identifier.
     */
    public function testFailureReasonReturnsStringWhenCreateUnqualifiedIdAndQualifiedId(): void
    {
        $qid = $this->createQualifiedIdDoubleFactory()->createDummy();
        $idExpr = $this->createIdExpressionDoubleFactory()
            ->createQualifiedId($qid);
        
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->buildMatches(NULL, FALSE)
            ->buildFailureReason(NULL, 'foo NULL reason')
            ->getDouble();
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
        self::assertSame(
            "Identifier expression\n".
            "  foo NULL reason", 
            $sut->failureReason($idExpr)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createQualifiedId() and the identifier expression is 
     * defined as an unqualified identifier.
     */
    public function testFailureReasonReturnsStringWhenCreateQualifiedIdAndUnqualifiedId(): void
    {
        $uid = $this->createUnqualifiedIdDoubleFactory()->createDummy();
        $idExpr = $this->createIdExpressionDoubleFactory()
            ->createUnqualifiedId($uid);
        
        $qidConst = ConceptConstraintDoubleBuilder::createQualifiedIdConstraint($this)
            ->buildMatches(NULL, FALSE)
            ->buildFailureReason(NULL, 'foo NULL reason')
            ->getDouble();
        
        $sut = IdExpressionConstraint::createQualifiedId($qidConst);
        self::assertSame(
            "Identifier expression\n".
            "  foo NULL reason", 
            $sut->failureReason($idExpr)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createUnqualifiedId() and the identifier expression is 
     * valid.
     */
    public function testFailureReasonReturnsStringWhenCreateUnqualifiedIdAndIdExpressionIsValid(): void
    {
        $uid = $this->createUnqualifiedIdDoubleFactory()->createDummy();
        $idExpr = $this->createIdExpressionDoubleFactory()
            ->createUnqualifiedId($uid);
        
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->buildMatches($uid, TRUE)
            ->getDouble();
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
        self::assertSame(
            'Identifier expression: Unknown reason.', 
            $sut->failureReason($idExpr)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createQualifiedId() and the identifier expression is valid.
     */
    public function testFailureReasonReturnsStringWhenCreateQualifiedIdAndIdExpressionIsValid(): void
    {
        $qid = $this->createQualifiedIdDoubleFactory()->createDummy();
        $idExpr = $this->createIdExpressionDoubleFactory()
            ->createQualifiedId($qid);
        
        $qidConst = ConceptConstraintDoubleBuilder::createQualifiedIdConstraint($this)
            ->buildMatches($qid, TRUE)
            ->getDouble();
        
        $sut = IdExpressionConstraint::createQualifiedId($qidConst);
        self::assertSame(
            'Identifier expression: Unknown reason.', 
            $sut->failureReason($idExpr)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createUnqualifiedId() and not instance of 
     * IdExpression.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateUnqualifiedIdAndNotInstanceIdExpression(): void
    {
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->buildConstraintDescription(
                "foo UnqualifiedId\n".
                "  bar Identifier"
            )
            ->getDouble();
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
        $pattern = \sprintf(
            "`^\n".
            "Identifier expression\n". 
            "  foo UnqualifiedId\n". 
            "    bar Identifier\n". 
            "\n".
            "Identifier expression: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', IdExpression::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createQualifiedId() and not instance of 
     * IdExpression.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateQualifiedIdAndNotInstanceIdExpression(): void
    {
        $qidConst = ConceptConstraintDoubleBuilder::createQualifiedIdConstraint($this)
            ->buildConstraintDescription(
                "foo QualifiedId\n".
                "  bar NestedNameSpecifier"
            )
            ->getDouble();
        
        $sut = IdExpressionConstraint::createQualifiedId($qidConst);
        $pattern = \sprintf(
            "`^\n".
            "Identifier expression\n". 
            "  foo QualifiedId\n". 
            "    bar NestedNameSpecifier\n". 
            "\n".
            "Identifier expression: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', IdExpression::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createUnqualifiedId() and the unqualified 
     * identifier is invalid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateUnqualifiedIdAndUnqualifiedIdIsInvalid(): void
    {
        $uid = $this->createUnqualifiedIdDoubleFactory()->createDummy();
        $idExpr = $this->createIdExpressionDoubleFactory()
            ->createUnqualifiedId($uid);
        
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->buildMatches($uid, FALSE)
            ->buildFailureReason(
                $uid, 
                "foo\n".
                "  bar reason"
            )
            ->buildConstraintDescription(
                "foo description\n".
                "  bar description"
            )
            ->getDouble();
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
        self::assertSame(
            "\n".
            "Identifier expression\n".
            "  foo description\n".
            "    bar description\n".
            "\n".
            "Identifier expression\n".
            "  foo\n". 
            "    bar reason", 
            $sut->additionalFailureDescription($idExpr)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createQualifiedId() and the qualified 
     * identifier is invalid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateQualifiedIdAndQualifiedIdIsInvalid(): void
    {
        $qid = $this->createQualifiedIdDoubleFactory()->createDummy();
        $idExpr = $this->createIdExpressionDoubleFactory()
            ->createQualifiedId($qid);
        
        $qidConst = ConceptConstraintDoubleBuilder::createQualifiedIdConstraint($this)
            ->buildMatches($qid, FALSE)
            ->buildFailureReason(
                $qid, 
                "foo\n".
                "  bar reason"
            )
            ->buildConstraintDescription(
                "foo description\n".
                "  bar description"
            )
            ->getDouble();
        
        $sut = IdExpressionConstraint::createQualifiedId($qidConst);
        self::assertSame(
            "\n".
            "Identifier expression\n".
            "  foo description\n".
            "    bar description\n".
            "\n".
            "Identifier expression\n".
            "  foo\n". 
            "    bar reason", 
            $sut->additionalFailureDescription($idExpr)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createUnqualifiedId() and the identifier 
     * expression is defined as a qualified identifier.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateUnqualifiedIdAndQualifiedId(): void
    {
        $qid = $this->createQualifiedIdDoubleFactory()->createDummy();
        $idExpr = $this->createIdExpressionDoubleFactory()
            ->createQualifiedId($qid);
        
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->buildMatches(NULL, FALSE)
            ->buildConstraintDescription('foo description')
            ->buildFailureReason(NULL, 'bar NULL reason')
            ->getDouble();
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
        self::assertSame(
            "\n".
            "Identifier expression\n".
            "  foo description\n".
            "\n".
            "Identifier expression\n".
            "  bar NULL reason", 
            $sut->additionalFailureDescription($idExpr)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createQualifiedId() and the identifier 
     * expression is defined as an unqualified identifier.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateQualifiedIdAndUnqualifiedId(): void
    {
        $uid = $this->createUnqualifiedIdDoubleFactory()->createDummy();
        $idExpr = $this->createIdExpressionDoubleFactory()
            ->createUnqualifiedId($uid);
        
        $qidConst = ConceptConstraintDoubleBuilder::createQualifiedIdConstraint($this)
            ->buildMatches(NULL, FALSE)
            ->buildConstraintDescription('foo description')
            ->buildFailureReason(NULL, 'bar NULL reason')
            ->getDouble();
        
        $sut = IdExpressionConstraint::createQualifiedId($qidConst);
        self::assertSame(
            "\n".
            "Identifier expression\n".
            "  foo description\n".
            "\n".
            "Identifier expression\n".
            "  bar NULL reason", 
            $sut->additionalFailureDescription($idExpr)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createUnqualifiedId() and the identifier 
     * expression is valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateUnqualifiedIdAndIdExpressionIsValid(): void
    {
        $uid = $this->createUnqualifiedIdDoubleFactory()->createDummy();
        $idExpr = $this->createIdExpressionDoubleFactory()
            ->createUnqualifiedId($uid);
        
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->buildMatches($uid, TRUE)
            ->buildConstraintDescription(
                "foo description\n".
                "  bar description"
            )
            ->getDouble();
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
        self::assertSame(
            "\n".
            "Identifier expression\n".
            "  foo description\n".
            "    bar description\n".
            "\n".
            "Identifier expression: Unknown reason.", 
            $sut->additionalFailureDescription($idExpr)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createQualifiedId() and the identifier 
     * expression is valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateQualifiedIdAndIdExpressionIsValid(): void
    {
        $qid = $this->createQualifiedIdDoubleFactory()->createDummy();
        $idExpr = $this->createIdExpressionDoubleFactory()
            ->createQualifiedId($qid);
        
        $qidConst = ConceptConstraintDoubleBuilder::createQualifiedIdConstraint($this)
            ->buildMatches($qid, TRUE)
            ->buildConstraintDescription(
                "foo description\n".
                "  bar description"
            )
            ->getDouble();
        
        $sut = IdExpressionConstraint::createQualifiedId($qidConst);
        self::assertSame(
            "\n".
            "Identifier expression\n".
            "  foo description\n".
            "    bar description\n".
            "\n".
            "Identifier expression: Unknown reason.", 
            $sut->additionalFailureDescription($idExpr)
        );
    }
    
    /**
     * Tests that failureDescription() is called when the instance is created 
     * by createUnqualifiedId() and the value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenCreateUnqualifiedIdAndValueIsInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is an identifier expression`');
        
        $uidConst = ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
            ->buildConstraintDescription('foo description')
            ->getDouble();
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Tests that failureDescription() is called when the instance is created 
     * by createQualifiedId() and the value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenCreateQualifiedIdAndValueIsInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is an identifier expression`');
        
        $qidConst = ConceptConstraintDoubleBuilder::createQualifiedIdConstraint($this)
            ->buildConstraintDescription('foo description')
            ->getDouble();
        
        $sut = IdExpressionConstraint::createQualifiedId($qidConst);
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
            'Unqualified identifier' => [
                IdExpressionConstraint::createUnqualifiedId(
                    ConceptConstraintDoubleBuilder::createUnqualifiedIdConstraint($this)
                        ->getDouble()
                ), 
            ], 
            'Qualified identifier' => [
                IdExpressionConstraint::createQualifiedId(
                    ConceptConstraintDoubleBuilder::createQualifiedIdConstraint($this)
                        ->getDouble()
                ), 
            ], 
        ];
    }
    
    /**
     * Creates a factory of identifier expression doubles.
     * 
     * @return  IdExpressionDoubleFactory
     */
    private function createIdExpressionDoubleFactory(): IdExpressionDoubleFactory
    {
        return new IdExpressionDoubleFactory($this);
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
    
    /**
     * Creates a factory of qualified identifier doubles.
     * 
     * @return  QualifiedIdDoubleFactory
     */
    private function createQualifiedIdDoubleFactory(): QualifiedIdDoubleFactory
    {
        return new QualifiedIdDoubleFactory($this);
    }
}

