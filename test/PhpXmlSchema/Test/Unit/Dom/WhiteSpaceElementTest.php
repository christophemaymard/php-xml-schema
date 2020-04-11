<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\WhiteSpaceElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\WhiteSpaceElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class WhiteSpaceElementTest extends AbstractFixedFacetElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new WhiteSpaceElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetLocalNameReturnsSpecificString(): void
    {
        self::assertSame('whiteSpace', $this->sut->getLocalName());
    }
    
    /**
     * Tests that hasValue() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasValue(): void
    {
        self::assertFalse($this->sut->hasValue(), 'The attribute has not been set.');
        
        $this->sut->setValue($this->createWhiteSpaceTypeDummy());
        self::assertTrue($this->sut->hasValue(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getValue() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetValue(): void
    {
        self::assertNull($this->sut->getValue(), 'The attribute has not been set.');
        
        $ws1 = $this->createWhiteSpaceTypeDummy();
        $this->sut->setValue($ws1);
        self::assertSame($ws1, $this->sut->getValue(), 'Set the attribute with a value: WhiteSpaceType.');
        
        $ws2 = $this->createWhiteSpaceTypeDummy();
        $this->sut->setValue($ws2);
        self::assertSame($ws2, $this->sut->getValue(), 'Set the attribute with another value: WhiteSpaceType.');
    }
}
