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
 * Represents the XML schema "any" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * - maxOccurs = (nonNegativeInteger | unbounded)
 * - minOccurs = nonNegativeInteger
 * - namespace = ((##any | ##other) | List of (anyURI | (##targetNamespace | ##local))) : ##any
 * - processContents = (lax | skip | strict)
 * 
 * Content (version 1.0):
 * (annotation?)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AnyElement extends AbstractAnnotatedElement implements ParticleElementInterface
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
     * The value of the "namespace" attribute.
     * @var NamespaceListType|NULL
     */
    private $namespaceAttr;
    
    /**
     * The value of the "processContents" attribute.
     * @var ProcessingModeType|NULL
     */
    private $processContentsAttr;
    
    /**
     * {@inheritDoc}
     */
    public function getElementId(): int
    {
        return ElementId::ELT_ANY;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName(): string
    {
        return 'any';
    }
    
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
     * Returns the value of the "namespace" attribute.
     * 
     * @return  NamespaceListType|NULL  The value of the attribute if it has been set, otherwise NULL.
     */
    public function getNamespace(): ?NamespaceListType
    {
        return $this->namespaceAttr;
    }
    
    /**
     * Sets the value of the "namespace" attribute.
     * 
     * @param   NamespaceListType   $value  The value to set.
     */
    public function setNamespace(NamespaceListType $value): void
    {
        $this->namespaceAttr = $value;
    }
    
    /**
     * Indicates whether the "namespace" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasNamespace(): bool
    {
        return $this->namespaceAttr !== NULL;
    }
    
    /**
     * Returns the value of the "processContents" attribute.
     * 
     * @return  ProcessingModeType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getProcessContents(): ?ProcessingModeType
    {
        return $this->processContentsAttr;
    }
    
    /**
     * Sets the value of the "processContents" attribute.
     * 
     * @param   ProcessingModeType  $value  The value to set.
     */
    public function setProcessContents(ProcessingModeType $value): void
    {
        $this->processContentsAttr = $value;
    }
    
    /**
     * Indicates whether the "processContents" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasProcessContents(): bool
    {
        return $this->processContentsAttr !== NULL;
    }
}
