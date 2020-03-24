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
 *     qualified-id
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
     * The qualified identifier.
     * @var QualifiedId|NULL
     */
    private $qid;
    
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
     * Creates an instance of an identifier expression defined with a qualified identifier.
     * 
     * @param   QualifiedId     $qid    The qualified identifier to use.
     * @return  IdExpression    The created instance of IdExpression.
     */
    public static function createQualifiedId(QualifiedId $qid): self
    {
        $idExpr = new self();
        $idExpr->qid = $qid;
        
        return $idExpr;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
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
    
    /**
     * Indicates whether this identifier expression has been defined with an 
     * unqualified identifier.
     * 
     * @return  bool    TRUE if this identifier expression has been defined with an unqualified identifier, otherwise FALSE.
     */
    public function isUnqualifiedId(): bool
    {
        return $this->uid !== NULL;
    }
    
    /**
     * Returns the qualified identifier.
     * 
     * @return  QualifiedId|NULL    The instance of the qualified identifier if this identifier expression has been defined with a qualified identifier, otherwise NULL.
     */
    public function getQualifiedId(): ?QualifiedId
    {
        return $this->qid;
    }
    
    /**
     * Indicates whether this identifier expression has been defined with a 
     * qualified identifier.
     * 
     * @return  bool    TRUE if this identifier expression has been defined with a qualified identifier, otherwise FALSE.
     */
    public function isQualifiedId(): bool
    {
        return $this->qid !== NULL;
    }
}

