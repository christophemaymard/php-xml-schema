<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\SimpleContentRestrictionElement;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SimpleContentRestrictionElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleContentRestrictionElementTest extends AbstractAbstractValueRestrictionElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SimpleContentRestrictionElement();
    }
    
    /**
     * Tests that getAttributeElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no AttributeElement element has been added
     * - an indexed array of all added AttributeElement elements
     * 
     * @group   elt-content
     */
    public function testGetAttributeElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getAttributeElements(), 'No element has been added.');
        
        $this->sut->addAttributeGroupElement($this->createAttributeGroupElementDummy());
        self::assertSame($elements, $this->sut->getAttributeElements(), 'Added elements but no AttributeElement element.');
        
        $elements[] = $this->createAttributeElementDummy();
        $this->sut->addAttributeElement($elements[0]);
        self::assertSame($elements, $this->sut->getAttributeElements(), 'Added 1 AttributeElement element.');
        
        $this->sut->addAttributeGroupElement($this->createAttributeGroupElementDummy());
        self::assertSame($elements, $this->sut->getAttributeElements(), 'Added 1 element between.');
        
        $elements[] = $this->createAttributeElementDummy();
        $this->sut->addAttributeElement($elements[1]);
        self::assertSame($elements, $this->sut->getAttributeElements(), 'Added 2 AttributeElement elements.');
    }
    
    /**
     * Tests that getAttributeGroupElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no AttributeGroupElement element has been added
     * - an indexed array of all added AttributeGroupElement elements
     * 
     * @group   elt-content
     */
    public function testGetAttributeGroupElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'No element has been added.');
        
        $this->sut->addAttributeElement($this->createAttributeElementDummy());
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'Added elements but no AttributeGroupElement element.');
        
        $elements[] = $this->createAttributeGroupElementDummy();
        $this->sut->addAttributeGroupElement($elements[0]);
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'Added 1 AttributeGroupElement element.');
        
        $this->sut->addAttributeElement($this->createAttributeElementDummy());
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'Added 1 element between.');
        
        $elements[] = $this->createAttributeGroupElementDummy();
        $this->sut->addAttributeGroupElement($elements[1]);
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'Added 2 AttributeGroupElement elements.');
    }
    
    /**
     * Tests that getAttributeDeclarationElements() returns:
     * - an empty array when no element has been added
     * - an indexed array of all added attribute declaration elements in container 3 ((attribute | attributeGroup)*)
     * 
     * @group   elt-content
     */
    public function testGetAttributeDeclarationElements()
    {
        self::assertSame([], $this->sut->getAttributeDeclarationElements(), 'No element has been added.');
        
        self::assertSame($this->fillSutContainer3(), $this->sut->getAttributeDeclarationElements(), 'Added attribute declaration elements.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 3 ((attribute | attributeGroup)*).
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOfContainer3()
    {
        self::assertSame($this->fillSutContainer3(), $this->sut->getElements(), 'Elements in container 3.');
    }
    
    /**
     * Tests that hasAnyAttributeElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   elt-content
     */
    public function testHasAnyAttributeElement()
    {
        self::assertFalse($this->sut->hasAnyAttributeElement(), 'No element has been set.');
        
        $this->sut->setAnyAttributeElement($this->createAnyAttributeElementDummy());
        self::assertTrue($this->sut->hasAnyAttributeElement(), 'Set with an element: AnyAttributeElement.');
    }
    
    /**
     * Tests that getAnyAttributeElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   elt-content
     */
    public function testGetAnyAttributeElement()
    {
        self::assertNull($this->sut->getAnyAttributeElement(), 'No element has been set.');
        
        $elt1 = $this->createAnyAttributeElementDummy();
        $this->sut->setAnyAttributeElement($elt1);
        self::assertSame($elt1, $this->sut->getAnyAttributeElement(), 'Set with an element: AnyAttributeElement.');
        
        $elt2 = $this->createAnyAttributeElementDummy();
        $this->sut->setAnyAttributeElement($elt2);
        self::assertSame($elt2, $this->sut->getAnyAttributeElement(), 'Set with another element: AnyAttributeElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 4 (anyAttribute?).
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOfContainer4()
    {
        $children = [];
        $children[] = $this->createAnyAttributeElementDummy();
        $this->sut->setAnyAttributeElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 4.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in that order:
     * - elements from container 0 (annotation?)
     * - elements from container 1 (simpleType?)
     * - elements from container 2 ((minExclusive | minInclusive | maxExclusive | maxInclusive | totalDigits | fractionDigits | length | minLength | maxLength | enumeration | whiteSpace | pattern)*)
     * - elements from container 3 ((attribute | attributeGroup)*)
     * - elements from container 4 (anyAttribute?)
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOrderedByContainer01234()
    {
        $children = [];
        $children[] = $this->createAnnotationElementDummy();
        $children[] = $this->createSimpleTypeElementDummy();
        $children[] = $this->createMinExclusiveElementDummy();
        $children[] = $this->createMinInclusiveElementDummy();
        $children[] = $this->createMaxExclusiveElementDummy();
        $children[] = $this->createMaxInclusiveElementDummy();
        $children[] = $this->createTotalDigitsElementDummy();
        $children[] = $this->createFractionDigitsElementDummy();
        $children[] = $this->createLengthElementDummy();
        $children[] = $this->createMinLengthElementDummy();
        $children[] = $this->createMaxLengthElementDummy();
        $children[] = $this->createEnumerationElementDummy();
        $children[] = $this->createWhiteSpaceElementDummy();
        $children[] = $this->createPatternElementDummy();
        $children[] = $this->createMinExclusiveElementDummy();
        $children[] = $this->createMinInclusiveElementDummy();
        $children[] = $this->createMaxExclusiveElementDummy();
        $children[] = $this->createMaxInclusiveElementDummy();
        $children[] = $this->createTotalDigitsElementDummy();
        $children[] = $this->createFractionDigitsElementDummy();
        $children[] = $this->createLengthElementDummy();
        $children[] = $this->createMinLengthElementDummy();
        $children[] = $this->createMaxLengthElementDummy();
        $children[] = $this->createEnumerationElementDummy();
        $children[] = $this->createWhiteSpaceElementDummy();
        $children[] = $this->createPatternElementDummy();
        $children[] = $this->createAttributeElementDummy();
        $children[] = $this->createAttributeGroupElementDummy();
        $children[] = $this->createAttributeElementDummy();
        $children[] = $this->createAttributeGroupElementDummy();
        $children[] = $this->createAnyAttributeElementDummy();
        
        // Init container 4.
        $this->sut->setAnyAttributeElement($children[30]);
        
        // Init container 3.
        $this->sut->addAttributeElement($children[26]);
        $this->sut->addAttributeGroupElement($children[27]);
        $this->sut->addAttributeElement($children[28]);
        $this->sut->addAttributeGroupElement($children[29]);
        
        // Init container 2.
        $this->sut->addMinExclusiveElement($children[2]);
        $this->sut->addMinInclusiveElement($children[3]);
        $this->sut->addMaxExclusiveElement($children[4]);
        $this->sut->addMaxInclusiveElement($children[5]);
        $this->sut->addTotalDigitsElement($children[6]);
        $this->sut->addFractionDigitsElement($children[7]);
        $this->sut->addLengthElement($children[8]);
        $this->sut->addMinLengthElement($children[9]);
        $this->sut->addMaxLengthElement($children[10]);
        $this->sut->addEnumerationElement($children[11]);
        $this->sut->addWhiteSpaceElement($children[12]);
        $this->sut->addPatternElement($children[13]);
        $this->sut->addMinExclusiveElement($children[14]);
        $this->sut->addMinInclusiveElement($children[15]);
        $this->sut->addMaxExclusiveElement($children[16]);
        $this->sut->addMaxInclusiveElement($children[17]);
        $this->sut->addTotalDigitsElement($children[18]);
        $this->sut->addFractionDigitsElement($children[19]);
        $this->sut->addLengthElement($children[20]);
        $this->sut->addMinLengthElement($children[21]);
        $this->sut->addMaxLengthElement($children[22]);
        $this->sut->addEnumerationElement($children[23]);
        $this->sut->addWhiteSpaceElement($children[24]);
        $this->sut->addPatternElement($children[25]);
        
        // Init container 1.
        $this->sut->setSimpleTypeElement($children[1]);
        
        // Init container 0.
        $this->sut->setAnnotationElement($children[0]);
        
        self::assertSame($children, $this->sut->getElements(), 'Elements ordered by container: 0, 1, 2, 3, 4.');
    }
    
    /**
     * Fills the container 3 ((attribute | attributeGroup)*) of the SUT with 
     * a set of elements.
     * 
     * @return  ProphecySubjectInterface[]  An indexed array of all the created elements.
     */
    private function fillSutContainer3():array
    {
        $elements = [];
        $elements[] = $this->createAttributeElementDummy();
        $elements[] = $this->createAttributeGroupElementDummy();
        $elements[] = $this->createAttributeElementDummy();
        $elements[] = $this->createAttributeGroupElementDummy();
        $this->sut->addAttributeElement($elements[0]);
        $this->sut->addAttributeGroupElement($elements[1]);
        $this->sut->addAttributeElement($elements[2]);
        $this->sut->addAttributeGroupElement($elements[3]);
        
        return $elements;
    }
}
