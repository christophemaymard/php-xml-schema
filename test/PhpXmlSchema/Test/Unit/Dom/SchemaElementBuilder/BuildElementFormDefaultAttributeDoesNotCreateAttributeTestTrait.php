<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;


/**
 * Represents the unit test for testing that 
 * buildElementFormDefaultAttribute() does not create the attribute.
 * 
 * It must be used in a class that extends the 
 * {@see PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder\AbstractSchemaElementBuilderTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait BuildElementFormDefaultAttributeDoesNotCreateAttributeTestTrait
{
    /**
     * Tests that buildElementFormDefaultAttribute() does not create the 
     * attribute when the current element does not support the 
     * "elementFormDefault" attribute.
     * 
     * @group   attribute
     */
    public function testBuildElementFormDefaultAttributeDoesNotCreateAttrWhenCEDoesNotSupportAttr()
    {
        $this->sut->buildElementFormDefaultAttribute('foo');
        $this->sut->buildElementFormDefaultAttribute('qualified');
        $sch = $this->sut->getSchema();
        
        self::assertSchemaElementNotChanged($sch);
    }
}
