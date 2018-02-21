<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "attributeGroup" element.
 * 
 * Content (version 1.0):
 * (annotation?, ((attribute | attributeGroup)*, anyAttribute?))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AttributeGroupElement extends AbstractCompositeElement implements AttributeDeclarationElementInterface
{
    /**
     * {@inheritDoc}
     */
    public function getAnnotationElement()
    {
        return $this->getChildElement(0);
    }
    
    /**
     * {@inheritDoc}
     */
    public function setAnnotationElement(AnnotationElement $element)
    {
        $this->setChildElement(0, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function hasAnnotationElement():bool
    {
        return $this->isChildElementSet(0);
    }
    
    /**
     * Adds an "attribute" element to this element.
     * 
     * @param   AttributeElement    $element    The element to add.
     */
    public function addAttributeElement(AttributeElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "attribute" child elements.
     * 
     * @return  AttributeElement[]  An indexed array of AttributeElement instances.
     */
    public function getAttributeElements():array
    {
        return $this->getChildElementsByType(1, AttributeElement::class);
    }
    
    /**
     * Adds an "attributeGroup" element to this element.
     * 
     * @param   AttributeGroupElement   $element    The element to add.
     */
    public function addAttributeGroupElement(AttributeGroupElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "attributeGroup" child elements.
     * 
     * @return  AttributeGroupElement[] An indexed array of AttributeGroupElement instances.
     */
    public function getAttributeGroupElements():array
    {
        return $this->getChildElementsByType(1, AttributeGroupElement::class);
    }
    
    /**
     * Returns all the attribute declaration child elements.
     * 
     * @return  AttributeDeclarationElementInterface[]  An indexed array of AttributeDeclarationElementInterface instances.
     */
    public function getAttributeDeclarationElements():array
    {
        return $this->getChildElementsByType(1, AttributeDeclarationElementInterface::class);
    }
}
