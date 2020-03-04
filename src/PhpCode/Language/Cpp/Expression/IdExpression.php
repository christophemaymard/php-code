<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Expression;

/**
 * Represents an identifier expression.
 * 
 * id-expression:
 *     unqualified-id
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class IdExpression
{
    /**
     * The unqualified identifier.
     * @var UnqualifiedId|NULL
     */
    private $uid;
    
    /**
     * Creates an instance of an identifier expression defined with an unqualified identifier.
     * 
     * @param   UnqualifiedId   $uid    The unqualified identifier to use.
     * @return  IdExpression    The created instance of IdExpression.
     */
    public static function createUnqualifiedId(UnqualifiedId $uid): self
    {
        $idExpr = new self();
        $idExpr->uid = $uid;
        
        return $idExpr;
    }
    
    /**
     * Returns the unqualified identifier.
     * 
     * @return  UnqualifiedId|NULL  The instance of the unqualified identifier if this identifier expression has been defined with an unqualified identifier, otherwise NULL.
     */
    public function getUnqualifiedId(): ?UnqualifiedId
    {
        return $this->uid;
    }
}

