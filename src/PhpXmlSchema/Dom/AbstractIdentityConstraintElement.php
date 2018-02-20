<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the base class for a XML schema element that provides for 
 * uniqueness and reference constraints with respect to the contents of 
 * multiple elements and attributes.
 * 
 * Content (version 1.0):
 * (annotation?, (selector, field+))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractIdentityConstraintElement extends AbstractAnnotatedElement implements IdentityConstraintElementInterface
{
    /**
     * {@inheritDoc}
     */
    public function getSelectorElement()
    {
        return $this->getChildElement(1);
    }
    
    /**
     * {@inheritDoc}
     */
    public function setSelectorElement(SelectorElement $element)
    {
        $this->setChildElement(1, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function hasSelectorElement():bool
    {
        return $this->isChildElementSet(1);
    }
    
    /**
     * {@inheritDoc}
     */
    public function addFieldElement(FieldElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getFieldElements():array
    {
        return $this->getChildElementsByType(2, FieldElement::class);
    }
}