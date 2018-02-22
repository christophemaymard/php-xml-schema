<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the unit tests for the "fixed" attribute (string) in a XML 
 * schema element.
 * 
 * It must be used in a class that extends the {@see PhpXmlSchema\Test\Unit\Dom\AbstractElementTestCase} 
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
     * @group   elt-attribute
     */
    public function testHasFixed()
    {
        self::assertFalse($this->sut->hasFixed(), 'The attribute has not been set.');
        
        $this->sut->setFixed('foo');
        self::assertTrue($this->sut->hasFixed(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getFixed() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   elt-attribute
     */
    public function testGetFixed()
    {
        self::assertNull($this->sut->getFixed(), 'The attribute has not been set.');
        
        $this->sut->setFixed('foo');
        self::assertSame('foo', $this->sut->getFixed(), 'Set the attribute with a value: foo.');
        
        $this->sut->setFixed('bar');
        self::assertSame('bar', $this->sut->getFixed(), 'Set the attribute with another value: bar.');
    }
}
