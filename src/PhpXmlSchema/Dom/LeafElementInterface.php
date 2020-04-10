<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Interface for a XML schema element that contains a value as content.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface LeafElementInterface extends ElementInterface
{
    /**
     * Returns the content of this element.
     * 
     * @return  string
     */
    public function getContent():string;
    
    /**
     * Sets the content of this element.
     * 
     * @param   string  $content    The content to set.
     */
    public function setContent(string $content);    
}
