<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\SimpleTypeRestrictionElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SimpleTypeRestrictionElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleTypeRestrictionElementTest extends AbstractCompositeElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SimpleTypeRestrictionElement();
    }
    
    /**
     * Tests that hasAnnotationElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   elt-content
     */
    public function testHasAnnotationElement()
    {
        self::assertFalse($this->sut->hasAnnotationElement(), 'No element has been set.');
        
        $this->sut->setAnnotationElement($this->createAnnotationElementDummy());
        self::assertTrue($this->sut->hasAnnotationElement(), 'Set with an element: AnnotationElement.');
    }
    
    /**
     * Tests that getAnnotationElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   elt-content
     */
    public function testGetAnnotationElement()
    {
        self::assertNull($this->sut->getAnnotationElement(), 'No element has been set.');
        
        $elt1 = $this->createAnnotationElementDummy();
        $this->sut->setAnnotationElement($elt1);
        self::assertSame($elt1, $this->sut->getAnnotationElement(), 'Set with an element: AnnotationElement.');
        
        $elt2 = $this->createAnnotationElementDummy();
        $this->sut->setAnnotationElement($elt2);
        self::assertSame($elt2, $this->sut->getAnnotationElement(), 'Set with another element: AnnotationElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 0 (annotation?).
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOfContainer0()
    {
        $children = [];
        $children[] = $this->createAnnotationElementDummy();
        $this->sut->setAnnotationElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 0.');
    }
    
    /**
     * Tests that hasSimpleTypeElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   elt-content
     */
    public function testHasSimpleTypeElement()
    {
        self::assertFalse($this->sut->hasSimpleTypeElement(), 'No element has been set.');
        
        $this->sut->setSimpleTypeElement($this->createSimpleTypeElementDummy());
        self::assertTrue($this->sut->hasSimpleTypeElement(), 'Set with an element: SimpleTypeElement.');
    }
    
    /**
     * Tests that getSimpleTypeElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   elt-content
     */
    public function testGetSimpleTypeElement()
    {
        self::assertNull($this->sut->getSimpleTypeElement(), 'No element has been set.');
        
        $elt1 = $this->createSimpleTypeElementDummy();
        $this->sut->setSimpleTypeElement($elt1);
        self::assertSame($elt1, $this->sut->getSimpleTypeElement(), 'Set with an element: SimpleTypeElement.');
        
        $elt2 = $this->createSimpleTypeElementDummy();
        $this->sut->setSimpleTypeElement($elt2);
        self::assertSame($elt2, $this->sut->getSimpleTypeElement(), 'Set with another element: SimpleTypeElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 1 (simpleType?).
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOfContainer1()
    {
        $children = [];
        $children[] = $this->createSimpleTypeElementDummy();
        $this->sut->setSimpleTypeElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 1.');
    }
}
