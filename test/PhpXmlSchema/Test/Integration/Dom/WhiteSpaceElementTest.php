<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\ElementId;
use PhpXmlSchema\Dom\SimpleContentRestrictionElement;
use PhpXmlSchema\Dom\SimpleTypeRestrictionElement;
use PhpXmlSchema\Dom\WhiteSpaceElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\WhiteSpaceElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class WhiteSpaceElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new WhiteSpaceElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetElementIdReturnsSpecificElementIdConstant(): void
    {
        self::assertSame(ElementId::ELT_WHITESPACE, $this->sut->getElementId());
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SimpleContentRestrictionElement.
     * 
     * @group   content
     */
    public function testWhiteSpaceElementWhenAddedToSimpleContentRestrictionElement(): void
    {
        $parent = new SimpleContentRestrictionElement();
        $parent->addWhiteSpaceElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SimpleContentRestrictionElement::addWhiteSpaceElement().
     * 
     * @group   content
     */
    public function testWhiteSpaceElementWithParentThrowsExceptionWhenSimpleContentRestrictionElementAddWhiteSpaceElement(): void
    {
        $parent1 = new SimpleContentRestrictionElement();
        $parent1->addWhiteSpaceElement($this->sut);
        
        $parent2 = new SimpleContentRestrictionElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addWhiteSpaceElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SimpleTypeRestrictionElement.
     * 
     * @group   content
     */
    public function testWhiteSpaceElementWhenAddedToSimpleTypeRestrictionElement(): void
    {
        $parent = new SimpleTypeRestrictionElement();
        $parent->addWhiteSpaceElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SimpleTypeRestrictionElement::addWhiteSpaceElement().
     * 
     * @group   content
     */
    public function testWhiteSpaceElementWithParentThrowsExceptionWhenSimpleTypeRestrictionElementAddWhiteSpaceElement(): void
    {
        $parent1 = new SimpleTypeRestrictionElement();
        $parent1->addWhiteSpaceElement($this->sut);
        
        $parent2 = new SimpleTypeRestrictionElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addWhiteSpaceElement($this->sut);
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
        $parent->addWhiteSpaceElement($this->sut);
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
        $parent->addWhiteSpaceElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
}
