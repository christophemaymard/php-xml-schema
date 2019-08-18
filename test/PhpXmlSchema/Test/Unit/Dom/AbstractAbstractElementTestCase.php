<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\DerivationType;
use PhpXmlSchema\Dom\ElementInterface;
use PhpXmlSchema\Dom\FieldXPathType;
use PhpXmlSchema\Dom\FormType;
use PhpXmlSchema\Dom\NamespaceListType;
use PhpXmlSchema\Dom\NonNegativeIntegerLimitType;
use PhpXmlSchema\Dom\ProcessingModeType;
use PhpXmlSchema\Dom\SelectorXPathType;
use PhpXmlSchema\Dom\UseType;
use PhpXmlSchema\Dom\WhiteSpaceType;
use PhpXmlSchema\Exception\InvalidOperationException;
use PhpXmlSchema\Test\Unit\Datatype\DatatypeDummyFactoryTrait;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the base class for all the element test cases.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractAbstractElementTestCase extends TestCase
{
    use DatatypeDummyFactoryTrait;
    
    /**
     * The element to test.
     * @var ElementInterface
     */
    protected $sut;
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that getLocalName() returns a specific string.
     */
    abstract public function testGetLocalNameReturnsSpecificString();
    
    /**
     * Tests that bindNamespace() throws an exception when the 'xml' prefix 
     * is bound to a namespace other than the XML 1.0 namespace.
     * 
     * @group   namespace
     * @group   xml
     * @group   element
     * @group   dom
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
     * @group   element
     * @group   dom
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
     * @group   element
     * @group   dom
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
     * @group   element
     * @group   dom
     */
    public function testBindNamespaceThrowsExceptionWhenBindingOtherPrefixToNamespaceXmlns10()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('"foo" prefix cannot be bound to '.
            '"http://www.w3.org/2000/xmlns/".');
        
        $this->sut->bindNamespace('foo', 'http://www.w3.org/2000/xmlns/');
    }
    
    /**
     * Tests that lookupNamespace() returns NULL when the prefix is not bound 
     * to a namespace.
     * 
     * @group   namespace
     * @group   xml
     * @group   element
     * @group   dom
     */
    public function testLookupNamespaceReturnsNullWhenPrefixNotBoundToNamespace()
    {
        self::assertNull($this->sut->lookupNamespace('foo'));
    }
    
    /**
     * Tests that lookupNamespace() returns the XML 1.0 namespace when the 
     * prefix is 'xml' and is not bound to a namespace.
     * 
     * @group   namespace
     * @group   xml
     * @group   element
     * @group   dom
     */
    public function testLookupNamespaceReturnsXml10NamespaceWhenPrefixIsXmlAndNotBoundToNamespace()
    {
        self::assertSame('http://www.w3.org/XML/1998/namespace', $this->sut->lookupNamespace('xml'));
    }
    
    /**
     * Tests that lookupNamespace() returns a string when the prefix is bound 
     * to a namespace.
     * 
     * @group   namespace
     * @group   xml
     * @group   element
     * @group   dom
     */
    public function testLookupNamespaceReturnsStringWhenPrefixNotBoundToNamespace()
    {
        $this->sut->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
    
    /**
     * Tests that bindNamespace() updates the namespace when a prefix is 
     * bound to multiple namespaces.
     * 
     * @group   namespace
     * @group   xml
     * @group   element
     * @group   dom
     */
    public function testBindNamespaceUpdatesNamespaceWhenPrefixBoundMultipleNamespaces()
    {
        $this->sut->bindNamespace('foo', 'http://example.org/foo');
        $this->sut->bindNamespace('foo', 'http://example.org/newfoo');
        self::assertSame('http://example.org/newfoo', $this->sut->lookupNamespace('foo'));
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\DerivationType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createDerivationTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(DerivationType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\FieldXPathType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createFieldXPathTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(FieldXPathType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\FormType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createFormTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(FormType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\NamespaceListType} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createNamespaceListTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(NamespaceListType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\NonNegativeIntegerLimitType} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createNonNegativeIntegerLimitTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(NonNegativeIntegerLimitType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\ProcessingModeType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createProcessingModeTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(ProcessingModeType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\SelectorXPathType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createSelectorXPathTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(SelectorXPathType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\UseType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createUseTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(UseType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\WhiteSpaceType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createWhiteSpaceTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(WhiteSpaceType::class)->reveal();
    }
}
