<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\GroupElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\GroupElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class GroupElementTest extends AbstractAnnotatedElementTestCase
{
    use MaxOccursAttributeTestCaseTrait;
    use MinOccursAttributeTestCaseTrait;
    use NameAttributeTestCaseTrait;
    use RefAttributeTestCaseTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new GroupElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetLocalNameReturnsSpecificString(): void
    {
        self::assertSame('group', $this->sut->getLocalName());
    }
    
    /**
     * Tests that hasModelGroupElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   content
     */
    public function testHasModelGroupElement(): void
    {
        self::assertFalse($this->sut->hasModelGroupElement(), 'No element has been set.');
        
        $this->sut->setModelGroupElement($this->createAllElementHasParentFalse1TimeMock());
        self::assertTrue($this->sut->hasModelGroupElement(), 'Set with an element: ModelGroupElementInterface.');
    }
    
    /**
     * Tests that getModelGroupElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   content
     */
    public function testGetModelGroupElement(): void
    {
        self::assertNull($this->sut->getModelGroupElement(), 'No element has been set.');
        
        $elt1 = $this->createAllElementHasParentFalse1TimeMock();
        $this->sut->setModelGroupElement($elt1);
        self::assertSame($elt1, $this->sut->getModelGroupElement(), 'Set with an element: AllElement.');
        
        $elt2 = $this->createChoiceElementHasParentFalse1TimeMock();
        $this->sut->setModelGroupElement($elt2);
        self::assertSame($elt2, $this->sut->getModelGroupElement(), 'Set with another element: ChoiceElement.');
        
        $elt3 = $this->createSequenceElementHasParentFalse1TimeMock();
        $this->sut->setModelGroupElement($elt3);
        self::assertSame($elt3, $this->sut->getModelGroupElement(), 'Set with another element: SequenceElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 1 ((all | choice | sequence)?).
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOfContainer1(): void
    {
        $children = [];
        $children[] = $this->createChoiceElementHasParentFalse1TimeMock();
        $this->sut->setModelGroupElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 1.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in that order:
     * - elements from container 0 (annotation?)
     * - elements from container 1 ((all | choice | sequence)?)
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOrderedByContainer01(): void
    {
        $children = [];
        $children[] = $this->createAnnotationElementHasParentFalse1TimeMock();
        $children[] = $this->createSequenceElementHasParentFalse1TimeMock();
        
        // Init container 1.
        $this->sut->setModelGroupElement($children[1]);
        
        // Init container 0.
        $this->sut->setAnnotationElement($children[0]);
        
        self::assertSame($children, $this->sut->getElements(), 'Elements ordered by container: 0, 1.');
    }
}
