<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "unique" element.
 * 
 * Content (version 1.0):
 * (annotation?, (selector, field+))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class UniqueElement extends AbstractCompositeElement
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
     * Returns the "selector" element.
     * 
     * @return  SelectorElement|NULL    The instance of the element if it has been set, otherwise NULL.
     */
    public function getSelectorElement()
    {
        return $this->getChildElement(1);
    }
    
    /**
     * Sets the "selector" element.
     * 
     * @param   SelectorElement $element    The element to set.
     */
    public function setSelectorElement(SelectorElement $element)
    {
        $this->setChildElement(1, $element);
    }
    
    /**
     * Indicates whether a "selector" element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasSelectorElement():bool
    {
        return $this->isChildElementSet(1);
    }
    
    /**
     * Adds a "field" element to this element.
     * 
     * @param   FieldElement    $element    The element to add.
     */
    public function addFieldElement(FieldElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "field" child elements.
     * 
     * @return  FieldElement[]  An indexed array of FieldElement instances.
     */
    public function getFieldElements():array
    {
        return $this->getChildElementsByType(2, FieldElement::class);
    }
}
