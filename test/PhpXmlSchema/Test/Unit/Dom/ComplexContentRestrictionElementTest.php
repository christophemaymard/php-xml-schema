<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\ComplexContentRestrictionElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\ComplexContentRestrictionElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ComplexContentRestrictionElementTest extends AbstractCompositeElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new ComplexContentRestrictionElement();
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
     * Tests that hasTypeDefinitionParticleElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   elt-content
     */
    public function testHasTypeDefinitionParticleElement()
    {
        self::assertFalse($this->sut->hasTypeDefinitionParticleElement(), 'No element has been set.');
        
        $this->sut->setTypeDefinitionParticleElement($this->createTypeDefinitionParticleElementInterfaceDummy());
        self::assertTrue($this->sut->hasTypeDefinitionParticleElement(), 'Set with an element: TypeDefinitionParticleElementInterface.');
    }
    
    /**
     * Tests that getTypeDefinitionParticleElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   elt-content
     */
    public function testGetTypeDefinitionParticleElement()
    {
        self::assertNull($this->sut->getTypeDefinitionParticleElement(), 'No element has been set.');
        
        $elt1 = $this->createGroupElementDummy();
        $this->sut->setTypeDefinitionParticleElement($elt1);
        self::assertSame($elt1, $this->sut->getTypeDefinitionParticleElement(), 'Set with an element: GroupElement.');
        
        $elt2 = $this->createAllElementDummy();
        $this->sut->setTypeDefinitionParticleElement($elt2);
        self::assertSame($elt2, $this->sut->getTypeDefinitionParticleElement(), 'Set with another element: AllElement.');
        
        $elt3 = $this->createChoiceElementDummy();
        $this->sut->setTypeDefinitionParticleElement($elt3);
        self::assertSame($elt3, $this->sut->getTypeDefinitionParticleElement(), 'Set with another element: ChoiceElement.');
        
        $elt4 = $this->createSequenceElementDummy();
        $this->sut->setTypeDefinitionParticleElement($elt4);
        self::assertSame($elt4, $this->sut->getTypeDefinitionParticleElement(), 'Set with another element: SequenceElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 1 ((group | all | choice | sequence)?).
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOfContainer1()
    {
        $children = [];
        $children[] = $this->createTypeDefinitionParticleElementInterfaceDummy();
        $this->sut->setTypeDefinitionParticleElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 1.');
    }
}
