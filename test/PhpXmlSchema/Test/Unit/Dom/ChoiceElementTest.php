<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\ChoiceElement;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\ChoiceElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ChoiceElementTest extends AbstractCompositeElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new ChoiceElement();
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
     * Tests that getElementElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no ElementElement element has been added
     * - an indexed array of all added ElementElement elements
     * 
     * @group   elt-content
     */
    public function testGetElementElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getElementElements(), 'No element has been added.');
        
        $this->sut->addGroupElement($this->createGroupElementDummy());
        $this->sut->addChoiceElement($this->createChoiceElementDummy());
        $this->sut->addSequenceElement($this->createSequenceElementDummy());
        $this->sut->addAnyElement($this->createAnyElementDummy());
        self::assertSame($elements, $this->sut->getElementElements(), 'Added elements but no ElementElement element.');
        
        $elements[] = $this->createElementElementDummy();
        $this->sut->addElementElement($elements[0]);
        self::assertSame($elements, $this->sut->getElementElements(), 'Added 1 ElementElement element.');
        
        $this->sut->addGroupElement($this->createGroupElementDummy());
        self::assertSame($elements, $this->sut->getElementElements(), 'Added 1 element between.');
        
        $elements[] = $this->createElementElementDummy();
        $this->sut->addElementElement($elements[1]);
        self::assertSame($elements, $this->sut->getElementElements(), 'Added 2 ElementElement elements.');
    }
    
    /**
     * Tests that getGroupElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no GroupElement element has been added
     * - an indexed array of all added GroupElement elements
     * 
     * @group   elt-content
     */
    public function testGetGroupElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getGroupElements(), 'No element has been added.');
        
        $this->sut->addElementElement($this->createElementElementDummy());
        $this->sut->addChoiceElement($this->createChoiceElementDummy());
        $this->sut->addSequenceElement($this->createSequenceElementDummy());
        $this->sut->addAnyElement($this->createAnyElementDummy());
        self::assertSame($elements, $this->sut->getGroupElements(), 'Added elements but no GroupElement element.');
        
        $elements[] = $this->createGroupElementDummy();
        $this->sut->addGroupElement($elements[0]);
        self::assertSame($elements, $this->sut->getGroupElements(), 'Added 1 GroupElement element.');
        
        $this->sut->addChoiceElement($this->createChoiceElementDummy());
        self::assertSame($elements, $this->sut->getGroupElements(), 'Added 1 element between.');
        
        $elements[] = $this->createGroupElementDummy();
        $this->sut->addGroupElement($elements[1]);
        self::assertSame($elements, $this->sut->getGroupElements(), 'Added 2 GroupElement elements.');
    }
    
    /**
     * Tests that getChoiceElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no ChoiceElement element has been added
     * - an indexed array of all added ChoiceElement elements
     * 
     * @group   elt-content
     */
    public function testGetChoiceElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getChoiceElements(), 'No element has been added.');
        
        $this->sut->addElementElement($this->createElementElementDummy());
        $this->sut->addGroupElement($this->createGroupElementDummy());
        $this->sut->addSequenceElement($this->createSequenceElementDummy());
        $this->sut->addAnyElement($this->createAnyElementDummy());
        self::assertSame($elements, $this->sut->getChoiceElements(), 'Added elements but no ChoiceElement element.');
        
        $elements[] = $this->createChoiceElementDummy();
        $this->sut->addChoiceElement($elements[0]);
        self::assertSame($elements, $this->sut->getChoiceElements(), 'Added 1 ChoiceElement element.');
        
        $this->sut->addSequenceElement($this->createSequenceElementDummy());
        self::assertSame($elements, $this->sut->getChoiceElements(), 'Added 1 element between.');
        
        $elements[] = $this->createChoiceElementDummy();
        $this->sut->addChoiceElement($elements[1]);
        self::assertSame($elements, $this->sut->getChoiceElements(), 'Added 2 ChoiceElement elements.');
    }
    
    /**
     * Tests that getSequenceElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no SequenceElement element has been added
     * - an indexed array of all added SequenceElement elements
     * 
     * @group   elt-content
     */
    public function testGetSequenceElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getSequenceElements(), 'No element has been added.');
        
        $this->sut->addElementElement($this->createElementElementDummy());
        $this->sut->addGroupElement($this->createGroupElementDummy());
        $this->sut->addChoiceElement($this->createChoiceElementDummy());
        $this->sut->addAnyElement($this->createAnyElementDummy());
        self::assertSame($elements, $this->sut->getSequenceElements(), 'Added elements but no SequenceElement element.');
        
        $elements[] = $this->createSequenceElementDummy();
        $this->sut->addSequenceElement($elements[0]);
        self::assertSame($elements, $this->sut->getSequenceElements(), 'Added 1 SequenceElement element.');
        
        $this->sut->addAnyElement($this->createAnyElementDummy());
        self::assertSame($elements, $this->sut->getSequenceElements(), 'Added 1 element between.');
        
        $elements[] = $this->createSequenceElementDummy();
        $this->sut->addSequenceElement($elements[1]);
        self::assertSame($elements, $this->sut->getSequenceElements(), 'Added 2 SequenceElement elements.');
    }
    
    /**
     * Tests that getAnyElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no AnyElement element has been added
     * - an indexed array of all added AnyElement elements
     * 
     * @group   elt-content
     */
    public function testGetAnyElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getAnyElements(), 'No element has been added.');
        
        $this->sut->addElementElement($this->createElementElementDummy());
        $this->sut->addGroupElement($this->createGroupElementDummy());
        $this->sut->addChoiceElement($this->createChoiceElementDummy());
        $this->sut->addSequenceElement($this->createSequenceElementDummy());
        self::assertSame($elements, $this->sut->getAnyElements(), 'Added elements but no AnyElement element.');
        
        $elements[] = $this->createAnyElementDummy();
        $this->sut->addAnyElement($elements[0]);
        self::assertSame($elements, $this->sut->getAnyElements(), 'Added 1 AnyElement element.');
        
        $this->sut->addElementElement($this->createElementElementDummy());
        self::assertSame($elements, $this->sut->getAnyElements(), 'Added 1 element between.');
        
        $elements[] = $this->createAnyElementDummy();
        $this->sut->addAnyElement($elements[1]);
        self::assertSame($elements, $this->sut->getAnyElements(), 'Added 2 AnyElement elements.');
    }
    
    /**
     * Tests that getParticleElements() returns:
     * - an empty array when no element has been added
     * - an indexed array of all added particle elements in container 1 (element*)
     * 
     * @group   elt-content
     */
    public function testGetParticleElements()
    {
        self::assertSame([], $this->sut->getParticleElements(), 'No element has been added.');
        
        self::assertSame($this->fillSutContainer1(), $this->sut->getParticleElements(), 'Added 10 particle elements.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 1 ((element | group | choice | sequence | any)*).
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOfContainer1()
    {
        self::assertSame($this->fillSutContainer1(), $this->sut->getElements(), 'Elements in container 1.');
    }
    
    /**
     * Fills the container 1 ((element | group | choice | sequence | any)*) 
     * of the SUT with a set of elements.
     * 
     * @return  ProphecySubjectInterface[]  An indexed array of all the created elements.
     */
    private function fillSutContainer1():array
    {
        $elements = [];
        $elements[] = $this->createElementElementDummy();
        $elements[] = $this->createGroupElementDummy();
        $elements[] = $this->createChoiceElementDummy();
        $elements[] = $this->createSequenceElementDummy();
        $elements[] = $this->createAnyElementDummy();
        $elements[] = $this->createElementElementDummy();
        $elements[] = $this->createGroupElementDummy();
        $elements[] = $this->createChoiceElementDummy();
        $elements[] = $this->createSequenceElementDummy();
        $elements[] = $this->createAnyElementDummy();
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
