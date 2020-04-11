<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the unit tests for the "namespace" attribute in a XML schema 
 * element.
 * 
 * It must be used in a class that extends the {@see PhpXmlSchema\Test\Unit\Dom\AbstractAbstractElementTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait NamespaceAttributeTestCaseTrait
{
    /**
     * Tests that hasNamespace() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasNamespace(): void
    {
        self::assertFalse($this->sut->hasNamespace(), 'The attribute has not been set.');
        
        $this->sut->setNamespace($this->createNamespaceListTypeDummy());
        self::assertTrue($this->sut->hasNamespace(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getNamespace() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetNamespace(): void
    {
        self::assertNull($this->sut->getNamespace(), 'The attribute has not been set.');
        
        $nsl1 = $this->createNamespaceListTypeDummy();
        $this->sut->setNamespace($nsl1);
        self::assertSame($nsl1, $this->sut->getNamespace(), 'Set the attribute with a value: NamespaceListType.');
        
        $nsl2 = $this->createNamespaceListTypeDummy();
        $this->sut->setNamespace($nsl2);
        self::assertSame($nsl2, $this->sut->getNamespace(), 'Set the attribute with another value: NamespaceListType.');
    }
}
