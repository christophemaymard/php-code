<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the base class for a factory of doubles.
 * 
 * It creates doubles for only one class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractDoubleFactory
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
     * Returns the name of the class to prophesize.
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
     * Creates a prophecy.
     * 
     * @return  ObjectProphecy
     */
    protected function prophesize(): ObjectProphecy
    {
        return $this->prophecyFactory->createProphecy($this->className);
    }
}

