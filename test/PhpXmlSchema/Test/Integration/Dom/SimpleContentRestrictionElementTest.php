<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\ElementId;
use PhpXmlSchema\Dom\SimpleContentElement;
use PhpXmlSchema\Dom\SimpleContentRestrictionElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\SimpleContentRestrictionElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleContentRestrictionElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SimpleContentRestrictionElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetElementIdReturnsSpecificElementIdConstant()
    {
        self::assertSame(ElementId::ELT_SIMPLECONTENT_RESTRICTION, $this->sut->getElementId());
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SimpleContentElement.
     * 
     * @group   content
     */
    public function testSimpleContentRestrictionElementWhenAddedToSimpleContentElement()
    {
        $parent = new SimpleContentElement();
        $parent->setDerivationElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SimpleContentElement::setDerivationElement().
     * 
     * @group   content
     */
    public function testSimpleContentRestrictionElementWithParentThrowsExceptionWhenSimpleContentElementSetDerivationElement()
    {
        $parent1 = new SimpleContentElement();
        $parent1->setDerivationElement($this->sut);
        
        $parent2 = new SimpleContentElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->setDerivationElement($this->sut);
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a SimpleContentElement element, and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testLookupNamespaceReturnsStringWhenAddedToSimpleContentElementAndParentPrefixBoundToNamespace()
    {
        $parent = new SimpleContentElement();
        $parent->setDerivationElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
}
