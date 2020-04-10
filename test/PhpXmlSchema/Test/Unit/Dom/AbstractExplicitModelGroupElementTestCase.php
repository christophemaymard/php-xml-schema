<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the base class to unit test a XML schema element that directly 
 * extends the {@see PhpXmlSchema\Dom\AbstractExplicitModelGroupElement} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractExplicitModelGroupElementTestCase extends AbstractModelGroupElementTestCase
{
    /**
     * Tests that getElementElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no ElementElement element has been added
     * - an indexed array of all added ElementElement elements
     * 
     * @group   content
     */
    public function testGetElementElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getElementElements(), 'No element has been added.');
        
        $this->sut->addGroupElement($this->createGroupElementHasParentFalse1TimeMock());
        $this->sut->addChoiceElement($this->createChoiceElementHasParentFalse1TimeMock());
        $this->sut->addSequenceElement($this->createSequenceElementHasParentFalse1TimeMock());
        $this->sut->addAnyElement($this->createAnyElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getElementElements(), 'Added elements but no ElementElement element.');
        
        $elements[] = $this->createElementElementHasParentFalse1TimeMock();
        $this->sut->addElementElement($elements[0]);
        self::assertSame($elements, $this->sut->getElementElements(), 'Added 1 ElementElement element.');
        
        $this->sut->addGroupElement($this->createGroupElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getElementElements(), 'Added 1 element between.');
        
        $elements[] = $this->createElementElementHasParentFalse1TimeMock();
        $this->sut->addElementElement($elements[1]);
        self::assertSame($elements, $this->sut->getElementElements(), 'Added 2 ElementElement elements.');
    }
    
    /**
     * Tests that getGroupElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no GroupElement element has been added
     * - an indexed array of all added GroupElement elements
     * 
     * @group   content
     */
    public function testGetGroupElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getGroupElements(), 'No element has been added.');
        
        $this->sut->addElementElement($this->createElementElementHasParentFalse1TimeMock());
        $this->sut->addChoiceElement($this->createChoiceElementHasParentFalse1TimeMock());
        $this->sut->addSequenceElement($this->createSequenceElementHasParentFalse1TimeMock());
        $this->sut->addAnyElement($this->createAnyElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getGroupElements(), 'Added elements but no GroupElement element.');
        
        $elements[] = $this->createGroupElementHasParentFalse1TimeMock();
        $this->sut->addGroupElement($elements[0]);
        self::assertSame($elements, $this->sut->getGroupElements(), 'Added 1 GroupElement element.');
        
        $this->sut->addChoiceElement($this->createChoiceElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getGroupElements(), 'Added 1 element between.');
        
        $elements[] = $this->createGroupElementHasParentFalse1TimeMock();
        $this->sut->addGroupElement($elements[1]);
        self::assertSame($elements, $this->sut->getGroupElements(), 'Added 2 GroupElement elements.');
    }
    
    /**
     * Tests that getChoiceElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no ChoiceElement element has been added
     * - an indexed array of all added ChoiceElement elements
     * 
     * @group   content
     */
    public function testGetChoiceElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getChoiceElements(), 'No element has been added.');
        
        $this->sut->addElementElement($this->createElementElementHasParentFalse1TimeMock());
        $this->sut->addGroupElement($this->createGroupElementHasParentFalse1TimeMock());
        $this->sut->addSequenceElement($this->createSequenceElementHasParentFalse1TimeMock());
        $this->sut->addAnyElement($this->createAnyElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getChoiceElements(), 'Added elements but no ChoiceElement element.');
        
        $elements[] = $this->createChoiceElementHasParentFalse1TimeMock();
        $this->sut->addChoiceElement($elements[0]);
        self::assertSame($elements, $this->sut->getChoiceElements(), 'Added 1 ChoiceElement element.');
        
        $this->sut->addSequenceElement($this->createSequenceElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getChoiceElements(), 'Added 1 element between.');
        
        $elements[] = $this->createChoiceElementHasParentFalse1TimeMock();
        $this->sut->addChoiceElement($elements[1]);
        self::assertSame($elements, $this->sut->getChoiceElements(), 'Added 2 ChoiceElement elements.');
    }
    
    /**
     * Tests that getSequenceElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no SequenceElement element has been added
     * - an indexed array of all added SequenceElement elements
     * 
     * @group   content
     */
    public function testGetSequenceElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getSequenceElements(), 'No element has been added.');
        
        $this->sut->addElementElement($this->createElementElementHasParentFalse1TimeMock());
        $this->sut->addGroupElement($this->createGroupElementHasParentFalse1TimeMock());
        $this->sut->addChoiceElement($this->createChoiceElementHasParentFalse1TimeMock());
        $this->sut->addAnyElement($this->createAnyElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getSequenceElements(), 'Added elements but no SequenceElement element.');
        
        $elements[] = $this->createSequenceElementHasParentFalse1TimeMock();
        $this->sut->addSequenceElement($elements[0]);
        self::assertSame($elements, $this->sut->getSequenceElements(), 'Added 1 SequenceElement element.');
        
        $this->sut->addAnyElement($this->createAnyElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getSequenceElements(), 'Added 1 element between.');
        
        $elements[] = $this->createSequenceElementHasParentFalse1TimeMock();
        $this->sut->addSequenceElement($elements[1]);
        self::assertSame($elements, $this->sut->getSequenceElements(), 'Added 2 SequenceElement elements.');
    }
    
    /**
     * Tests that getAnyElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no AnyElement element has been added
     * - an indexed array of all added AnyElement elements
     * 
     * @group   content
     */
    public function testGetAnyElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getAnyElements(), 'No element has been added.');
        
        $this->sut->addElementElement($this->createElementElementHasParentFalse1TimeMock());
        $this->sut->addGroupElement($this->createGroupElementHasParentFalse1TimeMock());
        $this->sut->addChoiceElement($this->createChoiceElementHasParentFalse1TimeMock());
        $this->sut->addSequenceElement($this->createSequenceElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getAnyElements(), 'Added elements but no AnyElement element.');
        
        $elements[] = $this->createAnyElementHasParentFalse1TimeMock();
        $this->sut->addAnyElement($elements[0]);
        self::assertSame($elements, $this->sut->getAnyElements(), 'Added 1 AnyElement element.');
        
        $this->sut->addElementElement($this->createElementElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getAnyElements(), 'Added 1 element between.');
        
        $elements[] = $this->createAnyElementHasParentFalse1TimeMock();
        $this->sut->addAnyElement($elements[1]);
        self::assertSame($elements, $this->sut->getAnyElements(), 'Added 2 AnyElement elements.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in that order:
     * - elements from container 0 (annotation?)
     * - elements from container 1 ((element | group | choice | sequence | any)*)
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOrderedByContainer01()
    {
        $children = [];
        $children[] = $this->createAnnotationElementHasParentFalse1TimeMock();
        $children[] = $this->createElementElementHasParentFalse1TimeMock();
        $children[] = $this->createGroupElementHasParentFalse1TimeMock();
        $children[] = $this->createChoiceElementHasParentFalse1TimeMock();
        $children[] = $this->createSequenceElementHasParentFalse1TimeMock();
        $children[] = $this->createAnyElementHasParentFalse1TimeMock();
        $children[] = $this->createElementElementHasParentFalse1TimeMock();
        $children[] = $this->createGroupElementHasParentFalse1TimeMock();
        $children[] = $this->createChoiceElementHasParentFalse1TimeMock();
        $children[] = $this->createSequenceElementHasParentFalse1TimeMock();
        $children[] = $this->createAnyElementHasParentFalse1TimeMock();
        
        // Init container 1.
        $this->sut->addElementElement($children[1]);
        $this->sut->addGroupElement($children[2]);
        $this->sut->addChoiceElement($children[3]);
        $this->sut->addSequenceElement($children[4]);
        $this->sut->addAnyElement($children[5]);
        $this->sut->addElementElement($children[6]);
        $this->sut->addGroupElement($children[7]);
        $this->sut->addChoiceElement($children[8]);
        $this->sut->addSequenceElement($children[9]);
        $this->sut->addAnyElement($children[10]);
        
        // Init container 0.
        $this->sut->setAnnotationElement($children[0]);
        
        self::assertSame($children, $this->sut->getElements(), 'Elements ordered by container: 0, 1.');
    }
    
    /**
     * Fills the container 1 ((element | group | choice | sequence | any)*) 
     * of the SUT with a set of elements.
     * 
     * @return  ProphecySubjectInterface[]  An indexed array of all the created elements.
     */
    protected function fillSutContainer1():array
    {
        $elements = [];
        $elements[] = $this->createElementElementHasParentFalse1TimeMock();
        $elements[] = $this->createGroupElementHasParentFalse1TimeMock();
        $elements[] = $this->createChoiceElementHasParentFalse1TimeMock();
        $elements[] = $this->createSequenceElementHasParentFalse1TimeMock();
        $elements[] = $this->createAnyElementHasParentFalse1TimeMock();
        $elements[] = $this->createElementElementHasParentFalse1TimeMock();
        $elements[] = $this->createGroupElementHasParentFalse1TimeMock();
        $elements[] = $this->createChoiceElementHasParentFalse1TimeMock();
        $elements[] = $this->createSequenceElementHasParentFalse1TimeMock();
        $elements[] = $this->createAnyElementHasParentFalse1TimeMock();
        $this->sut->addElementElement($elements[0]);
        $this->sut->addGroupElement($elements[1]);
        $this->sut->addChoiceElement($elements[2]);
        $this->sut->addSequenceElement($elements[3]);
        $this->sut->addAnyElement($elements[4]);
        $this->sut->addElementElement($elements[5]);
        $this->sut->addGroupElement($elements[6]);
        $this->sut->addChoiceElement($elements[7]);
        $this->sut->addSequenceElement($elements[8]);
        $this->sut->addAnyElement($elements[9]);
        
        return $elements;
    }
}