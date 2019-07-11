<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the unit tests for the "minOccurs" attribute in a XML schema 
 * element.
 * 
 * It must be used in a class that extends the {@see PhpXmlSchema\Test\Unit\Dom\AbstractElementTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait MinOccursAttributeTestCaseTrait
{
     /**
     * Tests that hasMinOccurs() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasMinOccurs()
    {
        self::assertFalse($this->sut->hasMinOccurs(), 'The attribute has not been set.');
        
        $this->sut->setMinOccurs($this->createNonNegativeIntegerTypeDummy());
        self::assertTrue($this->sut->hasMinOccurs(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getMinOccurs() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetMinOccurs()
    {
        self::assertNull($this->sut->getMinOccurs(), 'The attribute has not been set.');
        
        $nni1 = $this->createNonNegativeIntegerTypeDummy();
        $this->sut->setMinOccurs($nni1);
        self::assertSame($nni1, $this->sut->getMinOccurs(), 'Set the attribute with a value: NonNegativeIntegerType.');
        
        $nni2 = $this->createNonNegativeIntegerTypeDummy();
        $this->sut->setMinOccurs($nni2);
        self::assertSame($nni2, $this->sut->getMinOccurs(), 'Set the attribute with another value: NonNegativeIntegerType.');
    }
}
