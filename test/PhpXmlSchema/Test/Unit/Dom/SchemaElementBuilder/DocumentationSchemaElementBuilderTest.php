<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

use PhpXmlSchema\Dom\DocumentationElement;
use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SchemaElementBuilder;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "documentation" element.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DocumentationSchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
{
    use BuildAttributeFormDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildBlockDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildElementFormDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildFinalDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildIdAttributeDoesNotCreateAttributeTestTrait;
    use BuildTargetNamespaceAttributeDoesNotCreateAttributeTestTrait;
    use BuildVersionAttributeDoesNotCreateAttributeTestTrait;
    use BuildCompositionAnnotationElementDoesNotCreateElementTestTrait;
    use BuildAppInfoElementDoesNotCreateElementTestTrait;
    use BuildDocumentationElementDoesNotCreateElementTestTrait;
    use BuildImportElementDoesNotCreateElementTestTrait;
    use BuildNamespaceAttributeDoesNotCreateAttributeTestTrait;
    use BuildSchemaLocationAttributeDoesNotCreateAttributeTestTrait;
    use BuildAnnotationElementDoesNotCreateElementTestTrait;
    use BuildIncludeElementDoesNotCreateElementTestTrait;
    use BuildNotationElementDoesNotCreateElementTestTrait;
    use BuildNameAttributeDoesNotCreateAttributeTestTrait;
    use BuildPublicAttributeDoesNotCreateAttributeTestTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertSchemaElementNotChanged(SchemaElement $sch)
    {
        self::assertAncestorsNotChanged($sch);
        
        $doc = $sch->getCompositionAnnotationElements()[0]
            ->getDocumentationElements()[0];
        
        self::assertDocumentationElementHasNoAttribute($doc);
        self::assertSame('', $doc->getContent());
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
        self::assertCount(1, $ann->getDocumentationElements());
    }
    
    /**
     * Returns the instance of the current element.
     * 
     * @param   SchemaElement   $sch    The "schema" element of the current element
     * @return  DocumentationElement
     */
    private static function getCurrentElement(SchemaElement $sch):DocumentationElement
    {
        return $sch->getCompositionAnnotationElements()[0]
            ->getDocumentationElements()[0];
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildCompositionAnnotationElement();
        $this->sut->buildDocumentationElement();
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
     * current element is the "documentation" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $uri    The expected value for the URI.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidAnyUriValues
     */
    public function testBuildSourceAttributeCreatesAttrWhenDocumentationAndValueIsValid(
        string $value, 
        string $uri
    ) {
        $this->sut->buildSourceAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $doc = self::getCurrentElement($sch);
        self::assertDocumentationElementHasOnlySourceAttribute($doc);
        self::assertSame($uri, $doc->getSource()->getUri());
        self::assertSame('', $doc->getContent());
    }
    
    /**
     * Tests that buildSourceAttribute() throws an exception when the current 
     * element is the "documentation" element and the value is invalid.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildSourceAttributeThrowsExceptionWhenDocumentationAndValueIsInvalid()
    {
        $this->expectException(InvalidValueException::class);
        
        $this->sut->buildSourceAttribute(':');
    }
    
    /**
     * Tests that buildLangAttribute() creates the attribute when the current 
     * element is the "documentation" element and the value is valid.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $version    The expected value for the version.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidLanguageValues
     */
    public function testBuildLangAttributeCreatesAttrWhenDocumentationAndValueIsValid(
        string $value, 
        string $primary,
        array $subtags
    ) {
        $this->sut->buildLangAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $doc = self::getCurrentElement($sch);
        self::assertDocumentationElementHasOnlyLangAttribute($doc);
        self::assertSame($primary, $doc->getLang()->getPrimarySubtag());
        self::assertSame($subtags, $doc->getLang()->getSubtags());
        self::assertSame('', $doc->getContent());
    }
    
    /**
     * Tests that buildLangAttribute() throws an exception when the current 
     * element is the "documentation" element and the value is invalid.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidLanguageValues
     */
    public function testBuildLangAttributeThrowsExceptionWhenDocumentationAndValueIsInvalid(
        string $value,
        string $message
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildLangAttribute($value);
    }
    
    /**
     * Tests that buildLeafElementContent() creates the content when the 
     * current element is the "documentation" element.
     * 
     * @group   content
     * @group   element
     */
    public function testbuildLeafElementContentCreatesContentWhenDocumentation()
    {
        $this->sut->buildLeafElementContent('foo bar baz content');
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $doc = self::getCurrentElement($sch);
        self::assertDocumentationElementHasNoAttribute($doc);
        self::assertSame('foo bar baz content', $doc->getContent());
    }
    
    /**
     * Tests that buildLeafElementContent() updates the content when the 
     * current element is the "documentation" element.
     * 
     * @group   content
     * @group   element
     */
    public function testbuildLeafElementContentUpdatesContentWhenDocumentation()
    {
        $this->sut->buildLeafElementContent('foo');
        $this->sut->buildLeafElementContent('bar');
        $this->sut->buildLeafElementContent('baz');
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $doc = self::getCurrentElement($sch);
        self::assertDocumentationElementHasNoAttribute($doc);
        self::assertSame('baz', $doc->getContent());
    }
}
