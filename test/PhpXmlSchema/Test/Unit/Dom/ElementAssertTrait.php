<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\AllElement;
use PhpXmlSchema\Dom\AnnotationElement;
use PhpXmlSchema\Dom\AnyAttributeElement;
use PhpXmlSchema\Dom\AnyElement;
use PhpXmlSchema\Dom\AppInfoElement;
use PhpXmlSchema\Dom\AttributeElement;
use PhpXmlSchema\Dom\AttributeGroupElement;
use PhpXmlSchema\Dom\ChoiceElement;
use PhpXmlSchema\Dom\ComplexContentElement;
use PhpXmlSchema\Dom\ComplexContentExtensionElement;
use PhpXmlSchema\Dom\ComplexContentRestrictionElement;
use PhpXmlSchema\Dom\ComplexTypeElement;
use PhpXmlSchema\Dom\DocumentationElement;
use PhpXmlSchema\Dom\ElementInterface;
use PhpXmlSchema\Dom\ElementElement;
use PhpXmlSchema\Dom\EnumerationElement;
use PhpXmlSchema\Dom\FieldElement;
use PhpXmlSchema\Dom\FractionDigitsElement;
use PhpXmlSchema\Dom\GroupElement;
use PhpXmlSchema\Dom\ImportElement;
use PhpXmlSchema\Dom\IncludeElement;
use PhpXmlSchema\Dom\KeyElement;
use PhpXmlSchema\Dom\KeyRefElement;
use PhpXmlSchema\Dom\LengthElement;
use PhpXmlSchema\Dom\ListElement;
use PhpXmlSchema\Dom\MaxExclusiveElement;
use PhpXmlSchema\Dom\MaxInclusiveElement;
use PhpXmlSchema\Dom\MaxLengthElement;
use PhpXmlSchema\Dom\MinExclusiveElement;
use PhpXmlSchema\Dom\MinInclusiveElement;
use PhpXmlSchema\Dom\MinLengthElement;
use PhpXmlSchema\Dom\NotationElement;
use PhpXmlSchema\Dom\PatternElement;
use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SelectorElement;
use PhpXmlSchema\Dom\SequenceElement;
use PhpXmlSchema\Dom\SimpleContentElement;
use PhpXmlSchema\Dom\SimpleContentExtensionElement;
use PhpXmlSchema\Dom\SimpleContentRestrictionElement;
use PhpXmlSchema\Dom\SimpleTypeElement;
use PhpXmlSchema\Dom\SimpleTypeRestrictionElement;
use PhpXmlSchema\Dom\TotalDigitsElement;
use PhpXmlSchema\Dom\UnionElement;
use PhpXmlSchema\Dom\UniqueElement;
use PhpXmlSchema\Dom\WhiteSpaceElement;

