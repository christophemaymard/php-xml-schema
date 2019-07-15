<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\ElementElement;
use PhpXmlSchema\Dom\KeyRefElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\KeyRefElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class KeyRefElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new KeyRefElement();
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * ElementElement.
     * 
     * @group   content
     */
    public function testKeyRefElementWhenAddedToElementElement()
    {
        $parent = new ElementElement();
        $parent->addKeyRefElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with ElementElement::addKeyRefElement().
     * 
     * @group   content
     */
    public function testKeyRefElementWithParentThrowsExceptionWhenElementElementAddKeyRefElement()
    {
        $parent1 = new ElementElement();
        $parent1->addKeyRefElement($this->sut);
        
        $parent2 = new ElementElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addKeyRefElement($this->sut);
    }
}
