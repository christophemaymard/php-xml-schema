<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the base class for a XML schema element that specifies an 
 * interpretation of the particles base on:
 * - "element" elements ({@see PhpXmlSchema\Dom\ElementElement})
 * - "group" elements ({@see PhpXmlSchema\Dom\GroupElement})
 * - "choice" elements ({@see PhpXmlSchema\Dom\ChoiceElement})
 * - "sequence" elements ({@see PhpXmlSchema\Dom\SequenceElement})
 * - "any" elements ({@see PhpXmlSchema\Dom\AnyElement})
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractExplicitModelGroupElement extends AbstractModelGroupElement
{
    /**
     * Adds a "group" element to this element.
     * 
     * @param   GroupElement    $element    The element to add.
     */
    public function addGroupElement(GroupElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "group" child elements.
     * 
     * @return  GroupElement[]  An indexed array of GroupElement instances.
     */
    public function getGroupElements():array
    {
        return $this->getChildElementsByType(1, GroupElement::class);
    }
    
    /**
     * Adds a "choice" element to this element.
     * 
     * @param   ChoiceElement   $element    The element to add.
     */
    public function addChoiceElement(ChoiceElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "choice" child elements.
     * 
     * @return  ChoiceElement[] An indexed array of ChoiceElement instances.
     */
    public function getChoiceElements():array
    {
        return $this->getChildElementsByType(1, ChoiceElement::class);
    }
    
    /**
     * Adds a "sequence" element to this element.
     * 
     * @param   SequenceElement $element    The element to add.
     */
    public function addSequenceElement(SequenceElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "sequence" child elements.
     * 
     * @return  SequenceElement[]   An indexed array of SequenceElement instances.
     */
    public function getSequenceElements():array
    {
        return $this->getChildElementsByType(1, SequenceElement::class);
    }
    
    /**
     * Adds an "any" element to this element.
     * 
     * @param   AnyElement  $element    The element to add.
     */
    public function addAnyElement(AnyElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "any" child elements.
     * 
     * @return  AnyElement[]    An indexed array of AnyElement instances.
     */
    public function getAnyElements():array
    {
        return $this->getChildElementsByType(1, AnyElement::class);
    }
}