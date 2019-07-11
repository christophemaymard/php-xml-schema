<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\SimpleContentElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SimpleContentElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleContentElementTest extends AbstractAnnotatedElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SimpleContentElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetLocalNameReturnsSpecificString()
    {
        self::assertSame('simpleContent', $this->sut->getLocalName());
    }
    
    /**
     * Tests that hasDerivationElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   content
     */
    public function testHasDerivationElement()
    {
        self::assertFalse($this->sut->hasDerivationElement(), 'No element has been set.');
        
        $this->sut->setDerivationElement($this->createSimpleContentDerivationElementInterfaceDummy());
        self::assertTrue($this->sut->hasDerivationElement(), 'Set with an element: SimpleContentDerivationElementInterface.');
    }
    
    /**
     * Tests that getDerivationElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   content
     */
    public function testGetDerivationElement()
    {
        self::assertNull($this->sut->getDerivationElement(), 'No element has been set.');
        
        $elt1 = $this->createSimpleContentRestrictionElementDummy();
        $this->sut->setDerivationElement($elt1);
        self::assertSame($elt1, $this->sut->getDerivationElement(), 'Set with an element: SimpleContentRestrictionElement.');
        
        $elt2 = $this->createSimpleContentExtensionElementDummy();
        $this->sut->setDerivationElement($elt2);
        self::assertSame($elt2, $this->sut->getDerivationElement(), 'Set with another element: SimpleContentExtensionElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 1 ((restriction | extension)).
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOfContainer1()
    {
        $children = [];
        $children[] = $this->createSimpleContentDerivationElementInterfaceDummy();
        $this->sut->setDerivationElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 1.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in that order:
     * - elements from container 0 (annotation?)
     * - elements from container 1 ((restriction | extension))
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOrderedByContainer01()
    {
        $children = [];
        $children[] = $this->createAnnotationElementDummy();
        $children[] = $this->createSimpleContentDerivationElementInterfaceDummy();
        
        // Init container 1.
        $this->sut->setDerivationElement($children[1]);
        
        // Init container 0.
        $this->sut->setAnnotationElement($children[0]);
        
        self::assertSame($children, $this->sut->getElements(), 'Elements ordered by container: 0, 1.');
    }
}
