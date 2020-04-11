<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;


/**
 * Represents the unit test for testing that buildLeafElementContent() does 
 * not create the content.
 * 
 * It must be used in a class that extends the 
 * {@see PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder\AbstractSchemaElementBuilderTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait BuildLeafElementContentDoesNotCreateContentTestTrait
{
    /**
     * Tests that buildLeafElementContent() does not create the content when 
     * the current element is not a leaf element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildLeafElementContentDoesNotCreateContentWhenCEIsNotLeafElement(): void
    {
        $this->sut->buildLeafElementContent('foo bar baz content');
        $sch = $this->sut->getSchema();
        
        self::assertSchemaElementNotChanged($sch);
    }
}
