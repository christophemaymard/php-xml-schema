<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "restriction" element held in the XML schema 
 * "complexContent" element ({@see PhpXmlSchema\Dom\ComplexContentElement}).
 * 
 * Content (version 1.0):
 * (annotation?, (group | all | choice | sequence)?, ((attribute | attributeGroup)*, anyAttribute?))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ComplexContentRestrictionElement extends AbstractTypeNamingElement implements
    ComplexContentDerivationElementInterface
{
}
