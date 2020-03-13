<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence;
use PhpCode\Language\Cpp\Declarator\ParameterDeclaration;
use PhpCode\Test\ProphecyFactory;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Declarator\ParameterDeclaration} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationDoubleFactory
{
    /**
     * The factory of prophecies.
     * @var ProphecyFactory
     */
    private $prophecyFactory;
    
    /**
     * Constructor.
     * 
     * @param   TestCase    $testCase   The test case used to create the factory of prophecies.
     */
    public function __construct(TestCase $testCase)
    {
        $this->prophecyFactory = new ProphecyFactory($testCase);
    }
    
    /**
     * Creates a dummy.
     * 
     * @return  ProphecySubjectInterface
     */
    public function createDummy(): ProphecySubjectInterface
    {
        return $this->prophesize()->reveal();
    }
    
    /**
     * Creates a double where getDeclarationSpecifierSequence() can be called.
     * 
     * @param   DeclarationSpecifierSequence    $declSpecSeq    The value to return when getDeclarationSpecifierSequence() is called.
     * @return  ProphecySubjectInterface
     */
    public function createGetDeclarationSpecifierSequence(
        DeclarationSpecifierSequence $declSpecSeq
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $prophecy
            ->getDeclarationSpecifierSequence()
            ->willReturn($declSpecSeq);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a prophecy.
     * 
     * @return  ObjectProphecy
     */
    private function prophesize(): ObjectProphecy
    {
        return $this->prophecyFactory->createProphecy(ParameterDeclaration::class);
    }
}

