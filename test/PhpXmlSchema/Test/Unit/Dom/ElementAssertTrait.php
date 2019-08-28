<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\AnnotationElement;
use PhpXmlSchema\Dom\AppInfoElement;
use PhpXmlSchema\Dom\AttributeElement;
use PhpXmlSchema\Dom\DocumentationElement;
use PhpXmlSchema\Dom\ElementInterface;
use PhpXmlSchema\Dom\EnumerationElement;
use PhpXmlSchema\Dom\FractionDigitsElement;
use PhpXmlSchema\Dom\ImportElement;
use PhpXmlSchema\Dom\IncludeElement;
use PhpXmlSchema\Dom\LengthElement;
use PhpXmlSchema\Dom\MaxExclusiveElement;
use PhpXmlSchema\Dom\MaxInclusiveElement;
use PhpXmlSchema\Dom\MaxLengthElement;
use PhpXmlSchema\Dom\MinExclusiveElement;
use PhpXmlSchema\Dom\MinInclusiveElement;
use PhpXmlSchema\Dom\MinLengthElement;
use PhpXmlSchema\Dom\NotationElement;
use PhpXmlSchema\Dom\PatternElement;
use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SimpleTypeElement;
use PhpXmlSchema\Dom\SimpleTypeRestrictionElement;
use PhpXmlSchema\Dom\TotalDigitsElement;
use PhpXmlSchema\Dom\WhiteSpaceElement;

