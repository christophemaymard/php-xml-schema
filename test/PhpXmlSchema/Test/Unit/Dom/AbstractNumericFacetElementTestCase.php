<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the base class to unit test a fixed facet element that holds 
 * the "value" attribute (nonNegativeInteger).
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractNumericFacetElementTestCase extends AbstractFixedFacetElementTestCase
{
     /**
     * Tests that hasValue() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   elt-attribute
     */
    public function testHasValue()
    {
        self::assertFalse($this->sut->hasValue(), 'The attribute has not been set.');
        
        $this->sut->setValue($this->createNonNegativeIntegerTypeDummy());
        self::assertTrue($this->sut->hasValue(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getValue() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   elt-attribute
     */
    public function testGetValue()
    {
        self::assertNull($this->sut->getValue(), 'The attribute has not been set.');
        
        $nni1 = $this->createNonNegativeIntegerTypeDummy();
        $this->sut->setValue($nni1);
        self::assertSame($nni1, $this->sut->getValue(), 'Set the attribute with a value: NonNegativeIntegerType.');
        
        $nni2 = $this->createNonNegativeIntegerTypeDummy();
        $this->sut->setValue($nni2);
        self::assertSame($nni2, $this->sut->getValue(), 'Set the attribute with another value: NonNegativeIntegerType.');
    }
}
