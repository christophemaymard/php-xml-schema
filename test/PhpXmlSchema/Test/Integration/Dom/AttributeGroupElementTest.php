<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\AttributeGroupElement;
use PhpXmlSchema\Dom\AttributeNamingElementInterface;
use PhpXmlSchema\Dom\RedefineElement;
use PhpXmlSchema\Dom\SchemaElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\AttributeGroupElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AttributeGroupElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new AttributeGroupElement();
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
    public function testAttributeGroupElementWhenAddedToAttributeNamingElement(
        AttributeNamingElementInterface $parent
    ) {
        $parent->addAttributeGroupElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with AttributeNamingElementInterface::addAttributeGroupElement().
     * 
     * @param   AttributeNamingElementInterface $parent1    The first parent element to use for the test.
     * @param   AttributeNamingElementInterface $parent2    The second parent element to use for the test.
     * 
     * @dataProvider    getAllAttributeNamingElementParentValues
     * 
     * @group   content
     */
    public function testAttributeGroupElementWithParentThrowsExceptionWhenAttributeNamingElementAddAttributeGroupElement(
        AttributeNamingElementInterface $parent1,
        AttributeNamingElementInterface $parent2
    ) {
        $parent1->addAttributeGroupElement($this->sut);
        
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addAttributeGroupElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * RedefineElement.
     * 
     * @group   content
     */
    public function testAttributeGroupElementWhenAddedToRedefineElement()
    {
        $parent = new RedefineElement();
        $parent->addAttributeGroupElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with RedefineElement::addAttributeGroupElement().
     * 
     * @group   content
     */
    public function testAttributeGroupElementWithParentThrowsExceptionWhenRedefineElementAddAttributeGroupElement()
    {
        $parent1 = new RedefineElement();
        $parent1->addAttributeGroupElement($this->sut);
        
        $parent2 = new RedefineElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addAttributeGroupElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SchemaElement.
     * 
     * @group   content
     */
    public function testAttributeGroupElementWhenAddedToSchemaElement()
    {
        $parent = new SchemaElement();
        $parent->addAttributeGroupElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SchemaElement::addAttributeGroupElement().
     * 
     * @group   content
     */
    public function testAttributeGroupElementWithParentThrowsExceptionWhenSchemaElementAddAttributeGroupElement()
    {
        $parent1 = new SchemaElement();
        $parent1->addAttributeGroupElement($this->sut);
        
        $parent2 = new SchemaElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addAttributeGroupElement($this->sut);
    }
}
