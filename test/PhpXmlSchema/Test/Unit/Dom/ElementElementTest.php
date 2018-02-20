<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\ElementElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\ElementElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ElementElementTest extends AbstractAnnotatedElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new ElementElement();
    }
    
    /**
     * Tests that hasTypeElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   elt-content
     */
    public function testHasTypeElement()
    {
        self::assertFalse($this->sut->hasTypeElement(), 'No element has been set.');
        
        $this->sut->setTypeElement($this->createTypeElementInterfaceDummy());
        self::assertTrue($this->sut->hasTypeElement(), 'Set with an element: TypeElementInterface.');
    }
    
    /**
     * Tests that getTypeElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   elt-content
     */
    public function testGetTypeElement()
    {
        self::assertNull($this->sut->getTypeElement(), 'No element has been set.');
        
        $elt1 = $this->createSimpleTypeElementDummy();
        $this->sut->setTypeElement($elt1);
        self::assertSame($elt1, $this->sut->getTypeElement(), 'Set with an element: SimpleTypeElement.');
        
        $elt2 = $this->createComplexTypeElementDummy();
        $this->sut->setTypeElement($elt2);
        self::assertSame($elt2, $this->sut->getTypeElement(), 'Set with another element: ComplexTypeElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 1 ((simpleType | complexType)?).
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOfContainer1()
    {
        $children = [];
        $children[] = $this->createTypeElementInterfaceDummy();
        $this->sut->setTypeElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 1.');
    }
}
