<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\MaxInclusiveElement;
use PhpXmlSchema\Dom\SimpleContentRestrictionElement;
use PhpXmlSchema\Dom\SimpleTypeRestrictionElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\MaxInclusiveElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class MaxInclusiveElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new MaxInclusiveElement();
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SimpleContentRestrictionElement.
     * 
     * @group   content
     */
    public function testMaxInclusiveElementWhenAddedToSimpleContentRestrictionElement()
    {
        $parent = new SimpleContentRestrictionElement();
        $parent->addMaxInclusiveElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SimpleContentRestrictionElement::addMaxInclusiveElement().
     * 
     * @group   content
     */
    public function testMaxInclusiveElementWithParentThrowsExceptionWhenSimpleContentRestrictionElementAddMaxInclusiveElement()
    {
        $parent1 = new SimpleContentRestrictionElement();
        $parent1->addMaxInclusiveElement($this->sut);
        
        $parent2 = new SimpleContentRestrictionElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addMaxInclusiveElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SimpleTypeRestrictionElement.
     * 
     * @group   content
     */
    public function testMaxInclusiveElementWhenAddedToSimpleTypeRestrictionElement()
    {
        $parent = new SimpleTypeRestrictionElement();
        $parent->addMaxInclusiveElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SimpleTypeRestrictionElement::addMaxInclusiveElement().
     * 
     * @group   content
     */
    public function testMaxInclusiveElementWithParentThrowsExceptionWhenSimpleTypeRestrictionElementAddMaxInclusiveElement()
    {
        $parent1 = new SimpleTypeRestrictionElement();
        $parent1->addMaxInclusiveElement($this->sut);
        
        $parent2 = new SimpleTypeRestrictionElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addMaxInclusiveElement($this->sut);
    }
}
