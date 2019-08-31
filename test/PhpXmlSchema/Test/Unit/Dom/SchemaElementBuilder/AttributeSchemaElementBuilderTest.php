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
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "attribute" element (attribute).
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AttributeSchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
{
    use BindNamespaceTestTrait;
    
    use BuildAttributeFormDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildBlockDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildElementFormDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildFinalDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildIdAttributeDoesNotCreateAttributeTestTrait;
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
    use BuildAnnotationElementDoesNotCreateElementTestTrait;
    use BuildIncludeElementDoesNotCreateElementTestTrait;
    use BuildNotationElementDoesNotCreateElementTestTrait;
    use BuildNameAttributeDoesNotCreateAttributeTestTrait;
    use BuildPublicAttributeDoesNotCreateAttributeTestTrait;
    use BuildSystemNamespaceAttributeDoesNotCreateAttributeTestTrait;
    use BuildDefinitionAnnotationElementDoesNotCreateElementTestTrait;
    use BuildAttributeElementDoesNotCreateElementTestTrait;
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
        
        $ag = $sch->getAttributeGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $ag);
        self::assertAttributeGroupElementHasNoAttribute($ag);
        self::assertCount(1, $ag->getElements());
        self::assertCount(1, $ag->getAttributeElements());
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
        return $sch->getAttributeGroupElements()[0]
            ->getAttributeElements()[0];
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildAttributeGroupElement();
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
     * current element is the "attribute" element (attribute) and the value 
     * is valid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidStringValues
     */
    public function testBuildDefaultAttributeCreatesAttrWhenAttributeAndValueIsValid(
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
     * current element is the "attribute" element (attribute) and the value 
     * is invalid.
     * 
     * @param   string  $value      The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidStringValues
     */
    public function testBuildDefaultAttributeThrowsExceptionWhenAttributeAndValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('"'.$value.'" is an invalid string.');
        
        $this->sut->buildDefaultAttribute($value);
    }
    
    /**
     * Tests that buildFixedAttribute() creates the attribute when the 
     * current element is the "attribute" element (attribute) and the value 
     * is valid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidStringValues
     */
    public function testBuildFixedAttributeCreatesAttrWhenAttributeAndValueIsValid(
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
     * current element is the "attribute" element (attribute) and the value 
     * is invalid.
     * 
     * @param   string  $value      The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidStringValues
     */
    public function testBuildFixedAttributeThrowsExceptionWhenAttributeAndValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('"'.$value.'" is an invalid string.');
        
        $this->sut->buildFixedAttribute($value);
    }
}
