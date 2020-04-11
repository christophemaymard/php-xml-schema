<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the unit tests for the "mixed" attribute in a XML schema 
 * element.
 * 
 * It must be used in a class that extends the {@see PhpXmlSchema\Test\Unit\Dom\AbstractAbstractElementTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait MixedAttributeTestCaseTrait
{
    /**
     * Tests that hasMixed() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasMixed(): void
    {
        self::assertFalse($this->sut->hasMixed(), 'The attribute has not been set.');
        
        $this->sut->setMixed(TRUE);
        self::assertTrue($this->sut->hasMixed(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getMixed() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetMixed(): void
    {
        self::assertNull($this->sut->getMixed(), 'The attribute has not been set.');
        
        $this->sut->setMixed(TRUE);
        self::assertTrue($this->sut->getMixed(), 'Set the attribute with a value: TRUE.');
        
        $this->sut->setMixed(FALSE);
        self::assertFalse($this->sut->getMixed(), 'Set the attribute with another value: FALSE.');
    }
}
