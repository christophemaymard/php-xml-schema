<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\AttributeElement;
use PhpXmlSchema\Dom\ElementElement;
use PhpXmlSchema\Dom\ListElement;
use PhpXmlSchema\Dom\RedefineElement;
use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SimpleContentRestrictionElement;
use PhpXmlSchema\Dom\SimpleTypeElement;
use PhpXmlSchema\Dom\SimpleTypedElementInterface;
use PhpXmlSchema\Dom\SimpleTypeRestrictionElement;
use PhpXmlSchema\Dom\UnionElement;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\SimpleTypeElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleTypeElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SimpleTypeElement();
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SimpleTypedElementInterface.
     * 
     * @param   SimpleTypedElementInterface $parent The parent element to use for the test.
     * 
     * @dataProvider    getAllSimpleTypedElementValues
     * 
     * @group   content
     */
    public function testSimpleTypeElementWhenAddedToSimpleTypedElement(
        SimpleTypedElementInterface $parent
    ) {
        $parent->setSimpleTypeElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SimpleTypedElementInterface::setSimpleTypeElement().
     * 
     * @param   SimpleTypedElementInterface $parent1    The first parent element to use for the test.
     * @param   SimpleTypedElementInterface $parent2    The second parent element to use for the test.
     * 
     * @dataProvider    getAllSimpleTypedElementParentValues
     * 
     * @group   content
     */
    public function testSimpleTypeElementWithParentThrowsExceptionWhenSimpleTypedElementSetSimpleTypeElement(
        SimpleTypedElementInterface $parent1,
        SimpleTypedElementInterface $parent2
    ) {
        $parent1->setSimpleTypeElement($this->sut);
        
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->setSimpleTypeElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * ElementElement.
     * 
     * @group   content
     */
    public function testSimpleTypeElementWhenAddedToElementElement()
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
    public function testSimpleTypeElementWithParentThrowsExceptionWhenElementElementSetTypeElement()
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
    public function testSimpleTypeElementWhenAddedToRedefineElement()
    {
        $parent = new RedefineElement();
        $parent->addSimpleTypeElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with RedefineElement::addSimpleTypeElement().
     * 
     * @group   content
     */
    public function testSimpleTypeElementWithParentThrowsExceptionWhenRedefineElementAddSimpleTypeElement()
    {
        $parent1 = new RedefineElement();
        $parent1->addSimpleTypeElement($this->sut);
        
        $parent2 = new RedefineElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addSimpleTypeElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SchemaElement.
     * 
     * @group   content
     */
    public function testSimpleTypeElementWhenAddedToSchemaElement()
    {
        $parent = new SchemaElement();
        $parent->addSimpleTypeElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SchemaElement::addSimpleTypeElement().
     * 
     * @group   content
     */
    public function testSimpleTypeElementWithParentThrowsExceptionWhenSchemaElementAddSimpleTypeElement()
    {
        $parent1 = new SchemaElement();
        $parent1->addSimpleTypeElement($this->sut);
        
        $parent2 = new SchemaElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addSimpleTypeElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * UnionElement.
     * 
     * @group   content
     */
    public function testSimpleTypeElementWhenAddedToUnionElement()
    {
        $parent = new UnionElement();
        $parent->addSimpleTypeElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with UnionElement::addSimpleTypeElement().
     * 
     * @group   content
     */
    public function testSimpleTypeElementWithParentThrowsExceptionWhenUnionElementAddSimpleTypeElement()
    {
        $parent1 = new UnionElement();
        $parent1->addSimpleTypeElement($this->sut);
        
        $parent2 = new UnionElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addSimpleTypeElement($this->sut);
    }
    
    /**
     * Returns a set of all the simple typed element values.
     * 
     * @return  array[]
     */
    public function getAllSimpleTypedElementValues():array
    {
        $datasets = [];
        
        foreach ($this->getAllSimpleTypedElements() as $element) {
            $datasets[] = [ $element, ];
        }
        
        return $datasets;
    }
    
    /**
     * Returns a set of all the simple typed element parent values.
     * 
     * @return  array[]
     */
    public function getAllSimpleTypedElementParentValues():array
    {
        $datasets = [];
        
        $parents1 = $this->getAllSimpleTypedElements();
        $parents2 = $this->getAllSimpleTypedElements();
        $count = count($parents1);
        
        for ($num = 0; $num < $count; $num++) {
            $datasets[] = [ \array_shift($parents1), \array_shift($parents2), ];
        }
        
        return $datasets;
    }
    
    /**
     * Returns a set of all the simple typed elements.
     * 
     * @return  SimpleTypedElementInterface[]
     */
    private function getAllSimpleTypedElements():array
    {
        return [
            new AttributeElement(),
            new ListElement(),
            new SimpleContentRestrictionElement(),
            new SimpleTypeRestrictionElement(),
        ];
    }
}
