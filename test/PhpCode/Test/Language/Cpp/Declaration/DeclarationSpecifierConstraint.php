<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declaration;

use PhpCode\Language\Cpp\Declaration\DeclarationSpecifier;
use PhpCode\Test\Language\Cpp\AbstractConceptConstraint;
use PhpCode\Test\Language\Cpp\Expression\NestedNameSpecifierConstraint;
use PhpCode\Test\Language\Cpp\Lexical\IdentifierConstraint;

/**
 * Represents the constraint for a declaration specifier.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DeclarationSpecifierConstraint extends AbstractConceptConstraint
{
    private const ST_INT = 1;
    private const ST_FLOAT = 2;
    private const ST_BOOL = 3;
    private const ST_CHAR = 4;
    private const ST_WCHART = 5;
    private const ST_SHORT = 6;
    private const ST_LONG = 7;
    private const ST_SIGNED = 8;
    private const ST_UNSIGNED = 9;
    private const ST_DOUBLE = 10;
    private const ST_ID = 11;
    private const ST_QUALIFIED_ID = 12;
    
    /**
     * The type of simple type specifier (one of ST_XXX constant values).
     * @var int
     */
    private $stSpecType;
    
    /**
     * The identifier constraint if it has been defined as an identifier or a 
     * qualified identifier.
     * @var IdentifierConstraint|NULL
     */
    private $idConst;
    
    /**
     * The nested name specifier constraint if it has been defined as a 
     * qualified identifier.
     * @var NestedNameSpecifierConstraint|NULL
     */
    private $nnSpecConst;
    
    /**
     * Creates a constraint for a simple type specifier that is defined as 
     * "int".
     * 
     * @return  DeclarationSpecifierConstraint  The created instance of declaration specifier constraint.
     */
    public static function createInt(): self
    {
        $const = new self();
        $const->stSpecType = self::ST_INT;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a simple type specifier that is defined as 
     * "float".
     * 
     * @return  DeclarationSpecifierConstraint  The created instance of declaration specifier constraint.
     */
    public static function createFloat(): self
    {
        $const = new self();
        $const->stSpecType = self::ST_FLOAT;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a simple type specifier that is defined as 
     * "bool".
     * 
     * @return  DeclarationSpecifierConstraint  The created instance of declaration specifier constraint.
     */
    public static function createBool(): self
    {
        $const = new self();
        $const->stSpecType = self::ST_BOOL;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a simple type specifier that is defined as 
     * "char".
     * 
     * @return  DeclarationSpecifierConstraint  The created instance of declaration specifier constraint.
     */
    public static function createChar(): self
    {
        $const = new self();
        $const->stSpecType = self::ST_CHAR;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a simple type specifier that is defined as 
     * "wchar_t".
     * 
     * @return  DeclarationSpecifierConstraint  The created instance of declaration specifier constraint.
     */
    public static function createWCharT(): self
    {
        $const = new self();
        $const->stSpecType = self::ST_WCHART;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a simple type specifier that is defined as 
     * "short".
     * 
     * @return  DeclarationSpecifierConstraint  The created instance of declaration specifier constraint.
     */
    public static function createShort(): self
    {
        $const = new self();
        $const->stSpecType = self::ST_SHORT;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a simple type specifier that is defined as 
     * "long".
     * 
     * @return  DeclarationSpecifierConstraint  The created instance of declaration specifier constraint.
     */
    public static function createLong(): self
    {
        $const = new self();
        $const->stSpecType = self::ST_LONG;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a simple type specifier that is defined as 
     * "signed".
     * 
     * @return  DeclarationSpecifierConstraint  The created instance of declaration specifier constraint.
     */
    public static function createSigned(): self
    {
        $const = new self();
        $const->stSpecType = self::ST_SIGNED;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a simple type specifier that is defined as 
     * "unsigned".
     * 
     * @return  DeclarationSpecifierConstraint  The created instance of declaration specifier constraint.
     */
    public static function createUnsigned(): self
    {
        $const = new self();
        $const->stSpecType = self::ST_UNSIGNED;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a simple type specifier that is defined as 
     * "double".
     * 
     * @return  DeclarationSpecifierConstraint  The created instance of declaration specifier constraint.
     */
    public static function createDouble(): self
    {
        $const = new self();
        $const->stSpecType = self::ST_DOUBLE;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a simple type specifier that is defined as an 
     * identifier.
     * 
     * @param   IdentifierConstraint    $idConst    The identifier constraint.
     * @return  DeclarationSpecifierConstraint  The created instance of declaration specifier constraint.
     */
    public static function createIdentifier(IdentifierConstraint $idConst): self
    {
        $const = new self();
        $const->stSpecType = self::ST_ID;
        $const->idConst = $idConst;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a simple type specifier that is defined as a 
     * qualified identifier.
     * 
     * @param   NestedNameSpecifierConstraint   $nnSpecConst    The nested name specifier constraint.
     * @param   IdentifierConstraint            $idConst        The identifier constraint.
     * @return  DeclarationSpecifierConstraint  The created instance of declaration specifier constraint.
     */
    public static function createQualifiedIdentifier(
        NestedNameSpecifierConstraint $nnSpecConst, 
        IdentifierConstraint $idConst
    ): self
    {
        $const = new self();
        $const->stSpecType = self::ST_QUALIFIED_ID;
        $const->nnSpecConst = $nnSpecConst;
        $const->idConst = $idConst;
        
        return $const;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return 'declaration specifier';
    }
    
    /**
     * {@inheritDoc}
     */
    public function constraintDescription(): string
    {
        $lines = [];
        $lines[] = $this->getConceptName();
        $lines[] = $this->indent($this->getType());
        
        if ($this->stSpecType == self::ST_QUALIFIED_ID) {
            $lines[] = $this->indent(
                $this->indent(
                    $this->nnSpecConst->constraintDescription()
                )
            );
        }
        
        if ($this->stSpecType == self::ST_ID || $this->stSpecType == self::ST_QUALIFIED_ID) {
            $lines[] = $this->indent(
                $this->indent(
                    $this->idConst->constraintDescription()
                )
            );
        }
        
        return \implode("\n", $lines);
    }
    
    /**
     * {@inheritDoc}
     */
    public function matches($other): bool
    {
        if (!$other instanceof DeclarationSpecifier) {
            return FALSE;
        }
        
        $stSpec = $other->getDefiningTypeSpecifier()
            ->getTypeSpecifier()
            ->getSimpleTypeSpecifier();
        
        switch ($this->stSpecType) {
            case self::ST_INT:
                return $stSpec->isInt();
            case self::ST_FLOAT:
                return $stSpec->isFloat();
            case self::ST_BOOL:
                return $stSpec->isBool();
            case self::ST_CHAR:
                return $stSpec->isChar();
            case self::ST_WCHART:
                return $stSpec->isWCharT();
            case self::ST_SHORT:
                return $stSpec->isShort();
            case self::ST_LONG:
                return $stSpec->isLong();
            case self::ST_SIGNED:
                return $stSpec->isSigned();
            case self::ST_UNSIGNED:
                return $stSpec->isUnsigned();
            case self::ST_DOUBLE:
                return $stSpec->isDouble();
            case self::ST_ID:
                if (!$stSpec->isIdentifier()) {
                    return FALSE;
                }
                
                return $this->idConst->matches($stSpec->getIdentifier());
            case self::ST_QUALIFIED_ID:
                if (!$stSpec->isQualifiedIdentifier()) {
                    return FALSE;
                }
                
                if (!$this->nnSpecConst->matches($stSpec->getNestedNameSpecifier())) {
                    return FALSE;
                }
                
                return $this->idConst->matches($stSpec->getIdentifier());
        }
        
    }
    
    /**
     * {@inheritDoc}
     */
    public function failureReason($other): string
    {
        if (!$other instanceof DeclarationSpecifier) {
            return $this->instanceReason(DeclarationSpecifier::class, $other);
        } 
        
        $stSpec = $other->getDefiningTypeSpecifier()
            ->getTypeSpecifier()
            ->getSimpleTypeSpecifier();
        
        if ($this->stSpecType == self::ST_INT && !$stSpec->isInt()) {
            return $this->isReason(TRUE, 'simple type specifier "int"');
        } elseif ($this->stSpecType == self::ST_FLOAT && !$stSpec->isFloat()) {
            return $this->isReason(TRUE, 'simple type specifier "float"');
        } elseif ($this->stSpecType == self::ST_BOOL && !$stSpec->isBool()) {
            return $this->isReason(TRUE, 'simple type specifier "bool"');
        } elseif ($this->stSpecType == self::ST_CHAR && !$stSpec->isChar()) {
            return $this->isReason(TRUE, 'simple type specifier "char"');
        } elseif ($this->stSpecType == self::ST_WCHART && !$stSpec->isWCharT()) {
            return $this->isReason(TRUE, 'simple type specifier "wchar_t"');
        } elseif ($this->stSpecType == self::ST_SHORT && !$stSpec->isShort()) {
            return $this->isReason(TRUE, 'simple type specifier "short"');
        } elseif ($this->stSpecType == self::ST_LONG && !$stSpec->isLong()) {
            return $this->isReason(TRUE, 'simple type specifier "long"');
        } elseif ($this->stSpecType == self::ST_SIGNED && !$stSpec->isSigned()) {
            return $this->isReason(TRUE, 'simple type specifier "signed"');
        } elseif ($this->stSpecType == self::ST_UNSIGNED && !$stSpec->isUnsigned()) {
            return $this->isReason(TRUE, 'simple type specifier "unsigned"');
        } elseif ($this->stSpecType == self::ST_DOUBLE && !$stSpec->isDouble()) {
            return $this->isReason(TRUE, 'simple type specifier "double"');
        } elseif ($this->stSpecType == self::ST_ID) {
            if (!$stSpec->isIdentifier()) {
                return $this->isReason(TRUE, 'simple type specifier "identifier"');
            }
        } elseif ($this->stSpecType == self::ST_QUALIFIED_ID) {
            if (!$stSpec->isQualifiedIdentifier()) {
                return $this->isReason(TRUE, 'simple type specifier qualified identifier');
            }
            
            if (!$this->nnSpecConst->matches($stSpec->getNestedNameSpecifier())) {
                return $this->conceptIndent(
                    $this->nnSpecConst->failureReason($stSpec->getNestedNameSpecifier())
                );
            }
        }
        
        if ($this->stSpecType == self::ST_ID || $this->stSpecType == self::ST_QUALIFIED_ID) {
            if (!$this->idConst->matches($stSpec->getIdentifier())) {
                return $this->conceptIndent(
                    $this->idConst->failureReason($stSpec->getIdentifier())
                );
            }
        }
        
        return $this->failureDefaultReason($other);
    }
    
    /**
     * {@inheritDoc}
     */
    protected function failureDescription($other): string
    {
        return \sprintf(
            '%s is a %s', 
            $this->exporter()->shortenedExport($other), 
            $this->toString()
        );
    }
    
    /**
     * Returns the type of the declaration specifier.
     * 
     * @return  string
     */
    private function getType(): string
    {
        $type = '';
        
        switch ($this->stSpecType) {
            case self::ST_INT:
                $type = 'int';
                break;
            case self::ST_FLOAT:
                $type = 'float';
                break;
            case self::ST_BOOL:
                $type = 'bool';
                break;
            case self::ST_CHAR:
                $type = 'char';
                break;
            case self::ST_WCHART:
                $type = 'wchar_t';
                break;
            case self::ST_SHORT:
                $type = 'short';
                break;
            case self::ST_LONG:
                $type = 'long';
                break;
            case self::ST_SIGNED:
                $type = 'signed';
                break;
            case self::ST_UNSIGNED:
                $type = 'unsigned';
                break;
            case self::ST_DOUBLE:
                $type = 'double';
                break;
            case self::ST_ID:
                $type = 'identifier';
                break;
            case self::ST_QUALIFIED_ID:
                return 'Simple type specifier qualified identifier';
        }
        
        return \sprintf('Simple type specifier "%s"', $type);
    }
}

