<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\RedefineElement;
use PhpXmlSchema\Dom\SchemaElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\RedefineElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class RedefineElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new RedefineElement();
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SchemaElement.
     * 
     * @group   content
     */
    public function testRedefineElementWhenAddedToSchemaElement()
    {
        $parent = new SchemaElement();
        $parent->addRedefineElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SchemaElement::addRedefineElement().
     * 
     * @group   content
     */
    public function testRedefineElementWithParentThrowsExceptionWhenSchemaElementAddRedefineElement()
    {
        $parent1 = new SchemaElement();
        $parent1->addRedefineElement($this->sut);
        
        $parent2 = new SchemaElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addRedefineElement($this->sut);
    }
}
