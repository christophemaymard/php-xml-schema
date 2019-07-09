<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\QNameType;

/**
 * Represents the base class for a XML schema element that is a derivation 
 * by restriction and constrains the value space of a datatype with a set of 
 * facets ({@see PhpXmlSchema\Dom\FacetElementInterface}).
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractValueRestrictionElement extends AbstractSimpleTypedElement implements
    ValueRestrictionElementInterface
{
    /**
     * The value of the "base" attribute.
     * @var QNameType|NULL
     */
    private $baseAttr;
    
    /**
     * Returns the value of the "base" attribute.
     * 
     * @return  QNameType|NULL  The value of the attribute if it has been set, otherwise NULL.
     */
    public function getBase()
    {
        return $this->baseAttr;
    }
    
    /**
     * Sets the value of the "base" attribute.
     * 
     * @param   QNameType   $value  The value to set.
     */
    public function setBase(QNameType $value)
    {
        $this->baseAttr = $value;
    }
    
    /**
     * Indicates whether the "base" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasBase():bool
    {
        return $this->baseAttr !== NULL;
    }
    
    /**
     * {@inheritDoc}
     */
    public function addMinExclusiveElement(MinExclusiveElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getMinExclusiveElements():array
    {
        return $this->getChildElementsByType(2, MinExclusiveElement::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function addMinInclusiveElement(MinInclusiveElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getMinInclusiveElements():array
    {
        return $this->getChildElementsByType(2, MinInclusiveElement::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function addMaxExclusiveElement(MaxExclusiveElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getMaxExclusiveElements():array
    {
        return $this->getChildElementsByType(2, MaxExclusiveElement::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function addMaxInclusiveElement(MaxInclusiveElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getMaxInclusiveElements():array
    {
        return $this->getChildElementsByType(2, MaxInclusiveElement::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function addTotalDigitsElement(TotalDigitsElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getTotalDigitsElements():array
    {
        return $this->getChildElementsByType(2, TotalDigitsElement::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function addFractionDigitsElement(FractionDigitsElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getFractionDigitsElements():array
    {
        return $this->getChildElementsByType(2, FractionDigitsElement::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function addLengthElement(LengthElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLengthElements():array
    {
        return $this->getChildElementsByType(2, LengthElement::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function addMinLengthElement(MinLengthElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getMinLengthElements():array
    {
        return $this->getChildElementsByType(2, MinLengthElement::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function addMaxLengthElement(MaxLengthElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getMaxLengthElements():array
    {
        return $this->getChildElementsByType(2, MaxLengthElement::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function addEnumerationElement(EnumerationElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getEnumerationElements():array
    {
        return $this->getChildElementsByType(2, EnumerationElement::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function addWhiteSpaceElement(WhiteSpaceElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getWhiteSpaceElements():array
    {
        return $this->getChildElementsByType(2, WhiteSpaceElement::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function addPatternElement(PatternElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getPatternElements():array
    {
        return $this->getChildElementsByType(2, PatternElement::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getFacetElements():array
    {
        return $this->getChildElementsByType(2, FacetElementInterface::class);
    }
}