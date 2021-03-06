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
 * Represents the "nonNegativeInteger" datatype.
 * 
 * It represents non-negative integer numbers (the infinite set {0, 1, 2, ...}).
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NonNegativeIntegerType
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
     * @throws  InvalidValueException   When the value is an invalid nonNegativeInteger datatype.
     */
    private function setValue(\GMP $value): void
    {
        if ($value < 0) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid nonNegativeInteger datatype.', $value));
        }
        
        $this->value = $value;
    }
    
    /**
     * Returns the integer representation of the value.
     * 
     * @return  \GMP
     */
    public function getNonNegativeInteger(): \GMP
    {
        return $this->value;
    }
}
