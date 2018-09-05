<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "whiteSpace" element.
 * 
 * Attributes (version 1.0):
 * - fixed = boolean
 * - id = ID
 * - value = (collapse | preserve | replace)
 * 
 * Content (version 1.0):
 * (annotation?)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class WhiteSpaceElement extends AbstractFixedFacetElement
{
    /**
     * The value of the "value" attribute.
     * @var WhiteSpaceType|NULL
     */
    private $valueAttr;
    
    /**
     * Returns the value of the "value" attribute.
     * 
     * @return  WhiteSpaceType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getValue()
    {
        return $this->valueAttr;
    }
    
    /**
     * Sets the value of the "value" attribute.
     * 
     * @param   WhiteSpaceType  $value  The value to set.
     */
    public function setValue(WhiteSpaceType $value)
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
