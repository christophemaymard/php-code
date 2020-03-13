<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParameterDeclaration;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierSequenceConstraintDoubleFactory;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierSequenceDoubleFactory;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationConstraint;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationDoubleFactory;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationConstraint} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationConstraintTest extends TestCase
{
    /**
     * @var ParameterDeclarationDoubleFactory
     */
    private $prmDeclFactory;
    
    /**
     * @var DeclarationSpecifierSequenceDoubleFactory
     */
    private $declSpecSeqFactory;
    
    /**
     * @var DeclarationSpecifierSequenceConstraintDoubleFactory
     */
    private $declSpecSeqConstFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->prmDeclFactory = new ParameterDeclarationDoubleFactory($this);
        $this->declSpecSeqFactory = new DeclarationSpecifierSequenceDoubleFactory($this);
        $this->declSpecSeqConstFactory = new DeclarationSpecifierSequenceConstraintDoubleFactory($this);
    }
    
    /**
     * Tests that __construct() throws an exception.
     */
    public function test__constructThrowsException(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        
        $sut = new ParameterDeclarationConstraint();
    }
    
    /**
     * Tests that toString() returns a string when the instance is created 
     * by create().
     */
    public function testToStringReturnsStringWhenCreate(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createDummy();
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertSame('parameter declaration', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string when the instance is 
     * created by create().
     */
    public function testGetConceptNameReturnsStringWhenCreate(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createDummy();
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertSame('Parameter declaration', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when the instance 
     * is created by create().
     */
    public function testFailureDefaultReasonReturnsStringWhenCreate(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createDummy();
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertSame('Parameter declaration: Unknown reason.', $sut->failureDefaultReason(NULL));
    }
    
    /**
     * Tests that constraintDescription() returns a string when the instance 
     * is created by create().
     */
    public function testConstraintDescriptionReturnsStringWhenCreate(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createConstraintDescription(
            "foo DeclarationSpecifierSequence\n  bar DeclarationSpecifier"
        );
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertSame(
            "Parameter declaration\n".
            "  foo DeclarationSpecifierSequence\n".
            "    bar DeclarationSpecifier", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * create() and not instance of ParameterDeclaration.
     */
    public function testMatchesReturnsFalseWhenCreateAndNotInstanceParameterDeclaration(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createDummy();
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the instance is created by 
     * create() and the declaration specifier sequence is invalid.
     */
    public function testMatchesReturnsFalseWhenCreateAndDeclarationSpecifierSequenceIsInvalid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $prmDecl = $this->prmDeclFactory->createGetDeclarationSpecifierSequence($declSpecSeq);
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatches($declSpecSeq, FALSE);
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertFalse($sut->matches($prmDecl));
    }
    
    /**
     * Tests that matches() returns TRUE when the instance is created by 
     * create() and the parameter declaration is valid.
     */
    public function testMatchesReturnsTrueWhenCreateAndParameterDeclarationIsValid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $prmDecl = $this->prmDeclFactory->createGetDeclarationSpecifierSequence($declSpecSeq);
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatches($declSpecSeq, TRUE);
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertTrue($sut->matches($prmDecl));
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by create() and not instance of ParameterDeclaration.
     */
    public function testFailureReasonReturnsStringWhenCreateAndNotInstanceParameterDeclaration(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createDummy();
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertRegExp(
            \sprintf(
                '`^Parameter declaration: .+ is not an instance of %s\\.$`', 
                \str_replace('\\', '\\\\', ParameterDeclaration::class)
            ), 
            $sut->failureReason(NULL)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by create() and the declaration specifier sequence is invalid.
     */
    public function testFailureReasonReturnsStringWhenCreateAndDeclarationSpecifierSequenceIsInvalid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $prmDecl = $this->prmDeclFactory->createGetDeclarationSpecifierSequence($declSpecSeq);
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatchesFailureReason(
            $declSpecSeq, 
            FALSE,
            "foo DeclarationSpecifierSequence\n".
            "  bar DeclarationSpecifier"
        );
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertSame(
            "Parameter declaration\n".
            "  foo DeclarationSpecifierSequence\n".
            "    bar DeclarationSpecifier", 
            $sut->failureReason($prmDecl)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the instance is 
     * created by create() and the parameter declaration is valid.
     */
    public function testFailureReasonReturnsStringWhenCreateAndParameterDeclarationIsValid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $prmDecl = $this->prmDeclFactory->createGetDeclarationSpecifierSequence($declSpecSeq);
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatches($declSpecSeq, TRUE);
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertSame(
            'Parameter declaration: Unknown reason.', 
            $sut->failureReason($prmDecl)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by create() and not instance of 
     * ParameterDeclaration.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateAndNotInstanceParameterDeclaration(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createConstraintDescription(
            "foo DeclarationSpecifierSequence\n".
            "  bar DeclarationSpecifier"
        );
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        $pattern = \sprintf(
            "`^\n".
            "Parameter declaration\n". 
            "  foo DeclarationSpecifierSequence\n". 
            "    bar DeclarationSpecifier\n". 
            "\n".
            "Parameter declaration: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', ParameterDeclaration::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by create() and the declaration specifier sequence 
     * is invalid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateAndDeclarationSpecifierSequenceIsInvalid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $prmDecl = $this->prmDeclFactory->createGetDeclarationSpecifierSequence($declSpecSeq);
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatchesFailureReasonConstraintDescription(
            $declSpecSeq, 
            FALSE,
            "foo\n".
            "  bar reason", 
            "foo description\n".
            "  bar description"
        );
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertSame(
            "\n".
            "Parameter declaration\n".
            "  foo description\n".
            "    bar description\n".
            "\n".
            "Parameter declaration\n".
            "  foo\n". 
            "    bar reason", 
            $sut->additionalFailureDescription($prmDecl)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * instance is created by create() and the parameter declaration is valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenCreateAndParameterDeclarationIsValid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $prmDecl = $this->prmDeclFactory->createGetDeclarationSpecifierSequence($declSpecSeq);
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatchesConstraintDescription(
            $declSpecSeq, 
            TRUE, 
            "foo description\n".
            "  bar description"
        );
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        self::assertSame(
            "\n".
            "Parameter declaration\n".
            "  foo description\n".
            "    bar description\n".
            "\n".
            "Parameter declaration: Unknown reason.", 
            $sut->additionalFailureDescription($prmDecl)
        );
    }
    
    /**
     * Tests that failureDescription() is called when the instance is created 
     * by create() and a value is invalid.
     */
    public function testFailureDescriptionWhenCreateAndInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a parameter declaration`');
        
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createConstraintDescription(
                'foo description'
        );
        
        $sut = ParameterDeclarationConstraint::create($declSpecSeqConst);
        $sut->evaluate(NULL, '', FALSE);
    }
}

