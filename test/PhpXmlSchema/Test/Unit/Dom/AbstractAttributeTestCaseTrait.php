<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the unit tests for the "abstract" attribute in a XML schema 
 * element.
 * 
 * It must be used in a class that extends the {@see PhpXmlSchema\Test\Unit\Dom\AbstractElementTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait AbstractAttributeTestCaseTrait
{
    /**
     * Tests that hasAbstract() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   elt-attribute
     */
    public function testHasAbstract()
    {
        self::assertFalse($this->sut->hasAbstract(), 'The attribute has not been set.');
        
        $this->sut->setAbstract(TRUE);
        self::assertTrue($this->sut->hasAbstract(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getAbstract() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   elt-attribute
     */
    public function testGetAbstract()
    {
        self::assertNull($this->sut->getAbstract(), 'The attribute has not been set.');
        
        $this->sut->setAbstract(TRUE);
        self::assertTrue($this->sut->getAbstract(), 'Set the attribute with a value: TRUE.');
        
        $this->sut->setAbstract(FALSE);
        self::assertFalse($this->sut->getAbstract(), 'Set the attribute with another value: FALSE.');
    }
}
