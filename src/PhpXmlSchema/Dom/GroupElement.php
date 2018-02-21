<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "group" element.
 * 
 * Content (version 1.0):
 * (annotation?, (all | choice | sequence)?)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class GroupElement extends AbstractAnnotatedElement implements ParticleElementInterface
{
}
