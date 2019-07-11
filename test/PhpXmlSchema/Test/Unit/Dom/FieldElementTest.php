<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\FieldElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\FieldElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class FieldElementTest extends AbstractAnnotatedElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new FieldElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetLocalNameReturnsSpecificString()
    {
        self::assertSame('field', $this->sut->getLocalName());
    }
    
    /**
     * Tests that hasXPath() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasXPath()
    {
        self::assertFalse($this->sut->hasXPath(), 'The attribute has not been set.');
        
        $this->sut->setXPath($this->createFieldXPathTypeDummy());
        self::assertTrue($this->sut->hasXPath(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getXPath() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetXPath()
    {
        self::assertNull($this->sut->getXPath(), 'The attribute has not been set.');
        
        $xpath1 = $this->createFieldXPathTypeDummy();
        $this->sut->setXPath($xpath1);
        self::assertSame($xpath1, $this->sut->getXPath(), 'Set the attribute with a value: FieldXPathType.');
        
        $xpath2 = $this->createFieldXPathTypeDummy();
        $this->sut->setXPath($xpath2);
        self::assertSame($xpath2, $this->sut->getXPath(), 'Set the attribute with another value: FieldXPathType.');
    }
}
