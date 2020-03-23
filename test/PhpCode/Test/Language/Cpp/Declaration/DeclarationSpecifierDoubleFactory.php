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
use PhpCode\Test\AbstractDoubleFactory;
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
     * Creates a double where getDefiningTypeSpecifier() can be called.
     * 
     * @param   DefiningTypeSpecifier   $defTypeSpec    The value to return when getDefiningTypeSpecifier() is called.
     * @return  ProphecySubjectInterface
     */
    public function createGetDefiningTypeSpecifier(
        DefiningTypeSpecifier $defTypeSpec
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        $prophecy
            ->getDefiningTypeSpecifier()
            ->willReturn($defTypeSpec);
        
        return $prophecy->reveal();
    }
}

