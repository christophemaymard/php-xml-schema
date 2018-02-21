<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "complexType" element.
 * 
 * Content (version 1.0):
 * (annotation?, (simpleContent | complexContent | ((group | all | choice | sequence)?, ((attribute | attributeGroup)*, anyAttribute?))))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ComplexTypeElement extends AbstractCompositeElement implements TypeElementInterface
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
     * Returns the type definition particle element.
     * 
     * @return  TypeDefinitionParticleElementInterface|NULL The instance of the element if it has been set, otherwise NULL.
     */
    public function getTypeDefinitionParticleElement()
    {
        return $this->getChildElement(2);
    }
    
    /**
     * Sets the type definition particle element.
     * 
     * @param   TypeDefinitionParticleElementInterface  $element    The element to set.
     */
    public function setTypeDefinitionParticleElement(TypeDefinitionParticleElementInterface $element)
    {
        $this->setChildElement(2, $element);
    }
    
    /**
     * Indicates whether a type definition particle element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasTypeDefinitionParticleElement():bool
    {
        return $this->isChildElementSet(2);
    }
}
