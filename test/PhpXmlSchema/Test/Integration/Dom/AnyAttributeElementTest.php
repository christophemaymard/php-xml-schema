<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\AnyAttributeElement;
use PhpXmlSchema\Dom\AttributeNamingElementInterface;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\AnyAttributeElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AnyAttributeElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new AnyAttributeElement();
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * AttributeNamingElementInterface.
     * 
     * @param   AttributeNamingElementInterface $parent The parent element to use for the test.
     * 
     * @dataProvider    getAllAttributeNamingElementValues
     * 
     * @group   content
     */
    public function testAnyAttributeElementWhenAddedToAttributeNamingElement(
        AttributeNamingElementInterface $parent
    ) {
        $parent->setAnyAttributeElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with AttributeNamingElementInterface::setAnyAttributeElement().
     * 
     * @param   AttributeNamingElementInterface $parent1    The first parent element to use for the test.
     * @param   AttributeNamingElementInterface $parent2    The second parent element to use for the test.
     * 
     * @dataProvider    getAllAttributeNamingElementParentValues
     * 
     * @group   content
     */
    public function testAnyAttributeElementWithParentThrowsExceptionWhenAttributeNamingElementSetAnyAttributeElement(
        AttributeNamingElementInterface $parent1,
        AttributeNamingElementInterface $parent2
    ) {
        $parent1->setAnyAttributeElement($this->sut);
        
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->setAnyAttributeElement($this->sut);
    }
}
