<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\ElementElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\ElementElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ElementElementTest extends AbstractAnnotatedElementTestCase
{
    use AbstractAttributeTestCaseTrait;
    use DefaultAttributeTestCaseTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new ElementElement();
    }
    
    /**
     * Tests that hasTypeElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   elt-content
     */
    public function testHasTypeElement()
    {
        self::assertFalse($this->sut->hasTypeElement(), 'No element has been set.');
        
        $this->sut->setTypeElement($this->createTypeElementInterfaceDummy());
        self::assertTrue($this->sut->hasTypeElement(), 'Set with an element: TypeElementInterface.');
    }
    
    /**
     * Tests that getTypeElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   elt-content
     */
    public function testGetTypeElement()
    {
        self::assertNull($this->sut->getTypeElement(), 'No element has been set.');
        
        $elt1 = $this->createSimpleTypeElementDummy();
        $this->sut->setTypeElement($elt1);
        self::assertSame($elt1, $this->sut->getTypeElement(), 'Set with an element: SimpleTypeElement.');
        
        $elt2 = $this->createComplexTypeElementDummy();
        $this->sut->setTypeElement($elt2);
        self::assertSame($elt2, $this->sut->getTypeElement(), 'Set with another element: ComplexTypeElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 1 ((simpleType | complexType)?).
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOfContainer1()
    {
        $children = [];
        $children[] = $this->createTypeElementInterfaceDummy();
        $this->sut->setTypeElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 1.');
    }
    
    /**
     * Tests that getUniqueElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no UniqueElement element has been added
     * - an indexed array of all added UniqueElement elements
     * 
     * @group   elt-content
     */
    public function testGetUniqueElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getUniqueElements(), 'No element has been added.');
        
        $this->sut->addKeyElement($this->createKeyElementDummy());
        $this->sut->addKeyRefElement($this->createKeyRefElementDummy());
        self::assertSame($elements, $this->sut->getUniqueElements(), 'Added elements but no UniqueElement element.');
        
        $elements[] = $this->createUniqueElementDummy();
        $this->sut->addUniqueElement($elements[0]);
        self::assertSame($elements, $this->sut->getUniqueElements(), 'Added 1 UniqueElement element.');
        
        $this->sut->addKeyElement($this->createKeyElementDummy());
        self::assertSame($elements, $this->sut->getUniqueElements(), 'Added 1 element between.');
        
        $elements[] = $this->createUniqueElementDummy();
        $this->sut->addUniqueElement($elements[1]);
        self::assertSame($elements, $this->sut->getUniqueElements(), 'Added 2 UniqueElement elements.');
    }
    
    /**
     * Tests that getKeyElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no KeyElement element has been added
     * - an indexed array of all added KeyElement elements
     * 
     * @group   elt-content
     */
    public function testGetKeyElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getKeyElements(), 'No element has been added.');
        
        $this->sut->addUniqueElement($this->createUniqueElementDummy());
        $this->sut->addKeyRefElement($this->createKeyRefElementDummy());
        self::assertSame($elements, $this->sut->getKeyElements(), 'Added elements but no KeyElement element.');
        
        $elements[] = $this->createKeyElementDummy();
        $this->sut->addKeyElement($elements[0]);
        self::assertSame($elements, $this->sut->getKeyElements(), 'Added 1 KeyElement element.');
        
        $this->sut->addKeyRefElement($this->createKeyRefElementDummy());
        self::assertSame($elements, $this->sut->getKeyElements(), 'Added 1 element between.');
        
        $elements[] = $this->createKeyElementDummy();
        $this->sut->addKeyElement($elements[1]);
        self::assertSame($elements, $this->sut->getKeyElements(), 'Added 2 KeyElement elements.');
    }
    
    /**
     * Tests that getKeyRefElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no KeyRefElement element has been added
     * - an indexed array of all added KeyRefElement elements
     * 
     * @group   elt-content
     */
    public function testGetKeyRefElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getKeyRefElements(), 'No element has been added.');
        
        $this->sut->addUniqueElement($this->createUniqueElementDummy());
        $this->sut->addKeyElement($this->createKeyElementDummy());
        self::assertSame($elements, $this->sut->getKeyRefElements(), 'Added elements but no KeyRefElement element.');
        
        $elements[] = $this->createKeyRefElementDummy();
        $this->sut->addKeyRefElement($elements[0]);
        self::assertSame($elements, $this->sut->getKeyRefElements(), 'Added 1 KeyRefElement element.');
        
        $this->sut->addUniqueElement($this->createUniqueElementDummy());
        self::assertSame($elements, $this->sut->getKeyRefElements(), 'Added 1 element between.');
        
        $elements[] = $this->createKeyRefElementDummy();
        $this->sut->addKeyRefElement($elements[1]);
        self::assertSame($elements, $this->sut->getKeyRefElements(), 'Added 2 KeyRefElement elements.');
    }
    
    /**
     * Tests that getIdentityConstraintElements() returns:
     * - an empty array when no element has been added
     * - an indexed array of all added identity-constraint elements
     * 
     * @group   elt-content
     */
    public function testGetIdentityConstraintElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getIdentityConstraintElements(), 'No element has been added.');
        
        $elements[] = $this->createUniqueElementDummy();
        $elements[] = $this->createKeyElementDummy();
        $elements[] = $this->createKeyRefElementDummy();
        $elements[] = $this->createUniqueElementDummy();
        $elements[] = $this->createKeyElementDummy();
        $elements[] = $this->createKeyRefElementDummy();
        $this->sut->addUniqueElement($elements[0]);
        $this->sut->addKeyElement($elements[1]);
        $this->sut->addKeyRefElement($elements[2]);
        $this->sut->addUniqueElement($elements[3]);
        $this->sut->addKeyElement($elements[4]);
        $this->sut->addKeyRefElement($elements[5]);
        self::assertSame($elements, $this->sut->getIdentityConstraintElements(), 'Added 6 identity-constraint elements.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 2 ((unique | key | keyref)*).
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOfContainer2()
    {
        $children = [];
        $children[] = $this->createUniqueElementDummy();
        $children[] = $this->createKeyElementDummy();
        $children[] = $this->createKeyRefElementDummy();
        $children[] = $this->createUniqueElementDummy();
        $children[] = $this->createKeyElementDummy();
        $children[] = $this->createKeyRefElementDummy();
        $this->sut->addUniqueElement($children[0]);
        $this->sut->addKeyElement($children[1]);
        $this->sut->addKeyRefElement($children[2]);
        $this->sut->addUniqueElement($children[3]);
        $this->sut->addKeyElement($children[4]);
        $this->sut->addKeyRefElement($children[5]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 2.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in that order:
     * - elements from container 0 (annotation?)
     * - elements from container 1 ((simpleType | complexType)?)
     * - elements from container 2 ((unique | key | keyref)*)
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOrderedByContainer012()
    {
        $children = [];
        $children[] = $this->createAnnotationElementDummy();
        $children[] = $this->createTypeElementInterfaceDummy();
        $children[] = $this->createUniqueElementDummy();
        $children[] = $this->createKeyElementDummy();
        $children[] = $this->createKeyRefElementDummy();
        $children[] = $this->createUniqueElementDummy();
        $children[] = $this->createKeyElementDummy();
        $children[] = $this->createKeyRefElementDummy();
        
        // Init container 2.
        $this->sut->addUniqueElement($children[2]);
        $this->sut->addKeyElement($children[3]);
        $this->sut->addKeyRefElement($children[4]);
        $this->sut->addUniqueElement($children[5]);
        $this->sut->addKeyElement($children[6]);
        $this->sut->addKeyRefElement($children[7]);
        
        // Init container 1.
        $this->sut->setTypeElement($children[1]);
        
        // Init container 0.
        $this->sut->setAnnotationElement($children[0]);
        
        self::assertSame($children, $this->sut->getElements(), 'Elements ordered by container: 0, 1, 2.');
    }
    
    /**
     * Tests that hasNillable() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   elt-attribute
     */
    public function testHasNillable()
    {
        self::assertFalse($this->sut->hasNillable(), 'The attribute has not been set.');
        
        $this->sut->setNillable(TRUE);
        self::assertTrue($this->sut->hasNillable(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getNillable() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   elt-attribute
     */
    public function testGetNillable()
    {
        self::assertNull($this->sut->getNillable(), 'The attribute has not been set.');
        
        $this->sut->setNillable(TRUE);
        self::assertTrue($this->sut->getNillable(), 'Set the attribute with a value: TRUE.');
        
        $this->sut->setNillable(FALSE);
        self::assertFalse($this->sut->getNillable(), 'Set the attribute with another value: FALSE.');
    }
}
