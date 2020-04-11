<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Datatype;

use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the "string" datatype.
 * 
 * It represents character strings in XML.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class StringType
{
    /**
     * The value.
     * @var string
     */
    private $value;
    
    /**
     * Constructor.
     * 
     * @param   string  $value  The value to set.
     */
    public function __construct(string $value)
    {
        $this->setValue($value);
    }
    
    /**
     * Sets the value.
     * 
     * @param   string  $value  The value to set.
     * 
     * @throws  InvalidValueException   When the value is an invalid string datatype.
     */
    private function setValue(string $value): void
    {
        if (!\preg_match('`^['.XmlCharClass::CHAR.']*$`u', $value)) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid string datatype.', $value));
        }
        
        $this->value = $value;
    }
    
    /**
     * Returns the string representation of the value.
     * 
     * @return  string
     */
    public function getString(): string
    {
        return $this->value;
    }
}
