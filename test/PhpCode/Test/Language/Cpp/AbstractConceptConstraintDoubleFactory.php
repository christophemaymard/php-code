<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp;

use PhpCode\Test\ProphecyFactory;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the base class for a factory of concept constraint doubles.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractConceptConstraintDoubleFactory
{
    /**
     * The factory of prophecies.
     * @var ProphecyFactory
     */
    private $prophecyFactory;
    
    /**
     * The class name of the constraint to prophesize.
     * @var string
     */
    private $className;
    
    /**
     * Constructor.
     * 
     * @param   TestCase    $testCase   The test case used to create the factory of prophecies.
     */
    public function __construct(TestCase $testCase)
    {
        $this->prophecyFactory = new ProphecyFactory($testCase);
        $this->className = $this->getClassName();
    }
    
    /**
     * Returns the class name of the constraint to prophesize.
     * 
     * @return  string
     */
    abstract protected function getClassName(): string;
    
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
     * Creates a double where constraintDescription() can be called.
     * 
     * @param   string  $return The value to return when constraintDescription() is called.
     * @return  ProphecySubjectInterface
     */
    public function createConstraintDescription(string $return): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $this->buildConstraintDescription($prophecy, $return);
        
        return $prophecy->reveal();
    }
    
    /**
     * Builds and adds a prophecy of constraintDescription() to the 
     * specified prophecy.
     * 
     * @param   ObjectProphecy  $prophecy   The prophecy to build to.
     * @param   string          $return     The value to return when constraintDescription() is called.
     */
    protected function buildConstraintDescription(
        ObjectProphecy $prophecy, 
        string $return
    ): void
    {
        $prophecy
            ->constraintDescription()
            ->willReturn($return);
    }
    
    /**
     * Creates a prophecy.
     * 
     * @return  ObjectProphecy
     */
    protected function prophesize(): ObjectProphecy
    {
        return $this->prophecyFactory->createProphecy($this->className);
    }
}

