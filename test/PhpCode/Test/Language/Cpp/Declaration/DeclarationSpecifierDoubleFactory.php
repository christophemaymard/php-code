<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\DeclarationSpecifier;
use PhpCode\Language\Cpp\Declaration\DefiningTypeSpecifier;
use PhpCode\Test\ProphecyFactory;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Declaration\DeclarationSpecifier} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclarationSpecifierDoubleFactory
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
     * Creates a double where getDefiningTypeSpecifier() can be called.
     * 
     * @param   DefiningTypeSpecifier   $defTypeSpec    The value to return when getDefiningTypeSpecifier() is called.
     * @return  ProphecySubjectInterface
     */
    public function createGetDefiningTypeSpecifier(
        DefiningTypeSpecifier $defTypeSpec
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $prophecy
            ->getDefiningTypeSpecifier()
            ->willReturn($defTypeSpec);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a prophecy.
     * 
     * @return  ObjectProphecy
     */
    private function prophesize(): ObjectProphecy
    {
        return $this->prophecyFactory->createProphecy(DeclarationSpecifier::class);
    }
}

