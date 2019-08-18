<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\AllElement;
use PhpXmlSchema\Dom\ElementId;
use PhpXmlSchema\Dom\GroupElement;
use PhpXmlSchema\Dom\TypeNamingElementInterface;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\AllElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AllElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new AllElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetElementIdReturnsSpecificElementIdConstant()
    {
        self::assertSame(ElementId::ELT_ALL, $this->sut->getElementId());
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
    public function testAllElementWhenAddedToTypeNamingElement(
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
    public function testAllElementWithParentThrowsExceptionWhenTypeNamingElementSetTypeDefinitionParticleElement(
        TypeNamingElementInterface $parent1,
        TypeNamingElementInterface $parent2
    ) {
        $parent1->setTypeDefinitionParticleElement($this->sut);
        
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->setTypeDefinitionParticleElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * GroupElement.
     * 
     * @group   content
     */
    public function testAllElementWhenAddedToGroupElement()
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
    public function testAllElementWithParentThrowsExceptionWhenGroupElementSetModelGroupElement()
    {
        $parent1 = new GroupElement();
        $parent1->setModelGroupElement($this->sut);
        
        $parent2 = new GroupElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->setModelGroupElement($this->sut);
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a TypeNamingElementInterface element, and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @param   TypeNamingElementInterface  $parent The parent element to use for the test.
     * 
     * @group           namespace
     * @group           xml
     * @dataProvider    getAllTypeNamingElementValues
     */
    public function testLookupNamespaceReturnsStringWhenAddedToTypeNamingElementAndParentPrefixBoundToNamespace(
        TypeNamingElementInterface $parent
    ) {
        $parent->setTypeDefinitionParticleElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a GroupElement element, and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testLookupNamespaceReturnsStringWhenAddedToGroupElementAndParentPrefixBoundToNamespace()
    {
        $parent = new GroupElement();
        $parent->setModelGroupElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
}
