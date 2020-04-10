<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "minInclusive" element.
 * 
 * Attributes (version 1.0):
 * - fixed = boolean
 * - id = ID
 * - value = anySimpleType
 * 
 * Content (version 1.0):
 * (annotation?)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class MinInclusiveElement extends AbstractAnyFacetElement
{
    /**
     * {@inheritDoc}
     */
    public function getElementId():int
    {
        return ElementId::ELT_MININCLUSIVE;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName():string
    {
        return 'minInclusive';
    }
}
