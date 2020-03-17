<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Test\Language\Cpp;

use PhpCode\Test\Language\Cpp\CallableConceptConstraintFactory;
use PhpCode\Test\Language\Cpp\ConceptConstraintDoubleBuilder;
use PhpCode\Test\Language\Cpp\ConceptConstraintFactoryInterface;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Test\Language\Cpp\CallableConceptConstraintFactory} 
 * class.
 * 
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class CallableConceptConstraintFactoryTest extends TestCase
{
    /**
     * Tests that createConstraint() invokes the callable.
     */
    public function testCreateConstraintInvokesCallableWhenInstanceMethodCallable(): void
    {
        $constraint = ConceptConstraintDoubleBuilder::createPtrDeclaratorConstraint($this)
            ->getDouble();
        
        $instanceProphecy = $this->prophesize(ConceptConstraintFactoryInterface::class);
        $instanceProphecy->createConstraint()
            ->willReturn($constraint)
            ->shouldBeCalledTimes(1);
        $instance = $instanceProphecy->reveal();
        
        $callable = [$instance, 'createConstraint'];
        
        $sut = new CallableConceptConstraintFactory($callable);
        self::assertSame($constraint, $sut->createConstraint());
    }
}

