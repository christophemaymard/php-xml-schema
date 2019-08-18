<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\XmlNamespace;
use PhpXmlSchema\Exception\InvalidOperationException;

/**
 * Represents the base class for all the XML schema elements.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractElement implements ElementInterface
{
    /**
     * The instance of the element that holds this element.
     * @var ElementInterface|NULL
     */
    private $parent;
    
    /**
     * An associative array where:
     * - the key is the prefix, and 
     * - the value is the namespace.
     * @var string[]
     */
    private $nsBinding = [];
    
    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return $this->parent;
    }
    
    /**
     * Sets the parent of this element.
     * 
     * @param   ElementInterface    $element    The element that holds this element.
     * 
     * @throws  InvalidOperationException   When the element already belongs to another element.
     */
    protected function setParent(ElementInterface $element)
    {
        if ($this->hasParent()) {
            throw new InvalidOperationException(\sprintf(
                'The "%s" element cannot be added to the "%s" element because it already belongs to another element.',
                $this->getLocalName(),
                $element->getLocalName()
            ));
        }
        
        $this->parent = $element;
    }
    
    /**
     * {@inheritDoc}
     */
    public function hasParent():bool
    {
        return $this->parent !== NULL;
    }
    
    /**
     * {@inheritDoc}
     */
    public function bindNamespace(string $prefix, string $namespace)
    {
        if ($prefix == XmlNamespace::XML_1_0_PREFIX && $namespace != XmlNamespace::XML_1_0) {
            throw new InvalidOperationException(\sprintf(
                '"xml" prefix can be bound only to "http://www.w3.org/XML/1998/namespace" and not "%s".', 
                $namespace
            ));
        }
        
        if ($prefix != XmlNamespace::XML_1_0_PREFIX && $namespace == XmlNamespace::XML_1_0) {
            throw new InvalidOperationException(\sprintf(
                '"%s" prefix cannot be bound to "http://www.w3.org/XML/1998/namespace".', 
                $prefix
            ));
        }
        
        if ($prefix == XmlNamespace::XMLNS_1_0_PREFIX) {
            throw new InvalidOperationException('"xmlns" prefix is reserved.');
        }
        
        if ($namespace == XmlNamespace::XMLNS_1_0) {
            throw new InvalidOperationException(\sprintf(
                '"%s" prefix cannot be bound to "http://www.w3.org/2000/xmlns/".', 
                $prefix
            ));
        }
        
        $this->nsBinding[$prefix] = $namespace;
    }
    
    /**
     * {@inheritDoc}
     */
    public function lookupNamespace(string $prefix)
    {
        $ns = NULL;
        
        if (isset($this->nsBinding[$prefix])) {
            $ns = $this->nsBinding[$prefix];
        } elseif ($this->hasParent()) {
            $ns = $this->parent->lookupNamespace($prefix);
        } elseif ($prefix == XmlNamespace::XML_1_0_PREFIX) {
            $ns = XmlNamespace::XML_1_0;
        }
        
        return $ns;
    }
}
