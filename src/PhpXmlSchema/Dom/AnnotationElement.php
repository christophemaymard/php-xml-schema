<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "annotation" element.
 * 
 * Content (version 1.0):
 * (appinfo | documentation)*
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AnnotationElement extends AbstractCompositeElement
{
    /**
     * Adds an "appinfo" element to this element.
     * 
     * @param   AppInfoElement  $element    The element to add.
     */
    public function addAppInfoElement(AppInfoElement $element)
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "appinfo" child elements.
     * 
     * @return  AppInfoElement[]    An indexed array of AppInfoElement instances.
     */
    public function getAppInfoElements():array
    {
        return $this->getChildElementsByType(0, AppInfoElement::class);
    }
    
    /**
     * Adds a "documentation" element to this element.
     * 
     * @param   DocumentationElement    $element    The element to add.
     */
    public function addDocumentationElement(DocumentationElement $element)
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "documentation" child elements.
     * 
     * @return  DocumentationElement[]  An indexed array of DocumentationElement instances.
     */
    public function getDocumentationElements():array
    {
        return $this->getChildElementsByType(0, DocumentationElement::class);
    }
}
