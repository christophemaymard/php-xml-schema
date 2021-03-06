<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\SelectorElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SelectorElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SelectorElementTest extends AbstractAnnotatedElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new SelectorElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetLocalNameReturnsSpecificString(): void
    {
        self::assertSame('selector', $this->sut->getLocalName());
    }
    
    /**
     * Tests that hasXPath() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasXPath(): void
    {
        self::assertFalse($this->sut->hasXPath(), 'The attribute has not been set.');
        
        $this->sut->setXPath($this->createSelectorXPathTypeDummy());
        self::assertTrue($this->sut->hasXPath(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getXPath() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetXPath(): void
    {
        self::assertNull($this->sut->getXPath(), 'The attribute has not been set.');
        
        $xpath1 = $this->createSelectorXPathTypeDummy();
        $this->sut->setXPath($xpath1);
        self::assertSame($xpath1, $this->sut->getXPath(), 'Set the attribute with a value: SelectorXPathType.');
        
        $xpath2 = $this->createSelectorXPathTypeDummy();
        $this->sut->setXPath($xpath2);
        self::assertSame($xpath2, $this->sut->getXPath(), 'Set the attribute with another value: SelectorXPathType.');
    }
}
