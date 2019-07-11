<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "simpleContent" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * 
 * Content (version 1.0):
 * (annotation?, (restriction | extension))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleContentElement extends AbstractAnnotatedElement implements ContentElementInterface
{
    /**
     * {@inheritDoc}
     */
    public function getLocalName():string
    {
        return 'simpleContent';
    }
    
    /**
     * Returns the derivation element.
     * 
     * @return  SimpleContentDerivationElementInterface|NULL    The instance of the element if it has been set, otherwise NULL.
     */
    public function getDerivationElement()
    {
        return $this->getChildElement(1);
    }
    
    /**
     * Sets the derivation element.
     * 
     * @param   SimpleContentDerivationElementInterface $element    The element to set.
     */
    public function setDerivationElement(SimpleContentDerivationElementInterface $element)
    {
        $this->setChildElement(1, $element);
    }
    
    /**
     * Indicates whether a derivation element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasDerivationElement():bool
    {
        return $this->isChildElementSet(1);
    }
}
