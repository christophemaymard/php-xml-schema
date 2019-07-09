<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the unit tests for the "maxOccurs" attribute in a XML schema 
 * element.
 * 
 * It must be used in a class that extends the {@see PhpXmlSchema\Test\Unit\Dom\AbstractElementTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait MaxOccursAttributeTestCaseTrait
{
     /**
     * Tests that hasMaxnOccurs() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   elt-attribute
     */
    public function testHasMaxOccurs()
    {
        self::assertFalse($this->sut->hasMaxOccurs(), 'The attribute has not been set.');
        
        $this->sut->setMaxOccurs($this->createNonNegativeIntegerLimitTypeDummy());
        self::assertTrue($this->sut->hasMaxOccurs(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getMaxOccurs() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   elt-attribute
     */
    public function testGetMaxOccurs()
    {
        self::assertNull($this->sut->getMaxOccurs(), 'The attribute has not been set.');
        
        $nnil1 = $this->createNonNegativeIntegerLimitTypeDummy();
        $this->sut->setMaxOccurs($nnil1);
        self::assertSame($nnil1, $this->sut->getMaxOccurs(), 'Set the attribute with a value: NonNegativeIntegerLimitType.');
        
        $nnil2 = $this->createNonNegativeIntegerLimitTypeDummy();
        $this->sut->setMaxOccurs($nnil2);
        self::assertSame($nnil2, $this->sut->getMaxOccurs(), 'Set the attribute with another value: NonNegativeIntegerLimitType.');
    }
}
