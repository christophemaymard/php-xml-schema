<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Interface for a XML schema element that provides a "simpleType" element 
 * ({@see PhpXmlSchema\Dom\SimpleTypeElement}).
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface SimpleTypedElementInterface
{
    /**
     * Returns the "simpleType" element.
     * 
     * @return  SimpleTypeElement|NULL  The instance of the element if it has been set, otherwise NULL.
     */
    public function getSimpleTypeElement();
    
    /**
     * Sets the "simpleType" element.
     * 
     * @param   SimpleTypeElement   $element    The element to set.
     */
    public function setSimpleTypeElement(SimpleTypeElement $element);
    
    /**
     * Indicates whether a "simpleType" element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasSimpleTypeElement():bool;
}