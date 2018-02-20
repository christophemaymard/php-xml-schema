<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "element" element.
 * 
 * Content (version 1.0):
 * (annotation?, ((simpleType | complexType)?, (unique | key | keyref)*))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ElementElement extends AbstractAnnotatedElement implements ParticleElementInterface
{
    /**
     * Returns the type element.
     * 
     * @return  TypeElementInterface|NULL   The instance of the element if it has been set, otherwise NULL.
     */
    public function getTypeElement()
    {
        return $this->getChildElement(1);
    }
    
    /**
     * Sets the type element.
     * 
     * @param   TypeElementInterface    $element    The element to set.
     */
    public function setTypeElement(TypeElementInterface $element)
    {
        $this->setChildElement(1, $element);
    }
    
    /**
     * Indicates whether a type element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasTypeElement():bool
    {
        return $this->isChildElementSet(1);
    }
    
    /**
     * Adds an "unique" element to this element.
     * 
     * @param   UniqueElement   $element    The element to add.
     */
    public function addUniqueElement(UniqueElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "unique" child elements.
     * 
     * @return  UniqueElement[] An indexed array of UniqueElement instances.
     */
    public function getUniqueElements():array
    {
        return $this->getChildElementsByType(2, UniqueElement::class);
    }
    
    /**
     * Adds a "key" element to this element.
     * 
     * @param   KeyElement  $element    The element to add.
     */
    public function addKeyElement(KeyElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "key" child elements.
     * 
     * @return  KeyElement[]    An indexed array of KeyElement instances.
     */
    public function getKeyElements():array
    {
        return $this->getChildElementsByType(2, KeyElement::class);
    }
    
    /**
     * Adds a "keyref" element to this element.
     * 
     * @param   KeyRefElement   $element    The element to add.
     */
    public function addKeyRefElement(KeyRefElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "keyref" child elements.
     * 
     * @return  KeyRefElement[] An indexed array of KeyRefElement instances.
     */
    public function getKeyRefElements():array
    {
        return $this->getChildElementsByType(2, KeyRefElement::class);
    }
    
    /**
     * Returns all the identity-constraint child elements.
     * 
     * @return  IdentityConstraintElementInterface[]    An indexed array of IdentityConstraintElementInterface instances.
     */
    public function getIdentityConstraintElements():array
    {
        return $this->getChildElementsByType(2, IdentityConstraintElementInterface::class);
    }
}
