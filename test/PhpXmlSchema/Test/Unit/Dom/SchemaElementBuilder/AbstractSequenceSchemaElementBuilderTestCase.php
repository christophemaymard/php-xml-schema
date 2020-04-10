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
use PhpXmlSchema\Test\Unit\Datatype\NCNameTypeProviderTrait;

/**
 * Represents the base class to unit test the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "sequence" element.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractSequenceSchemaElementBuilderTestCase extends AbstractSchemaElementBuilderTestCase
{
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
    use BuildAllElementDoesNotCreateElementTestTrait;
    use BuildNillableAttributeDoesNotCreateAttributeTestTrait;
    use BuildUniqueElementDoesNotCreateElementTestTrait;
    use BuildSelectorElementDoesNotCreateElementTestTrait;
    use BuildFieldElementDoesNotCreateElementTestTrait;
    use BuildXPathAttributeDoesNotCreateAttributeTestTrait;
    use BuildKeyElementDoesNotCreateElementTestTrait;
    use BuildKeyRefElementDoesNotCreateElementTestTrait;
    use BuildReferAttributeDoesNotCreateAttributeTestTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertSchemaElementNotChanged(SchemaElement $sch)
    {
        static::assertAncestorsNotChanged($sch);
        
        $seq = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasNoAttribute($seq);
        self::assertSame([], $seq->getElements());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertCurrentElementHasNotAttribute(SchemaElement $sch)
    {
        self::assertSequenceElementHasNoAttribute(static::getCurrentElement($sch));
    }
    
    /**
     * Tests that buildIdAttribute() creates the attribute when the current 
     * element is the "sequence" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNCNameTypeWSValues
     */
    public function testBuildIdAttributeCreatesAttrWhenSequenceAndValueIsValid(
        string $value, 
        string $id
    ) {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $seq = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasOnlyIdAttribute($seq);
        self::assertSame($id, $seq->getId()->getId());
        self::assertSame([], $seq->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the current 
     * element is the "sequence" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $mValue The string representation of the value in the exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNCNameTypeWSValues
     */
    public function testBuildIdAttributeThrowsExceptionWhenSequenceAndValueIsInvalid(
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
     * Tests that buildAnnotationElement() creates the element when the 
     * current element is the "sequence" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAnnotationElementCreateEltWhenSequence()
    {
        $this->sut->buildAnnotationElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $seq = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasNoAttribute($seq);
        self::assertCount(1, $seq->getElements());
        
        $ann = $seq->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Tests that buildElementElement() creates the element when the current 
     * element is the "sequence" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildElementElementCreateEltWhenSequence()
    {
        $this->sut->buildElementElement();
        $this->sut->endElement();
        $this->sut->buildElementElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $seq = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasNoAttribute($seq);
        self::assertCount(2, $seq->getElements());
        
        $elts = $seq->getElementElements();
        
        self::assertElementNamespaceDeclarations([], $elts[0]);
        self::assertElementElementHasNoAttribute($elts[0]);
        self::assertSame([], $elts[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $elts[1]);
        self::assertElementElementHasNoAttribute($elts[1]);
        self::assertSame([], $elts[1]->getElements());
    }
    
    /**
     * Tests that buildGroupElement() creates the element when the current 
     * element is the "sequence" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildGroupElementCreateEltWhenSequence()
    {
        $this->sut->buildGroupElement();
        $this->sut->endElement();
        $this->sut->buildGroupElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $seq = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasNoAttribute($seq);
        self::assertCount(2, $seq->getElements());
        
        $grps = $seq->getGroupElements();
        
        self::assertElementNamespaceDeclarations([], $grps[0]);
        self::assertGroupElementHasNoAttribute($grps[0]);
        self::assertSame([], $grps[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $grps[1]);
        self::assertGroupElementHasNoAttribute($grps[1]);
        self::assertSame([], $grps[1]->getElements());
    }
    
    /**
     * Tests that buildChoiceElement() creates the element when the current 
     * element is the "sequence" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildChoiceElementCreateEltWhenSequence()
    {
        $this->sut->buildChoiceElement();
        $this->sut->endElement();
        $this->sut->buildChoiceElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $seq = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasNoAttribute($seq);
        self::assertCount(2, $seq->getElements());
        
        $choices = $seq->getChoiceElements();
        
        self::assertElementNamespaceDeclarations([], $choices[0]);
        self::assertChoiceElementHasNoAttribute($choices[0]);
        self::assertSame([], $choices[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $choices[1]);
        self::assertChoiceElementHasNoAttribute($choices[1]);
        self::assertSame([], $choices[1]->getElements());
    }
    
    /**
     * Tests that buildSequenceElement() creates the element when the current 
     * element is the "sequence" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildSequenceElementCreateEltWhenSequence()
    {
        $this->sut->buildSequenceElement();
        $this->sut->endElement();
        $this->sut->buildSequenceElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $seq = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasNoAttribute($seq);
        self::assertCount(2, $seq->getElements());
        
        $seqs = $seq->getSequenceElements();
        
        self::assertElementNamespaceDeclarations([], $seqs[0]);
        self::assertSequenceElementHasNoAttribute($seqs[0]);
        self::assertSame([], $seqs[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $seqs[1]);
        self::assertSequenceElementHasNoAttribute($seqs[1]);
        self::assertSame([], $seqs[1]->getElements());
    }
    
    /**
     * Tests that buildAnyElement() creates the element when the current 
     * element is the "sequence" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAnyElementCreateEltWhenSequence()
    {
        $this->sut->buildAnyElement();
        $this->sut->endElement();
        $this->sut->buildAnyElement();
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        
        $seq = static::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasNoAttribute($seq);
        self::assertCount(2, $seq->getElements());
        
        $anys = $seq->getAnyElements();
        
        self::assertElementNamespaceDeclarations([], $anys[0]);
        self::assertAnyElementHasNoAttribute($anys[0]);
        self::assertSame([], $anys[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $anys[1]);
        self::assertAnyElementHasNoAttribute($anys[1]);
        self::assertSame([], $anys[1]->getElements());
    }
}
