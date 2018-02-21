<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "group" element.
 * 
 * Content (version 1.0):
 * (annotation?, (all | choice | sequence)?)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class GroupElement extends AbstractAnnotatedElement implements ParticleElementInterface
{
    /**
     * Returns the model group element.
     * 
     * @return  ModelGroupElementInterface|NULL The instance of the element if it has been set, otherwise NULL.
     */
    public function getModelGroupElement()
    {
        return $this->getChildElement(1);
    }
    
    /**
     * Sets the model group element.
     * 
     * @param   ModelGroupElementInterface  $element    The element to set.
     */
    public function setModelGroupElement(ModelGroupElementInterface $element)
    {
        $this->setChildElement(1, $element);
    }
    
    /**
     * Indicates whether a model group element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasModelGroupElement():bool
    {
        return $this->isChildElementSet(1);
    }
}
