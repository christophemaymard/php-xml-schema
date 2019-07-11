<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the unit tests for the "name" attribute in a XML schema 
 * element.
 * 
 * It must be used in a class that extends the {@see PhpXmlSchema\Test\Unit\Dom\AbstractElementTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait NameAttributeTestCaseTrait
{
    /**
     * Tests that hasName() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasName()
    {
        self::assertFalse($this->sut->hasName(), 'The attribute has not been set.');
        
        $this->sut->setName($this->createNCNameTypeDummy());
        self::assertTrue($this->sut->hasName(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getName() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetName()
    {
        self::assertNull($this->sut->getName(), 'The attribute has not been set.');
        
        $value1 = $this->createNCNameTypeDummy();
        $this->sut->setName($value1);
        self::assertSame($value1, $this->sut->getName(), 'Set the attribute with a value: NCNameType.');
        
        $value2 = $this->createNCNameTypeDummy();
        $this->sut->setName($value2);
        self::assertSame($value2, $this->sut->getName(), 'Set the attribute with another value: NCNameType.');
    }
}