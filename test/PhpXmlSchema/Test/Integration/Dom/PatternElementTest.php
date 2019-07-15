<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\PatternElement;
use PhpXmlSchema\Dom\SimpleContentRestrictionElement;
use PhpXmlSchema\Dom\SimpleTypeRestrictionElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\PatternElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PatternElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new PatternElement();
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SimpleContentRestrictionElement.
     * 
     * @group   content
     */
    public function testPatternElementWhenAddedToSimpleContentRestrictionElement()
    {
        $parent = new SimpleContentRestrictionElement();
        $parent->addPatternElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SimpleContentRestrictionElement::addPatternElement().
     * 
     * @group   content
     */
    public function testPatternElementWithParentThrowsExceptionWhenSimpleContentRestrictionElementAddPatternElement()
    {
        $parent1 = new SimpleContentRestrictionElement();
        $parent1->addPatternElement($this->sut);
        
        $parent2 = new SimpleContentRestrictionElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addPatternElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SimpleTypeRestrictionElement.
     * 
     * @group   content
     */
    public function testPatternElementWhenAddedToSimpleTypeRestrictionElement()
    {
        $parent = new SimpleTypeRestrictionElement();
        $parent->addPatternElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SimpleTypeRestrictionElement::addPatternElement().
     * 
     * @group   content
     */
    public function testPatternElementWithParentThrowsExceptionWhenSimpleTypeRestrictionElementAddPatternElement()
    {
        $parent1 = new SimpleTypeRestrictionElement();
        $parent1->addPatternElement($this->sut);
        
        $parent2 = new SimpleTypeRestrictionElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addPatternElement($this->sut);
    }
}
