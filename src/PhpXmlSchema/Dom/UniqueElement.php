<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "unique" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * - name = NCName
 * 
 * Content (version 1.0):
 * (annotation?, (selector, field+))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class UniqueElement extends AbstractIdentityConstraintElement
{
    /**
     * {@inheritDoc}
     */
    public function getElementId(): int
    {
        return ElementId::ELT_UNIQUE;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName(): string
    {
        return 'unique';
    }
}
