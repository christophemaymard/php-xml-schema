<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "schema" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * 
 * Content (version 1.0):
 * ((include | import | redefine | annotation)*, (((simpleType | complexType | group | attributeGroup) | element | attribute | notation), annotation*)*)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SchemaElement extends AbstractCompositeElement
{
    /**
     * Adds an "include" element to this element.
     * 
     * @param   IncludeElement  $element    The element to add.
     */
    public function addIncludeElement(IncludeElement $element)
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "include" child elements.
     * 
     * @return  IncludeElement[]    An indexed array of IncludeElement instances.
     */
    public function getIncludeElements():array
    {
        return $this->getChildElementsByType(0, IncludeElement::class);
    }
    
    /**
     * Adds an "import" element to this element.
     * 
     * @param   ImportElement   $element    The element to add.
     */
    public function addImportElement(ImportElement $element)
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "import" child elements.
     * 
     * @return  ImportElement[] An indexed array of ImportElement instances.
     */
    public function getImportElements():array
    {
        return $this->getChildElementsByType(0, ImportElement::class);
    }
    
    /**
     * Adds a "redefine" element to this element.
     * 
     * @param   RedefineElement $element    The element to add.
     */
    public function addRedefineElement(RedefineElement $element)
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "redefine" child elements.
     * 
     * @return  RedefineElement[]   An indexed array of RedefineElement instances.
     */
    public function getRedefineElements():array
    {
        return $this->getChildElementsByType(0, RedefineElement::class);
    }
    
    /**
     * Adds an "annotation" element to this element.
     * 
     * @param   AnnotationElement   $element    The element to add.
     */
    public function addCompositionAnnotationElement(AnnotationElement $element)
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "annotation" child elements.
     * 
     * @return  AnnotationElement[] An indexed array of AnnotationElement instances.
     */
    public function getCompositionAnnotationElements():array
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
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "simpleType" child elements.
     * 
     * @return  SimpleTypeElement[] An indexed array of SimpleTypeElement instances.
     */
    public function getSimpleTypeElements():array
    {
        return $this->getChildElementsByType(1, SimpleTypeElement::class);
    }
    
    /**
     * Adds a "complexType" element to this element.
     * 
     * @param   ComplexTypeElement  $element    The element to add.
     */
    public function addComplexTypeElement(ComplexTypeElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "complexType" child elements.
     * 
     * @return  ComplexTypeElement[]    An indexed array of ComplexTypeElement instances.
     */
    public function getComplexTypeElements():array
    {
        return $this->getChildElementsByType(1, ComplexTypeElement::class);
    }
    
    /**
     * Adds a "group" element to this element.
     * 
     * @param   GroupElement    $element    The element to add.
     */
    public function addGroupElement(GroupElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "group" child elements.
     * 
     * @return  GroupElement[]  An indexed array of GroupElement instances.
     */
    public function getGroupElements():array
    {
        return $this->getChildElementsByType(1, GroupElement::class);
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
     * Adds an "element" element to this element.
     * 
     * @param   ElementElement  $element    The element to add.
     */
    public function addElementElement(ElementElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "element" child elements.
     * 
     * @return  ElementElement[]    An indexed array of ElementElement instances.
     */
    public function getElementElements():array
    {
        return $this->getChildElementsByType(1, ElementElement::class);
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
     * Adds a "notation" element to this element.
     * 
     * @param   NotationElement $element    The element to add.
     */
    public function addNotationElement(NotationElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "notation" child elements.
     * 
     * @return  NotationElement[]   An indexed array of NotationElement instances.
     */
    public function getNotationElements():array
    {
        return $this->getChildElementsByType(1, NotationElement::class);
    }
    
    /**
     * Adds a "annotation" element to this element.
     * 
     * @param   AnnotationElement   $element    The element to add.
     */
    public function addDefinitionAnnotationElement(AnnotationElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "annotation" child elements.
     * 
     * @return  AnnotationElement[] An indexed array of AnnotationElement instances.
     */
    public function getDefinitionAnnotationElements():array
    {
        return $this->getChildElementsByType(1, AnnotationElement::class);
    }
}
