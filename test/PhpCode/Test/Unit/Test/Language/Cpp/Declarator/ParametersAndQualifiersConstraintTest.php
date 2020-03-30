<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParametersAndQualifiers;
use PhpCode\Test\Language\Cpp\ConceptConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationClauseConstraintDoubleFactory;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationClauseDoubleFactory;
use PhpCode\Test\Language\Cpp\Declarator\ParametersAndQualifiersConstraint;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Declarator\ParametersAndQualifiersConstraint} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParametersAndQualifiersConstraintTest extends TestCase
{
    /**
     * @var ParameterDeclarationClauseDoubleFactory
     */
    private $prmDeclClauseFactory;
    
    /**
     * @var ParameterDeclarationClauseConstraintDoubleFactory
     */
    private $prmDeclClauseConstFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->prmDeclClauseFactory = new ParameterDeclarationClauseDoubleFactory($this);
        $this->prmDeclClauseConstFactory = new ParameterDeclarationClauseConstraintDoubleFactory(
            $this
        );
    }
    
    /**
     * Tests that toString() returns a string when instantiated.
     */
    public function testToStringReturnsStringWhenInstantiated(): void
    {
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createDummy();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        self::assertSame('parameters and qualifiers', $sut->toString());
    }
    
    /**
     * Tests that toString() returns a string when instantiated and a 
     * constant/volatile qualifier sequence constraint has been set.
     */
    public function testToStringReturnsStringWhenInstantiatedAndCVQualifierSequenceConstraintSet(): void
    {
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createDummy();
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame('parameters and qualifiers', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string when instantiated.
     */
    public function testGetConceptNameReturnsStringWhenInstantiated(): void
    {
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createDummy();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        self::assertSame('Parameters and qualifiers', $sut->getConceptName());
    }
    
    /**
     * Tests that getConceptName() returns a string when instantiated and a 
     * constant/volatile qualifier sequence constraint has been set.
     */
    public function testGetConceptNameReturnsStringWhenInstantiatedAndCVQualifierSequenceConstraintSet(): void
    {
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createDummy();
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame('Parameters and qualifiers', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when instantiated.
     */
    public function testFailureDefaultReasonReturnsStringWhenInstantiated(): void
    {
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createDummy();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        self::assertSame(
            'Parameters and qualifiers: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when instantiated 
     * and a constant/volatile qualifier sequence constraint has been set.
     */
    public function testFailureDefaultReasonReturnsStringWhenInstantiatedAndCVQualifierSequenceConstraintSet(): void
    {
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createDummy();
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame(
            'Parameters and qualifiers: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when instantiated.
     */
    public function testConstraintDescriptionReturnsStringWhenInstantiated(): void
    {
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createConstraintDescription(
            "foo parameter declaration clause\n".
            "  bar parameter declaration list"
        );
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        self::assertSame(
            "Parameters and qualifiers\n".
            "  foo parameter declaration clause\n".
            "    bar parameter declaration list", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when instantiated 
     * and a constant/volatile qualifier sequence constraint has been set.
     */
    public function testConstraintDescriptionReturnsStringWhenInstantiatedAndCVQualifierSequenceConstraintSet(): void
    {
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createConstraintDescription(
            "foo parameter declaration clause\n".
            "  bar parameter declaration list"
        );
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildConstraintDescription('constant/volatile qualifier sequence constraint description')
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame(
            "Parameters and qualifiers\n".
            "  foo parameter declaration clause\n".
            "    bar parameter declaration list\n".
            "  constant/volatile qualifier sequence constraint description", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when instantiated and not instance 
     * of ParametersAndQualifiers.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndNotInstanceParametersAndQualifiers(): void
    {
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createDummy();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when:
     * - instantiated, 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - not instance of ParametersAndQualifiers.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndCVQualifierSequenceConstraintSetAndNotInstanceParametersAndQualifiers(): void
    {
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createDummy();
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when instantiated and the 
     * parameter declaration clause is invalid.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndParameterDeclarationClauseIsInvalid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatches(
            $prmDeclClause, 
            FALSE
        );
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        self::assertFalse($sut->matches($prmQual));
    }
    
    /**
     * Tests that matches() returns FALSE when:
     * - instantiated, 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - the parameter declaration clause is invalid.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndCVQualifierSequenceConstraintSetAndParameterDeclarationClauseIsInvalid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatches(
            $prmDeclClause, 
            FALSE
        );
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertFalse($sut->matches($prmQual));
    }
    
    /**
     * Tests that matches() returns FALSE when:
     * - instantiated, 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - there is no constant/volatile qualifier sequence.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndCVQualifierSequenceConstraintSetAndNoCVQualifierSequence(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->buildGetCVQualifierSequence()
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatches(
            $prmDeclClause, 
            TRUE
        );
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertFalse($sut->matches($prmQual));
    }
    
    /**
     * Tests that matches() returns FALSE when:
     * - instantiated, and 
     * - a constant/volatile qualifier sequence is present.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndCVQualifierSequenceIsPresent(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->getDouble();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->buildGetCVQualifierSequence($cvSeq)
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatches(
            $prmDeclClause, 
            TRUE
        );
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        self::assertFalse($sut->matches($prmQual));
    }
    
    /**
     * Tests that matches() returns FALSE when:
     * - instantiated, 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - the constant/volatile qualifier sequence is invalid.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndCVQualifierSequenceConstraintSetAndCVQualifierSequenceIsInvalid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->getDouble();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->buildGetCVQualifierSequence($cvSeq)
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatches(
            $prmDeclClause, 
            TRUE
        );
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildMatches($cvSeq, FALSE)
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertFalse($sut->matches($prmQual));
    }
    
    /**
     * Tests that matches() returns TRUE when instantiated and the parameter 
     * declaration clause is valid.
     */
    public function testMatchesReturnsTrueWhenInstantiatedAndParameterDeclarationClauseIsValid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->buildGetCVQualifierSequence()
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatches(
            $prmDeclClause, 
            TRUE
        );
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        self::assertTrue($sut->matches($prmQual));
    }
    
    /**
     * Tests that matches() returns TRUE when:
     * - instantiated, 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - the constant/volatile qualifier sequence is valid.
     */
    public function testMatchesReturnsTrueWhenInstantiatedAndCVQualifierSequenceConstraintSetAndCVQualifierSequenceIsValid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->getDouble();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->buildGetCVQualifierSequence($cvSeq)
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatches(
            $prmDeclClause, 
            TRUE
        );
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildMatches($cvSeq, TRUE)
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertTrue($sut->matches($prmQual));
    }
    
    /**
     * Tests that failureReason() returns a string when instantiated and not 
     * instance of ParametersAndQualifiers.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndNotInstanceParametersAndQualifiers(): void
    {
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createDummy();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        self::assertRegExp(
            \sprintf(
                '`^Parameters and qualifiers: .+ is not an instance of %s\\.$`', 
                \str_replace('\\', '\\\\', ParametersAndQualifiers::class)
            ), 
            $sut->failureReason(NULL)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when:
     * - instantiated, 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - not instance of ParametersAndQualifiers.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndCVQualifierSequenceConstraintSetAndNotInstanceParametersAndQualifiers(): void
    {
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createDummy();
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        $pattern = \sprintf(
            '`^Parameters and qualifiers: .+ is not an instance of %s\\.$`', 
            \str_replace('\\', '\\\\', ParametersAndQualifiers::class)
        );
        self::assertRegExp($pattern, $sut->failureReason(NULL));
    }
    
    /**
     * Tests that failureReason() returns a string when instantiated and the 
     * parameter declaration clause is invalid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndParameterDeclarationClauseIsInvalid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatchesFailureReason(
            $prmDeclClause, 
            FALSE, 
            "foo parameter declaration list\n".
            "  bar parameter declaration reason"
        );
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        self::assertSame(
            "Parameters and qualifiers\n".
            "  foo parameter declaration list\n".
            "    bar parameter declaration reason", 
            $sut->failureReason($prmQual)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when:
     * - instantiated, 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - the parameter declaration clause is invalid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndCVQualifierSequenceConstraintSetAndParameterDeclarationClauseIsInvalid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatchesFailureReason(
            $prmDeclClause, 
            FALSE, 
            "foo parameter declaration list\n".
            "  bar parameter declaration reason"
        );
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame(
            "Parameters and qualifiers\n".
            "  foo parameter declaration list\n".
            "    bar parameter declaration reason", 
            $sut->failureReason($prmQual)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when:
     * - instantiated, 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - there is no constant/volatile qualifier sequence.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndCVQualifierSequenceConstraintSetAndNoCVQualifierSequence(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->buildGetCVQualifierSequence()
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatches(
            $prmDeclClause, 
            TRUE
        );
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame(
            'Parameters and qualifiers: '.
            'constant/volatile qualifier sequence absent whereas it should be present.', 
            $sut->failureReason($prmQual)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when:
     * - instantiated, and 
     * - a constant/volatile qualifier sequence is present.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndCVQualifierSequenceIsPresent(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->getDouble();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->buildGetCVQualifierSequence($cvSeq)
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatches(
            $prmDeclClause, 
            TRUE
        );
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        self::assertSame(
            'Parameters and qualifiers: '.
            'constant/volatile qualifier sequence present whereas it should be absent.', 
            $sut->failureReason($prmQual)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when:
     * - instantiated, 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - the constant/volatile qualifier sequence is invalid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndCVQualifierSequenceConstraintSetAndCVQualifierSequenceIsInvalid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->getDouble();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->buildGetCVQualifierSequence($cvSeq)
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatches(
            $prmDeclClause, 
            TRUE
        );
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildMatches($cvSeq, FALSE)
            ->buildFailureReason($cvSeq, 'constant/volatile qualifier sequence reason')
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame(
            "Parameters and qualifiers\n".
            "  constant/volatile qualifier sequence reason", 
            $sut->failureReason($prmQual)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when instantiated and the 
     * parameter declaration clause is valid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndParameterDeclarationClauseIsValid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->buildGetCVQualifierSequence()
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatches(
            $prmDeclClause, 
            TRUE
        );
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        self::assertSame(
            'Parameters and qualifiers: Unknown reason.', 
            $sut->failureReason($prmQual)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when:
     * - instantiated, 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - the constant/volatile qualifier sequence is valid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndCVQualifierSequenceConstraintSetAndCVQualifierSequenceIsValid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->getDouble();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->buildGetCVQualifierSequence($cvSeq)
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatches(
            $prmDeclClause, 
            TRUE
        );
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildMatches($cvSeq, TRUE)
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame(
            'Parameters and qualifiers: Unknown reason.', 
            $sut->failureReason($prmQual)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when 
     * instantiated and not instance of ParametersAndQualifiers.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenInstantiatedAndNotInstanceParametersAndQualifiers(): void
    {
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createConstraintDescription(
            "foo parameter declaration list description\n".
            "  bar parameter declaration description"
        );
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $pattern = \sprintf(
            "`^\n".
            "Parameters and qualifiers\n".
            "  foo parameter declaration list description\n".
            "    bar parameter declaration description\n".
            "\n".
            "Parameters and qualifiers: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', ParametersAndQualifiers::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when:
     * - instantiated, 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - not instance of ParametersAndQualifiers.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenInstantiatedAndCVQualifierSequenceConstraintSetAndNotInstanceParametersAndQualifiers(): void
    {
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createConstraintDescription(
            "foo parameter declaration list description\n".
            "  bar parameter declaration description"
        );
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildConstraintDescription('constant/volatile qualifier sequence description')
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        $pattern = \sprintf(
            "`^\n".
            "Parameters and qualifiers\n".
            "  foo parameter declaration list description\n".
            "    bar parameter declaration description\n".
            "  constant/volatile qualifier sequence description\n".
            "\n".
            "Parameters and qualifiers: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', ParametersAndQualifiers::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when 
     * instantiated and the parameter declaration clause is invalid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenInstantiatedAndParameterDeclarationClauseIsInvalid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatchesFailureReasonConstraintDescription(
            $prmDeclClause, 
            FALSE, 
            "foo parameter declaration list\n".
            "  bar parameter declaration reason", 
            "foo parameter declaration list description\n".
            "  bar parameter declaration description"
        );
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        self::assertSame(
            "\n".
            "Parameters and qualifiers\n".
            "  foo parameter declaration list description\n".
            "    bar parameter declaration description\n".
            "\n".
            "Parameters and qualifiers\n".
            "  foo parameter declaration list\n".
            "    bar parameter declaration reason", 
            $sut->additionalFailureDescription($prmQual)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when:
     * - instantiated, 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - the parameter declaration clause is invalid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenInstantiatedAndCVQualifierSequenceConstraintSetAndParameterDeclarationClauseIsInvalid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatchesFailureReasonConstraintDescription(
            $prmDeclClause, 
            FALSE, 
            "foo parameter declaration list\n".
            "  bar parameter declaration reason", 
            "foo parameter declaration list description\n".
            "  bar parameter declaration description"
        );
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildConstraintDescription('constant/volatile qualifier sequence description')
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame(
            "\n".
            "Parameters and qualifiers\n".
            "  foo parameter declaration list description\n".
            "    bar parameter declaration description\n".
            "  constant/volatile qualifier sequence description\n".
            "\n".
            "Parameters and qualifiers\n".
            "  foo parameter declaration list\n".
            "    bar parameter declaration reason", 
            $sut->additionalFailureDescription($prmQual)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when:
     * - instantiated, 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - there is no constant/volatile qualifier sequence.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenInstantiatedAndCVQualifierSequenceConstraintSetAndNoCVQualifierSequence(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->buildGetCVQualifierSequence()
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatchesConstraintDescription(
            $prmDeclClause, 
            TRUE, 
            "foo parameter declaration list description\n".
            "  bar parameter declaration description"
        );
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildConstraintDescription('constant/volatile qualifier sequence description')
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame(
            "\n".
            "Parameters and qualifiers\n".
            "  foo parameter declaration list description\n".
            "    bar parameter declaration description\n".
            "  constant/volatile qualifier sequence description\n".
            "\n".
            "Parameters and qualifiers: ".
            "constant/volatile qualifier sequence absent whereas it should be present.", 
            $sut->additionalFailureDescription($prmQual)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when:
     * - instantiated, and 
     * - a constant/volatile qualifier sequence is present.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenInstantiatedAndCVQualifierSequenceIsPresent(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->getDouble();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->buildGetCVQualifierSequence($cvSeq)
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatchesConstraintDescription(
            $prmDeclClause, 
            TRUE, 
            "foo parameter declaration list description\n".
            "  bar parameter declaration description"
        );
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        self::assertSame(
            "\n".
            "Parameters and qualifiers\n".
            "  foo parameter declaration list description\n".
            "    bar parameter declaration description\n".
            "\n".
            "Parameters and qualifiers: ".
            "constant/volatile qualifier sequence present whereas it should be absent.", 
            $sut->additionalFailureDescription($prmQual)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when:
     * - instantiated, 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - the constant/volatile qualifier sequence is invalid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenInstantiatedAndCVQualifierSequenceConstraintSetAndCVQualifierSequenceIsInvalid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->getDouble();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->buildGetCVQualifierSequence($cvSeq)
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatchesConstraintDescription(
            $prmDeclClause, 
            TRUE, 
            "foo parameter declaration list description\n".
            "  bar parameter declaration description"
        );
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildMatches($cvSeq, FALSE)
            ->buildConstraintDescription('constant/volatile qualifier sequence description')
            ->buildFailureReason($cvSeq, 'constant/volatile qualifier sequence reason')
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame(
            "\n".
            "Parameters and qualifiers\n".
            "  foo parameter declaration list description\n".
            "    bar parameter declaration description\n".
            "  constant/volatile qualifier sequence description\n".
            "\n".
            "Parameters and qualifiers\n".
            "  constant/volatile qualifier sequence reason", 
            $sut->additionalFailureDescription($prmQual)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when 
     * instantiated and parameters and the parameter declaration clause is 
     * valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenInstantiatedAndParameterDeclarationClauseIsValid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->buildGetCVQualifierSequence()
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatchesConstraintDescription(
            $prmDeclClause, 
            TRUE, 
            "foo parameter declaration list description\n".
            "  bar parameter declaration description"
        );
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        self::assertSame(
            "\n".
            "Parameters and qualifiers\n".
            "  foo parameter declaration list description\n".
            "    bar parameter declaration description\n".
            "\n".
            "Parameters and qualifiers: Unknown reason.", 
            $sut->additionalFailureDescription($prmQual)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when:
     * - instantiated, 
     * - a constant/volatile qualifier sequence constraint has been set, and 
     * - the constant/volatile qualifier sequence is valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenInstantiatedAndCVQualifierSequenceConstraintSetAndCVQualifierSequenceIsValid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $cvSeq = ConceptDoubleBuilder::createCVQualifierSequence($this)
            ->getDouble();
        $prmQual = ConceptDoubleBuilder::createParametersAndQualifiers($this)
            ->buildGetParameterDeclarationClause($prmDeclClause)
            ->buildGetCVQualifierSequence($cvSeq)
            ->getDouble();
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatchesConstraintDescription(
            $prmDeclClause, 
            TRUE, 
            "foo parameter declaration list description\n".
            "  bar parameter declaration description"
        );
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildMatches($cvSeq, TRUE)
            ->buildConstraintDescription('constant/volatile qualifier sequence description')
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        self::assertSame(
            "\n".
            "Parameters and qualifiers\n".
            "  foo parameter declaration list description\n".
            "    bar parameter declaration description\n".
            "  constant/volatile qualifier sequence description\n".
            "\n".
            "Parameters and qualifiers: Unknown reason.", 
            $sut->additionalFailureDescription($prmQual)
        );
    }
    
    /**
     * Tests that failureDescription() is called when instantiated and the 
     * value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenInstantiatedAndValueIsInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` are parameters and qualifiers`');
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createConstraintDescription(
            'foo description'
        );
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Tests that failureDescription() is called when instantiated and the 
     * value is invalid.
     */
    public function testFailureDescriptionIsCalledWhenInstantiatedAndCVQualifierSequenceConstraintSetAndValueIsInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` are parameters and qualifiers`');
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createConstraintDescription(
            'foo description'
        );
        $cvSeqConst = ConceptConstraintDoubleBuilder::createCVQualifierSequenceConstraint($this)
            ->buildConstraintDescription('constant/volatile qualifier sequence description')
            ->getDouble();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->setCVQualifierSequenceConstraint($cvSeqConst);
        $sut->evaluate(NULL, '', FALSE);
    }
}

