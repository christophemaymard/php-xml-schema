<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

/**
 * Represents the unit test for testing that buildMinOccursAttribute() does 
 * not create the attribute.
 * 
 * It must be used in a class that extends the 
 * {@see PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder\AbstractSchemaElementBuilderTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait BuildMinOccursAttributeDoesNotCreateAttributeTestTrait
{
    /**
     * Tests that buildMinOccursAttribute() does not create the attribute 
     * when the current element does not support the "minOccurs" attribute.
     * 
     * @group   attribute
     */
    public function testBuildMinOccursAttributeDoesNotCreateAttrWhenCEDoesNotSupportAttr(): void
    {
        $this->sut->buildMinOccursAttribute('-1');
        $this->sut->buildMinOccursAttribute('0');
        $sch = $this->sut->getSchema();
        
        self::assertSchemaElementNotChanged($sch);
    }
}
