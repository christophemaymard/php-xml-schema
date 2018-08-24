<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\AttributeElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\AttributeElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AttributeElementTest extends AbstractSimpleTypedElementTestCase
{
    use DefaultAttributeTestCaseTrait;
    use FixedAttributeTestCaseTrait;
    use NameAttributeTestCaseTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new AttributeElement();
    }
    
    /**
     * Tests that hasType() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   elt-attribute
     */
    public function testHasType()
    {
        self::assertFalse($this->sut->hasType(), 'The attribute has not been set.');
        
        $this->sut->setType($this->createQNameTypeDummy());
        self::assertTrue($this->sut->hasType(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getType() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   elt-attribute
     */
    public function testGetType()
    {
        self::assertNull($this->sut->getType(), 'The attribute has not been set.');
        
        $qname1 = $this->createQNameTypeDummy();
        $this->sut->setType($qname1);
        self::assertSame($qname1, $this->sut->getType(), 'Set the attribute with a value: QNameType.');
        
        $qname2 = $this->createQNameTypeDummy();
        $this->sut->setType($qname2);
        self::assertSame($qname2, $this->sut->getType(), 'Set the attribute with another value: QNameType.');
    }
}
