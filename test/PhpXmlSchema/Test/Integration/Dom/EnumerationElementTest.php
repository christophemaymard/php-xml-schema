<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\EnumerationElement;
use PhpXmlSchema\Dom\SimpleContentRestrictionElement;
use PhpXmlSchema\Dom\SimpleTypeRestrictionElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\EnumerationElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class EnumerationElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new EnumerationElement();
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SimpleContentRestrictionElement.
     * 
     * @group   content
     */
    public function testEnumerationElementWhenAddedToSimpleContentRestrictionElement()
    {
        $parent = new SimpleContentRestrictionElement();
        $parent->addEnumerationElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SimpleContentRestrictionElement::addEnumerationElement().
     * 
     * @group   content
     */
    public function testEnumerationElementWithParentThrowsExceptionWhenSimpleContentRestrictionElementAddEnumerationElement()
    {
        $parent1 = new SimpleContentRestrictionElement();
        $parent1->addEnumerationElement($this->sut);
        
        $parent2 = new SimpleContentRestrictionElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addEnumerationElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SimpleTypeRestrictionElement.
     * 
     * @group   content
     */
    public function testEnumerationElementWhenAddedToSimpleTypeRestrictionElement()
    {
        $parent = new SimpleTypeRestrictionElement();
        $parent->addEnumerationElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SimpleTypeRestrictionElement::addEnumerationElement().
     * 
     * @group   content
     */
    public function testEnumerationElementWithParentThrowsExceptionWhenSimpleTypeRestrictionElementAddEnumerationElement()
    {
        $parent1 = new SimpleTypeRestrictionElement();
        $parent1->addEnumerationElement($this->sut);
        
        $parent2 = new SimpleTypeRestrictionElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addEnumerationElement($this->sut);
    }
}
