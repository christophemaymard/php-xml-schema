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
use PhpXmlSchema\Test\Datatype\AnyUriTypeProviderTrait;
use PhpXmlSchema\Test\Datatype\LanguageTypeProviderTrait;
use PhpXmlSchema\Test\Datatype\NCNameTypeProviderTrait;
use PhpXmlSchema\Test\Datatype\TokenTypeProviderTrait;
use PhpXmlSchema\Test\Dom\DerivationTypeProviderTrait;
use PhpXmlSchema\Test\Dom\FormChoiceTypeProviderTrait;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "schema" element.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SchemaSchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
{
    use AnyUriTypeProviderTrait;
    use DerivationTypeProviderTrait;
    use FormChoiceTypeProviderTrait;
    use LanguageTypeProviderTrait;
    use NCNameTypeProviderTrait;
    use TokenTypeProviderTrait;
    
    use BindNamespaceTestTrait;
    
    use BuildAppInfoElementDoesNotCreateElementTestTrait;
    use BuildSourceAttributeDoesNotCreateAttributeTestTrait;
    use BuildLeafElementContentDoesNotCreateContentTestTrait;
    use BuildDocumentationElementDoesNotCreateElementTestTrait;
    use BuildNamespaceAttributeDoesNotCreateAttributeTestTrait;
    use BuildSchemaLocationAttributeDoesNotCreateAttributeTestTrait;
    use BuildAnnotationElementDoesNotCreateElementTestTrait;
    use BuildNameAttributeDoesNotCreateAttributeTestTrait;
    use BuildPublicAttributeDoesNotCreateAttributeTestTrait;
    use BuildSystemNamespaceAttributeDoesNotCreateAttributeTestTrait;
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
    use BuildMemberTypesAttributeDoesNotCreateAttributeTestTrait;
    use BuildFinalAttributeDoesNotCreateAttributeTestTrait;
    use BuildFormAttributeDoesNotCreateAttributeTestTrait;
    use BuildRefAttributeDoesNotCreateAttributeTestTrait;
    use BuildUseAttributeDoesNotCreateAttributeTestTrait;
    use BuildAnyAttributeElementDoesNotCreateElementTestTrait;
    use BuildProcessContentsAttributeDoesNotCreateAttributeTestTrait;
    use BuildAbstractAttributeDoesNotCreateAttributeTestTrait;
    use BuildBlockAttributeDoesNotCreateAttributeTestTrait;
    use BuildMixedAttributeDoesNotCreateAttributeTestTrait;
    use BuildSimpleContentElementDoesNotCreateElementTestTrait;
    use BuildExtensionElementDoesNotCreateElementTestTrait;
    use BuildComplexContentElementDoesNotCreateElementTestTrait;
    use BuildMaxOccursAttributeDoesNotCreateAttributeTestTrait;
    use BuildMinOccursAttributeDoesNotCreateAttributeTestTrait;
    use BuildAllElementDoesNotCreateElementTestTrait;
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
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch): void
    {
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertCurrentElementHasNotAttribute(SchemaElement $sch): void
    {
        self::assertSchemaElementHasNoAttribute(self::getCurrentElement($sch));
    }
    
    /**
     * {@inheritDoc}
     */
    protected static function getCurrentElement(SchemaElement $sch): ?ElementInterface
    {
        return $sch;
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new SchemaElementBuilder();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown(): void
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that getSchema() returns the same instance of SchemaElement when 
     * instantiated.
     */
    public function testGetSchemaReturnsSameInstanceOfEmptySchemaElementWhenInstantiated(): void
    {
        $sch1 = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch1);
        self::assertSchemaElementHasNoAttribute($sch1);
        self::assertSame([], $sch1->getElements());
        $sch2 = $this->sut->getSchema();
        self::assertSame($sch1, $sch2, 'Same instance of SchemaElement.');
    }
    
    /**
     * Tests that buildSchemaElement() creates an empty "schema" element and 
     * replaces the current one that is being built.
     */
    public function testBuildSchemaElementCreateNewInstanceOfEmptySchemaElement(): void
    {
        $sch1 = $this->sut->getSchema();
        $this->sut->buildSchemaElement();
        $sch2 = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch2);
        self::assertSchemaElementHasNoAttribute($sch2);
        self::assertSame([], $sch2->getElements());
        self::assertNotSame($sch2, $sch1, 'Not same instance of SchemaElement.');
    }
    
    /**
     * Tests that buildAttributeFormDefaultAttribute() creates the attribute 
     * when the current element is the "schema" element and the value is 
     * valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $qual   The expected value for the "qualified flag.
     * @param   bool    $unqual The expected value for the "unqualified flag.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidFormChoiceTypeValues
     */
    public function testBuildAttributeFormDefaultAttributeCreatesAttrWhenSchemaAndValueIsValid(
        string $value, 
        bool $qual, 
        bool $unqual
    ): void
    {
        $this->sut->buildAttributeFormDefaultAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasOnlyAttributeFormDefaultAttribute($sch);
        self::assertSame($qual, $sch->getAttributeFormDefault()->isQualified());
        self::assertSame($unqual, $sch->getAttributeFormDefault()->isUnqualified());
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildAttributeFormDefaultAttribute() throws an exception 
     * when the current element is the "schema" element and the value is 
     * invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidFormChoiceTypeValues
     */
    public function testBuildAttributeFormDefaultAttributeThrowsExceptionWhenSchemaAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            '"'.$value.'" is an invalid formChoice type, expected "qualified" or "unqualified".'
        );
        $this->sut->buildAttributeFormDefaultAttribute($value);
    }
    
    /**
     * Tests that buildBlockDefaultAttribute() creates the attribute when the 
     * current element is the "schema" element and the value is valid.
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
    public function testBuildBlockDefaultAttributeCreatesAttrWhenSchemaAndValueIsValid(
        string $value, 
        bool $res, 
        bool $ext, 
        bool $sub
    ): void
    {
        $this->sut->buildBlockDefaultAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasOnlyBlockDefaultAttribute($sch);
        self::assertSchemaElementBlockDefaultAttribute($res, $ext, $sub, $sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildBlockDefaultAttribute() throws an exception when the 
     * current element is the "schema" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidBlockSetTypeValues
     */
    public function testBuildBlockDefaultAttributeThrowsExceptionWhenSchemaAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid blockSet type, expected "#all" or a list of '.
            '"extension", "restriction" and/or "substitution".', 
            $value
        ));
        
        $this->sut->buildBlockDefaultAttribute($value);
    }
    
    /**
     * Tests that buildElementFormDefaultAttribute() creates the attribute 
     * when the current element is the "schema" element and the value is 
     * valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $qual   The expected value for the "qualified flag.
     * @param   bool    $unqual The expected value for the "unqualified flag.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidFormChoiceTypeValues
     */
    public function testBuildElementFormDefaultAttributeCreatesAttrWhenSchemaAndValueIsValid(
        string $value, 
        bool $qual, 
        bool $unqual
    ): void
    {
        $this->sut->buildElementFormDefaultAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasOnlyElementFormDefaultAttribute($sch);
        self::assertSame($qual, $sch->getElementFormDefault()->isQualified());
        self::assertSame($unqual, $sch->getElementFormDefault()->isUnqualified());
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildElementFormDefaultAttribute() throws an exception when 
     * the current element is the "schema" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidFormChoiceTypeValues
     */
    public function testBuildElementFormDefaultAttributeThrowsExceptionWhenSchemaAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            '"'.$value.'" is an invalid formChoice type, expected "qualified" or "unqualified".'
        );
        
        $this->sut->buildElementFormDefaultAttribute($value);
    }
    
    /**
     * Tests that buildFinalDefaultAttribute() creates the attribute when the 
     * current element is the "schema" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $ext    The expected value for the "extension" flag.
     * @param   bool    $res    The expected value for the "restriction" flag.
     * @param   bool    $lst    The expected value for the "list" flag.
     * @param   bool    $unn    The expected value for the "union" flag.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidFullDerivationSetTypeValues
     */
    public function testBuildFinalDefaultAttributeCreatesAttrWhenSchemaAndValueIsValid(
        string $value,
        bool $ext, 
        bool $res, 
        bool $lst, 
        bool $unn
    ): void
    {
        $this->sut->buildFinalDefaultAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasOnlyFinalDefaultAttribute($sch);
        self::assertSchemaElementFinalDefaultAttribute($ext, $res, $lst, $unn, $sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildFinalDefaultAttribute() throws an exception when the 
     * current element is the "schema" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidFullDerivationSetTypeValues
     */
    public function testBuildFinalDefaultAttributeThrowsExceptionWhenSchemaAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid fullDerivationSet type, expected "#all" or '.
            'a list of "extension", "restriction", "list" and/or "union".', 
            $value
        ));
        
        $this->sut->buildFinalDefaultAttribute($value);
    }
    
    /**
     * Tests that buildIdAttribute() creates the attribute when the current 
     * element is the "schema" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNCNameTypeWSValues
     */
    public function testBuildIdAttributeCreatesAttrWhenSchemaAndValueIsValid(
        string $value, 
        string $id
    ): void
    {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasOnlyIdAttribute($sch);
        self::assertSame($id, $sch->getId()->getId());
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the current 
     * element is the "schema" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $mValue The string representation of the value in the exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNCNameTypeWSValues
     */
    public function testBuildIdAttributeThrowsExceptionWhenSchemaAndValueIsInvalid(
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
     * Tests that buildTargetNamespaceAttribute() creates the attribute when 
     * the current element is the "schema" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $uri    The expected value for the URI.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidAnyUriTypeValues
     * @dataProvider    getValidAnyUriTypeWSValues
     */
    public function testBuildTargetNamespaceAttributeCreatesAttrWhenSchemaAndValueIsValid(
        string $value, 
        string $uri
    ): void
    {
        $this->sut->buildTargetNamespaceAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasOnlyTargetNamespaceAttribute($sch);
        self::assertSame($uri, $sch->getTargetNamespace()->getAnyUri());
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildTargetNamespaceAttribute() throws an exception when 
     * the current element is the "schema" element and the value is invalid.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidAnyUriTypeValues
     */
    public function testBuildTargetNamespaceAttributeThrowsExceptionWhenSchemaAndValueIsInvalid(
        string $value, 
        string $message
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildTargetNamespaceAttribute($value);
    }
    
    /**
     * Tests that buildVersionAttribute() creates the attribute when the 
     * current element is the "schema" element and the value is valid.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $version    The expected value for the version.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidTokenTypeWSValues
     */
    public function testBuildVersionAttributeCreatesAttrWhenSchemaAndValueIsValid(
        string $value, 
        string $version
    ): void
    {
        $this->sut->buildVersionAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasOnlyVersionAttribute($sch);
        self::assertSame($version, $sch->getVersion()->getToken());
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildVersionAttribute() throws an exception when the 
     * current element is the "schema" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $mValue The string representation of the value in the exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidTokenTypeWSValues
     */
    public function testBuildVersionAttributeThrowsExceptionWhenSchemaAndValueIsInvalid(
        string $value, 
        string $mValue
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid token datatype.', 
            $mValue
        ));
        
        $this->sut->buildVersionAttribute($value);
    }
    
    /**
     * Tests that buildLangAttribute() creates the attribute when the current 
     * element is the "schema" element and the value is valid.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $version    The expected value for the version.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidLanguageTypeValues
     */
    public function testBuildLangAttributeCreatesAttrWhenSchemaAndValueIsValid(
        string $value, 
        string $primary,
        array $subtags
    ): void
    {
        $this->sut->buildLangAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasOnlyLangAttribute($sch);
        self::assertSame($primary, $sch->getLang()->getPrimarySubtag());
        self::assertSame($subtags, $sch->getLang()->getSubtags());
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildLangAttribute() throws an exception when the current 
     * element is the "schema" element and the value is invalid.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidLanguageTypeValues
     */
    public function testBuildLangAttributeThrowsExceptionWhenSchemaAndValueIsInvalid(
        string $value,
        string $message
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildLangAttribute($value);
    }
    
    /**
     * Tests that buildCompositionAnnotationElement() creates the element 
     * when the current element is the "schema" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildCompositionAnnotationElementCreateEltWhenSchema(): void
    {
        $this->sut->buildCompositionAnnotationElement();
        $this->sut->endElement();
        $this->sut->buildCompositionAnnotationElement();
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $anns = $sch->getCompositionAnnotationElements();
        self::assertCount(2, $anns);
        
        self::assertElementNamespaceDeclarations([], $anns[0]);
        self::assertAnnotationElementHasNoAttribute($anns[0]);
        self::assertSame([], $anns[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $anns[1]);
        self::assertAnnotationElementHasNoAttribute($anns[1]);
        self::assertSame([], $anns[1]->getElements());
    }
    
    /**
     * Tests that buildImportElement() creates the element when the current 
     * element is the "schema" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildImportElementCreateEltWhenSchema(): void
    {
        $this->sut->buildImportElement();
        $this->sut->endElement();
        $this->sut->buildImportElement();
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $imports = $sch->getImportElements();
        self::assertCount(2, $imports);
        
        self::assertElementNamespaceDeclarations([], $imports[0]);
        self::assertImportElementHasNoAttribute($imports[0]);
        self::assertSame([], $imports[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $imports[1]);
        self::assertImportElementHasNoAttribute($imports[1]);
        self::assertSame([], $imports[1]->getElements());
    }
    
    /**
     * Tests that buildIncludeElement() creates the element when the current 
     * element is the "schema" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildIncludeElementCreateEltWhenSchema(): void
    {
        $this->sut->buildIncludeElement();
        $this->sut->endElement();
        $this->sut->buildIncludeElement();
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $incs = $sch->getIncludeElements();
        self::assertCount(2, $incs);
        
        self::assertElementNamespaceDeclarations([], $incs[0]);
        self::assertIncludeElementHasNoAttribute($incs[0]);
        self::assertSame([], $incs[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $incs[1]);
        self::assertIncludeElementHasNoAttribute($incs[1]);
        self::assertSame([], $incs[1]->getElements());
    }
    
    /**
     * Tests that buildNotationElement() creates the element when the current 
     * element is the "schema" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildNotationElementCreateEltWhenSchema(): void
    {
        $this->sut->buildNotationElement();
        $this->sut->endElement();
        $this->sut->buildNotationElement();
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $nots = $sch->getNotationElements();
        self::assertCount(2, $nots);
        
        self::assertElementNamespaceDeclarations([], $nots[0]);
        self::assertNotationElementHasNoAttribute($nots[0]);
        self::assertSame([], $nots[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $nots[1]);
        self::assertNotationElementHasNoAttribute($nots[1]);
        self::assertSame([], $nots[1]->getElements());
    }
    
    /**
     * Tests that buildDefinitionAnnotationElement() creates the element 
     * when the current element is the "schema" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildDefinitionAnnotationElementCreateEltWhenSchema(): void
    {
        $this->sut->buildDefinitionAnnotationElement();
        $this->sut->endElement();
        $this->sut->buildDefinitionAnnotationElement();
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $anns = $sch->getDefinitionAnnotationElements();
        self::assertCount(2, $anns);
        
        self::assertElementNamespaceDeclarations([], $anns[0]);
        self::assertAnnotationElementHasNoAttribute($anns[0]);
        self::assertSame([], $anns[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $anns[1]);
        self::assertAnnotationElementHasNoAttribute($anns[1]);
        self::assertSame([], $anns[1]->getElements());
    }
    
    /**
     * Tests that buildAttributeElement() creates the element when the 
     * current element is the "schema" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAttributeElementCreateEltWhenSchema(): void
    {
        $this->sut->buildAttributeElement();
        $this->sut->endElement();
        $this->sut->buildAttributeElement();
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $attrs = $sch->getAttributeElements();
        self::assertCount(2, $attrs);
        
        self::assertElementNamespaceDeclarations([], $attrs[0]);
        self::assertAttributeElementHasNoAttribute($attrs[0]);
        self::assertSame([], $attrs[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $attrs[1]);
        self::assertAttributeElementHasNoAttribute($attrs[1]);
        self::assertSame([], $attrs[1]->getElements());
    }
    
    /**
     * Tests that buildSimpleTypeElement() creates the element when the 
     * current element is the "schema" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildSimpleTypeElementCreateEltWhenSchema(): void
    {
        $this->sut->buildSimpleTypeElement();
        $this->sut->endElement();
        $this->sut->buildSimpleTypeElement();
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $sts = $sch->getSimpleTypeElements();
        
        self::assertElementNamespaceDeclarations([], $sts[0]);
        self::assertSimpleTypeElementHasNoAttribute($sts[0]);
        self::assertSame([], $sts[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $sts[1]);
        self::assertSimpleTypeElementHasNoAttribute($sts[1]);
        self::assertSame([], $sts[1]->getElements());
    }
    
    /**
     * Tests that buildAttributeGroupElement() creates the element when the 
     * current element is the "schema" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAttributeGroupElementCreateEltWhenSchema(): void
    {
        $this->sut->buildAttributeGroupElement();
        $this->sut->endElement();
        $this->sut->buildAttributeGroupElement();
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $ags = $sch->getAttributeGroupElements();
        
        self::assertElementNamespaceDeclarations([], $ags[0]);
        self::assertAttributeGroupElementHasNoAttribute($ags[0]);
        self::assertSame([], $ags[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $ags[1]);
        self::assertAttributeGroupElementHasNoAttribute($ags[1]);
        self::assertSame([], $ags[1]->getElements());
    }
    
    /**
     * Tests that buildComplexTypeElement() creates the element when the 
     * current element is the "schema" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildComplexTypeElementCreateEltWhenSchema(): void
    {
        $this->sut->buildComplexTypeElement();
        $this->sut->endElement();
        $this->sut->buildComplexTypeElement();
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $cts = $sch->getComplexTypeElements();
        
        self::assertElementNamespaceDeclarations([], $cts[0]);
        self::assertComplexTypeElementHasNoAttribute($cts[0]);
        self::assertSame([], $cts[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $cts[1]);
        self::assertComplexTypeElementHasNoAttribute($cts[1]);
        self::assertSame([], $cts[1]->getElements());
    }
    
    /**
     * Tests that buildGroupElement() creates the element when the current 
     * element is the "schema" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildGroupElementCreateEltWhenSchema(): void
    {
        $this->sut->buildGroupElement();
        $this->sut->endElement();
        $this->sut->buildGroupElement();
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $grps = $sch->getGroupElements();
        
        self::assertElementNamespaceDeclarations([], $grps[0]);
        self::assertGroupElementHasNoAttribute($grps[0]);
        self::assertSame([], $grps[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $grps[1]);
        self::assertGroupElementHasNoAttribute($grps[1]);
        self::assertSame([], $grps[1]->getElements());
    }
    
    /**
     * Tests that buildElementElement() creates the element when the current 
     * element is the "schema" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildElementElementCreateEltWhenSchema(): void
    {
        $this->sut->buildElementElement();
        $this->sut->endElement();
        $this->sut->buildElementElement();
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $elts = $sch->getElementElements();
        
        self::assertElementNamespaceDeclarations([], $elts[0]);
        self::assertElementElementHasNoAttribute($elts[0]);
        self::assertSame([], $elts[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $elts[1]);
        self::assertElementElementHasNoAttribute($elts[1]);
        self::assertSame([], $elts[1]->getElements());
    }
}
