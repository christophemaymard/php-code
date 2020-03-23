<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the base class for a factory of doubles.
 * 
 * It creates doubles for only one class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractDoubleFactory extends AbstractDoubleCreator
{
    /**
     * Constructor.
     * 
     * @param   TestCase    $testCase   The test case used to create the factory of prophecies.
     */
    public function __construct(TestCase $testCase)
    {
        $this->initCreator($testCase);
    }
    
    /**
     * Creates a dummy.
     * 
     * @return  ProphecySubjectInterface
     */
    public function createDummy(): ProphecySubjectInterface
    {
        return $this->prophesizeSubject()->reveal();
    }
}

