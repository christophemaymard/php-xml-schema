<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\ComplexContentElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\ComplexContentElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ComplexContentElementTest extends AbstractAnnotatedElementTestCase
{
    use MixedAttributeTestCaseTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new ComplexContentElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetLocalNameReturnsSpecificString()
    {
        self::assertSame('complexContent', $this->sut->getLocalName());
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
        
        $this->sut->setDerivationElement($this->createComplexContentDerivationElementInterfaceDummy());
        self::assertTrue($this->sut->hasDerivationElement(), 'Set with an element: ComplexContentDerivationElementInterface.');
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
        
        $elt1 = $this->createComplexContentRestrictionElementDummy();
        $this->sut->setDerivationElement($elt1);
        self::assertSame($elt1, $this->sut->getDerivationElement(), 'Set with an element: ComplexContentRestrictionElement.');
        
        $elt2 = $this->createComplexContentExtensionElementDummy();
        $this->sut->setDerivationElement($elt2);
        self::assertSame($elt2, $this->sut->getDerivationElement(), 'Set with another element: ComplexContentExtensionElement.');
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
        $children[] = $this->createComplexContentDerivationElementInterfaceDummy();
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
        $children[] = $this->createComplexContentDerivationElementInterfaceDummy();
        
        // Init container 1.
        $this->sut->setDerivationElement($children[1]);
        
        // Init container 0.
        $this->sut->setAnnotationElement($children[0]);
        
        self::assertSame($children, $this->sut->getElements(), 'Elements ordered by container: 0, 1.');
    }
}
