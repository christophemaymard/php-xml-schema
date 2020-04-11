<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\IncludeElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\IncludeElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class IncludeElementTest extends AbstractAnnotatedElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new IncludeElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetLocalNameReturnsSpecificString(): void
    {
        self::assertSame('include', $this->sut->getLocalName());
    }
    
    /**
     * Tests that hasSchemaLocation() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasSchemaLocation(): void
    {
        self::assertFalse($this->sut->hasSchemaLocation(), 'The attribute has not been set.');
        
        $this->sut->setSchemaLocation($this->createAnyUriTypeDummy());
        self::assertTrue($this->sut->hasSchemaLocation(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getSchemaLocation() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetSchemaLocation(): void
    {
        self::assertNull($this->sut->getSchemaLocation(), 'The attribute has not been set.');
        
        $value1 = $this->createAnyUriTypeDummy();
        $this->sut->setSchemaLocation($value1);
        self::assertSame($value1, $this->sut->getSchemaLocation(), 'Set the attribute with a value: AnyUriType.');
        
        $value2 = $this->createAnyUriTypeDummy();
        $this->sut->setSchemaLocation($value2);
        self::assertSame($value2, $this->sut->getSchemaLocation(), 'Set the attribute with another value: AnyUriType.');
    }
}
