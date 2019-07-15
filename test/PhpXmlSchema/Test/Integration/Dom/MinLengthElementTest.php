<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\MinLengthElement;
use PhpXmlSchema\Dom\SimpleContentRestrictionElement;
use PhpXmlSchema\Dom\SimpleTypeRestrictionElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\MinLengthElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class MinLengthElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new MinLengthElement();
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SimpleContentRestrictionElement.
     * 
     * @group   content
     */
    public function testMinLengthElementWhenAddedToSimpleContentRestrictionElement()
    {
        $parent = new SimpleContentRestrictionElement();
        $parent->addMinLengthElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SimpleContentRestrictionElement::addMinLengthElement().
     * 
     * @group   content
     */
    public function testMinLengthElementWithParentThrowsExceptionWhenSimpleContentRestrictionElementAddMinLengthElement()
    {
        $parent1 = new SimpleContentRestrictionElement();
        $parent1->addMinLengthElement($this->sut);
        
        $parent2 = new SimpleContentRestrictionElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addMinLengthElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SimpleTypeRestrictionElement.
     * 
     * @group   content
     */
    public function testMinLengthElementWhenAddedToSimpleTypeRestrictionElement()
    {
        $parent = new SimpleTypeRestrictionElement();
        $parent->addMinLengthElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SimpleTypeRestrictionElement::addMinLengthElement().
     * 
     * @group   content
     */
    public function testMinLengthElementWithParentThrowsExceptionWhenSimpleTypeRestrictionElementAddMinLengthElement()
    {
        $parent1 = new SimpleTypeRestrictionElement();
        $parent1->addMinLengthElement($this->sut);
        
        $parent2 = new SimpleTypeRestrictionElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addMinLengthElement($this->sut);
    }
}
