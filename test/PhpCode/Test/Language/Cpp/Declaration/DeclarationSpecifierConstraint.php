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
    
    /**
     * The type of simple type specifier (one of ST_XXX constant values).
     * @var int
     */
    private $stSpecType;
    
    /**
     * Creates a constraint for a simple type specifier that is "int".
     * 
     * @return  DeclarationSpecifierConstraint  The created instance of DeclarationSpecifierConstraint.
     */
    public static function createInt(): self
    {
        $const = new self();
        $const->stSpecType = self::ST_INT;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a simple type specifier that is "float".
     * 
     * @return  DeclarationSpecifierConstraint  The created instance of DeclarationSpecifierConstraint.
     */
    public static function createFloat(): self
    {
        $const = new self();
        $const->stSpecType = self::ST_FLOAT;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a simple type specifier that is "bool".
     * 
     * @return  DeclarationSpecifierConstraint  The created instance of DeclarationSpecifierConstraint.
     */
    public static function createBool(): self
    {
        $const = new self();
        $const->stSpecType = self::ST_BOOL;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a simple type specifier that is "char".
     * 
     * @return  DeclarationSpecifierConstraint  The created instance of DeclarationSpecifierConstraint.
     */
    public static function createChar(): self
    {
        $const = new self();
        $const->stSpecType = self::ST_CHAR;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a simple type specifier that is "wchar_t".
     * 
     * @return  DeclarationSpecifierConstraint  The created instance of DeclarationSpecifierConstraint.
     */
    public static function createWCharT(): self
    {
        $const = new self();
        $const->stSpecType = self::ST_WCHART;
        
        return $const;
    }
    
    /**
     * Creates a constraint for a simple type specifier that is "short".
     * 
     * @return  DeclarationSpecifierConstraint  The created instance of DeclarationSpecifierConstraint.
     */
    public static function createShort(): self
    {
        $const = new self();
        $const->stSpecType = self::ST_SHORT;
        
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
        }
        
        return \sprintf('Simple type specifier "%s"', $type);
    }
}

