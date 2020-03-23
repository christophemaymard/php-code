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
abstract class AbstractDoubleBuilder extends AbstractDoubleCreator
{
    /**
     * The prophecy of the subject class or interface that is being built.
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
        $this->initCreator($testCase);
        $this->prophecy = $this->prophesizeSubject();
    }
    
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
     * Returns the prophecy of the subject class or interface that is being 
     * built.
     * 
     * @return  ObjectProphecy
     */
    protected function getSubjectProphecy(): ObjectProphecy
    {
        return $this->prophecy;
    }
}

