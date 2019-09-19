<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

use PhpXmlSchema\Exception\InvalidOperationException;

/**
 * Represents the unit tests for testing bindNamespace().
 * 
 * It must be used in a class that extends the 
 * {@see PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder\AbstractSchemaElementBuilderTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait BindNamespaceTestTrait
{
    /**
     * Tests that bindNamespace() associates the prefix with a namespace.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testBindNamespaceAssociatesPrefixWithNamespace()
    {
        $this->sut->bindNamespace('foo', 'http://example.org/foo');
        $sch = $this->sut->getSchema();
        
        static::assertAncestorsNotChanged($sch);
        self::assertCurrentElementHasNotAttribute($sch);
        $elt = static::getCurrentElement($sch);
        self::assertSame('http://example.org/foo', $elt->lookupNamespace('foo'));        
    }
    
    /**
     * Tests that bindNamespace() throws an exception when the 'xml' prefix 
     * is bound to a namespace other than the XML 1.0 namespace.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testBindNamespaceThrowsExceptionWhenBindingXmlPrefixToNamespaceOtherXml10()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('"xml" prefix can be bound only to '.
            '"http://www.w3.org/XML/1998/namespace" and not "http://example.org".');
        
        $this->sut->bindNamespace('xml', 'http://example.org');
    }
    
    /**
     * Tests that bindNamespace() throws an exception when the prefix, other 
     * than 'xml', is bound to XML 1.0 namespace.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testBindNamespaceThrowsExceptionWhenBindingOtherPrefixToNamespaceXml10()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('"foo" prefix cannot be bound to '.
            '"http://www.w3.org/XML/1998/namespace".');
        
        $this->sut->bindNamespace('foo', 'http://www.w3.org/XML/1998/namespace');
    }
    
    /**
     * Tests that bindNamespace() throws an exception when the prefix is 
     * 'xmlns'.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testBindNamespaceThrowsExceptionWhenPrefixIsXmlns()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('"xmlns" prefix is reserved.');
        
        $this->sut->bindNamespace('xmlns', 'http://www.w3.org/2000/xmlns/');
    }
    
    /**
     * Tests that bindNamespace() throws an exception when the prefix, other 
     * than 'xmlns', is bound to XML NS 1.0 namespace.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testBindNamespaceThrowsExceptionWhenBindingOtherPrefixToNamespaceXmlns10()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('"foo" prefix cannot be bound to '.
            '"http://www.w3.org/2000/xmlns/".');
        
        $this->sut->bindNamespace('foo', 'http://www.w3.org/2000/xmlns/');
    }
}
