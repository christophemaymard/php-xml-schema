<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "selector" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * - xpath = a XPath expression ({@see PhpXmlSchema\Dom\SelectorXPathType})
 * 
 * Content (version 1.0):
 * (annotation?)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SelectorElement extends AbstractAnnotatedElement
{
    /**
     * The value of the "xpath" attribute.
     * @var SelectorXPathType|NULL
     */
    private $xpathAttr;
    
    /**
     * {@inheritDoc}
     */
    public function getElementId(): int
    {
        return ElementId::ELT_SELECTOR;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName(): string
    {
        return 'selector';
    }
    
    /**
     * Returns the value of the "xpath" attribute.
     * 
     * @return  SelectorXPathType|NULL  The value of the attribute if it has been set, otherwise NULL.
     */
    public function getXPath(): ?SelectorXPathType
    {
        return $this->xpathAttr;
    }
    
    /**
     * Sets the value of the "xpath" attribute.
     * 
     * @param   SelectorXPathType   $value  The value to set.
     */
    public function setXPath(SelectorXPathType $value): void
    {
        $this->xpathAttr = $value;
    }
    
    /**
     * Indicates whether the "xpath" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasXPath(): bool
    {
        return $this->xpathAttr !== NULL;
    }
}
