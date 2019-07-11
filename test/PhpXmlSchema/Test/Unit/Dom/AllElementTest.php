<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\AllElement;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\AllElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AllElementTest extends AbstractModelGroupElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new AllElement();
    }
    
    /**
     * Tests that getElementElements() returns:
     * - an empty array when no element has been added
     * - an indexed array of all added ElementElement elements
     * 
     * @group   content
     */
    public function testGetElementElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getElementElements(), 'No element has been added.');
        
        $elements[] = $this->createElementElementDummy();
        $this->sut->addElementElement($elements[0]);
        self::assertSame($elements, $this->sut->getElementElements(), 'Added 1 ElementElement element.');
        
        $elements[] = $this->createElementElementDummy();
        $this->sut->addElementElement($elements[1]);
        self::assertSame($elements, $this->sut->getElementElements(), 'Added 2 ElementElement elements.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in that order:
     * - elements from container 0 (annotation?)
     * - elements from container 1 (element*)
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOrderedByContainer01()
    {
        $children = [];
        $children[] = $this->createAnnotationElementDummy();
        $children[] = $this->createElementElementDummy();
        $children[] = $this->createElementElementDummy();
        
        // Init container 1.
        $this->sut->addElementElement($children[1]);
        $this->sut->addElementElement($children[2]);
        
        // Init container 0.
        $this->sut->setAnnotationElement($children[0]);
        
        self::assertSame($children, $this->sut->getElements(), 'Elements ordered by container: 0, 1.');
    }
    
    /**
     * Fills the container 1 (element*) of the SUT with a set of elements.
     * 
     * @return  ProphecySubjectInterface[]  An indexed array of all the created elements.
     */
    protected function fillSutContainer1():array
    {
        $elements = [];
        $elements[] = $this->createElementElementDummy();
        $elements[] = $this->createElementElementDummy();
        $this->sut->addElementElement($elements[0]);
        $this->sut->addElementElement($elements[1]);
        
        return $elements;
    }
}
