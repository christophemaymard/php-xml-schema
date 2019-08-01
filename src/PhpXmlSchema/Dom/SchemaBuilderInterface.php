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
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the value is invalid for the attribute.
     */
    public function buildAttributeFormDefaultAttribute(string $value);
    
    /**
     * Builds a "blockDefault" attribute in the "schema" element.
     * 
     * Before creating the attribute, the white space characters (i.e. TAB, 
     * LF, CR and SPACE) of the value are collapsed.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the value is invalid for the attribute.
     */
    public function buildBlockDefaultAttribute(string $value);
    
    /**
     * Builds an "elementFormDefault" attribute in the "schema" element.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the value is invalid for the attribute.
     */
    public function buildElementFormDefaultAttribute(string $value);
    
    /**
     * Builds a "schema" element.
     * 
     * An new instance is created and replaces the current "schema" element 
     * that is being built.
     */
    public function buildSchemaElement();
}
