<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParameterDeclaration;
use PhpCode\Language\Cpp\Declarator\ParameterDeclarationList;
use PhpCode\Test\ProphecyFactory;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Declarator\ParameterDeclarationList} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationListDoubleFactory
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
     * Creates a double where count() can be called.
     * 
     * @param   int $count    The value to return when count() is called.
     * @return  ProphecySubjectInterface
     */
    public function createCount(int $count): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $prophecy
            ->count()
            ->willReturn($count);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where count() and getParameterDeclarations() can be 
     * called.
     * 
     * @param   int                     $count      The value to return when count() is called.
     * @param   ParameterDeclaration[]  $prmDecls   The value to return when getParameterDeclarations() is called.
     * @return  ProphecySubjectInterface
     */
    public function createCountGetParameterDeclarations(
        int $count, 
        array $prmDecls
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $prophecy
            ->count()
            ->willReturn($count);
        
        $prophecy
            ->getParameterDeclarations()
            ->willReturn($prmDecls);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a prophecy.
     * 
     * @return  ObjectProphecy
     */
    private function prophesize(): ObjectProphecy
    {
        return $this->prophecyFactory->createProphecy(ParameterDeclarationList::class);
    }
}

