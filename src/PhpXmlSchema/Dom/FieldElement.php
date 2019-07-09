<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "field" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * - xpath = a XPath expression ({@see PhpXmlSchema\Dom\FieldXPathType})
 * 
 * Content (version 1.0):
 * (annotation?)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class FieldElement extends AbstractAnnotatedElement
{
    /**
     * The value of the "xpath" attribute.
     * @var FieldXPathType|NULL
     */
    private $xpathAttr;
    
    /**
     * Returns the value of the "xpath" attribute.
     * 
     * @return  FieldXPathType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getXPath()
    {
        return $this->xpathAttr;
    }
    
    /**
     * Sets the value of the "xpath" attribute.
     * 
     * @param   FieldXPathType  $value  The value to set.
     */
    public function setXPath(FieldXPathType $value)
    {
        $this->xpathAttr = $value;
    }
    
    /**
     * Indicates whether the "xpath" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasXPath():bool
    {
        return $this->xpathAttr !== NULL;
    }
}
