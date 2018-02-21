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
class SimpleContentRestrictionElement extends AbstractCompositeElement
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
    
    /**
     * Returns the "simpleType" element.
     * 
     * @return  SimpleTypeElement|NULL  The instance of the element if it has been set, otherwise NULL.
     */
    public function getSimpleTypeElement()
    {
        return $this->getChildElement(1);
    }
    
    /**
     * Sets the "simpleType" element.
     * 
     * @param   SimpleTypeElement   $element    The element to set.
     */
    public function setSimpleTypeElement(SimpleTypeElement $element)
    {
        $this->setChildElement(1, $element);
    }
    
    /**
     * Indicates whether a "simpleType" element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasSimpleTypeElement():bool
    {
        return $this->isChildElementSet(1);
    }
    
    /**
     * Adds a "minExclusive" element to this element.
     * 
     * @param   MinExclusiveElement $element    The element to add.
     */
    public function addMinExclusiveElement(MinExclusiveElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "minExclusive" child elements.
     * 
     * @return  MinExclusiveElement[]   An indexed array of MinExclusiveElement instances.
     */
    public function getMinExclusiveElements():array
    {
        return $this->getChildElementsByType(2, MinExclusiveElement::class);
    }
    
    /**
     * Adds a "minInclusive" element to this element.
     * 
     * @param   MinInclusiveElement $element    The element to add.
     */
    public function addMinInclusiveElement(MinInclusiveElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "minInclusive" child elements.
     * 
     * @return  MinInclusiveElement[]   An indexed array of MinInclusiveElement instances.
     */
    public function getMinInclusiveElements():array
    {
        return $this->getChildElementsByType(2, MinInclusiveElement::class);
    }
    
    /**
     * Adds a "maxExclusive" element to this element.
     * 
     * @param   MaxExclusiveElement $element    The element to add.
     */
    public function addMaxExclusiveElement(MaxExclusiveElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "maxExclusive" child elements.
     * 
     * @return  MaxExclusiveElement[]   An indexed array of MaxExclusiveElement instances.
     */
    public function getMaxExclusiveElements():array
    {
        return $this->getChildElementsByType(2, MaxExclusiveElement::class);
    }
    
    /**
     * Adds a "maxInclusive" element to this element.
     * 
     * @param   MaxInclusiveElement $element    The element to add.
     */
    public function addMaxInclusiveElement(MaxInclusiveElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "maxInclusive" child elements.
     * 
     * @return  MaxInclusiveElement[]   An indexed array of MaxInclusiveElement instances.
     */
    public function getMaxInclusiveElements():array
    {
        return $this->getChildElementsByType(2, MaxInclusiveElement::class);
    }
    
    /**
     * Adds a "totalDigits" element to this element.
     * 
     * @param   TotalDigitsElement  $element    The element to add.
     */
    public function addTotalDigitsElement(TotalDigitsElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "totalDigits" child elements.
     * 
     * @return  TotalDigitsElement[]    An indexed array of TotalDigitsElement instances.
     */
    public function getTotalDigitsElements():array
    {
        return $this->getChildElementsByType(2, TotalDigitsElement::class);
    }
    
    /**
     * Adds a "fractionDigits" element to this element.
     * 
     * @param   FractionDigitsElement   $element    The element to add.
     */
    public function addFractionDigitsElement(FractionDigitsElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "fractionDigits" child elements.
     * 
     * @return  FractionDigitsElement[] An indexed array of FractionDigitsElement instances.
     */
    public function getFractionDigitsElements():array
    {
        return $this->getChildElementsByType(2, FractionDigitsElement::class);
    }
    
    /**
     * Adds a "length" element to this element.
     * 
     * @param   LengthElement   $element    The element to add.
     */
    public function addLengthElement(LengthElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "length" child elements.
     * 
     * @return  LengthElement[] An indexed array of LengthElement instances.
     */
    public function getLengthElements():array
    {
        return $this->getChildElementsByType(2, LengthElement::class);
    }
    
    /**
     * Adds a "minLength" element to this element.
     * 
     * @param   MinLengthElement    $element    The element to add.
     */
    public function addMinLengthElement(MinLengthElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "minLength" child elements.
     * 
     * @return  MinLengthElement[]  An indexed array of MinLengthElement instances.
     */
    public function getMinLengthElements():array
    {
        return $this->getChildElementsByType(2, MinLengthElement::class);
    }
    
    /**
     * Adds a "maxLength" element to this element.
     * 
     * @param   MaxLengthElement    $element    The element to add.
     */
    public function addMaxLengthElement(MaxLengthElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "maxLength" child elements.
     * 
     * @return  MaxLengthElement[]  An indexed array of MaxLengthElement instances.
     */
    public function getMaxLengthElements():array
    {
        return $this->getChildElementsByType(2, MaxLengthElement::class);
    }
    
    /**
     * Adds an "enumeration" element to this element.
     * 
     * @param   EnumerationElement  $element    The element to add.
     */
    public function addEnumerationElement(EnumerationElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "enumeration" child elements.
     * 
     * @return  EnumerationElement[]    An indexed array of EnumerationElement instances.
     */
    public function getEnumerationElements():array
    {
        return $this->getChildElementsByType(2, EnumerationElement::class);
    }
    
    /**
     * Adds a "whiteSpace" element to this element.
     * 
     * @param   WhiteSpaceElement   $element    The element to add.
     */
    public function addWhiteSpaceElement(WhiteSpaceElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "whiteSpace" child elements.
     * 
     * @return  WhiteSpaceElement[] An indexed array of WhiteSpaceElement instances.
     */
    public function getWhiteSpaceElements():array
    {
        return $this->getChildElementsByType(2, WhiteSpaceElement::class);
    }
    
    /**
     * Adds a "pattern" element to this element.
     * 
     * @param   PatternElement  $element    The element to add.
     */
    public function addPatternElement(PatternElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "pattern" child elements.
     * 
     * @return  PatternElement[]    An indexed array of PatternElement instances.
     */
    public function getPatternElements():array
    {
        return $this->getChildElementsByType(2, PatternElement::class);
    }
    
    /**
     * Returns all the facet child elements.
     * 
     * @return  FacetElementInterface[] An indexed array of FacetElementInterface instances.
     */
    public function getFacetElements():array
    {
        return $this->getChildElementsByType(2, FacetElementInterface::class);
    }
    
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
}
