<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

use PhpXmlSchema\Datatype\NCNameType;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Datatype\NCNameType} 
 * class.
 * 
 * @group   type
 * @group   datatype
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NCNameTypeTest extends AbstractNCNameTypeTestCase
{
    /**
     * Creates the SUT with the specified value.
     * 
     * @param   string  The value to test.
     * @return  NCNameType  The instance of the SUT.
     * 
     * @throws  InvalidValueException   When the value is an invalid NCName.
     */
    protected function createSut(string $value)
    {
        return new NCNameType($value);
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getTypeName():string
    {
        return 'NCName';
    }
}
