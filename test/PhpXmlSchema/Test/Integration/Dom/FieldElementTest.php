<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\ElementId;
use PhpXmlSchema\Dom\FieldElement;
use PhpXmlSchema\Dom\KeyElement;
use PhpXmlSchema\Dom\KeyRefElement;
use PhpXmlSchema\Dom\UniqueElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\FieldElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class FieldElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new FieldElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetElementIdReturnsSpecificElementIdConstant(): void
    {
        self::assertSame(ElementId::ELT_FIELD, $this->sut->getElementId());
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * KeyElement.
     * 
     * @group   content
     */
    public function testFieldElementWhenAddedToKeyElement(): void
    {
        $parent = new KeyElement();
        $parent->addFieldElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with KeyElement::addFieldElement().
     * 
     * @group   content
     */
    public function testFieldElementWithParentThrowsExceptionWhenKeyElementAddFieldElement(): void
    {
        $parent1 = new KeyElement();
        $parent1->addFieldElement($this->sut);
        
        $parent2 = new KeyElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addFieldElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * KeyRefElement.
     * 
     * @group   content
     */
    public function testFieldElementWhenAddedToKeyRefElement(): void
    {
        $parent = new KeyRefElement();
        $parent->addFieldElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with KeyRefElement::addFieldElement().
     * 
     * @group   content
     */
    public function testFieldElementWithParentThrowsExceptionWhenKeyRefElementAddFieldElement(): void
    {
        $parent1 = new KeyRefElement();
        $parent1->addFieldElement($this->sut);
        
        $parent2 = new KeyRefElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addFieldElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * UniqueElement.
     * 
     * @group   content
     */
    public function testFieldElementWhenAddedToUniqueElement(): void
    {
        $parent = new UniqueElement();
        $parent->addFieldElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with UniqueElement::addFieldElement().
     * 
     * @group   content
     */
    public function testFieldElementWithParentThrowsExceptionWhenUniqueElementAddFieldElement(): void
    {
        $parent1 = new UniqueElement();
        $parent1->addFieldElement($this->sut);
        
        $parent2 = new UniqueElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addFieldElement($this->sut);
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a KeyElement element, and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testLookupNamespaceReturnsStringWhenAddedToKeyElementAndParentPrefixBoundToNamespace(): void
    {
        $parent = new KeyElement();
        $parent->addFieldElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a KeyRefElement element, and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testLookupNamespaceReturnsStringWhenAddedToKeyRefElementAndParentPrefixBoundToNamespace(): void
    {
        $parent = new KeyRefElement();
        $parent->addFieldElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a UniqueElement element, and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testLookupNamespaceReturnsStringWhenAddedToUniqueElementAndParentPrefixBoundToNamespace(): void
    {
        $parent = new UniqueElement();
        $parent->addFieldElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
}
