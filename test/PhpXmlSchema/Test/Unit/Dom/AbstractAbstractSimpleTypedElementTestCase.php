<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the base class to unit test the {@see PhpXmlSchema\Dom\AbstractSimpleTypedElement} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractAbstractSimpleTypedElementTestCase extends AbstractAnnotatedElementTestCase
{
    /**
     * Tests that hasSimpleTypeElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   content
     */
    public function testHasSimpleTypeElement()
    {
        self::assertFalse($this->sut->hasSimpleTypeElement(), 'No element has been set.');
        
        $this->sut->setSimpleTypeElement($this->createSimpleTypeElementHasParentFalse1TimeMock());
        self::assertTrue($this->sut->hasSimpleTypeElement(), 'Set with an element: SimpleTypeElement.');
    }
    
    /**
     * Tests that getSimpleTypeElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   content
     */
    public function testGetSimpleTypeElement()
    {
        self::assertNull($this->sut->getSimpleTypeElement(), 'No element has been set.');
        
        $elt1 = $this->createSimpleTypeElementHasParentFalse1TimeMock();
        $this->sut->setSimpleTypeElement($elt1);
        self::assertSame($elt1, $this->sut->getSimpleTypeElement(), 'Set with an element: SimpleTypeElement.');
        
        $elt2 = $this->createSimpleTypeElementHasParentFalse1TimeMock();
        $this->sut->setSimpleTypeElement($elt2);
        self::assertSame($elt2, $this->sut->getSimpleTypeElement(), 'Set with another element: SimpleTypeElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 1 (simpleType?).
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOfContainer1()
    {
        $children = [];
        $children[] = $this->createSimpleTypeElementHasParentFalse1TimeMock();
        $this->sut->setSimpleTypeElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 1.');
    }
}
