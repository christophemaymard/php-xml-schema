<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "fractionDigits" element.
 * 
 * Attributes (version 1.0):
 * - fixed = boolean
 * - id = ID
 * - value = nonNegativeInteger
 * 
 * Content (version 1.0):
 * (annotation?)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class FractionDigitsElement extends AbstractNumericFacetElement
{
    /**
     * {@inheritDoc}
     */
    public function getElementId():int
    {
        return ElementId::ELT_FRACTIONDIGITS;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName():string
    {
        return 'fractionDigits';
    }
}
