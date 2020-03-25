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
        }
        
        return \sprintf('Simple type specifier "%s"', $type);
    }
}

