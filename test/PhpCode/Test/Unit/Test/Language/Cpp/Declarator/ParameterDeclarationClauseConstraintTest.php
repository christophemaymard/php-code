<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParameterDeclarationClause;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationClauseConstraint;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationClauseDoubleFactory;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationListConstraintDoubleFactory;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationListDoubleFactory;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationClauseConstraint} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationClauseConstraintTest extends TestCase
{
    /**
     * @var ParameterDeclarationClauseDoubleFactory
     */
    private $prmDeclClauseFactory;
    
    /**
     * @var ParameterDeclarationListDoubleFactory
     */
    private $prmDeclListFactory;
    
    /**
     * @var ParameterDeclarationListConstraintDoubleFactory
     */
    private $prmDeclListConstFactory;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->prmDeclClauseFactory = new ParameterDeclarationClauseDoubleFactory($this);
        $this->prmDeclListFactory = new ParameterDeclarationListDoubleFactory($this);
        $this->prmDeclListConstFactory = new ParameterDeclarationListConstraintDoubleFactory($this);
    }
    
    /**
     * Tests that setParameterDeclarationListConstraint() returns the 
     * current instance.
     */
    public function testSetParameterDeclarationListConstraintReturnsCurrentInstance(): void
    {
        $prmDeclListConst = $this->prmDeclListConstFactory->createDummy();
        
        $sut = new ParameterDeclarationClauseConstraint();
        self::assertSame($sut, $sut->setParameterDeclarationListConstraint($prmDeclListConst));
    }
    
    /**
     * Tests that addEllipsis() returns the current instance.
     */
    public function testAddEllipsisReturnsCurrentInstance(): void
    {
        $sut = new ParameterDeclarationClauseConstraint();
        self::assertSame($sut, $sut->addEllipsis());
    }
    
    /**
     * Tests that toString() returns a string when instantiated.
     */
    public function testToStringReturnsStringWhenInstantiated(): void
    {
        $sut = new ParameterDeclarationClauseConstraint();
        self::assertSame('parameter declaration clause', $sut->toString());
    }
    
    /**
     * Tests that toString() returns a string when an ellipsis is present.
     */
    public function testToStringReturnsStringWhenEllipsis(): void
    {
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->addEllipsis();
        self::assertSame(
            'parameter declaration clause with an ellipsis', 
            $sut->toString()
        );
    }
    
    /**
     * Tests that toString() returns a string when a parameter declaration 
     * list constraint is set.
     */
    public function testToStringReturnsStringWhenList(): void
    {
        $prmDeclListConst = $this->prmDeclListConstFactory->createDummy();
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        self::assertSame(
            'parameter declaration clause with a parameter declaration list', 
            $sut->toString()
        );
    }
    
    /**
     * Tests that toString() returns a string when a parameter declaration 
     * list constraint is set and an ellipsis is present.
     */
    public function testToStringReturnsStringWhenListAndEllipsis(): void
    {
        $prmDeclListConst = $this->prmDeclListConstFactory->createDummy();
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        $sut->addEllipsis();
        self::assertSame(
            'parameter declaration clause with a parameter declaration list '.
            'and an ellipsis', 
            $sut->toString()
        );
    }
    
    /**
     * Tests that getConceptName() returns a string when instantiated.
     */
    public function testGetConceptNameReturnsStringWhenInstantiated(): void
    {
        $sut = new ParameterDeclarationClauseConstraint();
        self::assertSame('Parameter declaration clause', $sut->getConceptName());
    }
    
    /**
     * Tests that getConceptName() returns a string when an ellipsis is 
     * present.
     */
    public function testGetConceptNameReturnsStringWhenEllipsis(): void
    {
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->addEllipsis();
        self::assertSame(
            'Parameter declaration clause with an ellipsis', 
            $sut->getConceptName()
        );
    }
    
    /**
     * Tests that getConceptName() returns a string when a parameter 
     * declaration list constraint is set.
     */
    public function testGetConceptNameReturnsStringWhenList(): void
    {
        $prmDeclListConst = $this->prmDeclListConstFactory->createDummy();
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        self::assertSame(
            'Parameter declaration clause with a parameter declaration list', 
            $sut->getConceptName()
        );
    }
    
    /**
     * Tests that getConceptName() returns a string when a parameter 
     * declaration list constraint is set and an ellipsis is present.
     */
    public function testGetConceptNameReturnsStringWhenListAndEllipsis(): void
    {
        $prmDeclListConst = $this->prmDeclListConstFactory->createDummy();
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        $sut->addEllipsis();
        self::assertSame(
            'Parameter declaration clause with a parameter declaration list '.
            'and an ellipsis', 
            $sut->getConceptName()
        );
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when instantiated.
     */
    public function testFailureDefaultReasonReturnsStringWhenInstantiated(): void
    {
        $sut = new ParameterDeclarationClauseConstraint();
        self::assertSame(
            'Parameter declaration clause: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when an ellipsis 
     * is present.
     */
    public function testFailureDefaultReasonReturnsStringWhenEllipsis(): void
    {
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->addEllipsis();
        self::assertSame(
            'Parameter declaration clause with an ellipsis: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when a parameter 
     * declaration list constraint is set.
     */
    public function testFailureDefaultReasonReturnsStringWhenList(): void
    {
        $prmDeclListConst = $this->prmDeclListConstFactory->createDummy();
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        self::assertSame(
            'Parameter declaration clause with a parameter declaration list: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that failureDefaultReason() returns a string when a parameter 
     * declaration list constraint is set and an ellipsis is present.
     */
    public function testFailureDefaultReasonReturnsStringWhenListAndEllipsis(): void
    {
        $prmDeclListConst = $this->prmDeclListConstFactory->createDummy();
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        $sut->addEllipsis();
        self::assertSame(
            'Parameter declaration clause with a parameter declaration list '.
            'and an ellipsis: Unknown reason.', 
            $sut->failureDefaultReason(NULL)
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when instantiated.
     */
    public function testConstraintDescriptionReturnsStringWhenInstantiated(): void
    {
        $sut = new ParameterDeclarationClauseConstraint();
        self::assertSame(
            'Parameter declaration clause', 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when an ellipsis 
     * is present.
     */
    public function testConstraintDescriptionReturnsStringWhenEllipsis(): void
    {
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->addEllipsis();
        self::assertSame(
            'Parameter declaration clause with an ellipsis', 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when a parameter 
     * declaration list constraint is set.
     */
    public function testConstraintDescriptionReturnsStringWhenList(): void
    {
        $prmDeclListConst = $this->prmDeclListConstFactory->createConstraintDescription(
            "foo ParameterDeclarationList\n".
            "  bar DeclarationSpecifierSequence"
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        self::assertSame(
            "Parameter declaration clause with a parameter declaration list\n".
            "  foo ParameterDeclarationList\n".
            "    bar DeclarationSpecifierSequence", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that constraintDescription() returns a string when a parameter 
     * declaration list constraint is set and an ellipsis is present.
     */
    public function testConstraintDescriptionReturnsStringWhenListAndEllipsis(): void
    {
        $prmDeclListConst = $this->prmDeclListConstFactory->createConstraintDescription(
            "foo ParameterDeclarationList\n".
            "  bar DeclarationSpecifierSequence"
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        $sut->addEllipsis();
        self::assertSame(
            "Parameter declaration clause with a parameter declaration list and an ellipsis\n".
            "  foo ParameterDeclarationList\n".
            "    bar DeclarationSpecifierSequence", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when instantiated and not instance 
     * of ParameterDeclarationClause.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndNotInstanceParameterDeclarationClause(): void
    {
        $sut = new ParameterDeclarationClauseConstraint();
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when an ellipsis is present and 
     * not instance of ParameterDeclarationClause.
     */
    public function testMatchesReturnsFalseWhenEllipsisAndNotInstanceParameterDeclarationClause(): void
    {
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->addEllipsis();
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when a parameter declaration list 
     * constraint is set and not instance of ParameterDeclarationClause.
     */
    public function testMatchesReturnsFalseWhenListAndNotInstanceParameterDeclarationClause(): void
    {
        $prmDeclListConst = $this->prmDeclListConstFactory->createDummy();
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when a parameter declaration list 
     * constraint is set, an ellipsis is present and not instance of 
     * ParameterDeclarationClause.
     */
    public function testMatchesReturnsFalseWhenListAndEllipsisAndNotInstanceParameterDeclarationClause(): void
    {
        $prmDeclListConst = $this->prmDeclListConstFactory->createDummy();
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        $sut->addEllipsis();
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when instantiated and the parameter 
     * declaration clause contains a parameter declaration list.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndContainsParameterDeclarationList(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createGetParameterDeclarationList($prmDeclList);
        
        $sut = new ParameterDeclarationClauseConstraint();
        self::assertFalse($sut->matches($prmDeclClause));
    }
    
    /**
     * Tests that matches() returns FALSE when an ellipsis is present and the 
     * parameter declaration clause contains a parameter declaration list.
     */
    public function testMatchesReturnsFalseWhenEllipsisAndContainsParameterDeclarationList(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createGetParameterDeclarationList($prmDeclList);
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->addEllipsis();
        self::assertFalse($sut->matches($prmDeclClause));
    }
    
    /**
     * Tests that matches() returns FALSE when a parameter declaration list 
     * constraint is set and the parameter declaration list is invalid.
     */
    public function testMatchesReturnsFalseWhenListAndParameterDeclarationListIsInvalid(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createGetParameterDeclarationList($prmDeclList);
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createMatches($prmDeclList, FALSE);
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        self::assertFalse($sut->matches($prmDeclClause));
    }
    
    /**
     * Tests that matches() returns FALSE when a parameter declaration list 
     * constraint is set, an ellipsis is present and the parameter 
     * declaration list is invalid.
     */
    public function testMatchesReturnsFalseWhenListAndEllipsisAndParameterDeclarationListIsInvalid(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createGetParameterDeclarationList($prmDeclList);
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createMatches($prmDeclList, FALSE);
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        $sut->addEllipsis();
        self::assertFalse($sut->matches($prmDeclClause));
    }
    
    /**
     * Tests that matches() returns FALSE when instantiated and the parameter 
     * declaration clause has an ellipsis.
     */
    public function testMatchesReturnsFalseWhenInstantiatedAndParameterDeclarationClauseHasEllipsis(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            TRUE
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        self::assertFalse($sut->matches($prmDeclClause));
    }
    
    /**
     * Tests that matches() returns FALSE when an ellipsis is present and the 
     * parameter declaration clause has no ellipsis.
     */
    public function testMatchesReturnsFalseWhenEllipsisAndParameterDeclarationClauseHasNoEllipsis(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            FALSE
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->addEllipsis();
        self::assertFalse($sut->matches($prmDeclClause));
    }
    
    /**
     * Tests that matches() returns FALSE when a parameter declaration list 
     * constraint is set and the parameter declaration clause has an ellipsis.
     */
    public function testMatchesReturnsFalseWhenListAndParameterDeclarationClauseHasEllipsis(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            TRUE, 
            $prmDeclList
        );
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createMatches($prmDeclList, TRUE);
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        self::assertFalse($sut->matches($prmDeclClause));
    }
    
    /**
     * Tests that matches() returns FALSE when a parameter declaration list 
     * constraint is set, an ellipsis is present and the parameter 
     * declaration clause has no ellipsis.
     */
    public function testMatchesReturnsFalseWhenListAndEllipsisAndParameterDeclarationClauseHasNoEllipsis(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            FALSE, 
            $prmDeclList
        );
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createMatches($prmDeclList, TRUE);
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        $sut->addEllipsis();
        self::assertFalse($sut->matches($prmDeclClause));
    }
    
    /**
     * Tests that matches() returns TRUE when the parameter declaration 
     * clause is valid.
     */
    public function testMatchesReturnsTrueWhenInstantiatedAndParameterDeclarationClauseIsValid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            FALSE
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        self::assertTrue($sut->matches($prmDeclClause));
    }
    
    /**
     * Tests that matches() returns TRUE when an ellipsis is present and the 
     * parameter declaration clause is valid.
     */
    public function testMatchesReturnsTrueWhenEllipsisAndParameterDeclarationClauseIsValid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            TRUE
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->addEllipsis();
        self::assertTrue($sut->matches($prmDeclClause));
    }
    
    /**
     * Tests that matches() returns TRUE when a parameter declaration list 
     * constraint is set and the parameter declaration clause is valid.
     */
    public function testMatchesReturnsTrueWhenListAndParameterDeclarationClauseIsValid(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            FALSE, 
            $prmDeclList
        );
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createMatches($prmDeclList, TRUE);
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        self::assertTrue($sut->matches($prmDeclClause));
    }
    
    /**
     * Tests that matches() returns TRUE when a parameter declaration list 
     * constraint is set, an ellipsis is present and the parameter 
     * declaration clause is valid.
     */
    public function testMatchesReturnsTrueWhenListAndEllipsisAndParameterDeclarationClauseIsValid(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            TRUE, 
            $prmDeclList
        );
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createMatches($prmDeclList, TRUE);
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        $sut->addEllipsis();
        self::assertTrue($sut->matches($prmDeclClause));
    }
    
    /**
     * Tests that failureReason() returns a string when instantiated and not 
     * instance of ParameterDeclarationClause.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndNotInstanceParameterDeclarationClause(): void
    {
        $sut = new ParameterDeclarationClauseConstraint();
        self::assertRegExp(
            \sprintf(
                '`^Parameter declaration clause: .+ is not an instance of %s\\.$`', 
                \str_replace('\\', '\\\\', ParameterDeclarationClause::class)
            ), 
            $sut->failureReason(NULL)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when an ellipsis is 
     * present and not instance of ParameterDeclarationClause.
     */
    public function testFailureReasonReturnsStringWhenEllipsisAndNotInstanceParameterDeclarationClause(): void
    {
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->addEllipsis();
        self::assertRegExp(
            \sprintf(
                '`^Parameter declaration clause with an ellipsis: .+ is not an instance of %s\\.$`', 
                \str_replace('\\', '\\\\', ParameterDeclarationClause::class)
            ), 
            $sut->failureReason(NULL)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when a parameter 
     * declaration list constraint is set and not instance of 
     * ParameterDeclarationClause.
     */
    public function testFailureReasonReturnsStringWhenListAndNotInstanceParameterDeclarationClause(): void
    {
        $prmDeclListConst = $this->prmDeclListConstFactory->createDummy();
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        self::assertRegExp(
            \sprintf(
                '`^Parameter declaration clause with a parameter declaration '.
                'list: .+ is not an instance of %s\\.$`', 
                \str_replace('\\', '\\\\', ParameterDeclarationClause::class)
            ), 
            $sut->failureReason(NULL)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when a parameter 
     * declaration list constraint is set, an ellipsis is present and not 
     * instance of ParameterDeclarationClause.
     */
    public function testFailureReasonReturnsStringWhenListAndEllipsisAndNotInstanceParameterDeclarationClause(): void
    {
        $prmDeclListConst = $this->prmDeclListConstFactory->createDummy();
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        $sut->addEllipsis();
        self::assertRegExp(
            \sprintf(
                '`^Parameter declaration clause with a parameter declaration '.
                'list and an ellipsis: .+ is not an instance of %s\\.$`', 
                \str_replace('\\', '\\\\', ParameterDeclarationClause::class)
            ), 
            $sut->failureReason(NULL)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when instantiated and the 
     * parameter declaration clause contains a parameter declaration list.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndContainsParameterDeclarationList(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createGetParameterDeclarationList($prmDeclList);
        
        $sut = new ParameterDeclarationClauseConstraint();
        self::assertSame(
            'Parameter declaration clause: Unexpected parameter declaration list.', 
            $sut->failureReason($prmDeclClause)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when an ellipsis is 
     * present and the parameter declaration clause contains a parameter 
     * declaration list.
     */
    public function testFailureReasonReturnsStringWhenEllipsisAndContainsParameterDeclarationList(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createGetParameterDeclarationList($prmDeclList);
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->addEllipsis();
        self::assertSame(
            'Parameter declaration clause with an ellipsis: Unexpected parameter declaration list.', 
            $sut->failureReason($prmDeclClause)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when a parameter 
     * declaration list constraint is set and the parameter declaration list 
     * is invalid.
     */
    public function testFailureReasonReturnsStringWhenListAndParameterDeclarationListIsInvalid(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createGetParameterDeclarationList($prmDeclList);
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createMatchesFailureReason(
            $prmDeclList, 
            FALSE, 
            "foo ParameterDeclarationList\n".
            "  bar reason"
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        self::assertSame(
            "Parameter declaration clause with a parameter declaration list\n".
            "  foo ParameterDeclarationList\n".
            "    bar reason", 
            $sut->failureReason($prmDeclClause)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when a parameter 
     * declaration list constraint is set, an ellipsis is present and the 
     * parameter declaration list is invalid.
     */
    public function testFailureReasonReturnsStringWhenListAndEllipsisAndParameterDeclarationListIsInvalid(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createGetParameterDeclarationList($prmDeclList);
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createMatchesFailureReason(
            $prmDeclList, 
            FALSE, 
            "foo ParameterDeclarationList\n".
            "  bar reason"
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        $sut->addEllipsis();
        self::assertSame(
            "Parameter declaration clause with a parameter declaration list and an ellipsis\n".
            "  foo ParameterDeclarationList\n".
            "    bar reason", 
            $sut->failureReason($prmDeclClause)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when instantiated and the 
     * parameter declaration clause has an ellipsis.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndParameterDeclarationClauseHasEllipsis(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            TRUE
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        self::assertSame(
            'Parameter declaration clause: ellipsis present whereas it should be absent.', 
            $sut->failureReason($prmDeclClause)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when an ellipsis is 
     * present and the parameter declaration clause has no ellipsis.
     */
    public function testFailureReasonReturnsStringWhenEllipsisAndParameterDeclarationClauseHasNoEllipsis(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            FALSE
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->addEllipsis();
        self::assertSame(
            'Parameter declaration clause with an ellipsis: ellipsis absent '.
            'whereas it should be present.', 
            $sut->failureReason($prmDeclClause)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when a parameter 
     * declaration list constraint is set and the parameter declaration 
     * clause has an ellipsis.
     */
    public function testFailureReasonReturnsStringWhenListAndParameterDeclarationClauseHasEllipsis(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            TRUE, 
            $prmDeclList
        );
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createMatches($prmDeclList, TRUE);
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        self::assertSame(
            'Parameter declaration clause with a parameter declaration list: '.
            'ellipsis present whereas it should be absent.', 
            $sut->failureReason($prmDeclClause)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when a parameter 
     * declaration list constraint is set, an ellipsis is present and the 
     * parameter declaration clause has no ellipsis.
     */
    public function testFailureReasonReturnsStringWhenListAndEllipsisAndParameterDeclarationClauseHasNoEllipsis(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            FALSE, 
            $prmDeclList
        );
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createMatches($prmDeclList, TRUE);
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        $sut->addEllipsis();
        self::assertSame(
            'Parameter declaration clause with a parameter declaration list and '.
            'an ellipsis: ellipsis absent whereas it should be present.', 
            $sut->failureReason($prmDeclClause)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the parameter 
     * declaration clause is valid.
     */
    public function testFailureReasonReturnsStringWhenInstantiatedAndParameterDeclarationClauseIsValid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            FALSE
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        self::assertSame(
            'Parameter declaration clause: Unknown reason.', 
            $sut->failureReason($prmDeclClause)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when an ellipsis is 
     * present and the parameter declaration clause is valid.
     */
    public function testFailureReasonReturnsStringWhenEllipsisAndParameterDeclarationClauseIsValid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            TRUE
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->addEllipsis();
        self::assertSame(
            'Parameter declaration clause with an ellipsis: Unknown reason.', 
            $sut->failureReason($prmDeclClause)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when a parameter 
     * declaration list constraint is set and the parameter declaration 
     * clause is valid.
     */
    public function testFailureReasonReturnsStringWhenListAndParameterDeclarationClauseIsValid(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            FALSE, 
            $prmDeclList
        );
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createMatches($prmDeclList, TRUE);
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        self::assertSame(
            'Parameter declaration clause with a parameter declaration list: Unknown reason.', 
            $sut->failureReason($prmDeclClause)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when a parameter 
     * declaration list constraint is set, an ellipsis is present and the 
     * parameter declaration clause is valid.
     */
    public function testFailureReasonReturnsStringWhenListAndEllipsisAndParameterDeclarationClauseIsValid(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            TRUE, 
            $prmDeclList
        );
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createMatches($prmDeclList, TRUE);
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        $sut->addEllipsis();
        self::assertSame(
            'Parameter declaration clause with a parameter declaration list and '.
            'an ellipsis: Unknown reason.', 
            $sut->failureReason($prmDeclClause)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when 
     * instantiated and not instance of ParameterDeclarationClause.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenInstantiatedAndNotInstanceParameterDeclarationClause(): void
    {
        $sut = new ParameterDeclarationClauseConstraint();
        $pattern = \sprintf(
            "`^\n".
            "Parameter declaration clause\n".
            "\n".
            "Parameter declaration clause: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', ParameterDeclarationClause::class)
        );
        
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when an 
     * ellipsis is present and not instance of ParameterDeclarationClause.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenEllipsisAndNotInstanceParameterDeclarationClause(): void
    {
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->addEllipsis();
        $pattern = \sprintf(
            "`^\n".
            "Parameter declaration clause with an ellipsis\n".
            "\n".
            "Parameter declaration clause with an ellipsis: .+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', ParameterDeclarationClause::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when a 
     * parameter declaration list constraint is set and not instance of 
     * ParameterDeclarationClause.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenListAndNotInstanceParameterDeclarationClause(): void
    {
        $prmDeclListConst = $this->prmDeclListConstFactory->createConstraintDescription(
            "foo ParameterDeclarationList\n".
            "  bar DeclarationSpecifierSequence"
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        $pattern = \sprintf(
            "`^\n".
            "Parameter declaration clause with a parameter declaration list\n".
            "  foo ParameterDeclarationList\n".
            "    bar DeclarationSpecifierSequence\n".
            "\n".
            "Parameter declaration clause with a parameter declaration list: ".
            ".+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', ParameterDeclarationClause::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when a 
     * parameter declaration list constraint is set, an ellipsis is present 
     * and not instance of ParameterDeclarationClause.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenListAndEllipsisAndNotInstanceParameterDeclarationClause(): void
    {
        $prmDeclListConst = $this->prmDeclListConstFactory->createConstraintDescription(
            "foo ParameterDeclarationList\n".
            "  bar DeclarationSpecifierSequence"
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        $sut->addEllipsis();
        $pattern = \sprintf(
            "`^\n".
            "Parameter declaration clause with a parameter declaration list and an ellipsis\n".
            "  foo ParameterDeclarationList\n".
            "    bar DeclarationSpecifierSequence\n".
            "\n".
            "Parameter declaration clause with a parameter declaration list and an ellipsis: ".
            ".+ is not an instance of %s\\.$`", 
            \str_replace('\\', '\\\\', ParameterDeclarationClause::class)
        );
        self::assertRegExp($pattern, $sut->additionalFailureDescription(NULL));
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when 
     * instantiated and the parameter declaration clause contains a parameter 
     * declaration list.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenInstantiatedAndContainsParameterDeclarationList(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createGetParameterDeclarationList($prmDeclList);
        
        $sut = new ParameterDeclarationClauseConstraint();
        self::assertSame(
            "\n".
            "Parameter declaration clause\n".
            "\n". 
            "Parameter declaration clause: Unexpected parameter declaration list.", 
            $sut->additionalFailureDescription($prmDeclClause)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when an 
     * ellipsis is present and the parameter declaration clause contains a 
     * parameter declaration list.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenEllipsisAndContainsParameterDeclarationList(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createGetParameterDeclarationList($prmDeclList);
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->addEllipsis();
        self::assertSame(
            "\n".
            "Parameter declaration clause with an ellipsis\n".
            "\n". 
            "Parameter declaration clause with an ellipsis: Unexpected parameter declaration list.", 
            $sut->additionalFailureDescription($prmDeclClause)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when a 
     * parameter declaration list constraint is set and the parameter 
     * declaration list is invalid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenListAndParameterDeclarationListIsInvalid(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createGetParameterDeclarationList($prmDeclList);
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createMatchesFailureReasonConstraintDescription(
            $prmDeclList, 
            FALSE, 
            "foo ParameterDeclarationList\n".
            "  bar reason", 
            "foo description\n".
            "  bar description"
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        self::assertSame(
            "\n".
            "Parameter declaration clause with a parameter declaration list\n".
            "  foo description\n".
            "    bar description\n".
            "\n".
            "Parameter declaration clause with a parameter declaration list\n".
            "  foo ParameterDeclarationList\n".
            "    bar reason", 
            $sut->additionalFailureDescription($prmDeclClause)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when a 
     * parameter declaration list constraint is set, an ellipsis is present 
     * and the parameter declaration list is invalid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenListAndEllipsisAndParameterDeclarationListIsInvalid(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createGetParameterDeclarationList($prmDeclList);
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createMatchesFailureReasonConstraintDescription(
            $prmDeclList, 
            FALSE, 
            "foo ParameterDeclarationList\n".
            "  bar reason", 
            "foo description\n".
            "  bar description"
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        $sut->addEllipsis();
        self::assertSame(
            "\n".
            "Parameter declaration clause with a parameter declaration list and an ellipsis\n".
            "  foo description\n".
            "    bar description\n".
            "\n".
            "Parameter declaration clause with a parameter declaration list and an ellipsis\n".
            "  foo ParameterDeclarationList\n".
            "    bar reason", 
            $sut->additionalFailureDescription($prmDeclClause)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when 
     * instantiated and the parameter declaration clause has an ellipsis.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenInstantiatedAndParameterDeclarationClauseHasEllipsis(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            TRUE
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        self::assertSame(
            "\n".
            "Parameter declaration clause\n".
            "\n".
            "Parameter declaration clause: ellipsis present whereas it should be absent.", 
            $sut->additionalFailureDescription($prmDeclClause)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when an 
     * ellipsis is present and the parameter declaration clause has no 
     * ellipsis.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenEllipsisAndParameterDeclarationClauseHasNoEllipsis(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            FALSE
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->addEllipsis();
        self::assertSame(
            "\n".
            "Parameter declaration clause with an ellipsis\n".
            "\n".
            "Parameter declaration clause with an ellipsis: ellipsis absent ".
            "whereas it should be present.", 
            $sut->additionalFailureDescription($prmDeclClause)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when a 
     * parameter declaration list constraint is set and the parameter 
     * declaration clause has an ellipsis.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenListAndParameterDeclarationClauseHasEllipsis(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            TRUE, 
            $prmDeclList
        );
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createMatchesConstraintDescription(
            $prmDeclList, 
            TRUE, 
            "foo description\n".
            "  bar description"
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        self::assertSame(
            "\n".
            "Parameter declaration clause with a parameter declaration list\n".
            "  foo description\n".
            "    bar description\n".
            "\n".
            "Parameter declaration clause with a parameter declaration list: ".
            "ellipsis present whereas it should be absent.", 
            $sut->additionalFailureDescription($prmDeclClause)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when a 
     * parameter declaration list constraint is set, an ellipsis is present 
     * and the parameter declaration clause has no ellipsis.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenListAndEllipsisAndParameterDeclarationClauseHasNoEllipsis(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            FALSE, 
            $prmDeclList
        );
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createMatchesConstraintDescription(
            $prmDeclList, 
            TRUE, 
            "foo description\n".
            "  bar description"
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        $sut->addEllipsis();
        self::assertSame(
            "\n".
            "Parameter declaration clause with a parameter declaration list and an ellipsis\n".
            "  foo description\n".
            "    bar description\n".
            "\n".
            "Parameter declaration clause with a parameter declaration list and ".
            "an ellipsis: ellipsis absent whereas it should be present.", 
            $sut->additionalFailureDescription($prmDeclClause)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * parameter declaration clause is valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenInstantiatedAndParameterDeclarationClauseIsValid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            FALSE
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        self::assertSame(
            "\n".
            "Parameter declaration clause\n".
            "\n".
            "Parameter declaration clause: Unknown reason.", 
            $sut->additionalFailureDescription($prmDeclClause)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when an 
     * ellipsis is present and the parameter declaration clause is valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenEllipsisAndParameterDeclarationClauseIsValid(): void
    {
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            TRUE
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->addEllipsis();
        self::assertSame(
            "\n".
            "Parameter declaration clause with an ellipsis\n".
            "\n".
            "Parameter declaration clause with an ellipsis: Unknown reason.", 
            $sut->additionalFailureDescription($prmDeclClause)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when a 
     * parameter declaration list constraint is set and the parameter 
     * declaration clause is valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenListAndParameterDeclarationClauseIsValid(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            FALSE, 
            $prmDeclList
        );
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createMatchesConstraintDescription(
            $prmDeclList, 
            TRUE, 
            "foo description\n".
            "  bar description"
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        self::assertSame(
            "\n".
            "Parameter declaration clause with a parameter declaration list\n".
            "  foo description\n".
            "    bar description\n".
            "\n".
            "Parameter declaration clause with a parameter declaration list: Unknown reason.", 
            $sut->additionalFailureDescription($prmDeclClause)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when a 
     * parameter declaration list constraint is set, an ellipsis is present 
     * and the parameter declaration clause is valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenListAndEllipsisAndParameterDeclarationClauseIsValid(): void
    {
        $prmDeclList = $this->prmDeclListFactory->createDummy();
        $prmDeclClause = $this->prmDeclClauseFactory->createHasEllipsisGetParameterDeclarationList(
            TRUE, 
            $prmDeclList
        );
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createMatchesConstraintDescription(
            $prmDeclList, 
            TRUE, 
            "foo description\n".
            "  bar description"
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        $sut->addEllipsis();
        self::assertSame(
            "\n".
            "Parameter declaration clause with a parameter declaration list and an ellipsis\n".
            "  foo description\n".
            "    bar description\n".
            "\n".
            "Parameter declaration clause with a parameter declaration list and ".
            "an ellipsis: Unknown reason.", 
            $sut->additionalFailureDescription($prmDeclClause)
        );
    }
    
    /**
     * Tests that failureDescription() is called when instantiated and the 
     * value is invalid.
     */
    public function testFailureDescriptionWhenInstantiated(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a parameter declaration clause`');
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Tests that failureDescription() is called when an ellipsis is present 
     * and the value is invalid.
     */
    public function testFailureDescriptionWhenEllipsis(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches(
            '` is a parameter declaration clause with an ellipsis`'
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->addEllipsis();
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Tests that failureDescription() is called when a parameter declaration 
     * list constraint is set and the value is invalid.
     */
    public function testFailureDescriptionWhenList(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches(
            '` is a parameter declaration clause with a parameter declaration list`'
        );
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createConstraintDescription(
            'foo description'
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Tests that failureDescription() is called when a parameter declaration 
     * list constraint is set, an ellipsis is present and the value is 
     * invalid.
     */
    public function testFailureDescriptionWhenListAndEllipsis(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches(
            '` is a parameter declaration clause with a parameter declaration list and an ellipsis`'
        );
        
        $prmDeclListConst = $this->prmDeclListConstFactory->createConstraintDescription(
            'foo description'
        );
        
        $sut = new ParameterDeclarationClauseConstraint();
        $sut->setParameterDeclarationListConstraint($prmDeclListConst);
        $sut->addEllipsis();
        $sut->evaluate(NULL, '', FALSE);
    }
}

