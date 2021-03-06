<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the base class to unit test the {@see PhpXmlSchema\Dom\AbstractTypeNamingElement} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractAbstractTypeNamingElementTestCase extends AbstractAbstractAttributeNamingElementTestCase
{
    /**
     * Tests that hasTypeDefinitionParticleElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   content
     */
    public function testHasTypeDefinitionParticleElement(): void
    {
        self::assertFalse($this->sut->hasTypeDefinitionParticleElement(), 'No element has been set.');
        
        $this->sut->setTypeDefinitionParticleElement($this->createAllElementHasParentFalse1TimeMock());
        self::assertTrue($this->sut->hasTypeDefinitionParticleElement(), 'Set with an element: TypeDefinitionParticleElementInterface.');
    }
    
    /**
     * Tests that getTypeDefinitionParticleElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   content
     */
    public function testGetTypeDefinitionParticleElement(): void
    {
        self::assertNull($this->sut->getTypeDefinitionParticleElement(), 'No element has been set.');
        
        $elt1 = $this->createGroupElementHasParentFalse1TimeMock();
        $this->sut->setTypeDefinitionParticleElement($elt1);
        self::assertSame($elt1, $this->sut->getTypeDefinitionParticleElement(), 'Set with an element: GroupElement.');
        
        $elt2 = $this->createAllElementHasParentFalse1TimeMock();
        $this->sut->setTypeDefinitionParticleElement($elt2);
        self::assertSame($elt2, $this->sut->getTypeDefinitionParticleElement(), 'Set with another element: AllElement.');
        
        $elt3 = $this->createChoiceElementHasParentFalse1TimeMock();
        $this->sut->setTypeDefinitionParticleElement($elt3);
        self::assertSame($elt3, $this->sut->getTypeDefinitionParticleElement(), 'Set with another element: ChoiceElement.');
        
        $elt4 = $this->createSequenceElementHasParentFalse1TimeMock();
        $this->sut->setTypeDefinitionParticleElement($elt4);
        self::assertSame($elt4, $this->sut->getTypeDefinitionParticleElement(), 'Set with another element: SequenceElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 2 ((group | all | choice | sequence)?).
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOfContainer2(): void
    {
        $children = [];
        $children[] = $this->createChoiceElementHasParentFalse1TimeMock();
        $this->sut->setTypeDefinitionParticleElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 2.');
    }
}