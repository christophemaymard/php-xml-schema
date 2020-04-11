<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "restriction" element held in the XML schema 
 * "simpleContent" element ({@see PhpXmlSchema\Dom\SimpleContentElement}).
 * 
 * Attributes (version 1.0):
 * - base = QName
 * - id = ID
 * 
 * Content (version 1.0):
 * (annotation?, (simpleType?, (minExclusive | minInclusive | maxExclusive | maxInclusive | totalDigits | fractionDigits | length | minLength | maxLength | enumeration | whiteSpace | pattern)*)?, ((attribute | attributeGroup)*, anyAttribute?))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleContentRestrictionElement extends AbstractValueRestrictionElement implements
    SimpleContentDerivationElementInterface
{
    /**
     * {@inheritDoc}
     */
    public function getElementId(): int
    {
        return ElementId::ELT_SIMPLECONTENT_RESTRICTION;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName(): string
    {
        return 'restriction';
    }
    
    /**
     * {@inheritDoc}
     */
    public function addAttributeElement(AttributeElement $element): void
    {
        $this->addChildElement(3, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getAttributeElements(): array
    {
        return $this->getChildElementsByType(3, AttributeElement::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function addAttributeGroupElement(AttributeGroupElement $element): void
    {
        $this->addChildElement(3, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getAttributeGroupElements(): array
    {
        return $this->getChildElementsByType(3, AttributeGroupElement::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getAttributeDeclarationElements(): array
    {
        return $this->getChildElementsByType(3, AttributeDeclarationElementInterface::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getAnyAttributeElement(): ?AnyAttributeElement
    {
        return $this->getChildElement(4);
    }
    
    /**
     * {@inheritDoc}
     */
    public function setAnyAttributeElement(AnyAttributeElement $element): void
    {
        $this->setChildElement(4, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function hasAnyAttributeElement(): bool
    {
        return $this->isChildElementSet(4);
    }
}
