<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Datatype;

use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the base class for a datatype that matches the "NCName" 
 * production of "Namespaces in XML" ({@see PhpXmlSchema\Datatype\XmlCharClass}).
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractNCNameType
{
    /**
     * The value.
     * @var string
     */
    private $value;
    
    /**
     * Constructor.
     * 
     * @param   string  $value  The name to set.
     * 
     * @throws  InvalidValueException   When the value is an invalid value.
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
     * @throws  InvalidValueException   When the value is invalid.
     */
    private function setValue(string $value)
    {
        if (!\preg_match('`^[_'.XmlCharClass::LETTER.']['.XmlCharClass::NCNAMECHAR.']*$`u', $value)) {
            throw new InvalidValueException(\sprintf(
                '"%s" is an invalid %s.', 
                $value, 
                // Removes the namespace part and the 'Type' suffix.
                \substr($className = \get_class($this), \strrpos($className, '\\') + 1, -4)
            ));
        }
        
        $this->value = $value;
    }
    
    /**
     * Returns the string representation of the value.
     * 
     * @return  string
     */
    public function getString():string
    {
        return $this->value;
    }
}
