<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Interface for a XML schema element that provides for uniqueness and 
 * reference constraints with respect to the contents of multiple elements 
 * and attributes.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface IdentityConstraintElementInterface extends AnnotatedElementInterface
{
    /**
     * Returns the "selector" element.
     * 
     * @return  SelectorElement|NULL    The instance of the element if it has been set, otherwise NULL.
     */
    public function getSelectorElement();
    
    /**
     * Sets the "selector" element.
     * 
     * @param   SelectorElement $element    The element to set.
     */
    public function setSelectorElement(SelectorElement $element);
    
    /**
     * Indicates whether a "selector" element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasSelectorElement():bool;
    
    /**
     * Adds a "field" element to this element.
     * 
     * @param   FieldElement    $element    The element to add.
     */
    public function addFieldElement(FieldElement $element);
    
    /**
     * Returns all the "field" child elements.
     * 
     * @return  FieldElement[]  An indexed array of FieldElement instances.
     */
    public function getFieldElements():array;
}
