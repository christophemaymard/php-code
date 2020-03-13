<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\DeclarationSpecifier;
use PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence;
use PhpCode\Test\ProphecyFactory;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclarationSpecifierSequenceDoubleFactory
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
     * Creates a double where count() and getDeclarationSpecifiers() can be 
     * called.
     * 
     * @param   int                     $count      The value to return when count() is called.
     * @param   DeclarationSpecifier[]  $declSpecs  The value to return when getDeclarationSpecifiers() is called.
     * @return  ProphecySubjectInterface
     */
    public function createCountGetDeclarationSpecifiers(
        int $count, 
        array $declSpecs
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $prophecy
            ->count()
            ->willReturn($count);
        
        $prophecy
            ->getDeclarationSpecifiers()
            ->willReturn($declSpecs);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a prophecy.
     * 
     * @return  ObjectProphecy
     */
    private function prophesize(): ObjectProphecy
    {
        return $this->prophecyFactory->createProphecy(DeclarationSpecifierSequence::class);
    }
}

