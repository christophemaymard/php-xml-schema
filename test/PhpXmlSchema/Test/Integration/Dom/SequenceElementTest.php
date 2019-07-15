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
use PhpXmlSchema\Dom\SequenceElement;
use PhpXmlSchema\Dom\TypeNamingElementInterface;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\SequenceElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SequenceElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SequenceElement();
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * ChoiceElement.
     * 
     * @group   content
     */
    public function testSequenceElementWhenAddedToChoiceElement()
    {
        $parent = new ChoiceElement();
        $parent->addSequenceElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with ChoiceElement::addSequenceElement().
     * 
     * @group   content
     */
    public function testSequenceElementWithParentThrowsExceptionWhenChoiceElementAddSequenceElement()
    {
        $parent1 = new ChoiceElement();
        $parent1->addSequenceElement($this->sut);
        
        $parent2 = new ChoiceElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addSequenceElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * GroupElement.
     * 
     * @group   content
     */
    public function testSequenceElementWhenAddedToGroupElement()
    {
        $parent = new GroupElement();
        $parent->setModelGroupElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with GroupElement::setModelGroupElement().
     * 
     * @group   content
     */
    public function testSequenceElementWithParentThrowsExceptionWhenGroupElementSetModelGroupElement()
    {
        $parent1 = new GroupElement();
        $parent1->setModelGroupElement($this->sut);
        
        $parent2 = new GroupElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->setModelGroupElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SequenceElement.
     * 
     * @group   content
     */
    public function testSequenceElementWhenAddedToSequenceElement()
    {
        $parent = new SequenceElement();
        $parent->addSequenceElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SequenceElement::addSequenceElement().
     * 
     * @group   content
     */
    public function testSequenceElementWithParentThrowsExceptionWhenSequenceElementAddSequenceElement()
    {
        $parent1 = new SequenceElement();
        $parent1->addSequenceElement($this->sut);
        
        $parent2 = new SequenceElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addSequenceElement($this->sut);
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
    public function testSequenceElementWhenAddedToTypeNamingElement(
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
    public function testSequenceElementWithParentThrowsExceptionWhenTypeNamingElementSetTypeDefinitionParticleElement(
        TypeNamingElementInterface $parent1,
        TypeNamingElementInterface $parent2
    ) {
        $parent1->setTypeDefinitionParticleElement($this->sut);
        
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->setTypeDefinitionParticleElement($this->sut);
    }
}
