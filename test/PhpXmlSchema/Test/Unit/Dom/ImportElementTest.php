<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\ImportElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\ImportElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ImportElementTest extends AbstractAnnotatedElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new ImportElement();
    }
    
    /**
     * Tests that hasNamespace() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   elt-attribute
     */
    public function testHasNamespace()
    {
        self::assertFalse($this->sut->hasNamespace(), 'The attribute has not been set.');
        
        $this->sut->setNamespace($this->createAnyUriTypeDummy());
        self::assertTrue($this->sut->hasNamespace(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getNamespace() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   elt-attribute
     */
    public function testGetNamespace()
    {
        self::assertNull($this->sut->getNamespace(), 'The attribute has not been set.');
        
        $value1 = $this->createAnyUriTypeDummy();
        $this->sut->setNamespace($value1);
        self::assertSame($value1, $this->sut->getNamespace(), 'Set the attribute with a value: AnyUriType.');
        
        $value2 = $this->createAnyUriTypeDummy();
        $this->sut->setNamespace($value2);
        self::assertSame($value2, $this->sut->getNamespace(), 'Set the attribute with another value: AnyUriType.');
    }
    
    /**
     * Tests that hasSchemaLocation() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   elt-attribute
     */
    public function testHasSchemaLocation()
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
     * @group   elt-attribute
     */
    public function testGetSchemaLocation()
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
