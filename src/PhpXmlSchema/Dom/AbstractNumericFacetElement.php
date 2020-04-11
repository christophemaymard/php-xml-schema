<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\NonNegativeIntegerType;

/**
 * Represents the base class for a fixed facet element that holds the "value" 
 * attribute (nonNegativeInteger).
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractNumericFacetElement extends AbstractFixedFacetElement
{
    /**
     * The value of the "value" attribute.
     * @var NonNegativeIntegerType|NULL
     */
    private $valueAttr;
    
    /**
     * Returns the value of the "value" attribute.
     * 
     * @return  NonNegativeIntegerType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getValue(): ?NonNegativeIntegerType
    {
        return $this->valueAttr;
    }
    
    /**
     * Sets the value of the "value" attribute.
     * 
     * @param   NonNegativeIntegerType  $value  The value to set.
     */
    public function setValue(NonNegativeIntegerType $value): void
    {
        $this->valueAttr = $value;
    }
    
    /**
     * Indicates whether the "value" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasValue(): bool
    {
        return $this->valueAttr !== NULL;
    }
}
