<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "all" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * - maxOccurs = 1
 * - minOccurs = nonNegativeInteger
 * 
 * Content (version 1.0):
 * (annotation?, element*)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AllElement extends AbstractModelGroupElement
{
    /**
     * {@inheritDoc}
     */
    public function getElementId():int
    {
        return ElementId::ELT_ALL;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName():string
    {
        return 'all';
    }
}
