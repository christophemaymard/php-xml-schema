<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\AnyUriType;

/**
 * Represents the XML schema "import" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * - namespace = anyURI
 * - schemaLocation = anyURI
 * 
 * Content (version 1.0):
 * (annotation?)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ImportElement extends AbstractAnnotatedElement
{
    /**
     * The value of the "namespace" attribute.
     * @var AnyUriType|NULL
     */
    private $namespaceAttr;
    
    /**
     * The value of the "schemaLocation" attribute.
     * @var AnyUriType|NULL
     */
    private $schemaLocationAttr;
    
    /**
     * {@inheritDoc}
     */
    public function getElementId():int
    {
        return ElementId::ELT_IMPORT;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName():string
    {
        return 'import';
    }
    
    /**
     * Returns the value of the "namespace" attribute.
     * 
     * @return  AnyUriType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getNamespace()
    {
        return $this->namespaceAttr;
    }
    
    /**
     * Sets the value of the "namespace" attribute.
     * 
     * @param   AnyUriType  $value  The value to set.
     */
    public function setNamespace(AnyUriType $value)
    {
        $this->namespaceAttr = $value;
    }
    
    /**
     * Indicates whether the "namespace" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasNamespace():bool
    {
        return $this->namespaceAttr !== NULL;
    }
    
    /**
     * Returns the value of the "schemaLocation" attribute.
     * 
     * @return  AnyUriType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getSchemaLocation()
    {
        return $this->schemaLocationAttr;
    }
    
    /**
     * Sets the value of the "schemaLocation" attribute.
     * 
     * @param   AnyUriType  $value  The value to set.
     */
    public function setSchemaLocation(AnyUriType $value)
    {
        $this->schemaLocationAttr = $value;
    }
    
    /**
     * Indicates whether the "schemaLocation" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasSchemaLocation():bool
    {
        return $this->schemaLocationAttr !== NULL;
    }
}
