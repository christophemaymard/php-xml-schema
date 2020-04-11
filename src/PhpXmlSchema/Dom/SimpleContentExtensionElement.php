<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\QNameType;

/**
 * Represents the XML schema "extension" element held in the XML schema  
 * "simpleContent" element ({@see PhpXmlSchema\Dom\SimpleContentElement}).
 * 
 * Attributes (version 1.0):
 * - base = QName
 * - id = ID
 * 
 * Content (version 1.0):
 * (annotation?, ((attribute | attributeGroup)*, anyAttribute?))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleContentExtensionElement extends AbstractAttributeNamingElement implements
    SimpleContentDerivationElementInterface
{
    /**
     * The value of the "base" attribute.
     * @var QNameType|NULL
     */
    private $baseAttr;
    
    /**
     * {@inheritDoc}
     */
    public function getElementId(): int
    {
        return ElementId::ELT_SIMPLECONTENT_EXTENSION;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName(): string
    {
        return 'extension';
    }
    
    /**
     * Returns the value of the "base" attribute.
     * 
     * @return  QNameType|NULL  The value of the attribute if it has been set, otherwise NULL.
     */
    public function getBase(): ?QNameType
    {
        return $this->baseAttr;
    }
    
    /**
     * Sets the value of the "base" attribute.
     * 
     * @param   QNameType   $value  The value to set.
     */
    public function setBase(QNameType $value): void
    {
        $this->baseAttr = $value;
    }
    
    /**
     * Indicates whether the "base" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasBase(): bool
    {
        return $this->baseAttr !== NULL;
    }
}
