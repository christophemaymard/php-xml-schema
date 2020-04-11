<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\NonNegativeIntegerType;

/**
 * Represents the base class for a XML schema element that specifies an 
 * interpretation of the particles base on:
 * - "element" elements ({@see PhpXmlSchema\Dom\ElementElement})
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractModelGroupElement extends AbstractAnnotatedElement implements 
    ModelGroupElementInterface,
    ParticleElementInterface, 
    TypeDefinitionParticleElementInterface
{
    /**
     * The value of the "maxOccurs" attribute.
     * @var NonNegativeIntegerLimitType|NULL
     */
    private $maxOccursAttr;
    
    /**
     * The value of the "minOccurs" attribute.
     * @var NonNegativeIntegerType|NULL
     */
    private $minOccursAttr;
    
    /**
     * {@inheritDoc}
     */
    public function getMaxOccurs(): ?NonNegativeIntegerLimitType
    {
        return $this->maxOccursAttr;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setMaxOccurs(NonNegativeIntegerLimitType $value): void
    {
        $this->maxOccursAttr = $value;
    }
    
    /**
     * {@inheritDoc}
     */
    public function hasMaxOccurs(): bool
    {
        return $this->maxOccursAttr !== NULL;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getMinOccurs(): ?NonNegativeIntegerType
    {
        return $this->minOccursAttr;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setMinOccurs(NonNegativeIntegerType $value): void
    {
        $this->minOccursAttr = $value;
    }
    
    /**
     * {@inheritDoc}
     */
    public function hasMinOccurs(): bool
    {
        return $this->minOccursAttr !== NULL;
    }
    
    /**
     * {@inheritDoc}
     */
    public function addElementElement(ElementElement $element): void
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getElementElements(): array
    {
        return $this->getChildElementsByType(1, ElementElement::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getParticleElements(): array
    {
        return $this->getChildElementsByType(1, ParticleElementInterface::class);
    }
}