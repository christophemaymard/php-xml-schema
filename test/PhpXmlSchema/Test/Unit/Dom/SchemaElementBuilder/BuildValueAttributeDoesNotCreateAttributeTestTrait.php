<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;


/**
 * Represents the unit test for testing that buildValueAttribute() does not 
 * create the attribute.
 * 
 * It must be used in a class that extends the 
 * {@see PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder\AbstractSchemaElementBuilderTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait BuildValueAttributeDoesNotCreateAttributeTestTrait
{
    /**
     * Tests that buildValueAttribute() does not create the attribute when 
     * the current element does not support the "value" attribute.
     * 
     * @group   attribute
     */
    public function testBuildValueAttributeDoesNotCreateAttrWhenCEDoesNotSupportAttr()
    {
        // anySimpleType
        $this->sut->buildValueAttribute('value');
        
        // positiveInteger
        $this->sut->buildValueAttribute('-2');
        $this->sut->buildValueAttribute('+8');
        
        // nonNegativeInteger
        $this->sut->buildValueAttribute('-9');
        $this->sut->buildValueAttribute('+5');
        
        // white space
        $this->sut->buildValueAttribute('COLLAPSE');
        $this->sut->buildValueAttribute('preserve');
        
        // string
        $this->sut->buildValueAttribute("\u{0000}");
        $this->sut->buildValueAttribute('foo');
        
        $sch = $this->sut->getSchema();
        
        self::assertSchemaElementNotChanged($sch);
    }
}
