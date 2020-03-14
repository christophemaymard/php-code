<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Expression\UnqualifiedId;
use PhpCode\Language\Cpp\Lexical\Identifier;
use PhpCode\Test\AbstractDoubleFactory;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Expression\UnqualifiedId} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class UnqualifiedIdDoubleFactory extends AbstractDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getClassName(): string
    {
        return UnqualifiedId::class;
    }
    
    /**
     * Creates a double where getIdentifier() can be called.
     * 
     * @param   Identifier  $return The value to return when getIdentifier() is called (optional)(default to NULL).
     * @return  ProphecySubjectInterface
     */
    public function createGetIdentifier(Identifier $return = NULL): ProphecySubjectInterface
    {
        $prophecy = $this->prophesize();
        $prophecy
            ->getIdentifier()
            ->willReturn($return);
        
        return $prophecy->reveal();
    }
}

