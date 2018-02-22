<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Interface for a XML schema element that provides for naming a type 
 * definition particle ({@see PhpXmlSchema\Dom\GroupElement}, {@see PhpXmlSchema\Dom\AllElement}, 
 * {@see PhpXmlSchema\Dom\ChoiceElement} and {@see PhpXmlSchema\Dom\SequenceElement}), 
 * a group of attribute declarations ({@see PhpXmlSchema\Dom\AttributeElement} 
 * and {@see PhpXmlSchema\Dom\AttributeGroupElement}) and an attribute 
 * wildcard ({@see PhpXmlSchema\Dom\AnyAttributeElement}) for use by 
 * reference.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface TypeNamingElementInterface extends AttributeNamingElementInterface
{
    /**
     * Returns the type definition particle element.
     * 
     * @return  TypeDefinitionParticleElementInterface|NULL The instance of the element if it has been set, otherwise NULL.
     */
    public function getTypeDefinitionParticleElement();
    
    /**
     * Sets the type definition particle element.
     * 
     * @param   TypeDefinitionParticleElementInterface  $element    The element to set.
     */
    public function setTypeDefinitionParticleElement(TypeDefinitionParticleElementInterface $element);
    
    /**
     * Indicates whether a type definition particle element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasTypeDefinitionParticleElement():bool;
}
