<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Expression;

use PhpCode\Language\Cpp\Lexical\Identifier;

/**
 * Represents an unqualified identifier.
 * 
 * unqualified-id:
 *     identifier
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class UnqualifiedId
{
    /**
     * The identifier.
     * @var Identifier
     */
    private $identifier;
    
    /**
     * Creates an instance of an unqualified identifier defined with an identifier.
     * 
     * @param   Identifier  $identifier The identifier to use.
     * @return  UnqualifiedId   The created instance of UnqualifiedId.
     */
    public static function createIdentifier(Identifier $identifier): self
    {
        $uid = new self();
        $uid->identifier = $identifier;
        
        return $uid;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * Returns the identifier.
     * 
     * @return  Identifier
     */
    public function getIdentifier(): Identifier
    {
        return $this->identifier;
    }
}

