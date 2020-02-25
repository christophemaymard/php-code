<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Exception;

/**
 * Represents the exception thrown when an operation cannot be completed in 
 * the current state.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class InvalidOperationException extends \Exception implements PhpCodeExceptionInterface
{
}

