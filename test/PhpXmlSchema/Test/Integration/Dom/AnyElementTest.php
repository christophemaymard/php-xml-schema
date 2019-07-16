<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\AnyElement;
use PhpXmlSchema\Dom\ChoiceElement;
use PhpXmlSchema\Dom\ElementId;
use PhpXmlSchema\Dom\SequenceElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\AnyElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AnyElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new AnyElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetElementIdReturnsSpecificElementIdConstant()
    {
        self::assertSame(ElementId::ELT_ANY, $this->sut->getElementId());
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * ChoiceElement.
     * 
     * @group   content
     */
    public function testAnyElementWhenAddedToChoiceElement()
    {
        $parent = new ChoiceElement();
        $parent->addAnyElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with ChoiceElement::addAnyElement().
     * 
     * @group   content
     */
    public function testAnyElementWithParentThrowsExceptionWhenChoiceElementAddAnyElement()
    {
        $parent1 = new ChoiceElement();
        $parent1->addAnyElement($this->sut);
        
        $parent2 = new ChoiceElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addAnyElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SequenceElement.
     * 
     * @group   content
     */
    public function testAnyElementWhenAddedToSequenceElement()
    {
        $parent = new SequenceElement();
        $parent->addAnyElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SequenceElement::addAnyElement().
     * 
     * @group   content
     */
    public function testAnyElementWithParentThrowsExceptionWhenSequenceElementAddAnyElement()
    {
        $parent1 = new SequenceElement();
        $parent1->addAnyElement($this->sut);
        
        $parent2 = new SequenceElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addAnyElement($this->sut);
    }
}
