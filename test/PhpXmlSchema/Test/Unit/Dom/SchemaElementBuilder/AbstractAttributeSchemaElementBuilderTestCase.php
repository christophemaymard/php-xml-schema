<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Exception\InvalidOperationException;
use PhpXmlSchema\Exception\InvalidValueException;
use PhpXmlSchema\Test\Unit\Datatype\NCNameTypeProviderTrait;
use PhpXmlSchema\Test\Unit\Datatype\QNameTypeProviderTrait;
use PhpXmlSchema\Test\Unit\Datatype\StringTypeProviderTrait;

/**
 * Represents the base class to unit test the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "attribute" element.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractAttributeSchemaElementBuilderTestCase extends AbstractSchemaElementBuilderTestCase
{
    use NCNameTypeProviderTrait;
    use QNameTypeProviderTrait;
    use StringTypeProviderTrait;
    
    use BindNamespaceTestTrait;
    
    use BuildAttributeFormDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildBlockDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildElementFormDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildFinalDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildTargetNamespaceAttributeDoesNotCreateAttributeTestTrait;
    use BuildVersionAttributeDoesNotCreateAttributeTestTrait;
    use BuildLangAttributeDoesNotCreateAttributeTestTrait;
    use BuildCompositionAnnotationElementDoesNotCreateElementTestTrait;
    use BuildAppInfoElementDoesNotCreateElementTestTrait;
    use BuildSourceAttributeDoesNotCreateAttributeTestTrait;
    use BuildLeafElementContentDoesNotCreateContentTestTrait;
    use BuildDocumentationElementDoesNotCreateElementTestTrait;
    use BuildImportElementDoesNotCreateElementTestTrait;
    use BuildNamespaceAttributeDoesNotCreateAttributeTestTrait;
    use BuildSchemaLocationAttributeDoesNotCreateAttributeTestTrait;
    use BuildIncludeElementDoesNotCreateElementTestTrait;
    use BuildNotationElementDoesNotCreateElementTestTrait;
    use BuildPublicAttributeDoesNotCreateAttributeTestTrait;
    use BuildSystemNamespaceAttributeDoesNotCreateAttributeTestTrait;
    use BuildDefinitionAnnotationElementDoesNotCreateElementTestTrait;
    use BuildAttributeElementDoesNotCreateElementTestTrait;
    use BuildRestrictionElementDoesNotCreateElementTestTrait;
    use BuildBaseAttributeDoesNotCreateAttributeTestTrait;
    use BuildMinExclusiveElementDoesNotCreateElementTestTrait;
    use BuildValueAttributeDoesNotCreateAttributeTestTrait;
    use BuildMinInclusiveElementDoesNotCreateElementTestTrait;
    use BuildMaxExclusiveElementDoesNotCreateElementTestTrait;
    use BuildMaxInclusiveElementDoesNotCreateElementTestTrait;
    use BuildTotalDigitsElementDoesNotCreateElementTestTrait;
    use BuildFractionDigitsElementDoesNotCreateElementTestTrait;
    use BuildLengthElementDoesNotCreateElementTestTrait;
    use BuildMinLengthElementDoesNotCreateElementTestTrait;
    use BuildMaxLengthElementDoesNotCreateElementTestTrait;
    use BuildEnumerationElementDoesNotCreateElementTestTrait;
    use BuildWhiteSpaceElementDoesNotCreateElementTestTrait;
    use BuildPatternElementDoesNotCreateElementTestTrait;
    use BuildListElementDoesNotCreateElementTestTrait;
    use BuildItemTypeAttributeDoesNotCreateAttributeTestTrait;
    use BuildUnionElementDoesNotCreateElementTestTrait;
    use BuildMemberTypesAttributeDoesNotCreateAttributeTestTrait;
    use BuildFinalAttributeDoesNotCreateAttributeTestTrait;
    use BuildAttributeGroupElementDoesNotCreateElementTestTrait;
    use BuildAnyAttributeElementDoesNotCreateElementTestTrait;
    use BuildProcessContentsAttributeDoesNotCreateAttributeTestTrait;
    use BuildComplexTypeElementDoesNotCreateElementTestTrait;
    use BuildAbstractAttributeDoesNotCreateAttributeTestTrait;
    use BuildBlockAttributeDoesNotCreateAttributeTestTrait;
    use BuildMixedAttributeDoesNotCreateAttributeTestTrait;
    use BuildSimpleContentElementDoesNotCreateElementTestTrait;
    use BuildExtensionElementDoesNotCreateElementTestTrait;
    use BuildComplexContentElementDoesNotCreateElementTestTrait;
    use BuildGroupElementDoesNotCreateElementTestTrait;
    use BuildMaxOccursAttributeDoesNotCreateAttributeTestTrait;
    use BuildMinOccursAttributeDoesNotCreateAttributeTestTrait;
    use BuildAllElementDoesNotCreateElementTestTrait;
    use BuildElementElementDoesNotCreateElementTestTrait;
    use BuildNillableAttributeDoesNotCreateAttributeTestTrait;
    use BuildChoiceElementDoesNotCreateElementTestTrait;
    use BuildUniqueElementDoesNotCreateElementTestTrait;
    use BuildSelectorElementDoesNotCreateElementTestTrait;
    use BuildFieldElementDoesNotCreateElementTestTrait;
    use BuildXPathAttributeDoesNotCreateAttributeTestTrait;
    use BuildKeyElementDoesNotCreateElementTestTrait;
    use BuildKeyRefElementDoesNotCreateElementTestTrait;
    use BuildReferAttributeDoesNotCreateAttributeTestTrait;
    use BuildSequenceElementDoesNotCreateElementTestTrait;
    use BuildAnyElementDoesNotCreateElementTestTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertSchemaElementNotChanged(SchemaElement $sch): void
    {
        static::assertAncestorsNotChanged($sch);
        
        $attr = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasNoAttribute($attr);
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertCurrentElementHasNotAttribute(SchemaElement $sch): void
    {
        self::assertAttributeElementHasNoAttribute(static::getCurrentElement($sch));
    }
    
    /**
     * Tests that buildDefaultAttribute() creates the attribute when the 
     * current element is the "attribute" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidStringTypeValues
     */
    public function testBuildDefaultAttributeCreatesAttrWhenAttributeAndValueIsValid(
        string $value
    ): void
    {
        $this->sut->buildDefaultAttribute($value);
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $attr = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyDefaultAttribute($attr);
        self::assertSame($value, $attr->getDefault()->getString());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildDefaultAttribute() throws an exception when the 
     * current element is the "attribute" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidStringTypeValues
     */
    public function testBuildDefaultAttributeThrowsExceptionWhenAttributeAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid string datatype.', 
            $value
        ));
        
        $this->sut->buildDefaultAttribute($value);
    }
    
    /**
     * Tests that buildFixedAttribute() creates the attribute when the 
     * current element is the "attribute" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidStringTypeValues
     */
    public function testBuildFixedAttributeCreatesAttrWhenAttributeAndValueIsValid(
        string $value
    ): void
    {
        $this->sut->buildFixedAttribute($value);
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $attr = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyFixedAttribute($attr);
        self::assertSame($value, $attr->getFixed()->getString());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildFixedAttribute() throws an exception when the 
     * current element is the "attribute" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidStringTypeValues
     */
    public function testBuildFixedAttributeThrowsExceptionWhenAttributeAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid string datatype.', 
            $value
        ));
        
        $this->sut->buildFixedAttribute($value);
    }
    
    /**
     * Tests that buildIdAttribute() creates the attribute when the current 
     * element is the "attribute" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNCNameTypeWSValues
     */
    public function testBuildIdAttributeCreatesAttrWhenAttributeAndValueIsValid(
        string $value, 
        string $id
    ): void
    {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $attr = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyIdAttribute($attr);
        self::assertSame($id, $attr->getId()->getId());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the current 
     * element is the "attribute" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $mValue The string representation of the value in the exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNCNameTypeWSValues
     */
    public function testBuildIdAttributeThrowsExceptionWhenAttributeAndValueIsInvalid(
        string $value, 
        string $mValue
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid ID datatype.', 
            $mValue
        ));
        
        $this->sut->buildIdAttribute($value);
    }
    
    /**
     * Tests that buildNameAttribute() creates the attribute when the current 
     * element is the "attribute" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $name   The expected value for the name.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNCNameTypeWSValues
     */
    public function testBuildNameAttributeCreatesAttrWhenAttributeAndValueIsValid(
        string $value, 
        string $name
    ): void
    {
        $this->sut->buildNameAttribute($value);
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $attr = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyNameAttribute($attr);
        self::assertSame($name, $attr->getName()->getNCName());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildNameAttribute() throws an exception when the current 
     * element is the "attribute" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $mValue The string representation of the value in the exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNCNameTypeWSValues
     */
    public function testBuildNameAttributeThrowsExceptionWhenAttributeAndValueIsInvalid(
        string $value, 
        string $mValue
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid NCName datatype.', 
            $mValue
        ));
        
        $this->sut->buildNameAttribute($value);
    }
    
    /**
     * Tests that buildTypeAttribute() creates the attribute when:
     * - the current element is the "attribute" element, and 
     * - the value is a valid QName (local part without prefix), and 
     * - no default namespace.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $localPart  The expected value for the local part.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidLocalPartQNameTypeValues
     */
    public function testBuildTypeAttributeCreatesAttrWhenAttributeAndValueIsValidQNameLocalPartAndNoDefaultNamespace(
        string $value, 
        string $localPart
    ): void
    {
        $this->sut->buildTypeAttribute($value);
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $attr = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyTypeAttribute($attr);
        self::assertSame($localPart, $attr->getType()->getLocalPart()->getNCName());
        self::assertFalse($attr->getType()->hasNamespace());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildTypeAttribute() throws an exception when the current 
     * element is the "attribute" element and the value is an invalid QName.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidQNameTypeValues
     */
    public function testBuildTypeAttributeThrowsExceptionWhenAttributeAndValueIsInvalid(
        string $value, 
        string $message
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildTypeAttribute($value);
    }
    
    /**
     * Tests that buildTypeAttribute() throws an exception when:
     * - the current element is the "attribute" element, and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is not associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildTypeAttributeThrowsExceptionWhenAttributeAndValueIsValidAndPrefixNotAssociatedNamespace(): void
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The "foo" prefix is not bound to a namespace.');
        
        $this->sut->buildTypeAttribute('foo:bar');
    }
    
    /**
     * Tests that buildAnnotationElement() creates the element when the 
     * current element is the "attribute" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAnnotationElementCreateEltWhenAttribute(): void
    {
        $this->sut->buildAnnotationElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $attr = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasNoAttribute($attr);
        self::assertCount(1, $attr->getElements());
        
        $ann = $attr->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Tests that buildSimpleTypeElement() creates the element when the 
     * current element is the "attribute" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildSimpleTypeElementCreateEltWhenAttribute(): void
    {
        $this->sut->buildSimpleTypeElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $attr = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasNoAttribute($attr);
        self::assertCount(1, $attr->getElements());
        
        $st = $attr->getSimpleTypeElement();
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertSame([], $st->getElements());
    }
}
