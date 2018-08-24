<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the unit tests for the "ref" attribute in a XML schema element.
 * 
 * It must be used in a class that extends the {@see PhpXmlSchema\Test\Unit\Dom\AbstractElementTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait RefAttributeTestCaseTrait
{
    /**
     * Tests that hasRef() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   elt-attribute
     */
    public function testHasRef()
    {
        self::assertFalse($this->sut->hasRef(), 'The attribute has not been set.');
        
        $this->sut->setRef($this->createQNameTypeDummy());
        self::assertTrue($this->sut->hasRef(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getRef() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   elt-attribute
     */
    public function testGetRef()
    {
        self::assertNull($this->sut->getRef(), 'The attribute has not been set.');
        
        $qname1 = $this->createQNameTypeDummy();
        $this->sut->setRef($qname1);
        self::assertSame($qname1, $this->sut->getRef(), 'Set the attribute with a value: QNameType.');
        
        $qname2 = $this->createQNameTypeDummy();
        $this->sut->setRef($qname2);
        self::assertSame($qname2, $this->sut->getRef(), 'Set the attribute with another value: QNameType.');
    }
}
