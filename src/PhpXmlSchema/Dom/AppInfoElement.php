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
 * Represents the XML schema "appinfo" element.
 * 
 * Attributes (version 1.0):
 * - source = anyURI
 * 
 * Content (version 1.0):
 * ({any}*)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AppInfoElement extends AbstractLeafElement
{
    /**
     * The value of the "source" attribute.
     * @var AnyUriType|NULL
     */
    private $sourceAttr;
    
    /**
     * {@inheritDoc}
     */
    public function getElementId(): int
    {
        return ElementId::ELT_APPINFO;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName(): string
    {
        return 'appinfo';
    }
    
    /**
     * Returns the value of the "source" attribute.
     * 
     * @return  AnyUriType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getSource(): ?AnyUriType
    {
        return $this->sourceAttr;
    }
    
    /**
     * Sets the value of the "source" attribute.
     * 
     * @param   AnyUriType  $value  The value to set.
     */
    public function setSource(AnyUriType $value): void
    {
        $this->sourceAttr = $value;
    }
    
    /**
     * Indicates whether the "source" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasSource(): bool
    {
        return $this->sourceAttr !== NULL;
    }
}
