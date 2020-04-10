<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the base class for all the XML schema elements that contain a 
 * value as content.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractLeafElement extends AbstractElement implements LeafElementInterface
{
    /**
     * The content of the element (default to an empty string).
     * @var string
     */
    private $content = '';
    
    /**
     * {@inheritDoc}
     */
    public function getContent():string
    {
        return $this->content;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }
}
