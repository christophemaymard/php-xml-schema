<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\ListElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\ListElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ListElementTest extends AbstractSimpleTypedElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new ListElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetLocalNameReturnsSpecificString(): void
    {
        self::assertSame('list', $this->sut->getLocalName());
    }
    
    /**
     * Tests that hasItemType() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasItemType(): void
    {
        self::assertFalse($this->sut->hasItemType(), 'The attribute has not been set.');
        
        $this->sut->setItemType($this->createQNameTypeDummy());
        self::assertTrue($this->sut->hasItemType(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getItemType() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetItemType(): void
    {
        self::assertNull($this->sut->getItemType(), 'The attribute has not been set.');
        
        $qname1 = $this->createQNameTypeDummy();
        $this->sut->setItemType($qname1);
        self::assertSame($qname1, $this->sut->getItemType(), 'Set the attribute with a value: QNameType.');
        
        $qname2 = $this->createQNameTypeDummy();
        $this->sut->setItemType($qname2);
        self::assertSame($qname2, $this->sut->getItemType(), 'Set the attribute with another value: QNameType.');
    }
}
