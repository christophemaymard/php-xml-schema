<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Interface for a XML schema element that is a derivation by restriction and 
 * constrains the value space of a datatype with a set of facets 
 * ({@see PhpXmlSchema\Dom\FacetElementInterface}).
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface ValueRestrictionElementInterface extends SimpleTypedElementInterface
{
    /**
     * Adds a "minExclusive" element to this element.
     * 
     * @param   MinExclusiveElement $element    The element to add.
     */
    public function addMinExclusiveElement(MinExclusiveElement $element);
    
    /**
     * Returns all the "minExclusive" child elements.
     * 
     * @return  MinExclusiveElement[]   An indexed array of MinExclusiveElement instances.
     */
    public function getMinExclusiveElements():array;
    
    /**
     * Adds a "minInclusive" element to this element.
     * 
     * @param   MinInclusiveElement $element    The element to add.
     */
    public function addMinInclusiveElement(MinInclusiveElement $element);
    
    /**
     * Returns all the "minInclusive" child elements.
     * 
     * @return  MinInclusiveElement[]   An indexed array of MinInclusiveElement instances.
     */
    public function getMinInclusiveElements():array;
    
    /**
     * Adds a "maxExclusive" element to this element.
     * 
     * @param   MaxExclusiveElement $element    The element to add.
     */
    public function addMaxExclusiveElement(MaxExclusiveElement $element);
    
    /**
     * Returns all the "maxExclusive" child elements.
     * 
     * @return  MaxExclusiveElement[]   An indexed array of MaxExclusiveElement instances.
     */
    public function getMaxExclusiveElements():array;
    
    /**
     * Adds a "maxInclusive" element to this element.
     * 
     * @param   MaxInclusiveElement $element    The element to add.
     */
    public function addMaxInclusiveElement(MaxInclusiveElement $element);
    
    /**
     * Returns all the "maxInclusive" child elements.
     * 
     * @return  MaxInclusiveElement[]   An indexed array of MaxInclusiveElement instances.
     */
    public function getMaxInclusiveElements():array;
    
    /**
     * Adds a "totalDigits" element to this element.
     * 
     * @param   TotalDigitsElement  $element    The element to add.
     */
    public function addTotalDigitsElement(TotalDigitsElement $element);
    
    /**
     * Returns all the "totalDigits" child elements.
     * 
     * @return  TotalDigitsElement[]    An indexed array of TotalDigitsElement instances.
     */
    public function getTotalDigitsElements():array;
    
    /**
     * Adds a "fractionDigits" element to this element.
     * 
     * @param   FractionDigitsElement   $element    The element to add.
     */
    public function addFractionDigitsElement(FractionDigitsElement $element);
    
    /**
     * Returns all the "fractionDigits" child elements.
     * 
     * @return  FractionDigitsElement[] An indexed array of FractionDigitsElement instances.
     */
    public function getFractionDigitsElements():array;
    
    /**
     * Adds a "length" element to this element.
     * 
     * @param   LengthElement   $element    The element to add.
     */
    public function addLengthElement(LengthElement $element);
    
    /**
     * Returns all the "length" child elements.
     * 
     * @return  LengthElement[] An indexed array of LengthElement instances.
     */
    public function getLengthElements():array;
    
    /**
     * Adds a "minLength" element to this element.
     * 
     * @param   MinLengthElement    $element    The element to add.
     */
    public function addMinLengthElement(MinLengthElement $element);
    
    /**
     * Returns all the "minLength" child elements.
     * 
     * @return  MinLengthElement[]  An indexed array of MinLengthElement instances.
     */
    public function getMinLengthElements():array;
    
    /**
     * Adds a "maxLength" element to this element.
     * 
     * @param   MaxLengthElement    $element    The element to add.
     */
    public function addMaxLengthElement(MaxLengthElement $element);
    
    /**
     * Returns all the "maxLength" child elements.
     * 
     * @return  MaxLengthElement[]  An indexed array of MaxLengthElement instances.
     */
    public function getMaxLengthElements():array;
    
    /**
     * Adds an "enumeration" element to this element.
     * 
     * @param   EnumerationElement  $element    The element to add.
     */
    public function addEnumerationElement(EnumerationElement $element);
    
    /**
     * Returns all the "enumeration" child elements.
     * 
     * @return  EnumerationElement[]    An indexed array of EnumerationElement instances.
     */
    public function getEnumerationElements():array;
    
    /**
     * Adds a "whiteSpace" element to this element.
     * 
     * @param   WhiteSpaceElement   $element    The element to add.
     */
    public function addWhiteSpaceElement(WhiteSpaceElement $element);
    
    /**
     * Returns all the "whiteSpace" child elements.
     * 
     * @return  WhiteSpaceElement[] An indexed array of WhiteSpaceElement instances.
     */
    public function getWhiteSpaceElements():array;
    
    /**
     * Adds a "pattern" element to this element.
     * 
     * @param   PatternElement  $element    The element to add.
     */
    public function addPatternElement(PatternElement $element);
    
    /**
     * Returns all the "pattern" child elements.
     * 
     * @return  PatternElement[]    An indexed array of PatternElement instances.
     */
    public function getPatternElements():array;
    
    /**
     * Returns all the facet child elements.
     * 
     * @return  FacetElementInterface[] An indexed array of FacetElementInterface instances.
     */
    public function getFacetElements():array;
}
