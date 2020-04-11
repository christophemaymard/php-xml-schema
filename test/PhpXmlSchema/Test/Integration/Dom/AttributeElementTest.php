<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\AttributeElement;
use PhpXmlSchema\Dom\AttributeNamingElementInterface;
use PhpXmlSchema\Dom\ElementId;
use PhpXmlSchema\Dom\SchemaElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\AttributeElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AttributeElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new AttributeElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetElementIdReturnsSpecificElementIdConstant(): void
    {
        self::assertSame(ElementId::ELT_ATTRIBUTE, $this->sut->getElementId());
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * AttributeNamingElementInterface.
     * 
     * @param   AttributeNamingElementInterface $parent The parent element to use for the test.
     * 
     * @dataProvider    getAllAttributeNamingElementValues
     * 
     * @group   content
     */
    public function testAttributeElementWhenAddedToAttributeNamingElement(
        AttributeNamingElementInterface $parent
    ): void
    {
        $parent->addAttributeElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with AttributeNamingElementInterface::addAttributeElement().
     * 
     * @param   AttributeNamingElementInterface $parent1    The first parent element to use for the test.
     * @param   AttributeNamingElementInterface $parent2    The second parent element to use for the test.
     * 
     * @dataProvider    getAllAttributeNamingElementParentValues
     * 
     * @group   content
     */
    public function testAttributeElementWithParentThrowsExceptionWhenAttributeNamingElementAddAttributeElement(
        AttributeNamingElementInterface $parent1,
        AttributeNamingElementInterface $parent2
    ): void
    {
        $parent1->addAttributeElement($this->sut);
        
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addAttributeElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SchemaElement.
     * 
     * @group   content
     */
    public function testAttributeElementWhenAddedToSchemaElement(): void
    {
        $parent = new SchemaElement();
        $parent->addAttributeElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SchemaElement::addAttributeElement().
     * 
     * @group   content
     */
    public function testAttributeElementWithParentThrowsExceptionWhenSchemaElementAddAttributeElement(): void
    {
        $parent1 = new SchemaElement();
        $parent1->addAttributeElement($this->sut);
        
        $parent2 = new SchemaElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addAttributeElement($this->sut);
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a AttributeNamingElementInterface element, and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @param   AttributeNamingElementInterface $parent The parent element to use for the test.
     * 
     * @group           namespace
     * @group           xml
     * @dataProvider    getAllAttributeNamingElementValues
     */
    public function testLookupNamespaceReturnsStringWhenAddedToAttributeNamingElementAndParentPrefixBoundToNamespace(
        AttributeNamingElementInterface $parent
    ): void
    {
        $parent->addAttributeElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a SchemaElement element, and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testLookupNamespaceReturnsStringWhenAddedToSchemaElementAndParentPrefixBoundToNamespace(): void
    {
        $parent = new SchemaElement();
        $parent->addAttributeElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
}
