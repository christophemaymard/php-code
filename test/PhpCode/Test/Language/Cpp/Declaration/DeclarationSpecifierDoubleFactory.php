<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\DeclarationSpecifier;
use PhpCode\Language\Cpp\Declaration\SimpleTypeSpecifier;
use PhpCode\Test\AbstractDoubleFactory;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Declaration\DeclarationSpecifier} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclarationSpecifierDoubleFactory extends AbstractDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return DeclarationSpecifier::class;
    }
    
    /**
     * Creates a double where: 
     * ->getDefiningTypeSpecifier()
     *     ->getTypeSpecifier()
     *         ->getSimpleTypeSpecifier()
     * can be called.
     * 
     * The simple type specifier is defined as none.
     * 
     * @return  ProphecySubjectInterface
     */
    public function createNoneSimpleTypeSpecifier(): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        
        $stSpec = ConceptDoubleBuilder::createSimpleTypeSpecifier($this->getTestCase())
            ->buildIsInt(FALSE)
            ->getDouble();
        
        $this->buildSimpleTypeSpecifierGetDefiningTypeSpecifier($prophecy, $stSpec);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where: 
     * -> getDefiningTypeSpecifier()
     *     ->getTypeSpecifier()
     *         ->getSimpleTypeSpecifier()
     * can be called.
     * 
     * The simple type specifier is defined as "int".
     * 
     * @return  ProphecySubjectInterface
     */
    public function createIntSimpleTypeSpecifier(): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        
        $stSpec = ConceptDoubleBuilder::createSimpleTypeSpecifier($this->getTestCase())
            ->buildIsInt(TRUE)
            ->getDouble();
        
        $this->buildSimpleTypeSpecifierGetDefiningTypeSpecifier($prophecy, $stSpec);
        
        return $prophecy->reveal();
    }
    
    /**
     * Builds and adds a prophecy of getDefiningTypeSpecifier() to the 
     * specified prophecy.
     * 
     * @param   ObjectProphecy      $prophecy   The prophecy to build to.
     * @param   SimpleTypeSpecifier $stSpec     The value to return when getSimpleTypeSpecifier() is called.
     */
    private function buildSimpleTypeSpecifierGetDefiningTypeSpecifier(
        ObjectProphecy $prophecy, 
        SimpleTypeSpecifier $stSpec
    ): void
    {
        $testCase = $this->getTestCase();
        
        $typeSpec = ConceptDoubleBuilder::createTypeSpecifier($testCase)
            ->buildGetSimpleTypeSpecifier($stSpec)
            ->getDouble();
        
        $defTypeSpec = ConceptDoubleBuilder::createDefiningTypeSpecifier($testCase)
            ->buildGetTypeSpecifier($typeSpec)
            ->getDouble();
        
        $prophecy
            ->getDefiningTypeSpecifier()
            ->willReturn($defTypeSpec);
    }
}

