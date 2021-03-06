<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\ComplexTypeElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\ComplexTypeElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ComplexTypeElementTest extends AbstractAbstractTypeNamingElementTestCase
{
    use AbstractAttributeTestCaseTrait;
    use BlockAttributeTestCaseTrait;
    use FinalAttributeTestCaseTrait;
    use MixedAttributeTestCaseTrait;
    use NameAttributeTestCaseTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new ComplexTypeElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetLocalNameReturnsSpecificString(): void
    {
        self::assertSame('complexType', $this->sut->getLocalName());
    }
    
    /**
     * Tests that hasContentElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   content
     */
    public function testHasContentElement(): void
    {
        self::assertFalse($this->sut->hasContentElement(), 'No element has been set.');
        
        $this->sut->setContentElement($this->createSimpleContentElementHasParentFalse1TimeMock());
        self::assertTrue($this->sut->hasContentElement(), 'Set with an element: ContentElementInterface.');
    }
    
    /**
     * Tests that getContentElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   content
     */
    public function testGetContentElement(): void
    {
        self::assertNull($this->sut->getContentElement(), 'No element has been set.');
        
        $elt1 = $this->createSimpleContentElementHasParentFalse1TimeMock();
        $this->sut->setContentElement($elt1);
        self::assertSame($elt1, $this->sut->getContentElement(), 'Set with an element: SimpleContentElement.');
        
        $elt2 = $this->createComplexContentElementHasParentFalse1TimeMock();
        $this->sut->setContentElement($elt2);
        self::assertSame($elt2, $this->sut->getContentElement(), 'Set with another element: ComplexContentElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 1 ((simpleContent | complexContent)).
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOfContainer1(): void
    {
        $children = [];
        $children[] = $this->createComplexContentElementHasParentFalse1TimeMock();
        $this->sut->setContentElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 1.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in that order:
     * - elements from container 0 (annotation?)
     * - elements from container 1 ((simpleContent | complexContent))
     * - elements from container 2 ((group | all | choice | sequence)?)
     * - elements from container 3 ((attribute | attributeGroup)*)
     * - elements from container 4 (anyAttribute?)
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOrderedByContainer01234(): void
    {
        $children = [];
        $children[] = $this->createAnnotationElementHasParentFalse1TimeMock();
        $children[] = $this->createSimpleContentElementHasParentFalse1TimeMock();
        $children[] = $this->createSequenceElementHasParentFalse1TimeMock();
        $children[] = $this->createAttributeElementHasParentFalse1TimeMock();
        $children[] = $this->createAttributeGroupElementHasParentFalse1TimeMock();
        $children[] = $this->createAttributeElementHasParentFalse1TimeMock();
        $children[] = $this->createAttributeGroupElementHasParentFalse1TimeMock();
        $children[] = $this->createAnyAttributeElementHasParentFalse1TimeMock();
        
        // Init container 4.
        $this->sut->setAnyAttributeElement($children[7]);
        
        // Init container 3.
        $this->sut->addAttributeElement($children[3]);
        $this->sut->addAttributeGroupElement($children[4]);
        $this->sut->addAttributeElement($children[5]);
        $this->sut->addAttributeGroupElement($children[6]);
        
        // Init container 2.
        $this->sut->setTypeDefinitionParticleElement($children[2]);
        
        // Init container 1.
        $this->sut->setContentElement($children[1]);
        
        // Init container 0.
        $this->sut->setAnnotationElement($children[0]);
        
        self::assertSame($children, $this->sut->getElements(), 'Elements ordered by container: 0, 1, 2, 3, 4.');
    }
}
