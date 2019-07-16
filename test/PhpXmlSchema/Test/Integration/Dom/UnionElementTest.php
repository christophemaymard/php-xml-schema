<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\ElementId;
use PhpXmlSchema\Dom\SimpleTypeElement;
use PhpXmlSchema\Dom\UnionElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\UnionElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class UnionElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new UnionElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetElementIdReturnsSpecificElementIdConstant()
    {
        self::assertSame(ElementId::ELT_UNION, $this->sut->getElementId());
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SimpleTypeElement.
     * 
     * @group   content
     */
    public function testUnionElementWhenAddedToSimpleTypeElement()
    {
        $parent = new SimpleTypeElement();
        $parent->setDerivationElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SimpleTypeElement::setDerivationElement().
     * 
     * @group   content
     */
    public function testUnionElementWithParentThrowsExceptionWhenSimpleTypeElementSetDerivationElement()
    {
        $parent1 = new SimpleTypeElement();
        $parent1->setDerivationElement($this->sut);
        
        $parent2 = new SimpleTypeElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->setDerivationElement($this->sut);
    }
}
