<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Declarator;

/**
 * Represents a parameter declaration clause.
 * 
 * parameter-declaration-clause:
 *     ...[opt]
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParameterDeclarationClause
{
    /**
     * The ellipsis flag (default to FALSE).
     * @var bool
     */
    private $ellipsis = FALSE;
    
    /**
     * Adds an ellipsis.
     */
    public function addEllipsis(): void
    {
        $this->ellipsis = TRUE;
    }
    
    /**
     * Indicates whether an ellipsis is present.
     * 
     * @return  bool    TRUE if an ellipsis is present, otherwise FALSE.
     */
    public function hasEllipsis(): bool
    {
        return $this->ellipsis;
    }
}

