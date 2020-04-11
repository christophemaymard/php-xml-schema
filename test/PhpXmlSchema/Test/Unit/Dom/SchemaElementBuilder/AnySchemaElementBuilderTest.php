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
use PhpXmlSchema\Exception\InvalidValueException;
use PhpXmlSchema\Test\Unit\Datatype\NCNameTypeProviderTrait;
use PhpXmlSchema\Test\Unit\Datatype\NonNegativeIntegerTypeProviderTrait;
use PhpXmlSchema\Test\Unit\Dom\NamespaceListTypeProviderTrait;
use PhpXmlSchema\Test\Unit\Dom\NonNegativeIntegerLimitTypeProviderTrait;
use PhpXmlSchema\Test\Unit\Dom\ProcessingModeTypeProviderTrait;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "any" element.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AnySchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
{
    use NamespaceListTypeProviderTrait;
    use NCNameTypeProviderTrait;
    use NonNegativeIntegerLimitTypeProviderTrait;
    use NonNegativeIntegerTypeProviderTrait;
    use ProcessingModeTypeProviderTrait;
    
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
        
        $any = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $any);
        self::assertAnyElementHasNoAttribute($any);
        self::assertSame([], $any->getElements());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch): void
    {
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct1 = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct1);
        self::assertComplexTypeElementHasNoAttribute($ct1);
        self::assertCount(1, $ct1->getElements());
        
        $cc = $ct1->getContentElement();
        self::assertElementNamespaceDeclarations([], $cc);
        self::assertComplexContentElementHasNoAttribute($cc);
        self::assertCount(1, $cc->getElements());
        
        $res = $cc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertComplexContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $all = $res->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasNoAttribute($all);
        self::assertCount(1, $all->getElements());
        
        $elt = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasNoAttribute($elt);
        self::assertCount(1, $elt->getElements());
        
        $ct2 = $elt->getTypeElement();
        self::assertElementNamespaceDeclarations([], $ct2);
        self::assertComplexTypeElementHasNoAttribute($ct2);
        self::assertCount(1, $ct2->getElements());
        
        $choice = $ct2->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasNoAttribute($choice);
        self::assertCount(1, $choice->getElements());
        
        $seq = $choice->getSequenceElements()[0];
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasNoAttribute($seq);
        self::assertCount(1, $seq->getElements());
        self::assertCount(1, $seq->getAnyElements());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertCurrentElementHasNotAttribute(SchemaElement $sch): void
    {
        self::assertAnyElementHasNoAttribute(self::getCurrentElement($sch));
    }
    
    /**
     * {@inheritDoc}
     */
    protected static function getCurrentElement(SchemaElement $sch): ?ElementInterface
    {
        return $sch->getComplexTypeElements()[0]
            ->getContentElement()
            ->getDerivationElement()
            ->getTypeDefinitionParticleElement()
            ->getElementElements()[0]
            ->getTypeElement()
            ->getTypeDefinitionParticleElement()
            ->getSequenceElements()[0]
            ->getAnyElements()[0];
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildComplexTypeElement();
        $this->sut->buildComplexContentElement();
        $this->sut->buildRestrictionElement();
        $this->sut->buildAllElement();
        $this->sut->buildElementElement();
        $this->sut->buildComplexTypeElement();
        $this->sut->buildChoiceElement();
        $this->sut->buildSequenceElement();
        $this->sut->buildAnyElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown(): void
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that buildIdAttribute() creates the attribute when the current 
     * element is the "any" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNCNameTypeWSValues
     */
    public function testBuildIdAttributeCreatesAttrWhenAnyAndValueIsValid(
        string $value, 
        string $id
    ): void
    {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $any = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $any);
        self::assertAnyElementHasOnlyIdAttribute($any);
        self::assertSame($id, $any->getId()->getId());
        self::assertSame([], $any->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the current 
     * element is the "any" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $mValue The string representation of the value in the exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNCNameTypeWSValues
     */
    public function testBuildIdAttributeThrowsExceptionWhenAnyAndValueIsInvalid(
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
     * Tests that buildMaxOccursAttribute() creates the attribute when the 
     * current element is the "any" element and the value is "unbounded".
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildMaxOccursAttributeCreatesAttrWhenAnyAndValueIsUnbounded(): void
    {
        $this->sut->buildMaxOccursAttribute('unbounded');
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $any = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $any);
        self::assertAnyElementHasOnlyMaxOccursAttribute($any);
        self::assertTrue($any->getMaxOccurs()->isUnlimited());
        self::assertSame([], $any->getElements());
    }
    
    /**
     * Tests that buildMaxOccursAttribute() creates the attribute when the 
     * current element is the "any" element and the value is a valid 
     * non-negative integer.
     * 
     * @param   string  $value  The value to test.
     * @param   \GMP    $nni    The expected value for the non-negative integer.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNonNegativeIntegerTypeValues
     */
    public function testBuildMaxOccursAttributeCreatesAttrWhenAnyAndValueIsNonNegativeInteger(
        string $value, 
        \GMP $nni
    ): void
    {
        $this->sut->buildMaxOccursAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $any = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $any);
        self::assertAnyElementHasOnlyMaxOccursAttribute($any);
        self::assertEquals($nni, $any->getMaxOccurs()->getLimit()->getNonNegativeInteger());
        self::assertSame([], $any->getElements());
    }
    
    /**
     * Tests that buildMaxOccursAttribute() throws an exception when the 
     * current element is the "any" element and the value is invalid.
     * 
     * @param   string  $value      The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNonNegativeIntegerLimitTypeValues
     * @dataProvider    getInvalidNonNegativeIntegerTypeValues
     */
    public function testBuildMaxOccursAttributeThrowsExceptionWhenAnyAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is an invalid non-negative integer limit type.', $value));
        
        $this->sut->buildMaxOccursAttribute($value);
    }
    
    /**
     * Tests that buildMinOccursAttribute() creates the attribute when the 
     * current element is the "any" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   \GMP    $nni    The expected value for the non-negative integer.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNonNegativeIntegerTypeValues
     */
    public function testBuildMinOccursAttributeCreatesAttrWhenAnyAndValueIsValid(
        string $value, 
        \GMP $nni
    ): void
    {
        $this->sut->buildMinOccursAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $any = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $any);
        self::assertAnyElementHasOnlyMinOccursAttribute($any);
        self::assertEquals($nni, $any->getMinOccurs()->getNonNegativeInteger());
        self::assertSame([], $any->getElements());
    }
    
    /**
     * Tests that buildMinOccursAttribute() throws an exception when the 
     * current element is the "any" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNonNegativeIntegerTypeValues
     */
    public function testBuildMinOccursAttributeThrowsExceptionWhenAnyAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid nonNegativeInteger datatype.', 
            $value
        ));
        
        $this->sut->buildMinOccursAttribute($value);
    }
    
    /**
     * Tests that buildNamespaceAttribute() creates the attribute when the 
     * current element is the "any" element and the value is valid.
     * 
     * @param   string      $value      The value to test.
     * @param   bool        $any        The expected value for the "any" flag.
     * @param   bool        $other      The expected value for the "other" flag.
     * @param   bool        $targetNs   The expected value for the "targetNamespace" flag.
     * @param   bool        $local      The expected value for the "local" flag.
     * @param   string[]    $uris       The expected value for the anyURIs.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNamespaceListTypeValues
     */
    public function testBuildNamespaceAttributeCreatesAttrWhenAnyAndValueIsValid(
        string $value, 
        bool $any, 
        bool $other, 
        bool $targetNs, 
        bool $local, 
        array $uris
    ): void
    {
        $this->sut->buildNamespaceAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $anyElt = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $anyElt);
        self::assertAnyElementHasOnlyNamespaceAttribute($anyElt);
        self::assertAnyElementNamespaceAttribute(
            $any, 
            $other, 
            $targetNs, 
            $local, 
            $uris, 
            $anyElt
        );
        self::assertSame([], $anyElt->getElements());
    }
    
    /**
     * Tests that buildNamespaceAttribute() throws an exception when the 
     * current element is the "any" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNamespaceListTypeValues
     */
    public function testBuildNamespaceAttributeThrowsExceptionWhenAnyAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is an invalid namespace list.', $value));
        
        $this->sut->buildNamespaceAttribute($value);
    }
    
    /**
     * Tests that buildProcessContentsAttribute() creates the attribute when 
     * the current element is the "any" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $lax    The expected value for the "lax" flag.
     * @param   bool    $skip   The expected value for the "skip" flag.
     * @param   bool    $strict The expected value for the "strict" flag.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidProcessingModeTypeValues
     */
    public function testBuildProcessContentsAttributeCreatesAttrWhenAnyAndValueIsValid(
        string $value, 
        bool $lax, 
        bool $skip, 
        bool $strict
    ): void
    {
        $this->sut->buildProcessContentsAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $any = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $any);
        self::assertAnyElementHasOnlyProcessContentsAttribute($any);
        self::assertSame($lax, $any->getProcessContents()->isLax());
        self::assertSame($skip, $any->getProcessContents()->isSkip());
        self::assertSame($strict, $any->getProcessContents()->isStrict());
        self::assertSame([], $any->getElements());
    }
    
    /**
     * Tests that buildProcessContentsAttribute() throws an exception when 
     * the current element is the "any" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidProcessingModeTypeValues
     */
    public function testBuildProcessContentsAttributeThrowsExceptionWhenAnyAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid mode of content processing, expected "lax", '.
            '"skip" or "strict".', 
            $value
        ));
        
        $this->sut->buildProcessContentsAttribute($value);
    }
    
    /**
     * Tests that buildAnnotationElement() creates the element when the 
     * current element is the "any" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAnnotationElementCreateEltWhenAny(): void
    {
        $this->sut->buildAnnotationElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $any = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $any);
        self::assertAnyElementHasNoAttribute($any);
        self::assertCount(1, $any->getElements());
        
        $ann = $any->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
}