/**
 * Represents a trait to assert XML Schema elements.
 * 
 * It must be used in a class that extends the {@see PHPUnit\Framework\TestCase} 
 * class and uses the {@see PhpXmlSchema\Test\Dom\XmlAssertTrait} trait.
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
    public static function assertElementNamespaceDeclarations(array $decls, ElementInterface $sut): void
    {
        self::assertNamespaceDeclarations($decls, $sut->getNamespaceDeclarations());
    }
    
    /**
     * Asserts that the specified "schema" element has no attribute.
     * 
     * @param   SchemaElement   $sut    The element to test.
     */
    public static function assertSchemaElementHasNoAttribute(SchemaElement $sut): void
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    public static function assertAnnotationElementHasNoAttribute(AnnotationElement $sut): void
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
    ): void
    {
        self::assertTrue($sut->hasId());
    }
    
    /**
     * Asserts that the specified "appinfo" element has no attribute.
     * 
     * @param   AppInfoElement  $sut    The element to test.
     */
    public static function assertAppInfoElementHasNoAttribute(AppInfoElement $sut): void
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
    ): void
    {
        self::assertTrue($sut->hasSource());
    }
    
    /**
     * Asserts that the specified "documentation" element has no attribute.
     * 
     * @param   DocumentationElement    $sut    The element to test.
     */
    public static function assertDocumentationElementHasNoAttribute(
        DocumentationElement $sut
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
     * Asserts that the specified "attribute" element has only the "form" 
     * attribute.
     * 
     * @param   AttributeElement    $sut    The element to test.
     */
    public static function assertAttributeElementHasOnlyFormAttribute(
        AttributeElement $sut
    ): void
    {
        self::assertFalse($sut->hasDefault());
        self::assertFalse($sut->hasFixed());
        self::assertTrue($sut->hasForm());
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
    ): void
    {
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
    ): void
    {
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
     * Asserts that the specified "attribute" element has only the "ref" 
     * attribute.
     * 
     * @param   AttributeElement    $sut    The element to test.
     */
    public static function assertAttributeElementHasOnlyRefAttribute(
        AttributeElement $sut
    ): void
    {
        self::assertFalse($sut->hasDefault());
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasName());
        self::assertTrue($sut->hasRef());
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
    ): void
    {
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
     * Asserts that the specified "attribute" element has only the "use" 
     * attribute.
     * 
     * @param   AttributeElement    $sut    The element to test.
     */
    public static function assertAttributeElementHasOnlyUseAttribute(
        AttributeElement $sut
    ): void
    {
        self::assertFalse($sut->hasDefault());
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasRef());
        self::assertFalse($sut->hasType());
        self::assertTrue($sut->hasUse());
    }
    
    /**
     * Asserts that the specified "simpleType" element has no attribute.
     * 
     * @param   SimpleTypeElement   $sut    The element to test.
     */
    public static function assertSimpleTypeElementHasNoAttribute(
        SimpleTypeElement $sut
    ): void
    {
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasName());
    }
    
    /**
     * Asserts that the specified "simpleType" element has only the "final" 
     * attribute.
     * 
     * @param   SimpleTypeElement   $sut    The element to test.
     */
    public static function assertSimpleTypeElementHasOnlyFinalAttribute(
        SimpleTypeElement $sut
    ): void
    {
        self::assertTrue($sut->hasFinal());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasName());
    }
    
    /**
     * Asserts that the "final" attribute:
     * - byRestriction() returns the same value as the expected "restriction" flag
     * - byExtension() returns FALSE
     * - bySubstitution() returns FALSE
     * - byList() returns returns the same value as the expected "list" flag
     * - byUnion() returns returns the same value as the expected "union" flag
     * 
     * @param   bool                $list   The expected value for the "list" flag.
     * @param   bool                $union  The expected value for the "union" flag.
     * @param   bool                $res    The expected value for the "restriction" flag.
     * @param   SimpleTypeElement   $st     The element that holds the attribute.
     */
    public static function assertSimpleTypeElementFinalAttribute(
        bool $list, 
        bool $union, 
        bool $res, 
        SimpleTypeElement $st
    ): void
    {
        $sut = $st->getFinal();
        self::assertSame($res, $sut->byRestriction());
        self::assertFalse($sut->byExtension());
        self::assertFalse($sut->bySubstitution());
        self::assertSame($list, $sut->byList());
        self::assertSame($union, $sut->byUnion());
    }
    
    /**
     * Asserts that the specified "simpleType" element has only the "id" 
     * attribute.
     * 
     * @param   SimpleTypeElement   $sut    The element to test.
     */
    public static function assertSimpleTypeElementHasOnlyIdAttribute(
        SimpleTypeElement $sut
    ): void
    {
        self::assertFalse($sut->hasFinal());
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasName());
    }
    
    /**
     * Asserts that the specified "simpleType" element has only the "name" 
     * attribute.
     * 
     * @param   SimpleTypeElement   $sut    The element to test.
     */
    public static function assertSimpleTypeElementHasOnlyNameAttribute(
        SimpleTypeElement $sut
    ): void
    {
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasName());
    }
    
    /**
     * Asserts that the specified "restriction" element (simpleType) has no 
     * attribute.
     * 
     * @param   SimpleTypeRestrictionElement    $sut    The element to test.
     */
    public static function assertSimpleTypeRestrictionElementHasNoAttribute(
        SimpleTypeRestrictionElement $sut
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
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
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasValue());
    }
    
    /**
     * Asserts that the specified "list" element has no attribute.
     * 
     * @param   ListElement $sut    The element to test.
     */
    public static function assertListElementHasNoAttribute(
        ListElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasItemType());
    }
    
    /**
     * Asserts that the specified "list" element has only the "id" 
     * attribute.
     * 
     * @param   ListElement $sut    The element to test.
     */
    public static function assertListElementHasOnlyIdAttribute(
        ListElement $sut
    ): void
    {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasItemType());
    }
    
    /**
     * Asserts that the specified "list" element has only the "itemType" 
     * attribute.
     * 
     * @param   ListElement $sut    The element to test.
     */
    public static function assertListElementHasOnlyItemTypeAttribute(
        ListElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasItemType());
    }
    
    /**
     * Asserts that the specified "union" element has no attribute.
     * 
     * @param   UnionElement    $sut    The element to test.
     */
    public static function assertUnionElementHasNoAttribute(
        UnionElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMemberTypes());
    }
    
    /**
     * Asserts that the specified "union" element has only the "id" attribute.
     * 
     * @param   UnionElement    $sut    The element to test.
     */
    public static function assertUnionElementHasOnlyIdAttribute(
        UnionElement $sut
    ): void
    {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasMemberTypes());
    }
    
    /**
     * Asserts that the specified "union" element has only the "memberTypes" 
     * attribute.
     * 
     * @param   UnionElement    $sut    The element to test.
     */
    public static function assertUnionElementHasOnlyMemberTypesAttribute(
        UnionElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasMemberTypes());
    }
    
    /**
     * Asserts that the specified "attributeGroup" element has no attribute.
     * 
     * @param   AttributeGroupElement   $sut    The element to test.
     */
    public static function assertAttributeGroupElementHasNoAttribute(
        AttributeGroupElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasRef());
    }
    
    /**
     * Asserts that the specified "attributeGroup" element has only the "id" 
     * attribute.
     * 
     * @param   AttributeGroupElement   $sut    The element to test.
     */
    public static function assertAttributeGroupElementHasOnlyIdAttribute(
        AttributeGroupElement $sut
    ): void
    {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasRef());
    }
    
    /**
     * Asserts that the specified "attributeGroup" element has only the 
     * "name" attribute.
     * 
     * @param   AttributeGroupElement   $sut    The element to test.
     */
    public static function assertAttributeGroupElementHasOnlyNameAttribute(
        AttributeGroupElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasName());
        self::assertFalse($sut->hasRef());
    }
    
    /**
     * Asserts that the specified "attributeGroup" element has only the "ref" 
     * attribute.
     * 
     * @param   AttributeGroupElement   $sut    The element to test.
     */
    public static function assertAttributeGroupElementHasOnlyRefAttribute(
        AttributeGroupElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasName());
        self::assertTrue($sut->hasRef());
    }
    
    /**
     * Asserts that the specified "anyAttribute" element has no attribute.
     * 
     * @param   AnyAttributeElement $sut    The element to test.
     */
    public static function assertAnyAttributeElementHasNoAttribute(
        AnyAttributeElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasNamespace());
        self::assertFalse($sut->hasProcessContents());
    }
    
    /**
     * Asserts that the specified "anyAttribute" element has only the "id" 
     * attribute.
     * 
     * @param   AnyAttributeElement $sut    The element to test.
     */
    public static function assertAnyAttributeElementHasOnlyIdAttribute(
        AnyAttributeElement $sut
    ): void
    {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasNamespace());
        self::assertFalse($sut->hasProcessContents());
    }
    
    /**
     * Asserts that the specified "anyAttribute" element has only the 
     * "namespace" attribute.
     * 
     * @param   AnyAttributeElement $sut    The element to test.
     */
    public static function assertAnyAttributeElementHasOnlyNamespaceAttribute(
        AnyAttributeElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasNamespace());
        self::assertFalse($sut->hasProcessContents());
    }
    
    /**
     * Asserts that the "namespace" attribute:
     * - hasAny() returns the same value as the expected "any" flag
     * - hasOther() returns the same value as the expected "other" flag
     * - hasTargetNamespace() returns the same value as the expected "targetNamespace" flag
     * - hasLocal() returns the same value as the expected "local" flag
     * - getNamespaces() returns the same anyURI list
     * 
     * @param   bool                $any        The expected value for the "any" flag.
     * @param   bool                $other      The expected value for the "other" flag.
     * @param   bool                $targetNs   The expected value for the "targetNamespace" flag.
     * @param   bool                $local      The expected value for the "local" flag.
     * @param   string[]            $uris       The expected value for the anyURI list.
     * @param   AnyAttributeElement $sut        The element to test.
     */
    public static function assertAnyAttributeElementNamespaceAttribute(
        bool $any, 
        bool $other, 
        bool $targetNs, 
        bool $local, 
        array $uris, 
        AnyAttributeElement $sut
    ): void
    {
        self::assertSame($any, $sut->getNamespace()->hasAny());
        self::assertSame($other, $sut->getNamespace()->hasOther());
        self::assertSame($targetNs, $sut->getNamespace()->hasTargetNamespace());
        self::assertSame($local, $sut->getNamespace()->hasLocal());
        
        $namespaces = [];
        
        foreach ($sut->getNamespace()->getNamespaces() as $uri) {
            $namespaces[] = $uri->getAnyUri();
        }
        
        self::assertSame($uris, $namespaces);
    }
    
    /**
     * Asserts that the specified "anyAttribute" element has only the 
     * "processContents" attribute.
     * 
     * @param   AnyAttributeElement $sut    The element to test.
     */
    public static function assertAnyAttributeElementHasOnlyProcessContentsAttribute(
        AnyAttributeElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasNamespace());
        self::assertTrue($sut->hasProcessContents());
    }
    
    /**
     * Asserts that the specified "complexType" element has no attribute.
     * 
     * @param   ComplexTypeElement  $sut    The element to test.
     */
    public static function assertComplexTypeElementHasNoAttribute(
        ComplexTypeElement $sut
    ): void
    {
        self::assertFalse($sut->hasAbstract());
        self::assertFalse($sut->hasBlock());
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMixed());
        self::assertFalse($sut->hasName());
    }
    
    /**
     * Asserts that the specified "complexType" element has only the 
     * "abstract" attribute.
     * 
     * @param   ComplexTypeElement  $sut    The element to test.
     */
    public static function assertComplexTypeElementHasOnlyAbstractAttribute(
        ComplexTypeElement $sut
    ): void
    {
        self::assertTrue($sut->hasAbstract());
        self::assertFalse($sut->hasBlock());
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMixed());
        self::assertFalse($sut->hasName());
    }
    
    /**
     * Asserts that the specified "complexType" element has only the "block" 
     * attribute.
     * 
     * @param   ComplexTypeElement  $sut    The element to test.
     */
    public static function assertComplexTypeElementHasOnlyBlockAttribute(
        ComplexTypeElement $sut
    ): void
    {
        self::assertFalse($sut->hasAbstract());
        self::assertTrue($sut->hasBlock());
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMixed());
        self::assertFalse($sut->hasName());
    }
    
    /**
     * Asserts that the "block" attribute:
     * - byRestriction() returns the same value as the expected "restriction" flag
     * - byExtension() returns the same value as the expected "extension" flag
     * - bySubstitution() returns FALSE
     * - byList() returns FALSE
     * - byUnion() returns FALSE
     * 
     * @param   bool                $ext    The expected value for the "extension" flag.
     * @param   bool                $res    The expected value for the "restriction" flag.
     * @param   ComplexTypeElement  $elt    The element that holds the attribute.
     */
    public static function assertComplexTypeElementBlockAttribute(
        bool $ext, 
        bool $res, 
        ComplexTypeElement $elt
    ): void
    {
        $sut = $elt->getBlock();
        self::assertSame($res, $sut->byRestriction());
        self::assertSame($ext, $sut->byExtension());
        self::assertFalse($sut->bySubstitution());
        self::assertFalse($sut->byList());
        self::assertFalse($sut->byUnion());
    }
    
    /**
     * Asserts that the specified "complexType" element has only the "final" 
     * attribute.
     * 
     * @param   ComplexTypeElement  $sut    The element to test.
     */
    public static function assertComplexTypeElementHasOnlyFinalAttribute(
        ComplexTypeElement $sut
    ): void
    {
        self::assertFalse($sut->hasAbstract());
        self::assertFalse($sut->hasBlock());
        self::assertTrue($sut->hasFinal());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMixed());
        self::assertFalse($sut->hasName());
    }
    
    /**
     * Asserts that the "final" attribute:
     * - byRestriction() returns the same value as the expected "restriction" flag
     * - byExtension() returns the same value as the expected "extension" flag
     * - bySubstitution() returns FALSE
     * - byList() returns FALSE
     * - byUnion() returns FALSE
     * 
     * @param   bool                $ext    The expected value for the "extension" flag.
     * @param   bool                $res    The expected value for the "restriction" flag.
     * @param   ComplexTypeElement  $elt    The element that holds the attribute.
     */
    public static function assertComplexTypeElementFinalAttribute(
        bool $ext, 
        bool $res, 
        ComplexTypeElement $elt
    ): void
    {
        $sut = $elt->getFinal();
        self::assertSame($res, $sut->byRestriction());
        self::assertSame($ext, $sut->byExtension());
        self::assertFalse($sut->bySubstitution());
        self::assertFalse($sut->byList());
        self::assertFalse($sut->byUnion());
    }
    
    /**
     * Asserts that the specified "complexType" element has only the "id" 
     * attribute.
     * 
     * @param   ComplexTypeElement  $sut    The element to test.
     */
    public static function assertComplexTypeElementHasOnlyIdAttribute(
        ComplexTypeElement $sut
    ): void
    {
        self::assertFalse($sut->hasAbstract());
        self::assertFalse($sut->hasBlock());
        self::assertFalse($sut->hasFinal());
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasMixed());
        self::assertFalse($sut->hasName());
    }
    
    /**
     * Asserts that the specified "complexType" element has only the "mixed" 
     * attribute.
     * 
     * @param   ComplexTypeElement  $sut    The element to test.
     */
    public static function assertComplexTypeElementHasOnlyMixedAttribute(
        ComplexTypeElement $sut
    ): void
    {
        self::assertFalse($sut->hasAbstract());
        self::assertFalse($sut->hasBlock());
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasMixed());
        self::assertFalse($sut->hasName());
    }
    
    /**
     * Asserts that the specified "complexType" element has only the "name" 
     * attribute.
     * 
     * @param   ComplexTypeElement  $sut    The element to test.
     */
    public static function assertComplexTypeElementHasOnlyNameAttribute(
        ComplexTypeElement $sut
    ): void
    {
        self::assertFalse($sut->hasAbstract());
        self::assertFalse($sut->hasBlock());
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMixed());
        self::assertTrue($sut->hasName());
    }
    
    /**
     * Asserts that the specified "simpleContent" element has no attribute.
     * 
     * @param   SimpleContentElement    $sut    The element to test.
     */
    public static function assertSimpleContentElementHasNoAttribute(
        SimpleContentElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
    }
    
    /**
     * Asserts that the specified "simpleContent" element has only the "id" 
     * attribute.
     * 
     * @param   SimpleContentElement    $sut    The element to test.
     */
    public static function assertSimpleContentElementHasOnlyIdAttribute(
        SimpleContentElement $sut
    ): void
    {
        self::assertTrue($sut->hasId());
    }
    
    /**
     * Asserts that the specified "restriction" element 
     * (simpleRestrictionType) has no attribute.
     * 
     * @param   SimpleContentRestrictionElement $sut    The element to test.
     */
    public static function assertSimpleContentRestrictionElementHasNoAttribute(
        SimpleContentRestrictionElement $sut
    ): void
    {
        self::assertFalse($sut->hasBase());
        self::assertFalse($sut->hasId());
    }
    
    /**
     * Asserts that the specified "restriction" element 
     * (simpleRestrictionType) has only the "base" attribute.
     * 
     * @param   SimpleContentRestrictionElement $sut    The element to test.
     */
    public static function assertSimpleContentRestrictionElementHasOnlyBaseAttribute(
        SimpleContentRestrictionElement $sut
    ): void
    {
        self::assertTrue($sut->hasBase());
        self::assertFalse($sut->hasId());
    }
    
    /**
     * Asserts that the specified "restriction" element 
     * (simpleRestrictionType) has only the "id" attribute.
     * 
     * @param   SimpleContentRestrictionElement $sut    The element to test.
     */
    public static function assertSimpleContentRestrictionElementHasOnlyIdAttribute(
        SimpleContentRestrictionElement $sut
    ): void
    {
        self::assertFalse($sut->hasBase());
        self::assertTrue($sut->hasId());
    }
    
    /**
     * Asserts that the specified "extension" element (simpleExtensionType) 
     * has no attribute.
     * 
     * @param   SimpleContentExtensionElement   $sut    The element to test.
     */
    public static function assertSimpleContentExtensionElementHasNoAttribute(
        SimpleContentExtensionElement $sut
    ): void
    {
        self::assertFalse($sut->hasBase());
        self::assertFalse($sut->hasId());
    }
    
    /**
     * Asserts that the specified "extension" element (simpleExtensionType) 
     * has only the "base" attribute.
     * 
     * @param   SimpleContentExtensionElement   $sut    The element to test.
     */
    public static function assertSimpleContentExtensionElementHasOnlyBaseAttribute(
        SimpleContentExtensionElement $sut
    ): void
    {
        self::assertTrue($sut->hasBase());
        self::assertFalse($sut->hasId());
    }
    
    /**
     * Asserts that the specified "extension" element (simpleExtensionType) 
     * has only the "id" attribute.
     * 
     * @param   SimpleContentExtensionElement   $sut    The element to test.
     */
    public static function assertSimpleContentExtensionElementHasOnlyIdAttribute(
        SimpleContentExtensionElement $sut
    ): void
    {
        self::assertFalse($sut->hasBase());
        self::assertTrue($sut->hasId());
    }
    
    /**
     * Asserts that the specified "complexContent" element has no attribute.
     * 
     * @param   ComplexContentElement   $sut    The element to test.
     */
    public static function assertComplexContentElementHasNoAttribute(
        ComplexContentElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMixed());
    }
    
    /**
     * Asserts that the specified "complexContent" element has only the "id" 
     * attribute.
     * 
     * @param   ComplexContentElement   $sut    The element to test.
     */
    public static function assertComplexContentElementHasOnlyIdAttribute(
        ComplexContentElement $sut
    ): void
    {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasMixed());
    }
    
    /**
     * Asserts that the specified "complexContent" element has only the 
     * "mixed" attribute.
     * 
     * @param   ComplexContentElement   $sut    The element to test.
     */
    public static function assertComplexContentElementHasOnlyMixedAttribute(
        ComplexContentElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasMixed());
    }
    
    /**
     * Asserts that the specified "restriction" element 
     * (complexRestrictionType) has no attribute.
     * 
     * @param   ComplexContentRestrictionElement    $sut    The element to test.
     */
    public static function assertComplexContentRestrictionElementHasNoAttribute(
        ComplexContentRestrictionElement $sut
    ): void
    {
        self::assertFalse($sut->hasBase());
        self::assertFalse($sut->hasId());
    }
    
    /**
     * Asserts that the specified "restriction" element 
     * (complexRestrictionType) has only the "base" attribute.
     * 
     * @param   ComplexContentRestrictionElement    $sut    The element to test.
     */
    public static function assertComplexContentRestrictionElementHasOnlyBaseAttribute(
        ComplexContentRestrictionElement $sut
    ): void
    {
        self::assertTrue($sut->hasBase());
        self::assertFalse($sut->hasId());
    }
    
    /**
     * Asserts that the specified "restriction" element 
     * (complexRestrictionType) has only the "id" attribute.
     * 
     * @param   ComplexContentRestrictionElement    $sut    The element to test.
     */
    public static function assertComplexContentRestrictionElementHasOnlyIdAttribute(
        ComplexContentRestrictionElement $sut
    ): void
    {
        self::assertFalse($sut->hasBase());
        self::assertTrue($sut->hasId());
    }
    
    /**
     * Asserts that the specified "group" element has no attribute.
     * 
     * @param   GroupElement    $sut    The element to test.
     */
    public static function assertGroupElementHasNoAttribute(GroupElement $sut)
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasRef());
    }
    
    /**
     * Asserts that the specified "group" element has only the "id" attribute.
     * 
     * @param   GroupElement    $sut    The element to test.
     */
    public static function assertGroupElementHasOnlyIdAttribute(GroupElement $sut)
    {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasRef());
    }
    
    /**
     * Asserts that the specified "group" element has only the "maxOccurs" 
     * attribute.
     * 
     * @param   GroupElement    $sut    The element to test.
     */
    public static function assertGroupElementHasOnlyMaxOccursAttribute(
        GroupElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasRef());
    }
    
    /**
     * Asserts that the specified "group" element has only the "minOccurs" 
     * attribute.
     * 
     * @param   GroupElement    $sut    The element to test.
     */
    public static function assertGroupElementHasOnlyMinOccursAttribute(
        GroupElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertTrue($sut->hasMinOccurs());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasRef());
    }
    
    /**
     * Asserts that the specified "group" element has only the "name" 
     * attribute.
     * 
     * @param   GroupElement    $sut    The element to test.
     */
    public static function assertGroupElementHasOnlyNameAttribute(
        GroupElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertTrue($sut->hasName());
        self::assertFalse($sut->hasRef());
    }
    
    /**
     * Asserts that the specified "group" element has only the "ref" 
     * attribute.
     * 
     * @param   GroupElement    $sut    The element to test.
     */
    public static function assertGroupElementHasOnlyRefAttribute(
        GroupElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasName());
        self::assertTrue($sut->hasRef());
    }
    
    /**
     * Asserts that the specified "all" element has no attribute.
     * 
     * @param   AllElement  $sut    The element to test.
     */
    public static function assertAllElementHasNoAttribute(AllElement $sut)
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
    }
    
    /**
     * Asserts that the specified "all" element has only the "id" attribute.
     * 
     * @param   AllElement  $sut    The element to test.
     */
    public static function assertAllElementHasOnlyIdAttribute(
        AllElement $sut
    ): void
    {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
    }
    
    /**
     * Asserts that the specified "all" element has only the "maxOccurs" 
     * attribute.
     * 
     * @param   AllElement  $sut    The element to test.
     */
    public static function assertAllElementHasOnlyMaxOccursAttribute(
        AllElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
    }
    
    /**
     * Asserts that the specified "all" element has only the "minOccurs" 
     * attribute.
     * 
     * @param   AllElement  $sut    The element to test.
     */
    public static function assertAllElementHasOnlyMinOccursAttribute(
        AllElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertTrue($sut->hasMinOccurs());
    }
    
    /**
     * Asserts that the specified "element" element has no attribute.
     * 
     * @param   ElementElement  $sut    The element to test.
     */
    public static function assertElementElementHasNoAttribute(
        ElementElement $sut
    ): void
    {
        self::assertFalse($sut->hasAbstract());
        self::assertFalse($sut->hasBlock());
        self::assertFalse($sut->hasDefault());
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasNillable());
        self::assertFalse($sut->hasRef());
        self::assertFalse($sut->hasSubstitutionGroup());
        self::assertFalse($sut->hasType());
    }
    
    /**
     * Asserts that the specified "element" element has only the "abstract" 
     * attribute.
     * 
     * @param   ElementElement  $sut    The element to test.
     */
    public static function assertElementElementHasOnlyAbstractAttribute(
        ElementElement $sut
    ): void
    {
        self::assertTrue($sut->hasAbstract());
        self::assertFalse($sut->hasBlock());
        self::assertFalse($sut->hasDefault());
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasNillable());
        self::assertFalse($sut->hasRef());
        self::assertFalse($sut->hasSubstitutionGroup());
        self::assertFalse($sut->hasType());
    }
    
    /**
     * Asserts that the specified "element" element has only the "block" 
     * attribute.
     * 
     * @param   ElementElement  $sut    The element to test.
     */
    public static function assertElementElementHasOnlyBlockAttribute(
        ElementElement $sut
    ): void
    {
        self::assertFalse($sut->hasAbstract());
        self::assertTrue($sut->hasBlock());
        self::assertFalse($sut->hasDefault());
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasNillable());
        self::assertFalse($sut->hasRef());
        self::assertFalse($sut->hasSubstitutionGroup());
        self::assertFalse($sut->hasType());
    }
    
    /**
     * Asserts that the "block" attribute:
     * - byRestriction() returns the same value as the expected "restriction" flag
     * - byExtension() returns the same value as the expected "extension" flag
     * - bySubstitution() returns the same value as the expected "substitution" flag
     * - byList() returns FALSE
     * - byUnion() returns FALSE
     * 
     * @param   bool            $res    The expected value for the "restriction" flag.
     * @param   bool            $ext    The expected value for the "extension" flag.
     * @param   bool            $sub    The expected value for the "substitution" flag.
     * @param   ElementElement  $elt    The element to test.
     */
    public static function assertElementElementBlockAttribute(
        bool $res, 
        bool $ext, 
        bool $sub, 
        ElementElement $elt
    ): void
    {
        $sut = $elt->getBlock();
        self::assertSame($res, $sut->byRestriction());
        self::assertSame($ext, $sut->byExtension());
        self::assertSame($sub, $sut->bySubstitution());
        self::assertFalse($sut->byList());
        self::assertFalse($sut->byUnion());
    }
    
    /**
     * Asserts that the specified "element" element has only the "default" 
     * attribute.
     * 
     * @param   ElementElement  $sut    The element to test.
     */
    public static function assertElementElementHasOnlyDefaultAttribute(
        ElementElement $sut
    ): void
    {
        self::assertFalse($sut->hasAbstract());
        self::assertFalse($sut->hasBlock());
        self::assertTrue($sut->hasDefault());
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasNillable());
        self::assertFalse($sut->hasRef());
        self::assertFalse($sut->hasSubstitutionGroup());
        self::assertFalse($sut->hasType());
    }
    
    /**
     * Asserts that the specified "element" element has only the "final" 
     * attribute.
     * 
     * @param   ElementElement  $sut    The element to test.
     */
    public static function assertElementElementHasOnlyFinalAttribute(
        ElementElement $sut
    ): void
    {
        self::assertFalse($sut->hasAbstract());
        self::assertFalse($sut->hasBlock());
        self::assertFalse($sut->hasDefault());
        self::assertTrue($sut->hasFinal());
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasNillable());
        self::assertFalse($sut->hasRef());
        self::assertFalse($sut->hasSubstitutionGroup());
        self::assertFalse($sut->hasType());
    }
    
    /**
     * Asserts that the "final" attribute:
     * - byRestriction() returns the same value as the expected "restriction" flag
     * - byExtension() returns the same value as the expected "extension" flag
     * - bySubstitution() returns FALSE
     * - byList() returns FALSE
     * - byUnion() returns FALSE
     * 
     * @param   bool            $ext    The expected value for the "extension" flag.
     * @param   bool            $res    The expected value for the "restriction" flag.
     * @param   ElementElement  $elt    The element that holds the attribute.
     */
    public static function assertElementElementFinalAttribute(
        bool $ext, 
        bool $res, 
        ElementElement $elt
    ): void
    {
        $sut = $elt->getFinal();
        self::assertSame($res, $sut->byRestriction());
        self::assertSame($ext, $sut->byExtension());
        self::assertFalse($sut->bySubstitution());
        self::assertFalse($sut->byList());
        self::assertFalse($sut->byUnion());
    }
    
    /**
     * Asserts that the specified "element" element has only the "fixed" 
     * attribute.
     * 
     * @param   ElementElement  $sut    The element to test.
     */
    public static function assertElementElementHasOnlyFixedAttribute(
        ElementElement $sut
    ): void
    {
        self::assertFalse($sut->hasAbstract());
        self::assertFalse($sut->hasBlock());
        self::assertFalse($sut->hasDefault());
        self::assertFalse($sut->hasFinal());
        self::assertTrue($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasNillable());
        self::assertFalse($sut->hasRef());
        self::assertFalse($sut->hasSubstitutionGroup());
        self::assertFalse($sut->hasType());
    }
    
    /**
     * Asserts that the specified "element" element has only the "form" 
     * attribute.
     * 
     * @param   ElementElement  $sut    The element to test.
     */
    public static function assertElementElementHasOnlyFormAttribute(
        ElementElement $sut
    ): void
    {
        self::assertFalse($sut->hasAbstract());
        self::assertFalse($sut->hasBlock());
        self::assertFalse($sut->hasDefault());
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasFixed());
        self::assertTrue($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasNillable());
        self::assertFalse($sut->hasRef());
        self::assertFalse($sut->hasSubstitutionGroup());
        self::assertFalse($sut->hasType());
    }
    
    /**
     * Asserts that the specified "element" element has only the "id" 
     * attribute.
     * 
     * @param   ElementElement  $sut    The element to test.
     */
    public static function assertElementElementHasOnlyIdAttribute(
        ElementElement $sut
    ): void
    {
        self::assertFalse($sut->hasAbstract());
        self::assertFalse($sut->hasBlock());
        self::assertFalse($sut->hasDefault());
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasNillable());
        self::assertFalse($sut->hasRef());
        self::assertFalse($sut->hasSubstitutionGroup());
        self::assertFalse($sut->hasType());
    }
    
    /**
     * Asserts that the specified "element" element has only the "maxOccurs" 
     * attribute.
     * 
     * @param   ElementElement  $sut    The element to test.
     */
    public static function assertElementElementHasOnlyMaxOccursAttribute(
        ElementElement $sut
    ): void
    {
        self::assertFalse($sut->hasAbstract());
        self::assertFalse($sut->hasBlock());
        self::assertFalse($sut->hasDefault());
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasNillable());
        self::assertFalse($sut->hasRef());
        self::assertFalse($sut->hasSubstitutionGroup());
        self::assertFalse($sut->hasType());
    }
    
    /**
     * Asserts that the specified "element" element has only the "minOccurs" 
     * attribute.
     * 
     * @param   ElementElement  $sut    The element to test.
     */
    public static function assertElementElementHasOnlyMinOccursAttribute(
        ElementElement $sut
    ): void
    {
        self::assertFalse($sut->hasAbstract());
        self::assertFalse($sut->hasBlock());
        self::assertFalse($sut->hasDefault());
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertTrue($sut->hasMinOccurs());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasNillable());
        self::assertFalse($sut->hasRef());
        self::assertFalse($sut->hasSubstitutionGroup());
        self::assertFalse($sut->hasType());
    }
    
    /**
     * Asserts that the specified "element" element has only the "name" 
     * attribute.
     * 
     * @param   ElementElement  $sut    The element to test.
     */
    public static function assertElementElementHasOnlyNameAttribute(
        ElementElement $sut
    ): void
    {
        self::assertFalse($sut->hasAbstract());
        self::assertFalse($sut->hasBlock());
        self::assertFalse($sut->hasDefault());
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertTrue($sut->hasName());
        self::assertFalse($sut->hasNillable());
        self::assertFalse($sut->hasRef());
        self::assertFalse($sut->hasSubstitutionGroup());
        self::assertFalse($sut->hasType());
    }
    
    /**
     * Asserts that the specified "element" element has only the "nillable" 
     * attribute.
     * 
     * @param   ElementElement  $sut    The element to test.
     */
    public static function assertElementElementHasOnlyNillableAttribute(
        ElementElement $sut
    ): void
    {
        self::assertFalse($sut->hasAbstract());
        self::assertFalse($sut->hasBlock());
        self::assertFalse($sut->hasDefault());
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasName());
        self::assertTrue($sut->hasNillable());
        self::assertFalse($sut->hasRef());
        self::assertFalse($sut->hasSubstitutionGroup());
        self::assertFalse($sut->hasType());
    }
    
    /**
     * Asserts that the specified "element" element has only the "ref" 
     * attribute.
     * 
     * @param   ElementElement  $sut    The element to test.
     */
    public static function assertElementElementHasOnlyRefAttribute(
        ElementElement $sut
    ): void
    {
        self::assertFalse($sut->hasAbstract());
        self::assertFalse($sut->hasBlock());
        self::assertFalse($sut->hasDefault());
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasNillable());
        self::assertTrue($sut->hasRef());
        self::assertFalse($sut->hasSubstitutionGroup());
        self::assertFalse($sut->hasType());
    }
    
    /**
     * Asserts that the specified "element" element has only the "type" 
     * attribute.
     * 
     * @param   ElementElement  $sut    The element to test.
     */
    public static function assertElementElementHasOnlyTypeAttribute(
        ElementElement $sut
    ): void
    {
        self::assertFalse($sut->hasAbstract());
        self::assertFalse($sut->hasBlock());
        self::assertFalse($sut->hasDefault());
        self::assertFalse($sut->hasFinal());
        self::assertFalse($sut->hasFixed());
        self::assertFalse($sut->hasForm());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasNillable());
        self::assertFalse($sut->hasRef());
        self::assertFalse($sut->hasSubstitutionGroup());
        self::assertTrue($sut->hasType());
    }
    
    /**
     * Asserts that the specified "choice" element has no attribute.
     * 
     * @param   ChoiceElement   $sut    The element to test.
     */
    public static function assertChoiceElementHasNoAttribute(ChoiceElement $sut)
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
    }
    
    /**
     * Asserts that the specified "choice" element has only the "id" 
     * attribute.
     * 
     * @param   ChoiceElement   $sut    The element to test.
     */
    public static function assertChoiceElementHasOnlyIdAttribute(
        ChoiceElement $sut
    ): void
    {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
    }
    
    /**
     * Asserts that the specified "choice" element has only the "maxOccurs" 
     * attribute.
     * 
     * @param   ChoiceElement   $sut    The element to test.
     */
    public static function assertChoiceElementHasOnlyMaxOccursAttribute(
        ChoiceElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
    }
    
    /**
     * Asserts that the specified "choice" element has only the "minOccurs" 
     * attribute.
     * 
     * @param   ChoiceElement   $sut    The element to test.
     */
    public static function assertChoiceElementHasOnlyMinOccursAttribute(
        ChoiceElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertTrue($sut->hasMinOccurs());
    }
    
    /**
     * Asserts that the specified "unique" element has no attribute.
     * 
     * @param   UniqueElement   $sut    The element to test.
     */
    public static function assertUniqueElementHasNoAttribute(UniqueElement $sut)
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasName());
    }
    
    /**
     * Asserts that the specified "unique" element has only the "id" 
     * attribute.
     * 
     * @param   UniqueElement   $sut    The element to test.
     */
    public static function assertUniqueElementHasOnlyIdAttribute(
        UniqueElement $sut
    ): void
    {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasName());
    }
    
    /**
     * Asserts that the specified "unique" element has only the "name" 
     * attribute.
     * 
     * @param   UniqueElement   $sut    The element to test.
     */
    public static function assertUniqueElementHasOnlyNameAttribute(
        UniqueElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasName());
    }
    
    /**
     * Asserts that the specified "selector" element has no attribute.
     * 
     * @param   SelectorElement $sut    The element to test.
     */
    public static function assertSelectorElementHasNoAttribute(
        SelectorElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasXPath());
    }
    
    /**
     * Asserts that the specified "selector" element has only the "id" 
     * attribute.
     * 
     * @param   SelectorElement $sut    The element to test.
     */
    public static function assertSelectorElementHasOnlyIdAttribute(
        SelectorElement $sut
    ): void
    {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasXPath());
    }
    
    /**
     * Asserts that the specified "selector" element has only the "xpath" 
     * attribute.
     * 
     * @param   SelectorElement $sut    The element to test.
     */
    public static function assertSelectorElementHasOnlyXPathAttribute(
        SelectorElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasXPath());
    }
    
    /**
     * Asserts that the specified "field" element has no attribute.
     * 
     * @param   FieldElement    $sut    The element to test.
     */
    public static function assertFieldElementHasNoAttribute(FieldElement $sut)
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasXPath());
    }
    
    /**
     * Asserts that the specified "field" element has only the "id" attribute.
     * 
     * @param   FieldElement    $sut    The element to test.
     */
    public static function assertFieldElementHasOnlyIdAttribute(
        FieldElement $sut
    ): void
    {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasXPath());
    }
    
    /**
     * Asserts that the specified "field" element has only the "xpath" 
     * attribute.
     * 
     * @param   FieldElement    $sut    The element to test.
     */
    public static function assertFieldElementHasOnlyXPathAttribute(
        FieldElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasXPath());
    }
    
    /**
     * Asserts that the specified "key" element has no attribute.
     * 
     * @param   KeyElement  $sut    The element to test.
     */
    public static function assertKeyElementHasNoAttribute(KeyElement $sut)
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasName());
    }
    
    /**
     * Asserts that the specified "key" element has only the "id" attribute.
     * 
     * @param   KeyElement  $sut    The element to test.
     */
    public static function assertKeyElementHasOnlyIdAttribute(
        KeyElement $sut
    ): void
    {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasName());
    }
    
    /**
     * Asserts that the specified "key" element has only the "name" attribute.
     * 
     * @param   KeyElement  $sut    The element to test.
     */
    public static function assertKeyElementHasOnlyNameAttribute(
        KeyElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasName());
    }
    
    /**
     * Asserts that the specified "keyref" element has no attribute.
     * 
     * @param   KeyRefElement   $sut    The element to test.
     */
    public static function assertKeyRefElementHasNoAttribute(KeyRefElement $sut)
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasRefer());
    }
    
    /**
     * Asserts that the specified "keyref" element has only the "id" 
     * attribute.
     * 
     * @param   KeyRefElement   $sut    The element to test.
     */
    public static function assertKeyRefElementHasOnlyIdAttribute(
        KeyRefElement $sut
    ): void
    {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasName());
        self::assertFalse($sut->hasRefer());
    }
    
    /**
     * Asserts that the specified "keyref" element has only the "name" 
     * attribute.
     * 
     * @param   KeyRefElement   $sut    The element to test.
     */
    public static function assertKeyRefElementHasOnlyNameAttribute(
        KeyRefElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasName());
        self::assertFalse($sut->hasRefer());
    }
    
    /**
     * Asserts that the specified "keyref" element has only the "refer" 
     * attribute.
     * 
     * @param   KeyRefElement   $sut    The element to test.
     */
    public static function assertKeyRefElementHasOnlyReferAttribute(
        KeyRefElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasName());
        self::assertTrue($sut->hasRefer());
    }
    
    /**
     * Asserts that the specified "sequence" element has no attribute.
     * 
     * @param   SequenceElement $sut    The element to test.
     */
    public static function assertSequenceElementHasNoAttribute(
        SequenceElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
    }
    
    /**
     * Asserts that the specified "sequence" element has only the "id" 
     * attribute.
     * 
     * @param   SequenceElement $sut    The element to test.
     */
    public static function assertSequenceElementHasOnlyIdAttribute(
        SequenceElement $sut
    ): void
    {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
    }
    
    /**
     * Asserts that the specified "sequence" element has only the "maxOccurs" 
     * attribute.
     * 
     * @param   SequenceElement $sut    The element to test.
     */
    public static function assertSequenceElementHasOnlyMaxOccursAttribute(
        SequenceElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
    }
    
    /**
     * Asserts that the specified "sequence" element has only the "minOccurs" 
     * attribute.
     * 
     * @param   SequenceElement $sut    The element to test.
     */
    public static function assertSequenceElementHasOnlyMinOccursAttribute(
        SequenceElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertTrue($sut->hasMinOccurs());
    }
    
    /**
     * Asserts that the specified "any" element has no attribute.
     * 
     * @param   AnyElement  $sut    The element to test.
     */
    public static function assertAnyElementHasNoAttribute(
        AnyElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasNamespace());
        self::assertFalse($sut->hasProcessContents());
    }
    
    /**
     * Asserts that the specified "any" element has only the "id" attribute.
     * 
     * @param   AnyElement  $sut    The element to test.
     */
    public static function assertAnyElementHasOnlyIdAttribute(AnyElement $sut)
    {
        self::assertTrue($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasNamespace());
        self::assertFalse($sut->hasProcessContents());
    }
    
    /**
     * Asserts that the specified "any" element has only the "maxOccurs" 
     * attribute.
     * 
     * @param   AnyElement  $sut    The element to test.
     */
    public static function assertAnyElementHasOnlyMaxOccursAttribute(
        AnyElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertTrue($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasNamespace());
        self::assertFalse($sut->hasProcessContents());
    }
    
    /**
     * Asserts that the specified "any" element has only the "minOccurs" 
     * attribute.
     * 
     * @param   AnyElement  $sut    The element to test.
     */
    public static function assertAnyElementHasOnlyMinOccursAttribute(
        AnyElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertTrue($sut->hasMinOccurs());
        self::assertFalse($sut->hasNamespace());
        self::assertFalse($sut->hasProcessContents());
    }
    
    /**
     * Asserts that the specified "any" element has only the "namespace" 
     * attribute.
     * 
     * @param   AnyElement  $sut    The element to test.
     */
    public static function assertAnyElementHasOnlyNamespaceAttribute(
        AnyElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertTrue($sut->hasNamespace());
        self::assertFalse($sut->hasProcessContents());
    }
    
    /**
     * Asserts that the "namespace" attribute:
     * - hasAny() returns the same value as the expected "any" flag
     * - hasOther() returns the same value as the expected "other" flag
     * - hasTargetNamespace() returns the same value as the expected "targetNamespace" flag
     * - hasLocal() returns the same value as the expected "local" flag
     * - getNamespaces() returns the same anyURI list
     * 
     * @param   bool        $any        The expected value for the "any" flag.
     * @param   bool        $other      The expected value for the "other" flag.
     * @param   bool        $targetNs   The expected value for the "targetNamespace" flag.
     * @param   bool        $local      The expected value for the "local" flag.
     * @param   string[]    $uris       The expected value for the anyURI list.
     * @param   AnyElement  $sut        The element to test.
     */
    public static function assertAnyElementNamespaceAttribute(
        bool $any, 
        bool $other, 
        bool $targetNs, 
        bool $local, 
        array $uris, 
        AnyElement $sut
    ): void
    {
        self::assertSame($any, $sut->getNamespace()->hasAny());
        self::assertSame($other, $sut->getNamespace()->hasOther());
        self::assertSame($targetNs, $sut->getNamespace()->hasTargetNamespace());
        self::assertSame($local, $sut->getNamespace()->hasLocal());
        
        $namespaces = [];
        
        foreach ($sut->getNamespace()->getNamespaces() as $uri) {
            $namespaces[] = $uri->getAnyUri();
        }
        
        self::assertSame($uris, $namespaces);
    }
    
    /**
     * Asserts that the specified "any" element has only the 
     * "processContents" attribute.
     * 
     * @param   AnyElement  $sut    The element to test.
     */
    public static function assertAnyElementHasOnlyProcessContentsAttribute(
        AnyElement $sut
    ): void
    {
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasMaxOccurs());
        self::assertFalse($sut->hasMinOccurs());
        self::assertFalse($sut->hasNamespace());
        self::assertTrue($sut->hasProcessContents());
    }
    
    /**
     * Asserts that the specified "extension" element (extensionType) has no 
     * attribute.
     * 
     * @param   ComplexContentExtensionElement  $sut    The element to test.
     */
    public static function assertComplexContentExtensionElementHasNoAttribute(
        ComplexContentExtensionElement $sut
    ): void
    {
        self::assertFalse($sut->hasBase());
        self::assertFalse($sut->hasId());
    }
    
    /**
     * Asserts that the specified "extension" element (extensionType) element 
     * has only the "base" attribute.
     * 
     * @param   ComplexContentExtensionElement  $sut    The element to test.
     */
    public static function assertComplexContentExtensionElementHasOnlyBaseAttribute(
        ComplexContentExtensionElement $sut
    ): void
    {
        self::assertTrue($sut->hasBase());
        self::assertFalse($sut->hasId());
    }
    
    /**
     * Asserts that the specified "extension" element (extensionType) element 
     * has only the "id" attribute.
     * 
     * @param   ComplexContentExtensionElement  $sut    The element to test.
     */
    public static function assertComplexContentExtensionElementHasOnlyIdAttribute(
        ComplexContentExtensionElement $sut
    ): void
    {
        self::assertFalse($sut->hasBase());
        self::assertTrue($sut->hasId());
    }
}
