<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\ChoiceElement;
use PhpXmlSchema\Dom\GroupElement;
use PhpXmlSchema\Dom\RedefineElement;
use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SequenceElement;
use PhpXmlSchema\Dom\TypeNamingElementInterface;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\GroupElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class GroupElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new GroupElement();
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * ChoiceElement.
     * 
     * @group   content
     */
    public function testGroupElementWhenAddedToChoiceElement()
    {
        $parent = new ChoiceElement();
        $parent->addGroupElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with ChoiceElement::addGroupElement().
     * 
     * @group   content
     */
    public function testGroupElementWithParentThrowsExceptionWhenChoiceElementAddGroupElement()
    {
        $parent1 = new ChoiceElement();
        $parent1->addGroupElement($this->sut);
        
        $parent2 = new ChoiceElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addGroupElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * RedefineElement.
     * 
     * @group   content
     */
    public function testGroupElementWhenAddedToRedefineElement()
    {
        $parent = new RedefineElement();
        $parent->addGroupElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with RedefineElement::addGroupElement().
     * 
     * @group   content
     */
    public function testGroupElementWithParentThrowsExceptionWhenRedefineElementAddGroupElement()
    {
        $parent1 = new RedefineElement();
        $parent1->addGroupElement($this->sut);
        
        $parent2 = new RedefineElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addGroupElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SchemaElement.
     * 
     * @group   content
     */
    public function testGroupElementWhenAddedToSchemaElement()
    {
        $parent = new SchemaElement();
        $parent->addGroupElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SchemaElement::addGroupElement().
     * 
     * @group   content
     */
    public function testGroupElementWithParentThrowsExceptionWhenSchemaElementAddGroupElement()
    {
        $parent1 = new SchemaElement();
        $parent1->addGroupElement($this->sut);
        
        $parent2 = new SchemaElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addGroupElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SequenceElement.
     * 
     * @group   content
     */
    public function testGroupElementWhenAddedToSequenceElement()
    {
        $parent = new SequenceElement();
        $parent->addGroupElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SequenceElement::addGroupElement().
     * 
     * @group   content
     */
    public function testGroupElementWithParentThrowsExceptionWhenSequenceElementAddGroupElement()
    {
        $parent1 = new SequenceElement();
        $parent1->addGroupElement($this->sut);
        
        $parent2 = new SequenceElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addGroupElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * TypeNamingElementInterface.
     * 
     * @param   TypeNamingElementInterface  $parent The parent element to use for the test.
     * 
     * @dataProvider    getAllTypeNamingElementValues
     * 
     * @group   content
     */
    public function testGroupElementWhenAddedToTypeNamingElement(
        TypeNamingElementInterface $parent
    ) {
        $parent->setTypeDefinitionParticleElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with TypeNamingElementInterface::setTypeDefinitionParticleElement().
     * 
     * @param   TypeNamingElementInterface  $parent1    The first parent element to use for the test.
     * @param   TypeNamingElementInterface  $parent2    The second parent element to use for the test.
     * 
     * @dataProvider    getAllTypeNamingElementParentValues
     * 
     * @group   content
     */
    public function testGroupElementWithParentThrowsExceptionWhenTypeNamingElementSetTypeDefinitionParticleElement(
        TypeNamingElementInterface $parent1,
        TypeNamingElementInterface $parent2
    ) {
        $parent1->setTypeDefinitionParticleElement($this->sut);
        
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->setTypeDefinitionParticleElement($this->sut);
    }
}
