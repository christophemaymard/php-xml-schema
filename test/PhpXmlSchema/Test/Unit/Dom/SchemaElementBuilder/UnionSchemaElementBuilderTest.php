<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SchemaElementBuilder;
use PhpXmlSchema\Exception\InvalidOperationException;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "union" element.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class UnionSchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
{
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
    use BuildItemTypeAttributeDoesNotCreateAttributeTestTrait;
    use BuildUnionElementDoesNotCreateElementTestTrait;
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
    
    /**
     * {@inheritDoc}
     */
    public static function assertSchemaElementNotChanged(SchemaElement $sch)
    {
        self::assertAncestorsNotChanged($sch);
        
        $union = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $union);
        self::assertUnionElementHasNoAttribute($union);
        self::assertSame([], $union->getElements());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch)
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
    public static function assertCurrentElementHasNotAttribute(SchemaElement $sch)
    {
        self::assertUnionElementHasNoAttribute(self::getCurrentElement($sch));
    }
    
    /**
     * {@inheritDoc}
     */
    protected static function getCurrentElement(SchemaElement $sch)
    {
        return $sch->getAttributeElements()[0]
            ->getSimpleTypeElement()
            ->getDerivationElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildAttributeElement();
        $this->sut->buildSimpleTypeElement();
        $this->sut->buildUnionElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that buildIdAttribute() creates the attribute when the current 
     * element is the "union" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidIdValues
     */
    public function testBuildIdAttributeCreatesAttrWhenUnionAndValueIsValid(
        string $value, 
        string $id
    ) {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $union = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $union);
        self::assertUnionElementHasOnlyIdAttribute($union);
        self::assertSame($id, $union->getId()->getId());
        self::assertSame([], $union->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the current 
     * element is the "union" element and the value is invalid.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidIdValues
     */
    public function testBuildIdAttributeThrowsExceptionWhenUnionAndValueIsInvalid(
        string $value, 
        string $message
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildIdAttribute($value);
    }
    
    /**
     * Tests that buildMemberTypesAttribute() creates the attribute when:
     * - the current element is the "union" element, and 
     * - the value is a valid QName list, and 
     * - multiple QName with a local part and no prefix, and 
     * - no default namespace.
     * 
     * @param   string      $value      The value to test.
     * @param   string[]    $localParts The expected value for the local parts.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidQNameListLValues
     */
    public function testBuildMemberTypesAttributeCreatesAttrWhenUnionAndValueIsValidLAndNoDefaultNamespace(
        string $value, 
        array $localParts
    ) {
        $this->sut->buildMemberTypesAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $union = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $union);
        self::assertUnionElementHasOnlyMemberTypesAttribute($union);
        $qnames = $union->getMemberTypes();
        self::assertSame(\count($localParts), \count($qnames));
        
        foreach ($localParts as $idx => $localPart) {
            self::assertSame($localPart, $qnames[$idx]->getLocalPart()->getNCName());
            self::assertFalse($qnames[$idx]->hasNamespace());
        }
        
        self::assertSame([], $union->getElements());
    }
    
    /**
     * Tests that buildMemberTypesAttribute() creates the attribute when:
     * - the current element is the "union" element, and 
     * - the value is a valid QName list, and 
     * - 1 QName with a local part and no prefix, and 
     * - default namespace.
     * 
     * @param   string      $value      The value to test.
     * @param   string[]    $localParts The expected value for the local parts.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidQNameListLValues
     */
    public function testBuildMemberTypesAttributeCreatesAttrWhenUnionAndValueIsValidLAndDefaultNamespace(
        string $value, 
        array $localParts
    ) {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('', 'http://example.org');
        $this->sut->buildAttributeElement();
        $this->sut->buildSimpleTypeElement();
        $this->sut->buildUnionElement();
        $this->sut->buildMemberTypesAttribute($value);
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
        
        $union = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $union);
        self::assertUnionElementHasOnlyMemberTypesAttribute($union);
        $qnames = $union->getMemberTypes();
        self::assertSame(\count($localParts), \count($qnames));
        
        foreach ($localParts as $idx => $localPart) {
            self::assertSame($localPart, $qnames[$idx]->getLocalPart()->getNCName());
            self::assertSame('http://example.org', $qnames[$idx]->getNamespace()->getUri());
        }
        
        self::assertSame([], $union->getElements());
    }
    
    /**
     * Tests that buildMemberTypesAttribute() throws an exception when the 
     * current element is the "union" element and the value is an invalid 
     * QName list.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidQNameListValues
     */
    public function testBuildMemberTypesAttributeThrowsExceptionWhenUnionAndValueIsInvalid(
        string $value, 
        string $message
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildMemberTypesAttribute($value);
    }
    
    /**
     * Tests that buildMemberTypesAttribute() creates the attribute when:
     * - the current element is the "union" element, and 
     * - the value is a valid QName list, and 
     * - 2 QName with a prefix and a local part, and 
     * - prefixes are associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildMemberTypesAttributeCreatesAttrWhenUnionAndValueIsValidAndPrefixAssociatedNamespace()
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('foo', 'http://example.org/foo');
        $this->sut->bindNamespace('baz', 'http://example.org/baz');
        $this->sut->buildAttributeElement();
        $this->sut->buildSimpleTypeElement();
        $this->sut->buildUnionElement();
        $this->sut->buildMemberTypesAttribute('foo:bar baz:qux');
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(
            [ 
                'foo' => 'http://example.org/foo', 
                'baz' => 'http://example.org/baz', 
            ], 
            $sch
        );
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
        
        $union = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $union);
        self::assertUnionElementHasOnlyMemberTypesAttribute($union);
        $qnames = $union->getMemberTypes();
        self::assertCount(2, $qnames);
        self::assertSame('bar', $qnames[0]->getLocalPart()->getNCName());
        self::assertSame('http://example.org/foo', $qnames[0]->getNamespace()->getUri());
        self::assertSame('qux', $qnames[1]->getLocalPart()->getNCName());
        self::assertSame('http://example.org/baz', $qnames[1]->getNamespace()->getUri());
        self::assertSame([], $union->getElements());
    }
    
    /**
     * Tests that buildMemberTypesAttribute() throws an exception when:
     * - the current element is the "union" element, and 
     * - the value is a valid QName list, and 
     * - the prefix is not associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildMemberTypesAttributeThrowsExceptionWhenUnionAndValueIsValidAndPrefixNotAssociatedNamespace()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The "bar" prefix is not bound to a namespace.');
        
        $this->sut->buildMemberTypesAttribute('foo bar:baz');
    }
    
    /**
     * Tests that buildAnnotationElement() creates the element when the 
     * current element is the "union" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAnnotationElementCreateEltWhenUnion()
    {
        $this->sut->buildAnnotationElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $union = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $union);
        self::assertUnionElementHasNoAttribute($union);
        self::assertCount(1, $union->getElements());
        
        $ann = $union->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Tests that buildSimpleTypeElement() creates the element when the 
     * current element is the "union" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildSimpleTypeElementCreateEltWhenUnion()
    {
        $this->sut->buildSimpleTypeElement();
        $this->sut->endElement();
        $this->sut->buildSimpleTypeElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $union = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $union);
        self::assertUnionElementHasNoAttribute($union);
        self::assertCount(2, $union->getElements());
        
        $sts = $union->getSimpleTypeElements();
        
        self::assertElementNamespaceDeclarations([], $sts[0]);
        self::assertSimpleTypeElementHasNoAttribute($sts[0]);
        self::assertSame([], $sts[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $sts[1]);
        self::assertSimpleTypeElementHasNoAttribute($sts[1]);
        self::assertSame([], $sts[1]->getElements());
    }
}
