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
 * class when the current element is the "restriction" element (simpleType).
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleTypeRestrictionSchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
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
    use BuildValueAttributeDoesNotCreateAttributeTestTrait;
    use BuildListElementDoesNotCreateElementTestTrait;
    use BuildItemTypeAttributeDoesNotCreateAttributeTestTrait;
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
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertSame([], $res->getElements());
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
        self::assertSimpleTypeRestrictionElementHasNoAttribute(self::getCurrentElement($sch));
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
        $this->sut->buildRestrictionElement();
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
     * - the current element is the "restriction" element (simpleType), and 
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
    public function testBuildBaseAttributeCreatesAttrWhenSimpleTypeRestrictionAndValueIsValidQNameLocalPartAndNoDefaultNamespace(
        string $value, 
        string $localPart
    ): void
    {
        $this->sut->buildBaseAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasOnlyBaseAttribute($res);
        self::assertSame($localPart, $res->getBase()->getLocalPart()->getNCName());
        self::assertFalse($res->getBase()->hasNamespace());
        self::assertSame([], $res->getElements());
    }
    
    /**
     * Tests that buildBaseAttribute() creates the attribute when:
     * - the current element is the "restriction" element (simpleType), and 
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
    public function testBuildBaseAttributeCreatesAttrWhenSimpleTypeRestrictionAndValueIsValidQNameLocalPartAndDefaultNamespace(
        string $value, 
        string $localPart
    ): void
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('', 'http://example.org');
        $this->sut->buildAttributeElement();
        $this->sut->buildSimpleTypeElement();
        $this->sut->buildRestrictionElement();
        $this->sut->buildBaseAttribute($value);
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
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasOnlyBaseAttribute($res);
        self::assertSame($localPart, $res->getBase()->getLocalPart()->getNCName());
        self::assertSame('http://example.org', $res->getBase()->getNamespace()->getAnyUri());
        self::assertSame([], $res->getElements());
    }
    
    /**
     * Tests that buildBaseAttribute() throws an exception when the current 
     * element is the "restriction" element (simpleType) and the value is an 
     * invalid QName.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidQNameTypeValues
     */
    public function testBuildBaseAttributeThrowsExceptionWhenSimpleTypeRestrictionAndValueIsInvalid(
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
     * - the current element is the "restriction" element (simpleType), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildBaseAttributeCreatesAttrWhenSimpleTypeRestrictionAndValueIsValidAndPrefixAssociatedNamespace(): void
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('foo', 'http://example.org/foo');
        $this->sut->buildAttributeElement();
        $this->sut->buildSimpleTypeElement();
        $this->sut->buildRestrictionElement();
        $this->sut->buildBaseAttribute('foo:bar');
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
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasOnlyBaseAttribute($res);
        self::assertSame('bar', $res->getBase()->getLocalPart()->getNCName());
        self::assertSame('http://example.org/foo', $res->getBase()->getNamespace()->getAnyUri());
        self::assertSame([], $res->getElements());
    }
    
    /**
     * Tests that buildBaseAttribute() throws an exception when:
     * - the current element is the "restriction" element (simpleType), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is not associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildBaseAttributeThrowsExceptionWhenSimpleTypeRestrictionAndValueIsValidAndPrefixNotAssociatedNamespace(): void
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The "foo" prefix is not bound to a namespace.');
        
        $this->sut->buildBaseAttribute('foo:bar');
    }
    
    /**
     * Tests that buildIdAttribute() creates the attribute when the current 
     * element is the "restriction" element (simpleType) and the value is 
     * valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNCNameTypeWSValues
     */
    public function testBuildIdAttributeCreatesAttrWhenSimpleTypeRestrictionAndValueIsValid(
        string $value, 
        string $id
    ): void
    {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasOnlyIdAttribute($res);
        self::assertSame($id, $res->getId()->getId());
        self::assertSame([], $res->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the current 
     * element is the "restriction" element (simpleType) and the value is 
     * invalid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $mValue The string representation of the value in the exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNCNameTypeWSValues
     */
    public function testBuildIdAttributeThrowsExceptionWhenSimpleTypeRestrictionAndValueIsInvalid(
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
     * current element is the "restriction" element (simpleType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAnnotationElementCreateEltWhenSimpleTypeRestriction(): void
    {
        $this->sut->buildAnnotationElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $ann = $res->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Tests that buildSimpleTypeElement() creates the element when the 
     * current element is the "restriction" element (simpleType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildSimpleTypeElementCreateEltWhenSimpleTypeRestriction(): void
    {
        $this->sut->buildSimpleTypeElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $st = $res->getSimpleTypeElement();
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertSame([], $st->getElements());
    }
    
    /**
     * Tests that buildMinExclusiveElement() creates the element when the 
     * current element is the "restriction" element (simpleType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildMinExclusiveElementCreateEltWhenSimpleTypeRestriction(): void
    {
        $this->sut->buildMinExclusiveElement();
        $this->sut->endElement();
        $this->sut->buildMinExclusiveElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $minexcs = $res->getMinExclusiveElements();
        
        self::assertElementNamespaceDeclarations([], $minexcs[0]);
        self::assertMinExclusiveElementHasNoAttribute($minexcs[0]);
        self::assertSame([], $minexcs[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $minexcs[1]);
        self::assertMinExclusiveElementHasNoAttribute($minexcs[1]);
        self::assertSame([], $minexcs[1]->getElements());
    }
    
    /**
     * Tests that buildMinInclusiveElement() creates the element when the 
     * current element is the "restriction" element (simpleType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildMinInclusiveElementCreateEltWhenSimpleTypeRestriction(): void
    {
        $this->sut->buildMinInclusiveElement();
        $this->sut->endElement();
        $this->sut->buildMinInclusiveElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $minincs = $res->getMinInclusiveElements();
        
        self::assertElementNamespaceDeclarations([], $minincs[0]);
        self::assertMinInclusiveElementHasNoAttribute($minincs[0]);
        self::assertSame([], $minincs[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $minincs[1]);
        self::assertMinInclusiveElementHasNoAttribute($minincs[1]);
        self::assertSame([], $minincs[1]->getElements());
    }
    
    /**
     * Tests that buildMaxExclusiveElement() creates the element when the 
     * current element is the "restriction" element (simpleType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildMaxExclusiveElementCreateEltWhenSimpleTypeRestriction(): void
    {
        $this->sut->buildMaxExclusiveElement();
        $this->sut->endElement();
        $this->sut->buildMaxExclusiveElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $maxexcs = $res->getMaxExclusiveElements();
        
        self::assertElementNamespaceDeclarations([], $maxexcs[0]);
        self::assertMaxExclusiveElementHasNoAttribute($maxexcs[0]);
        self::assertSame([], $maxexcs[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $maxexcs[1]);
        self::assertMaxExclusiveElementHasNoAttribute($maxexcs[1]);
        self::assertSame([], $maxexcs[1]->getElements());
    }
    
    /**
     * Tests that buildMaxInclusiveElement() creates the element when the 
     * current element is the "restriction" element (simpleType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildMaxInclusiveElementCreateEltWhenSimpleTypeRestriction(): void
    {
        $this->sut->buildMaxInclusiveElement();
        $this->sut->endElement();
        $this->sut->buildMaxInclusiveElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $maxincs = $res->getMaxInclusiveElements();
        
        self::assertElementNamespaceDeclarations([], $maxincs[0]);
        self::assertMaxInclusiveElementHasNoAttribute($maxincs[0]);
        self::assertSame([], $maxincs[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $maxincs[1]);
        self::assertMaxInclusiveElementHasNoAttribute($maxincs[1]);
        self::assertSame([], $maxincs[1]->getElements());
    }
    
    /**
     * Tests that buildTotalDigitsElement() creates the element when the 
     * current element is the "restriction" element (simpleType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildTotalDigitsElementCreateEltWhenSimpleTypeRestriction(): void
    {
        $this->sut->buildTotalDigitsElement();
        $this->sut->endElement();
        $this->sut->buildTotalDigitsElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $tds = $res->getTotalDigitsElements();
        
        self::assertElementNamespaceDeclarations([], $tds[0]);
        self::assertTotalDigitsElementHasNoAttribute($tds[0]);
        self::assertSame([], $tds[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $tds[1]);
        self::assertTotalDigitsElementHasNoAttribute($tds[1]);
        self::assertSame([], $tds[1]->getElements());
    }
    
    /**
     * Tests that buildFractionDigitsElement() creates the element when the 
     * current element is the "restriction" element (simpleType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildFractionDigitsElementCreateEltWhenSimpleTypeRestriction(): void
    {
        $this->sut->buildFractionDigitsElement();
        $this->sut->endElement();
        $this->sut->buildFractionDigitsElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $fds = $res->getFractionDigitsElements();
        
        self::assertElementNamespaceDeclarations([], $fds[0]);
        self::assertFractionDigitsElementHasNoAttribute($fds[0]);
        self::assertSame([], $fds[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $fds[1]);
        self::assertFractionDigitsElementHasNoAttribute($fds[1]);
        self::assertSame([], $fds[1]->getElements());
    }
    
    /**
     * Tests that buildLengthElement() creates the element when the current 
     * element is the "restriction" element (simpleType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildLengthElementCreateEltWhenSimpleTypeRestriction(): void
    {
        $this->sut->buildLengthElement();
        $this->sut->endElement();
        $this->sut->buildLengthElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $lengths = $res->getLengthElements();
        
        self::assertElementNamespaceDeclarations([], $lengths[0]);
        self::assertLengthElementHasNoAttribute($lengths[0]);
        self::assertSame([], $lengths[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $lengths[1]);
        self::assertLengthElementHasNoAttribute($lengths[1]);
        self::assertSame([], $lengths[1]->getElements());
    }
    
    /**
     * Tests that buildMinLengthElement() creates the element when the 
     * current element is the "restriction" element (simpleType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildMinLengthElementCreateEltWhenSimpleTypeRestriction(): void
    {
        $this->sut->buildMinLengthElement();
        $this->sut->endElement();
        $this->sut->buildMinLengthElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $minls = $res->getMinLengthElements();
        
        self::assertElementNamespaceDeclarations([], $minls[0]);
        self::assertMinLengthElementHasNoAttribute($minls[0]);
        self::assertSame([], $minls[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $minls[1]);
        self::assertMinLengthElementHasNoAttribute($minls[1]);
        self::assertSame([], $minls[1]->getElements());
    }
    
    /**
     * Tests that buildMaxLengthElement() creates the element when the 
     * current element is the "restriction" element (simpleType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildMaxLengthElementCreateEltWhenSimpleTypeRestriction(): void
    {
        $this->sut->buildMaxLengthElement();
        $this->sut->endElement();
        $this->sut->buildMaxLengthElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $maxls = $res->getMaxLengthElements();
        
        self::assertElementNamespaceDeclarations([], $maxls[0]);
        self::assertMaxLengthElementHasNoAttribute($maxls[0]);
        self::assertSame([], $maxls[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $maxls[1]);
        self::assertMaxLengthElementHasNoAttribute($maxls[1]);
        self::assertSame([], $maxls[1]->getElements());
    }
    
    /**
     * Tests that buildEnumerationElement() creates the element when the 
     * current element is the "restriction" element (simpleType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildEnumerationElementCreateEltWhenSimpleTypeRestriction(): void
    {
        $this->sut->buildEnumerationElement();
        $this->sut->endElement();
        $this->sut->buildEnumerationElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $enums = $res->getEnumerationElements();
        
        self::assertElementNamespaceDeclarations([], $enums[0]);
        self::assertEnumerationElementHasNoAttribute($enums[0]);
        self::assertSame([], $enums[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $enums[1]);
        self::assertEnumerationElementHasNoAttribute($enums[1]);
        self::assertSame([], $enums[1]->getElements());
    }
    
    /**
     * Tests that buildWhiteSpaceElement() creates the element when the 
     * current element is the "restriction" element (simpleType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildWhiteSpaceElementCreateEltWhenSimpleTypeRestriction(): void
    {
        $this->sut->buildWhiteSpaceElement();
        $this->sut->endElement();
        $this->sut->buildWhiteSpaceElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $wps = $res->getWhiteSpaceElements();
        
        self::assertElementNamespaceDeclarations([], $wps[0]);
        self::assertWhiteSpaceElementHasNoAttribute($wps[0]);
        self::assertSame([], $wps[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $wps[1]);
        self::assertWhiteSpaceElementHasNoAttribute($wps[1]);
        self::assertSame([], $wps[1]->getElements());
    }
    
    /**
     * Tests that buildPatternElement() creates the element when the current 
     * element is the "restriction" element (simpleType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildPatternElementCreateEltWhenSimpleTypeRestriction(): void
    {
        $this->sut->buildPatternElement();
        $this->sut->endElement();
        $this->sut->buildPatternElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $pats = $res->getPatternElements();
        
        self::assertElementNamespaceDeclarations([], $pats[0]);
        self::assertPatternElementHasNoAttribute($pats[0]);
        self::assertSame([], $pats[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $pats[1]);
        self::assertPatternElementHasNoAttribute($pats[1]);
        self::assertSame([], $pats[1]->getElements());
    }
}
