<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\TotalDigitsElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\TotalDigitsElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TotalDigitsElementTest extends AbstractFixedFacetElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new TotalDigitsElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetLocalNameReturnsSpecificString(): void
    {
        self::assertSame('totalDigits', $this->sut->getLocalName());
    }
    
    /**
     * Tests that hasValue() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasValue(): void
    {
        self::assertFalse($this->sut->hasValue(), 'The attribute has not been set.');
        
        $this->sut->setValue($this->createPositiveIntegerTypeDummy());
        self::assertTrue($this->sut->hasValue(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getValue() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetValue(): void
    {
        self::assertNull($this->sut->getValue(), 'The attribute has not been set.');
        
        $pi1 = $this->createPositiveIntegerTypeDummy();
        $this->sut->setValue($pi1);
        self::assertSame($pi1, $this->sut->getValue(), 'Set the attribute with a value: PositiveIntegerType.');
        
        $pi2 = $this->createPositiveIntegerTypeDummy();
        $this->sut->setValue($pi2);
        self::assertSame($pi2, $this->sut->getValue(), 'Set the attribute with another value: PositiveIntegerType.');
    }
}
