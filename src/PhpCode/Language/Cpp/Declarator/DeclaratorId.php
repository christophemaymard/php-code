<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Expression\IdExpression;

/**
 * Represents a declarator identifier.
 * 
 * declarator-id:
 *     id-expression
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclaratorId
{
    /**
     * The identifier expression.
     * @var IdExpression|NULL
     */
    private $idExpr;
    
    /**
     * Creates an instance of a declarator identifier defined with an identifier expression.
     * 
     * @param   IdExpression    $idExpr The identifier expression to use.
     * @return  DeclaratorId    The created instance of DeclaratorId.
     */
    public static function createIdExpression(IdExpression $idExpr): self
    {
        $did = new self();
        $did->idExpr = $idExpr;
        
        return $did;
    }
    
    /**
     * Returns the identifier expression.
     * 
     * @return  IdExpression|NULL   The instance of the identifier expression if this declarator identifier has been defined with an identifier expression, otherwise NULL.
     */
    public function getIdExpression(): ?IdExpression
    {
        return $this->idExpr;
    }
}

