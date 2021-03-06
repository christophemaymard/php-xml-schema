<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\ElementId;
use PhpXmlSchema\Dom\ListElement;
use PhpXmlSchema\Dom\SimpleTypeElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\ListElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ListElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new ListElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetElementIdReturnsSpecificElementIdConstant(): void
    {
        self::assertSame(ElementId::ELT_LIST, $this->sut->getElementId());
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SimpleTypeElement.
     * 
     * @group   content
     */
    public function testListElementWhenAddedToSimpleTypeElement(): void
    {
        $parent = new SimpleTypeElement();
        $parent->setDerivationElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SimpleTypeElement::setDerivationElement().
     * 
     * @group   content
     */
    public function testListElementWithParentThrowsExceptionWhenSimpleTypeElementSetDerivationElement(): void
    {
        $parent1 = new SimpleTypeElement();
        $parent1->setDerivationElement($this->sut);
        
        $parent2 = new SimpleTypeElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->setDerivationElement($this->sut);
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a SimpleTypeElement element, and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testLookupNamespaceReturnsStringWhenAddedToSimpleTypeElementAndParentPrefixBoundToNamespace(): void
    {
        $parent = new SimpleTypeElement();
        $parent->setDerivationElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
}
