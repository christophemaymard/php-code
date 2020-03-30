<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Parsing;

use PhpCode\Exception\FormatException;

/**
 * Represents an invalid data.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class InvalidData extends AbstractData
{
    /**
     * The name of the exception (default to FormatException class name).
     * @var string
     */
    private $exceptionName = FormatException::class;
    
    /**
     * The message of the exception.
     * @var string
     */
    private $exceptionMessage;
    
    /**
     * Constructor.
     * 
     * @param   string  $stream             The stream to set.
     * @param   string  $exceptionMessage   The message of the exception.
     */
    public function __construct(string $stream, string $exceptionMessage)
    {
        $this->setStream($stream);
        $this->exceptionMessage = $exceptionMessage;
    }
    
    /**
     * Returns the name of the exception.
     * 
     * @return  string
     */
    public function getExceptionName(): string
    {
        return $this->exceptionName;
    }
    
    /**
     * Sets the name of the exception.
     * 
     * @param   string  $name   The name to set.
     */
    public function setExceptionName(string $name): void
    {
        $this->exceptionName = $name;
    }
    
    /**
     * Returns the message of the exception.
     * 
     * @return  string
     */
    public function getExceptionMessage(): string
    {
        return $this->exceptionMessage;
    }
}

