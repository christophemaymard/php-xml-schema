<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\ElementId;
use PhpXmlSchema\Dom\MaxExclusiveElement;
use PhpXmlSchema\Dom\SimpleContentRestrictionElement;
use PhpXmlSchema\Dom\SimpleTypeRestrictionElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\MaxExclusiveElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class MaxExclusiveElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new MaxExclusiveElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetElementIdReturnsSpecificElementIdConstant(): void
    {
        self::assertSame(ElementId::ELT_MAXEXCLUSIVE, $this->sut->getElementId());
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SimpleContentRestrictionElement.
     * 
     * @group   content
     */
    public function testMaxExclusiveElementWhenAddedToSimpleContentRestrictionElement(): void
    {
        $parent = new SimpleContentRestrictionElement();
        $parent->addMaxExclusiveElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SimpleContentRestrictionElement::addMaxExclusiveElement().
     * 
     * @group   content
     */
    public function testMaxExclusiveElementWithParentThrowsExceptionWhenSimpleContentRestrictionElementAddMaxExclusiveElement(): void
    {
        $parent1 = new SimpleContentRestrictionElement();
        $parent1->addMaxExclusiveElement($this->sut);
        
        $parent2 = new SimpleContentRestrictionElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addMaxExclusiveElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SimpleTypeRestrictionElement.
     * 
     * @group   content
     */
    public function testMaxExclusiveElementWhenAddedToSimpleTypeRestrictionElement(): void
    {
        $parent = new SimpleTypeRestrictionElement();
        $parent->addMaxExclusiveElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SimpleTypeRestrictionElement::addMaxExclusiveElement().
     * 
     * @group   content
     */
    public function testMaxExclusiveElementWithParentThrowsExceptionWhenSimpleTypeRestrictionElementAddMaxExclusiveElement(): void
    {
        $parent1 = new SimpleTypeRestrictionElement();
        $parent1->addMaxExclusiveElement($this->sut);
        
        $parent2 = new SimpleTypeRestrictionElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addMaxExclusiveElement($this->sut);
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a SimpleContentRestrictionElement element, and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testLookupNamespaceReturnsStringWhenAddedToSimpleContentRestrictionElementAndParentPrefixBoundToNamespace(): void
    {
        $parent = new SimpleContentRestrictionElement();
        $parent->addMaxExclusiveElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a SimpleTypeRestrictionElement element, and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testLookupNamespaceReturnsStringWhenAddedToSimpleTypeRestrictionElementAndParentPrefixBoundToNamespace(): void
    {
        $parent = new SimpleTypeRestrictionElement();
        $parent->addMaxExclusiveElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
}
