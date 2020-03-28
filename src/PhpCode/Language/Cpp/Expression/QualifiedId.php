<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Expression;

/**
 * Represents a qualified identifier.
 * 
 * qualified-id:
 *     nested-name-specifier unqualified-id
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class QualifiedId
{
    /**
     * The nested name specifier.
     * @var NestedNameSpecifier
     */
    private $nnSpec;
    
    /**
     * The unqualified identifier.
     * @var UnqualifiedId
     */
    private $unqualId;
    
    /**
     * Constructor.
     * 
     * @param   NestedNameSpecifier $nnSpec     The nested name specifier.
     * @param   UnqualifiedId       $unqualId   The unqualified identifier.
     */
    public function __construct(NestedNameSpecifier $nnSpec, UnqualifiedId $unqualId)
    {
        $this->nnSpec = $nnSpec;
        $this->unqualId = $unqualId;
    }
    
    /**
     * Returns the nested name specifier.
     * 
     * @return  NestedNameSpecifier
     */
    public function getNestedNameSpecifier(): NestedNameSpecifier
    {
        return $this->nnSpec;
    }
    
    /**
     * Returns the unqualified identifier.
     * 
     * @return  UnqualifiedId
     */
    public function getUnqualifiedId(): UnqualifiedId
    {
        return $this->unqualId;
    }
}

