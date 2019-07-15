<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\NotationElement;
use PhpXmlSchema\Dom\SchemaElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\NotationElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NotationElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new NotationElement();
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SchemaElement.
     * 
     * @group   content
     */
    public function testNotationElementWhenAddedToSchemaElement()
    {
        $parent = new SchemaElement();
        $parent->addNotationElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SchemaElement::addNotationElement().
     * 
     * @group   content
     */
    public function testNotationElementWithParentThrowsExceptionWhenSchemaElementAddNotationElement()
    {
        $parent1 = new SchemaElement();
        $parent1->addNotationElement($this->sut);
        
        $parent2 = new SchemaElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addNotationElement($this->sut);
    }
}
