<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\KeyElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\KeyElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class KeyElementTest extends AbstractCompositeElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new KeyElement();
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
     * Tests that hasSelectorElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   elt-content
     */
    public function testHasSelectorElement()
    {
        self::assertFalse($this->sut->hasSelectorElement(), 'No element has been set.');
        
        $this->sut->setSelectorElement($this->createSelectorElementDummy());
        self::assertTrue($this->sut->hasSelectorElement(), 'Set with an element: SelectorElement.');
    }
    
    /**
     * Tests that getSelectorElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   elt-content
     */
    public function testGetSelectorElement()
    {
        self::assertNull($this->sut->getSelectorElement(), 'No element has been set.');
        
        $elt1 = $this->createSelectorElementDummy();
        $this->sut->setSelectorElement($elt1);
        self::assertSame($elt1, $this->sut->getSelectorElement(), 'Set with an element: SelectorElement.');
        
        $elt2 = $this->createSelectorElementDummy();
        $this->sut->setSelectorElement($elt2);
        self::assertSame($elt2, $this->sut->getSelectorElement(), 'Set with another element: SelectorElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 1 (selector).
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOfContainer1()
    {
        $children = [];
        $children[] = $this->createSelectorElementDummy();
        $this->sut->setSelectorElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 1.');
    }
    
    /**
     * Tests that getFieldElements() returns:
     * - an empty array when no element has been added
     * - an indexed array of all added FieldElement elements
     * 
     * @group   elt-content
     */
    public function testGetFieldElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getFieldElements(), 'No element has been added.');
        
        $elements[] = $this->createFieldElementDummy();
        $this->sut->addFieldElement($elements[0]);
        self::assertSame($elements, $this->sut->getFieldElements(), 'Added 1 FieldElement element.');
        
        $elements[] = $this->createFieldElementDummy();
        $this->sut->addFieldElement($elements[1]);
        self::assertSame($elements, $this->sut->getFieldElements(), 'Added 2 FieldElement elements.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 2 (field+).
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOfContainer2()
    {
        $children = [];
        $children[] = $this->createFieldElementDummy();
        $children[] = $this->createFieldElementDummy();
        $this->sut->addFieldElement($children[0]);
        $this->sut->addFieldElement($children[1]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 2.');
    }
}
