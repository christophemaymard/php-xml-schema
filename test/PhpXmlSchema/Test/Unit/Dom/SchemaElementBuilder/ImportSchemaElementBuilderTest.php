<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

use PhpXmlSchema\Dom\ImportElement;
use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SchemaElementBuilder;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "import" element.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ImportSchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
{
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
    use BuildIncludeElementDoesNotCreateElementTestTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertSchemaElementNotChanged(SchemaElement $sch)
    {
        self::assertAncestorsNotChanged($sch);
        
        $import = self::getCurrentElement($sch);
        self::assertImportElementHasNoAttribute($import);
        self::assertSame([], $import->getElements());
    }
    
    /**
     * Asserts that the ancestors of the current element did not change since 
     * its building.
     * 
     * @param   SchemaElement   $sch    The "schema" element of the current element to assert.
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch)
    {
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        self::assertCount(1, $sch->getImportElements());
    }
    
    /**
     * Returns the instance of the current element.
     * 
     * @param   SchemaElement   $sch    The "schema" element of the current element
     * @return  ImportElement
     */
    private static function getCurrentElement(SchemaElement $sch):ImportElement
    {
        return $sch->getImportElements()[0];
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildImportElement();
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
     * element is the "import" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidIdValues
     */
    public function testBuildIdAttributeCreatesAttrWhenImportAndValueIsValid(
        string $value, 
        string $id
    ) {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $import = self::getCurrentElement($sch);
        self::assertImportElementHasOnlyIdAttribute($import);
        self::assertSame($id, $import->getId()->getId());
        self::assertSame([], $import->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the current 
     * element is the "import" element and the value is invalid.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidIdValues
     */
    public function testBuildIdAttributeThrowsExceptionWhenImportAndValueIsInvalid(
        string $value, 
        string $message
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildIdAttribute($value);
    }
    
    /**
     * Tests that buildNamespaceAttribute() creates the attribute when the 
     * current element is the "import" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $uri    The expected value for the URI.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidAnyUriValues
     */
    public function testBuildNamespaceAttributeCreatesAttrWhenImportAndValueIsValid(
        string $value, 
        string $uri
    ) {
        $this->sut->buildNamespaceAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $import = self::getCurrentElement($sch);
        self::assertImportElementHasOnlyNamespaceAttribute($import);
        self::assertSame($uri, $import->getNamespace()->getUri());
        self::assertSame([], $import->getElements());
    }
    
    /**
     * Tests that buildNamespaceAttribute() throws an exception when the 
     * current element is the "import" element and the value is invalid.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildNamespaceAttributeThrowsExceptionWhenImportAndValueIsInvalid()
    {
        $this->expectException(InvalidValueException::class);
        
        $this->sut->buildNamespaceAttribute(':');
    }
    
    /**
     * Tests that buildSchemaLocationAttribute() creates the attribute when the 
     * current element is the "import" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $uri    The expected value for the URI.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidAnyUriValues
     */
    public function testBuildSchemaLocationAttributeCreatesAttrWhenImportAndValueIsValid(
        string $value, 
        string $uri
    ) {
        $this->sut->buildSchemaLocationAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $import = self::getCurrentElement($sch);
        self::assertImportElementHasOnlySchemaLocationAttribute($import);
        self::assertSame($uri, $import->getSchemaLocation()->getUri());
        self::assertSame([], $import->getElements());
    }
    
    /**
     * Tests that buildSchemaLocationAttribute() throws an exception when the 
     * current element is the "import" element and the value is invalid.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildSchemaLocationAttributeThrowsExceptionWhenImportAndValueIsInvalid()
    {
        $this->expectException(InvalidValueException::class);
        
        $this->sut->buildSchemaLocationAttribute(':');
    }
    
    /**
     * Tests that buildAnnotationElement() creates the element when the 
     * current element is the "import" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAnnotationElementCreateEltWhenImport()
    {
        $this->sut->buildAnnotationElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $import = self::getCurrentElement($sch);
        self::assertImportElementHasNoAttribute($import);
        self::assertCount(1, $import->getElements());
        
        $ann = $import->getAnnotationElement();
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
}