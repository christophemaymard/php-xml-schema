<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the base class for a fixed facet element that holds the "value" 
 * attribute (anySimpleType).
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractAnyFacetElement extends AbstractFixedFacetElement
{
    /**
     * The value of the "value" attribute.
     * @var string|NULL
     */
    private $valueAttr;
    
    /**
     * Returns the value of the "value" attribute.
     * 
     * @return  string|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getValue()
    {
        return $this->valueAttr;
    }
    
    /**
     * Sets the value of the "value" attribute.
     * 
     * @param   string  $value  The value to set.
     */
    public function setValue(string $value)
    {
        $this->valueAttr = $value;
    }
    
    /**
     * Indicates whether the "value" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasValue():bool
    {
        return $this->valueAttr !== NULL;
    }
}
