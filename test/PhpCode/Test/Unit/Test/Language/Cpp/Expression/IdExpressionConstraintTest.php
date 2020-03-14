<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\IdExpression;
use PhpCode\Test\Language\Cpp\Expression\IdExpressionConstraint;
use PhpCode\Test\Language\Cpp\Expression\IdExpressionDoubleFactory;
use PhpCode\Test\Language\Cpp\Expression\UnqualifiedIdConstraintDoubleFactory;
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
     * @var IdExpressionDoubleFactory
     */
    private $idExprFactory;
    
    /**
     * @var UnqualifiedIdDoubleFactory
     */
    private $uidFactory;
    
    /**
     * @var UnqualifiedIdConstraintDoubleFactory
     */
    private $uidConstFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->idExprFactory = new IdExpressionDoubleFactory($this);
        $this->uidFactory = new UnqualifiedIdDoubleFactory($this);
        $this->uidConstFactory = new UnqualifiedIdConstraintDoubleFactory($this);
    }
    
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
     * Tests that toString() returns a string when the instance is created 
     * by createUnqualifiedId().
     */
    public function testToStringReturnsStringWhenCreateUnqualifiedId(): void
    {
        $uidConst = $this->uidConstFactory->createDummy();
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
        self::assertSame('identifier expression', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string when the instance is 
     * created by createUnqualifiedId().
     */
    public function testGetConceptNameReturnsStringWhenCreateUnqualifiedId(): void
    {
        $uidConst = $this->uidConstFactory->createDummy();
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
        self::assertSame('Identifier expression', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when the instance 
     * is created by createUnqualifiedId().
     */
    public function testFailureDefaultReasonReturnsStringWhenCreateUnqualifiedId(): void
    {
        $uidConst = $this->uidConstFactory->createDummy();
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
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
        $uidConst = $this->uidConstFactory->createConstraintDescription(
            "foo UnqualifiedId\n".
            "  bar Identifier"
        );
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
        self::assertSame(
            "Identifier expression\n".
            "  foo UnqualifiedId\n".
            "    bar Identifier", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createUnqualifiedId() and not instance of IdExpression.
     */
    public function testMatchesReturnsFalseWhenCreateUnqualifiedIdAndNotInstanceIdExpression(): void
    {
        $uidConst = $this->uidConstFactory->createDummy();
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createUnqualifiedId() and the unqualified identifier is invalid.
     */
    public function testMatchesReturnsFalseWhenCreateUnqualifiedIdAndUnqualifiedIdIsInvalid(): void
    {
        $uid = $this->uidFactory->createDummy();
        $idExpr = $this->idExprFactory->createGetUnqualifiedId($uid);
        
        $uidConst = $this->uidConstFactory->createMatches($uid, FALSE);
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
        self::assertFalse($sut->matches($idExpr));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createUnqualifiedId() and the identifier expression is valid.
     */
    public function testMatchesReturnsTrueWhenCreateUnqualifiedIdAndIdExpressionIsValid(): void
    {
        $uid = $this->uidFactory->createDummy();
        $idExpr = $this->idExprFactory->createGetUnqualifiedId($uid);
        
        $uidConst = $this->uidConstFactory->createMatches($uid, TRUE);
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
        self::assertTrue($sut->matches($idExpr));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createUnqualifiedId() and not instance of IdExpression.
     */
    public function testFailureReasonReturnsStringWhenCreateUnqualifiedIdAndNotInstanceIdExpression(): void
    {
        $uidConst = $this->uidConstFactory->createDummy();
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
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
        $uid = $this->uidFactory->createDummy();
        $idExpr = $this->idExprFactory->createGetUnqualifiedId($uid);
        
        $uidConst = $this->uidConstFactory->createMatchesFailureReason(
            $uid, 
            FALSE,
            "foo UnqualifiedId\n".
            "  bar Identifier"
        );
        
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
     * created by createUnqualifiedId() and the identifier expression is 
     * valid.
     */
    public function testFailureReasonReturnsStringWhenCreateUnqualifiedIdAndIdExpressionIsValid(): void
    {
        $uid = $this->uidFactory->createDummy();
        $idExpr = $this->idExprFactory->createGetUnqualifiedId($uid);
        
        $uidConst = $this->uidConstFactory->createMatches($uid, TRUE);
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
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
        $uidConst = $this->uidConstFactory->createConstraintDescription(
            "foo UnqualifiedId\n".
            "  bar Identifier"
        );
        
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
     * instance is created by createUnqualifiedId() and the unqualified 
     * identifier is invalid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateUnqualifiedIdAndUnqualifiedIdIsInvalid(): void
    {
        $uid = $this->uidFactory->createDummy();
        $idExpr = $this->idExprFactory->createGetUnqualifiedId($uid);
        
        $uidConst = $this->uidConstFactory->createMatchesFailureReasonConstraintDescription(
            $uid, 
            FALSE,
            "foo\n".
            "  bar reason", 
            "foo description\n".
            "  bar description"
        );
        
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
     * instance is created by createUnqualifiedId() and the identifier 
     * expression is valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateUnqualifiedIdAndIdExpressionIsValid(): void
    {
        $uid = $this->uidFactory->createDummy();
        $idExpr = $this->idExprFactory->createGetUnqualifiedId($uid);
        
        $uidConst = $this->uidConstFactory->createMatchesConstraintDescription(
            $uid, 
            TRUE, 
            "foo description\n".
            "  bar description"
        );
        
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
     * Tests that failureDescription() is called when the instance is created 
     * by createUnqualifiedId() and the value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenCreateUnqualifiedIdAndValueIsInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is an identifier expression`');
        
        $uidConst = $this->uidConstFactory->createConstraintDescription(
            'foo description'
        );
        
        $sut = IdExpressionConstraint::createUnqualifiedId($uidConst);
        $sut->evaluate(NULL, '', FALSE);
    }
}

