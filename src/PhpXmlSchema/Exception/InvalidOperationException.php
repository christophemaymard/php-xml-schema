<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Exception;

/**
 * Represents the exception thrown when an operation cannot be completed in 
 * the current state.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class InvalidOperationException extends \LogicException implements PhpXmlSchemaExceptionInterface
{
}
