<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\UnqualifiedId;
use PhpCode\Test\Language\Cpp\Expression\UnqualifiedIdConstraint;
use PhpCode\Test\Language\Cpp\Expression\UnqualifiedIdDoubleFactory;
use PhpCode\Test\Language\Cpp\Lexical\IdentifierConstraintDoubleFactory;
use PhpCode\Test\Language\Cpp\Lexical\IdentifierDoubleFactory;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Expression\UnqualifiedIdConstraint} 
 * class.
 * 
 * @group   expression
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class UnqualifiedIdConstraintTest extends TestCase
{
    /**
     * @var UnqualifiedIdDoubleFactory
     */
    private $uidFactory;
    
    /**
     * @var IdentifierDoubleFactory
     */
    private $idFactory;
    
    /**
     * @var IdentifierConstraintDoubleFactory
     */
    private $idConstFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->uidFactory = new UnqualifiedIdDoubleFactory($this);
        $this->idFactory = new IdentifierDoubleFactory($this);
        $this->idConstFactory = new IdentifierConstraintDoubleFactory($this);
    }
    
    /**
     * Tests that __construct() throws an exception.
     */
    public function test__constructThrowsException(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        
        $sut = new UnqualifiedIdConstraint();
    }
    
    /**
     * Tests that toString() returns a string when the instance is created 
     * by createIdentifier().
     */
    public function testToStringReturnsStringWhenCreateIdentifier(): void
    {
        $idConst = $this->idConstFactory->createDummy();
        
        $sut = UnqualifiedIdConstraint::createIdentifier($idConst);
        self::assertSame('unqualified identifier', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string when the instance is 
     * created by createIdentifier().
     */
    public function testGetConceptNameReturnsStringWhenCreateIdentifier(): void
    {
        $idConst = $this->idConstFactory->createDummy();
        
        $sut = UnqualifiedIdConstraint::createIdentifier($idConst);
        self::assertSame('Unqualified identifier', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when the instance 
     * is created by createIdentifier().
     */
    public function testFailureDefaultReasonReturnsStringWhenCreateIdentifier(): void
    {
        $idConst = $this->idConstFactory->createDummy();
        
        $sut = UnqualifiedIdConstraint::createIdentifier($idConst);
        self::assertSame(
            'Unqualified identifier: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by createIdentifier().
     */
    public function testConstraintDescriptionReturnsStringWhenCreateIdentifier(): void
    {
        $idConst = $this->idConstFactory->createConstraintDescription(
            "foo Identifier\n".
            "  bar string"
        );
        
        $sut = UnqualifiedIdConstraint::createIdentifier($idConst);
        self::assertSame(
            "Unqualified identifier\n".
            "  foo Identifier\n".
            "    bar string", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createIdentifier() and not instance of UnqualifiedId.
     */
    public function testMatchesReturnsFalseWhenCreateIdentifierAndNotInstanceUnqualifiedId(): void
    {
        $idConst = $this->idConstFactory->createDummy();
        
        $sut = UnqualifiedIdConstraint::createIdentifier($idConst);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * createIdentifier() and the identifier is invalid.
     */
    public function testMatchesReturnsFalseWhenCreateIdentifierAndIdentifierIsInvalid(): void
    {
        $id = $this->idFactory->createDummy();
        $uid = $this->uidFactory->createGetIdentifier($id);
        $idConst = $this->idConstFactory->createMatches($id, FALSE);
        
        $sut = UnqualifiedIdConstraint::createIdentifier($idConst);
        self::assertFalse($sut->matches($uid));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * createIdentifier() and the unqualified identifier is valid.
     */
    public function testMatchesReturnsTrueWhenCreateIdentifierAndUnqualifiedIdIsValid(): void
    {
        $id = $this->idFactory->createDummy();
        $uid = $this->uidFactory->createGetIdentifier($id);
        $idConst = $this->idConstFactory->createMatches($id, TRUE);
        
        $sut = UnqualifiedIdConstraint::createIdentifier($idConst);
        self::assertTrue($sut->matches($uid));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createIdentifier() and not instance of UnqualifiedId.
     */
    public function testFailureReasonReturnsStringWhenCreateIdentifierAndNotInstanceUnqualifiedId(): void
    {
        $idConst = $this->idConstFactory->createDummy();
        
        $sut = UnqualifiedIdConstraint::createIdentifier($idConst);
        self::assertRegExp(
            \sprintf(
                '`^Unqualified identifier: .+ is not an instance of %s\\.$`', 
                \str_replace('\\', '\\\\', UnqualifiedId::class)
            ), 
            $sut->failureReason(NULL)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createIdentifier() and the identifier is invalid.
     */
    public function testFailureReasonReturnsStringWhenCreateIdentifierAndIdentifierIsInvalid(): void
    {
        $id = $this->idFactory->createDummy();
        $uid = $this->uidFactory->createGetIdentifier($id);
        $idConst = $this->idConstFactory->createMatchesFailureReason(
            $id, 
            FALSE,
            "foo Identifier\n".
            "  bar string"
        );
        
        $sut = UnqualifiedIdConstraint::createIdentifier($idConst);
        self::assertSame(
            "Unqualified identifier\n".
            "  foo Identifier\n".
            "    bar string", 
            $sut->failureReason($uid)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by createIdentifier() and the unqualified identifier is valid.
     */
    public function testFailureReasonReturnsStringWhenCreateIdentifierAndUnqualifiedIdIsValid(): void
    {
        $id = $this->idFactory->createDummy();
        $uid = $this->uidFactory->createGetIdentifier($id);
        $idConst = $this->idConstFactory->createMatches($id, TRUE);
        
        $sut = UnqualifiedIdConstraint::createIdentifier($idConst);
        self::assertSame(
            'Unqualified identifier: Unknown reason.', 
            $sut->failureReason($uid)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createIdentifier() and not instance of 
     * UnqualifiedId.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateIdentifierAndNotInstanceUnqualifiedId(): void
    {
        $idConst = $this->idConstFactory->createConstraintDescription(
            "foo Identifier\n".
            "  bar string"
        );
        
        $sut = UnqualifiedIdConstraint::createIdentifier($idConst);
        $pattern = \sprintf(
            "`^\n".
            "Unqualified identifier\n". 
            "  foo Identifier\n". 
            "    bar string\n". 
            "\n".
            "Unqualified identifier: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', UnqualifiedId::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createIdentifier() and the identifier is 
     * invalid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateIdentifierAndIdentifierIsInvalid(): void
    {
        $id = $this->idFactory->createDummy();
        $uid = $this->uidFactory->createGetIdentifier($id);
        $idConst = $this->idConstFactory->createMatchesFailureReasonConstraintDescription(
            $id, 
            FALSE,
            "foo\n".
            "  bar reason", 
            "foo description\n".
            "  bar description"
        );
        
        $sut = UnqualifiedIdConstraint::createIdentifier($idConst);
        self::assertSame(
            "\n".
            "Unqualified identifier\n".
            "  foo description\n".
            "    bar description\n".
            "\n".
            "Unqualified identifier\n".
            "  foo\n". 
            "    bar reason", 
            $sut->additionalFailureDescription($uid)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by createIdentifier() and the unqualified 
     * identifier is valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateIdentifierAndUnqualifiedIdIsValid(): void
    {
        $id = $this->idFactory->createDummy();
        $uid = $this->uidFactory->createGetIdentifier($id);
        $idConst = $this->idConstFactory->createMatchesConstraintDescription(
            $id, 
            TRUE, 
            "foo description\n".
            "  bar description"
        );
        
        $sut = UnqualifiedIdConstraint::createIdentifier($idConst);
        self::assertSame(
            "\n".
            "Unqualified identifier\n".
            "  foo description\n".
            "    bar description\n".
            "\n".
            "Unqualified identifier: Unknown reason.", 
            $sut->additionalFailureDescription($uid)
        );
    }
    
    /**
     * Tests that failureDescription() is called when the instance is created 
     * by createIdentifier() and a value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenCreateIdentifierAndValueIsInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is an unqualified identifier`');
        
        $idConst = $this->idConstFactory->createConstraintDescription(
            'foo description'
        );
        
        $sut = UnqualifiedIdConstraint::createIdentifier($idConst);
        $sut->evaluate(NULL, '', FALSE);
    }
}

