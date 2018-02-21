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
 * "simpleContent" element ({@see PhpXmlSchema\Dom\SimpleContentElement}).
 * 
 * Content (version 1.0):
 * (annotation?, (simpleType?, (minExclusive | minInclusive | maxExclusive | maxInclusive | totalDigits | fractionDigits | length | minLength | maxLength | enumeration | whiteSpace | pattern)*)?, ((attribute | attributeGroup)*, anyAttribute?))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleContentRestrictionElement extends AbstractValueRestrictionElement
{
    /**
     * Adds an "attribute" element to this element.
     * 
     * @param   AttributeElement    $element    The element to add.
     */
    public function addAttributeElement(AttributeElement $element)
    {
        $this->addChildElement(3, $element);
    }
    
    /**
     * Returns all the "attribute" child elements.
     * 
     * @return  AttributeElement[]  An indexed array of AttributeElement instances.
     */
    public function getAttributeElements():array
    {
        return $this->getChildElementsByType(3, AttributeElement::class);
    }
    
    /**
     * Adds an "attributeGroup" element to this element.
     * 
     * @param   AttributeGroupElement   $element    The element to add.
     */
    public function addAttributeGroupElement(AttributeGroupElement $element)
    {
        $this->addChildElement(3, $element);
    }
    
    /**
     * Returns all the "attributeGroup" child elements.
     * 
     * @return  AttributeGroupElement[] An indexed array of AttributeGroupElement instances.
     */
    public function getAttributeGroupElements():array
    {
        return $this->getChildElementsByType(3, AttributeGroupElement::class);
    }
    
    /**
     * Returns all the attribute declaration child elements.
     * 
     * @return  AttributeDeclarationElementInterface[]  An indexed array of AttributeDeclarationElementInterface instances.
     */
    public function getAttributeDeclarationElements():array
    {
        return $this->getChildElementsByType(3, AttributeDeclarationElementInterface::class);
    }
    
    /**
     * Returns the "anyAttribute" element.
     * 
     * @return  AnyAttributeElement|NULL    The instance of the element if it has been set, otherwise NULL.
     */
    public function getAnyAttributeElement()
    {
        return $this->getChildElement(4);
    }
    
    /**
     * Sets the "anyAttribute" element.
     * 
     * @param   AnyAttributeElement $element    The element to set.
     */
    public function setAnyAttributeElement(AnyAttributeElement $element)
    {
        $this->setChildElement(4, $element);
    }
    
    /**
     * Indicates whether an "anyAttribute" element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasAnyAttributeElement():bool
    {
        return $this->isChildElementSet(4);
    }
}
