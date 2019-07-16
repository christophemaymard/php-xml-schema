<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\ComplexContentElement;
use PhpXmlSchema\Dom\ComplexContentRestrictionElement;
use PhpXmlSchema\Dom\ElementId;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\ComplexContentRestrictionElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ComplexContentRestrictionElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new ComplexContentRestrictionElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetElementIdReturnsSpecificElementIdConstant()
    {
        self::assertSame(ElementId::ELT_COMPLEXCONTENT_RESTRICTION, $this->sut->getElementId());
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * ComplexContentElement.
     * 
     * @group   content
     */
    public function testComplexContentRestrictionElementWhenAddedToComplexContentElement()
    {
        $parent = new ComplexContentElement();
        $parent->setDerivationElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with ComplexContentElement::setDerivationElement().
     * 
     * @group   content
     */
    public function testComplexContentRestrictionElementWithParentThrowsExceptionWhenComplexContentElementSetDerivationElement()
    {
        $parent1 = new ComplexContentElement();
        $parent1->setDerivationElement($this->sut);
        
        $parent2 = new ComplexContentElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->setDerivationElement($this->sut);
    }
}
