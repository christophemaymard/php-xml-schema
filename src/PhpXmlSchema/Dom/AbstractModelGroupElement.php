<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the base class for a XML schema element that specifies an 
 * interpretation of the particles base on:
 * - "element" elements ({@see PhpXmlSchema\Dom\ElementElement})
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractModelGroupElement extends AbstractAnnotatedElement implements ModelGroupElementInterface
{
    /**
     * {@inheritDoc}
     */
    public function addElementElement(ElementElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getElementElements():array
    {
        return $this->getChildElementsByType(1, ElementElement::class);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getParticleElements():array
    {
        return $this->getChildElementsByType(1, ParticleElementInterface::class);
    }
}