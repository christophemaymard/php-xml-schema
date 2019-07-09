<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Interface for a XML schema element that specifies an interpretation of the 
 * particles base on particle elements.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface ModelGroupElementInterface extends AnnotatedElementInterface
{
    /**
     * Adds an "element" element to this element.
     * 
     * @param   ElementElement  $element    The element to add.
     */
    public function addElementElement(ElementElement $element);
    
    /**
     * Returns all the "element" child elements.
     * 
     * @return  ElementElement[]    An indexed array of ElementElement instances.
     */
    public function getElementElements():array;
    
    /**
     * Returns all the particle child elements.
     * 
     * @return  ParticleElementInterface[]  An indexed array of ParticleElementInterface instances.
     */
    public function getParticleElements():array;
}