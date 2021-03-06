<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\ElementId;
use PhpXmlSchema\Dom\ElementElement;
use PhpXmlSchema\Dom\UniqueElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\UniqueElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class UniqueElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new UniqueElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetElementIdReturnsSpecificElementIdConstant(): void
    {
        self::assertSame(ElementId::ELT_UNIQUE, $this->sut->getElementId());
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * ElementElement.
     * 
     * @group   content
     */
    public function testUniqueElementWhenAddedToElementElement(): void
    {
        $parent = new ElementElement();
        $parent->addUniqueElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with ElementElement::addUniqueElement().
     * 
     * @group   content
     */
    public function testUniqueElementWithParentThrowsExceptionWhenElementElementAddUniqueElement(): void
    {
        $parent1 = new ElementElement();
        $parent1->addUniqueElement($this->sut);
        
        $parent2 = new ElementElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addUniqueElement($this->sut);
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
        $parent->addUniqueElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
}
