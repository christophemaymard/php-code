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

/**
 * Represents the base class for a creator of doubles.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractDoubleCreator
{
    /**
     * The test case used by the creator.
     * @var TestCase
     */
    private $testCase;
    
    /**
     * The factory of prophecies.
     * @var ProphecyFactory
     */
    private $prophecyFactory;
    
    /**
     * Initializes the creator with the specified test case, creating a 
     * factory of factories.
     * 
     * @param   TestCase    $testCase   The test case used to initialize the creator.
     */
    protected function initCreator(TestCase $testCase): void
    {
        $this->testCase = $testCase;
        $this->prophecyFactory = new ProphecyFactory($testCase);
    }
    
    /**
     * Creates a prophecy of the class or interface subject.
     * 
     * @return  ObjectProphecy
     */
    protected function prophesizeSubject(): ObjectProphecy
    {
        return $this->prophesize($this->getSubjectName());
    }
    
    /**
     * Returns the name of the class or interface subject to prophesize.
     * 
     * @return  string
     */
    abstract protected function getSubjectName(): string;
    
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
    
    /**
     * Returns the test case used by the creator.
     * 
     * @return  TestCase
     */
    protected function getTestCase(): TestCase
    {
        return $this->testCase;
    }
}

