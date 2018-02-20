<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "element" element.
 * 
 * Content (version 1.0):
 * (annotation?, ((simpleType | complexType)?, (unique | key | keyref)*))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ElementElement extends AbstractAnnotatedElement
{
    /**
     * Returns the type element.
     * 
     * @return  TypeElementInterface|NULL   The instance of the element if it has been set, otherwise NULL.
     */
    public function getTypeElement()
    {
        return $this->getChildElement(1);
    }
    
    /**
     * Sets the type element.
     * 
     * @param   TypeElementInterface    $element    The element to set.
     */
    public function setTypeElement(TypeElementInterface $element)
    {
        $this->setChildElement(1, $element);
    }
    
    /**
     * Indicates whether a type element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasTypeElement():bool
    {
        return $this->isChildElementSet(1);
    }
}
