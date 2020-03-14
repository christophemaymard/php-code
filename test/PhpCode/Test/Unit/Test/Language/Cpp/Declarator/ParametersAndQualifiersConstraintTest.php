<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParametersAndQualifiers;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationClauseConstraintDoubleFactory;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationClauseDoubleFactory;
use PhpCode\Test\Language\Cpp\Declarator\ParametersAndQualifiersConstraint;
use PhpCode\Test\Language\Cpp\Declarator\ParametersAndQualifiersDoubleFactory;
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
     * @var ParametersAndQualifiersDoubleFactory
     */
    private $prmQualFactory;
    
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
        $this->prmQualFactory = new ParametersAndQualifiersDoubleFactory($this);
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
     * Tests that getConceptName() returns a string when instantiated.
     */
    public function testGetConceptNameReturnsStringWhenInstantiated(): void
    {
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createDummy();
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
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
     * Tests that matches() returns FALSE when instantiated and the 
     * parameter declaration clause is invalid.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndParameterDeclarationClauseIsInvalid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $prmQual = $this->prmQualFactory->createGetParameterDeclarationClause($prmDeclClause);
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatches(
            $prmDeclClause, 
            FALSE
        );
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        self::assertFalse($sut->matches($prmQual));
    }
    
    /**
     * Tests that matches() returns TRUE when instantiated and parameters and 
     * qualifiers are valid.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndParametersAndQualifiersAreValid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $prmQual = $this->prmQualFactory->createGetParameterDeclarationClause($prmDeclClause);
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createMatches(
            $prmDeclClause, 
            TRUE
        );
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
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
     * Tests that failureReason() returns a string when instantiated and the 
     * parameter declaration clause is invalid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndParameterDeclarationClauseIsInvalid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $prmQual = $this->prmQualFactory->createGetParameterDeclarationClause($prmDeclClause);
        
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
     * Tests that failureReason() returns a string when instantiated and 
     * parameters and qualifiers are valid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndParametersAndQualifiersAreValid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $prmQual = $this->prmQualFactory->createGetParameterDeclarationClause($prmDeclClause);
        
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
     * Tests that additionalFailureDescription() returns a string when 
     * instantiated and the parameter declaration clause is invalid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenInstantiatedAndParameterDeclarationClauseIsInvalid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $prmQual = $this->prmQualFactory->createGetParameterDeclarationClause($prmDeclClause);
        
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
     * Tests that additionalFailureDescription() returns a string when 
     * instantiated and parameters and qualifiers are valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenInstantiatedAndParametersAndQualifiersAreValid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createDummy();
        $prmQual = $this->prmQualFactory->createGetParameterDeclarationClause($prmDeclClause);
        
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
     * Tests that failureDescription() is called when the instantiated and 
     * the value is invalid.
     */
    public function testFailureDescriptionWhenInstantiatedAndInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is parameters and qualifiers`');
        
        $prmDeclClauseConst = $this->prmDeclClauseConstFactory->createConstraintDescription(
            'foo description'
        );
        
        $sut = new ParametersAndQualifiersConstraint($prmDeclClauseConst);
        $sut->evaluate(NULL, '', FALSE);
    }
}

