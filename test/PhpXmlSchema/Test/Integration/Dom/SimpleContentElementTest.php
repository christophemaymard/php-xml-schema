<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\ComplexTypeElement;
use PhpXmlSchema\Dom\SimpleContentElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\SimpleContentElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleContentElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SimpleContentElement();
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * ComplexTypeElement.
     * 
     * @group   content
     */
    public function testSimpleContentElementWhenAddedToComplexTypeElement()
    {
        $parent = new ComplexTypeElement();
        $parent->setContentElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with ComplexTypeElement::setContentElement().
     * 
     * @group   content
     */
    public function testSimpleContentElementWithParentThrowsExceptionWhenComplexTypeElementSetContentElement()
    {
        $parent1 = new ComplexTypeElement();
        $parent1->setContentElement($this->sut);
        
        $parent2 = new ComplexTypeElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->setContentElement($this->sut);
    }
}
