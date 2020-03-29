<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParametersAndQualifiers;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\ParameterDeclarationClauseDoubleFactory;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declarator\ParametersAndQualifiers} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParametersAndQualifiersTest extends TestCase
{
    /**
     * Tests that __construct() stores the instance of the parameter 
     * declaration clause.
     */
    public function test__constructStoresParameterDeclarationClause(): void
    {
        $prmDeclClause = $this->createParameterDeclarationClauseDoubleFactory()
            ->createDummy();
        
        $sut = new ParametersAndQualifiers($prmDeclClause);
        self::assertSame($prmDeclClause, $sut->getParameterDeclarationClause());
    }
    
    /**
     * Tests that getCVQualifierSequence() returns:
     * - NULL when instantiated, 
     * - the instance of constant/volatile qualifier sequence that has been 
     * set with setCVQualifierSequence().
     */
    public function testGetCVQualifierSequence(): void
    {
        $prmDeclClause = $this->createParameterDeclarationClauseDoubleFactory()
            ->createDummy();
        
        $sut = new ParametersAndQualifiers($prmDeclClause);
        
        self::assertNull($sut->getCVQualifierSequence());
        
        $cvSeq1 = ConceptDoubleBuilder::createCVQualifierSequence($this)->getDouble();
        $sut->setCVQualifierSequence($cvSeq1);
        self::assertSame($cvSeq1, $sut->getCVQualifierSequence());
        
        $cvSeq2 = ConceptDoubleBuilder::createCVQualifierSequence($this)->getDouble();
        $sut->setCVQualifierSequence($cvSeq2);
        self::assertSame($cvSeq2, $sut->getCVQualifierSequence());
    }
    
    /**
     * Tests that hasCVQualifierSequence() returns:
     * - FALSE when instantiated, 
     * - TRUE when an instance of constant/volatile qualifier sequence has 
     * been set with setCVQualifierSequence().
     */
    public function testHasCVQualifierSequenceReturnsBool(): void
    {
        $prmDeclClause = $this->createParameterDeclarationClauseDoubleFactory()
            ->createDummy();
        
        $sut = new ParametersAndQualifiers($prmDeclClause);
        
        self::assertFalse($sut->hasCVQualifierSequence());
        
        $cvSeq1 = ConceptDoubleBuilder::createCVQualifierSequence($this)->getDouble();
        $sut->setCVQualifierSequence($cvSeq1);
        self::assertTrue($sut->hasCVQualifierSequence());
        
        $cvSeq2 = ConceptDoubleBuilder::createCVQualifierSequence($this)->getDouble();
        $sut->setCVQualifierSequence($cvSeq2);
        self::assertTrue($sut->hasCVQualifierSequence());
    }
    
    /**
     * Creates a factory of parameter declaration clause doubles.
     * 
     * @return  ParameterDeclarationClauseDoubleFactory
     */
    private function createParameterDeclarationClauseDoubleFactory(): ParameterDeclarationClauseDoubleFactory
    {
        return new ParameterDeclarationClauseDoubleFactory($this);
    }
}

