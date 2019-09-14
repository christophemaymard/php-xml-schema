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
use PhpXmlSchema\Test\Unit\Datatype\NCNameTypeProviderTrait;
use PhpXmlSchema\Test\Unit\Datatype\NonNegativeIntegerTypeProviderTrait;
use PhpXmlSchema\Test\Unit\Datatype\QNameTypeProviderTrait;
use PhpXmlSchema\Test\Unit\Dom\NonNegativeIntegerLimitTypeProviderTrait;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "group" element (groupRef).
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class GroupRefSchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
{
    use NonNegativeIntegerLimitTypeProviderTrait;
    use NonNegativeIntegerTypeProviderTrait;
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
    use BuildSimpleTypeElementDoesNotCreateElementTestTrait;
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
    use BuildFormAttributeDoesNotCreateAttributeTestTrait;
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
    use BuildAllElementDoesNotCreateElementTestTrait;
    use BuildElementElementDoesNotCreateElementTestTrait;
    use BuildNillableAttributeDoesNotCreateAttributeTestTrait;
    use BuildChoiceElementDoesNotCreateElementTestTrait;
    use BuildUniqueElementDoesNotCreateElementTestTrait;
    use BuildSelectorElementDoesNotCreateElementTestTrait;
    use BuildFieldElementDoesNotCreateElementTestTrait;
    use BuildXPathAttributeDoesNotCreateAttributeTestTrait;
    use BuildKeyElementDoesNotCreateElementTestTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertSchemaElementNotChanged(SchemaElement $sch)
    {
        self::assertAncestorsNotChanged($sch);
        
        $grp = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $grp);
        self::assertGroupElementHasNoAttribute($grp);
        self::assertSame([], $grp->getElements());
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
        
        $cc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $cc);
        self::assertComplexContentElementHasNoAttribute($cc);
        self::assertCount(1, $cc->getElements());
        
        $res = $cc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertComplexContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        self::assertNotNull($res->getTypeDefinitionParticleElement());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertCurrentElementHasNotAttribute(SchemaElement $sch)
    {
        self::assertGroupElementHasNoAttribute(self::getCurrentElement($sch));
    }
    
    /**
     * {@inheritDoc}
     */
    protected static function getCurrentElement(SchemaElement $sch)
    {
        return $sch->getComplexTypeElements()[0]
            ->getContentElement()
            ->getDerivationElement()
            ->getTypeDefinitionParticleElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildComplexTypeElement();
        $this->sut->buildComplexContentElement();
        $this->sut->buildRestrictionElement();
        $this->sut->buildGroupElement();
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
     * element is the "group" element (groupRef) and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNCNameTypeWSValues
     */
    public function testBuildIdAttributeCreatesAttrWhenGroupRefAndValueIsValid(
        string $value, 
        string $id
    ) {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $grp = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $grp);
        self::assertGroupElementHasOnlyIdAttribute($grp);
        self::assertSame($id, $grp->getId()->getId());
        self::assertSame([], $grp->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the current 
     * element is the "group" element (groupRef) and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $mValue The string representation of the value in the exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNCNameTypeWSValues
     */
    public function testBuildIdAttributeThrowsExceptionWhenGroupRefAndValueIsInvalid(
        string $value, 
        string $mValue
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid ID datatype.', 
            $mValue
        ));
        
        $this->sut->buildIdAttribute($value);
    }
    
    /**
     * Tests that buildMaxOccursAttribute() creates the attribute when the 
     * current element is the "group" element (groupRef) and the value is 
     * "unbounded".
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildMaxOccursAttributeCreatesAttrWhenGroupRefAndValueIsUnbounded()
    {
        $this->sut->buildMaxOccursAttribute('unbounded');
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $grp = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $grp);
        self::assertGroupElementHasOnlyMaxOccursAttribute($grp);
        self::assertTrue($grp->getMaxOccurs()->isUnlimited());
        self::assertSame([], $grp->getElements());
    }
    
    /**
     * Tests that buildMaxOccursAttribute() creates the attribute when the 
     * current element is the "group" element (groupRef) and the value is a 
     * valid non-negative integer.
     * 
     * @param   string  $value  The value to test.
     * @param   \GMP    $nni    The expected value for the non-negative integer.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNonNegativeIntegerTypeValues
     */
    public function testBuildMaxOccursAttributeCreatesAttrWhenGroupRefAndValueIsNonNegativeInteger(
        string $value, 
        \GMP $nni
    ) {
        $this->sut->buildMaxOccursAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $grp = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $grp);
        self::assertGroupElementHasOnlyMaxOccursAttribute($grp);
        self::assertEquals($nni, $grp->getMaxOccurs()->getLimit()->getNonNegativeInteger());
        self::assertSame([], $grp->getElements());
    }
    
    /**
     * Tests that buildMaxOccursAttribute() throws an exception when the 
     * current element is the "group" element (groupRef) and the value is 
     * invalid.
     * 
     * @param   string  $value      The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNonNegativeIntegerLimitTypeValues
     * @dataProvider    getInvalidNonNegativeIntegerTypeValues
     */
    public function testBuildMaxOccursAttributeThrowsExceptionWhenGroupRefAndValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is an invalid non-negative integer limit type.', $value));
        
        $this->sut->buildMaxOccursAttribute($value);
    }
    
    /**
     * Tests that buildMinOccursAttribute() creates the attribute when the 
     * current element is the "group" element (groupRef) and the value is 
     * valid.
     * 
     * @param   string  $value  The value to test.
     * @param   \GMP    $nni    The expected value for the non-negative integer.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNonNegativeIntegerTypeValues
     */
    public function testBuildMinOccursAttributeCreatesAttrWhenGroupRefAndValueIsValid(
        string $value, 
        \GMP $nni
    ) {
        $this->sut->buildMinOccursAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $grp = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $grp);
        self::assertGroupElementHasOnlyMinOccursAttribute($grp);
        self::assertEquals($nni, $grp->getMinOccurs()->getNonNegativeInteger());
        self::assertSame([], $grp->getElements());
    }
    
    /**
     * Tests that buildMinOccursAttribute() throws an exception when the 
     * current element is the "group" element (groupRef) and the value is 
     * invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNonNegativeIntegerTypeValues
     */
    public function testBuildMinOccursAttributeThrowsExceptionWhenGroupRefAndValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid nonNegativeInteger datatype.', 
            $value
        ));
        
        $this->sut->buildMinOccursAttribute($value);
    }
    
    /**
     * Tests that buildRefAttribute() creates the attribute when:
     * - the current element is the "group" element (groupRef), and 
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
    public function testBuildRefAttributeCreatesAttrWhenGroupRefAndValueIsValidQNameLocalPartAndNoDefaultNamespace(
        string $value, 
        string $localPart
    ) {
        $this->sut->buildRefAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $grp = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $grp);
        self::assertGroupElementHasOnlyRefAttribute($grp);
        self::assertSame($localPart, $grp->getRef()->getLocalPart()->getNCName());
        self::assertFalse($grp->getRef()->hasNamespace());
        self::assertSame([], $grp->getElements());
    }
    
    /**
     * Tests that buildRefAttribute() creates the attribute when:
     * - the current element is the "group" element (groupRef), and 
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
    public function testBuildRefAttributeCreatesAttrWhenGroupRefAndValueIsValidQNameLocalPartAndDefaultNamespace(
        string $value, 
        string $localPart
    ) {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('', 'http://example.org');
        $this->sut->buildComplexTypeElement();
        $this->sut->buildComplexContentElement();
        $this->sut->buildRestrictionElement();
        $this->sut->buildGroupElement();
        $this->sut->buildRefAttribute($value);
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
        
        $res = $cc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertComplexContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        self::assertNotNull($res->getTypeDefinitionParticleElement());
        
        $grp = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $grp);
        self::assertGroupElementHasOnlyRefAttribute($grp);
        self::assertSame($localPart, $grp->getRef()->getLocalPart()->getNCName());
        self::assertSame('http://example.org', $grp->getRef()->getNamespace()->getAnyUri());
        self::assertSame([], $grp->getElements());
    }
    
    /**
     * Tests that buildRefAttribute() throws an exception when the current 
     * element is the "group" element (groupRef) and the value is an invalid 
     * QName.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidQNameTypeValues
     */
    public function testBuildRefAttributeThrowsExceptionWhenGroupRefAndValueIsInvalid(
        string $value, 
        string $message
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildRefAttribute($value);
    }
    
    /**
     * Tests that buildRefAttribute() creates the attribute when:
     * - the current element is the "group" element (groupRef), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildRefAttributeCreatesAttrWhenGroupRefAndValueIsValidAndPrefixAssociatedNamespace()
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('foo', 'http://example.org/foo');
        $this->sut->buildComplexTypeElement();
        $this->sut->buildComplexContentElement();
        $this->sut->buildRestrictionElement();
        $this->sut->buildGroupElement();
        $this->sut->buildRefAttribute('foo:bar');
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
        
        $res = $cc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertComplexContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        self::assertNotNull($res->getTypeDefinitionParticleElement());
        
        $grp = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $grp);
        self::assertGroupElementHasOnlyRefAttribute($grp);
        self::assertSame('bar', $grp->getRef()->getLocalPart()->getNCName());
        self::assertSame('http://example.org/foo', $grp->getRef()->getNamespace()->getAnyUri());
        self::assertSame([], $grp->getElements());
    }
    
    /**
     * Tests that buildRefAttribute() throws an exception when:
     * - the current element is the "group" element (groupRef), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is not associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildRefAttributeThrowsExceptionWhenGroupRefAndValueIsValidAndPrefixNotAssociatedNamespace()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The "foo" prefix is not bound to a namespace.');
        
        $this->sut->buildRefAttribute('foo:bar');
    }
    
    /**
     * Tests that buildAnnotationElement() creates the element when the 
     * current element is the "group" element (groupRef).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAnnotationElementCreateEltWhenGroupRef()
    {
        $this->sut->buildAnnotationElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $grp = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $grp);
        self::assertGroupElementHasNoAttribute($grp);
        self::assertCount(1, $grp->getElements());
        
        $ann = $grp->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
}
