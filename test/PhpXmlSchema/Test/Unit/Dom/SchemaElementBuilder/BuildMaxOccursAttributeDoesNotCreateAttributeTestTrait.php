<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

/**
 * Represents the unit test for testing that buildMaxOccursAttribute() does 
 * not create the attribute.
 * 
 * It must be used in a class that extends the 
 * {@see PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder\AbstractSchemaElementBuilderTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait BuildMaxOccursAttributeDoesNotCreateAttributeTestTrait
{
    /**
     * Tests that buildMaxOccursAttribute() does not create the attribute 
     * when the current element does not support the "maxOccurs" attribute.
     * 
     * @group   attribute
     */
    public function testBuildMaxOccursAttributeDoesNotCreateAttrWhenCEDoesNotSupportAttr()
    {
        $this->sut->buildMaxOccursAttribute('foo');
        $this->sut->buildMaxOccursAttribute('1');
        $sch = $this->sut->getSchema();
        
        self::assertSchemaElementNotChanged($sch);
    }
}
