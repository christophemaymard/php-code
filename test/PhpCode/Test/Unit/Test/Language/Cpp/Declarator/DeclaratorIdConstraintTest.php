<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\DeclaratorId;
use PhpCode\Test\Language\Cpp\ConceptConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\DeclaratorIdConstraint;
use PhpCode\Test\Language\Cpp\Expression\IdExpressionDoubleFactory;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Declarator\DeclaratorIdConstraint} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclaratorIdConstraintTest extends TestCase
{
    /**
     * @var IdExpressionDoubleFactory
     */
    private $idExprFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->idExprFactory = new IdExpressionDoubleFactory($this);
    }
    
    /**
     * Tests that toString() returns a string when instantiated.
     */
    public function testToStringReturnsStringWhenInstantiated(): void
    {
        $idExprConst = ConceptConstraintDoubleBuilder::createIdExpressionConstraint($this)->getDouble();
        
        $sut = new DeclaratorIdConstraint($idExprConst);
        self::assertSame('declarator identifier', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string when instantiated.
     */
    public function testGetConceptNameReturnsStringWhenInstantiated(): void
    {
        $idExprConst = ConceptConstraintDoubleBuilder::createIdExpressionConstraint($this)->getDouble();
        
        $sut = new DeclaratorIdConstraint($idExprConst);
        self::assertSame('Declarator identifier', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when instantiated.
     */
    public function testFailureDefaultReasonReturnsStringWhenInstantiated(): void
    {
        $idExprConst = ConceptConstraintDoubleBuilder::createIdExpressionConstraint($this)->getDouble();
        
        $sut = new DeclaratorIdConstraint($idExprConst);
        self::assertSame(
            'Declarator identifier: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when instantiated.
     */
    public function testConstraintDescriptionReturnsStringWhenInstantiated(): void
    {
        $idExprConst = ConceptConstraintDoubleBuilder::createIdExpressionConstraint($this)
            ->buildConstraintDescription(
                "foo IdExpression\n".
                "  bar UnqualifiedId"
            )
            ->getDouble();
        
        $sut = new DeclaratorIdConstraint($idExprConst);
        self::assertSame(
            "Declarator identifier\n".
            "  foo IdExpression\n".
            "    bar UnqualifiedId", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when instantiated and not instance 
     * of DeclaratorId.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndNotInstanceDeclaratorId(): void
    {
        $idExprConst = ConceptConstraintDoubleBuilder::createIdExpressionConstraint($this)->getDouble();
        
        $sut = new DeclaratorIdConstraint($idExprConst);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when instantiated and the 
     * identifier expression is invalid.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndIdExpressionIsInvalid(): void
    {
        $idExpr = $this->idExprFactory->createDummy();
        $did = ConceptDoubleBuilder::createDeclaratorId($this)
            ->buildGetIdExpression($idExpr)
            ->getDouble();
        
        $idExprConst = ConceptConstraintDoubleBuilder::createIdExpressionConstraint($this)
            ->buildMatches($idExpr, FALSE)
            ->getDouble();
        
        $sut = new DeclaratorIdConstraint($idExprConst);
        self::assertFalse($sut->matches($did));
    }
    
    /**
     * Tests that matches() returns TRUE when instantiated and the 
     * declarator identifier is valid.
     */
    public function testMatchesReturnsTrueWhenInstantiatedAndDeclaratorIdIsValid(): void
    {
        $idExpr = $this->idExprFactory->createDummy();
        $did = ConceptDoubleBuilder::createDeclaratorId($this)
            ->buildGetIdExpression($idExpr)
            ->getDouble();
        
        $idExprConst = ConceptConstraintDoubleBuilder::createIdExpressionConstraint($this)
            ->buildMatches($idExpr, TRUE)
            ->getDouble();
        
        $sut = new DeclaratorIdConstraint($idExprConst);
        self::assertTrue($sut->matches($did));
    }
    
    /**
     * Tests that failureReason() returns a string when instantiated and not 
     * instance of DeclaratorId.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndNotInstanceDeclaratorId(): void
    {
        $idExprConst = ConceptConstraintDoubleBuilder::createIdExpressionConstraint($this)->getDouble();
        
        $sut = new DeclaratorIdConstraint($idExprConst);
        self::assertRegExp(
            \sprintf(
                '`^Declarator identifier: .+ is not an instance of %s\\.$`', 
                \str_replace('\\', '\\\\', DeclaratorId::class)
            ), 
            $sut->failureReason(NULL)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when instantiated and the 
     * identifier expression is invalid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndIdExpressionIsInvalid(): void
    {
        $idExpr = $this->idExprFactory->createDummy();
        $did = ConceptDoubleBuilder::createDeclaratorId($this)
            ->buildGetIdExpression($idExpr)
            ->getDouble();
        
        $idExprConst = ConceptConstraintDoubleBuilder::createIdExpressionConstraint($this)
            ->buildMatches($idExpr, FALSE)
            ->buildFailureReason(
                $idExpr, 
                "foo IdExpression\n".
                "  bar UnqualifiedId"
            )
            ->getDouble();
        
        $sut = new DeclaratorIdConstraint($idExprConst);
        self::assertSame(
            "Declarator identifier\n".
            "  foo IdExpression\n".
            "    bar UnqualifiedId", 
            $sut->failureReason($did)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when instantiated and 
     * the declarator identifier is valid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndDeclaratorIdIsValid(): void
    {
        $idExpr = $this->idExprFactory->createDummy();
        $did = ConceptDoubleBuilder::createDeclaratorId($this)
            ->buildGetIdExpression($idExpr)
            ->getDouble();
        
        $idExprConst = ConceptConstraintDoubleBuilder::createIdExpressionConstraint($this)
            ->buildMatches($idExpr, TRUE)
            ->getDouble();
        
        $sut = new DeclaratorIdConstraint($idExprConst);
        self::assertSame(
            'Declarator identifier: Unknown reason.', 
            $sut->failureReason($did)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * instantiated.
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenInstantiated(): void
    {
        $idExprConst = ConceptConstraintDoubleBuilder::createIdExpressionConstraint($this)
            ->buildConstraintDescription(
                "foo IdExpression\n".
                "  bar UnqualifiedId"
            )
            ->getDouble();
        
        $sut = new DeclaratorIdConstraint($idExprConst);
        $pattern = \sprintf(
            "`^\n".
            "Declarator identifier\n". 
            "  foo IdExpression\n". 
            "    bar UnqualifiedId\n". 
            "\n".
            "Declarator identifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', DeclaratorId::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that failureDescription() is called when instantiated and the 
     * value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenInstantiatedAndValueIsInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a declarator identifier`');
        
        $idExprConst = ConceptConstraintDoubleBuilder::createIdExpressionConstraint($this)
            ->buildConstraintDescription('foo description')
            ->getDouble();
        
        $sut = new DeclaratorIdConstraint($idExprConst);
        $sut->evaluate(NULL, '', FALSE);
    }
}

