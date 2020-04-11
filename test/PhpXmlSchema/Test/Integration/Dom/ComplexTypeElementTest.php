<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\ComplexTypeElement;
use PhpXmlSchema\Dom\ElementElement;
use PhpXmlSchema\Dom\ElementId;
use PhpXmlSchema\Dom\RedefineElement;
use PhpXmlSchema\Dom\SchemaElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\ComplexTypeElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ComplexTypeElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new ComplexTypeElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetElementIdReturnsSpecificElementIdConstant(): void
    {
        self::assertSame(ElementId::ELT_COMPLEXTYPE, $this->sut->getElementId());
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * ElementElement.
     * 
     * @group   content
     */
    public function testComplexTypeElementWhenAddedToElementElement(): void
    {
        $parent = new ElementElement();
        $parent->setTypeElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with ElementElement::setTypeElement().
     * 
     * @group   content
     */
    public function testComplexTypeElementWithParentThrowsExceptionWhenElementElementSetTypeElement(): void
    {
        $parent1 = new ElementElement();
        $parent1->setTypeElement($this->sut);
        
        $parent2 = new ElementElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->setTypeElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * RedefineElement.
     * 
     * @group   content
     */
    public function testComplexTypeElementWhenAddedToRedefineElement(): void
    {
        $parent = new RedefineElement();
        $parent->addComplexTypeElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with RedefineElement::addComplexTypeElement().
     * 
     * @group   content
     */
    public function testComplexTypeElementWithParentThrowsExceptionWhenRedefineElementAddComplexTypeElement(): void
    {
        $parent1 = new RedefineElement();
        $parent1->addComplexTypeElement($this->sut);
        
        $parent2 = new RedefineElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addComplexTypeElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SchemaElement.
     * 
     * @group   content
     */
    public function testComplexTypeElementWhenAddedToSchemaElement(): void
    {
        $parent = new SchemaElement();
        $parent->addComplexTypeElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SchemaElement::addComplexTypeElement().
     * 
     * @group   content
     */
    public function testComplexTypeElementWithParentThrowsExceptionWhenSchemaElementAddComplexTypeElement(): void
    {
        $parent1 = new SchemaElement();
        $parent1->addComplexTypeElement($this->sut);
        
        $parent2 = new SchemaElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addComplexTypeElement($this->sut);
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a ElementElement element, and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testLookupNamespaceReturnsStringWhenAddedToElementElementAndParentPrefixBoundToNamespace(): void
    {
        $parent = new ElementElement();
        $parent->setTypeElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a RedefineElement element, and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testLookupNamespaceReturnsStringWhenAddedToRedefineElementAndParentPrefixBoundToNamespace(): void
    {
        $parent = new RedefineElement();
        $parent->addComplexTypeElement($this->sut);
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
        $parent->addComplexTypeElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
}
