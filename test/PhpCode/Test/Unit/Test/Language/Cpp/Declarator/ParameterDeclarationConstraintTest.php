<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParameterDeclaration;
use PhpCode\Test\Language\Cpp\ConceptConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierSequenceConstraintDoubleFactory;
use PhpCode\Test\Language\Cpp\Declaration\DeclarationSpecifierSequenceDoubleFactory;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationConstraint;
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
     * Tests that toString() returns a string when instantiated and an 
     * abstract declarator constraint has been set.
     */
    public function testToStringReturnsStringWhenInstantiatedAndAbstractDeclaratorConstraintSet(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createDummy();
        $abstDcltorConst = ConceptConstraintDoubleBuilder::createAbstractDeclaratorConstraint($this)
            ->getDouble();
                
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        $sut->setAbstractDeclaratorConstraint($abstDcltorConst);
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
     * Tests that getConceptName() returns a string when instantiated and an 
     * abstract declarator constraint has been set.
     */
    public function testGetConceptNameReturnsStringWhenInstantiatedAndAbstractDeclaratorConstraintSet(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createDummy();
        $abstDcltorConst = ConceptConstraintDoubleBuilder::createAbstractDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        $sut->setAbstractDeclaratorConstraint($abstDcltorConst);
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
     * Tests that failureDefaultReason() returns a string when instantiated 
     * and an abstract declarator constraint has been set.
     */
    public function testFailureDefaultReasonReturnsStringWhenInstantiatedAndAbstractDeclaratorConstraintSet(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createDummy();
        $abstDcltorConst = ConceptConstraintDoubleBuilder::createAbstractDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        $sut->setAbstractDeclaratorConstraint($abstDcltorConst);
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
     * Tests that constraintDescription() returns a string when instantiated 
     * and an abstract declarator constraint has been set.
     */
    public function testConstraintDescriptionReturnsStringWhenInstantiatedAndAbstractDeclaratorConstraintSet(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createConstraintDescription(
            "foo DeclarationSpecifierSequence\n".
            "  bar DeclarationSpecifier"
        );
        $abstDcltorConst = ConceptConstraintDoubleBuilder::createAbstractDeclaratorConstraint($this)
            ->buildConstraintDescription('abstract declarator description')
            ->getDouble();
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        $sut->setAbstractDeclaratorConstraint($abstDcltorConst);
        self::assertSame(
            "Parameter declaration\n".
            "  foo DeclarationSpecifierSequence\n".
            "    bar DeclarationSpecifier\n".
            "  abstract declarator description", 
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
     * Tests that matches() returns FALSE when:
     * - instantiated, 
     * - an abstract declarator constraint has been set, and 
     * - not instance of ParameterDeclaration.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndAbstractDeclaratorConstraintSetAndNotInstanceParameterDeclaration(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createDummy();
        $abstDcltorConst = ConceptConstraintDoubleBuilder::createAbstractDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        $sut->setAbstractDeclaratorConstraint($abstDcltorConst);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when instantiated and the 
     * declaration specifier sequence is invalid.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndDeclarationSpecifierSequenceIsInvalid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $prmDecl = ConceptDoubleBuilder::createParameterDeclaration($this)
            ->buildGetDeclarationSpecifierSequence($declSpecSeq)
            ->getDouble();
        
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatches($declSpecSeq, FALSE);
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        self::assertFalse($sut->matches($prmDecl));
    }
    
    /**
     * Tests that matches() returns FALSE when:
     * - instantiated, 
     * - an abstract declarator constraint has been set, and 
     * - the declaration specifier sequence is invalid.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndAbstractDeclaratorConstraintSetAndDeclarationSpecifierSequenceIsInvalid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $prmDecl = ConceptDoubleBuilder::createParameterDeclaration($this)
            ->buildGetDeclarationSpecifierSequence($declSpecSeq)
            ->getDouble();
        
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatches($declSpecSeq, FALSE);
        $abstDcltorConst = ConceptConstraintDoubleBuilder::createAbstractDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        $sut->setAbstractDeclaratorConstraint($abstDcltorConst);
        self::assertFalse($sut->matches($prmDecl));
    }
    
    /**
     * Tests that matches() returns FALSE when:
     * - instantiated, 
     * - the declaration specifier sequence is valid, and 
     * - the parameter declaration has an abstract declarator.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndAbstractDeclaratorPresent(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $abstDcltor = ConceptDoubleBuilder::createAbstractDeclarator($this)
            ->getDouble();
        $prmDecl = ConceptDoubleBuilder::createParameterDeclaration($this)
            ->buildGetDeclarationSpecifierSequence($declSpecSeq)
            ->buildGetAbstractDeclarator($abstDcltor)
            ->getDouble();
        
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatches($declSpecSeq, TRUE);
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        self::assertFalse($sut->matches($prmDecl));
    }
    
    /**
     * Tests that matches() returns FALSE when:
     * - instantiated, 
     * - an abstract declarator constraint has been set, and 
     * - the declaration specifier sequence is valid, and 
     * - the abstract declarator is invalid.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndAbstractDeclaratorConstraintSetAndAbstractDeclaratorIsInvalid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $abstDcltor = ConceptDoubleBuilder::createAbstractDeclarator($this)
            ->getDouble();
        $prmDecl = ConceptDoubleBuilder::createParameterDeclaration($this)
            ->buildGetDeclarationSpecifierSequence($declSpecSeq)
            ->buildGetAbstractDeclarator($abstDcltor)
            ->getDouble();
        
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatches($declSpecSeq, TRUE);
        $abstDcltorConst = ConceptConstraintDoubleBuilder::createAbstractDeclaratorConstraint($this)
            ->buildMatches($abstDcltor, FALSE)
            ->getDouble();
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        $sut->setAbstractDeclaratorConstraint($abstDcltorConst);
        self::assertFalse($sut->matches($prmDecl));
    }
    
    /**
     * Tests that matches() returns TRUE when:
     * - instantiated, 
     * - the declaration specifier sequence is valid, and 
     * - the parameter declaration has no abstract declarator.
     */
    public function testMatchesReturnsTrueWhenInstantiatedAndParameterDeclarationIsValid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $prmDecl = ConceptDoubleBuilder::createParameterDeclaration($this)
            ->buildGetDeclarationSpecifierSequence($declSpecSeq)
            ->buildGetAbstractDeclarator()
            ->getDouble();
        
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatches($declSpecSeq, TRUE);
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        self::assertTrue($sut->matches($prmDecl));
    }
    
    /**
     * Tests that matches() returns TRUE when:
     * - instantiated, 
     * - an abstract declarator constraint has been set, and 
     * - the declaration specifier sequence is valid, and 
     * - the abstract declarator is valid.
     */
    public function testMatchesReturnsTrueWhenInstantiatedAndAbstractDeclaratorConstraintSetAndAbstractDeclaratorIsValid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $abstDcltor = ConceptDoubleBuilder::createAbstractDeclarator($this)
            ->getDouble();
        $prmDecl = ConceptDoubleBuilder::createParameterDeclaration($this)
            ->buildGetDeclarationSpecifierSequence($declSpecSeq)
            ->buildGetAbstractDeclarator($abstDcltor)
            ->getDouble();
        
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatches($declSpecSeq, TRUE);
        $abstDcltorConst = ConceptConstraintDoubleBuilder::createAbstractDeclaratorConstraint($this)
            ->buildMatches($abstDcltor, TRUE)
            ->getDouble();
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        $sut->setAbstractDeclaratorConstraint($abstDcltorConst);
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
     * Tests that failureReason() returns a string when:
     * - instantiated, 
     * - an abstract declarator constraint has been set, and 
     * - not instance of ParameterDeclaration.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndAbstractDeclaratorConstraintSetAndNotInstanceParameterDeclaration(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createDummy();
        $abstDcltorConst = ConceptConstraintDoubleBuilder::createAbstractDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        $sut->setAbstractDeclaratorConstraint($abstDcltorConst);
        $pattern = \sprintf(
            '`^Parameter declaration: .+ is not an instance of %s\\.$`', 
            \str_replace('\\', '\\\\', ParameterDeclaration::class)
        );
        self::assertRegExp($pattern, $sut->failureReason(NULL));
    }
    
    /**
     * Tests that failureReason() returns a string when instantiated and the 
     * declaration specifier sequence is invalid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndDeclarationSpecifierSequenceIsInvalid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $prmDecl = ConceptDoubleBuilder::createParameterDeclaration($this)
            ->buildGetDeclarationSpecifierSequence($declSpecSeq)
            ->getDouble();
        
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
     * Tests that failureReason() returns a string when:
     * - instantiated, 
     * - an abstract declarator constraint has been set, and 
     * - the declaration specifier sequence is invalid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndAbstractDeclaratorConstraintSetAndDeclarationSpecifierSequenceIsInvalid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $prmDecl = ConceptDoubleBuilder::createParameterDeclaration($this)
            ->buildGetDeclarationSpecifierSequence($declSpecSeq)
            ->getDouble();
        
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatchesFailureReason(
            $declSpecSeq, 
            FALSE,
            "foo DeclarationSpecifierSequence\n".
            "  bar DeclarationSpecifier"
        );
        $abstDcltorConst = ConceptConstraintDoubleBuilder::createAbstractDeclaratorConstraint($this)
            ->getDouble();
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        $sut->setAbstractDeclaratorConstraint($abstDcltorConst);
        self::assertSame(
            "Parameter declaration\n".
            "  foo DeclarationSpecifierSequence\n".
            "    bar DeclarationSpecifier", 
            $sut->failureReason($prmDecl)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when:
     * - instantiated, 
     * - the declaration specifier sequence is valid, and 
     * - the parameter declaration has an abstract declarator.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndAbstractDeclaratorPresent(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $abstDcltor = ConceptDoubleBuilder::createAbstractDeclarator($this)
            ->getDouble();
        $prmDecl = ConceptDoubleBuilder::createParameterDeclaration($this)
            ->buildGetDeclarationSpecifierSequence($declSpecSeq)
            ->buildGetAbstractDeclarator($abstDcltor)
            ->getDouble();
        
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatches($declSpecSeq, TRUE);
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        self::assertSame(
            'Parameter declaration: abstract declarator present whereas it should be absent.', 
            $sut->failureReason($prmDecl)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when:
     * - instantiated, 
     * - an abstract declarator constraint has been set, and 
     * - the declaration specifier sequence is valid, and 
     * - the abstract declarator is invalid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndAbstractDeclaratorConstraintSetAndAbstractDeclaratorIsInvalid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $abstDcltor = ConceptDoubleBuilder::createAbstractDeclarator($this)
            ->getDouble();
        $prmDecl = ConceptDoubleBuilder::createParameterDeclaration($this)
            ->buildGetDeclarationSpecifierSequence($declSpecSeq)
            ->buildGetAbstractDeclarator($abstDcltor)
            ->getDouble();
        
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatches($declSpecSeq, TRUE);
        $abstDcltorConst = ConceptConstraintDoubleBuilder::createAbstractDeclaratorConstraint($this)
            ->buildMatches($abstDcltor, FALSE)
            ->buildFailureReason($abstDcltor, 'abstract declarator reason')
            ->getDouble();
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        $sut->setAbstractDeclaratorConstraint($abstDcltorConst);
        self::assertSame(
            "Parameter declaration\n".
            "  abstract declarator reason", 
            $sut->failureReason($prmDecl)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when:
     * - instantiated, 
     * - the declaration specifier sequence is valid, and 
     * - the parameter declaration has no abstract declarator.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndParameterDeclarationIsValid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $prmDecl = ConceptDoubleBuilder::createParameterDeclaration($this)
            ->buildGetDeclarationSpecifierSequence($declSpecSeq)
            ->buildGetAbstractDeclarator()
            ->getDouble();
        
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatches($declSpecSeq, TRUE);
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        self::assertSame(
            'Parameter declaration: Unknown reason.', 
            $sut->failureReason($prmDecl)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when:
     * - instantiated, 
     * - an abstract declarator constraint has been set, and 
     * - the declaration specifier sequence is valid, and 
     * - the abstract declarator is valid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndAbstractDeclaratorConstraintSetAndAbstractDeclaratorIsValid(): void
    {
        $declSpecSeq = $this->declSpecSeqFactory->createDummy();
        $abstDcltor = ConceptDoubleBuilder::createAbstractDeclarator($this)
            ->getDouble();
        $prmDecl = ConceptDoubleBuilder::createParameterDeclaration($this)
            ->buildGetDeclarationSpecifierSequence($declSpecSeq)
            ->buildGetAbstractDeclarator($abstDcltor)
            ->getDouble();
        
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createMatches($declSpecSeq, TRUE);
        $abstDcltorConst = ConceptConstraintDoubleBuilder::createAbstractDeclaratorConstraint($this)
            ->buildMatches($abstDcltor, TRUE)
            ->getDouble();
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        $sut->setAbstractDeclaratorConstraint($abstDcltorConst);
        self::assertSame(
            'Parameter declaration: Unknown reason.', 
            $sut->failureReason($prmDecl)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * instantiated.
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenInstantiated(): void
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
     * Tests that additionalFailureDescription() returns a string that is 
     * the constraint description followed by the reason of the failure when 
     * instantiated and an abstract declarator constraint has been set.
     */
    public function testAdditionalFailureDescriptionReturnsConstraintDescriptionAndFailureReasonWhenInstantiatedAndAbstractDeclaratorConstraintSet(): void
    {
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createConstraintDescription(
            "foo DeclarationSpecifierSequence\n".
            "  bar DeclarationSpecifier"
        );
        $abstDcltorConst = ConceptConstraintDoubleBuilder::createAbstractDeclaratorConstraint($this)
            ->buildConstraintDescription('abstract declarator description')
            ->getDouble();
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        $sut->setAbstractDeclaratorConstraint($abstDcltorConst);
        $pattern = \sprintf(
            "`^\n".
            "Parameter declaration\n".
            "  foo DeclarationSpecifierSequence\n".
            "    bar DeclarationSpecifier\n".
            "  abstract declarator description\n".
            "\n".
            "Parameter declaration: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', ParameterDeclaration::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
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
    
    /**
     * Tests that failureDescription() is called when:
     * - instantiated, 
     * - an abstract declarator constraint has been set, and 
     * - the value is invalid.
     */
    public function testFailureDescriptionWhenInstantiatedAndAbstractDeclaratorConstraintSetAndValueIsInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a parameter declaration`');
        
        $declSpecSeqConst = $this->declSpecSeqConstFactory->createConstraintDescription(
                'foo description'
        );
        $abstDcltorConst = ConceptConstraintDoubleBuilder::createAbstractDeclaratorConstraint($this)
            ->buildConstraintDescription('abstract declarator description')
            ->getDouble();
        
        $sut = new ParameterDeclarationConstraint($declSpecSeqConst);
        $sut->setAbstractDeclaratorConstraint($abstDcltorConst);
        $sut->evaluate(NULL, '', FALSE);
    }
}

