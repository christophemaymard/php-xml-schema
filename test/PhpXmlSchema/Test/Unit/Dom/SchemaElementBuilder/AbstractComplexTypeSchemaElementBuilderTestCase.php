<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Exception\InvalidValueException;
use PhpXmlSchema\Test\Unit\Datatype\BooleanTypeProviderTrait;
use PhpXmlSchema\Test\Unit\Datatype\NCNameTypeProviderTrait;

/**
 * Represents the base class to unit test the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "complexType" element.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractComplexTypeSchemaElementBuilderTestCase extends AbstractSchemaElementBuilderTestCase
{
    use BooleanTypeProviderTrait;
    use NCNameTypeProviderTrait;
    
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
    use BuildFormAttributeDoesNotCreateAttributeTestTrait;
    use BuildRefAttributeDoesNotCreateAttributeTestTrait;
    use BuildUseAttributeDoesNotCreateAttributeTestTrait;
    use BuildProcessContentsAttributeDoesNotCreateAttributeTestTrait;
    use BuildComplexTypeElementDoesNotCreateElementTestTrait;
    use BuildExtensionElementDoesNotCreateElementTestTrait;
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
        static::assertAncestorsNotChanged($sch);
        
        $ct = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertSame([], $ct->getElements());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertCurrentElementHasNotAttribute(SchemaElement $sch): void
    {
        self::assertComplexTypeElementHasNoAttribute(static::getCurrentElement($sch));
    }
    
    /**
     * Tests that buildIdAttribute() creates the attribute when the current 
     * element is the "complexType" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNCNameTypeWSValues
     */
    public function testBuildIdAttributeCreatesAttrWhenComplexTypeAndValueIsValid(
        string $value, 
        string $id
    ): void
    {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $ct = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasOnlyIdAttribute($ct);
        self::assertSame($id, $ct->getId()->getId());
        self::assertSame([], $ct->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the current 
     * element is the "complexType" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $mValue The string representation of the value in the exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNCNameTypeWSValues
     */
    public function testBuildIdAttributeThrowsExceptionWhenComplexTypeAndValueIsInvalid(
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
     * Tests that buildMixedAttribute() creates the attribute when the 
     * current element is the "complexType" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $bool   The expected value for the boolean.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidBooleanTypeValues
     */
    public function testBuildMixedAttributeCreatesAttrWhenComplexTypeAndValueIsValid(
        string $value, 
        bool $bool
    ): void
    {
        $this->sut->buildMixedAttribute($value);
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $ct = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasOnlyMixedAttribute($ct);
        self::assertSame($bool, $ct->getMixed());
        self::assertSame([], $ct->getElements());
    }
    
    /**
     * Tests that buildMixedAttribute() throws an exception when the current 
     * element is the "complexType" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidBooleanTypeValues
     */
    public function testBuildMixedAttributeThrowsExceptionWhenComplexTypeAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is an invalid boolean datatype.', $value));
        
        $this->sut->buildMixedAttribute($value);
    }
    
    /**
     * Tests that buildAnnotationElement() creates the element when the 
     * current element is the "complexType" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAnnotationElementCreateEltWhenComplexType(): void
    {
        $this->sut->buildAnnotationElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $ct = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $ann = $ct->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Tests that buildSimpleContentElement() creates the element when the 
     * current element is the "complexType" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildSimpleContentElementCreateEltWhenComplexType(): void
    {
        $this->sut->buildSimpleContentElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $ct = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertSame([], $sc->getElements());
    }
    
    /**
     * Tests that buildComplexContentElement() creates the element when the 
     * current element is the "complexType" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildComplexContentElementCreateEltWhenComplexType(): void
    {
        $this->sut->buildComplexContentElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $ct = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $cc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $cc);
        self::assertComplexContentElementHasNoAttribute($cc);
        self::assertSame([], $cc->getElements());
    }
    
    /**
     * Tests that buildGroupElement() creates the element when the current 
     * element is the "complexType" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildGroupElementCreateEltWhenComplexType(): void
    {
        $this->sut->buildGroupElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $ct = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $grp = $ct->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $grp);
        self::assertGroupElementHasNoAttribute($grp);
        self::assertSame([], $grp->getElements());
    }
    
    /**
     * Tests that buildAllElement() creates the element when the current 
     * element is the "complexType" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAllElementCreateEltWhenComplexType(): void
    {
        $this->sut->buildAllElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $ct = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $all = $ct->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasNoAttribute($all);
        self::assertSame([], $all->getElements());
    }
    
    /**
     * Tests that buildChoiceElement() creates the element when the current 
     * element is the "complexType" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildChoiceElementCreateEltWhenComplexType(): void
    {
        $this->sut->buildChoiceElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $ct = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $choice = $ct->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasNoAttribute($choice);
        self::assertSame([], $choice->getElements());
    }
    
    /**
     * Tests that buildSequenceElement() creates the element when the current 
     * element is the "complexType" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildSequenceElementCreateEltWhenComplexType(): void
    {
        $this->sut->buildSequenceElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $ct = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $seq = $ct->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasNoAttribute($seq);
        self::assertSame([], $seq->getElements());
    }
    
    /**
     * Tests that buildAttributeElement() creates the element when the 
     * current element is the "complexType" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAttributeElementCreateEltWhenComplexType(): void
    {
        $this->sut->buildAttributeElement();
        $this->sut->endElement();
        $this->sut->buildAttributeElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $ct = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(2, $ct->getElements());
        
        $attrs = $ct->getAttributeElements();
        
        self::assertElementNamespaceDeclarations([], $attrs[0]);
        self::assertAttributeElementHasNoAttribute($attrs[0]);
        self::assertSame([], $attrs[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $attrs[1]);
        self::assertAttributeElementHasNoAttribute($attrs[1]);
        self::assertSame([], $attrs[1]->getElements());
    }
    
    /**
     * Tests that buildAttributeGroupElement() creates the element when the 
     * current element is the "complexType" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAttributeGroupElementCreateEltWhenComplexType(): void
    {
        $this->sut->buildAttributeGroupElement();
        $this->sut->endElement();
        $this->sut->buildAttributeGroupElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $ct = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(2, $ct->getElements());
        
        $ags = $ct->getAttributeGroupElements();
        
        self::assertElementNamespaceDeclarations([], $ags[0]);
        self::assertAttributeGroupElementHasNoAttribute($ags[0]);
        self::assertSame([], $ags[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $ags[1]);
        self::assertAttributeGroupElementHasNoAttribute($ags[1]);
        self::assertSame([], $ags[1]->getElements());
    }
    
    /**
     * Tests that buildAnyAttributeElement() creates the element when the 
     * current element is the "complexType" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAnyAttributeElementCreateEltWhenComplexType(): void
    {
        $this->sut->buildAnyAttributeElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $ct = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $anyAttr = $ct->getAnyAttributeElement();
        self::assertElementNamespaceDeclarations([], $anyAttr);
        self::assertAnyAttributeElementHasNoAttribute($anyAttr);
        self::assertSame([], $anyAttr->getElements());
    }
}
