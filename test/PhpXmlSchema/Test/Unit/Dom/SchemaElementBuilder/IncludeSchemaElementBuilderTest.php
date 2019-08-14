<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

use PhpXmlSchema\Dom\IncludeElement;
use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SchemaElementBuilder;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "include" element.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class IncludeSchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
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
    
    /**
     * {@inheritDoc}
     */
    public static function assertSchemaElementNotChanged(SchemaElement $sch)
    {
        self::assertAncestorsNotChanged($sch);
        
        $inc = self::getCurrentElement($sch);
        self::assertIncludeElementHasNoAttribute($inc);
        self::assertSame([], $inc->getElements());
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
        self::assertCount(1, $sch->getIncludeElements());
    }
    
    /**
     * Returns the instance of the current element.
     * 
     * @param   SchemaElement   $sch    The "schema" element of the current element
     * @return  IncludeElement
     */
    private static function getCurrentElement(SchemaElement $sch):IncludeElement
    {
        return $sch->getIncludeElements()[0];
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildIncludeElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
}
