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
 * extends the {@see PhpXmlSchema\Dom\AbstractTypeNamingElement} class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractTypeNamingElementTestCase extends AbstractAbstractTypeNamingElementTestCase
{
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in that order:
     * - elements from container 0 (annotation?)
     * - elements from container 2 ((group | all | choice | sequence)?)
     * - elements from container 3 ((attribute | attributeGroup)*)
     * - elements from container 4 (anyAttribute?)
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOrderedByContainer0234(): void
    {
        $children = [];
        $children[] = $this->createAnnotationElementHasParentFalse1TimeMock();
        $children[] = $this->createGroupElementHasParentFalse1TimeMock();
        $children[] = $this->createAttributeElementHasParentFalse1TimeMock();
        $children[] = $this->createAttributeGroupElementHasParentFalse1TimeMock();
        $children[] = $this->createAttributeElementHasParentFalse1TimeMock();
        $children[] = $this->createAttributeGroupElementHasParentFalse1TimeMock();
        $children[] = $this->createAnyAttributeElementHasParentFalse1TimeMock();
        
        // Init container 4.
        $this->sut->setAnyAttributeElement($children[6]);
        
        // Init container 3.
        $this->sut->addAttributeElement($children[2]);
        $this->sut->addAttributeGroupElement($children[3]);
        $this->sut->addAttributeElement($children[4]);
        $this->sut->addAttributeGroupElement($children[5]);
        
        // Init container 2.
        $this->sut->setTypeDefinitionParticleElement($children[1]);
        
        // Init container 0.
        $this->sut->setAnnotationElement($children[0]);
        
        self::assertSame($children, $this->sut->getElements(), 'Elements ordered by container: 0, 2, 3, 4.');
    }
}
