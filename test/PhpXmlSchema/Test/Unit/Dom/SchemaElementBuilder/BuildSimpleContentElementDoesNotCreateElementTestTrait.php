<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

/**
 * Represents the unit test for testing that buildSimpleContentElement() does 
 * not create the element.
 * 
 * It must be used in a class that extends the 
 * {@see PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder\AbstractSchemaElementBuilderTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait BuildSimpleContentElementDoesNotCreateElementTestTrait
{
    /**
     * Tests that buildSimpleContentElement() does not create the element 
     * when the current element does not support the "simpleContent" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildSimpleContentElementDoesNotCreateEltWhenCEDoesNotSupportElt(): void
    {
        $this->sut->buildSimpleContentElement();
        $sch = $this->sut->getSchema();
        
        self::assertSchemaElementNotChanged($sch);
    }
}
