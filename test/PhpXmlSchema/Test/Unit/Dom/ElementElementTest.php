<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
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
    use BlockAttributeTestCaseTrait;
    use DefaultAttributeTestCaseTrait;
    use FinalAttributeTestCaseTrait;
    use FixedAttributeTestCaseTrait;
    use MaxOccursAttributeTestCaseTrait;
    use MinOccursAttributeTestCaseTrait;
    use NameAttributeTestCaseTrait;
    use RefAttributeTestCaseTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new ElementElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetLocalNameReturnsSpecificString()
    {
        self::assertSame('element', $this->sut->getLocalName());
    }
    
    /**
     * Tests that hasForm() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasForm()
    {
        self::assertFalse($this->sut->hasForm(), 'The attribute has not been set.');
        
        $this->sut->setForm($this->createFormTypeDummy());
        self::assertTrue($this->sut->hasForm(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getForm() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetForm()
    {
        self::assertNull($this->sut->getForm(), 'The attribute has not been set.');
        
        $form1 = $this->createFormTypeDummy();
        $this->sut->setForm($form1);
        self::assertSame($form1, $this->sut->getForm(), 'Set the attribute with a value: FormType.');
        
        $form2 = $this->createFormTypeDummy();
        $this->sut->setForm($form2);
        self::assertSame($form2, $this->sut->getForm(), 'Set the attribute with another value: FormType.');
    }
    
    /**
     * Tests that hasSubstitutionGroup() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasSubstitutionGroup()
    {
        self::assertFalse($this->sut->hasSubstitutionGroup(), 'The attribute has not been set.');
        
        $this->sut->setSubstitutionGroup($this->createQNameTypeDummy());
        self::assertTrue($this->sut->hasSubstitutionGroup(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getSubstitutionGroup() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetSubstitutionGroup()
    {
        self::assertNull($this->sut->getSubstitutionGroup(), 'The attribute has not been set.');
        
        $qname1 = $this->createQNameTypeDummy();
        $this->sut->setSubstitutionGroup($qname1);
        self::assertSame($qname1, $this->sut->getSubstitutionGroup(), 'Set the attribute with a value: QNameType.');
        
        $qname2 = $this->createQNameTypeDummy();
        $this->sut->setSubstitutionGroup($qname2);
        self::assertSame($qname2, $this->sut->getSubstitutionGroup(), 'Set the attribute with another value: QNameType.');
    }
    
    /**
     * Tests that hasType() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasType()
    {
        self::assertFalse($this->sut->hasType(), 'The attribute has not been set.');
        
        $this->sut->setType($this->createQNameTypeDummy());
        self::assertTrue($this->sut->hasType(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getType() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetType()
    {
        self::assertNull($this->sut->getType(), 'The attribute has not been set.');
        
        $qname1 = $this->createQNameTypeDummy();
        $this->sut->setType($qname1);
        self::assertSame($qname1, $this->sut->getType(), 'Set the attribute with a value: QNameType.');
        
        $qname2 = $this->createQNameTypeDummy();
        $this->sut->setType($qname2);
        self::assertSame($qname2, $this->sut->getType(), 'Set the attribute with another value: QNameType.');
    }
    
    /**
     * Tests that hasTypeElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   content
     */
    public function testHasTypeElement()
    {
        self::assertFalse($this->sut->hasTypeElement(), 'No element has been set.');
        
        $this->sut->setTypeElement($this->createSimpleTypeElementHasParentFalse1TimeMock());
        self::assertTrue($this->sut->hasTypeElement(), 'Set with an element: TypeElementInterface.');
    }
    
    /**
     * Tests that getTypeElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   content
     */
    public function testGetTypeElement()
    {
        self::assertNull($this->sut->getTypeElement(), 'No element has been set.');
        
        $elt1 = $this->createSimpleTypeElementHasParentFalse1TimeMock();
        $this->sut->setTypeElement($elt1);
        self::assertSame($elt1, $this->sut->getTypeElement(), 'Set with an element: SimpleTypeElement.');
        
        $elt2 = $this->createComplexTypeElementHasParentFalse1TimeMock();
        $this->sut->setTypeElement($elt2);
        self::assertSame($elt2, $this->sut->getTypeElement(), 'Set with another element: ComplexTypeElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 1 ((simpleType | complexType)?).
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOfContainer1()
    {
        $children = [];
        $children[] = $this->createComplexTypeElementHasParentFalse1TimeMock();
        $this->sut->setTypeElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 1.');
    }
    
    /**
     * Tests that getUniqueElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no UniqueElement element has been added
     * - an indexed array of all added UniqueElement elements
     * 
     * @group   content
     */
    public function testGetUniqueElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getUniqueElements(), 'No element has been added.');
        
        $this->sut->addKeyElement($this->createKeyElementHasParentFalse1TimeMock());
        $this->sut->addKeyRefElement($this->createKeyRefElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getUniqueElements(), 'Added elements but no UniqueElement element.');
        
        $elements[] = $this->createUniqueElementHasParentFalse1TimeMock();
        $this->sut->addUniqueElement($elements[0]);
        self::assertSame($elements, $this->sut->getUniqueElements(), 'Added 1 UniqueElement element.');
        
        $this->sut->addKeyElement($this->createKeyElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getUniqueElements(), 'Added 1 element between.');
        
        $elements[] = $this->createUniqueElementHasParentFalse1TimeMock();
        $this->sut->addUniqueElement($elements[1]);
        self::assertSame($elements, $this->sut->getUniqueElements(), 'Added 2 UniqueElement elements.');
    }
    
    /**
     * Tests that getKeyElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no KeyElement element has been added
     * - an indexed array of all added KeyElement elements
     * 
     * @group   content
     */
    public function testGetKeyElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getKeyElements(), 'No element has been added.');
        
        $this->sut->addUniqueElement($this->createUniqueElementHasParentFalse1TimeMock());
        $this->sut->addKeyRefElement($this->createKeyRefElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getKeyElements(), 'Added elements but no KeyElement element.');
        
        $elements[] = $this->createKeyElementHasParentFalse1TimeMock();
        $this->sut->addKeyElement($elements[0]);
        self::assertSame($elements, $this->sut->getKeyElements(), 'Added 1 KeyElement element.');
        
        $this->sut->addKeyRefElement($this->createKeyRefElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getKeyElements(), 'Added 1 element between.');
        
        $elements[] = $this->createKeyElementHasParentFalse1TimeMock();
        $this->sut->addKeyElement($elements[1]);
        self::assertSame($elements, $this->sut->getKeyElements(), 'Added 2 KeyElement elements.');
    }
    
    /**
     * Tests that getKeyRefElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no KeyRefElement element has been added
     * - an indexed array of all added KeyRefElement elements
     * 
     * @group   content
     */
    public function testGetKeyRefElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getKeyRefElements(), 'No element has been added.');
        
        $this->sut->addUniqueElement($this->createUniqueElementHasParentFalse1TimeMock());
        $this->sut->addKeyElement($this->createKeyElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getKeyRefElements(), 'Added elements but no KeyRefElement element.');
        
        $elements[] = $this->createKeyRefElementHasParentFalse1TimeMock();
        $this->sut->addKeyRefElement($elements[0]);
        self::assertSame($elements, $this->sut->getKeyRefElements(), 'Added 1 KeyRefElement element.');
        
        $this->sut->addUniqueElement($this->createUniqueElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getKeyRefElements(), 'Added 1 element between.');
        
        $elements[] = $this->createKeyRefElementHasParentFalse1TimeMock();
        $this->sut->addKeyRefElement($elements[1]);
        self::assertSame($elements, $this->sut->getKeyRefElements(), 'Added 2 KeyRefElement elements.');
    }
    
    /**
     * Tests that getIdentityConstraintElements() returns:
     * - an empty array when no element has been added
     * - an indexed array of all added identity-constraint elements
     * 
     * @group   content
     */
    public function testGetIdentityConstraintElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getIdentityConstraintElements(), 'No element has been added.');
        
        $elements[] = $this->createUniqueElementHasParentFalse1TimeMock();
        $elements[] = $this->createKeyElementHasParentFalse1TimeMock();
        $elements[] = $this->createKeyRefElementHasParentFalse1TimeMock();
        $elements[] = $this->createUniqueElementHasParentFalse1TimeMock();
        $elements[] = $this->createKeyElementHasParentFalse1TimeMock();
        $elements[] = $this->createKeyRefElementHasParentFalse1TimeMock();
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
     * @group   content
     */
    public function testGetElementsReturnsElementsOfContainer2()
    {
        $children = [];
        $children[] = $this->createUniqueElementHasParentFalse1TimeMock();
        $children[] = $this->createKeyElementHasParentFalse1TimeMock();
        $children[] = $this->createKeyRefElementHasParentFalse1TimeMock();
        $children[] = $this->createUniqueElementHasParentFalse1TimeMock();
        $children[] = $this->createKeyElementHasParentFalse1TimeMock();
        $children[] = $this->createKeyRefElementHasParentFalse1TimeMock();
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
     * @group   content
     */
    public function testGetElementsReturnsElementsOrderedByContainer012()
    {
        $children = [];
        $children[] = $this->createAnnotationElementHasParentFalse1TimeMock();
        $children[] = $this->createSimpleTypeElementHasParentFalse1TimeMock();
        $children[] = $this->createUniqueElementHasParentFalse1TimeMock();
        $children[] = $this->createKeyElementHasParentFalse1TimeMock();
        $children[] = $this->createKeyRefElementHasParentFalse1TimeMock();
        $children[] = $this->createUniqueElementHasParentFalse1TimeMock();
        $children[] = $this->createKeyElementHasParentFalse1TimeMock();
        $children[] = $this->createKeyRefElementHasParentFalse1TimeMock();
        
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
     * @group   attribute
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
     * @group   attribute
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
