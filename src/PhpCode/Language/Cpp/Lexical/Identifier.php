<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Language\Cpp\Lexical;

use PhpCode\Exception\FormatException;

/**
 * Represents an identifier.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class Identifier
{
    /**
     * The "identifier" pattern.
     */
    public const PATTERN = '[_a-zA-Z][_a-zA-Z0-9]*';
    
    /**
     * The identifier.
     * @var string
     */
    private $id;
    
    /**
     * Constructor.
     * 
     * @param   string  $id The identifier to set.
     */
    public function __construct(string $id)
    {
        $this->setIdentifier($id);
    }
    
    /**
     * Sets the identifier.
     * 
     * @param   string  $id The identifier to set.
     * 
     * @throws  FormatException When the identifier is invalid.
     */
    private function setIdentifier(string $id): void
    {
        if (!\preg_match('`^'.self::PATTERN.'$`', $id)) {
            throw new FormatException(\sprintf('"%s" is an invalid identifier.', $id));
        }
        
        $this->id = $id;
    }
    
    /**
     * Returns the identifier.
     * 
     * @return  string
     */
    public function getIdentifier(): string
    {
        return $this->id;
    }
}

