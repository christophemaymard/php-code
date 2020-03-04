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
 * Represents a factory of prophecies.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ProphecyFactory extends TestCase
{
    /**
     * The test case used to create the prophecies.
     * @var TestCase
     */
    private $testCase;
    
    /**
     * Constructor.
     * 
     * @param   TestCase    $testCase   The test case used to create the prophecies.
     */
    public function __construct(TestCase $testCase)
    {
        $this->testCase = $testCase;
    }
    
    /**
     * Creates a prophecy for the specified interface or class name.
     * 
     * @param   string  $interfaceOrClassName   The interface or class name to create a prophecy for.
     * @return  ObjectProphecy  The created instance of ObjectProphecy.
     */
    public function createProphecy(string $interfaceOrClassName): ObjectProphecy
    {
        return $this->testCase->prophesize($interfaceOrClassName);
    }
}

