<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\ElementElement;
use PhpXmlSchema\Dom\KeyElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\KeyElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class KeyElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new KeyElement();
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * ElementElement.
     * 
     * @group   content
     */
    public function testKeyElementWhenAddedToElementElement()
    {
        $parent = new ElementElement();
        $parent->addKeyElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with ElementElement::addKeyElement().
     * 
     * @group   content
     */
    public function testKeyElementWithParentThrowsExceptionWhenElementElementAddKeyElement()
    {
        $parent1 = new ElementElement();
        $parent1->addKeyElement($this->sut);
        
        $parent2 = new ElementElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addKeyElement($this->sut);
    }
}
