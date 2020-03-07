<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\ParameterDeclarationClause;
use PhpCode\Language\Cpp\Declarator\ParameterDeclarationList;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ProphecySubjectInterface;

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
    
    /**
     * Tests that getParameterDeclarationList() returns:
     * - NULL when instantiated, and 
     * - the instance of ParameterDeclarationList that has been set with 
     *   setParameterDeclarationList().
     */
    public function testGetParameterDeclarationList(): void
    {
        self::assertNull($this->sut->getParameterDeclarationList());
        
        $prmDeclList1 = $this->createParameterDeclarationListDummy();
        $this->sut->setParameterDeclarationList($prmDeclList1);
        self::assertSame($prmDeclList1, $this->sut->getParameterDeclarationList());
        
        $prmDeclList2 = $this->createParameterDeclarationListDummy();
        $this->sut->setParameterDeclarationList($prmDeclList2);
        self::assertSame($prmDeclList2, $this->sut->getParameterDeclarationList());
    }
    
    /**
     * Tests that hasParameterDeclarationList() returns:
     * - FALSE when instantiated, and 
     * - TRUE when an instance of ParameterDeclarationList has been set with 
     *   setParameterDeclarationList().
     */
    public function testHasParameterDeclarationListReturnsBool(): void
    {
        self::assertFalse($this->sut->hasParameterDeclarationList());
        
        $prmDeclList1 = $this->createParameterDeclarationListDummy();
        $this->sut->setParameterDeclarationList($prmDeclList1);
        self::assertTrue($this->sut->hasParameterDeclarationList());
        
        $prmDeclList2 = $this->createParameterDeclarationListDummy();
        $this->sut->setParameterDeclarationList($prmDeclList2);
        self::assertTrue($this->sut->hasParameterDeclarationList());
    }
    
    /**
     * Creates a dummy of the {@see PhpCode\Language\Cpp\Declarator\ParameterDeclarationList} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    private function createParameterDeclarationListDummy(): ProphecySubjectInterface
    {
        return $this->prophesize(ParameterDeclarationList::class)->reveal();
    }
}

