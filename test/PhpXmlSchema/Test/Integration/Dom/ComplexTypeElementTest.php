<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\ComplexTypeElement;
use PhpXmlSchema\Dom\ElementElement;
use PhpXmlSchema\Dom\ElementId;
use PhpXmlSchema\Dom\RedefineElement;
use PhpXmlSchema\Dom\SchemaElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\ComplexTypeElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ComplexTypeElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new ComplexTypeElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetElementIdReturnsSpecificElementIdConstant()
    {
        self::assertSame(ElementId::ELT_COMPLEXTYPE, $this->sut->getElementId());
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * ElementElement.
     * 
     * @group   content
     */
    public function testComplexTypeElementWhenAddedToElementElement()
    {
        $parent = new ElementElement();
        $parent->setTypeElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with ElementElement::setTypeElement().
     * 
     * @group   content
     */
    public function testComplexTypeElementWithParentThrowsExceptionWhenElementElementSetTypeElement()
    {
        $parent1 = new ElementElement();
        $parent1->setTypeElement($this->sut);
        
        $parent2 = new ElementElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->setTypeElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * RedefineElement.
     * 
     * @group   content
     */
    public function testComplexTypeElementWhenAddedToRedefineElement()
    {
        $parent = new RedefineElement();
        $parent->addComplexTypeElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with RedefineElement::addComplexTypeElement().
     * 
     * @group   content
     */
    public function testComplexTypeElementWithParentThrowsExceptionWhenRedefineElementAddComplexTypeElement()
    {
        $parent1 = new RedefineElement();
        $parent1->addComplexTypeElement($this->sut);
        
        $parent2 = new RedefineElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addComplexTypeElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SchemaElement.
     * 
     * @group   content
     */
    public function testComplexTypeElementWhenAddedToSchemaElement()
    {
        $parent = new SchemaElement();
        $parent->addComplexTypeElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SchemaElement::addComplexTypeElement().
     * 
     * @group   content
     */
    public function testComplexTypeElementWithParentThrowsExceptionWhenSchemaElementAddComplexTypeElement()
    {
        $parent1 = new SchemaElement();
        $parent1->addComplexTypeElement($this->sut);
        
        $parent2 = new SchemaElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addComplexTypeElement($this->sut);
    }
}
