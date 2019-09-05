<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Datatype;

use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the "positiveInteger" datatype.
 * 
 * It represents positive integer numbers (the infinite set {1, 2, ...}).
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PositiveIntegerType
{
    /**
     * The value.
     * @var \GMP
     */
    private $value;
    
    /**
     * Constructor.
     * 
     * @param   \GMP    $value  The value to set.
     */
    public function __construct(\GMP $value)
    {
        $this->setValue($value);
    }
    
    /**
     * Sets the value.
     * 
     * @param   \GMP    $value  The value to set.
     * 
     * @throws  InvalidValueException   When the value is invalid.
     */
    private function setValue(\GMP $value)
    {
        if ($value < 1) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid positive integer.', $value));
        }
        
        $this->value = $value;
    }
    
    /**
     * Returns the integer representation of the value.
     * 
     * @return  \GMP
     */
    public function getPositiveInteger():\GMP
    {
        return $this->value;
    }
}
