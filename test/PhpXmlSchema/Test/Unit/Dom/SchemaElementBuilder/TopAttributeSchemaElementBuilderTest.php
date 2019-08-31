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
 * class when the current element is the "attribute" element 
 * (topLevelAttributeType).
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TopAttributeSchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
{
    use BindNamespaceTestTrait;
    
    use BuildAttributeFormDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildBlockDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildElementFormDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildFinalDefaultAttributeDoesNotCreateAttributeTestTrait;
    //use BuildIdAttributeDoesNotCreateAttributeTestTrait;
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
    
    /**
     * {@inheritDoc}
     */
    public static function assertSchemaElementNotChanged(SchemaElement $sch)
    {
        self::assertAncestorsNotChanged($sch);
        
        $attr = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasNoAttribute($attr);
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch)
    {
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        self::assertCount(1, $sch->getAttributeElements());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertCurrentElementHasNotAttribute(SchemaElement $sch)
    {
        self::assertAttributeElementHasNoAttribute(self::getCurrentElement($sch));
    }
    
    /**
     * {@inheritDoc}
     */
    protected static function getCurrentElement(SchemaElement $sch)
    {
        return $sch->getAttributeElements()[0];
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildAttributeElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that buildDefaultAttribute() creates the attribute when the 
     * current element is the "attribute" element (topLevelAttributeType) and 
     * the value is valid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidStringValues
     */
    public function testBuildDefaultAttributeCreatesAttrWhenTopAttributeAndValueIsValid(
        string $value
    ) {
        $this->sut->buildDefaultAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $attr = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyDefaultAttribute($attr);
        self::assertSame($value, $attr->getDefault()->getString());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildDefaultAttribute() throws an exception when the 
     * current element is the "attribute" element (topLevelAttributeType) and 
     * the value is invalid.
     * 
     * @param   string  $value      The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidStringValues
     */
    public function testBuildDefaultAttributeThrowsExceptionWhenTopAttributeAndValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('"'.$value.'" is an invalid string.');
        
        $this->sut->buildDefaultAttribute($value);
    }
    
    /**
     * Tests that buildFixedAttribute() creates the attribute when the 
     * current element is the "attribute" element (topLevelAttributeType) and 
     * the value is valid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidStringValues
     */
    public function testBuildFixedAttributeCreatesAttrWhenTopAttributeAndValueIsValid(
        string $value
    ) {
        $this->sut->buildFixedAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $attr = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyFixedAttribute($attr);
        self::assertSame($value, $attr->getFixed()->getString());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildFixedAttribute() throws an exception when the 
     * current element is the "attribute" element (topLevelAttributeType) and 
     * the value is invalid.
     * 
     * @param   string  $value      The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidStringValues
     */
    public function testBuildFixedAttributeThrowsExceptionWhenTopAttributeAndValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('"'.$value.'" is an invalid string.');
        
        $this->sut->buildFixedAttribute($value);
    }
    
    /**
     * Tests that buildIdAttribute() creates the attribute when the current 
     * element is the "attribute" element (topLevelAttributeType) and the 
     * value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidIdValues
     */
    public function testBuildIdAttributeCreatesAttrWhenTopAttributeAndValueIsValid(
        string $value, 
        string $id
    ) {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $attr = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyIdAttribute($attr);
        self::assertSame($id, $attr->getId()->getId());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the current 
     * element is the "attribute" element (topLevelAttributeType) and the 
     * value is invalid.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidIdValues
     */
    public function testBuildIdAttributeThrowsExceptionWhenTopAttributeAndValueIsInvalid(
        string $value, 
        string $message
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildIdAttribute($value);
    }
    
    /**
     * Tests that buildNameAttribute() creates the attribute when the current 
     * element is the "attribute" element (topLevelAttributeType) and the 
     * value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $name   The expected value for the name.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNCNameValues
     */
    public function testBuildNameAttributeCreatesAttrWhenTopAttributeAndValueIsValid(
        string $value, 
        string $name
    ) {
        $this->sut->buildNameAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $attr = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyNameAttribute($attr);
        self::assertSame($name, $attr->getName()->getNCName());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildNameAttribute() throws an exception when the current 
     * element is the "attribute" element (topLevelAttributeType) and the 
     * value is invalid.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNCNameValues
     */
    public function testBuildNameAttributeThrowsExceptionWhenTopAttributeAndValueIsInvalid(
        string $value, 
        string $message
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildNameAttribute($value);
    }
    
    /**
     * Tests that buildTypeAttribute() creates the attribute when:
     * - the current element is the "attribute" element 
     * (topLevelAttributeType), and 
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
    public function testBuildTypeAttributeCreatesAttrWhenTopAttributeAndValueIsValidQNameLocalPartAndNoDefaultNamespace(
        string $value, 
        string $localPart
    ) {
        $this->sut->buildTypeAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $attr = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyTypeAttribute($attr);
        self::assertSame($localPart, $attr->getType()->getLocalPart()->getNCName());
        self::assertFalse($attr->getType()->hasNamespace());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildTypeAttribute() creates the attribute when:
     * - the current element is the "attribute" element 
     * (topLevelAttributeType), and 
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
    public function testBuildTypeAttributeCreatesAttrWhenTopAttributeAndValueIsValidQNameLocalPartAndDefaultNamespace(
        string $value, 
        string $localPart
    ) {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('', 'http://example.org');
        $this->sut->buildAttributeElement();
        $this->sut->buildTypeAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['' => 'http://example.org' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        self::assertCount(1, $sch->getAttributeElements());
        
        $attr = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyTypeAttribute($attr);
        self::assertSame($localPart, $attr->getType()->getLocalPart()->getNCName());
        self::assertSame('http://example.org', $attr->getType()->getNamespace()->getUri());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildTypeAttribute() throws an exception when the current 
     * element is the "attribute" element (topLevelAttributeType) and the 
     * value is an invalid QName.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidQNameValues
     */
    public function testBuildTypeAttributeThrowsExceptionWhenTopAttributeAndValueIsInvalid(
        string $value, 
        string $message
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildTypeAttribute($value);
    }
    
    /**
     * Tests that buildTypeAttribute() creates the attribute when:
     * - the current element is the "attribute" element 
     * (topLevelAttributeType), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildTypeAttributeCreatesAttrWhenTopAttributeAndValueIsValidAndPrefixAssociatedNamespace()
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('foo', 'http://example.org/foo');
        $this->sut->buildAttributeElement();
        $this->sut->buildTypeAttribute('foo:bar');
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['foo' => 'http://example.org/foo' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        self::assertCount(1, $sch->getAttributeElements());
        
        $attr = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyTypeAttribute($attr);
        self::assertSame('bar', $attr->getType()->getLocalPart()->getNCName());
        self::assertSame('http://example.org/foo', $attr->getType()->getNamespace()->getUri());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildTypeAttribute() throws an exception when:
     * - the current element is the "attribute" element 
     * (topLevelAttributeType), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is not associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildTypeAttributeThrowsExceptionWhenTopAttributeAndValueIsValidAndPrefixNotAssociatedNamespace()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The "foo" prefix is not bound to a namespace.');
        
        $this->sut->buildTypeAttribute('foo:bar');
    }
    
    /**
     * Tests that buildAnnotationElement() creates the element when the 
     * current element is the "attribute" element (topLevelAttributeType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAnnotationElementCreateEltWhenTopAttribute()
    {
        $this->sut->buildAnnotationElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $attr = self::getCurrentElement($sch);
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
     * current element is the "attribute" element (topLevelAttributeType).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildSimpleTypeElementCreateEltWhenTopAttribute()
    {
        $this->sut->buildSimpleTypeElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $attr = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasNoAttribute($attr);
        self::assertCount(1, $attr->getElements());
        
        $st = $attr->getSimpleTypeElement();
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertSame([], $st->getElements());
    }
}
