<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the base class to unit test the {@see PhpXmlSchema\Dom\AbstractAnnotatedElement} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractAnnotatedElementTestCase extends AbstractCompositeElementTestCase
{
    /**
     * Tests that hasAnnotationElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   content
     */
    public function testHasAnnotationElement(): void
    {
        self::assertFalse($this->sut->hasAnnotationElement(), 'No element has been set.');
        
        $this->sut->setAnnotationElement($this->createAnnotationElementHasParentFalse1TimeMock());
        self::assertTrue($this->sut->hasAnnotationElement(), 'Set with an element: AnnotationElement.');
    }
    
    /**
     * Tests that getAnnotationElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   content
     */
    public function testGetAnnotationElement(): void
    {
        self::assertNull($this->sut->getAnnotationElement(), 'No element has been set.');
        
        $elt1 = $this->createAnnotationElementHasParentFalse1TimeMock();
        $this->sut->setAnnotationElement($elt1);
        self::assertSame($elt1, $this->sut->getAnnotationElement(), 'Set with an element: AnnotationElement.');
        
        $elt2 = $this->createAnnotationElementHasParentFalse1TimeMock();
        $this->sut->setAnnotationElement($elt2);
        self::assertSame($elt2, $this->sut->getAnnotationElement(), 'Set with another element: AnnotationElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 0 (annotation?).
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOfContainer0(): void
    {
        $children = [];
        $children[] = $this->createAnnotationElementHasParentFalse1TimeMock();
        $this->sut->setAnnotationElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 0.');
    }
}
