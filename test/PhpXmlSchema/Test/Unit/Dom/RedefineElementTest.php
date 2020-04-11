<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\RedefineElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\RedefineElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class RedefineElementTest extends AbstractCompositeElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new RedefineElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetLocalNameReturnsSpecificString(): void
    {
        self::assertSame('redefine', $this->sut->getLocalName());
    }
    
    /**
     * Tests that hasSchemaLocation() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasSchemaLocation(): void
    {
        self::assertFalse($this->sut->hasSchemaLocation(), 'The attribute has not been set.');
        
        $this->sut->setSchemaLocation($this->createAnyUriTypeDummy());
        self::assertTrue($this->sut->hasSchemaLocation(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getSchemaLocation() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetSchemaLocation(): void
    {
        self::assertNull($this->sut->getSchemaLocation(), 'The attribute has not been set.');
        
        $value1 = $this->createAnyUriTypeDummy();
        $this->sut->setSchemaLocation($value1);
        self::assertSame($value1, $this->sut->getSchemaLocation(), 'Set the attribute with a value: AnyUriType.');
        
        $value2 = $this->createAnyUriTypeDummy();
        $this->sut->setSchemaLocation($value2);
        self::assertSame($value2, $this->sut->getSchemaLocation(), 'Set the attribute with another value: AnyUriType.');
    }
    
    /**
     * Tests that getAnnotationElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no AnnotationElement element has been added
     * - an indexed array of all added AnnotationElement elements
     * 
     * @group   content
     */
    public function testGetAnnotationElements(): void
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getAnnotationElements(), 'No element has been added.');
        
        $this->sut->addSimpleTypeElement($this->createSimpleTypeElementHasParentFalse1TimeMock());
        $this->sut->addComplexTypeElement($this->createComplexTypeElementHasParentFalse1TimeMock());
        $this->sut->addGroupElement($this->createGroupElementHasParentFalse1TimeMock());
        $this->sut->addAttributeGroupElement($this->createAttributeGroupElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getAnnotationElements(), 'Added elements but no AnnotationElement element.');
        
        $elements[] = $this->createAnnotationElementHasParentFalse1TimeMock();
        $this->sut->addAnnotationElement($elements[0]);
        self::assertSame($elements, $this->sut->getAnnotationElements(), 'Added 1 AnnotationElement element.');
        
        $this->sut->addSimpleTypeElement($this->createSimpleTypeElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getAnnotationElements(), 'Added 1 element between.');
        
        $elements[] = $this->createAnnotationElementHasParentFalse1TimeMock();
        $this->sut->addAnnotationElement($elements[1]);
        self::assertSame($elements, $this->sut->getAnnotationElements(), 'Added 2 AnnotationElement elements.');
    }
    
    /**
     * Tests that getSimpleTypeElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no SimpleTypeElement element has been added
     * - an indexed array of all added SimpleTypeElement elements
     * 
     * @group   content
     */
    public function testGetSimpleTypeElements(): void
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getSimpleTypeElements(), 'No element has been added.');
        
        $this->sut->addAnnotationElement($this->createAnnotationElementHasParentFalse1TimeMock());
        $this->sut->addComplexTypeElement($this->createComplexTypeElementHasParentFalse1TimeMock());
        $this->sut->addGroupElement($this->createGroupElementHasParentFalse1TimeMock());
        $this->sut->addAttributeGroupElement($this->createAttributeGroupElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getSimpleTypeElements(), 'Added elements but no SimpleTypeElement element.');
        
        $elements[] = $this->createSimpleTypeElementHasParentFalse1TimeMock();
        $this->sut->addSimpleTypeElement($elements[0]);
        self::assertSame($elements, $this->sut->getSimpleTypeElements(), 'Added 1 SimpleTypeElement element.');
        
        $this->sut->addComplexTypeElement($this->createComplexTypeElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getSimpleTypeElements(), 'Added 1 element between.');
        
        $elements[] = $this->createSimpleTypeElementHasParentFalse1TimeMock();
        $this->sut->addSimpleTypeElement($elements[1]);
        self::assertSame($elements, $this->sut->getSimpleTypeElements(), 'Added 2 SimpleTypeElement elements.');
    }
    
    /**
     * Tests that getComplexTypeElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no ComplexTypeElement element has been added
     * - an indexed array of all added ComplexTypeElement elements
     * 
     * @group   content
     */
    public function testGetComplexTypeElements(): void
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getComplexTypeElements(), 'No element has been added.');
        
        $this->sut->addAnnotationElement($this->createAnnotationElementHasParentFalse1TimeMock());
        $this->sut->addSimpleTypeElement($this->createSimpleTypeElementHasParentFalse1TimeMock());
        $this->sut->addGroupElement($this->createGroupElementHasParentFalse1TimeMock());
        $this->sut->addAttributeGroupElement($this->createAttributeGroupElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getComplexTypeElements(), 'Added elements but no ComplexTypeElement element.');
        
        $elements[] = $this->createComplexTypeElementHasParentFalse1TimeMock();
        $this->sut->addComplexTypeElement($elements[0]);
        self::assertSame($elements, $this->sut->getComplexTypeElements(), 'Added 1 ComplexTypeElement element.');
        
        $this->sut->addGroupElement($this->createGroupElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getComplexTypeElements(), 'Added 1 element between.');
        
        $elements[] = $this->createComplexTypeElementHasParentFalse1TimeMock();
        $this->sut->addComplexTypeElement($elements[1]);
        self::assertSame($elements, $this->sut->getComplexTypeElements(), 'Added 2 ComplexTypeElement elements.');
    }
    
    /**
     * Tests that getGroupElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no GroupElement element has been added
     * - an indexed array of all added GroupElement elements
     * 
     * @group   content
     */
    public function testGetGroupElements(): void
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getGroupElements(), 'No element has been added.');
        
        $this->sut->addAnnotationElement($this->createAnnotationElementHasParentFalse1TimeMock());
        $this->sut->addSimpleTypeElement($this->createSimpleTypeElementHasParentFalse1TimeMock());
        $this->sut->addComplexTypeElement($this->createComplexTypeElementHasParentFalse1TimeMock());
        $this->sut->addAttributeGroupElement($this->createAttributeGroupElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getGroupElements(), 'Added elements but no GroupElement element.');
        
        $elements[] = $this->createGroupElementHasParentFalse1TimeMock();
        $this->sut->addGroupElement($elements[0]);
        self::assertSame($elements, $this->sut->getGroupElements(), 'Added 1 GroupElement element.');
        
        $this->sut->addAttributeGroupElement($this->createAttributeGroupElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getGroupElements(), 'Added 1 element between.');
        
        $elements[] = $this->createGroupElementHasParentFalse1TimeMock();
        $this->sut->addGroupElement($elements[1]);
        self::assertSame($elements, $this->sut->getGroupElements(), 'Added 2 GroupElement elements.');
    }
    
    /**
     * Tests that getAttributeGroupElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no AttributeGroupElement element has been added
     * - an indexed array of all added AttributeGroupElement elements
     * 
     * @group   content
     */
    public function testGetAttributeGroupElements(): void
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'No element has been added.');
        
        $this->sut->addAnnotationElement($this->createAnnotationElementHasParentFalse1TimeMock());
        $this->sut->addSimpleTypeElement($this->createSimpleTypeElementHasParentFalse1TimeMock());
        $this->sut->addComplexTypeElement($this->createComplexTypeElementHasParentFalse1TimeMock());
        $this->sut->addGroupElement($this->createGroupElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'Added elements but no AttributeGroupElement element.');
        
        $elements[] = $this->createAttributeGroupElementHasParentFalse1TimeMock();
        $this->sut->addAttributeGroupElement($elements[0]);
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'Added 1 AttributeGroupElement element.');
        
        $this->sut->addAnnotationElement($this->createAnnotationElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'Added 1 element between.');
        
        $elements[] = $this->createAttributeGroupElementHasParentFalse1TimeMock();
        $this->sut->addAttributeGroupElement($elements[1]);
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'Added 2 AttributeGroupElement elements.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 0 ((annotation | (simpleType | complexType | group | attributeGroup))*).
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOfContainer0(): void
    {
        $children = [];
        $children[] = $this->createAnnotationElementHasParentFalse1TimeMock();
        $children[] = $this->createSimpleTypeElementHasParentFalse1TimeMock();
        $children[] = $this->createComplexTypeElementHasParentFalse1TimeMock();
        $children[] = $this->createGroupElementHasParentFalse1TimeMock();
        $children[] = $this->createAttributeGroupElementHasParentFalse1TimeMock();
        $children[] = $this->createAnnotationElementHasParentFalse1TimeMock();
        $children[] = $this->createSimpleTypeElementHasParentFalse1TimeMock();
        $children[] = $this->createComplexTypeElementHasParentFalse1TimeMock();
        $children[] = $this->createGroupElementHasParentFalse1TimeMock();
        $children[] = $this->createAttributeGroupElementHasParentFalse1TimeMock();
        $this->sut->addAnnotationElement($children[0]);
        $this->sut->addSimpleTypeElement($children[1]);
        $this->sut->addComplexTypeElement($children[2]);
        $this->sut->addGroupElement($children[3]);
        $this->sut->addAttributeGroupElement($children[4]);
        $this->sut->addAnnotationElement($children[5]);
        $this->sut->addSimpleTypeElement($children[6]);
        $this->sut->addComplexTypeElement($children[7]);
        $this->sut->addGroupElement($children[8]);
        $this->sut->addAttributeGroupElement($children[9]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 0.');
    }
}
