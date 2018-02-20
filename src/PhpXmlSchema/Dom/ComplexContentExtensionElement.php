<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "extension" element held in the XML schema 
 * "complexContent" element ({@see PhpXmlSchema\Dom\ComplexContentElement}).
 * 
 * Content (version 1.0):
 * (annotation?, (group | all | choice | sequence)?, ((attribute | attributeGroup)*, anyAttribute?))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ComplexContentExtensionElement extends AbstractCompositeElement
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
}
