<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "restriction" element held in the XML schema 
 * "simpleType" element ({@see PhpXmlSchema\Dom\SimpleTypeElement}).
 * 
 * Content (version 1.0):
 * (annotation?, (simpleType?, (minExclusive | minInclusive | maxExclusive | maxInclusive | totalDigits | fractionDigits | length | minLength | maxLength | enumeration | whiteSpace | pattern)*))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleTypeRestrictionElement extends AbstractCompositeElement
{
    /**
     * Returns the "annotation" element.
     * 
     * @return  AnnotationElement|NULL  The instance of the element if it has been set, otherwise NULL.
     */
    public function getAnnotationElement()
    {
        return $this->getChildElement(0);
    }
    
    /**
     * Sets the "annotation" element.
     * 
     * @param   AnnotationElement   $element    The element to set.
     */
    public function setAnnotationElement(AnnotationElement $element)
    {
        $this->setChildElement(0, $element);
    }
    
    /**
     * Indicates whether an "annotation" element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasAnnotationElement():bool
    {
        return $this->isChildElementSet(0);
    }
    
    /**
     * Returns the "simpleType" element.
     * 
     * @return  SimpleTypeElement|NULL  The instance of the element if it has been set, otherwise NULL.
     */
    public function getSimpleTypeElement()
    {
        return $this->getChildElement(1);
    }
    
    /**
     * Sets the "simpleType" element.
     * 
     * @param   SimpleTypeElement   $element    The element to set.
     */
    public function setSimpleTypeElement(SimpleTypeElement $element)
    {
        $this->setChildElement(1, $element);
    }
    
    /**
     * Indicates whether a "simpleType" element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasSimpleTypeElement():bool
    {
        return $this->isChildElementSet(1);
    }
}
