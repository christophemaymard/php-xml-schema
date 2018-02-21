<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\GroupElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\GroupElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class GroupElementTest extends AbstractAnnotatedElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new GroupElement();
    }
    
    /**
     * Tests that hasModelGroupElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   elt-content
     */
    public function testHasModelGroupElement()
    {
        self::assertFalse($this->sut->hasModelGroupElement(), 'No element has been set.');
        
        $this->sut->setModelGroupElement($this->createModelGroupElementInterfaceDummy());
        self::assertTrue($this->sut->hasModelGroupElement(), 'Set with an element: ModelGroupElementInterface.');
    }
    
    /**
     * Tests that getModelGroupElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   elt-content
     */
    public function testGetModelGroupElement()
    {
        self::assertNull($this->sut->getModelGroupElement(), 'No element has been set.');
        
        $elt1 = $this->createAllElementDummy();
        $this->sut->setModelGroupElement($elt1);
        self::assertSame($elt1, $this->sut->getModelGroupElement(), 'Set with an element: AllElement.');
        
        $elt2 = $this->createChoiceElementDummy();
        $this->sut->setModelGroupElement($elt2);
        self::assertSame($elt2, $this->sut->getModelGroupElement(), 'Set with another element: ChoiceElement.');
        
        $elt3 = $this->createSequenceElementDummy();
        $this->sut->setModelGroupElement($elt3);
        self::assertSame($elt3, $this->sut->getModelGroupElement(), 'Set with another element: SequenceElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 1 ((all | choice | sequence)?).
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOfContainer1()
    {
        $children = [];
        $children[] = $this->createModelGroupElementInterfaceDummy();
        $this->sut->setModelGroupElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 1.');
    }
}
