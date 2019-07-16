<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "restriction" element held in the XML schema 
 * "simpleType" element ({@see PhpXmlSchema\Dom\SimpleTypeElement}).
 * 
 * Attributes (version 1.0):
 * - base = QName
 * - id = ID
 * 
 * Content (version 1.0):
 * (annotation?, (simpleType?, (minExclusive | minInclusive | maxExclusive | maxInclusive | totalDigits | fractionDigits | length | minLength | maxLength | enumeration | whiteSpace | pattern)*))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleTypeRestrictionElement extends AbstractValueRestrictionElement implements SimpleTypeDerivationElementInterface
{
    /**
     * {@inheritDoc}
     */
    public function getElementId():int
    {
        return ElementId::ELT_SIMPLETYPE_RESTRICTION;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName():string
    {
        return 'restriction';
    }
}
