<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\StringType;

/**
 * Represents the XML schema "pattern" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * - value = string
 * 
 * Content (version 1.0):
 * (annotation?)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PatternElement extends AbstractAnnotatedElement implements FacetElementInterface
{
    /**
     * The value of the "value" attribute.
     * @var StringType|NULL
     */
    private $valueAttr;
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName():string
    {
        return 'pattern';
    }
    
    /**
     * Returns the value of the "value" attribute.
     * 
     * @return  StringType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getValue()
    {
        return $this->valueAttr;
    }
    
    /**
     * Sets the value of the "value" attribute.
     * 
     * @param   StringType  $value  The value to set.
     */
    public function setValue(StringType $value)
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
