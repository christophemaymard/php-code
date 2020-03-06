<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParameterDeclarationClause;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declarator\ParameterDeclarationClause} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationClauseTest extends TestCase
{
    /**
     * The system under test.
     * @var ParameterDeclarationClause
     */
    private $sut;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new ParameterDeclarationClause();
    }
    
    /**
     * Tests that hasEllipsis() returns:
     * - FALSE when instantiated, and 
     * - TRUE when call addEllipsis().
     */
    public function testHasEllipsisReturnsBool(): void
    {
        self::assertFalse($this->sut->hasEllipsis());
        
        $this->sut->addEllipsis();
        self::assertTrue($this->sut->hasEllipsis());
        
        $this->sut->addEllipsis();
        self::assertTrue($this->sut->hasEllipsis());
    }
}

