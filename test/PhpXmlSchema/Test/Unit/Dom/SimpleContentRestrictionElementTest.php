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
class SimpleContentRestrictionElementTest extends AbstractCompositeElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SimpleContentRestrictionElement();
    }
    
    /**
     * Tests that hasAnnotationElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   elt-content
     */
    public function testHasAnnotationElement()
    {
        self::assertFalse($this->sut->hasAnnotationElement(), 'No element has been set.');
        
        $this->sut->setAnnotationElement($this->createAnnotationElementDummy());
        self::assertTrue($this->sut->hasAnnotationElement(), 'Set with an element: AnnotationElement.');
    }
    
    /**
     * Tests that getAnnotationElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   elt-content
     */
    public function testGetAnnotationElement()
    {
        self::assertNull($this->sut->getAnnotationElement(), 'No element has been set.');
        
        $elt1 = $this->createAnnotationElementDummy();
        $this->sut->setAnnotationElement($elt1);
        self::assertSame($elt1, $this->sut->getAnnotationElement(), 'Set with an element: AnnotationElement.');
        
        $elt2 = $this->createAnnotationElementDummy();
        $this->sut->setAnnotationElement($elt2);
        self::assertSame($elt2, $this->sut->getAnnotationElement(), 'Set with another element: AnnotationElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 0 (annotation?).
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOfContainer0()
    {
        $children = [];
        $children[] = $this->createAnnotationElementDummy();
        $this->sut->setAnnotationElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 0.');
    }
    
    /**
     * Tests that hasSimpleTypeElement() returns a boolean:
     * - FALSE when no element has been set
     * - TRUE when an element has been set
     * 
     * @group   elt-content
     */
    public function testHasSimpleTypeElement()
    {
        self::assertFalse($this->sut->hasSimpleTypeElement(), 'No element has been set.');
        
        $this->sut->setSimpleTypeElement($this->createSimpleTypeElementDummy());
        self::assertTrue($this->sut->hasSimpleTypeElement(), 'Set with an element: SimpleTypeElement.');
    }
    
    /**
     * Tests that getSimpleTypeElement() returns:
     * - NULL when no element has been set
     * - the instance of the element that has been set
     * 
     * @group   elt-content
     */
    public function testGetSimpleTypeElement()
    {
        self::assertNull($this->sut->getSimpleTypeElement(), 'No element has been set.');
        
        $elt1 = $this->createSimpleTypeElementDummy();
        $this->sut->setSimpleTypeElement($elt1);
        self::assertSame($elt1, $this->sut->getSimpleTypeElement(), 'Set with an element: SimpleTypeElement.');
        
        $elt2 = $this->createSimpleTypeElementDummy();
        $this->sut->setSimpleTypeElement($elt2);
        self::assertSame($elt2, $this->sut->getSimpleTypeElement(), 'Set with another element: SimpleTypeElement.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 1 (simpleType?).
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOfContainer1()
    {
        $children = [];
        $children[] = $this->createSimpleTypeElementDummy();
        $this->sut->setSimpleTypeElement($children[0]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 1.');
    }
    
    /**
     * Tests that getMinExclusiveElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no MinExclusiveElement element has been added
     * - an indexed array of all added MinExclusiveElement elements
     * 
     * @group   elt-content
     */
    public function testGetMinExclusiveElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getMinExclusiveElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementDummy());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementDummy());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementDummy());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementDummy());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementDummy());
        $this->sut->addLengthElement($this->createLengthElementDummy());
        $this->sut->addMinLengthElement($this->createMinLengthElementDummy());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementDummy());
        $this->sut->addEnumerationElement($this->createEnumerationElementDummy());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementDummy());
        $this->sut->addPatternElement($this->createPatternElementDummy());
        self::assertSame($elements, $this->sut->getMinExclusiveElements(), 'Added elements but no MinExclusiveElement element.');
        
        $elements[] = $this->createMinExclusiveElementDummy();
        $this->sut->addMinExclusiveElement($elements[0]);
        self::assertSame($elements, $this->sut->getMinExclusiveElements(), 'Added 1 MinExclusiveElement element.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementDummy());
        self::assertSame($elements, $this->sut->getMinExclusiveElements(), 'Added 1 element between.');
        
        $elements[] = $this->createMinExclusiveElementDummy();
        $this->sut->addMinExclusiveElement($elements[1]);
        self::assertSame($elements, $this->sut->getMinExclusiveElements(), 'Added 2 MinExclusiveElement elements.');
    }
    
    /**
     * Tests that getMinInclusiveElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no MinInclusiveElement element has been added
     * - an indexed array of all added MinInclusiveElement elements
     * 
     * @group   elt-content
     */
    public function testGetMinInclusiveElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getMinInclusiveElements(), 'No element has been added.');
        
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementDummy());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementDummy());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementDummy());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementDummy());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementDummy());
        $this->sut->addLengthElement($this->createLengthElementDummy());
        $this->sut->addMinLengthElement($this->createMinLengthElementDummy());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementDummy());
        $this->sut->addEnumerationElement($this->createEnumerationElementDummy());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementDummy());
        $this->sut->addPatternElement($this->createPatternElementDummy());
        self::assertSame($elements, $this->sut->getMinInclusiveElements(), 'Added elements but no MinInclusiveElement element.');
        
        $elements[] = $this->createMinInclusiveElementDummy();
        $this->sut->addMinInclusiveElement($elements[0]);
        self::assertSame($elements, $this->sut->getMinInclusiveElements(), 'Added 1 MinInclusiveElement element.');
        
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementDummy());
        self::assertSame($elements, $this->sut->getMinInclusiveElements(), 'Added 1 element between.');
        
        $elements[] = $this->createMinInclusiveElementDummy();
        $this->sut->addMinInclusiveElement($elements[1]);
        self::assertSame($elements, $this->sut->getMinInclusiveElements(), 'Added 2 MinInclusiveElement elements.');
    }
    
    /**
     * Tests that getMaxExclusiveElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no MaxExclusiveElement element has been added
     * - an indexed array of all added MaxExclusiveElement elements
     * 
     * @group   elt-content
     */
    public function testGetMaxExclusiveElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getMaxExclusiveElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementDummy());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementDummy());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementDummy());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementDummy());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementDummy());
        $this->sut->addLengthElement($this->createLengthElementDummy());
        $this->sut->addMinLengthElement($this->createMinLengthElementDummy());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementDummy());
        $this->sut->addEnumerationElement($this->createEnumerationElementDummy());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementDummy());
        $this->sut->addPatternElement($this->createPatternElementDummy());
        self::assertSame($elements, $this->sut->getMaxExclusiveElements(), 'Added elements but no MaxExclusiveElement element.');
        
        $elements[] = $this->createMaxExclusiveElementDummy();
        $this->sut->addMaxExclusiveElement($elements[0]);
        self::assertSame($elements, $this->sut->getMaxExclusiveElements(), 'Added 1 MaxExclusiveElement element.');
        
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementDummy());
        self::assertSame($elements, $this->sut->getMaxExclusiveElements(), 'Added 1 element between.');
        
        $elements[] = $this->createMaxExclusiveElementDummy();
        $this->sut->addMaxExclusiveElement($elements[1]);
        self::assertSame($elements, $this->sut->getMaxExclusiveElements(), 'Added 2 MaxExclusiveElement elements.');
    }
    
    /**
     * Tests that getMaxInclusiveElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no MaxInclusiveElement element has been added
     * - an indexed array of all added MaxInclusiveElement elements
     * 
     * @group   elt-content
     */
    public function testGetMaxInclusiveElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getMaxInclusiveElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementDummy());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementDummy());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementDummy());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementDummy());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementDummy());
        $this->sut->addLengthElement($this->createLengthElementDummy());
        $this->sut->addMinLengthElement($this->createMinLengthElementDummy());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementDummy());
        $this->sut->addEnumerationElement($this->createEnumerationElementDummy());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementDummy());
        $this->sut->addPatternElement($this->createPatternElementDummy());
        self::assertSame($elements, $this->sut->getMaxInclusiveElements(), 'Added elements but no MaxInclusiveElement element.');
        
        $elements[] = $this->createMaxInclusiveElementDummy();
        $this->sut->addMaxInclusiveElement($elements[0]);
        self::assertSame($elements, $this->sut->getMaxInclusiveElements(), 'Added 1 MaxInclusiveElement element.');
        
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementDummy());
        self::assertSame($elements, $this->sut->getMaxInclusiveElements(), 'Added 1 element between.');
        
        $elements[] = $this->createMaxInclusiveElementDummy();
        $this->sut->addMaxInclusiveElement($elements[1]);
        self::assertSame($elements, $this->sut->getMaxInclusiveElements(), 'Added 2 MaxInclusiveElement elements.');
    }
    
    /**
     * Tests that getTotalDigitsElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no TotalDigitsElement element has been added
     * - an indexed array of all added TotalDigitsElement elements
     * 
     * @group   elt-content
     */
    public function testGetTotalDigitsElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getTotalDigitsElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementDummy());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementDummy());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementDummy());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementDummy());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementDummy());
        $this->sut->addLengthElement($this->createLengthElementDummy());
        $this->sut->addMinLengthElement($this->createMinLengthElementDummy());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementDummy());
        $this->sut->addEnumerationElement($this->createEnumerationElementDummy());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementDummy());
        $this->sut->addPatternElement($this->createPatternElementDummy());
        self::assertSame($elements, $this->sut->getTotalDigitsElements(), 'Added elements but no TotalDigitsElement element.');
        
        $elements[] = $this->createTotalDigitsElementDummy();
        $this->sut->addTotalDigitsElement($elements[0]);
        self::assertSame($elements, $this->sut->getTotalDigitsElements(), 'Added 1 TotalDigitsElement element.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementDummy());
        self::assertSame($elements, $this->sut->getTotalDigitsElements(), 'Added 1 element between.');
        
        $elements[] = $this->createTotalDigitsElementDummy();
        $this->sut->addTotalDigitsElement($elements[1]);
        self::assertSame($elements, $this->sut->getTotalDigitsElements(), 'Added 2 TotalDigitsElement elements.');
    }
    
    /**
     * Tests that getFractionDigitsElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no FractionDigitsElement element has been added
     * - an indexed array of all added FractionDigitsElement elements
     * 
     * @group   elt-content
     */
    public function testGetFractionDigitsElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getFractionDigitsElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementDummy());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementDummy());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementDummy());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementDummy());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementDummy());
        $this->sut->addLengthElement($this->createLengthElementDummy());
        $this->sut->addMinLengthElement($this->createMinLengthElementDummy());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementDummy());
        $this->sut->addEnumerationElement($this->createEnumerationElementDummy());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementDummy());
        $this->sut->addPatternElement($this->createPatternElementDummy());
        self::assertSame($elements, $this->sut->getFractionDigitsElements(), 'Added elements but no FractionDigitsElement element.');
        
        $elements[] = $this->createFractionDigitsElementDummy();
        $this->sut->addFractionDigitsElement($elements[0]);
        self::assertSame($elements, $this->sut->getFractionDigitsElements(), 'Added 1 FractionDigitsElement element.');
        
        $this->sut->addLengthElement($this->createLengthElementDummy());
        self::assertSame($elements, $this->sut->getFractionDigitsElements(), 'Added 1 element between.');
        
        $elements[] = $this->createFractionDigitsElementDummy();
        $this->sut->addFractionDigitsElement($elements[1]);
        self::assertSame($elements, $this->sut->getFractionDigitsElements(), 'Added 2 FractionDigitsElement elements.');
    }
    
    /**
     * Tests that getLengthElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no LengthElement element has been added
     * - an indexed array of all added LengthElement elements
     * 
     * @group   elt-content
     */
    public function testGetLengthElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getLengthElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementDummy());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementDummy());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementDummy());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementDummy());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementDummy());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementDummy());
        $this->sut->addMinLengthElement($this->createMinLengthElementDummy());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementDummy());
        $this->sut->addEnumerationElement($this->createEnumerationElementDummy());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementDummy());
        $this->sut->addPatternElement($this->createPatternElementDummy());
        self::assertSame($elements, $this->sut->getLengthElements(), 'Added elements but no LengthElement element.');
        
        $elements[] = $this->createLengthElementDummy();
        $this->sut->addLengthElement($elements[0]);
        self::assertSame($elements, $this->sut->getLengthElements(), 'Added 1 LengthElement element.');
        
        $this->sut->addMinLengthElement($this->createMinLengthElementDummy());
        self::assertSame($elements, $this->sut->getLengthElements(), 'Added 1 element between.');
        
        $elements[] = $this->createLengthElementDummy();
        $this->sut->addLengthElement($elements[1]);
        self::assertSame($elements, $this->sut->getLengthElements(), 'Added 2 LengthElement elements.');
    }
    
    /**
     * Tests that getMinLengthElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no MinLengthElement element has been added
     * - an indexed array of all added MinLengthElement elements
     * 
     * @group   elt-content
     */
    public function testGetMinLengthElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getMinLengthElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementDummy());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementDummy());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementDummy());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementDummy());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementDummy());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementDummy());
        $this->sut->addLengthElement($this->createLengthElementDummy());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementDummy());
        $this->sut->addEnumerationElement($this->createEnumerationElementDummy());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementDummy());
        $this->sut->addPatternElement($this->createPatternElementDummy());
        self::assertSame($elements, $this->sut->getMinLengthElements(), 'Added elements but no MinLengthElement element.');
        
        $elements[] = $this->createMinLengthElementDummy();
        $this->sut->addMinLengthElement($elements[0]);
        self::assertSame($elements, $this->sut->getMinLengthElements(), 'Added 1 MinLengthElement element.');
        
        $this->sut->addMaxLengthElement($this->createMaxLengthElementDummy());
        self::assertSame($elements, $this->sut->getMinLengthElements(), 'Added 1 element between.');
        
        $elements[] = $this->createMinLengthElementDummy();
        $this->sut->addMinLengthElement($elements[1]);
        self::assertSame($elements, $this->sut->getMinLengthElements(), 'Added 2 MinLengthElement elements.');
    }
    
    /**
     * Tests that getMaxLengthElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no MaxLengthElement element has been added
     * - an indexed array of all added MaxLengthElement elements
     * 
     * @group   elt-content
     */
    public function testGetMaxLengthElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getMaxLengthElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementDummy());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementDummy());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementDummy());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementDummy());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementDummy());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementDummy());
        $this->sut->addLengthElement($this->createLengthElementDummy());
        $this->sut->addMinLengthElement($this->createMinLengthElementDummy());
        $this->sut->addEnumerationElement($this->createEnumerationElementDummy());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementDummy());
        $this->sut->addPatternElement($this->createPatternElementDummy());
        self::assertSame($elements, $this->sut->getMaxLengthElements(), 'Added elements but no MaxLengthElement element.');
        
        $elements[] = $this->createMaxLengthElementDummy();
        $this->sut->addMaxLengthElement($elements[0]);
        self::assertSame($elements, $this->sut->getMaxLengthElements(), 'Added 1 MaxLengthElement element.');
        
        $this->sut->addEnumerationElement($this->createEnumerationElementDummy());
        self::assertSame($elements, $this->sut->getMaxLengthElements(), 'Added 1 element between.');
        
        $elements[] = $this->createMaxLengthElementDummy();
        $this->sut->addMaxLengthElement($elements[1]);
        self::assertSame($elements, $this->sut->getMaxLengthElements(), 'Added 2 MaxLengthElement elements.');
    }
    
    /**
     * Tests that getEnumerationElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no EnumerationElement element has been added
     * - an indexed array of all added EnumerationElement elements
     * 
     * @group   elt-content
     */
    public function testGetEnumerationElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getEnumerationElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementDummy());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementDummy());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementDummy());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementDummy());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementDummy());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementDummy());
        $this->sut->addLengthElement($this->createLengthElementDummy());
        $this->sut->addMinLengthElement($this->createMinLengthElementDummy());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementDummy());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementDummy());
        $this->sut->addPatternElement($this->createPatternElementDummy());
        self::assertSame($elements, $this->sut->getEnumerationElements(), 'Added elements but no EnumerationElement element.');
        
        $elements[] = $this->createEnumerationElementDummy();
        $this->sut->addEnumerationElement($elements[0]);
        self::assertSame($elements, $this->sut->getEnumerationElements(), 'Added 1 EnumerationElement element.');
        
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementDummy());
        self::assertSame($elements, $this->sut->getEnumerationElements(), 'Added 1 element between.');
        
        $elements[] = $this->createEnumerationElementDummy();
        $this->sut->addEnumerationElement($elements[1]);
        self::assertSame($elements, $this->sut->getEnumerationElements(), 'Added 2 EnumerationElement elements.');
    }
    
    /**
     * Tests that getWhiteSpaceElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no WhiteSpaceElement element has been added
     * - an indexed array of all added WhiteSpaceElement elements
     * 
     * @group   elt-content
     */
    public function testGetWhiteSpaceElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getWhiteSpaceElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementDummy());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementDummy());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementDummy());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementDummy());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementDummy());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementDummy());
        $this->sut->addLengthElement($this->createLengthElementDummy());
        $this->sut->addMinLengthElement($this->createMinLengthElementDummy());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementDummy());
        $this->sut->addEnumerationElement($this->createEnumerationElementDummy());
        $this->sut->addPatternElement($this->createPatternElementDummy());
        self::assertSame($elements, $this->sut->getWhiteSpaceElements(), 'Added elements but no WhiteSpaceElement element.');
        
        $elements[] = $this->createWhiteSpaceElementDummy();
        $this->sut->addWhiteSpaceElement($elements[0]);
        self::assertSame($elements, $this->sut->getWhiteSpaceElements(), 'Added 1 WhiteSpaceElement element.');
        
        $this->sut->addPatternElement($this->createPatternElementDummy());
        self::assertSame($elements, $this->sut->getWhiteSpaceElements(), 'Added 1 element between.');
        
        $elements[] = $this->createWhiteSpaceElementDummy();
        $this->sut->addWhiteSpaceElement($elements[1]);
        self::assertSame($elements, $this->sut->getWhiteSpaceElements(), 'Added 2 WhiteSpaceElement elements.');
    }
    
    /**
     * Tests that getPatternElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no PatternElement element has been added
     * - an indexed array of all added PatternElement elements
     * 
     * @group   elt-content
     */
    public function testGetPatternElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getPatternElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementDummy());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementDummy());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementDummy());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementDummy());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementDummy());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementDummy());
        $this->sut->addLengthElement($this->createLengthElementDummy());
        $this->sut->addMinLengthElement($this->createMinLengthElementDummy());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementDummy());
        $this->sut->addEnumerationElement($this->createEnumerationElementDummy());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementDummy());
        self::assertSame($elements, $this->sut->getPatternElements(), 'Added elements but no PatternElement element.');
        
        $elements[] = $this->createPatternElementDummy();
        $this->sut->addPatternElement($elements[0]);
        self::assertSame($elements, $this->sut->getPatternElements(), 'Added 1 PatternElement element.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementDummy());
        self::assertSame($elements, $this->sut->getPatternElements(), 'Added 1 element between.');
        
        $elements[] = $this->createPatternElementDummy();
        $this->sut->addPatternElement($elements[1]);
        self::assertSame($elements, $this->sut->getPatternElements(), 'Added 2 PatternElement elements.');
    }
    
    /**
     * Tests that getFacetElements() returns:
     * - an empty array when no element has been added
     * - an indexed array of all added facet elements in container 2 ((minExclusive | minInclusive | maxExclusive | maxInclusive | totalDigits | fractionDigits | length | minLength | maxLength | enumeration | whiteSpace | pattern)*)
     * 
     * @group   elt-content
     */
    public function testGetFacetElements()
    {
        self::assertSame([], $this->sut->getFacetElements(), 'No element has been added.');
        
        self::assertSame($this->fillSutContainer2(), $this->sut->getFacetElements(), 'Added facet elements.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 2 ((minExclusive | minInclusive | maxExclusive | maxInclusive | totalDigits | fractionDigits | length | minLength | maxLength | enumeration | whiteSpace | pattern)*).
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOfContainer2()
    {
        self::assertSame($this->fillSutContainer2(), $this->sut->getElements(), 'Elements in container 2.');
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
     * Fills the container 2 ((minExclusive | minInclusive | maxExclusive | maxInclusive | totalDigits | fractionDigits | length | minLength | maxLength | enumeration | whiteSpace | pattern)*) 
     * of the SUT with a set of elements.
     * 
     * @return  ProphecySubjectInterface[]  An indexed array of all the created elements.
     */
    private function fillSutContainer2():array
    {
        $elements = [];
        $elements[] = $this->createMinExclusiveElementDummy();
        $elements[] = $this->createMinInclusiveElementDummy();
        $elements[] = $this->createMaxExclusiveElementDummy();
        $elements[] = $this->createMaxInclusiveElementDummy();
        $elements[] = $this->createTotalDigitsElementDummy();
        $elements[] = $this->createFractionDigitsElementDummy();
        $elements[] = $this->createLengthElementDummy();
        $elements[] = $this->createMinLengthElementDummy();
        $elements[] = $this->createMaxLengthElementDummy();
        $elements[] = $this->createEnumerationElementDummy();
        $elements[] = $this->createWhiteSpaceElementDummy();
        $elements[] = $this->createPatternElementDummy();
        $elements[] = $this->createMinExclusiveElementDummy();
        $elements[] = $this->createMinInclusiveElementDummy();
        $elements[] = $this->createMaxExclusiveElementDummy();
        $elements[] = $this->createMaxInclusiveElementDummy();
        $elements[] = $this->createTotalDigitsElementDummy();
        $elements[] = $this->createFractionDigitsElementDummy();
        $elements[] = $this->createLengthElementDummy();
        $elements[] = $this->createMinLengthElementDummy();
        $elements[] = $this->createMaxLengthElementDummy();
        $elements[] = $this->createEnumerationElementDummy();
        $elements[] = $this->createWhiteSpaceElementDummy();
        $elements[] = $this->createPatternElementDummy();
        $this->sut->addMinExclusiveElement($elements[0]);
        $this->sut->addMinInclusiveElement($elements[1]);
        $this->sut->addMaxExclusiveElement($elements[2]);
        $this->sut->addMaxInclusiveElement($elements[3]);
        $this->sut->addTotalDigitsElement($elements[4]);
        $this->sut->addFractionDigitsElement($elements[5]);
        $this->sut->addLengthElement($elements[6]);
        $this->sut->addMinLengthElement($elements[7]);
        $this->sut->addMaxLengthElement($elements[8]);
        $this->sut->addEnumerationElement($elements[9]);
        $this->sut->addWhiteSpaceElement($elements[10]);
        $this->sut->addPatternElement($elements[11]);
        $this->sut->addMinExclusiveElement($elements[12]);
        $this->sut->addMinInclusiveElement($elements[13]);
        $this->sut->addMaxExclusiveElement($elements[14]);
        $this->sut->addMaxInclusiveElement($elements[15]);
        $this->sut->addTotalDigitsElement($elements[16]);
        $this->sut->addFractionDigitsElement($elements[17]);
        $this->sut->addLengthElement($elements[18]);
        $this->sut->addMinLengthElement($elements[19]);
        $this->sut->addMaxLengthElement($elements[20]);
        $this->sut->addEnumerationElement($elements[21]);
        $this->sut->addWhiteSpaceElement($elements[22]);
        $this->sut->addPatternElement($elements[23]);
        
        return $elements;
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