/**
 * Represents a trait to assert XML Schema elements.
 * 
 * It must be used in a class that extends the {@see PHPUnit\Framework\TestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait ElementAssertTrait
{
    /**
     * Asserts that the specified element has a set of namespace declarations.
     * 
     * @param   string[]            $decls  
     * @param   ElementInterface    $sut    The element to test.
     */
    public static function assertElementNamespaceDeclarations(array $decls, ElementInterface $sut)
    {
        self::assertArraySubset($decls, $sut->getNamespaceDeclarations(), TRUE);
        self::assertCount(0, \array_diff_assoc($sut->getNamespaceDeclarations(), $decls));
    }
    
    /**
     * Asserts that the specified "schema" element has no attribute.
     * 
     * @param   SchemaElement   $sut    The element to test.
     */
    public static function assertSchemaElementHasNoAttribute(SchemaElement $sut)
    {
        self::assertFalse($sut->hasAttributeFormDefault());
        self::assertFalse($sut->hasBlockDefault());
        self::assertFalse($sut->hasElementFormDefault());
        self::assertFalse($sut->hasFinalDefault());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasTargetNamespace());
        self::assertFalse($sut->hasVersion());
        self::assertFalse($sut->hasLang());
    }
    
    /**
     * Asserts that the specified "schema" element has only the 
     * "attributeFormDefault" attribute.
     * 
     * @param   SchemaElement   $sut    The element to test.
     */
    public static function assertSchemaElementHasOnlyAttributeFormDefaultAttribute(
        SchemaElement $sut
    ) {
        self::assertTrue($sut->hasAttributeFormDefault());
        self::assertFalse($sut->hasBlockDefault());
        self::assertFalse($sut->hasElementFormDefault());
        self::assertFalse($sut->hasFinalDefault());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasTargetNamespace());
        self::assertFalse($sut->hasVersion());
        self::assertFalse($sut->hasLang());
    }
    
    /**
     * Asserts that the "blockDefault" attribute:
     * - byExtension() returns the same value as the expected "extension" flag
     * - byList() returns FALSE
     * - byRestriction() returns the same value as the expected "restriction" flag
     * - bySubstitution() returns the same value as the expected "substitution" flag
     * - byUnion() returns FALSE
     * 
     * @param   bool            $res    The expected value for the "restriction" flag.
     * @param   bool            $ext    The expected value for the "extension" flag.
     * @param   bool            $sub    The expected value for the "substitution" flag.
     * @param   SchemaElement   $sch    The element that holds the attribute.
     */
    public static function assertSchemaElementBlockDefaultAttribute(
        bool $res, 
        bool $ext, 
        bool $sub, 
        SchemaElement $sch
    ) {
        $sut = $sch->getBlockDefault();
        self::assertSame($ext, $sut->byExtension());
        self::assertFalse($sut->byList());
        self::assertSame($res, $sut->byRestriction());
        self::assertSame($sub, $sut->bySubstitution());
        self::assertFalse($sut->byUnion());
    }
    
    /**
     * Asserts that the specified "schema" element has only the 
     * "blockDefault" attribute.
     * 
     * @param   SchemaElement   $sut    The element to test.
     */
    public static function assertSchemaElementHasOnlyBlockDefaultAttribute(
        SchemaElement $sut
    ) {
        self::assertFalse($sut->hasAttributeFormDefault());
        self::assertTrue($sut->hasBlockDefault());
        self::assertFalse($sut->hasElementFormDefault());
        self::assertFalse($sut->hasFinalDefault());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasTargetNamespace());
        self::assertFalse($sut->hasVersion());
        self::assertFalse($sut->hasLang());
    }
    
    /**
     * Asserts that the specified "schema" element has only the 
     * "elementFormDefault" attribute.
     * 
     * @param   SchemaElement   $sut    The element to test.
     */
    public static function assertSchemaElementHasOnlyElementFormDefaultAttribute(
        SchemaElement $sut
    ) {
        self::assertFalse($sut->hasAttributeFormDefault());
        self::assertFalse($sut->hasBlockDefault());
        self::assertTrue($sut->hasElementFormDefault());
        self::assertFalse($sut->hasFinalDefault());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasTargetNamespace());
        self::assertFalse($sut->hasVersion());
        self::assertFalse($sut->hasLang());
    }
    
    /**
     * Asserts that the "finalDefault" attribute:
     * - byExtension() returns the same value as the expected "extension" flag
     * - byRestriction() returns the same value as the expected "restriction" flag
     * - byList() returns the same value as the expected "list" flag
     * - byUnion() returns the same value as the expected "union" flag
     * - bySubstitution() returns FALSE
     * 
     * @param   bool            $ext    The expected value for the "extension" flag.
     * @param   bool            $res    The expected value for the "restriction" flag.
     * @param   bool            $lst    The expected value for the "list" flag.
     * @param   bool            $unn    The expected value for the "union" flag.
     * @param   SchemaElement   $sch    The element that holds the attribute.
     */
    public static function assertSchemaElementFinalDefaultAttribute(
        bool $ext, 
        bool $res, 
        bool $lst, 
        bool $unn, 
        SchemaElement $sch
    ) {
        $sut = $sch->getFinalDefault();
        self::assertSame($ext, $sut->byExtension());
        self::assertSame($res, $sut->byRestriction());
        self::assertSame($lst, $sut->byList());
        self::assertSame($unn, $sut->byUnion());
        self::assertFalse($sut->bySubstitution());
    }
    
    /**
     * Asserts that the specified "schema" element has only the 
     * "finalDefault" attribute.
     * 
     * @param   SchemaElement   $sut    The element to test.
     */
    public static function assertSchemaElementHasOnlyFinalDefaultAttribute(
        SchemaElement $sut
    ) {
        self::assertFalse($sut->hasAttributeFormDefault());
        self::assertFalse($sut->hasBlockDefault());
        self::assertFalse($sut->hasElementFormDefault());
        self::assertTrue($sut->hasFinalDefault());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasTargetNamespace());
        self::assertFalse($sut->hasVersion());
        self::assertFalse($sut->hasLang());
    }
    
    /**
     * Asserts that the specified "schema" element has only the "id" 
     * attribute.
     * 
     * @param   SchemaElement   $sut    The element to test.
     */
    public static function assertSchemaElementHasOnlyIdAttribute(
        SchemaElement $sut
    ) {
        self::assertFalse($sut->hasAttributeFormDefault());
        self::assertFalse($sut->hasBlockDefault());
        self::assertFalse($sut->hasElementFormDefault());
        self::assertFalse($sut->hasFinalDefault());
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasTargetNamespace());
        self::assertFalse($sut->hasVersion());
        self::assertFalse($sut->hasLang());
    }
    
    /**
     * Asserts that the specified "schema" element has only the 
     * "targetNamespace" attribute.
     * 
     * @param   SchemaElement   $sut    The element to test.
     */
    public static function assertSchemaElementHasOnlyTargetNamespaceAttribute(
        SchemaElement $sut
    ) {
        self::assertFalse($sut->hasAttributeFormDefault());
        self::assertFalse($sut->hasBlockDefault());
        self::assertFalse($sut->hasElementFormDefault());
        self::assertFalse($sut->hasFinalDefault());
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasTargetNamespace());
        self::assertFalse($sut->hasVersion());
        self::assertFalse($sut->hasLang());
    }
    
    /**
     * Asserts that the specified "schema" element has only the "version" 
     * attribute.
     * 
     * @param   SchemaElement   $sut    The element to test.
     */
    public static function assertSchemaElementHasOnlyVersionAttribute(
        SchemaElement $sut
    ) {
        self::assertFalse($sut->hasAttributeFormDefault());
        self::assertFalse($sut->hasBlockDefault());
        self::assertFalse($sut->hasElementFormDefault());
        self::assertFalse($sut->hasFinalDefault());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasTargetNamespace());
        self::assertTrue($sut->hasVersion());
        self::assertFalse($sut->hasLang());
    }
    
    /**
     * Asserts that the specified "schema" element has only the "xml:lang" 
     * attribute.
     * 
     * @param   SchemaElement   $sut    The element to test.
     */
    public static function assertSchemaElementHasOnlyLangAttribute(
        SchemaElement $sut
    ) {
        self::assertFalse($sut->hasAttributeFormDefault());
        self::assertFalse($sut->hasBlockDefault());
        self::assertFalse($sut->hasElementFormDefault());
        self::assertFalse($sut->hasFinalDefault());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasTargetNamespace());
        self::assertFalse($sut->hasVersion());
        self::assertTrue($sut->hasLang());
    }
    
    /**
     * Asserts that the specified "annotation" element has no attribute.
     * 
     * @param   AnnotationElement   $sut    The element to test.
     */
    public static function assertAnnotationElementHasNoAttribute(AnnotationElement $sut)
    {
        self::assertFalse($sut->hasId());
    }
    
    /**
     * Asserts that the specified "annotation" element has only the "id" 
     * attribute.
     * 
     * @param   AnnotationElement   $sut    The element to test.
     */
    public static function assertAnnotationElementHasOnlyIdAttribute(
        AnnotationElement $sut
    ) {
        self::assertTrue($sut->hasId());
    }
    
    /**
     * Asserts that the specified "appinfo" element has no attribute.
     * 
     * @param   AppInfoElement  $sut    The element to test.
     */
    public static function assertAppInfoElementHasNoAttribute(AppInfoElement $sut)
    {
        self::assertFalse($sut->hasSource());
    }
    
    /**
     * Asserts that the specified "appinfo" element has only the "source" 
     * attribute.
     * 
     * @param   AppInfoElement  $sut    The element to test.
     */
    public static function assertAppInfoElementHasOnlySourceAttribute(
        AppInfoElement $sut
    ) {
        self::assertTrue($sut->hasSource());
    }
    
    /**
     * Asserts that the specified "documentation" element has no attribute.
     * 
     * @param   DocumentationElement    $sut    The element to test.
     */
    public static function assertDocumentationElementHasNoAttribute(
        DocumentationElement $sut
    ) {
        self::assertFalse($sut->hasSource());
        self::assertFalse($sut->hasLang());
    }
    
    /**
     * Asserts that the specified "documentation" element has only the 
     * "source" attribute.
     * 
     * @param   DocumentationElement    $sut    The element to test.
     */
    public static function assertDocumentationElementHasOnlySourceAttribute(
        DocumentationElement $sut
    ) {
        self::assertTrue($sut->hasSource());
        self::assertFalse($sut->hasLang());
    }
    
    /**
     * Asserts that the specified "documentation" element has only the 
     * "xml:lang" attribute.
     * 
     * @param   DocumentationElement    $sut    The element to test.
     */
    public static function assertDocumentationElementHasOnlyLangAttribute(
        DocumentationElement $sut
    ) {
        self::assertFalse($sut->hasSource());
        self::assertTrue($sut->hasLang());
    }
    
    /**
     * Asserts that the specified "import" element has no attribute.
     * 
     * @param   ImportElement   $sut    The element to test.
     */
    public static function assertImportElementHasNoAttribute(
        ImportElement $sut
    ) {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasNamespace());
        self::assertFalse($sut->hasSchemaLocation());
    }
    
    /**
     * Asserts that the specified "import" element has only the "id" 
     * attribute.
     * 
     * @param   ImportElement   $sut    The element to test.
     */
    public static function assertImportElementHasOnlyIdAttribute(
        ImportElement $sut
    ) {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasNamespace());
        self::assertFalse($sut->hasSchemaLocation());
    }
    
    /**
     * Asserts that the specified "import" element has only the "namespace" 
     * attribute.
     * 
     * @param   ImportElement   $sut    The element to test.
     */
    public static function assertImportElementHasOnlyNamespaceAttribute(
        ImportElement $sut
    ) {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasNamespace());
        self::assertFalse($sut->hasSchemaLocation());
    }
    
    /**
     * Asserts that the specified "import" element has only the 
     * "schemaLocation" attribute.
     * 
     * @param   ImportElement   $sut    The element to test.
     */
    public static function assertImportElementHasOnlySchemaLocationAttribute(
        ImportElement $sut
    ) {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasNamespace());
        self::assertTrue($sut->hasSchemaLocation());
    }
    
    /**
     * Asserts that the specified "include" element has no attribute.
     * 
     * @param   IncludeElement  $sut    The element to test.
     */
    public static function assertIncludeElementHasNoAttribute(
        IncludeElement $sut
    ) {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasSchemaLocation());
    }
    
    /**
     * Asserts that the specified "include" element has only the "id" 
     * attribute.
     * 
     * @param   IncludeElement  $sut    The element to test.
     */
    public static function assertIncludeElementHasOnlyIdAttribute(
        IncludeElement $sut
    ) {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasSchemaLocation());
    }
    
    /**
     * Asserts that the specified "include" element has only the 
     * "schemaLocation" attribute.
     * 
     * @param   IncludeElement  $sut    The element to test.
     */
    public static function assertIncludeElementHasOnlySchemaLocationAttribute(
        IncludeElement $sut
    ) {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasSchemaLocation());
    }
    
    /**
     * Asserts that the specified "notation" element has no attribute.
     * 
     * @param   NotationElement $sut    The element to test.
     */
    public static function assertNotationElementHasNoAttribute(
        NotationElement $sut
    ) {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasPublic());
        self::assertFalse($sut->hasSystem());
    }
    
    /**
     * Asserts that the specified "notation" element has only the "id" 
     * attribute.
     * 
     * @param   NotationElement $sut    The element to test.
     */
    public static function assertNotationElementHasOnlyIdAttribute(
        NotationElement $sut
    ) {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasPublic());
        self::assertFalse($sut->hasSystem());
    }
    
    /**
     * Asserts that the specified "notation" element has only the "name" 
     * attribute.
     * 
     * @param   NotationElement $sut    The element to test.
     */
    public static function assertNotationElementHasOnlyNameAttribute(
        NotationElement $sut
    ) {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasName());
        self::assertFalse($sut->hasPublic());
        self::assertFalse($sut->hasSystem());
    }
    
    /**
     * Asserts that the specified "notation" element has only the "public" 
     * attribute.
     * 
     * @param   NotationElement $sut    The element to test.
     */
    public static function assertNotationElementHasOnlyPublicAttribute(
        NotationElement $sut
    ) {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasName());
        self::assertTrue($sut->hasPublic());
        self::assertFalse($sut->hasSystem());
    }
    
    /**
     * Asserts that the specified "notation" element has only the "system" 
     * attribute.
     * 
     * @param   NotationElement $sut    The element to test.
     */
    public static function assertNotationElementHasOnlySystemAttribute(
        NotationElement $sut
    ) {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasPublic());
        self::assertTrue($sut->hasSystem());
    }
    
    /**
     * Asserts that the specified "attribute" element has no attribute.
     * 
     * @param   AttributeElement    $sut    The element to test.
     */
    public static function assertAttributeElementHasNoAttribute(
        AttributeElement $sut
    ) {
        self::assertFalse($sut->hasDefault());
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasRef());
        self::assertFalse($sut->hasType());
        self::assertFalse($sut->hasUse());
    }
    
    /**
     * Asserts that the specified "attribute" element has only the "default" 
     * attribute.
     * 
     * @param   AttributeElement    $sut    The element to test.
     */
    public static function assertAttributeElementHasOnlyDefaultAttribute(
        AttributeElement $sut
    ) {
        self::assertTrue($sut->hasDefault());
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasRef());
        self::assertFalse($sut->hasType());
        self::assertFalse($sut->hasUse());
    }
    
    /**
     * Asserts that the specified "attribute" element has only the "fixed" 
     * attribute.
     * 
     * @param   AttributeElement    $sut    The element to test.
     */
    public static function assertAttributeElementHasOnlyFixedAttribute(
        AttributeElement $sut
    ) {
        self::assertFalse($sut->hasDefault());
        self::assertTrue($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasRef());
        self::assertFalse($sut->hasType());
        self::assertFalse($sut->hasUse());
    }
    
    /**
     * Asserts that the specified "attribute" element has only the "id" 
     * attribute.
     * 
     * @param   AttributeElement    $sut    The element to test.
     */
    public static function assertAttributeElementHasOnlyIdAttribute(
        AttributeElement $sut
    ) {
        self::assertFalse($sut->hasDefault());
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasRef());
        self::assertFalse($sut->hasType());
        self::assertFalse($sut->hasUse());
    }
    
    /**
     * Asserts that the specified "attribute" element has only the "name" 
     * attribute.
     * 
     * @param   AttributeElement    $sut    The element to test.
     */
    public static function assertAttributeElementHasOnlyNameAttribute(
        AttributeElement $sut
    ) {
        self::assertFalse($sut->hasDefault());
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasName());
        self::assertFalse($sut->hasRef());
        self::assertFalse($sut->hasType());
        self::assertFalse($sut->hasUse());
    }
    
    /**
     * Asserts that the specified "attribute" element has only the "type" 
     * attribute.
     * 
     * @param   AttributeElement    $sut    The element to test.
     */
    public static function assertAttributeElementHasOnlyTypeAttribute(
        AttributeElement $sut
    ) {
        self::assertFalse($sut->hasDefault());
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasRef());
        self::assertTrue($sut->hasType());
        self::assertFalse($sut->hasUse());
    }
    
    /**
     * Asserts that the specified "simpleType" element has no attribute.
     * 
     * @param   SimpleTypeElement   $sut    The element to test.
     */
    public static function assertSimpleTypeElementHasNoAttribute(
        SimpleTypeElement $sut
    ) {
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasName());
    }
    
    /**
     * Asserts that the specified "simpleType" element has only the "id" 
     * attribute.
     * 
     * @param   SimpleTypeElement   $sut    The element to test.
     */
    public static function assertSimpleTypeElementHasOnlyIdAttribute(
        SimpleTypeElement $sut
    ) {
        self::assertFalse($sut->hasFinal());
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasName());
    }
    
    /**
     * Asserts that the specified "restriction" element (simpleType) has no 
     * attribute.
     * 
     * @param   SimpleTypeRestrictionElement    $sut    The element to test.
     */
    public static function assertSimpleTypeRestrictionElementHasNoAttribute(
        SimpleTypeRestrictionElement $sut
    ) {
        self::assertFalse($sut->hasBase());
        self::assertFalse($sut->hasId());
    }
    
    /**
     * Asserts that the specified "restriction" element (simpleType) has only 
     * the "base" attribute.
     * 
     * @param   SimpleTypeRestrictionElement    $sut    The element to test.
     */
    public static function assertSimpleTypeRestrictionElementHasOnlyBaseAttribute(
        SimpleTypeRestrictionElement $sut
    ) {
        self::assertTrue($sut->hasBase());
        self::assertFalse($sut->hasId());
    }
    
    /**
     * Asserts that the specified "restriction" element (simpleType) has only 
     * the "id" attribute.
     * 
     * @param   SimpleTypeRestrictionElement    $sut    The element to test.
     */
    public static function assertSimpleTypeRestrictionElementHasOnlyIdAttribute(
        SimpleTypeRestrictionElement $sut
    ) {
        self::assertFalse($sut->hasBase());
        self::assertTrue($sut->hasId());
    }
    
    /**
     * Asserts that the specified "minExclusive" element has no attribute.
     * 
     * @param   MinExclusiveElement $sut    The element to test.
     */
    public static function assertMinExclusiveElementHasNoAttribute(
        MinExclusiveElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "minExclusive" element has only the "fixed" 
     * attribute.
     * 
     * @param   MinExclusiveElement $sut    The element to test.
     */
    public static function assertMinExclusiveElementHasOnlyFixedAttribute(
        MinExclusiveElement $sut
    ) {
        self::assertTrue($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "minExclusive" element has only the "id" 
     * attribute.
     * 
     * @param   MinExclusiveElement $sut    The element to test.
     */
    public static function assertMinExclusiveElementHasOnlyIdAttribute(
        MinExclusiveElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "minExclusive" element has only the "value" 
     * attribute.
     * 
     * @param   MinExclusiveElement $sut    The element to test.
     */
    public static function assertMinExclusiveElementHasOnlyValueAttribute(
        MinExclusiveElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "minInclusive" element has no attribute.
     * 
     * @param   MinInclusiveElement $sut    The element to test.
     */
    public static function assertMinInclusiveElementHasNoAttribute(
        MinInclusiveElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "minInclusive" element has only the "fixed" 
     * attribute.
     * 
     * @param   MinInclusiveElement $sut    The element to test.
     */
    public static function assertMinInclusiveElementHasOnlyFixedAttribute(
        MinInclusiveElement $sut
    ) {
        self::assertTrue($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "minInclusive" element has only the "id" 
     * attribute.
     * 
     * @param   MinInclusiveElement $sut    The element to test.
     */
    public static function assertMinInclusiveElementHasOnlyIdAttribute(
        MinInclusiveElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "minInclusive" element has only the "value" 
     * attribute.
     * 
     * @param   MinInclusiveElement $sut    The element to test.
     */
    public static function assertMinInclusiveElementHasOnlyValueAttribute(
        MinInclusiveElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "maxExclusive" element has no attribute.
     * 
     * @param   MaxExclusiveElement $sut    The element to test.
     */
    public static function assertMaxExclusiveElementHasNoAttribute(
        MaxExclusiveElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "maxExclusive" element has only the "fixed" 
     * attribute.
     * 
     * @param   MaxExclusiveElement $sut    The element to test.
     */
    public static function assertMaxExclusiveElementHasOnlyFixedAttribute(
        MaxExclusiveElement $sut
    ) {
        self::assertTrue($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "maxExclusive" element has only the "id" 
     * attribute.
     * 
     * @param   MaxExclusiveElement $sut    The element to test.
     */
    public static function assertMaxExclusiveElementHasOnlyIdAttribute(
        MaxExclusiveElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "maxExclusive" element has only the "value" 
     * attribute.
     * 
     * @param   MaxExclusiveElement $sut    The element to test.
     */
    public static function assertMaxExclusiveElementHasOnlyValueAttribute(
        MaxExclusiveElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "maxInclusive" element has no attribute.
     * 
     * @param   MaxInclusiveElement $sut    The element to test.
     */
    public static function assertMaxInclusiveElementHasNoAttribute(
        MaxInclusiveElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "maxInclusive" element has only the "fixed" 
     * attribute.
     * 
     * @param   MaxInclusiveElement $sut    The element to test.
     */
    public static function assertMaxInclusiveElementHasOnlyFixedAttribute(
        MaxInclusiveElement $sut
    ) {
        self::assertTrue($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "maxInclusive" element has only the "id" 
     * attribute.
     * 
     * @param   MaxInclusiveElement $sut    The element to test.
     */
    public static function assertMaxInclusiveElementHasOnlyIdAttribute(
        MaxInclusiveElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "maxInclusive" element has only the "value" 
     * attribute.
     * 
     * @param   MaxInclusiveElement $sut    The element to test.
     */
    public static function assertMaxInclusiveElementHasOnlyValueAttribute(
        MaxInclusiveElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "totalDigits" element has no attribute.
     * 
     * @param   TotalDigitsElement  $sut    The element to test.
     */
    public static function assertTotalDigitsElementHasNoAttribute(
        TotalDigitsElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "totalDigits" element has only the "fixed" 
     * attribute.
     * 
     * @param   TotalDigitsElement  $sut    The element to test.
     */
    public static function assertTotalDigitsElementHasOnlyFixedAttribute(
        TotalDigitsElement $sut
    ) {
        self::assertTrue($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "totalDigits" element has only the "id" 
     * attribute.
     * 
     * @param   TotalDigitsElement  $sut    The element to test.
     */
    public static function assertTotalDigitsElementHasOnlyIdAttribute(
        TotalDigitsElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "totalDigits" element has only the "value" 
     * attribute.
     * 
     * @param   TotalDigitsElement  $sut    The element to test.
     */
    public static function assertTotalDigitsElementHasOnlyValueAttribute(
        TotalDigitsElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "fractionDigits" element has no attribute.
     * 
     * @param   FractionDigitsElement   $sut    The element to test.
     */
    public static function assertFractionDigitsElementHasNoAttribute(
        FractionDigitsElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "fractionDigits" element has only the 
     * "fixed" attribute.
     * 
     * @param   FractionDigitsElement   $sut    The element to test.
     */
    public static function assertFractionDigitsElementHasOnlyFixedAttribute(
        FractionDigitsElement $sut
    ) {
        self::assertTrue($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "fractionDigits" element has only the 
     * "id" attribute.
     * 
     * @param   FractionDigitsElement   $sut    The element to test.
     */
    public static function assertFractionDigitsElementHasOnlyIdAttribute(
        FractionDigitsElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "fractionDigits" element has only the 
     * "value" attribute.
     * 
     * @param   FractionDigitsElement   $sut    The element to test.
     */
    public static function assertFractionDigitsElementHasOnlyValueAttribute(
        FractionDigitsElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "length" element has no attribute.
     * 
     * @param   LengthElement   $sut    The element to test.
     */
    public static function assertLengthElementHasNoAttribute(
        LengthElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "length" element has only the "fixed" 
     * attribute.
     * 
     * @param   LengthElement   $sut    The element to test.
     */
    public static function assertLengthElementHasOnlyFixedAttribute(
        LengthElement $sut
    ) {
        self::assertTrue($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "length" element has only the "id" 
     * attribute.
     * 
     * @param   LengthElement   $sut    The element to test.
     */
    public static function assertLengthElementHasOnlyIdAttribute(
        LengthElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "length" element has only the "value" 
     * attribute.
     * 
     * @param   LengthElement   $sut    The element to test.
     */
    public static function assertLengthElementHasOnlyValueAttribute(
        LengthElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "minLength" element has no attribute.
     * 
     * @param   MinLengthElement    $sut    The element to test.
     */
    public static function assertMinLengthElementHasNoAttribute(
        MinLengthElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "minLength" element has only the "fixed" 
     * attribute.
     * 
     * @param   MinLengthElement    $sut    The element to test.
     */
    public static function assertMinLengthElementHasOnlyFixedAttribute(
        MinLengthElement $sut
    ) {
        self::assertTrue($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "minLength" element has only the "id" 
     * attribute.
     * 
     * @param   MinLengthElement    $sut    The element to test.
     */
    public static function assertMinLengthElementHasOnlyIdAttribute(
        MinLengthElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "minLength" element has only the "value" 
     * attribute.
     * 
     * @param   MinLengthElement    $sut    The element to test.
     */
    public static function assertMinLengthElementHasOnlyValueAttribute(
        MinLengthElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "maxLength" element has no attribute.
     * 
     * @param   MaxLengthElement    $sut    The element to test.
     */
    public static function assertMaxLengthElementHasNoAttribute(
        MaxLengthElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "maxLength" element has only the "fixed" 
     * attribute.
     * 
     * @param   MaxLengthElement    $sut    The element to test.
     */
    public static function assertMaxLengthElementHasOnlyFixedAttribute(
        MaxLengthElement $sut
    ) {
        self::assertTrue($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "maxLength" element has only the "id" 
     * attribute.
     * 
     * @param   MaxLengthElement    $sut    The element to test.
     */
    public static function assertMaxLengthElementHasOnlyIdAttribute(
        MaxLengthElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "maxLength" element has only the "value" 
     * attribute.
     * 
     * @param   MaxLengthElement    $sut    The element to test.
     */
    public static function assertMaxLengthElementHasOnlyValueAttribute(
        MaxLengthElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "enumeration" element has no attribute.
     * 
     * @param   EnumerationElement  $sut    The element to test.
     */
    public static function assertEnumerationElementHasNoAttribute(
        EnumerationElement $sut
    ) {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "enumeration" element has only the "id" 
     * attribute.
     * 
     * @param   EnumerationElement  $sut    The element to test.
     */
    public static function assertEnumerationElementHasOnlyIdAttribute(
        EnumerationElement $sut
    ) {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "enumeration" element has only the "value" 
     * attribute.
     * 
     * @param   EnumerationElement  $sut    The element to test.
     */
    public static function assertEnumerationElementHasOnlyValueAttribute(
        EnumerationElement $sut
    ) {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "whiteSpace" element has no attribute.
     * 
     * @param   WhiteSpaceElement   $sut    The element to test.
     */
    public static function assertWhiteSpaceElementHasNoAttribute(
        WhiteSpaceElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "whiteSpace" element has only the "fixed" 
     * attribute.
     * 
     * @param   WhiteSpaceElement   $sut    The element to test.
     */
    public static function assertWhiteSpaceElementHasOnlyFixedAttribute(
        WhiteSpaceElement $sut
    ) {
        self::assertTrue($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "whiteSpace" element has only the "id" 
     * attribute.
     * 
     * @param   WhiteSpaceElement   $sut    The element to test.
     */
    public static function assertWhiteSpaceElementHasOnlyIdAttribute(
        WhiteSpaceElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "whiteSpace" element has only the "value" 
     * attribute.
     * 
     * @param   WhiteSpaceElement   $sut    The element to test.
     */
    public static function assertWhiteSpaceElementHasOnlyValueAttribute(
        WhiteSpaceElement $sut
    ) {
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "pattern" element has no attribute.
     * 
     * @param   PatternElement  $sut    The element to test.
     */
    public static function assertPatternElementHasNoAttribute(
        PatternElement $sut
    ) {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "pattern" element has only the "id" 
     * attribute.
     * 
     * @param   PatternElement  $sut    The element to test.
     */
    public static function assertPatternElementHasOnlyIdAttribute(
        PatternElement $sut
    ) {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "pattern" element has only the "value" 
     * attribute.
     * 
     * @param   PatternElement  $sut    The element to test.
     */
    public static function assertPatternElementHasOnlyValueAttribute(
        PatternElement $sut
    ) {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasValue());
    }
}
