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
 * Represents the base class for a builder of double.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractDoubleBuilder
{
    /**
     * The factory of prophecies.
     * @var ProphecyFactory
     */
    private $prophecyFactory;
    
    /**
     * The prophecy of the class or interface that is being built.
     * @var ObjectProphecy
     */
    private $prophecy;
    
    /**
     * Constructor.
     * 
     * @param   TestCase    $testCase   The test case used to create the factory of prophecies.
     */
    public function __construct(TestCase $testCase)
    {
        $this->prophecyFactory = new ProphecyFactory($testCase);
        $this->prophecy = $this->prophesize($this->getClassInterfaceName());
    }
    
    /**
     * Returns the name of the class or interface to prophesize.
     * 
     * @return  string
     */
    abstract protected function getClassInterfaceName(): string;
    
    /**
     * Returns the double.
     * 
     * @return  ProphecySubjectInterface
     */
    public function getDouble(): ProphecySubjectInterface
    {
        return $this->prophecy->reveal();
    }
    
    /**
     * Returns the prophecy of the class or interface that is being built.
     * 
     * @return  ObjectProphecy
     */
    protected function getProphecy(): ObjectProphecy
    {
        return $this->prophecy;
    }
    
    /**
     * Creates a prophecy of the specified class or interface.
     * 
     * @param   string  $classOrInterface   The name of the class or interface to prophesize.
     * @return  ObjectProphecy
     */
    protected function prophesize(string $classOrInterface): ObjectProphecy
    {
        return $this->prophecyFactory->createProphecy($classOrInterface);
    }
}

