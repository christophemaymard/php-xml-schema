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
 * class when the current element is the "restriction" element 
 * (simpleRestrictionType).
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleContentRestrictionSchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
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
    use BuildValueAttributeDoesNotCreateAttributeTestTrait;
    use BuildWhiteSpaceElementDoesNotCreateElementTestTrait;
    use BuildPatternElementDoesNotCreateElementTestTrait;
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
    
    /**
     * {@inheritDoc}
     */
    public static function assertSchemaElementNotChanged(SchemaElement $sch)
    {
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertSame([], $res->getElements());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch)
    {
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        self::assertNotNull($sc->getDerivationElement());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertCurrentElementHasNotAttribute(SchemaElement $sch)
    {
        self::assertSimpleContentRestrictionElementHasNoAttribute(self::getCurrentElement($sch));
    }
    
    /**
     * {@inheritDoc}
     */
    protected static function getCurrentElement(SchemaElement $sch)
    {
        return $sch->getComplexTypeElements()[0]
            ->getContentElement()
            ->getDerivationElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildComplexTypeElement();
        $this->sut->buildSimpleContentElement();
        $this->sut->buildRestrictionElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that buildBaseAttribute() creates the attribute when:
     * - the current element is the "restriction" element 
     * (simpleRestrictionType), and 
     * - the value is a valid QName (local part without prefix), and 
     * - no default namespace.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $localPart  The expected value for the local part.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidQNameLocalPartValues
     */
    public function testBuildBaseAttributeCreatesAttrWhenSimpleContentRestrictionAndValueIsValidQNameLocalPartAndNoDefaultNamespace(
        string $value, 
        string $localPart
    ) {
        $this->sut->buildBaseAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasOnlyBaseAttribute($res);
        self::assertSame($localPart, $res->getBase()->getLocalPart()->getNCName());
        self::assertFalse($res->getBase()->hasNamespace());
        self::assertSame([], $res->getElements());
    }
    
    /**
     * Tests that buildBaseAttribute() creates the attribute when:
     * - the current element is the "restriction" element 
     * (simpleRestrictionType), and 
     * - the value is a valid QName (local part without prefix), and 
     * - default namespace.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $localPart  The expected value for the local part.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidQNameLocalPartValues
     */
    public function testBuildBaseAttributeCreatesAttrWhenSimpleContentRestrictionAndValueIsValidQNameLocalPartAndDefaultNamespace(
        string $value, 
        string $localPart
    ) {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('', 'http://example.org');
        $this->sut->buildComplexTypeElement();
        $this->sut->buildSimpleContentElement();
        $this->sut->buildRestrictionElement();
        $this->sut->buildBaseAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['' => 'http://example.org' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        self::assertNotNull($sc->getDerivationElement());
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasOnlyBaseAttribute($res);
        self::assertSame($localPart, $res->getBase()->getLocalPart()->getNCName());
        self::assertSame('http://example.org', $res->getBase()->getNamespace()->getUri());
        self::assertSame([], $res->getElements());
    }
    
    /**
     * Tests that buildBaseAttribute() throws an exception when the current 
     * element is the "restriction" element (simpleRestrictionType) and the 
     * value is an invalid QName.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidQNameValues
     */
    public function testBuildBaseAttributeThrowsExceptionWhenSimpleContentRestrictionAndValueIsInvalid(
        string $value, 
        string $message
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildBaseAttribute($value);
    }
    
    /**
     * Tests that buildBaseAttribute() creates the attribute when:
     * - the current element is the "restriction" element 
     * (simpleRestrictionType), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildBaseAttributeCreatesAttrWhenSimpleContentRestrictionAndValueIsValidAndPrefixAssociatedNamespace()
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('foo', 'http://example.org/foo');
        $this->sut->buildComplexTypeElement();
        $this->sut->buildSimpleContentElement();
        $this->sut->buildRestrictionElement();
        $this->sut->buildBaseAttribute('foo:bar');
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['foo' => 'http://example.org/foo' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        self::assertNotNull($sc->getDerivationElement());
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasOnlyBaseAttribute($res);
        self::assertSame('bar', $res->getBase()->getLocalPart()->getNCName());
        self::assertSame('http://example.org/foo', $res->getBase()->getNamespace()->getUri());
        self::assertSame([], $res->getElements());
    }
    
    /**
     * Tests that buildBaseAttribute() throws an exception when:
     * - the current element is the "restriction" element 
     * (simpleRestrictionType), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is not associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildBaseAttributeThrowsExceptionWhenSimpleContentRestrictionAndValueIsValidAndPrefixNotAssociatedNamespace()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The "foo" prefix is not bound to a namespace.');
        
        $this->sut->buildBaseAttribute('foo:bar');
    }
    
    /**
     * Tests that buildIdAttribute() creates the attribute when the current 
     * element is the "restriction" element (simpleRestrictionType) and the 
     * value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidIdValues
     */
    public function testBuildIdAttributeCreatesAttrWhenSimpleContentRestrictionAndValueIsValid(
        string $value, 
        string $id
    ) {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasOnlyIdAttribute($res);
        self::assertSame($id, $res->getId()->getId());
        self::assertSame([], $res->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the current 
     * element is the "restriction" element (simpleRestrictionType) and the 
     * value is invalid.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidIdValues
     */
    public function testBuildIdAttributeThrowsExceptionWhenSimpleContentRestrictionAndValueIsInvalid(
        string $value, 
        string $message
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildIdAttribute($value);
    }
    
    /**
     * Tests that buildAnnotationElement() creates the element when the 
     * current element is the "restriction" element (simpleRestrictionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAnnotationElementCreateEltWhenSimpleContentRestriction()
    {
        $this->sut->buildAnnotationElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $ann = $res->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Tests that buildSimpleTypeElement() creates the element when the 
     * current element is the "restriction" element (simpleRestrictionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildSimpleTypeElementCreateEltWhenSimpleContentRestriction()
    {
        $this->sut->buildSimpleTypeElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $st = $res->getSimpleTypeElement();
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertSame([], $st->getElements());
    }
    
    /**
     * Tests that buildMinExclusiveElement() creates the element when the 
     * current element is the "restriction" element (simpleRestrictionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildMinExclusiveElementCreateEltWhenSimpleContentRestriction()
    {
        $this->sut->buildMinExclusiveElement();
        $this->sut->endElement();
        $this->sut->buildMinExclusiveElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
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
     * current element is the "restriction" element (simpleRestrictionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildMinInclusiveElementCreateEltWhenSimpleContentRestriction()
    {
        $this->sut->buildMinInclusiveElement();
        $this->sut->endElement();
        $this->sut->buildMinInclusiveElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
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
     * current element is the "restriction" element (simpleRestrictionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildMaxExclusiveElementCreateEltWhenSimpleContentRestriction()
    {
        $this->sut->buildMaxExclusiveElement();
        $this->sut->endElement();
        $this->sut->buildMaxExclusiveElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
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
     * current element is the "restriction" element (simpleRestrictionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildMaxInclusiveElementCreateEltWhenSimpleContentRestriction()
    {
        $this->sut->buildMaxInclusiveElement();
        $this->sut->endElement();
        $this->sut->buildMaxInclusiveElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
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
     * current element is the "restriction" element (simpleRestrictionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildTotalDigitsElementCreateEltWhenSimpleContentRestriction()
    {
        $this->sut->buildTotalDigitsElement();
        $this->sut->endElement();
        $this->sut->buildTotalDigitsElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
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
     * current element is the "restriction" element (simpleRestrictionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildFractionDigitsElementCreateEltWhenSimpleContentRestriction()
    {
        $this->sut->buildFractionDigitsElement();
        $this->sut->endElement();
        $this->sut->buildFractionDigitsElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
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
     * Tests that buildLengthElement() creates the element when the 
     * current element is the "restriction" element (simpleRestrictionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildLengthElementCreateEltWhenSimpleContentRestriction()
    {
        $this->sut->buildLengthElement();
        $this->sut->endElement();
        $this->sut->buildLengthElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
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
     * current element is the "restriction" element (simpleRestrictionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildMinLengthElementCreateEltWhenSimpleContentRestriction()
    {
        $this->sut->buildMinLengthElement();
        $this->sut->endElement();
        $this->sut->buildMinLengthElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
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
     * current element is the "restriction" element (simpleRestrictionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildMaxLengthElementCreateEltWhenSimpleContentRestriction()
    {
        $this->sut->buildMaxLengthElement();
        $this->sut->endElement();
        $this->sut->buildMaxLengthElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
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
     * current element is the "restriction" element (simpleRestrictionType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildEnumerationElementCreateEltWhenSimpleContentRestriction()
    {
        $this->sut->buildEnumerationElement();
        $this->sut->endElement();
        $this->sut->buildEnumerationElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $res = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $enums = $res->getEnumerationElements();
        
        self::assertElementNamespaceDeclarations([], $enums[0]);
        self::assertEnumerationElementHasNoAttribute($enums[0]);
        self::assertSame([], $enums[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $enums[1]);
        self::assertEnumerationElementHasNoAttribute($enums[1]);
        self::assertSame([], $enums[1]->getElements());
    }
}
