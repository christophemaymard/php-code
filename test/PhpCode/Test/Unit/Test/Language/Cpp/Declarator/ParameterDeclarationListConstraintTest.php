<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp\Declarator;

use PhpCode\Exception\ArgumentException;
use PhpCode\Language\Cpp\Declarator\ParameterDeclaration;
use PhpCode\Language\Cpp\Declarator\ParameterDeclarationList;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationConstraint;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationListConstraint;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationListConstraint} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationListConstraintTest extends TestCase
{
    /**
     * Tests that __construct() throws an exception when contraints are empty.
     */
    public function test__constructThrowsExceptionWhenConstraintsEmpty(): void
    {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('The parameter declaration constraints are empty.');
        
        $sut = new ParameterDeclarationListConstraint([]);
    }
    
    /**
     * Tests that __construct() throws an exception when one of the 
     * constraints is not an instance of ParameterDeclarationConstraint.
     */
    public function test__constructThrowsExeptionWhenOneOfContraintIsNotInstanceParameterDeclarationConstraint(): void
    {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage(\sprintf(
            'The constraint must be an instance of %s.', 
            ParameterDeclarationConstraint::class
        ));
        
        $consts = [];
        $consts[] = $this->createParameterDeclarationConstraintDummy();
        $consts[] = $this->createParameterDeclarationConstraintDummy();
        $consts[] = NULL;
        
        $sut = new ParameterDeclarationListConstraint($consts);
        
    }
    
    /**
     * Tests that toString() returns a string.
     */
    public function testToStringReturnsString(): void
    {
        $consts = [];
        $consts[] = $this->createParameterDeclarationConstraintDummy();
        
        $sut = new ParameterDeclarationListConstraint($consts);
        self::assertSame('parameter declaration list', $sut->toString());
    }
    
    /**
     * Tests that getConceptName() returns a string.
     */
    public function testGetConceptNameReturnsString(): void
    {
        $consts = [];
        $consts[] = $this->createParameterDeclarationConstraintDummy();
        
        $sut = new ParameterDeclarationListConstraint($consts);
        self::assertSame('Parameter declaration list', $sut->getConceptName());
    }
    
    /**
     * Tests that failureDefaultReason() returns a string.
     */
    public function testFailureDefaultReasonReturnsString(): void
    {
        $consts = [];
        $consts[] = $this->createParameterDeclarationConstraintDummy();
        
        $sut = new ParameterDeclarationListConstraint($consts);
        self::assertSame('Parameter declaration list: Unknown reason.', $sut->failureDefaultReason(NULL));
    }
    
    /**
     * Tests that constraintDescription() returns a string.
     */
    public function testConstraintDescriptionReturnsString(): void
    {
        $consts = [];
        $consts[] = $this->createParameterDeclarationConstraintDoubleConstraintDescription('foo');
        $consts[] = $this->createParameterDeclarationConstraintDoubleConstraintDescription('bar');
        $consts[] = $this->createParameterDeclarationConstraintDoubleConstraintDescription('baz');
        
        $sut = new ParameterDeclarationListConstraint($consts);
        self::assertSame(
            "Parameter declaration list (3)\n  foo\n  bar\n  baz", 
            $sut->constraintDescription()
        );
    }
    
    /**
     * Tests that matches() returns FALSE when not instance of 
     * ParameterDeclarationList.
     */
    public function testMatchesReturnsFalseWhenNotInstanceParameterDeclarationList(): void
    {
        $consts = [];
        $consts[] = $this->createParameterDeclarationConstraintDummy();
        
        $sut = new ParameterDeclarationListConstraint($consts);
        self::assertFalse($sut->matches(NULL));
    }
    
    /**
     * Tests that matches() returns FALSE when the constraint count is not 
     * equal to the parameter declaration count of the list.
     */
    public function testMatchesReturnsFalseWhenConstraintCountNotEqualParameterDeclarationCount(): void
    {
        $prmDeclList = $this->createParameterDeclarationListDoubleCount(0);
        
        $consts = [];
        $consts[] = $this->createParameterDeclarationConstraintDummy();
        $consts[] = $this->createParameterDeclarationConstraintDummy();
        $consts[] = $this->createParameterDeclarationConstraintDummy();
        
        $sut = new ParameterDeclarationListConstraint($consts);
        self::assertFalse($sut->matches($prmDeclList));
    }
    
    /**
     * Tests that matches() returns FALSE when a parameter declaration is not 
     * valid.
     */
    public function testMatchesReturnsFalseWhenParameterDeclarationIsNotValid(): void
    {
        $prmDecls = [];
        $prmDecls[] = $this->createParameterDeclarationDummy();
        $prmDecls[] = $this->createParameterDeclarationDummy();
        $prmDecls[] = $this->createParameterDeclarationDummy();
        $prmDeclList = $this->createParameterDeclarationListDoubleCountGetParameterDeclarations(
            3, 
            $prmDecls
        );
        
        $consts = [];
        $consts[] = $this->createParameterDeclarationConstraintDoubleMatches($prmDecls[0], TRUE);
        $consts[] = $this->createParameterDeclarationConstraintDoubleMatches($prmDecls[1], TRUE);
        $consts[] = $this->createParameterDeclarationConstraintDoubleMatches($prmDecls[2], FALSE);
        
        $sut = new ParameterDeclarationListConstraint($consts);
        self::assertFalse($sut->matches($prmDeclList));
    }
    
    /**
     * Tests that matches() returns TRUE when the parameter declaration list 
     * is valid.
     */
    public function testMatchesReturnsTrueWhenParameterDeclarationListIsValid(): void
    {
        $prmDecls = [];
        $prmDecls[] = $this->createParameterDeclarationDummy();
        $prmDecls[] = $this->createParameterDeclarationDummy();
        $prmDecls[] = $this->createParameterDeclarationDummy();
        $prmDeclList = $this->createParameterDeclarationListDoubleCountGetParameterDeclarations(
            3, 
            $prmDecls
        );
        
        $consts = [];
        $consts[] = $this->createParameterDeclarationConstraintDoubleMatches($prmDecls[0], TRUE);
        $consts[] = $this->createParameterDeclarationConstraintDoubleMatches($prmDecls[1], TRUE);
        $consts[] = $this->createParameterDeclarationConstraintDoubleMatches($prmDecls[2], TRUE);
        
        $sut = new ParameterDeclarationListConstraint($consts);
        self::assertTrue($sut->matches($prmDeclList));
    }
    
    /**
     * Tests that failureReason() returns a string when not instance of 
     * ParameterDeclarationList.
     */
    public function testFailureReasonReturnsStringWhenNotInstanceParameterDeclarationList(): void
    {
        $consts = [];
        $consts[] = $this->createParameterDeclarationConstraintDummy();
        
        $sut = new ParameterDeclarationListConstraint($consts);
        self::assertRegExp(
            \sprintf(
                '`^Parameter declaration list: .+ is not an instance of %s\\.$`', 
                \str_replace('\\', '\\\\', ParameterDeclarationList::class)
            ), 
            $sut->failureReason(NULL)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the constraint count 
     * is not equal to the parameter declaration count of the list.
     */
    public function testFailureReasonReturnsStringWhenConstraintCountNotEqualParameterDeclarationCount(): void
    {
        $prmDeclList = $this->createParameterDeclarationListDoubleCount(0);
        
        $consts = [];
        $consts[] = $this->createParameterDeclarationConstraintDummy();
        $consts[] = $this->createParameterDeclarationConstraintDummy();
        $consts[] = $this->createParameterDeclarationConstraintDummy();
        
        $sut = new ParameterDeclarationListConstraint($consts);
        self::assertSame(
            'Parameter declaration list: '.
            'parameter declaration list should have 3 parameter declaration(s), got 0.', 
            $sut->failureReason($prmDeclList)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when a parameter 
     * declaration is not valid.
     */
    public function testFailureReasonReturnsStringWhenParameterDeclarationIsNotValid(): void
    {
        $prmDecls = [];
        $prmDecls[] = $this->createParameterDeclarationDummy();
        $prmDecls[] = $this->createParameterDeclarationDummy();
        $prmDecls[] = $this->createParameterDeclarationDummy();
        $prmDeclList = $this->createParameterDeclarationListDoubleCountGetParameterDeclarations(
            3, 
            $prmDecls
        );
        
        $consts = [];
        $consts[] = $this->createParameterDeclarationConstraintDoubleMatches($prmDecls[0], TRUE);
        $consts[] = $this->createParameterDeclarationConstraintDoubleMatches($prmDecls[1], TRUE);
        $consts[] = $this->createParameterDeclarationConstraintDoubleMatchesFailureReason(
            $prmDecls[2], 
            FALSE, 
            "foo parameter\n".
            "  bar declaration sepcifier sequence\n".
            "    baz declaration sepcifier reason"
        );
        
        $sut = new ParameterDeclarationListConstraint($consts);
        self::assertSame(
            "Parameter declaration list\n".
            "  foo parameter\n".
            "    bar declaration sepcifier sequence\n".
            "      baz declaration sepcifier reason", 
            $sut->failureReason($prmDeclList)
        );
    }
    
    /**
     * Tests that failureReason() returns a string when the parameter 
     * declaration list is valid.
     */
    public function testFailureReasonReturnsStringWhenParameterDeclarationListIsValid(): void
    {
        $prmDecls = [];
        $prmDecls[] = $this->createParameterDeclarationDummy();
        $prmDecls[] = $this->createParameterDeclarationDummy();
        $prmDecls[] = $this->createParameterDeclarationDummy();
        $prmDeclList = $this->createParameterDeclarationListDoubleCountGetParameterDeclarations(
            3, 
            $prmDecls
        );
        
        $consts = [];
        $consts[] = $this->createParameterDeclarationConstraintDoubleMatches($prmDecls[0], TRUE);
        $consts[] = $this->createParameterDeclarationConstraintDoubleMatches($prmDecls[1], TRUE);
        $consts[] = $this->createParameterDeclarationConstraintDoubleMatches($prmDecls[2], TRUE);
        
        $sut = new ParameterDeclarationListConstraint($consts);
        self::assertSame(
            'Parameter declaration list: Unknown reason.', 
            $sut->failureReason($prmDeclList)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when not 
     * instance of ParameterDeclarationList.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenNotInstanceParameterDeclarationList(): void
    {
        $consts = [];
        $consts[] = $this->createParameterDeclarationConstraintDoubleConstraintDescription("foo\n  foo sub");
        $consts[] = $this->createParameterDeclarationConstraintDoubleConstraintDescription("bar\n  bar sub");
        $consts[] = $this->createParameterDeclarationConstraintDoubleConstraintDescription("baz\n  baz sub");
        
        $sut = new ParameterDeclarationListConstraint($consts);
        self::assertRegExp(
            \sprintf(
                "`^\n".
                "Parameter declaration list \\(3\\)\n".
                "  foo\n".
                "    foo sub\n".
                "  bar\n".
                "    bar sub\n".
                "  baz\n".
                "    baz sub\n".
                "\n".
                "Parameter declaration list: null is not an instance of %s\\.$`", 
                \str_replace('\\', '\\\\', ParameterDeclarationList::class)
            ), 
            $sut->additionalFailureDescription(NULL)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * constraint count is not equal to the parameter declaration count of 
     * the list.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenConstraintCountNotEqualParameterDeclarationCount(): void
    {
        $prmDeclList = $this->createParameterDeclarationListDoubleCount(0);
        
        $consts = [];
        $consts[] = $this->createParameterDeclarationConstraintDoubleConstraintDescription("foo\n  foo sub");
        
        $sut = new ParameterDeclarationListConstraint($consts);
        self::assertSame(
            "\n".
            "Parameter declaration list (1)\n".
            "  foo\n". 
            "    foo sub\n".
            "\n".
            "Parameter declaration list: ".
            "parameter declaration list should have 1 parameter declaration(s), got 0.", 
            $sut->additionalFailureDescription($prmDeclList)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when a 
     * parameter declaration is not valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenParameterDeclarationIsNotValid(): void
    {
        $prmDecls = [];
        $prmDecls[] = $this->createParameterDeclarationDummy();
        $prmDeclList = $this->createParameterDeclarationListDoubleCountGetParameterDeclarations(
            1, 
            $prmDecls
        );
        
        $consts = [];
        $consts[] = $this->createParameterDeclarationConstraintDoubleMatchesFailureReasonConstraintDescription(
            $prmDecls[0], 
            FALSE, 
            "foo reason", 
            'foo description'
        );
        
        $sut = new ParameterDeclarationListConstraint($consts);
        self::assertSame(
            "\n".
            "Parameter declaration list (1)\n".
            "  foo description\n".
            "\n".
            "Parameter declaration list\n".
            "  foo reason", 
            $sut->additionalFailureDescription($prmDeclList)
        );
    }
    
    /**
     * Tests that additionalFailureDescription() returns a string when the 
     * parameter declaration list is valid.
     */
    public function testAdditionalFailureDescriptionReturnsStringWhenParameterDeclarationListIsValid(): void
    {
        $prmDecls = [];
        $prmDecls[] = $this->createParameterDeclarationDummy();
        $prmDeclList = $this->createParameterDeclarationListDoubleCountGetParameterDeclarations(
            1, 
            $prmDecls
        );
        
        $consts = [];
        $consts[] = $this->createParameterDeclarationConstraintDoubleMatchesConstraintDescription(
            $prmDecls[0], 
            TRUE, 
            'foo description'
        );
        
        $sut = new ParameterDeclarationListConstraint($consts);
        self::assertSame(
            "\n".
            "Parameter declaration list (1)\n".
            "  foo description\n".
            "\n".
            "Parameter declaration list: Unknown reason.",
            $sut->additionalFailureDescription($prmDeclList)
        );
    }
    
    /**
     * Tests that failureDescription() is called when a value is invalid.
     */
    public function testFailureDescriptionWhenInvalid(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessageMatches('` is a parameter declaration list`');
        
        $consts = [];
        $consts[] = $this->createParameterDeclarationConstraintDoubleConstraintDescription(
            'foo description'
        );
        
        $sut = new ParameterDeclarationListConstraint($consts);
        $sut->evaluate(NULL, '', FALSE);
    }
    
    /**
     * Creates a dummy for the {@see PhpCode\Language\Cpp\Declarator\ParameterDeclaration} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    private function createParameterDeclarationDummy(): ProphecySubjectInterface
    {
        return $this->prophesize(ParameterDeclaration::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationConstraint} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    private function createParameterDeclarationConstraintDummy(): ProphecySubjectInterface
    {
        return $this->prophesize(ParameterDeclarationConstraint::class)->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationConstraint} 
     * class where constraintDescription() can be called.
     * 
     * @param   string  $return The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    private function createParameterDeclarationConstraintDoubleConstraintDescription(
        string $return
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize(ParameterDeclarationConstraint::class);
        $prophecy
            ->constraintDescription()
            ->willReturn($return);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationConstraint} 
     * class where matches() can be called.
     * 
     * @param   ParameterDeclaration    $prmDecl    The first argument when matches() is called.
     * @param   bool                    $return     The value to return when matches() is called.
     * @return  ProphecySubjectInterface
     */
    private function createParameterDeclarationConstraintDoubleMatches(
        ParameterDeclaration $prmDecl, 
        bool $return
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize(ParameterDeclarationConstraint::class);
        $prophecy
            ->matches($prmDecl)
            ->willReturn($return);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationConstraint} 
     * class where matches() and failureReason() can be called.
     * 
     * @param   ParameterDeclaration    $prmDecl                The first argument when matches() or failureReason() is called.
     * @param   bool                    $returnMatches          The value to return when matches() is called.
     * @param   string                  $returnFailureReason    The value to return when failureReason() is called.
     * @return  ProphecySubjectInterface
     */
    private function createParameterDeclarationConstraintDoubleMatchesFailureReason(
        ParameterDeclaration $prmDecl, 
        bool $returnMatches, 
        string $returnFailureReason
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize(ParameterDeclarationConstraint::class);
        $prophecy
            ->matches($prmDecl)
            ->willReturn($returnMatches);
        
        $prophecy
            ->failureReason($prmDecl)
            ->willReturn($returnFailureReason);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationConstraint} 
     * class where matches(), failureReason() and constraintDescription() can 
     * be called.
     * 
     * @param   ParameterDeclaration    $prmDecl                The first argument when matches() or failureReason() is called.
     * @param   bool                    $returnMatches          The value to return when matches() is called.
     * @param   string                  $returnFailureReason    The value to return when failureReason() is called.
     * @param   string                  $returnConstDesc        The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    private function createParameterDeclarationConstraintDoubleMatchesFailureReasonConstraintDescription(
        ParameterDeclaration $prmDecl, 
        bool $returnMatches, 
        string $returnFailureReason, 
        string $returnConstDesc
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize(ParameterDeclarationConstraint::class);
        $prophecy
            ->matches($prmDecl)
            ->willReturn($returnMatches);
        
        $prophecy
            ->failureReason($prmDecl)
            ->willReturn($returnFailureReason);
        
        $prophecy
            ->constraintDescription()
            ->willReturn($returnConstDesc);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationConstraint} 
     * class where matches() and constraintDescription() can be called.
     * 
     * @param   ParameterDeclaration    $prmDecl                The first argument when matches() is called.
     * @param   bool                    $returnMatches          The value to return when matches() is called.
     * @param   string                  $returnConstDesc        The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    private function createParameterDeclarationConstraintDoubleMatchesConstraintDescription(
        ParameterDeclaration $prmDecl, 
        bool $returnMatches, 
        string $returnConstDesc
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize(ParameterDeclarationConstraint::class);
        $prophecy
            ->matches($prmDecl)
            ->willReturn($returnMatches);
        
        $prophecy
            ->constraintDescription()
            ->willReturn($returnConstDesc);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Language\Cpp\Declarator\ParameterDeclarationList} 
     * class where count() can be called.
     * 
     * @param   int $return The value to return when count() is called.
     * @return  ProphecySubjectInterface
     */
    private function createParameterDeclarationListDoubleCount(
        int $return
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize(ParameterDeclarationList::class);
        $prophecy
            ->count()
            ->willReturn($return);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double of the {@see PhpCode\Language\Cpp\Declarator\ParameterDeclarationList} 
     * class where count() and getParameterDeclarations() can be called.
     * 
     * @param   int                     $returnCount    The value to return when count() is called.
     * @param   ParameterDeclaration[]  $returnPrmDecls The value to return when getParameterDeclarations() is called.
     * @return  ProphecySubjectInterface
     */
    private function createParameterDeclarationListDoubleCountGetParameterDeclarations(
        int $returnCount, 
        array $returnPrmDecls
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize(ParameterDeclarationList::class);
        $prophecy
            ->count()
            ->willReturn($returnCount);
        
        $prophecy
            ->getParameterDeclarations()
            ->willReturn($returnPrmDecls);
        
        return $prophecy->reveal();
    }
}

