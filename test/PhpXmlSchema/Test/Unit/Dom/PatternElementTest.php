<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\PatternElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\PatternElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PatternElementTest extends AbstractAnnotatedElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new PatternElement();
    }
    
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
        
        $this->sut->setValue($this->createStringTypeDummy());
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
        
        $string1 = $this->createStringTypeDummy();
        $this->sut->setValue($string1);
        self::assertSame($string1, $this->sut->getValue(), 'Set the attribute with a value: StringType.');
        
        $string2 = $this->createStringTypeDummy();
        $this->sut->setValue($string2);
        self::assertSame($string2, $this->sut->getValue(), 'Set the attribute with another value: StringType.');
    }
}
