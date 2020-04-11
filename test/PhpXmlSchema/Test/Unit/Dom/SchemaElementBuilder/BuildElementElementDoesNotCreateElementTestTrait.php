<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

/**
 * Represents the unit test for testing that buildElementElement() does not 
 * create the element.
 * 
 * It must be used in a class that extends the 
 * {@see PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder\AbstractSchemaElementBuilderTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait BuildElementElementDoesNotCreateElementTestTrait
{
    /**
     * Tests that buildElementElement() does not create the element when 
     * the current element does not support the "element" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildElementElementDoesNotCreateEltWhenCEDoesNotSupportElt(): void
    {
        $this->sut->buildElementElement();
        $sch = $this->sut->getSchema();
        
        self::assertSchemaElementNotChanged($sch);
    }
}
