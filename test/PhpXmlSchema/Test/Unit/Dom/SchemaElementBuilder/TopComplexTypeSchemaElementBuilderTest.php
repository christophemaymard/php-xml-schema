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
 * class when the current element is the "complexType" element 
 * (topLevelComplexType).
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TopComplexTypeSchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
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
    use BuildAnnotationElementDoesNotCreateElementTestTrait;
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
    use BuildAttributeGroupElementDoesNotCreateElementTestTrait;
    use BuildFormAttributeDoesNotCreateAttributeTestTrait;
    use BuildRefAttributeDoesNotCreateAttributeTestTrait;
    use BuildUseAttributeDoesNotCreateAttributeTestTrait;
    use BuildAnyAttributeElementDoesNotCreateElementTestTrait;
    use BuildProcessContentsAttributeDoesNotCreateAttributeTestTrait;
    use BuildComplexTypeElementDoesNotCreateElementTestTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertSchemaElementNotChanged(SchemaElement $sch)
    {
        self::assertAncestorsNotChanged($sch);
        
        $ct = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertSame([], $ct->getElements());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch)
    {
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        self::assertCount(1, $sch->getComplexTypeElements());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertCurrentElementHasNotAttribute(SchemaElement $sch)
    {
        self::assertComplexTypeElementHasNoAttribute(self::getCurrentElement($sch));
    }
    
    /**
     * {@inheritDoc}
     */
    protected static function getCurrentElement(SchemaElement $sch)
    {
        return $sch->getComplexTypeElements()[0];
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildComplexTypeElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that buildAbstractAttribute() creates the attribute when the 
     * current element is the "complexType" element (topLevelComplexType) and 
     * the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $bool   The expected value for the boolean.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidBooleanValues
     */
    public function testBuildAbstractAttributeCreatesAttrWhenTopComplexTypeAndValueIsValid(
        string $value, 
        bool $bool
    ) {
        $this->sut->buildAbstractAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ct = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasOnlyAbstractAttribute($ct);
        self::assertSame($bool, $ct->getAbstract());
        self::assertSame([], $ct->getElements());
    }
    
    /**
     * Tests that buildAbstractAttribute() throws an exception when the current 
     * element is the "complexType" element (topLevelComplexType) and the 
     * value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidBooleanValues
     */
    public function testBuildAbstractAttributeThrowsExceptionWhenTopComplexTypeAndValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is an invalid boolean datatype.', $value));
        
        $this->sut->buildAbstractAttribute($value);
    }
    
    /**
     * Tests that buildBlockAttribute() creates the attribute when the 
     * current element is the "complexType" element (topLevelComplexType) and 
     * the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $ext    The expected value for the "extension" flag.
     * @param   bool    $res    The expected value for the "restriction" flag.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidDerivationSetValues
     */
    public function testBuildBlockAttributeCreatesAttrWhenTopComplexTypeAndValueIsValid(
        string $value, 
        bool $ext, 
        bool $res
    ) {
        $this->sut->buildBlockAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ct = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasOnlyBlockAttribute($ct);
        self::assertComplexTypeElementBlockAttribute($ext, $res, $ct);
        self::assertSame([], $ct->getElements());
    }
    
    /**
     * Tests that buildBlockAttribute() throws an exception when the 
     * current element is the "complexType" element (topLevelComplexType) and 
     * the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidDerivationSetValues
     */
    public function testBuildBlockAttributeThrowsExceptionWhenTopComplexTypeAndValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            '"'.$value.'" is an invalid value for the "block" '.
            'attribute (from no namespace), expected: "#all" or '.
            '"List of (extension | restriction)".'
        );
        
        $this->sut->buildBlockAttribute($value);
    }
    
    /**
     * Tests that buildFinalAttribute() creates the attribute when the 
     * current element is the "complexType" element (topLevelComplexType) and 
     * the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $ext    The expected value for the "extension" flag.
     * @param   bool    $res    The expected value for the "restriction" flag.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidDerivationSetValues
     */
    public function testBuildFinalAttributeCreatesAttrWhenTopComplexTypeAndValueIsValid(
        string $value, 
        bool $ext, 
        bool $res
    ) {
        $this->sut->buildFinalAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ct = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasOnlyFinalAttribute($ct);
        self::assertComplexTypeElementFinalAttribute($ext, $res, $ct);
        self::assertSame([], $ct->getElements());
    }
    
    /**
     * Tests that buildFinalAttribute() throws an exception when the 
     * current element is the "complexType" element (topLevelComplexType) and 
     * the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidDerivationSetValues
     */
    public function testBuildFinalAttributeThrowsExceptionWhenTopComplexTypeAndValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            '"'.$value.'" is an invalid value for the "final" '.
            'attribute (from no namespace), expected: "#all" or '.
            '"List of (extension | restriction)".'
        );
        
        $this->sut->buildFinalAttribute($value);
    }
    
    /**
     * Tests that buildIdAttribute() creates the attribute when the current 
     * element is the "complexType" element (topLevelComplexType) and the 
     * value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidIdValues
     */
    public function testBuildIdAttributeCreatesAttrWhenTopComplexTypeAndValueIsValid(
        string $value, 
        string $id
    ) {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ct = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasOnlyIdAttribute($ct);
        self::assertSame($id, $ct->getId()->getId());
        self::assertSame([], $ct->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the current 
     * element is the "complexType" element (topLevelComplexType) and the 
     * value is invalid.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidIdValues
     */
    public function testBuildIdAttributeThrowsExceptionWhenTopComplexTypeAndValueIsInvalid(
        string $value, 
        string $message
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildIdAttribute($value);
    }
    
    /**
     * Tests that buildMixedAttribute() creates the attribute when the 
     * current element is the "complexType" element (topLevelComplexType) and 
     * the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $bool   The expected value for the boolean.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidBooleanValues
     */
    public function testBuildMixedAttributeCreatesAttrWhenTopComplexTypeAndValueIsValid(
        string $value, 
        bool $bool
    ) {
        $this->sut->buildMixedAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ct = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasOnlyMixedAttribute($ct);
        self::assertSame($bool, $ct->getMixed());
        self::assertSame([], $ct->getElements());
    }
    
    /**
     * Tests that buildMixedAttribute() throws an exception when the current 
     * element is the "complexType" element (topLevelComplexType) and the 
     * value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidBooleanValues
     */
    public function testBuildMixedAttributeThrowsExceptionWhenTopComplexTypeAndValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is an invalid boolean datatype.', $value));
        
        $this->sut->buildMixedAttribute($value);
    }
}
