<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Exception;

/**
 * Represents the exception thrown when a value does not adhere to a defined 
 * valid data domain.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class InvalidValueException extends \DomainException implements PhpXmlSchemaExceptionInterface
{
}
