<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "sequence" element.
 * 
 * Content (version 1.0):
 * (annotation?, (element | group | choice | sequence | any)*)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SequenceElement extends AbstractCompositeElement implements ParticleElementInterface
{
    /**
     * {@inheritDoc}
     */
    public function getAnnotationElement()
    {
        return $this->getChildElement(0);
    }
    
    /**
     * {@inheritDoc}
     */
    public function setAnnotationElement(AnnotationElement $element)
    {
        $this->setChildElement(0, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function hasAnnotationElement():bool
    {
        return $this->isChildElementSet(0);
    }
    
    /**
     * Adds an "element" element to this element.
     * 
     * @param   ElementElement  $element    The element to add.
     */
    public function addElementElement(ElementElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "element" child elements.
     * 
     * @return  ElementElement[]    An indexed array of ElementElement instances.
     */
    public function getElementElements():array
    {
        return $this->getChildElementsByType(1, ElementElement::class);
    }
    
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
    
    /**
     * Returns all the particle child elements.
     * 
     * @return  ParticleElementInterface[]  An indexed array of ParticleElementInterface instances.
     */
    public function getParticleElements():array
    {
        return $this->getChildElementsByType(1, ParticleElementInterface::class);
    }
}
