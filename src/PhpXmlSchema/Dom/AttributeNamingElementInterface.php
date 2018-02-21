<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Interface for a XML schema element that provides for naming a group of 
 * attribute declarations ({@see PhpXmlSchema\Dom\AttributeElement} and 
 * {@see PhpXmlSchema\Dom\AttributeGroupElement}) and an attribute wildcard 
 * ({@see PhpXmlSchema\Dom\AnyAttributeElement}) for use by reference.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface AttributeNamingElementInterface extends AnnotatedElementInterface
{
    /**
     * Adds an "attribute" element to this element.
     * 
     * @param   AttributeElement    $element    The element to add.
     */
    public function addAttributeElement(AttributeElement $element);
    
    /**
     * Returns all the "attribute" child elements.
     * 
     * @return  AttributeElement[]  An indexed array of AttributeElement instances.
     */
    public function getAttributeElements():array;
    
    /**
     * Adds an "attributeGroup" element to this element.
     * 
     * @param   AttributeGroupElement   $element    The element to add.
     */
    public function addAttributeGroupElement(AttributeGroupElement $element);
    
    /**
     * Returns all the "attributeGroup" child elements.
     * 
     * @return  AttributeGroupElement[] An indexed array of AttributeGroupElement instances.
     */
    public function getAttributeGroupElements():array;
    
    /**
     * Returns all the attribute declaration child elements.
     * 
     * @return  AttributeDeclarationElementInterface[]  An indexed array of AttributeDeclarationElementInterface instances.
     */
    public function getAttributeDeclarationElements():array;
    
    /**
     * Returns the "anyAttribute" element.
     * 
     * @return  AnyAttributeElement|NULL    The instance of the element if it has been set, otherwise NULL.
     */
    public function getAnyAttributeElement();
    
    /**
     * Sets the "anyAttribute" element.
     * 
     * @param   AnyAttributeElement $element    The element to set.
     */
    public function setAnyAttributeElement(AnyAttributeElement $element);
    
    /**
     * Indicates whether an "anyAttribute" element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasAnyAttributeElement():bool;
}
