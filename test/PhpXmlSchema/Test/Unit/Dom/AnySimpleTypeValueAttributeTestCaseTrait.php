<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the unit tests for the "value" attribute (anySimpleType) in a 
 * XML schema element.
 * 
 * It must be used in a class that extends the {@see PhpXmlSchema\Test\Unit\Dom\AbstractAbstractElementTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait AnySimpleTypeValueAttributeTestCaseTrait
{
    /**
     * Tests that hasValue() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasValue()
    {
        self::assertFalse($this->sut->hasValue(), 'The attribute has not been set.');
        
        $this->sut->setValue('');
        self::assertTrue($this->sut->hasValue(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getValue() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetValue()
    {
        self::assertNull($this->sut->getValue(), 'The attribute has not been set.');
        
        $val1 = '';
        $this->sut->setValue($val1);
        self::assertSame($val1, $this->sut->getValue(), 'Set the attribute with a value: string.');
        
        $val2 = ' foo bar ';
        $this->sut->setValue($val2);
        self::assertSame($val2, $this->sut->getValue(), 'Set the attribute with another value: string.');
    }
}
