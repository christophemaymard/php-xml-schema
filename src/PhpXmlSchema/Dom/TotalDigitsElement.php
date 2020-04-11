<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\PositiveIntegerType;

/**
 * Represents the XML schema "totalDigits" element.
 * 
 * Attributes (version 1.0):
 * - fixed = boolean
 * - id = ID
 * - value = positiveInteger
 * 
 * Content (version 1.0):
 * (annotation?)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TotalDigitsElement extends AbstractFixedFacetElement
{
    /**
     * The value of the "value" attribute.
     * @var PositiveIntegerType|NULL
     */
    private $valueAttr;
    
    /**
     * {@inheritDoc}
     */
    public function getElementId(): int
    {
        return ElementId::ELT_TOTALDIGITS;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName(): string
    {
        return 'totalDigits';
    }
    
    /**
     * Returns the value of the "value" attribute.
     * 
     * @return  PositiveIntegerType|NULL    The value of the attribute if it has been set, otherwise NULL.
     */
    public function getValue(): ?PositiveIntegerType
    {
        return $this->valueAttr;
    }
    
    /**
     * Sets the value of the "value" attribute.
     * 
     * @param   PositiveIntegerType $value  The value to set.
     */
    public function setValue(PositiveIntegerType $value): void
    {
        $this->valueAttr = $value;
    }
    
    /**
     * Indicates whether the "value" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasValue(): bool
    {
        return $this->valueAttr !== NULL;
    }
}
