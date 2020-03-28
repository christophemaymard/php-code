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
     * Tests that toString() returns a string when the instance is created 
     * by create().
     */
    public function testToStringReturnsStringWhenInstantiated(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createDummy();
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        self::assertSame('parameter declaration', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string when instantiated.
     */
    public function testGetConceptNameReturnsStringWhenInstantiated(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createDummy();
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        self::assertSame('Parameter declaration', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when instantiated.
     */
    public function testFailureDefaultReasonReturnsStringWhenInstantiated(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createDummy();
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        self::assertSame('Parameter declaration: Unknown reason.', $sut->failureDefaultReason(NULL));
    }
    
    /**
     * Tests that constraintDescription() returns a string when instantiated.
     */
    public function testConstraintDescriptionReturnsStringWhenInstantiated(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createConstraintDescription(
            "foo DeclarationSpecifierSequence\n  bar DeclarationSpecifier"
        );
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        self::assertSame(
            "Parameter declaration\n".
            "  foo DeclarationSpecifierSequence\n".
            "    bar DeclarationSpecifier", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when the instantiated and not 
     * instance of ParameterDeclaration.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndNotInstanceParameterDeclaration(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createDummy();
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when instantiated and the 
     * declaration specifier sequence is invalid.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndDeclarationSpecifierSequenceIsInvalid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $prmDecl = $this->prmDeclFactory->createGetDeclarationSpecifierSequence($declSpecSeq);
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatches($declSpecSeq, FALSE);
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        self::assertFalse($sut->matches($prmDecl));
    }
    
    /**
     * Tests that matches() returns TRUE when instantiated and the parameter 
     * declaration is valid.
     */
    public function testMatchesReturnsTrueWhenInstantiatedAndParameterDeclarationIsValid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $prmDecl = $this->prmDeclFactory->createGetDeclarationSpecifierSequence($declSpecSeq);
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatches($declSpecSeq, TRUE);
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        self::assertTrue($sut->matches($prmDecl));
    }
    
    /**
     * Tests that failureReason() returns a string when instantiated and not 
     * instance of ParameterDeclaration.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndNotInstanceParameterDeclaration(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createDummy();
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        self::assertRegExp(
            \sprintf(
                '`^Parameter declaration: .+ is not an instance of %s\\.$`', 
                \str_replace('\\', '\\\\', ParameterDeclaration::class)
            ), 
            $sut->failureReason(NULL)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when instantiated and the 
     * declaration specifier sequence is invalid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndDeclarationSpecifierSequenceIsInvalid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $prmDecl = $this->prmDeclFactory->createGetDeclarationSpecifierSequence($declSpecSeq);
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatchesFailureReason(
            $declSpecSeq, 
            FALSE,
            "foo DeclarationSpecifierSequence\n".
            "  bar DeclarationSpecifier"
        );
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        self::assertSame(
            "Parameter declaration\n".
            "  foo DeclarationSpecifierSequence\n".
            "    bar DeclarationSpecifier", 
            $sut->failureReason($prmDecl)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when instantiated and the 
     * parameter declaration is valid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndParameterDeclarationIsValid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $prmDecl = $this->prmDeclFactory->createGetDeclarationSpecifierSequence($declSpecSeq);
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatches($declSpecSeq, TRUE);
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        self::assertSame(
            'Parameter declaration: Unknown reason.', 
            $sut->failureReason($prmDecl)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when 
     * instantiated and not instance of ParameterDeclaration.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenInstantiatedAndNotInstanceParameterDeclaration(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createConstraintDescription(
            "foo DeclarationSpecifierSequence\n".
            "  bar DeclarationSpecifier"
        );
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
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
     * Tests that additionalFailureDescription() returns a string when 
     * instantiated and the declaration specifier sequence is invalid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenInstantiatedAndDeclarationSpecifierSequenceIsInvalid(): void
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
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
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
     * Tests that additionalFailureDescription() returns a string when 
     * instantiated and the parameter declaration is valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenInstantiatedAndParameterDeclarationIsValid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $prmDecl = $this->prmDeclFactory->createGetDeclarationSpecifierSequence($declSpecSeq);
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatchesConstraintDescription(
            $declSpecSeq, 
            TRUE, 
            "foo description\n".
            "  bar description"
        );
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
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
     * Tests that failureDescription() is called when instantiated and the 
     * value is invalid.
     */
    public function testFailureDescriptionWhenInstantiatedAndInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a parameter declaration`');
        
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createConstraintDescription(
                'foo description'
        );
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        $sut->evaluate(NULL, '', FALSE);
    }
}

