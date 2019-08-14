<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

use PhpXmlSchema\Dom\AppInfoElement;
use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SchemaElementBuilder;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "appinfo" element.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AppInfoSchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
{
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
    use BuildDocumentationElementDoesNotCreateElementTestTrait;
    use BuildImportElementDoesNotCreateElementTestTrait;
    use BuildNamespaceAttributeDoesNotCreateAttributeTestTrait;
    use BuildSchemaLocationAttributeDoesNotCreateAttributeTestTrait;
    use BuildAnnotationElementDoesNotCreateElementTestTrait;
    use BuildIncludeElementDoesNotCreateElementTestTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertSchemaElementNotChanged(SchemaElement $sch)
    {
        self::assertAncestorsNotChanged($sch);
        
        $appinfo = self::getCurrentElement($sch);
        self::assertAppInfoElementHasNoAttribute($appinfo);
        self::assertSame('', $appinfo->getContent());
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
        
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertCount(1, $ann->getElements());
        self::assertCount(1, $ann->getAppInfoElements());
    }
    
    /**
     * Returns the instance of the current element.
     * 
     * @param   SchemaElement   $sch    The "schema" element of the current element
     * @return  AppInfoElement
     */
    private static function getCurrentElement(SchemaElement $sch):AppInfoElement
    {
        return $sch->getCompositionAnnotationElements()[0]
            ->getAppInfoElements()[0];
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildCompositionAnnotationElement();
        $this->sut->buildAppInfoElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that buildSourceAttribute() creates the attribute when the 
     * current element is the "appinfo" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $uri    The expected value for the URI.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidAnyUriValues
     */
    public function testBuildSourceAttributeCreatesAttrWhenAppInfoAndValueIsValid(
        string $value, 
        string $uri
    ) {
        $this->sut->buildSourceAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $appinfo = self::getCurrentElement($sch);
        self::assertAppInfoElementHasOnlySourceAttribute($appinfo);
        self::assertSame($uri, $appinfo->getSource()->getUri());
        self::assertSame('', $appinfo->getContent());
    }
    
    /**
     * Tests that buildSourceAttribute() throws an exception when the current 
     * element is the "appinfo" element and the value is invalid.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildSourceAttributeThrowsExceptionWhenAppInfoAndValueIsInvalid()
    {
        $this->expectException(InvalidValueException::class);
        
        $this->sut->buildSourceAttribute(':');
    }
    
    /**
     * Tests that buildLeafElementContent() creates the content when the 
     * current element is the "appinfo" element.
     * 
     * @group   content
     * @group   element
     */
    public function testbuildLeafElementContentCreatesContentWhenAppInfo()
    {
        $this->sut->buildLeafElementContent('foo bar baz content');
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $appinfo = self::getCurrentElement($sch);
        self::assertAppInfoElementHasNoAttribute($appinfo);
        self::assertSame('foo bar baz content', $appinfo->getContent());
    }
    
    /**
     * Tests that buildLeafElementContent() updates the content when the 
     * current element is the "appinfo" element.
     * 
     * @group   content
     * @group   element
     */
    public function testbuildLeafElementContentUpdatesContentWhenAppInfo()
    {
        $this->sut->buildLeafElementContent('foo');
        $this->sut->buildLeafElementContent('bar');
        $this->sut->buildLeafElementContent('baz');
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $appinfo = self::getCurrentElement($sch);
        self::assertAppInfoElementHasNoAttribute($appinfo);
        self::assertSame('baz', $appinfo->getContent());
    }
}