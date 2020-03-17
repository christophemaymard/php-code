<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Parsing;

/**
 * Represents the base class for a data.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractData
{
    /**
     * The name of the data (default to en empty string).
     * @var string
     */
    private $name = '';
    
    /**
     * The supported standards (default to an indexed array with 1, 2, 4 and 8).
     * @var int[]
     */
    private $standards = [ 1, 2, 4, 8, ];
    
    /**
     * The stream (default to en empty string).
     * @var string
     */
    private $stream = '';
    
    /**
     * Returns the name of the data.
     * 
     * @return  string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * Sets the name of the data.
     * 
     * @param   string  $name   The name of the data to set.
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    
    /**
     * Indicates whether the data has a name.
     * 
     * @return  bool    TRUE if the data has a name, otherwise FALSE.
     */
    public function hasName(): bool
    {
        return $this->name !== '';
    }
    
    /**
     * Returns the supported standards.
     * 
     * @return  int[]
     */
    public function getStandards(): array
    {
        return $this->standards;
    }
    
    /**
     * Returns the stream.
     * 
     * @return  string
     */
    public function getStream(): string
    {
        return $this->stream;
    }
    
    /**
     * Sets the stream.
     * 
     * @param   string  $stream The stream to set.
     */
    protected function setStream(string $stream): void
    {
        $this->stream = $stream;
    }
}

