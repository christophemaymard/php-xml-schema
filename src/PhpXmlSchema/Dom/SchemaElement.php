<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "schema" element.
 * 
 * Content (version 1.0):
 * ((include | import | redefine | annotation)*, (((simpleType | complexType | group | attributeGroup) | element | attribute | notation), annotation*)*)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SchemaElement extends AbstractCompositeElement
{
    /**
     * Adds an "include" element to this element.
     * 
     * @param   IncludeElement  $element    The element to add.
     */
    public function addIncludeElement(IncludeElement $element)
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "include" child elements.
     * 
     * @return  IncludeElement[]    An indexed array of IncludeElement instances.
     */
    public function getIncludeElements():array
    {
        return $this->getChildElementsByType(0, IncludeElement::class);
    }
    
    /**
     * Adds an "import" element to this element.
     * 
     * @param   ImportElement   $element    The element to add.
     */
    public function addImportElement(ImportElement $element)
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "import" child elements.
     * 
     * @return  ImportElement[] An indexed array of ImportElement instances.
     */
    public function getImportElements():array
    {
        return $this->getChildElementsByType(0, ImportElement::class);
    }
    
    /**
     * Adds a "redefine" element to this element.
     * 
     * @param   RedefineElement $element    The element to add.
     */
    public function addRedefineElement(RedefineElement $element)
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "redefine" child elements.
     * 
     * @return  RedefineElement[]   An indexed array of RedefineElement instances.
     */
    public function getRedefineElements():array
    {
        return $this->getChildElementsByType(0, RedefineElement::class);
    }
    
    /**
     * Adds an "annotation" element to this element.
     * 
     * @param   AnnotationElement   $element    The element to add.
     */
    public function addCompositionAnnotationElement(AnnotationElement $element)
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "annotation" child elements.
     * 
     * @return  AnnotationElement[] An indexed array of AnnotationElement instances.
     */
    public function getCompositionAnnotationElements():array
    {
        return $this->getChildElementsByType(0, AnnotationElement::class);
    }
}
