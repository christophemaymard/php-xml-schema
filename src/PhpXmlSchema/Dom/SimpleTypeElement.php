<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "simpleType" element.
 * 
 * Content (version 1.0):
 * (annotation?, (restriction | list | union))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleTypeElement extends AbstractAnnotatedElement implements TypeElementInterface
{
    /**
     * Returns the derivation element.
     * 
     * @return  SimpleTypeDerivationElementInterface|NULL   The instance of the element if it has been set, otherwise NULL.
     */
    public function getDerivationElement()
    {
        return $this->getChildElement(1);
    }
    
    /**
     * Sets the derivation element.
     * 
     * @param   SimpleTypeDerivationElementInterface    $element    The element to set.
     */
    public function setDerivationElement(SimpleTypeDerivationElementInterface $element)
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
