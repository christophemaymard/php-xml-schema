<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\AllElement;
use PhpXmlSchema\Dom\ChoiceElement;
use PhpXmlSchema\Dom\ElementElement;
use PhpXmlSchema\Dom\ElementId;
use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SequenceElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\ElementElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ElementElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new ElementElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetElementIdReturnsSpecificElementIdConstant()
    {
        self::assertSame(ElementId::ELT_ELEMENT, $this->sut->getElementId());
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * AllElement.
     * 
     * @group   content
     */
    public function testElementElementWhenAddedToAllElement()
    {
        $parent = new AllElement();
        $parent->addElementElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with AllElement::addElementElement().
     * 
     * @group   content
     */
    public function testElementElementWithParentThrowsExceptionWhenAllElementAddElementElement()
    {
        $parent1 = new AllElement();
        $parent1->addElementElement($this->sut);
        
        $parent2 = new AllElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addElementElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * ChoiceElement.
     * 
     * @group   content
     */
    public function testElementElementWhenAddedToChoiceElement()
    {
        $parent = new ChoiceElement();
        $parent->addElementElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with ChoiceElement::addElementElement().
     * 
     * @group   content
     */
    public function testElementElementWithParentThrowsExceptionWhenChoiceElementAddElementElement()
    {
        $parent1 = new ChoiceElement();
        $parent1->addElementElement($this->sut);
        
        $parent2 = new ChoiceElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addElementElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SchemaElement.
     * 
     * @group   content
     */
    public function testElementElementWhenAddedToSchemaElement()
    {
        $parent = new SchemaElement();
        $parent->addElementElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SchemaElement::addElementElement().
     * 
     * @group   content
     */
    public function testElementElementWithParentThrowsExceptionWhenSchemaElementAddElementElement()
    {
        $parent1 = new SchemaElement();
        $parent1->addElementElement($this->sut);
        
        $parent2 = new SchemaElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addElementElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SequenceElement.
     * 
     * @group   content
     */
    public function testElementElementWhenAddedToSequenceElement()
    {
        $parent = new SequenceElement();
        $parent->addElementElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SequenceElement::addElementElement().
     * 
     * @group   content
     */
    public function testElementElementWithParentThrowsExceptionWhenSequenceElementAddElementElement()
    {
        $parent1 = new SequenceElement();
        $parent1->addElementElement($this->sut);
        
        $parent2 = new SequenceElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addElementElement($this->sut);
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a AllElement element, and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testLookupNamespaceReturnsStringWhenAddedToAllElementAndParentPrefixBoundToNamespace()
    {
        $parent = new AllElement();
        $parent->addElementElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a ChoiceElement element, and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testLookupNamespaceReturnsStringWhenAddedToChoiceElementAndParentPrefixBoundToNamespace()
    {
        $parent = new ChoiceElement();
        $parent->addElementElement($this->sut);
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
    public function testLookupNamespaceReturnsStringWhenAddedToSchemaElementAndParentPrefixBoundToNamespace()
    {
        $parent = new SchemaElement();
        $parent->addElementElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a SequenceElement element, and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testLookupNamespaceReturnsStringWhenAddedToSequenceElementAndParentPrefixBoundToNamespace()
    {
        $parent = new SequenceElement();
        $parent->addElementElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
}
