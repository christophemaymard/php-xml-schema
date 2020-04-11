<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

/**
 * Represents the unit test for testing that buildXPathAttribute() does not 
 * create the attribute.
 * 
 * It must be used in a class that extends the 
 * {@see PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder\AbstractSchemaElementBuilderTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait BuildXPathAttributeDoesNotCreateAttributeTestTrait
{
    /**
     * Tests that buildXPathAttribute() does not create the attribute when 
     * the current element does not support the "xpath" attribute.
     * 
     * @group   attribute
     */
    public function testBuildXPathAttributeDoesNotCreateAttrWhenCEDoesNotSupportAttr(): void
    {
        // "selector" xpath.
        $this->sut->buildXPathAttribute('');
        $this->sut->buildXPathAttribute('*');
        
        // "field" xpath.
        $this->sut->buildXPathAttribute('attribute::');
        $this->sut->buildXPathAttribute('*');
        
        $sch = $this->sut->getSchema();
        
        self::assertSchemaElementNotChanged($sch);
    }
}
