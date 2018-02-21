<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the base class to unit test a XML schema element that directly 
 * extends the {@see PhpXmlSchema\Dom\AbstractAttributeNamingElement} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractAttributeNamingElementTestCase extends AbstractAbstractAttributeNamingElementTestCase
{
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in that order:
     * - elements from container 0 (annotation?)
     * - elements from container 3 ((attribute | attributeGroup)*)
     * - elements from container 4 (anyAttribute?)
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOrderedByContainer034()
    {
        $children = [];
        $children[] = $this->createAnnotationElementDummy();
        $children[] = $this->createAttributeElementDummy();
        $children[] = $this->createAttributeGroupElementDummy();
        $children[] = $this->createAttributeElementDummy();
        $children[] = $this->createAttributeGroupElementDummy();
        $children[] = $this->createAnyAttributeElementDummy();
        
        // Init container 4.
        $this->sut->setAnyAttributeElement($children[5]);
        
        // Init container 3.
        $this->sut->addAttributeElement($children[1]);
        $this->sut->addAttributeGroupElement($children[2]);
        $this->sut->addAttributeElement($children[3]);
        $this->sut->addAttributeGroupElement($children[4]);
        
        // Init container 0.
        $this->sut->setAnnotationElement($children[0]);
        
        self::assertSame($children, $this->sut->getElements(), 'Elements ordered by container: 0, 3, 4.');
    }
}
