<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the unit tests for the "fixed" attribute (string) in a XML 
 * schema element.
 * 
 * It must be used in a class that extends the {@see PhpXmlSchema\Test\Unit\Dom\AbstractAbstractElementTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait FixedAttributeTestCaseTrait
{
    /**
     * Tests that hasFixed() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasFixed(): void
    {
        self::assertFalse($this->sut->hasFixed(), 'The attribute has not been set.');
        
        $this->sut->setFixed($this->createStringTypeDummy());
        self::assertTrue($this->sut->hasFixed(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getFixed() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetFixed(): void
    {
        self::assertNull($this->sut->getFixed(), 'The attribute has not been set.');
        
        $string1 = $this->createStringTypeDummy();
        $this->sut->setFixed($string1);
        self::assertSame($string1, $this->sut->getFixed(), 'Set the attribute with a value: StringType.');
        
        $string2 = $this->createStringTypeDummy();
        $this->sut->setFixed($string2);
        self::assertSame($string2, $this->sut->getFixed(), 'Set the attribute with another value: StringType.');
    }
}
