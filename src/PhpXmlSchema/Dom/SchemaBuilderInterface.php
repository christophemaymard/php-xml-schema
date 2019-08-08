<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Interface for building a XML Schema.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface SchemaBuilderInterface
{
    /**
     * Builds an "attributeFormDefault" attribute in the "schema" element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildAttributeFormDefaultAttribute(string $value);
    
    /**
     * Builds a "blockDefault" attribute in the "schema" element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * Before creating the attribute, the white space characters (i.e. TAB, 
     * LF, CR and SPACE) of the value are collapsed.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildBlockDefaultAttribute(string $value);
    
    /**
     * Builds an "elementFormDefault" attribute in the "schema" element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildElementFormDefaultAttribute(string $value);
    
    /**
     * Builds a "finalDefault" attribute in the "schema" element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildFinalDefaultAttribute(string $value);
    
    /**
     * Builds an "id" attribute in the "schema" element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildIdAttribute(string $value);
    
    /**
     * Builds a "targetNamespace" attribute in the "schema" element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildTargetNamespaceAttribute(string $value);
    
    /**
     * Builds a "version" attribute in the "schema" element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildVersionAttribute(string $value);
    
    /**
     * Builds a "xml:lang" attribute in the "schema" element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildLangAttribute(string $value);
    
    /**
     * Builds an "annotation" element (composition).
     * 
     * If the current element does not support the element then it is not 
     * built.
     */
    public function buildCompositionAnnotationElement();
    
    /**
     * Builds a "schema" element.
     * 
     * A new instance is created that replaces the "schema" element and the 
     * current element that is being built.
     */
    public function buildSchemaElement();
    
    /**
     * Updates the current element with the parent element of the current 
     * element that is being built.
     * 
     * If the current element is a "schema" element then the new current 
     * element is NULL and no more attributes and/or elements can be built.
     */
    public function endElement();
}
