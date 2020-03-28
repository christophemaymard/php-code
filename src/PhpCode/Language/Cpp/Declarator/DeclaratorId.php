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
     * @var IdExpression
     */
    private $idExpr;
    
    /**
     * Constructor.
     * 
     * @param   IdExpression    $idExpr The identifier expression.
     */
    public function __construct(IdExpression $idExpr)
    {
        $this->idExpr = $idExpr;
    }
    
    /**
     * Returns the identifier expression.
     * 
     * @return  IdExpression
     */
    public function getIdExpression(): IdExpression
    {
        return $this->idExpr;
    }
}

