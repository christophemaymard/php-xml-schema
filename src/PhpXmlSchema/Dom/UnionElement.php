<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "union" element.
 * 
 * Content (version 1.0):
 * (annotation?, simpleType*)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class UnionElement extends AbstractAnnotatedElement implements SimpleTypeDerivationElementInterface
{
    /**
     * Adds a "simpleType" element to this element.
     * 
     * @param   SimpleTypeElement   $element    The element to add.
     */
    public function addSimpleTypeElement(SimpleTypeElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "simpleType" child elements.
     * 
     * @return  SimpleTypeElement[] An indexed array of SimpleTypeElement instances.
     */
    public function getSimpleTypeElements():array
    {
        return $this->getChildElementsByType(1, SimpleTypeElement::class);
    }
}
