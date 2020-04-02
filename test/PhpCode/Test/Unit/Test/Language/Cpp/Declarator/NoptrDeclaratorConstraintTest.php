<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\NoptrDeclarator;
use PhpCode\Test\Language\Cpp\ConceptConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\NoptrDeclaratorConstraint;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Declarator\NoptrDeclaratorConstraint} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NoptrDeclaratorConstraintTest extends TestCase
{
    /**
     * Tests that __construct() throws an exception.
     */
    public function test__constructThrowsException(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        
        $sut = new NoptrDeclaratorConstraint();
    }
    
    /**
     * Tests that toString() returns a string when the instance is created 
     * by createDeclaratorId().
     */
    public function testToStringReturnsStringWhenCreateDId(): void
    {
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildToString('foo declarator identifier')
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorId($didConst);
        self::assertSame(
            'no-pointer declarator with foo declarator identifier', 
            $sut->toString()
        );
    }
    
    /**
     * Tests that toString() returns a string when the instance is created 
     * by createDeclaratorIdParametersAndQualifiers().
     */
    public function testToStringReturnsStringWhenCreateDIdPQual(): void
    {
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildToString('foo declarator identifier')
            ->getDouble();
        $prmQualConst = ConceptConstraintDoubleBuilder::createParametersAndQualifiersConstraint($this)
            ->buildToString('bar parameters and qualifiers')
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorIdParametersAndQualifiers(
            $didConst, 
            $prmQualConst
        );
        self::assertSame(
            'no-pointer declarator with foo declarator identifier and '.
            'bar parameters and qualifiers', 
            $sut->toString()
        );
    }
    
    /**
     * Tests that getConceptName() returns a string when the instance is 
     * created by createDeclaratorId().
     */
    public function testGetConceptNameReturnsStringWhenCreateDId(): void
    {
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildToString('foo declarator identifier')
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorId($didConst);
        self::assertSame(
            'No-pointer declarator with foo declarator identifier', 
            $sut->getConceptName()
        );
    }
    
    /**
     * Tests that getConceptName() returns a string when the instance is 
     * created by createDeclaratorIdParametersAndQualifiers().
     */
    public function testGetConceptNameReturnsStringWhenCreateDIdPQual(): void
    {
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildToString('foo declarator identifier')
            ->getDouble();
        $prmQualConst = ConceptConstraintDoubleBuilder::createParametersAndQualifiersConstraint($this)
            ->buildToString('bar parameters and qualifiers')
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorIdParametersAndQualifiers(
            $didConst, 
            $prmQualConst
        );
        self::assertSame(
            'No-pointer declarator with foo declarator identifier and '.
            'bar parameters and qualifiers', 
            $sut->getConceptName()
        );
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when the instance 
     * is created by createDeclaratorId().
     */
    public function testFailureDefaultReasonReturnsStringWhenCreateDId(): void
    {
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildToString('foo declarator identifier')
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorId($didConst);
        self::assertSame(
            'No-pointer declarator with foo declarator identifier: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when the instance 
     * is created by createDeclaratorIdParametersAndQualifiers().
     */
    public function testFailureDefaultReasonReturnsStringWhenCreateDIdPQual(): void
    {
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildToString('foo declarator identifier')
            ->getDouble();
        $prmQualConst = ConceptConstraintDoubleBuilder::createParametersAndQualifiersConstraint($this)
            ->buildToString('bar parameters and qualifiers')
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorIdParametersAndQualifiers(
            $didConst, 
            $prmQualConst
        );
        self::assertSame(
            'No-pointer declarator with foo declarator identifier and '.
            'bar parameters and qualifiers: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createDeclaratorId().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateDId(): void
    {
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildToString('foo declarator identifier')
            ->buildConstraintDescription(
                "foo DeclaratorId\n".
                "  foo IdExpression"
            )
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorId($didConst);
        self::assertSame(
            "No-pointer declarator with foo declarator identifier\n".
            "  foo DeclaratorId\n".
            "    foo IdExpression", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createDeclaratorIdParametersAndQualifiers().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateDIdPQual(): void
    {
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildToString('foo declarator identifier')
            ->buildConstraintDescription(
                "foo DeclaratorId\n".
                "  foo IdExpression"
            )
            ->getDouble();
        $prmQualConst = ConceptConstraintDoubleBuilder::createParametersAndQualifiersConstraint($this)
            ->buildToString('bar parameters and qualifiers')
            ->buildConstraintDescription(
                "bar ParameterDeclarationClause\n".
                "  bar ParameterDeclarationList"
            )
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorIdParametersAndQualifiers(
            $didConst, 
            $prmQualConst
        );
        self::assertSame(
            "No-pointer declarator with foo declarator identifier and ".
            "bar parameters and qualifiers\n".
            "  foo DeclaratorId\n".
            "    foo IdExpression\n".
            "  bar ParameterDeclarationClause\n".
            "    bar ParameterDeclarationList", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createDeclaratorId() and not instance of NoptrDeclarator.
     */
    public function testMatchesReturnsFalseWhenCreateDIdAndNotInstanceNoptrDeclarator(): void
    {
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorId($didConst);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createDeclaratorIdParametersAndQualifiers() and not instance of 
     * NoptrDeclarator.
     */
    public function testMatchesReturnsFalseWhenCreateDIdPQualAndNotInstanceNoptrDeclarator(): void
    {
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->getDouble();
        $prmQualConst = ConceptConstraintDoubleBuilder::createParametersAndQualifiersConstraint($this)
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorIdParametersAndQualifiers(
            $didConst, 
            $prmQualConst
        );
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createDeclaratorId() and the declarator identifier is invalid.
     */
    public function testMatchesReturnsFalseWhenCreateDIdAndDeclaratorIdIsInvalid(): void
    {
        $did = ConceptDoubleBuilder::createDeclaratorId($this)->getDouble();
        $noptrDecl = ConceptDoubleBuilder::createNoptrDeclarator($this)
            ->buildGetDeclaratorId($did)
            ->getDouble();
        
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildMatches($did, FALSE)
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorId($didConst);
        self::assertFalse($sut->matches($noptrDecl));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createDeclaratorIdParametersAndQualifiers() and the declarator 
     * identifier is invalid.
     */
    public function testMatchesReturnsFalseWhenCreateDIdPQualAndDeclaratorIdIsInvalid(): void
    {
        $did = ConceptDoubleBuilder::createDeclaratorId($this)->getDouble();
        $noptrDecl = ConceptDoubleBuilder::createNoptrDeclarator($this)
            ->buildGetDeclaratorId($did)
            ->getDouble();
        
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildMatches($did, FALSE)
            ->getDouble();
        $prmQualConst = ConceptConstraintDoubleBuilder::createParametersAndQualifiersConstraint($this)
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorIdParametersAndQualifiers(
            $didConst, 
            $prmQualConst
        );
        self::assertFalse($sut->matches($noptrDecl));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createDeclaratorId() and the no-pointer declarator contains parameters 
     * and qualifiers.
     */
    public function testMatchesReturnsFalseWhenCreateDIdAndNoptrDeclaratorContainsParametersAndQualifiers(): void
    {
        $did = ConceptDoubleBuilder::createDeclaratorId($this)->getDouble();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->getDouble();
        $noptrDecl = ConceptDoubleBuilder::createNoptrDeclarator($this)
            ->buildGetDeclaratorId($did)
            ->buildGetParametersAndQualifiers($prmQual)
            ->getDouble();
        
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildMatches($did, TRUE)
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorId($didConst);
        self::assertFalse($sut->matches($noptrDecl));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createDeclaratorIdParametersAndQualifiers() and parameters and 
     * qualifiers are invalid.
     */
    public function testMatchesReturnsFalseWhenCreateDIdPQualAndParametersAndQualifiersAreInvalid(): void
    {
        $did = ConceptDoubleBuilder::createDeclaratorId($this)->getDouble();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->getDouble();
        $noptrDecl = ConceptDoubleBuilder::createNoptrDeclarator($this)
            ->buildGetDeclaratorId($did)
            ->buildGetParametersAndQualifiers($prmQual)
            ->getDouble();
        
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildMatches($did, TRUE)
            ->getDouble();
        $prmQualConst = ConceptConstraintDoubleBuilder::createParametersAndQualifiersConstraint($this)
            ->buildMatches($prmQual, FALSE)
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorIdParametersAndQualifiers(
            $didConst, 
            $prmQualConst
        );
        self::assertFalse($sut->matches($noptrDecl));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createDeclaratorId() and the no-pointer declarator is valid.
     */
    public function testMatchesReturnsTrueWhenCreateDIdAndNoptrDeclaratorIsValid(): void
    {
        $did = ConceptDoubleBuilder::createDeclaratorId($this)->getDouble();
        $noptrDecl = ConceptDoubleBuilder::createNoptrDeclarator($this)
            ->buildGetDeclaratorId($did)
            ->buildGetParametersAndQualifiers()
            ->getDouble();
        
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildMatches($did, TRUE)
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorId($didConst);
        self::assertTrue($sut->matches($noptrDecl));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createDeclaratorIdParametersAndQualifiers() and the no-pointer 
     * declarator is valid.
     */
    public function testMatchesReturnsTrueWhenCreateDIdPQualAndNoptrDeclaratorIsValid(): void
    {
        $did = ConceptDoubleBuilder::createDeclaratorId($this)->getDouble();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->getDouble();
        $noptrDecl = ConceptDoubleBuilder::createNoptrDeclarator($this)
            ->buildGetDeclaratorId($did)
            ->buildGetParametersAndQualifiers($prmQual)
            ->getDouble();
        
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildMatches($did, TRUE)
            ->getDouble();
        $prmQualConst = ConceptConstraintDoubleBuilder::createParametersAndQualifiersConstraint($this)
            ->buildMatches($prmQual, TRUE)
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorIdParametersAndQualifiers(
            $didConst, 
            $prmQualConst
        );
        self::assertTrue($sut->matches($noptrDecl));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createDeclaratorId() and not instance of NoptrDeclarator.
     */
    public function testFailureReasonReturnsStringWhenCreateDIdAndNotInstanceNoptrDeclarator(): void
    {
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildToString('foo declarator identifier')
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorId($didConst);
        $pattern = \sprintf(
            '`^No-pointer declarator with foo declarator identifier: '.
            '.+ is not an instance of %s\\.$`', 
            \str_replace('\\', '\\\\', NoptrDeclarator::class)
        );
        self::assertRegExp($pattern, $sut->failureReason(NULL));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createDeclaratorIdParametersAndQualifiers() and not 
     * instance of NoptrDeclarator.
     */
    public function testFailureReasonReturnsStringWhenCreateDIdPQualAndNotInstanceNoptrDeclarator(): void
    {
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildToString('foo declarator identifier')
            ->getDouble();
        $prmQualConst = ConceptConstraintDoubleBuilder::createParametersAndQualifiersConstraint($this)
            ->buildToString('bar parameters and qualifiers')
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorIdParametersAndQualifiers(
            $didConst, 
            $prmQualConst
        );
        $pattern = \sprintf(
            '`^No-pointer declarator with foo declarator identifier and '.
            'bar parameters and qualifiers: .+ is not an instance of %s\\.$`', 
            \str_replace('\\', '\\\\', NoptrDeclarator::class)
        );
        self::assertRegExp($pattern, $sut->failureReason(NULL));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createDeclaratorId() and the declarator identifier is 
     * invalid.
     */
    public function testFailureReasonReturnsStringWhenCreateDIdAndDeclaratorIdIsInvalid(): void
    {
        $did = ConceptDoubleBuilder::createDeclaratorId($this)->getDouble();
        $noptrDecl = ConceptDoubleBuilder::createNoptrDeclarator($this)
            ->buildGetDeclaratorId($did)
            ->getDouble();
        
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildMatches($did, FALSE)
            ->buildToString('foo declarator identifier')
            ->buildFailureReason($did, 'foo reason')
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorId($didConst);
        self::assertSame(
            "No-pointer declarator with foo declarator identifier\n".
            "  foo reason", 
            $sut->failureReason($noptrDecl
        ));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createDeclaratorIdParametersAndQualifiers() and the 
     * declarator identifier is invalid.
     */
    public function testFailureReasonReturnsStringWhenCreateDIdPQualAndDeclaratorIdIsInvalid(): void
    {
        $did = ConceptDoubleBuilder::createDeclaratorId($this)->getDouble();
        $noptrDecl = ConceptDoubleBuilder::createNoptrDeclarator($this)
            ->buildGetDeclaratorId($did)
            ->getDouble();
        
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildMatches($did, FALSE)
            ->buildToString('foo declarator identifier')
            ->buildFailureReason($did, 'foo reason')
            ->getDouble();
        $prmQualConst = ConceptConstraintDoubleBuilder::createParametersAndQualifiersConstraint($this)
            ->buildToString('bar parameters and qualifiers')
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorIdParametersAndQualifiers(
            $didConst, 
            $prmQualConst
        );
        self::assertSame(
            "No-pointer declarator with foo declarator identifier and ".
            "bar parameters and qualifiers\n".
            "  foo reason", 
            $sut->failureReason($noptrDecl)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createDeclaratorId() and the no-pointer declarator contains 
     * parameters and qualifiers.
     */
    public function testFailureReasonReturnsStringWhenCreateDIdAndNoptrDeclaratorContainsParametersAndQualifiers(): void
    {
        $did = ConceptDoubleBuilder::createDeclaratorId($this)->getDouble();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->getDouble();
        $noptrDecl = ConceptDoubleBuilder::createNoptrDeclarator($this)
            ->buildGetDeclaratorId($did)
            ->buildGetParametersAndQualifiers($prmQual)
            ->getDouble();
        
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildMatches($did, TRUE)
            ->buildToString('foo declarator identifier')
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorId($didConst);
        self::assertSame(
            'No-pointer declarator with foo declarator identifier: '.
            'Unexpected parameters and qualifiers.', 
            $sut->failureReason($noptrDecl)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createDeclaratorIdParametersAndQualifiers() and parameters 
     * and qualifiers are invalid.
     */
    public function testFailureReasonReturnsStringWhenCreateDIdPQualAndParametersAndQualifiersAreInvalid(): void
    {
        $did = ConceptDoubleBuilder::createDeclaratorId($this)->getDouble();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->getDouble();
        $noptrDecl = ConceptDoubleBuilder::createNoptrDeclarator($this)
            ->buildGetDeclaratorId($did)
            ->buildGetParametersAndQualifiers($prmQual)
            ->getDouble();
        
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildMatches($did, TRUE)
            ->buildToString('foo declarator identifier')
            ->getDouble();
        $prmQualConst = ConceptConstraintDoubleBuilder::createParametersAndQualifiersConstraint($this)
            ->buildMatches($prmQual, FALSE)
            ->buildToString('bar parameters and qualifiers')
            ->buildFailureReason($prmQual, 'bar reason')
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorIdParametersAndQualifiers(
            $didConst, 
            $prmQualConst
        );
        self::assertSame(
            "No-pointer declarator with foo declarator identifier and ".
            "bar parameters and qualifiers\n".
            "  bar reason", 
            $sut->failureReason($noptrDecl)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createDeclaratorId() and the no-pointer declarator is valid.
     */
    public function testFailureReasonReturnsStringWhenCreateDIdAndNoptrDeclaratorIsValid(): void
    {
        $did = ConceptDoubleBuilder::createDeclaratorId($this)->getDouble();
        $noptrDecl = ConceptDoubleBuilder::createNoptrDeclarator($this)
            ->buildGetDeclaratorId($did)
            ->buildGetParametersAndQualifiers()
            ->getDouble();
        
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildMatches($did, TRUE)
            ->buildToString('foo declarator identifier')
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorId($didConst);
        self::assertSame(
            'No-pointer declarator with foo declarator identifier: Unknown reason.', 
            $sut->failureReason($noptrDecl)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createDeclaratorIdParametersAndQualifiers() and the 
     * no-pointer declarator is valid.
     */
    public function testFailureReasonReturnsStringWhenCreateDIdPQualAndNoptrDeclaratorIsValid(): void
    {
        $did = ConceptDoubleBuilder::createDeclaratorId($this)->getDouble();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->getDouble();
        $noptrDecl = ConceptDoubleBuilder::createNoptrDeclarator($this)
            ->buildGetDeclaratorId($did)
            ->buildGetParametersAndQualifiers($prmQual)
            ->getDouble();
        
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildMatches($did, TRUE)
            ->buildToString('foo declarator identifier')
            ->getDouble();
        $prmQualConst = ConceptConstraintDoubleBuilder::createParametersAndQualifiersConstraint($this)
            ->buildMatches($prmQual, TRUE)
            ->buildToString('bar parameters and qualifiers')
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorIdParametersAndQualifiers(
            $didConst, 
            $prmQualConst
        );
        self::assertSame(
            'No-pointer declarator with foo declarator identifier and '.
            'bar parameters and qualifiers: Unknown reason.', 
            $sut->failureReason($noptrDecl)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by createDeclaratorId().
     */
    public function testAdditionalFailureReasonReturnsConstraintDescriptionAndFailureReasonWhenCreateDId(): void
    {
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildToString('foo declarator identifier')
            ->buildConstraintDescription('foo declarator identifier description')
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorId($didConst);
        $pattern = \sprintf(
            "`^\n".
            "No-pointer declarator with foo declarator identifier\n".
            "  foo declarator identifier description\n".
            "\n".
            "No-pointer declarator with foo declarator identifier: ".
            ".+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', NoptrDeclarator::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * the instance is created by createDeclaratorIdParametersAndQualifiers().
     */
    public function testAdditionalFailureReasonReturnsConstraintDescriptionAndFailureReasonWhenCreateDIdPQual(): void
    {
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildToString('foo declarator identifier')
            ->buildConstraintDescription('foo declarator identifier description')
            ->getDouble();
        $prmQualConst = ConceptConstraintDoubleBuilder::createParametersAndQualifiersConstraint($this)
            ->buildToString('bar parameters and qualifiers')
            ->buildConstraintDescription('bar parameters and qualifiers description')
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorIdParametersAndQualifiers(
            $didConst, 
            $prmQualConst
        );
        $pattern = \sprintf(
            "`^\n".
            "No-pointer declarator with foo declarator identifier and bar parameters and qualifiers\n".
            "  foo declarator identifier description\n".
            "  bar parameters and qualifiers description\n".
            "\n".
            "No-pointer declarator with foo declarator identifier and ".
            "bar parameters and qualifiers: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', NoptrDeclarator::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that failureDescription() is called when the instance is created 
     * by createDeclaratorId() and the value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenCreateDIdAndAndValueIsInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches(
            '` is a no-pointer declarator with foo declarator identifier`'
        );
        
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildToString('foo declarator identifier')
            ->buildConstraintDescription('foo declarator identifier description')
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorId($didConst);
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Tests that failureDescription() is called when the instance is created 
     * by createDeclaratorIdParametersAndQualifiers() and the value is 
     * invalid.
     */
    public function testFailureDescriptionIsCalledWhenCreateDIdPQualAndAndValueIsInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches(
            '` is a no-pointer declarator with foo declarator identifier and bar parameters and qualifiers`'
        );
        
        $didConst = ConceptConstraintDoubleBuilder::createDeclaratorIdConstraint($this)
            ->buildToString('foo declarator identifier')
            ->buildConstraintDescription('foo declarator identifier description')
            ->getDouble();
        $prmQualConst = ConceptConstraintDoubleBuilder::createParametersAndQualifiersConstraint($this)
            ->buildToString('bar parameters and qualifiers')
            ->buildConstraintDescription('bar parameters and qualifiers description')
            ->getDouble();
        
        $sut = NoptrDeclaratorConstraint::createDeclaratorIdParametersAndQualifiers(
            $didConst, 
            $prmQualConst
        );
        $sut->evaluate(NULL, '', FALSE);
    }
}

