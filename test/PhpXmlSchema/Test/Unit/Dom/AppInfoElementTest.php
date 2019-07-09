<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\AppInfoElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\AppInfoElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AppInfoElementTest extends AbstractLeafElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new AppInfoElement();
    }
    
    /**
     * Tests that hasSource() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   elt-attribute
     */
    public function testHasSource()
    {
        self::assertFalse($this->sut->hasSource(), 'The attribute has not been set.');
        
        $this->sut->setSource($this->createAnyUriTypeDummy());
        self::assertTrue($this->sut->hasSource(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getSource() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   elt-attribute
     */
    public function testGetSource()
    {
        self::assertNull($this->sut->getSource(), 'The attribute has not been set.');
        
        $value1 = $this->createAnyUriTypeDummy();
        $this->sut->setSource($value1);
        self::assertSame($value1, $this->sut->getSource(), 'Set the attribute with a value: AnyUriType.');
        
        $value2 = $this->createAnyUriTypeDummy();
        $this->sut->setSource($value2);
        self::assertSame($value2, $this->sut->getSource(), 'Set the attribute with another value: AnyUriType.');
    }
}
