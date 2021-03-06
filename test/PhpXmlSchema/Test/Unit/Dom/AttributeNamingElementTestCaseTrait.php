<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents a trait to unit test a class that implements the {@see PhpXmlSchema\Dom\AttributeNamingElementInterface} 
 * interface.
 * 
 * It must be used in a class that extends the {@see PhpXmlSchema\Test\Unit\Dom\AbstractAnnotatedElementTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait AttributeNamingElementTestCaseTrait
{
    /**
     * Tests that getAttributeElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no AttributeElement element has been added
     * - an indexed array of all added AttributeElement elements
     * 
     * @group   content
     */
    public function testGetAttributeElements(): void
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getAttributeElements(), 'No element has been added.');
        
        $this->sut->addAttributeGroupElement($this->createAttributeGroupElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getAttributeElements(), 'Added elements but no AttributeElement element.');
        
        $elements[] = $this->createAttributeElementHasParentFalse1TimeMock();
        $this->sut->addAttributeElement($elements[0]);
        self::assertSame($elements, $this->sut->getAttributeElements(), 'Added 1 AttributeElement element.');
        
        $this->sut->addAttributeGroupElement($this->createAttributeGroupElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getAttributeElements(), 'Added 1 element between.');
        
        $elements[] = $this->createAttributeElementHasParentFalse1TimeMock();
        $this->sut->addAttributeElement($elements[1]);
        self::assertSame($elements, $this->sut->getAttributeElements(), 'Added 2 AttributeElement elements.');
    }
    
    /**
     * Tests that getAttributeGroupElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no AttributeGroupElement element has been added
     * - an indexed array of all added AttributeGroupElement elements
     * 
     * @group   content
     */
    public function testGetAttributeGroupElements(): void
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'No element has been added.');
        
        $this->sut->addAttributeElement($this->createAttributeElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'Added elements but no AttributeGroupElement element.');
        
        $elements[] = $this->createAttributeGroupElementHasParentFalse1TimeMock();
        $this->sut->addAttributeGroupElement($elements[0]);
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'Added 1 AttributeGroupElement element.');
        
        $this->sut->addAttributeElement($this->createAttributeElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'Added 1 element between.');
        
        $elements[] = $this->createAttributeGroupElementHasParentFalse1TimeMock();
        $this->sut->addAttributeGroupElement($elements[1]);
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'Added 2 AttributeGroupElement elements.');
    }
    
    /**
     * Tests that getAttributeDeclarationElements() returns:
     * - an empty array when no element has been added
     * - an indexed array of all added attribute declaration elements in container 3 ((attribute | attributeGroup)*)
     * 
     * @group   content
     */
    public function testGetAttributeDeclarationElements(): void
    {
        self::assertSame([], $this->sut->getAttributeDeclarationElements(), 'No element has been added.');
        
        self::assertSame($this->fillSutContainer3(), $this->sut->getAttributeDeclarationElements(), 'Added attribute declaration elements.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 3 ((attribute | attributeGroup)*).
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOfContainer3(): void
    {
        self::assertSame($this->fillSutContainer3(), $this->sut->getElements(), 'Elements in container 3.');
    }
    
    /**
     * Tests that hasAnyAttributeElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   content
     */
    public function testHasAnyAttributeElement(): void
    {
        self::assertFalse($this->sut->hasAnyAttributeElement(), 'No element has been set.');
        
        $this->sut->setAnyAttributeElement($this->createAnyAttributeElementHasParentFalse1TimeMock());
        self::assertTrue($this->sut->hasAnyAttributeElement(), 'Set with an element: AnyAttributeElement.');
    }
    
    /**
     * Tests that getAnyAttributeElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   content
     */
    public function testGetAnyAttributeElement(): void
    {
        self::assertNull($this->sut->getAnyAttributeElement(), 'No element has been set.');
        
        $elt1 = $this->createAnyAttributeElementHasParentFalse1TimeMock();
        $this->sut->setAnyAttributeElement($elt1);
        self::assertSame($elt1, $this->sut->getAnyAttributeElement(), 'Set with an element: AnyAttributeElement.');
        
        $elt2 = $this->createAnyAttributeElementHasParentFalse1TimeMock();
        $this->sut->setAnyAttributeElement($elt2);
        self::assertSame($elt2, $this->sut->getAnyAttributeElement(), 'Set with another element: AnyAttributeElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 4 (anyAttribute?).
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOfContainer4(): void
    {
        $children = [];
        $children[] = $this->createAnyAttributeElementHasParentFalse1TimeMock();
        $this->sut->setAnyAttributeElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 4.');
    }
    
    /**
     * Fills the container 3 ((attribute | attributeGroup)*) of the SUT with 
     * a set of elements.
     * 
     * @return  ProphecySubjectInterface[]  An indexed array of all the created elements.
     */
    private function fillSutContainer3(): array
    {
        $elements = [];
        $elements[] = $this->createAttributeElementHasParentFalse1TimeMock();
        $elements[] = $this->createAttributeGroupElementHasParentFalse1TimeMock();
        $elements[] = $this->createAttributeElementHasParentFalse1TimeMock();
        $elements[] = $this->createAttributeGroupElementHasParentFalse1TimeMock();
        $this->sut->addAttributeElement($elements[0]);
        $this->sut->addAttributeGroupElement($elements[1]);
        $this->sut->addAttributeElement($elements[2]);
        $this->sut->addAttributeGroupElement($elements[3]);
        
        return $elements;
    }
}