<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "choice" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * - maxOccurs = (nonNegativeInteger | unbounded)
 * - minOccurs = nonNegativeInteger
 * 
 * Content (version 1.0):
 * (annotation?, (element | group | choice | sequence | any)*)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ChoiceElement extends AbstractExplicitModelGroupElement
{
}
