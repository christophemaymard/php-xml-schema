<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the base class for a XML schema element that provides for 
 * naming a type definition particle ({@see PhpXmlSchema\Dom\GroupElement}, 
 * {@see PhpXmlSchema\Dom\AllElement}, {@see PhpXmlSchema\Dom\ChoiceElement} 
 * and {@see PhpXmlSchema\Dom\SequenceElement}), a group of attribute 
 * declarations ({@see PhpXmlSchema\Dom\AttributeElement} and 
 * {@see PhpXmlSchema\Dom\AttributeGroupElement}) and an attribute wildcard 
 * ({@see PhpXmlSchema\Dom\AnyAttributeElement}) for use by reference.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractTypeNamingElement extends AbstractAttributeNamingElement implements 
    TypeNamingElementInterface
{
    /**
     * {@inheritDoc}
     */
    public function getTypeDefinitionParticleElement(): ?TypeDefinitionParticleElementInterface
    {
        return $this->getChildElement(2);
    }
    
    /**
     * {@inheritDoc}
     */
    public function setTypeDefinitionParticleElement(TypeDefinitionParticleElementInterface $element): void
    {
        $this->setChildElement(2, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function hasTypeDefinitionParticleElement(): bool
    {
        return $this->isChildElementSet(2);
    }
}
