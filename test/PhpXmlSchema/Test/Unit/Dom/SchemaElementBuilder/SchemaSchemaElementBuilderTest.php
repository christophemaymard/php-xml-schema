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
 * class when the current element is the "schema" element.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SchemaSchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
{
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
    
    /**
     * {@inheritDoc}
     */
    public static function assertSchemaElementNotChanged(SchemaElement $sch)
    {
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that getSchema() returns the same instance of SchemaElement when 
     * instantiated.
     */
    public function testGetSchemaReturnsSameInstanceOfEmptySchemaElementWhenInstantiated()
    {
        $sch1 = $this->sut->getSchema();
        
        self::assertSame([], $sch1->getNamespaceDeclarations());
        self::assertSchemaElementHasNoAttribute($sch1);
        self::assertSame([], $sch1->getElements());
        $sch2 = $this->sut->getSchema();
        self::assertSame($sch1, $sch2, 'Same instance of SchemaElement.');
    }
    
    /**
     * Tests that buildSchemaElement() creates an empty "schema" element and 
     * replaces the current one that is being built.
     */
    public function testBuildSchemaElementCreateNewInstanceOfEmptySchemaElement()
    {
        $sch1 = $this->sut->getSchema();
        $this->sut->buildSchemaElement();
        $sch2 = $this->sut->getSchema();
        
        self::assertSame([], $sch2->getNamespaceDeclarations());
        self::assertSchemaElementHasNoAttribute($sch2);
        self::assertSame([], $sch2->getElements());
        self::assertNotSame($sch2, $sch1, 'Not same instance of SchemaElement.');
    }
    
    /**
     * Tests that buildAttributeFormDefaultAttribute() creates the attribute 
     * when the current element is the "schema" element and the value is 
     * "qualified".
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildAttributeFormDefaultAttributeCreatesAttrWhenSchemaAndValueIsQualified()
    {
        $this->sut->buildAttributeFormDefaultAttribute('qualified');
        $sch = $this->sut->getSchema();
        
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasOnlyAttributeFormDefaultAttribute($sch);
        self::assertTrue($sch->getAttributeFormDefault()->isQualified());
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildAttributeFormDefaultAttribute() creates the attribute 
     * when the current element is the "schema" element and the value is 
     * "unqualified".
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildAttributeFormDefaultAttributeCreatesAttrWhenSchemaAndValueIsUnqualified()
    {
        $this->sut->buildAttributeFormDefaultAttribute('unqualified');
        $sch = $this->sut->getSchema();
        
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasOnlyAttributeFormDefaultAttribute($sch);
        self::assertTrue($sch->getAttributeFormDefault()->isUnqualified());
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
     * @dataProvider    getInvalidFormChoiceValues
     */
    public function testBuildAttributeFormDefaultAttributeThrowsExceptionWhenSchemaAndValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            '"'.$value.'" is an invalid value for the "attributeFormDefault" '.
            'attribute (from no namespace), expected: "qualified" or '.
            '"unqualified".'
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
     * @dataProvider    getValidBlockSetValues
     */
    public function testBuildBlockDefaultAttributeCreatesAttrWhenSchemaAndValueIsValid(
        string $value, 
        bool $res, 
        bool $ext, 
        bool $sub
    ) {
        $this->sut->buildBlockDefaultAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertSame([], $sch->getNamespaceDeclarations());
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
     * @dataProvider    getInvalidBlockSetValues
     */
    public function testBuildBlockDefaultAttributeThrowsExceptionWhenSchemaAndValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            '"'.$value.'" is an invalid value for the "blockDefault" '.
            'attribute (from no namespace), expected: "#all" or '.
            '"List of (extension | restriction | substitution)".'
        );
        
        $this->sut->buildBlockDefaultAttribute($value);
    }
    
    /**
     * Tests that buildElementFormDefaultAttribute() creates the attribute 
     * when the current element is the "schema" element and the value is 
     * "qualified".
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildElementFormDefaultAttributeCreatesAttrWhenSchemaAndValueIsQualified()
    {
        $this->sut->buildElementFormDefaultAttribute('qualified');
        $sch = $this->sut->getSchema();
        
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasOnlyElementFormDefaultAttribute($sch);
        self::assertTrue($sch->getElementFormDefault()->isQualified());
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildElementFormDefaultAttribute() creates the attribute 
     * when the current element is the "schema" element and the value is 
     * "unqualified".
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildElementFormDefaultAttributeCreatesAttrWhenSchemaAndValueIsUnqualified()
    {
        $this->sut->buildElementFormDefaultAttribute('unqualified');
        $sch = $this->sut->getSchema();
        
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasOnlyElementFormDefaultAttribute($sch);
        self::assertTrue($sch->getElementFormDefault()->isUnqualified());
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
     * @dataProvider    getInvalidFormChoiceValues
     */
    public function testBuildElementFormDefaultAttributeThrowsExceptionWhenSchemaAndValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            '"'.$value.'" is an invalid value for the "elementFormDefault" '.
            'attribute (from no namespace), expected: "qualified" or '.
            '"unqualified".'
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
     * @dataProvider    getValidFullDerivationSetValues
     */
    public function testBuildFinalDefaultAttributeCreatesAttrWhenSchemaAndValueIsValid(
        string $value,
        bool $ext, 
        bool $res, 
        bool $lst, 
        bool $unn
    ) {
        $this->sut->buildFinalDefaultAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertSame([], $sch->getNamespaceDeclarations());
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
     * @dataProvider    getInvalidFullDerivationSetValues
     */
    public function testBuildFinalDefaultAttributeThrowsExceptionWhenSchemaAndValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            '"'.$value.'" is an invalid value for the "finalDefault" '.
            'attribute (from no namespace), expected: "#all" or '.
            '"List of (extension | restriction | list | union)".'
        );
        
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
     * @dataProvider    getValidIdValues
     */
    public function testBuildIdAttributeCreatesAttrWhenSchemaAndValueIsValid(
        string $value, 
        string $id
    ) {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasOnlyIdAttribute($sch);
        self::assertSame($id, $sch->getId()->getId());
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the current 
     * element is the "schema" element and the value is invalid.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidIdValues
     */
    public function testBuildIdAttributeThrowsExceptionWhenSchemaAndValueIsInvalid(
        string $value, 
        string $message
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
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
     * @dataProvider    getValidAnyUriValues
     */
    public function testBuildTargetNamespaceAttributeCreatesAttrWhenSchemaAndValueIsValid(
        string $value, 
        string $uri
    ) {
        $this->sut->buildTargetNamespaceAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasOnlyTargetNamespaceAttribute($sch);
        self::assertSame($uri, $sch->getTargetNamespace()->getUri());
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildTargetNamespaceAttribute() throws an exception when 
     * the current element is the "schema" element and the value is invalid.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildTargetNamespaceAttributeThrowsExceptionWhenSchemaAndValueIsInvalid()
    {
        $this->expectException(InvalidValueException::class);
        
        $this->sut->buildTargetNamespaceAttribute(':');
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
     * @dataProvider    getValidTokenValues
     */
    public function testBuildVersionAttributeCreatesAttrWhenSchemaAndValueIsValid(
        string $value, 
        string $version
    ) {
        $this->sut->buildVersionAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasOnlyVersionAttribute($sch);
        self::assertSame($version, $sch->getVersion()->getToken());
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildVersionAttribute() throws an exception when the 
     * current element is the "schema" element and the value is invalid.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildVersionAttributeThrowsExceptionWhenSchemaAndValueIsInvalid()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage("\"\u{001F}\" is an invalid token.");
        
        $this->sut->buildVersionAttribute("\u{001F}");
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
     * @dataProvider    getValidLanguageValues
     */
    public function testBuildLangAttributeCreatesAttrWhenSchemaAndValueIsValid(
        string $value, 
        string $primary,
        array $subtags
    ) {
        $this->sut->buildLangAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertSame([], $sch->getNamespaceDeclarations());
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
     * @dataProvider    getInvalidLanguageValues
     */
    public function testBuildLangAttributeThrowsExceptionWhenSchemaAndValueIsInvalid(
        string $value,
        string $message
    ) {
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
    public function testBuildCompositionAnnotationElementCreateEltWhenSchema()
    {
        $this->sut->buildCompositionAnnotationElement();
        $this->sut->endElement();
        $this->sut->buildCompositionAnnotationElement();
        $sch = $this->sut->getSchema();
        
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $anns = $sch->getCompositionAnnotationElements();
        self::assertCount(2, $anns);
        
        self::assertSame([], $anns[0]->getNamespaceDeclarations());
        self::assertAnnotationElementHasNoAttribute($anns[0]);
        self::assertSame([], $anns[0]->getElements());
        
        self::assertSame([], $anns[1]->getNamespaceDeclarations());
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
    public function testBuildImportElementCreateEltWhenSchema()
    {
        $this->sut->buildImportElement();
        $this->sut->endElement();
        $this->sut->buildImportElement();
        $sch = $this->sut->getSchema();
        
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $imports = $sch->getImportElements();
        self::assertCount(2, $imports);
        
        self::assertSame([], $imports[0]->getNamespaceDeclarations());
        self::assertImportElementHasNoAttribute($imports[0]);
        self::assertSame([], $imports[0]->getElements());
        
        self::assertSame([], $imports[1]->getNamespaceDeclarations());
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
    public function testBuildIncludeElementCreateEltWhenSchema()
    {
        $this->sut->buildIncludeElement();
        $this->sut->endElement();
        $this->sut->buildIncludeElement();
        $sch = $this->sut->getSchema();
        
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $incs = $sch->getIncludeElements();
        self::assertCount(2, $incs);
        
        self::assertSame([], $incs[0]->getNamespaceDeclarations());
        self::assertIncludeElementHasNoAttribute($incs[0]);
        self::assertSame([], $incs[0]->getElements());
        
        self::assertSame([], $incs[1]->getNamespaceDeclarations());
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
    public function testBuildNotationElementCreateEltWhenSchema()
    {
        $this->sut->buildNotationElement();
        $this->sut->endElement();
        $this->sut->buildNotationElement();
        $sch = $this->sut->getSchema();
        
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $nots = $sch->getNotationElements();
        self::assertCount(2, $nots);
        
        self::assertSame([], $nots[0]->getNamespaceDeclarations());
        self::assertNotationElementHasNoAttribute($nots[0]);
        self::assertSame([], $nots[0]->getElements());
        
        self::assertSame([], $nots[1]->getNamespaceDeclarations());
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
    public function testBuildDefinitionAnnotationElementCreateEltWhenSchema()
    {
        $this->sut->buildDefinitionAnnotationElement();
        $this->sut->endElement();
        $this->sut->buildDefinitionAnnotationElement();
        $sch = $this->sut->getSchema();
        
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $anns = $sch->getDefinitionAnnotationElements();
        self::assertCount(2, $anns);
        
        self::assertSame([], $anns[0]->getNamespaceDeclarations());
        self::assertAnnotationElementHasNoAttribute($anns[0]);
        self::assertSame([], $anns[0]->getElements());
        
        self::assertSame([], $anns[1]->getNamespaceDeclarations());
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
    public function testBuildAttributeElementCreateEltWhenSchema()
    {
        $this->sut->buildAttributeElement();
        $this->sut->endElement();
        $this->sut->buildAttributeElement();
        $sch = $this->sut->getSchema();
        
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $attrs = $sch->getAttributeElements();
        self::assertCount(2, $attrs);
        
        self::assertSame([], $attrs[0]->getNamespaceDeclarations());
        self::assertAttributeElementHasNoAttribute($attrs[0]);
        self::assertSame([], $attrs[0]->getElements());
        
        self::assertSame([], $attrs[1]->getNamespaceDeclarations());
        self::assertAttributeElementHasNoAttribute($attrs[1]);
        self::assertSame([], $attrs[1]->getElements());
    }
}
