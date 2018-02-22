<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\ComplexTypeElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\ComplexTypeElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ComplexTypeElementTest extends AbstractAbstractTypeNamingElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new ComplexTypeElement();
    }
    
    /**
     * Tests that hasContentElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   elt-content
     */
    public function testHasContentElement()
    {
        self::assertFalse($this->sut->hasContentElement(), 'No element has been set.');
        
        $this->sut->setContentElement($this->createContentElementInterfaceDummy());
        self::assertTrue($this->sut->hasContentElement(), 'Set with an element: ContentElementInterface.');
    }
    
    /**
     * Tests that getContentElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   elt-content
     */
    public function testGetContentElement()
    {
        self::assertNull($this->sut->getContentElement(), 'No element has been set.');
        
        $elt1 = $this->createSimpleContentElementDummy();
        $this->sut->setContentElement($elt1);
        self::assertSame($elt1, $this->sut->getContentElement(), 'Set with an element: SimpleContentElement.');
        
        $elt2 = $this->createComplexContentElementDummy();
        $this->sut->setContentElement($elt2);
        self::assertSame($elt2, $this->sut->getContentElement(), 'Set with another element: ComplexContentElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 1 ((simpleContent | complexContent)).
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOfContainer1()
    {
        $children = [];
        $children[] = $this->createContentElementInterfaceDummy();
        $this->sut->setContentElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 1.');
    }
}
