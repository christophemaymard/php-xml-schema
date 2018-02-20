<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the base class for all the XML schema elements that contain a 
 * sequence of XML schema elements as content.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractCompositeElement implements CompositeElementInterface
{
    /**
     * {@inheritDoc}
     */
    public function getElements():array
    {
        return [];
    }
}
