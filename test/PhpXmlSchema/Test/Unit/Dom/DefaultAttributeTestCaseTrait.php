<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the unit tests for the "default" attribute in a XML schema 
 * element.
 * 
 * It must be used in a class that extends the {@see PhpXmlSchema\Test\Unit\Dom\AbstractElementTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait DefaultAttributeTestCaseTrait
{
    /**
     * Tests that hasDefault() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasDefault()
    {
        self::assertFalse($this->sut->hasDefault(), 'The attribute has not been set.');
        
        $this->sut->setDefault($this->createStringTypeDummy());
        self::assertTrue($this->sut->hasDefault(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getDefault() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetDefault()
    {
        self::assertNull($this->sut->getDefault(), 'The attribute has not been set.');
        
        $string1 = $this->createStringTypeDummy();
        $this->sut->setDefault($string1);
        self::assertSame($string1, $this->sut->getDefault(), 'Set the attribute with a value: StringType.');
        
        $string2 = $this->createStringTypeDummy();
        $this->sut->setDefault($string2);
        self::assertSame($string2, $this->sut->getDefault(), 'Set the attribute with another value: StringType.');
    }
}
