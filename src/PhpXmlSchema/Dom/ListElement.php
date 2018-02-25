<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "list" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * 
 * Content (version 1.0):
 * (annotation?, simpleType?)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ListElement extends AbstractSimpleTypedElement implements SimpleTypeDerivationElementInterface
{
}
