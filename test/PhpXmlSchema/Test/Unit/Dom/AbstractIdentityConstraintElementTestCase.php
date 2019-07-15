<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the base class to unit test a XML schema element that directly 
 * extends the {@see PhpXmlSchema\Dom\AbstractIdentityConstraintElement} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractIdentityConstraintElementTestCase extends AbstractAnnotatedElementTestCase
{
    use NameAttributeTestCaseTrait;
    
    /**
     * Tests that hasSelectorElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   content
     */
    public function testHasSelectorElement()
    {
        self::assertFalse($this->sut->hasSelectorElement(), 'No element has been set.');
        
        $this->sut->setSelectorElement($this->createSelectorElementHasParentFalse1TimeMock());
        self::assertTrue($this->sut->hasSelectorElement(), 'Set with an element: SelectorElement.');
    }
    
    /**
     * Tests that getSelectorElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   content
     */
    public function testGetSelectorElement()
    {
        self::assertNull($this->sut->getSelectorElement(), 'No element has been set.');
        
        $elt1 = $this->createSelectorElementHasParentFalse1TimeMock();
        $this->sut->setSelectorElement($elt1);
        self::assertSame($elt1, $this->sut->getSelectorElement(), 'Set with an element: SelectorElement.');
        
        $elt2 = $this->createSelectorElementHasParentFalse1TimeMock();
        $this->sut->setSelectorElement($elt2);
        self::assertSame($elt2, $this->sut->getSelectorElement(), 'Set with another element: SelectorElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 1 (selector).
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOfContainer1()
    {
        $children = [];
        $children[] = $this->createSelectorElementHasParentFalse1TimeMock();
        $this->sut->setSelectorElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 1.');
    }
    
    /**
     * Tests that getFieldElements() returns:
     * - an empty array when no element has been added
     * - an indexed array of all added FieldElement elements
     * 
     * @group   content
     */
    public function testGetFieldElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getFieldElements(), 'No element has been added.');
        
        $elements[] = $this->createFieldElementHasParentFalse1TimeMock();
        $this->sut->addFieldElement($elements[0]);
        self::assertSame($elements, $this->sut->getFieldElements(), 'Added 1 FieldElement element.');
        
        $elements[] = $this->createFieldElementHasParentFalse1TimeMock();
        $this->sut->addFieldElement($elements[1]);
        self::assertSame($elements, $this->sut->getFieldElements(), 'Added 2 FieldElement elements.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 2 (field+).
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOfContainer2()
    {
        $children = [];
        $children[] = $this->createFieldElementHasParentFalse1TimeMock();
        $children[] = $this->createFieldElementHasParentFalse1TimeMock();
        $this->sut->addFieldElement($children[0]);
        $this->sut->addFieldElement($children[1]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 2.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in that order:
     * - elements from container 0 (annotation?)
     * - elements from container 1 (selector)
     * - elements from container 2 (field+)
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOrderedByContainer012()
    {
        $children = [];
        $children[] = $this->createAnnotationElementHasParentFalse1TimeMock();
        $children[] = $this->createSelectorElementHasParentFalse1TimeMock();
        $children[] = $this->createFieldElementHasParentFalse1TimeMock();
        $children[] = $this->createFieldElementHasParentFalse1TimeMock();
        
        // Init container 2.
        $this->sut->addFieldElement($children[2]);
        $this->sut->addFieldElement($children[3]);
        
        // Init container 1.
        $this->sut->setSelectorElement($children[1]);
        
        // Init container 0.
        $this->sut->setAnnotationElement($children[0]);
        
        self::assertSame($children, $this->sut->getElements(), 'Elements ordered by container: 0, 1, 2.');
    }
}
