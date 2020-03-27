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
use PhpCode\Language\Cpp\Expression\NestedNameSpecifier;
use PhpCode\Language\Cpp\Lexical\Identifier;
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
            ->buildIsFloat(FALSE)
            ->buildIsBool(FALSE)
            ->buildIsChar(FALSE)
            ->buildIsWCharT(FALSE)
            ->buildIsShort(FALSE)
            ->buildIsLong(FALSE)
            ->buildIsSigned(FALSE)
            ->buildIsUnsigned(FALSE)
            ->buildIsDouble(FALSE)
            ->buildIsIdentifier(FALSE)
            ->buildGetIdentifier()
            ->buildIsQualifiedIdentifier(FALSE)
            ->buildGetNestedNameSpecifier()
            ->getDouble();
        
        $this->buildSimpleTypeSpecifierGetDefiningTypeSpecifier($prophecy, $stSpec);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where: 
     * ->getDefiningTypeSpecifier()
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
            ->buildIsFloat(FALSE)
            ->buildIsBool(FALSE)
            ->buildIsChar(FALSE)
            ->buildIsWCharT(FALSE)
            ->buildIsShort(FALSE)
            ->buildIsLong(FALSE)
            ->buildIsSigned(FALSE)
            ->buildIsUnsigned(FALSE)
            ->buildIsDouble(FALSE)
            ->buildIsIdentifier(FALSE)
            ->buildGetIdentifier()
            ->buildIsQualifiedIdentifier(FALSE)
            ->buildGetNestedNameSpecifier()
            ->getDouble();
        
        $this->buildSimpleTypeSpecifierGetDefiningTypeSpecifier($prophecy, $stSpec);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where: 
     * ->getDefiningTypeSpecifier()
     *     ->getTypeSpecifier()
     *         ->getSimpleTypeSpecifier()
     * can be called.
     * 
     * The simple type specifier is defined as "float".
     * 
     * @return  ProphecySubjectInterface
     */
    public function createFloatSimpleTypeSpecifier(): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        
        $stSpec = ConceptDoubleBuilder::createSimpleTypeSpecifier($this->getTestCase())
            ->buildIsInt(FALSE)
            ->buildIsFloat(TRUE)
            ->buildIsBool(FALSE)
            ->buildIsChar(FALSE)
            ->buildIsWCharT(FALSE)
            ->buildIsShort(FALSE)
            ->buildIsLong(FALSE)
            ->buildIsSigned(FALSE)
            ->buildIsUnsigned(FALSE)
            ->buildIsDouble(FALSE)
            ->buildIsIdentifier(FALSE)
            ->buildGetIdentifier()
            ->buildIsQualifiedIdentifier(FALSE)
            ->buildGetNestedNameSpecifier()
            ->getDouble();
        
        $this->buildSimpleTypeSpecifierGetDefiningTypeSpecifier($prophecy, $stSpec);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where: 
     * ->getDefiningTypeSpecifier()
     *     ->getTypeSpecifier()
     *         ->getSimpleTypeSpecifier()
     * can be called.
     * 
     * The simple type specifier is defined as "bool".
     * 
     * @return  ProphecySubjectInterface
     */
    public function createBoolSimpleTypeSpecifier(): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        
        $stSpec = ConceptDoubleBuilder::createSimpleTypeSpecifier($this->getTestCase())
            ->buildIsInt(FALSE)
            ->buildIsFloat(FALSE)
            ->buildIsBool(TRUE)
            ->buildIsChar(FALSE)
            ->buildIsWCharT(FALSE)
            ->buildIsShort(FALSE)
            ->buildIsLong(FALSE)
            ->buildIsSigned(FALSE)
            ->buildIsUnsigned(FALSE)
            ->buildIsDouble(FALSE)
            ->buildIsIdentifier(FALSE)
            ->buildGetIdentifier()
            ->buildIsQualifiedIdentifier(FALSE)
            ->buildGetNestedNameSpecifier()
            ->getDouble();
        
        $this->buildSimpleTypeSpecifierGetDefiningTypeSpecifier($prophecy, $stSpec);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where: 
     * ->getDefiningTypeSpecifier()
     *     ->getTypeSpecifier()
     *         ->getSimpleTypeSpecifier()
     * can be called.
     * 
     * The simple type specifier is defined as "char".
     * 
     * @return  ProphecySubjectInterface
     */
    public function createCharSimpleTypeSpecifier(): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        
        $stSpec = ConceptDoubleBuilder::createSimpleTypeSpecifier($this->getTestCase())
            ->buildIsInt(FALSE)
            ->buildIsFloat(FALSE)
            ->buildIsBool(FALSE)
            ->buildIsChar(TRUE)
            ->buildIsWCharT(FALSE)
            ->buildIsShort(FALSE)
            ->buildIsLong(FALSE)
            ->buildIsSigned(FALSE)
            ->buildIsUnsigned(FALSE)
            ->buildIsDouble(FALSE)
            ->buildIsIdentifier(FALSE)
            ->buildGetIdentifier()
            ->buildIsQualifiedIdentifier(FALSE)
            ->buildGetNestedNameSpecifier()
            ->getDouble();
        
        $this->buildSimpleTypeSpecifierGetDefiningTypeSpecifier($prophecy, $stSpec);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where: 
     * ->getDefiningTypeSpecifier()
     *     ->getTypeSpecifier()
     *         ->getSimpleTypeSpecifier()
     * can be called.
     * 
     * The simple type specifier is defined as "wchar_t".
     * 
     * @return  ProphecySubjectInterface
     */
    public function createWCharTSimpleTypeSpecifier(): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        
        $stSpec = ConceptDoubleBuilder::createSimpleTypeSpecifier($this->getTestCase())
            ->buildIsInt(FALSE)
            ->buildIsFloat(FALSE)
            ->buildIsBool(FALSE)
            ->buildIsChar(FALSE)
            ->buildIsWCharT(TRUE)
            ->buildIsShort(FALSE)
            ->buildIsLong(FALSE)
            ->buildIsSigned(FALSE)
            ->buildIsUnsigned(FALSE)
            ->buildIsDouble(FALSE)
            ->buildIsIdentifier(FALSE)
            ->buildGetIdentifier()
            ->buildIsQualifiedIdentifier(FALSE)
            ->buildGetNestedNameSpecifier()
            ->getDouble();
        
        $this->buildSimpleTypeSpecifierGetDefiningTypeSpecifier($prophecy, $stSpec);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where: 
     * ->getDefiningTypeSpecifier()
     *     ->getTypeSpecifier()
     *         ->getSimpleTypeSpecifier()
     * can be called.
     * 
     * The simple type specifier is defined as "short".
     * 
     * @return  ProphecySubjectInterface
     */
    public function createShortSimpleTypeSpecifier(): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        
        $stSpec = ConceptDoubleBuilder::createSimpleTypeSpecifier($this->getTestCase())
            ->buildIsInt(FALSE)
            ->buildIsFloat(FALSE)
            ->buildIsBool(FALSE)
            ->buildIsChar(FALSE)
            ->buildIsWCharT(FALSE)
            ->buildIsShort(TRUE)
            ->buildIsLong(FALSE)
            ->buildIsSigned(FALSE)
            ->buildIsUnsigned(FALSE)
            ->buildIsDouble(FALSE)
            ->buildIsIdentifier(FALSE)
            ->buildGetIdentifier()
            ->buildIsQualifiedIdentifier(FALSE)
            ->buildGetNestedNameSpecifier()
            ->getDouble();
        
        $this->buildSimpleTypeSpecifierGetDefiningTypeSpecifier($prophecy, $stSpec);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where: 
     * ->getDefiningTypeSpecifier()
     *     ->getTypeSpecifier()
     *         ->getSimpleTypeSpecifier()
     * can be called.
     * 
     * The simple type specifier is defined as "long".
     * 
     * @return  ProphecySubjectInterface
     */
    public function createLongSimpleTypeSpecifier(): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        
        $stSpec = ConceptDoubleBuilder::createSimpleTypeSpecifier($this->getTestCase())
            ->buildIsInt(FALSE)
            ->buildIsFloat(FALSE)
            ->buildIsBool(FALSE)
            ->buildIsChar(FALSE)
            ->buildIsWCharT(FALSE)
            ->buildIsShort(FALSE)
            ->buildIsLong(TRUE)
            ->buildIsSigned(FALSE)
            ->buildIsUnsigned(FALSE)
            ->buildIsDouble(FALSE)
            ->buildIsIdentifier(FALSE)
            ->buildGetIdentifier()
            ->buildIsQualifiedIdentifier(FALSE)
            ->buildGetNestedNameSpecifier()
            ->getDouble();
        
        $this->buildSimpleTypeSpecifierGetDefiningTypeSpecifier($prophecy, $stSpec);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where: 
     * ->getDefiningTypeSpecifier()
     *     ->getTypeSpecifier()
     *         ->getSimpleTypeSpecifier()
     * can be called.
     * 
     * The simple type specifier is defined as "signed".
     * 
     * @return  ProphecySubjectInterface
     */
    public function createSignedSimpleTypeSpecifier(): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        
        $stSpec = ConceptDoubleBuilder::createSimpleTypeSpecifier($this->getTestCase())
            ->buildIsInt(FALSE)
            ->buildIsFloat(FALSE)
            ->buildIsBool(FALSE)
            ->buildIsChar(FALSE)
            ->buildIsWCharT(FALSE)
            ->buildIsShort(FALSE)
            ->buildIsLong(FALSE)
            ->buildIsSigned(TRUE)
            ->buildIsUnsigned(FALSE)
            ->buildIsDouble(FALSE)
            ->buildIsIdentifier(FALSE)
            ->buildGetIdentifier()
            ->buildIsQualifiedIdentifier(FALSE)
            ->buildGetNestedNameSpecifier()
            ->getDouble();
        
        $this->buildSimpleTypeSpecifierGetDefiningTypeSpecifier($prophecy, $stSpec);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where: 
     * ->getDefiningTypeSpecifier()
     *     ->getTypeSpecifier()
     *         ->getSimpleTypeSpecifier()
     * can be called.
     * 
     * The simple type specifier is defined as "unsigned".
     * 
     * @return  ProphecySubjectInterface
     */
    public function createUnsignedSimpleTypeSpecifier(): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        
        $stSpec = ConceptDoubleBuilder::createSimpleTypeSpecifier($this->getTestCase())
            ->buildIsInt(FALSE)
            ->buildIsFloat(FALSE)
            ->buildIsBool(FALSE)
            ->buildIsChar(FALSE)
            ->buildIsWCharT(FALSE)
            ->buildIsShort(FALSE)
            ->buildIsLong(FALSE)
            ->buildIsSigned(FALSE)
            ->buildIsUnsigned(TRUE)
            ->buildIsDouble(FALSE)
            ->buildIsIdentifier(FALSE)
            ->buildGetIdentifier()
            ->buildIsQualifiedIdentifier(FALSE)
            ->buildGetNestedNameSpecifier()
            ->getDouble();
        
        $this->buildSimpleTypeSpecifierGetDefiningTypeSpecifier($prophecy, $stSpec);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where: 
     * ->getDefiningTypeSpecifier()
     *     ->getTypeSpecifier()
     *         ->getSimpleTypeSpecifier()
     * can be called.
     * 
     * The simple type specifier is defined as "double".
     * 
     * @return  ProphecySubjectInterface
     */
    public function createDoubleSimpleTypeSpecifier(): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        
        $stSpec = ConceptDoubleBuilder::createSimpleTypeSpecifier($this->getTestCase())
            ->buildIsInt(FALSE)
            ->buildIsFloat(FALSE)
            ->buildIsBool(FALSE)
            ->buildIsChar(FALSE)
            ->buildIsWCharT(FALSE)
            ->buildIsShort(FALSE)
            ->buildIsLong(FALSE)
            ->buildIsSigned(FALSE)
            ->buildIsUnsigned(FALSE)
            ->buildIsDouble(TRUE)
            ->buildIsIdentifier(FALSE)
            ->buildGetIdentifier()
            ->buildIsQualifiedIdentifier(FALSE)
            ->buildGetNestedNameSpecifier()
            ->getDouble();
        
        $this->buildSimpleTypeSpecifierGetDefiningTypeSpecifier($prophecy, $stSpec);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where: 
     * ->getDefiningTypeSpecifier()
     *     ->getTypeSpecifier()
     *         ->getSimpleTypeSpecifier()
     * can be called.
     * 
     * The simple type specifier is defined as "identifier".
     * 
     * @param   Identifier  $id The value to return when getIdentifier() is called.
     * @return  ProphecySubjectInterface
     */
    public function createIdentifierSimpleTypeSpecifier(
        Identifier $id
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        
        $stSpec = ConceptDoubleBuilder::createSimpleTypeSpecifier($this->getTestCase())
            ->buildIsInt(FALSE)
            ->buildIsFloat(FALSE)
            ->buildIsBool(FALSE)
            ->buildIsChar(FALSE)
            ->buildIsWCharT(FALSE)
            ->buildIsShort(FALSE)
            ->buildIsLong(FALSE)
            ->buildIsSigned(FALSE)
            ->buildIsUnsigned(FALSE)
            ->buildIsDouble(FALSE)
            ->buildIsIdentifier(TRUE)
            ->buildGetIdentifier($id)
            ->buildIsQualifiedIdentifier(FALSE)
            ->buildGetNestedNameSpecifier()
            ->getDouble();
        
        $this->buildSimpleTypeSpecifierGetDefiningTypeSpecifier($prophecy, $stSpec);
        
        return $prophecy->reveal();
    }
    
    /**
     * Creates a double where: 
     * ->getDefiningTypeSpecifier()
     *     ->getTypeSpecifier()
     *         ->getSimpleTypeSpecifier()
     * can be called.
     * 
     * The simple type specifier is defined as a qualified identifier.
     * 
     * @param   NestedNameSpecifier $nnSpec The value to return when getNestedNameSpecifier() is called.
     * @param   Identifier          $id     The value to return when getIdentifier() is called.
     * @return  ProphecySubjectInterface
     */
    public function createQualifiedIdentifierSimpleTypeSpecifier(
        NestedNameSpecifier $nnSpec, 
        Identifier $id
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        
        $stSpec = ConceptDoubleBuilder::createSimpleTypeSpecifier($this->getTestCase())
            ->buildIsInt(FALSE)
            ->buildIsFloat(FALSE)
            ->buildIsBool(FALSE)
            ->buildIsChar(FALSE)
            ->buildIsWCharT(FALSE)
            ->buildIsShort(FALSE)
            ->buildIsLong(FALSE)
            ->buildIsSigned(FALSE)
            ->buildIsUnsigned(FALSE)
            ->buildIsDouble(FALSE)
            ->buildIsIdentifier(FALSE)
            ->buildGetIdentifier($id)
            ->buildIsQualifiedIdentifier(TRUE)
            ->buildGetNestedNameSpecifier($nnSpec)
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

