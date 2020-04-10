<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\UnionElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\UnionElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class UnionElementTest extends AbstractAnnotatedElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new UnionElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetLocalNameReturnsSpecificString()
    {
        self::assertSame('union', $this->sut->getLocalName());
    }
    
    /**
     * Tests that hasMemberTypes() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasMemberTypes()
    {
        self::assertFalse($this->sut->hasMemberTypes(), 'The attribute has not been set.');
        
        $this->sut->addMemberType($this->createQNameTypeDummy());
        self::assertTrue($this->sut->hasMemberTypes(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getMemberTypes() returns:
     * - an empty array when no QName has been added
     * - an indexed array of all added QName
     * 
     * @group   attribute
     */
    public function testGetMemberTypes()
    {
        $qnames = [];
        
        self::assertSame($qnames, $this->sut->getMemberTypes(), 'No QName has been added.');
        
        $qnames[] = $this->createQNameTypeDummy();
        $this->sut->addMemberType($qnames[0]);
        self::assertSame($qnames, $this->sut->getMemberTypes(), 'Added 1 instance of QName.');
        
        $qnames[] = $this->createQNameTypeDummy();
        $this->sut->addMemberType($qnames[1]);
        self::assertSame($qnames, $this->sut->getMemberTypes(), 'Added 2 instances of QName.');
    }
    
    /**
     * Tests that getSimpleTypeElements() returns:
     * - an empty array when no element has been added
     * - an indexed array of all added SimpleTypeElement elements
     * 
     * @group   content
     */
    public function testGetSimpleTypeElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getSimpleTypeElements(), 'No element has been added.');
        
        $elements[] = $this->createSimpleTypeElementHasParentFalse1TimeMock();
        $this->sut->addSimpleTypeElement($elements[0]);
        self::assertSame($elements, $this->sut->getSimpleTypeElements(), 'Added 1 SimpleTypeElement element.');
        
        $elements[] = $this->createSimpleTypeElementHasParentFalse1TimeMock();
        $this->sut->addSimpleTypeElement($elements[1]);
        self::assertSame($elements, $this->sut->getSimpleTypeElements(), 'Added 2 SimpleTypeElement elements.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 1 (simpleType*).
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOfContainer1()
    {
        $children = [];
        $children[] = $this->createSimpleTypeElementHasParentFalse1TimeMock();
        $children[] = $this->createSimpleTypeElementHasParentFalse1TimeMock();
        $this->sut->addSimpleTypeElement($children[0]);
        $this->sut->addSimpleTypeElement($children[1]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 1.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in that order:
     * - elements from container 0 (annotation?)
     * - elements from container 1 (simpleType*)
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOrderedByContainer01()
    {
        $children = [];
        $children[] = $this->createAnnotationElementHasParentFalse1TimeMock();
        $children[] = $this->createSimpleTypeElementHasParentFalse1TimeMock();
        $children[] = $this->createSimpleTypeElementHasParentFalse1TimeMock();
        
        // Init container 1.
        $this->sut->addSimpleTypeElement($children[1]);
        $this->sut->addSimpleTypeElement($children[2]);
        
        // Init container 0.
        $this->sut->setAnnotationElement($children[0]);
        
        self::assertSame($children, $this->sut->getElements(), 'Elements ordered by container: 0, 1.');
    }
}
