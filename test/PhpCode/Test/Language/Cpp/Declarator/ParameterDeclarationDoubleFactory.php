<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declaration\DeclarationSpecifierSequence;
use PhpCode\Language\Cpp\Declarator\ParameterDeclaration;
use PhpCode\Test\AbstractDoubleFactory;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Declarator\ParameterDeclaration} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationDoubleFactory extends AbstractDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return ParameterDeclaration::class;
    }
    
    /**
     * Creates a double where getDeclarationSpecifierSequence() can be called.
     * 
     * @param   DeclarationSpecifierSequence    $declSpecSeq    The value to return when getDeclarationSpecifierSequence() is called.
     * @return  ProphecySubjectInterface
     */
    public function createGetDeclarationSpecifierSequence(
        DeclarationSpecifierSequence $declSpecSeq
    ): ProphecySubjectInterface
    {
        $prophecy = $this->prophesizeSubject();
        $prophecy
            ->getDeclarationSpecifierSequence()
            ->willReturn($declSpecSeq);
        
        return $prophecy->reveal();
    }
}

