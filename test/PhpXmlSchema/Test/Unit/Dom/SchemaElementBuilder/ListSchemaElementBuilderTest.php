<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

use PhpXmlSchema\Dom\ElementInterface;
use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SchemaElementBuilder;
use PhpXmlSchema\Exception\InvalidOperationException;
use PhpXmlSchema\Exception\InvalidValueException;
use PhpXmlSchema\Test\Datatype\NCNameTypeProviderTrait;
use PhpXmlSchema\Test\Datatype\QNameTypeProviderTrait;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "list" element.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ListSchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
{
    use NCNameTypeProviderTrait;
    use QNameTypeProviderTrait;
    
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
    use BuildNameAttributeDoesNotCreateAttributeTestTrait;
    use BuildPublicAttributeDoesNotCreateAttributeTestTrait;
    use BuildSystemNamespaceAttributeDoesNotCreateAttributeTestTrait;
    use BuildDefinitionAnnotationElementDoesNotCreateElementTestTrait;
    use BuildAttributeElementDoesNotCreateElementTestTrait;
    use BuildDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildFixedAttributeDoesNotCreateAttributeTestTrait;
    use BuildTypeAttributeDoesNotCreateAttributeTestTrait;
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
    use BuildUnionElementDoesNotCreateElementTestTrait;
    use BuildMemberTypesAttributeDoesNotCreateAttributeTestTrait;
    use BuildFinalAttributeDoesNotCreateAttributeTestTrait;
    use BuildAttributeGroupElementDoesNotCreateElementTestTrait;
    use BuildFormAttributeDoesNotCreateAttributeTestTrait;
    use BuildRefAttributeDoesNotCreateAttributeTestTrait;
    use BuildUseAttributeDoesNotCreateAttributeTestTrait;
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
    use BuildSubstitutionGroupAttributeDoesNotCreateAttributeTestTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertSchemaElementNotChanged(SchemaElement $sch): void
    {
        self::assertAncestorsNotChanged($sch);
        
        $list = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $list);
        self::assertListElementHasNoAttribute($list);
        self::assertSame([], $list->getElements());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch): void
    {
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $attr = $sch->getAttributeElements()[0];
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasNoAttribute($attr);
        self::assertCount(1, $attr->getElements());
        
        $st = $attr->getSimpleTypeElement();
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertCount(1, $st->getElements());
        self::assertNotNull($st->getDerivationElement());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertCurrentElementHasNotAttribute(SchemaElement $sch): void
    {
        self::assertListElementHasNoAttribute(self::getCurrentElement($sch));
    }
    
    /**
     * {@inheritDoc}
     */
    protected static function getCurrentElement(SchemaElement $sch): ?ElementInterface
    {
        return $sch->getAttributeElements()[0]
            ->getSimpleTypeElement()
            ->getDerivationElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildAttributeElement();
        $this->sut->buildSimpleTypeElement();
        $this->sut->buildListElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown(): void
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that buildIdAttribute() creates the attribute when the current 
     * element is the "list" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNCNameTypeWSValues
     */
    public function testBuildIdAttributeCreatesAttrWhenListAndValueIsValid(
        string $value, 
        string $id
    ): void
    {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $list = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $list);
        self::assertListElementHasOnlyIdAttribute($list);
        self::assertSame($id, $list->getId()->getId());
        self::assertSame([], $list->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the current 
     * element is the "list" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $mValue The string representation of the value in the exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNCNameTypeWSValues
     */
    public function testBuildIdAttributeThrowsExceptionWhenListAndValueIsInvalid(
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
     * Tests that buildItemTypeAttribute() creates the attribute when:
     * - the current element is the "list" element, and 
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
    public function testBuildItemTypeAttributeCreatesAttrWhenListAndValueIsValidQNameLocalPartAndNoDefaultNamespace(
        string $value, 
        string $localPart
    ): void
    {
        $this->sut->buildItemTypeAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $list = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $list);
        self::assertListElementHasOnlyItemTypeAttribute($list);
        self::assertSame($localPart, $list->getItemType()->getLocalPart()->getNCName());
        self::assertFalse($list->getItemType()->hasNamespace());
        self::assertSame([], $list->getElements());
    }
    
    /**
     * Tests that buildItemTypeAttribute() creates the attribute when:
     * - the current element is the "list" element, and 
     * - the value is a valid QName (local part without prefix), and 
     * - default namespace.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $localPart  The expected value for the local part.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidLocalPartQNameTypeValues
     */
    public function testBuildItemTypeAttributeCreatesAttrWhenListAndValueIsValidQNameLocalPartAndDefaultNamespace(
        string $value, 
        string $localPart
    ): void
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('', 'http://example.org');
        $this->sut->buildAttributeElement();
        $this->sut->buildSimpleTypeElement();
        $this->sut->buildListElement();
        $this->sut->buildItemTypeAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['' => 'http://example.org' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $attr = $sch->getAttributeElements()[0];
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasNoAttribute($attr);
        self::assertCount(1, $attr->getElements());
        
        $st = $attr->getSimpleTypeElement();
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertCount(1, $st->getElements());
        self::assertNotNull($st->getDerivationElement());
        
        $list = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $list);
        self::assertListElementHasOnlyItemTypeAttribute($list);
        self::assertSame($localPart, $list->getItemType()->getLocalPart()->getNCName());
        self::assertSame('http://example.org', $list->getItemType()->getNamespace()->getAnyUri());
        self::assertSame([], $list->getElements());
    }
    
    /**
     * Tests that buildItemTypeAttribute() throws an exception when the current 
     * element is the "list" element and the value is an invalid QName.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidQNameTypeValues
     */
    public function testBuildItemTypeAttributeThrowsExceptionWhenListAndValueIsInvalid(
        string $value, 
        string $message
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildItemTypeAttribute($value);
    }
    
    /**
     * Tests that buildItemTypeAttribute() creates the attribute when:
     * - the current element is the "list" element, and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildItemTypeAttributeCreatesAttrWhenListAndValueIsValidAndPrefixAssociatedNamespace(): void
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('foo', 'http://example.org/foo');
        $this->sut->buildAttributeElement();
        $this->sut->buildSimpleTypeElement();
        $this->sut->buildListElement();
        $this->sut->buildItemTypeAttribute('foo:bar');
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['foo' => 'http://example.org/foo' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $attr = $sch->getAttributeElements()[0];
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasNoAttribute($attr);
        self::assertCount(1, $attr->getElements());
        
        $st = $attr->getSimpleTypeElement();
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertCount(1, $st->getElements());
        self::assertNotNull($st->getDerivationElement());
        
        $list = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $list);
        self::assertListElementHasOnlyItemTypeAttribute($list);
        self::assertSame('bar', $list->getItemType()->getLocalPart()->getNCName());
        self::assertSame('http://example.org/foo', $list->getItemType()->getNamespace()->getAnyUri());
        self::assertSame([], $list->getElements());
    }
    
    /**
     * Tests that buildItemTypeAttribute() throws an exception when:
     * - the current element is the "list" element, and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is not associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildItemTypeAttributeThrowsExceptionWhenListAndValueIsValidAndPrefixNotAssociatedNamespace(): void
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The "foo" prefix is not bound to a namespace.');
        
        $this->sut->buildItemTypeAttribute('foo:bar');
    }
    
    /**
     * Tests that buildAnnotationElement() creates the element when the 
     * current element is the "list" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAnnotationElementCreateEltWhenList(): void
    {
        $this->sut->buildAnnotationElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $list = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $list);
        self::assertListElementHasNoAttribute($list);
        self::assertCount(1, $list->getElements());
        
        $ann = $list->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Tests that buildSimpleTypeElement() creates the element when the 
     * current element is the "list" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildSimpleTypeElementCreateEltWhenList(): void
    {
        $this->sut->buildSimpleTypeElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $list = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $list);
        self::assertListElementHasNoAttribute($list);
        self::assertCount(1, $list->getElements());
        
        $st = $list->getSimpleTypeElement();
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertSame([], $st->getElements());
    }
}
