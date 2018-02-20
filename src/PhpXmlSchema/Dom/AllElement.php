<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "all" element.
 * 
 * Content (version 1.0):
 * (annotation?, element*)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AllElement extends AbstractCompositeElement implements ParticleElementInterface
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
     * Returns all the particle child elements.
     * 
     * @return  ParticleElementInterface[]  An indexed array of ParticleElementInterface instances.
     */
    public function getParticleElements():array
    {
        return $this->getChildElementsByType(1, ParticleElementInterface::class);
    }
}
