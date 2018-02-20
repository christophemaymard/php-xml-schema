<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\SimpleTypeElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SimpleTypeElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleTypeElementTest extends AbstractAnnotatedElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SimpleTypeElement();
    }
    
    /**
     * Tests that hasDerivationElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   elt-content
     */
    public function testHasDerivationElement()
    {
        self::assertFalse($this->sut->hasDerivationElement(), 'No element has been set.');
        
        $this->sut->setDerivationElement($this->createSimpleTypeDerivationElementInterfaceDummy());
        self::assertTrue($this->sut->hasDerivationElement(), 'Set with an element: SimpleTypeDerivationElementInterface.');
    }
    
    /**
     * Tests that getDerivationElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   elt-content
     */
    public function testGetDerivationElement()
    {
        self::assertNull($this->sut->getDerivationElement(), 'No element has been set.');
        
        $elt1 = $this->createSimpleTypeRestrictionElementDummy();
        $this->sut->setDerivationElement($elt1);
        self::assertSame($elt1, $this->sut->getDerivationElement(), 'Set with an element: SimpleTypeRestrictionElement.');
        
        $elt2 = $this->createListElementDummy();
        $this->sut->setDerivationElement($elt2);
        self::assertSame($elt2, $this->sut->getDerivationElement(), 'Set with another element: ListElement.');
        
        $elt3 = $this->createUnionElementDummy();
        $this->sut->setDerivationElement($elt3);
        self::assertSame($elt3, $this->sut->getDerivationElement(), 'Set with another element: UnionElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 1 ((restriction | list | union)).
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOfContainer1()
    {
        $children = [];
        $children[] = $this->createSimpleTypeDerivationElementInterfaceDummy();
        $this->sut->setDerivationElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 1.');
    }
}
