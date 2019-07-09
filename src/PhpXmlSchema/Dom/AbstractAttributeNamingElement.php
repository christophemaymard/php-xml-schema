<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the base class for a XML schema element that provides for 
 * naming a group of attribute declarations ({@see PhpXmlSchema\Dom\AttributeElement} 
 * and {@see PhpXmlSchema\Dom\AttributeGroupElement}) and an attribute 
 * wildcard ({@see PhpXmlSchema\Dom\AnyAttributeElement}) for use by 
 * reference.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractAttributeNamingElement extends AbstractAnnotatedElement implements AttributeNamingElementInterface
{
    /**
     * {@inheritDoc}
     */
    public function addAttributeElement(AttributeElement $element)
    {
        $this->addChildElement(3, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getAttributeElements():array
    {
        return $this->getChildElementsByType(3, AttributeElement::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function addAttributeGroupElement(AttributeGroupElement $element)
    {
        $this->addChildElement(3, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getAttributeGroupElements():array
    {
        return $this->getChildElementsByType(3, AttributeGroupElement::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getAttributeDeclarationElements():array
    {
        return $this->getChildElementsByType(3, AttributeDeclarationElementInterface::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getAnyAttributeElement()
    {
        return $this->getChildElement(4);
    }
    
    /**
     * {@inheritDoc}
     */
    public function setAnyAttributeElement(AnyAttributeElement $element)
    {
        $this->setChildElement(4, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function hasAnyAttributeElement():bool
    {
        return $this->isChildElementSet(4);
    }
}
