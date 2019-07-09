<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\KeyRefElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\KeyRefElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class KeyRefElementTest extends AbstractIdentityConstraintElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new KeyRefElement();
    }
    
    /**
     * Tests that hasRefer() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   elt-attribute
     */
    public function testHasRefer()
    {
        self::assertFalse($this->sut->hasRefer(), 'The attribute has not been set.');
        
        $this->sut->setRefer($this->createQNameTypeDummy());
        self::assertTrue($this->sut->hasRefer(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getRefer() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   elt-attribute
     */
    public function testGetRefer()
    {
        self::assertNull($this->sut->getRefer(), 'The attribute has not been set.');
        
        $qname1 = $this->createQNameTypeDummy();
        $this->sut->setRefer($qname1);
        self::assertSame($qname1, $this->sut->getRefer(), 'Set the attribute with a value: QNameType.');
        
        $qname2 = $this->createQNameTypeDummy();
        $this->sut->setRefer($qname2);
        self::assertSame($qname2, $this->sut->getRefer(), 'Set the attribute with another value: QNameType.');
    }
}
