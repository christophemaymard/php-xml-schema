<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\AnyUriType;

/**
 * Represents the XML schema "redefine" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * - schemaLocation = anyURI
 * 
 * Content (version 1.0):
 * (annotation | (simpleType | complexType | group | attributeGroup))*
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class RedefineElement extends AbstractCompositeElement
{
    /**
     * The value of the "schemaLocation" attribute.
     * @var AnyUriType|NULL
     */
    private $schemaLocationAttr;
    
    /**
     * {@inheritDoc}
     */
    public function getElementId(): int
    {
        return ElementId::ELT_REDEFINE;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName(): string
    {
        return 'redefine';
    }
    
    /**
     * Returns the value of the "schemaLocation" attribute.
     * 
     * @return  AnyUriType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getSchemaLocation(): ?AnyUriType
    {
        return $this->schemaLocationAttr;
    }
    
    /**
     * Sets the value of the "schemaLocation" attribute.
     * 
     * @param   AnyUriType  $value  The value to set.
     */
    public function setSchemaLocation(AnyUriType $value): void
    {
        $this->schemaLocationAttr = $value;
    }
    
    /**
     * Indicates whether the "schemaLocation" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasSchemaLocation(): bool
    {
        return $this->schemaLocationAttr !== NULL;
    }
    
    /**
     * Adds an "annotation" element to this element.
     * 
     * @param   AnnotationElement   $element    The element to add.
     */
    public function addAnnotationElement(AnnotationElement $element): void
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "annotation" child elements.
     * 
     * @return  AnnotationElement[] An indexed array of AnnotationElement instances.
     */
    public function getAnnotationElements(): array
    {
        return $this->getChildElementsByType(0, AnnotationElement::class);
    }
    
    /**
     * Adds a "simpleType" element to this element.
     * 
     * @param   SimpleTypeElement   $element    The element to add.
     */
    public function addSimpleTypeElement(SimpleTypeElement $element): void
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "simpleType" child elements.
     * 
     * @return  SimpleTypeElement[] An indexed array of SimpleTypeElement instances.
     */
    public function getSimpleTypeElements(): array
    {
        return $this->getChildElementsByType(0, SimpleTypeElement::class);
    }
    
    /**
     * Adds a "complexType" element to this element.
     * 
     * @param   ComplexTypeElement  $element    The element to add.
     */
    public function addComplexTypeElement(ComplexTypeElement $element): void
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "complexType" child elements.
     * 
     * @return  ComplexTypeElement[]    An indexed array of ComplexTypeElement instances.
     */
    public function getComplexTypeElements(): array
    {
        return $this->getChildElementsByType(0, ComplexTypeElement::class);
    }
    
    /**
     * Adds a "group" element to this element.
     * 
     * @param   GroupElement    $element    The element to add.
     */
    public function addGroupElement(GroupElement $element): void
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "group" child elements.
     * 
     * @return  GroupElement[]  An indexed array of GroupElement instances.
     */
    public function getGroupElements(): array
    {
        return $this->getChildElementsByType(0, GroupElement::class);
    }
    
    /**
     * Adds an "attributeGroup" element to this element.
     * 
     * @param   AttributeGroupElement   $element    The element to add.
     */
    public function addAttributeGroupElement(AttributeGroupElement $element): void
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "attributeGroup" child elements.
     * 
     * @return  AttributeGroupElement[] An indexed array of AttributeGroupElement instances.
     */
    public function getAttributeGroupElements(): array
    {
        return $this->getChildElementsByType(0, AttributeGroupElement::class);
    }
}
