<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

use PhpXmlSchema\Dom\AttributeElement;
use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SchemaElementBuilder;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "attribute" element 
 * (topLevelAttributeType).
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TopAttributeSchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
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
    
    /**
     * {@inheritDoc}
     */
    public static function assertSchemaElementNotChanged(SchemaElement $sch)
    {
        self::assertAncestorsNotChanged($sch);
        
        $attr = self::getCurrentElement($sch);
        self::assertAttributeElementHasNoAttribute($attr);
        self::assertSame([], $attr->getElements());
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
        self::assertCount(1, $sch->getAttributeElements());
    }
    
    /**
     * Returns the instance of the current element.
     * 
     * @param   SchemaElement   $sch    The "schema" element of the current element
     * @return  AttributeElement
     */
    private static function getCurrentElement(SchemaElement $sch):AttributeElement
    {
        return $sch->getAttributeElements()[0];
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
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
     * current element is the "attribute" element (topLevelAttributeType) and 
     * the value is valid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidStringValues
     */
    public function testBuildDefaultAttributeCreatesAttrWhenTopAttributeAndValueIsValid(
        string $value
    ) {
        $this->sut->buildDefaultAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $attr = self::getCurrentElement($sch);
        self::assertAttributeElementHasOnlyDefaultAttribute($attr);
        self::assertSame($value, $attr->getDefault()->getString());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildDefaultAttribute() throws an exception when the 
     * current element is the "attribute" element (topLevelAttributeType) and 
     * the value is invalid.
     * 
     * @param   string  $value      The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidStringValues
     */
    public function testBuildDefaultAttributeThrowsExceptionWhenTopAttributeAndValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('"'.$value.'" is an invalid string.');
        
        $this->sut->buildDefaultAttribute($value);
    }
}