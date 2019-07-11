<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Interface for a XML schema element.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface ElementInterface
{
    /**
     * Returns the local name of this element.
     * 
     * @return  string
     */
    public function getLocalName():string;
}
