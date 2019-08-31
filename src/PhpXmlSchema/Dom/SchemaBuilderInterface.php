<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Exception\InvalidOperationException;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Interface for building a XML Schema.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface SchemaBuilderInterface
{
    /**
     * Binds the specified prefix to the specified namespace.
     * 
     * @param   string  $prefix     The prefix.
     * @param   string  $namespace  The namespace to bind to.
     * 
     * @throws  InvalidOperationException   When 'xml' prefix is bound to a namespace other than XML 1.0 namespace.
     * @throws  InvalidOperationException   When the prefix, other than 'xml', is bound to the XML 1.0 namespace.
     * @throws  InvalidOperationException   When the prefix is 'xmlns'.
     * @throws  InvalidOperationException   When the prefix, other than 'xmlns', is bound to the XML NS 1.0 namespace.
     */
    public function bindNamespace(string $prefix, string $namespace);
    
    /**
     * Builds an "attributeFormDefault" attribute in the current element.
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
     * Builds a "base" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException       When the current element supports the attribute and the value is invalid.
     * @throws  InvalidOperationException   When the current element supports the attribute and the prefix is not bound to a namespace.
     */
    public function buildBaseAttribute(string $value);
    
    /**
     * Builds a "blockDefault" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildBlockDefaultAttribute(string $value);
    
    /**
     * Builds a "default" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildDefaultAttribute(string $value);
    
    /**
     * Builds an "elementFormDefault" attribute in the current element.
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
     * Builds a "final" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildFinalAttribute(string $value);
    
    /**
     * Builds a "finalDefault" attribute in the current element.
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
     * Builds a "fixed" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildFixedAttribute(string $value);
    
    /**
     * Builds an "id" attribute in the current element.
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
     * Builds an "itemType" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException       When the current element supports the attribute and the value is invalid.
     * @throws  InvalidOperationException   When the current element supports the attribute and the prefix is not bound to a namespace.
     */
    public function buildItemTypeAttribute(string $value);
    
    /**
     * Builds a "memberTypes" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException       When the current element supports the attribute and the value is invalid.
     * @throws  InvalidOperationException   When the current element supports the attribute and the prefix is not bound to a namespace.
     */
    public function buildMemberTypesAttribute(string $value);
    
    /**
     * Builds a "name" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildNameAttribute(string $value);
    
    /**
     * Builds a "namespace" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildNamespaceAttribute(string $value);
    
    /**
     * Builds a "public" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildPublicAttribute(string $value);
    
    /**
     * Builds a "schemaLocation" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildSchemaLocationAttribute(string $value);
    
    /**
     * Builds a "source" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildSourceAttribute(string $value);
    
    /**
     * Builds a "system" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildSystemAttribute(string $value);
    
    /**
     * Builds a "targetNamespace" attribute in the current element.
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
     * Builds a "type" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException       When the current element supports the attribute and the value is invalid.
     * @throws  InvalidOperationException   When the current element supports the attribute and the prefix is not bound to a namespace.
     */
    public function buildTypeAttribute(string $value);
    
    /**
     * Builds a "value" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildValueAttribute(string $value);
    
    /**
     * Builds a "version" attribute in the current element.
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
     * Builds a "xml:lang" attribute in the current element.
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
     * Builds an "annotation" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildAnnotationElement();
    
    /**
     * Builds an "annotation" element (composition).
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildCompositionAnnotationElement();
    
    /**
     * Builds an "annotation" element (definition).
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildDefinitionAnnotationElement();
    
    /**
     * Builds an "appinfo" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildAppInfoElement();
    
    /**
     * Builds an "attribute" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildAttributeElement();
    
    /**
     * Builds an "attributeGroup" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildAttributeGroupElement();
    
    /**
     * Builds a "documentation" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildDocumentationElement();
    
    /**
     * Builds an "enumeration" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildEnumerationElement();
    
    /**
     * Builds a "fractionDigits" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildFractionDigitsElement();
    
    /**
     * Builds an "import" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildImportElement();
    
    /**
     * Builds an "include" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildIncludeElement();
    
    /**
     * Builds a "length" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildLengthElement();
    
    /**
     * Builds a "list" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildListElement();
    
    /**
     * Builds a "maxExclusive" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildMaxExclusiveElement();
    
    /**
     * Builds a "maxInclusive" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildMaxInclusiveElement();
    
    /**
     * Builds a "maxLength" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildMaxLengthElement();
    
    /**
     * Builds a "minExclusive" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildMinExclusiveElement();
    
    /**
     * Builds a "minInclusive" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildMinInclusiveElement();
    
    /**
     * Builds a "minLength" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildMinLengthElement();
    
    /**
     * Builds a "notation" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildNotationElement();
    
    /**
     * Builds a "pattern" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildPatternElement();
    
    /**
     * Builds a "restriction" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildRestrictionElement();
    
    /**
     * Builds a "simpleType" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildSimpleTypeElement();
    
    /**
     * Builds a "totalDigits" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildTotalDigitsElement();
    
    /**
     * Builds an "union" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildUnionElement();
    
    /**
     * Builds a "whiteSpace" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildWhiteSpaceElement();
    
    /**
     * Builds a "schema" element.
     * 
     * A new instance is created that replaces the "schema" element and the 
     * current element that is being built.
     */
    public function buildSchemaElement();
    
    /**
     * Builds the content of a leaf element.
     * 
     * If the current element is not a leaf element then it is not built.
     * 
     * In any case, the current element does not change.
     * 
     * @param   string  $content    The content to set in the element.
     */
    public function buildLeafElementContent(string $content);
    
    /**
     * Updates the current element with the parent element of the current 
     * element that is being built.
     * 
     * If the current element is a "schema" element then the new current 
     * element is NULL and no more attributes and/or elements can be built.
     */
    public function endElement();
}
