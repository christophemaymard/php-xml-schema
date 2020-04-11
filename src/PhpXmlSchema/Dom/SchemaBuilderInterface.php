<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
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
    public function bindNamespace(string $prefix, string $namespace): void;
    
    /**
     * Builds an "abstract" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildAbstractAttribute(string $value): void;
    
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
    public function buildAttributeFormDefaultAttribute(string $value): void;
    
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
    public function buildBaseAttribute(string $value): void;
    
    /**
     * Builds a "block" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildBlockAttribute(string $value): void;
    
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
    public function buildBlockDefaultAttribute(string $value): void;
    
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
    public function buildDefaultAttribute(string $value): void;
    
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
    public function buildElementFormDefaultAttribute(string $value): void;
    
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
    public function buildFinalAttribute(string $value): void;
    
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
    public function buildFinalDefaultAttribute(string $value): void;
    
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
    public function buildFixedAttribute(string $value): void;
    
    /**
     * Builds a "form" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildFormAttribute(string $value): void;
    
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
    public function buildIdAttribute(string $value): void;
    
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
    public function buildItemTypeAttribute(string $value): void;
    
    /**
     * Builds a "maxOccurs" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildMaxOccursAttribute(string $value): void;
    
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
    public function buildMemberTypesAttribute(string $value): void;
    
    /**
     * Builds a "minOccurs" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildMinOccursAttribute(string $value): void;
    
    /**
     * Builds a "mixed" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildMixedAttribute(string $value): void;
    
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
    public function buildNameAttribute(string $value): void;
    
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
    public function buildNamespaceAttribute(string $value): void;
    
    /**
     * Builds a "nillable" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildNillableAttribute(string $value): void;
    
    /**
     * Builds a "processContents" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildProcessContentsAttribute(string $value): void;
    
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
    public function buildPublicAttribute(string $value): void;
    
    /**
     * Builds a "ref" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException       When the current element supports the attribute and the value is invalid.
     * @throws  InvalidOperationException   When the current element supports the attribute and the prefix is not bound to a namespace.
     */
    public function buildRefAttribute(string $value): void;
    
    /**
     * Builds a "refer" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException       When the current element supports the attribute and the value is invalid.
     * @throws  InvalidOperationException   When the current element supports the attribute and the prefix is not bound to a namespace.
     */
    public function buildReferAttribute(string $value): void;
    
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
    public function buildSchemaLocationAttribute(string $value): void;
    
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
    public function buildSourceAttribute(string $value): void;
    
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
    public function buildSystemAttribute(string $value): void;
    
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
    public function buildTargetNamespaceAttribute(string $value): void;
    
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
    public function buildTypeAttribute(string $value): void;
    
    /**
     * Builds an "use" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildUseAttribute(string $value): void;
    
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
    public function buildValueAttribute(string $value): void;
    
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
    public function buildVersionAttribute(string $value): void;
    
    /**
     * Builds a "xpath" attribute in the current element.
     * 
     * If the current element does not support the attribute then it is not 
     * built.
     * 
     * @param   string  $value  The value of the attribute.
     * 
     * @throws  InvalidValueException   When the current element supports the attribute and the value is invalid.
     */
    public function buildXPathAttribute(string $value): void;
    
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
    public function buildLangAttribute(string $value): void;
    
    /**
     * Builds an "all" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildAllElement(): void;
    
    /**
     * Builds an "annotation" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildAnnotationElement(): void;
    
    /**
     * Builds an "annotation" element (composition).
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildCompositionAnnotationElement(): void;
    
    /**
     * Builds an "annotation" element (definition).
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildDefinitionAnnotationElement(): void;
    
    /**
     * Builds an "any" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildAnyElement(): void;
    
    /**
     * Builds an "anyAttribute" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildAnyAttributeElement(): void;
    
    /**
     * Builds an "appinfo" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildAppInfoElement(): void;
    
    /**
     * Builds an "attribute" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildAttributeElement(): void;
    
    /**
     * Builds an "attributeGroup" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildAttributeGroupElement(): void;
    
    /**
     * Builds a "choice" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildChoiceElement(): void;
    
    /**
     * Builds a "complexContent" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildComplexContentElement(): void;
    
    /**
     * Builds a "complexType" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildComplexTypeElement(): void;
    
    /**
     * Builds a "documentation" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildDocumentationElement(): void;
    
    /**
     * Builds an "element" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildElementElement(): void;
    
    /**
     * Builds an "enumeration" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildEnumerationElement(): void;
    
    /**
     * Builds an "extension" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildExtensionElement(): void;
    
    /**
     * Builds a "field" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildFieldElement(): void;
    
    /**
     * Builds a "fractionDigits" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildFractionDigitsElement(): void;
    
    /**
     * Builds a "group" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildGroupElement(): void;
    
    /**
     * Builds an "import" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildImportElement(): void;
    
    /**
     * Builds an "include" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildIncludeElement(): void;
    
    /**
     * Builds a "key" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildKeyElement(): void;
    
    /**
     * Builds a "keyref" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildKeyRefElement(): void;
    
    /**
     * Builds a "length" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildLengthElement(): void;
    
    /**
     * Builds a "list" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildListElement(): void;
    
    /**
     * Builds a "maxExclusive" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildMaxExclusiveElement(): void;
    
    /**
     * Builds a "maxInclusive" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildMaxInclusiveElement(): void;
    
    /**
     * Builds a "maxLength" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildMaxLengthElement(): void;
    
    /**
     * Builds a "minExclusive" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildMinExclusiveElement(): void;
    
    /**
     * Builds a "minInclusive" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildMinInclusiveElement(): void;
    
    /**
     * Builds a "minLength" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildMinLengthElement(): void;
    
    /**
     * Builds a "notation" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildNotationElement(): void;
    
    /**
     * Builds a "pattern" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildPatternElement(): void;
    
    /**
     * Builds a "restriction" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildRestrictionElement(): void;
    
    /**
     * Builds a "selector" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildSelectorElement(): void;
    
    /**
     * Builds a "sequence" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildSequenceElement(): void;
    
    /**
     * Builds a "simpleContent" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildSimpleContentElement(): void;
    
    /**
     * Builds a "simpleType" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildSimpleTypeElement(): void;
    
    /**
     * Builds a "totalDigits" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildTotalDigitsElement(): void;
    
    /**
     * Builds an "union" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildUnionElement(): void;
    
    /**
     * Builds an "unique" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildUniqueElement(): void;
    
    /**
     * Builds a "whiteSpace" element.
     * 
     * If the current element supports the element then:
     * - a new instance is created, and 
     * - the created instance is added or set to the current element, and 
     * - the created instance becomes the current element.
     */
    public function buildWhiteSpaceElement(): void;
    
    /**
     * Builds a "schema" element.
     * 
     * A new instance is created that replaces the "schema" element and the 
     * current element that is being built.
     */
    public function buildSchemaElement(): void;
    
    /**
     * Builds the content of a leaf element.
     * 
     * If the current element is not a leaf element then it is not built.
     * 
     * In any case, the current element does not change.
     * 
     * @param   string  $content    The content to set in the element.
     */
    public function buildLeafElementContent(string $content): void;
    
    /**
     * Updates the current element with the parent element of the current 
     * element that is being built.
     * 
     * If the current element is a "schema" element then the new current 
     * element is NULL and no more attributes and/or elements can be built.
     */
    public function endElement(): void;
}
