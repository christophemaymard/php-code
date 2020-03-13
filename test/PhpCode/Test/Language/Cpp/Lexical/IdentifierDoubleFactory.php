<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Lexical;

use PhpCode\Language\Cpp\Lexical\Identifier;
use PhpCode\Test\AbstractDoubleFactory;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Lexical\Identifier} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class IdentifierDoubleFactory extends AbstractDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getClassName(): string
    {
        return Identifier::class;
    }
    
    /**
     * Creates a double where getIdentifier() can be called.
     * 
     * @param   string  $return The value to return when getIdentifier() is called.
     * @return  ProphecySubjectInterface
     */
    public function createGetIdentifier(string $return): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $prophecy
            ->getIdentifier()
            ->willReturn($return);
        
        return $prophecy->reveal();
    }
}

