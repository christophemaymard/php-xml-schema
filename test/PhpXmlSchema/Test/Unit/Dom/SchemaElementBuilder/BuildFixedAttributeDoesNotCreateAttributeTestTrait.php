<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;


/**
 * Represents the unit test for testing that buildFixedAttribute() does not 
 * create the attribute.
 * 
 * It must be used in a class that extends the 
 * {@see PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder\AbstractSchemaElementBuilderTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait BuildFixedAttributeDoesNotCreateAttributeTestTrait
{
    /**
     * Tests that buildFixedAttribute() does not create the attribute when 
     * the current element does not support the "fixed" attribute.
     * 
     * @group   attribute
     */
    public function testBuildFixedAttributeDoesNotCreateAttrWhenCEDoesNotSupportAttr(): void
    {
        // string
        $this->sut->buildFixedAttribute("\u{0000}");
        $this->sut->buildFixedAttribute('foo');
        
        // boolean
        $this->sut->buildFixedAttribute('TRUE');
        $this->sut->buildFixedAttribute('true');
        
        $sch = $this->sut->getSchema();
        
        self::assertSchemaElementNotChanged($sch);
    }
}
