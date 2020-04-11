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
use PhpXmlSchema\Test\Unit\Datatype\NCNameTypeProviderTrait;
use PhpXmlSchema\Test\Unit\Datatype\QNameTypeProviderTrait;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "extension" element (extensionType).
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ComplexContentExtensionSchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
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
    use BuildDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildFixedAttributeDoesNotCreateAttributeTestTrait;
    use BuildTypeAttributeDoesNotCreateAttributeTestTrait;
    use BuildSimpleTypeElementDoesNotCreateElementTestTrait;
    use BuildRestrictionElementDoesNotCreateElementTestTrait;
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
    use BuildFormAttributeDoesNotCreateAttributeTestTrait;
    use BuildRefAttributeDoesNotCreateAttributeTestTrait;
    use BuildUseAttributeDoesNotCreateAttributeTestTrait;
    use BuildProcessContentsAttributeDoesNotCreateAttributeTestTrait;
    use BuildComplexTypeElementDoesNotCreateElementTestTrait;
    use BuildAbstractAttributeDoesNotCreateAttributeTestTrait;
    use BuildBlockAttributeDoesNotCreateAttributeTestTrait;
    use BuildMixedAttributeDoesNotCreateAttributeTestTrait;
    use BuildSimpleContentElementDoesNotCreateElementTestTrait;
    use BuildExtensionElementDoesNotCreateElementTestTrait;
    use BuildComplexContentElementDoesNotCreateElementTestTrait;
    use BuildMaxOccursAttributeDoesNotCreateAttributeTestTrait;
    use BuildMinOccursAttributeDoesNotCreateAttributeTestTrait;
    use BuildElementElementDoesNotCreateElementTestTrait;
    use BuildNillableAttributeDoesNotCreateAttributeTestTrait;
    use BuildUniqueElementDoesNotCreateElementTestTrait;
    use BuildSelectorElementDoesNotCreateElementTestTrait;
    use BuildFieldElementDoesNotCreateElementTestTrait;
    use BuildXPathAttributeDoesNotCreateAttributeTestTrait;
    use BuildKeyElementDoesNotCreateElementTestTrait;
    use BuildKeyRefElementDoesNotCreateElementTestTrait;
    use BuildReferAttributeDoesNotCreateAttributeTestTrait;
    use BuildAnyElementDoesNotCreateElementTestTrait;
    use BuildSubstitutionGroupAttributeDoesNotCreateAttributeTestTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertSchemaElementNotChanged(SchemaElement $sch): void
    {
        self::assertAncestorsNotChanged($sch);
        
        $ext = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ext);
        self::assertComplexContentExtensionElementHasNoAttribute($ext);
        self::assertSame([], $ext->getElements());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch): void
    {
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $cc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $cc);
        self::assertComplexContentElementHasNoAttribute($cc);
        self::assertCount(1, $cc->getElements());
        self::assertNotNull($cc->getDerivationElement());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertCurrentElementHasNotAttribute(SchemaElement $sch): void
    {
        self::assertComplexContentExtensionElementHasNoAttribute(self::getCurrentElement($sch));
    }
    
    /**
     * {@inheritDoc}
     */
    protected static function getCurrentElement(SchemaElement $sch): ?ElementInterface
    {
        return $sch->getComplexTypeElements()[0]
            ->getContentElement()
            ->getDerivationElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildComplexTypeElement();
        $this->sut->buildComplexContentElement();
        $this->sut->buildExtensionElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown(): void
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that buildBaseAttribute() creates the attribute when:
     * - the current element is the "extension" element (extensionType), and 
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
    public function testBuildBaseAttributeCreatesAttrWhenComplexContentExtensionAndValueIsValidQNameLocalPartAndNoDefaultNamespace(
        string $value, 
        string $localPart
    ): void
    {
        $this->sut->buildBaseAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ext = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ext);
        self::assertComplexContentExtensionElementHasOnlyBaseAttribute($ext);
        self::assertSame($localPart, $ext->getBase()->getLocalPart()->getNCName());
        self::assertFalse($ext->getBase()->hasNamespace());
        self::assertSame([], $ext->getElements());
    }
    
    /**
     * Tests that buildBaseAttribute() creates the attribute when:
     * - the current element is the "extension" element (extensionType), and 
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
    public function testBuildBaseAttributeCreatesAttrWhenComplexContentExtensionAndValueIsValidQNameLocalPartAndDefaultNamespace(
        string $value, 
        string $localPart
    ): void
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('', 'http://example.org');
        $this->sut->buildComplexTypeElement();
        $this->sut->buildComplexContentElement();
        $this->sut->buildExtensionElement();
        $this->sut->buildBaseAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['' => 'http://example.org' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $cc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $cc);
        self::assertComplexContentElementHasNoAttribute($cc);
        self::assertCount(1, $cc->getElements());
        self::assertNotNull($cc->getDerivationElement());
        
        $ext = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ext);
        self::assertComplexContentExtensionElementHasOnlyBaseAttribute($ext);
        self::assertSame($localPart, $ext->getBase()->getLocalPart()->getNCName());
        self::assertSame('http://example.org', $ext->getBase()->getNamespace()->getAnyUri());
        self::assertSame([], $ext->getElements());
    }
    
    /**
     * Tests that buildBaseAttribute() throws an exception when the current 
     * element is the "extension" element (extensionType) and the value is an 
     * invalid QName.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidQNameTypeValues
     */
    public function testBuildBaseAttributeThrowsExceptionWhenComplexContentExtensionAndValueIsInvalid(
        string $value, 
        string $message
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildBaseAttribute($value);
    }
    
    /**
     * Tests that buildBaseAttribute() creates the attribute when:
     * - the current element is the "extension" element (extensionType), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildBaseAttributeCreatesAttrWhenComplexContentExtensionAndValueIsValidAndPrefixAssociatedNamespace(): void
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('foo', 'http://example.org/foo');
        $this->sut->buildComplexTypeElement();
        $this->sut->buildComplexContentElement();
        $this->sut->buildExtensionElement();
        $this->sut->buildBaseAttribute('foo:bar');
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['foo' => 'http://example.org/foo' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $cc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $cc);
        self::assertComplexContentElementHasNoAttribute($cc);
        self::assertCount(1, $cc->getElements());
        self::assertNotNull($cc->getDerivationElement());
        
        $ext = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ext);
        self::assertComplexContentExtensionElementHasOnlyBaseAttribute($ext);
        self::assertSame('bar', $ext->getBase()->getLocalPart()->getNCName());
        self::assertSame('http://example.org/foo', $ext->getBase()->getNamespace()->getAnyUri());
        self::assertSame([], $ext->getElements());
    }
    
    /**
     * Tests that buildBaseAttribute() throws an exception when:
     * - the current element is the "extension" element (extensionType), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is not associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildBaseAttributeThrowsExceptionWhenComplexContentExtensionAndValueIsValidAndPrefixNotAssociatedNamespace(): void
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The "foo" prefix is not bound to a namespace.');
        
        $this->sut->buildBaseAttribute('foo:bar');
    }
    
    /**
     * Tests that buildIdAttribute() creates the attribute when the current 
     * element is the "extension" element (extensionType) and the value is 
     * valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNCNameTypeWSValues
     */
    public function testBuildIdAttributeCreatesAttrWhenComplexContentExtensionAndValueIsValid(
        string $value, 
        string $id
    ): void
    {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ext = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ext);
        self::assertComplexContentExtensionElementHasOnlyIdAttribute($ext);
        self::assertSame($id, $ext->getId()->getId());
        self::assertSame([], $ext->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the current 
     * element is the "extension" element (extensionType) and the value is 
     * invalid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $mValue The string representation of the value in the exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNCNameTypeWSValues
     */
    public function testBuildIdAttributeThrowsExceptionWhenComplexContentExtensionAndValueIsInvalid(
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
     * Tests that buildAnnotationElement() creates the element when the 
     * current element is the "extension" element (extensionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAnnotationElementCreateEltWhenComplexContentExtension(): void
    {
        $this->sut->buildAnnotationElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ext = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ext);
        self::assertComplexContentExtensionElementHasNoAttribute($ext);
        self::assertCount(1, $ext->getElements());
        
        $ann = $ext->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Tests that buildGroupElement() creates the element when the current 
     * element is the "extension" element (extensionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildGroupElementCreateEltWhenComplexContentExtension(): void
    {
        $this->sut->buildGroupElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ext = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ext);
        self::assertComplexContentExtensionElementHasNoAttribute($ext);
        self::assertCount(1, $ext->getElements());
        
        $grp = $ext->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $grp);
        self::assertGroupElementHasNoAttribute($grp);
        self::assertSame([], $grp->getElements());
    }
    
    /**
     * Tests that buildAllElement() creates the element when the current 
     * element is the "extension" element (extensionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAllElementCreateEltWhenComplexContentExtension(): void
    {
        $this->sut->buildAllElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ext = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ext);
        self::assertComplexContentExtensionElementHasNoAttribute($ext);
        self::assertCount(1, $ext->getElements());
        
        $all = $ext->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasNoAttribute($all);
        self::assertSame([], $all->getElements());
    }
    
    /**
     * Tests that buildChoiceElement() creates the element when the current 
     * element is the "extension" element (extensionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildChoiceElementCreateEltWhenComplexContentExtension(): void
    {
        $this->sut->buildChoiceElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ext = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ext);
        self::assertComplexContentExtensionElementHasNoAttribute($ext);
        self::assertCount(1, $ext->getElements());
        
        $choice = $ext->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasNoAttribute($choice);
        self::assertSame([], $choice->getElements());
    }
    
    /**
     * Tests that buildSequenceElement() creates the element when the current 
     * element is the "extension" element (extensionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildSequenceElementCreateEltWhenComplexContentExtension(): void
    {
        $this->sut->buildSequenceElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ext = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ext);
        self::assertComplexContentExtensionElementHasNoAttribute($ext);
        self::assertCount(1, $ext->getElements());
        
        $seq = $ext->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasNoAttribute($seq);
        self::assertSame([], $seq->getElements());
    }
    
    /**
     * Tests that buildAttributeElement() creates the element when the 
     * current element is the "extension" element (extensionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAttributeElementCreateEltWhenComplexContentExtension(): void
    {
        $this->sut->buildAttributeElement();
        $this->sut->endElement();
        $this->sut->buildAttributeElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ext = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ext);
        self::assertComplexContentExtensionElementHasNoAttribute($ext);
        self::assertCount(2, $ext->getElements());
        
        $attrs = $ext->getAttributeElements();
        
        self::assertElementNamespaceDeclarations([], $attrs[0]);
        self::assertAttributeElementHasNoAttribute($attrs[0]);
        self::assertSame([], $attrs[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $attrs[1]);
        self::assertAttributeElementHasNoAttribute($attrs[1]);
        self::assertSame([], $attrs[1]->getElements());
    }
    
    /**
     * Tests that buildAttributeGroupElement() creates the element when the 
     * current element is the "extension" element (extensionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAttributeGroupElementCreateEltWhenComplexContentExtension(): void
    {
        $this->sut->buildAttributeGroupElement();
        $this->sut->endElement();
        $this->sut->buildAttributeGroupElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ext = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ext);
        self::assertComplexContentExtensionElementHasNoAttribute($ext);
        self::assertCount(2, $ext->getElements());
        
        $ags = $ext->getAttributeGroupElements();
        
        self::assertElementNamespaceDeclarations([], $ags[0]);
        self::assertAttributeGroupElementHasNoAttribute($ags[0]);
        self::assertSame([], $ags[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $ags[1]);
        self::assertAttributeGroupElementHasNoAttribute($ags[1]);
        self::assertSame([], $ags[1]->getElements());
    }
    
    /**
     * Tests that buildAnyAttributeElement() creates the element when the 
     * current element is the "extension" element (extensionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAnyAttributeElementCreateEltWhenComplexContentExtension(): void
    {
        $this->sut->buildAnyAttributeElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ext = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ext);
        self::assertComplexContentExtensionElementHasNoAttribute($ext);
        self::assertCount(1, $ext->getElements());
        
        $anyAttr = $ext->getAnyAttributeElement();
        self::assertElementNamespaceDeclarations([], $anyAttr);
        self::assertAnyAttributeElementHasNoAttribute($anyAttr);
        self::assertSame([], $anyAttr->getElements());
    }
}
