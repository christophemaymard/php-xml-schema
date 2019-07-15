<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\MaxLengthElement;
use PhpXmlSchema\Dom\SimpleContentRestrictionElement;
use PhpXmlSchema\Dom\SimpleTypeRestrictionElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\MaxLengthElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class MaxLengthElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new MaxLengthElement();
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SimpleContentRestrictionElement.
     * 
     * @group   content
     */
    public function testMaxLengthElementWhenAddedToSimpleContentRestrictionElement()
    {
        $parent = new SimpleContentRestrictionElement();
        $parent->addMaxLengthElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SimpleContentRestrictionElement::addMaxLengthElement().
     * 
     * @group   content
     */
    public function testMaxLengthElementWithParentThrowsExceptionWhenSimpleContentRestrictionElementAddMaxLengthElement()
    {
        $parent1 = new SimpleContentRestrictionElement();
        $parent1->addMaxLengthElement($this->sut);
        
        $parent2 = new SimpleContentRestrictionElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addMaxLengthElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SimpleTypeRestrictionElement.
     * 
     * @group   content
     */
    public function testMaxLengthElementWhenAddedToSimpleTypeRestrictionElement()
    {
        $parent = new SimpleTypeRestrictionElement();
        $parent->addMaxLengthElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SimpleTypeRestrictionElement::addMaxLengthElement().
     * 
     * @group   content
     */
    public function testMaxLengthElementWithParentThrowsExceptionWhenSimpleTypeRestrictionElementAddMaxLengthElement()
    {
        $parent1 = new SimpleTypeRestrictionElement();
        $parent1->addMaxLengthElement($this->sut);
        
        $parent2 = new SimpleTypeRestrictionElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addMaxLengthElement($this->sut);
    }
}
