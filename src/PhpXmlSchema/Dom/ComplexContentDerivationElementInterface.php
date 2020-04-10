<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Interface for a XML schema element that represents a derivation in the 
 * "complexContent" element ({@see PhpXmlSchema\Dom\ComplexContentElement}).
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface ComplexContentDerivationElementInterface extends
    AnnotatedElementInterface,
    TypeNamingElementInterface
{
}
