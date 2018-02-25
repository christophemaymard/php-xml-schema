<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "redefine" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * 
 * Content (version 1.0):
 * (annotation | (simpleType | complexType | group | attributeGroup))*
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class RedefineElement extends AbstractCompositeElement
{
    /**
     * Adds an "annotation" element to this element.
     * 
     * @param   AnnotationElement   $element    The element to add.
     */
    public function addAnnotationElement(AnnotationElement $element)
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "annotation" child elements.
     * 
     * @return  AnnotationElement[] An indexed array of AnnotationElement instances.
     */
    public function getAnnotationElements():array
    {
        return $this->getChildElementsByType(0, AnnotationElement::class);
    }
    
    /**
     * Adds a "simpleType" element to this element.
     * 
     * @param   SimpleTypeElement   $element    The element to add.
     */
    public function addSimpleTypeElement(SimpleTypeElement $element)
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "simpleType" child elements.
     * 
     * @return  SimpleTypeElement[] An indexed array of SimpleTypeElement instances.
     */
    public function getSimpleTypeElements():array
    {
        return $this->getChildElementsByType(0, SimpleTypeElement::class);
    }
    
    /**
     * Adds a "complexType" element to this element.
     * 
     * @param   ComplexTypeElement  $element    The element to add.
     */
    public function addComplexTypeElement(ComplexTypeElement $element)
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "complexType" child elements.
     * 
     * @return  ComplexTypeElement[]    An indexed array of ComplexTypeElement instances.
     */
    public function getComplexTypeElements():array
    {
        return $this->getChildElementsByType(0, ComplexTypeElement::class);
    }
    
    /**
     * Adds a "group" element to this element.
     * 
     * @param   GroupElement    $element    The element to add.
     */
    public function addGroupElement(GroupElement $element)
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "group" child elements.
     * 
     * @return  GroupElement[]  An indexed array of GroupElement instances.
     */
    public function getGroupElements():array
    {
        return $this->getChildElementsByType(0, GroupElement::class);
    }
    
    /**
     * Adds an "attributeGroup" element to this element.
     * 
     * @param   AttributeGroupElement   $element    The element to add.
     */
    public function addAttributeGroupElement(AttributeGroupElement $element)
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "attributeGroup" child elements.
     * 
     * @return  AttributeGroupElement[] An indexed array of AttributeGroupElement instances.
     */
    public function getAttributeGroupElements():array
    {
        return $this->getChildElementsByType(0, AttributeGroupElement::class);
    }
}
