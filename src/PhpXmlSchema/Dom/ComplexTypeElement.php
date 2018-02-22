<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "complexType" element.
 * 
 * Content (version 1.0):
 * (annotation?, (simpleContent | complexContent | ((group | all | choice | sequence)?, ((attribute | attributeGroup)*, anyAttribute?))))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ComplexTypeElement extends AbstractTypeNamingElement implements TypeElementInterface
{
    /**
     * Returns the content element.
     * 
     * @return  ContentElementInterface|NULL    The instance of the element if it has been set, otherwise NULL.
     */
    public function getContentElement()
    {
        return $this->getChildElement(1);
    }
    
    /**
     * Sets the content element.
     * 
     * @param   ContentElementInterface $element    The element to set.
     */
    public function setContentElement(ContentElementInterface $element)
    {
        $this->setChildElement(1, $element);
    }
    
    /**
     * Indicates whether a content element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasContentElement():bool
    {
        return $this->isChildElementSet(1);
    }
}
