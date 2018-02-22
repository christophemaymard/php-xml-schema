<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the base clas to unit test a facet element that holds the 
 * "fixed" attribute.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractFixedFacetElementTestCase extends AbstractAnnotatedElementTestCase
{
    /**
     * Tests that hasFixed() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   elt-attribute
     */
    public function testHasFixed()
    {
        self::assertFalse($this->sut->hasFixed(), 'The attribute has not been set.');
        
        $this->sut->setFixed(TRUE);
        self::assertTrue($this->sut->hasFixed(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getFixed() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   elt-attribute
     */
    public function testGetFixed()
    {
        self::assertNull($this->sut->getFixed(), 'The attribute has not been set.');
        
        $this->sut->setFixed(TRUE);
        self::assertTrue($this->sut->getFixed(), 'Set the attribute with a value: TRUE.');
        
        $this->sut->setFixed(FALSE);
        self::assertFalse($this->sut->getFixed(), 'Set the attribute with another value: FALSE.');
    }
}
