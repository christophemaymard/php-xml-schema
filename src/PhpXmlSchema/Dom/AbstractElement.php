<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Exception\InvalidOperationException;

/**
 * Represents the base class for all the XML schema elements.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractElement implements ElementInterface
{
    /**
     * The instance of the element that holds this element.
     * @var ElementInterface|NULL
     */
    private $parent;
    
    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return $this->parent;
    }
    
    /**
     * Sets the parent of this element.
     * 
     * @param   ElementInterface    $element    The element that holds this element.
     * 
     * @throws  InvalidOperationException   When the element already belongs to another element.
     */
    protected function setParent(ElementInterface $element)
    {
        if ($this->hasParent()) {
            throw new InvalidOperationException(\sprintf(
                'The "%s" element cannot be added to the "%s" element because it already belongs to another element.',
                $this->getLocalName(),
                $element->getLocalName()
            ));
        }
        
        $this->parent = $element;
    }
    
    /**
     * {@inheritDoc}
     */
    public function hasParent():bool
    {
        return $this->parent !== NULL;
    }
}