<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the unit tests for the "base" attribute in a XML schema element.
 * 
 * It must be used in a class that extends the {@see PhpXmlSchema\Test\Unit\Dom\AbstractAbstractElementTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait BaseAttributeTestCaseTrait
{
    /**
     * Tests that hasBase() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasBase()
    {
        self::assertFalse($this->sut->hasBase(), 'The attribute has not been set.');
        
        $this->sut->setBase($this->createQNameTypeDummy());
        self::assertTrue($this->sut->hasBase(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getBase() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetBase()
    {
        self::assertNull($this->sut->getBase(), 'The attribute has not been set.');
        
        $qname1 = $this->createQNameTypeDummy();
        $this->sut->setBase($qname1);
        self::assertSame($qname1, $this->sut->getBase(), 'Set the attribute with a value: QNameType.');
        
        $qname2 = $this->createQNameTypeDummy();
        $this->sut->setBase($qname2);
        self::assertSame($qname2, $this->sut->getBase(), 'Set the attribute with another value: QNameType.');
    }
}
