<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "maxExclusive" element.
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
class MaxExclusiveElement extends AbstractAnyFacetElement
{
    /**
     * {@inheritDoc}
     */
    public function getLocalName():string
    {
        return 'maxExclusive';
    }
}
