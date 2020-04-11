<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the base class for a XML schema element that provides an 
 * "annotation" element ({@see PhpXmlSchema\Dom\AnnotationElement}) and a 
 * "simpleType" element ({@see PhpXmlSchema\Dom\SimpleTypeElement}).
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractSimpleTypedElement extends AbstractAnnotatedElement implements SimpleTypedElementInterface
{
    /**
     * {@inheritDoc}
     */
    public function getSimpleTypeElement(): ?SimpleTypeElement
    {
        return $this->getChildElement(1);
    }
    
    /**
     * {@inheritDoc}
     */
    public function setSimpleTypeElement(SimpleTypeElement $element): void
    {
        $this->setChildElement(1, $element);
    }
    
    /**
     * {@inheritDoc}
     */
    public function hasSimpleTypeElement(): bool
    {
        return $this->isChildElementSet(1);
    }
}
