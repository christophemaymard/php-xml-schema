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
use PhpXmlSchema\Test\Unit\Datatype\BooleanTypeProviderTrait;
use PhpXmlSchema\Test\Unit\Datatype\NCNameTypeProviderTrait;
use PhpXmlSchema\Test\Unit\Datatype\QNameTypeProviderTrait;
use PhpXmlSchema\Test\Unit\Datatype\StringTypeProviderTrait;
use PhpXmlSchema\Test\Unit\Dom\DerivationTypeProviderTrait;

/**
 * Represents the base class to unit test the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "element" element.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractElementSchemaElementBuilderTestCase extends AbstractSchemaElementBuilderTestCase
{
    use BooleanTypeProviderTrait;
    use DerivationTypeProviderTrait;
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
    use BuildAttributeGroupElementDoesNotCreateElementTestTrait;
    use BuildUseAttributeDoesNotCreateAttributeTestTrait;
    use BuildAnyAttributeElementDoesNotCreateElementTestTrait;
    use BuildProcessContentsAttributeDoesNotCreateAttributeTestTrait;
    use BuildMixedAttributeDoesNotCreateAttributeTestTrait;
    use BuildSimpleContentElementDoesNotCreateElementTestTrait;
    use BuildExtensionElementDoesNotCreateElementTestTrait;
    use BuildComplexContentElementDoesNotCreateElementTestTrait;
    use BuildGroupElementDoesNotCreateElementTestTrait;
    use BuildAllElementDoesNotCreateElementTestTrait;
    use BuildElementElementDoesNotCreateElementTestTrait;
    use BuildChoiceElementDoesNotCreateElementTestTrait;
    use BuildSelectorElementDoesNotCreateElementTestTrait;
    use BuildFieldElementDoesNotCreateElementTestTrait;
    use BuildXPathAttributeDoesNotCreateAttributeTestTrait;
    use BuildReferAttributeDoesNotCreateAttributeTestTrait;
    use BuildSequenceElementDoesNotCreateElementTestTrait;
    use BuildAnyElementDoesNotCreateElementTestTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertSchemaElementNotChanged(SchemaElement $sch): void
    {
        static::assertAncestorsNotChanged($sch);
        
        $elt = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasNoAttribute($elt);
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertCurrentElementHasNotAttribute(SchemaElement $sch): void
    {
        self::assertElementElementHasNoAttribute(static::getCurrentElement($sch));
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown(): void
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that buildBlockAttribute() creates the attribute when the 
     * current element is the "element" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $res    The expected value for the "restriction" flag.
     * @param   bool    $ext    The expected value for the "extension" flag.
     * @param   bool    $sub    The expected value for the "substitution" flag.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidBlockSetTypeValues
     */
    public function testBuildBlockAttributeCreatesAttrWhenElementAndValueIsValid(
        string $value, 
        bool $res, 
        bool $ext, 
        bool $sub
    ): void
    {
        $this->sut->buildBlockAttribute($value);
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $elt = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyBlockAttribute($elt);
        self::assertElementElementBlockAttribute($res, $ext, $sub, $elt);
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildBlockAttribute() throws an exception when the 
     * current element is the "element" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidBlockSetTypeValues
     */
    public function testBuildBlockAttributeThrowsExceptionWhenElementAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid blockSet type, expected "#all" or a list of '.
            '"extension", "restriction" and/or "substitution".',
            $value
        ));
        
        $this->sut->buildBlockAttribute($value);
    }
    
    /**
     * Tests that buildDefaultAttribute() creates the attribute when the 
     * current element is the "element" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidStringTypeValues
     */
    public function testBuildDefaultAttributeCreatesAttrWhenElementAndValueIsValid(
        string $value
    ): void
    {
        $this->sut->buildDefaultAttribute($value);
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $elt = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyDefaultAttribute($elt);
        self::assertSame($value, $elt->getDefault()->getString());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildDefaultAttribute() throws an exception when the 
     * current element is the "element" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidStringTypeValues
     */
    public function testBuildDefaultAttributeThrowsExceptionWhenElementAndValueIsInvalid(
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
     * current element is the "element" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidStringTypeValues
     */
    public function testBuildFixedAttributeCreatesAttrWhenElementAndValueIsValid(
        string $value
    ): void
    {
        $this->sut->buildFixedAttribute($value);
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $elt = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyFixedAttribute($elt);
        self::assertSame($value, $elt->getFixed()->getString());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildFixedAttribute() throws an exception when the current 
     * element is the "element" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidStringTypeValues
     */
    public function testBuildFixedAttributeThrowsExceptionWhenElementAndValueIsInvalid(
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
     * element is the "element" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNCNameTypeWSValues
     */
    public function testBuildIdAttributeCreatesAttrWhenElementAndValueIsValid(
        string $value, 
        string $id
    ): void
    {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $elt = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyIdAttribute($elt);
        self::assertSame($id, $elt->getId()->getId());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the current 
     * element is the "element" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $mValue The string representation of the value in the exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNCNameTypeWSValues
     */
    public function testBuildIdAttributeThrowsExceptionWhenElementAndValueIsInvalid(
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
     * element is the "element" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $name   The expected value for the name.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNCNameTypeWSValues
     */
    public function testBuildNameAttributeCreatesAttrWhenElementAndValueIsValid(
        string $value, 
        string $name
    ): void
    {
        $this->sut->buildNameAttribute($value);
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $elt = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyNameAttribute($elt);
        self::assertSame($name, $elt->getName()->getNCName());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildNameAttribute() throws an exception when the current 
     * element is the "element" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $mValue The string representation of the value in the exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNCNameTypeWSValues
     */
    public function testBuildNameAttributeThrowsExceptionWhenElementAndValueIsInvalid(
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
     * Tests that buildNillableAttribute() creates the attribute when the 
     * current element is the "element" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $bool   The expected value for the boolean.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidBooleanTypeValues
     */
    public function testBuildNillableAttributeCreatesAttrWhenElementAndValueIsValid(
        string $value, 
        bool $bool
    ): void
    {
        $this->sut->buildNillableAttribute($value);
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $elt = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyNillableAttribute($elt);
        self::assertSame($bool, $elt->getNillable());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildNillableAttribute() throws an exception when the current 
     * element is the "element" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidBooleanTypeValues
     */
    public function testBuildNillableAttributeThrowsExceptionWhenElementAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is an invalid boolean datatype.', $value));
        
        $this->sut->buildNillableAttribute($value);
    }
    
    /**
     * Tests that buildTypeAttribute() creates the attribute when:
     * - the current element is the "element" element, and 
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
    public function testBuildTypeAttributeCreatesAttrWhenElementAndValueIsValidQNameLocalPartAndNoDefaultNamespace(
        string $value, 
        string $localPart
    ): void
    {
        $this->sut->buildTypeAttribute($value);
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $elt = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyTypeAttribute($elt);
        self::assertSame($localPart, $elt->getType()->getLocalPart()->getNCName());
        self::assertFalse($elt->getType()->hasNamespace());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildTypeAttribute() throws an exception when the current 
     * element is the "element" element and the value is an invalid QName.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidQNameTypeValues
     */
    public function testBuildTypeAttributeThrowsExceptionWhenElementAndValueIsInvalid(
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
     * - the current element is the "element" element, and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is not associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildTypeAttributeThrowsExceptionWhenElementAndValueIsValidAndPrefixNotAssociatedNamespace(): void
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The "foo" prefix is not bound to a namespace.');
        
        $this->sut->buildTypeAttribute('foo:bar');
    }
    
    /**
     * Tests that buildAnnotationElement() creates the element when the 
     * current element is the "element" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAnnotationElementCreateEltWhenElement(): void
    {
        $this->sut->buildAnnotationElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $elt = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasNoAttribute($elt);
        self::assertCount(1, $elt->getElements());
        
        $ann = $elt->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Tests that buildSimpleTypeElement() creates the element when the 
     * current element is the "element" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildSimpleTypeElementCreateEltWhenElement(): void
    {
        $this->sut->buildSimpleTypeElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $elt = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasNoAttribute($elt);
        self::assertCount(1, $elt->getElements());
        
        $st = $elt->getTypeElement();
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertSame([], $st->getElements());
    }
    
    /**
     * Tests that buildComplexTypeElement() creates the element when the 
     * current element is the "element" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildComplexTypeElementCreateEltWhenElement(): void
    {
        $this->sut->buildComplexTypeElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $elt = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasNoAttribute($elt);
        self::assertCount(1, $elt->getElements());
        
        $ct = $elt->getTypeElement();
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertSame([], $ct->getElements());
    }
    
    /**
     * Tests that buildUniqueElement() creates the element when the current 
     * element is the "element" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildUniqueElementCreateEltWhenElement(): void
    {
        $this->sut->buildUniqueElement();
        $this->sut->endElement();
        $this->sut->buildUniqueElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $elt = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasNoAttribute($elt);
        self::assertCount(2, $elt->getElements());
        
        $uniques = $elt->getUniqueElements();
        
        self::assertElementNamespaceDeclarations([], $uniques[0]);
        self::assertUniqueElementHasNoAttribute($uniques[0]);
        self::assertSame([], $uniques[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $uniques[1]);
        self::assertUniqueElementHasNoAttribute($uniques[1]);
        self::assertSame([], $uniques[1]->getElements());
    }
    
    /**
     * Tests that buildKeyElement() creates the element when the current 
     * element is the "element" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildKeyElementCreateEltWhenElement(): void
    {
        $this->sut->buildKeyElement();
        $this->sut->endElement();
        $this->sut->buildKeyElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $elt = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasNoAttribute($elt);
        self::assertCount(2, $elt->getElements());
        
        $keys = $elt->getKeyElements();
        
        self::assertElementNamespaceDeclarations([], $keys[0]);
        self::assertKeyElementHasNoAttribute($keys[0]);
        self::assertSame([], $keys[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $keys[1]);
        self::assertKeyElementHasNoAttribute($keys[1]);
        self::assertSame([], $keys[1]->getElements());
    }
    
    /**
     * Tests that buildKeyRefElement() creates the element when the current 
     * element is the "element" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildKeyRefElementCreateEltWhenElement(): void
    {
        $this->sut->buildKeyRefElement();
        $this->sut->endElement();
        $this->sut->buildKeyRefElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $elt = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasNoAttribute($elt);
        self::assertCount(2, $elt->getElements());
        
        $keyRefs = $elt->getKeyRefElements();
        
        self::assertElementNamespaceDeclarations([], $keyRefs[0]);
        self::assertKeyRefElementHasNoAttribute($keyRefs[0]);
        self::assertSame([], $keyRefs[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $keyRefs[1]);
        self::assertKeyRefElementHasNoAttribute($keyRefs[1]);
        self::assertSame([], $keyRefs[1]->getElements());
    }
}
