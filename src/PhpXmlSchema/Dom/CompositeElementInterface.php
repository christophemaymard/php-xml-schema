<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Interface for a XML schema element that contains a sequence of XML schema 
 * elements as content.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface CompositeElementInterface extends ElementInterface
{
    /**
     * Returns all the child elements that belong to this element.
     * 
     * @return  ElementInterface[]
     */
    public function getElements():array;
}
