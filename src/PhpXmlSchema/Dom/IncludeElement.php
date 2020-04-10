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
 * Represents the XML schema "include" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * - schemaLocation = anyURI
 * 
 * Content (version 1.0):
 * (annotation?)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class IncludeElement extends AbstractAnnotatedElement
{
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
        return ElementId::ELT_INCLUDE;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName():string
    {
        return 'include';
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
