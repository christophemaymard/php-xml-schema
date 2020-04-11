<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the base class to unit test the {@see PhpXmlSchema\Dom\AbstractValueRestrictionElement} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractAbstractValueRestrictionElementTestCase extends AbstractAbstractSimpleTypedElementTestCase
{
    use BaseAttributeTestCaseTrait;
    
    /**
     * Tests that getMinExclusiveElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no MinExclusiveElement element has been added
     * - an indexed array of all added MinExclusiveElement elements
     * 
     * @group   content
     */
    public function testGetMinExclusiveElements(): void
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getMinExclusiveElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementHasParentFalse1TimeMock());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementHasParentFalse1TimeMock());
        $this->sut->addLengthElement($this->createLengthElementHasParentFalse1TimeMock());
        $this->sut->addMinLengthElement($this->createMinLengthElementHasParentFalse1TimeMock());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementHasParentFalse1TimeMock());
        $this->sut->addEnumerationElement($this->createEnumerationElementHasParentFalse1TimeMock());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementHasParentFalse1TimeMock());
        $this->sut->addPatternElement($this->createPatternElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getMinExclusiveElements(), 'Added elements but no MinExclusiveElement element.');
        
        $elements[] = $this->createMinExclusiveElementHasParentFalse1TimeMock();
        $this->sut->addMinExclusiveElement($elements[0]);
        self::assertSame($elements, $this->sut->getMinExclusiveElements(), 'Added 1 MinExclusiveElement element.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getMinExclusiveElements(), 'Added 1 element between.');
        
        $elements[] = $this->createMinExclusiveElementHasParentFalse1TimeMock();
        $this->sut->addMinExclusiveElement($elements[1]);
        self::assertSame($elements, $this->sut->getMinExclusiveElements(), 'Added 2 MinExclusiveElement elements.');
    }
    
    /**
     * Tests that getMinInclusiveElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no MinInclusiveElement element has been added
     * - an indexed array of all added MinInclusiveElement elements
     * 
     * @group   content
     */
    public function testGetMinInclusiveElements(): void
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getMinInclusiveElements(), 'No element has been added.');
        
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementHasParentFalse1TimeMock());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementHasParentFalse1TimeMock());
        $this->sut->addLengthElement($this->createLengthElementHasParentFalse1TimeMock());
        $this->sut->addMinLengthElement($this->createMinLengthElementHasParentFalse1TimeMock());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementHasParentFalse1TimeMock());
        $this->sut->addEnumerationElement($this->createEnumerationElementHasParentFalse1TimeMock());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementHasParentFalse1TimeMock());
        $this->sut->addPatternElement($this->createPatternElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getMinInclusiveElements(), 'Added elements but no MinInclusiveElement element.');
        
        $elements[] = $this->createMinInclusiveElementHasParentFalse1TimeMock();
        $this->sut->addMinInclusiveElement($elements[0]);
        self::assertSame($elements, $this->sut->getMinInclusiveElements(), 'Added 1 MinInclusiveElement element.');
        
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getMinInclusiveElements(), 'Added 1 element between.');
        
        $elements[] = $this->createMinInclusiveElementHasParentFalse1TimeMock();
        $this->sut->addMinInclusiveElement($elements[1]);
        self::assertSame($elements, $this->sut->getMinInclusiveElements(), 'Added 2 MinInclusiveElement elements.');
    }
    
    /**
     * Tests that getMaxExclusiveElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no MaxExclusiveElement element has been added
     * - an indexed array of all added MaxExclusiveElement elements
     * 
     * @group   content
     */
    public function testGetMaxExclusiveElements(): void
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getMaxExclusiveElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementHasParentFalse1TimeMock());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementHasParentFalse1TimeMock());
        $this->sut->addLengthElement($this->createLengthElementHasParentFalse1TimeMock());
        $this->sut->addMinLengthElement($this->createMinLengthElementHasParentFalse1TimeMock());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementHasParentFalse1TimeMock());
        $this->sut->addEnumerationElement($this->createEnumerationElementHasParentFalse1TimeMock());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementHasParentFalse1TimeMock());
        $this->sut->addPatternElement($this->createPatternElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getMaxExclusiveElements(), 'Added elements but no MaxExclusiveElement element.');
        
        $elements[] = $this->createMaxExclusiveElementHasParentFalse1TimeMock();
        $this->sut->addMaxExclusiveElement($elements[0]);
        self::assertSame($elements, $this->sut->getMaxExclusiveElements(), 'Added 1 MaxExclusiveElement element.');
        
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getMaxExclusiveElements(), 'Added 1 element between.');
        
        $elements[] = $this->createMaxExclusiveElementHasParentFalse1TimeMock();
        $this->sut->addMaxExclusiveElement($elements[1]);
        self::assertSame($elements, $this->sut->getMaxExclusiveElements(), 'Added 2 MaxExclusiveElement elements.');
    }
    
    /**
     * Tests that getMaxInclusiveElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no MaxInclusiveElement element has been added
     * - an indexed array of all added MaxInclusiveElement elements
     * 
     * @group   content
     */
    public function testGetMaxInclusiveElements(): void
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getMaxInclusiveElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementHasParentFalse1TimeMock());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementHasParentFalse1TimeMock());
        $this->sut->addLengthElement($this->createLengthElementHasParentFalse1TimeMock());
        $this->sut->addMinLengthElement($this->createMinLengthElementHasParentFalse1TimeMock());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementHasParentFalse1TimeMock());
        $this->sut->addEnumerationElement($this->createEnumerationElementHasParentFalse1TimeMock());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementHasParentFalse1TimeMock());
        $this->sut->addPatternElement($this->createPatternElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getMaxInclusiveElements(), 'Added elements but no MaxInclusiveElement element.');
        
        $elements[] = $this->createMaxInclusiveElementHasParentFalse1TimeMock();
        $this->sut->addMaxInclusiveElement($elements[0]);
        self::assertSame($elements, $this->sut->getMaxInclusiveElements(), 'Added 1 MaxInclusiveElement element.');
        
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getMaxInclusiveElements(), 'Added 1 element between.');
        
        $elements[] = $this->createMaxInclusiveElementHasParentFalse1TimeMock();
        $this->sut->addMaxInclusiveElement($elements[1]);
        self::assertSame($elements, $this->sut->getMaxInclusiveElements(), 'Added 2 MaxInclusiveElement elements.');
    }
    
    /**
     * Tests that getTotalDigitsElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no TotalDigitsElement element has been added
     * - an indexed array of all added TotalDigitsElement elements
     * 
     * @group   content
     */
    public function testGetTotalDigitsElements(): void
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getTotalDigitsElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementHasParentFalse1TimeMock());
        $this->sut->addLengthElement($this->createLengthElementHasParentFalse1TimeMock());
        $this->sut->addMinLengthElement($this->createMinLengthElementHasParentFalse1TimeMock());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementHasParentFalse1TimeMock());
        $this->sut->addEnumerationElement($this->createEnumerationElementHasParentFalse1TimeMock());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementHasParentFalse1TimeMock());
        $this->sut->addPatternElement($this->createPatternElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getTotalDigitsElements(), 'Added elements but no TotalDigitsElement element.');
        
        $elements[] = $this->createTotalDigitsElementHasParentFalse1TimeMock();
        $this->sut->addTotalDigitsElement($elements[0]);
        self::assertSame($elements, $this->sut->getTotalDigitsElements(), 'Added 1 TotalDigitsElement element.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getTotalDigitsElements(), 'Added 1 element between.');
        
        $elements[] = $this->createTotalDigitsElementHasParentFalse1TimeMock();
        $this->sut->addTotalDigitsElement($elements[1]);
        self::assertSame($elements, $this->sut->getTotalDigitsElements(), 'Added 2 TotalDigitsElement elements.');
    }
    
    /**
     * Tests that getFractionDigitsElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no FractionDigitsElement element has been added
     * - an indexed array of all added FractionDigitsElement elements
     * 
     * @group   content
     */
    public function testGetFractionDigitsElements(): void
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getFractionDigitsElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementHasParentFalse1TimeMock());
        $this->sut->addLengthElement($this->createLengthElementHasParentFalse1TimeMock());
        $this->sut->addMinLengthElement($this->createMinLengthElementHasParentFalse1TimeMock());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementHasParentFalse1TimeMock());
        $this->sut->addEnumerationElement($this->createEnumerationElementHasParentFalse1TimeMock());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementHasParentFalse1TimeMock());
        $this->sut->addPatternElement($this->createPatternElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getFractionDigitsElements(), 'Added elements but no FractionDigitsElement element.');
        
        $elements[] = $this->createFractionDigitsElementHasParentFalse1TimeMock();
        $this->sut->addFractionDigitsElement($elements[0]);
        self::assertSame($elements, $this->sut->getFractionDigitsElements(), 'Added 1 FractionDigitsElement element.');
        
        $this->sut->addLengthElement($this->createLengthElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getFractionDigitsElements(), 'Added 1 element between.');
        
        $elements[] = $this->createFractionDigitsElementHasParentFalse1TimeMock();
        $this->sut->addFractionDigitsElement($elements[1]);
        self::assertSame($elements, $this->sut->getFractionDigitsElements(), 'Added 2 FractionDigitsElement elements.');
    }
    
    /**
     * Tests that getLengthElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no LengthElement element has been added
     * - an indexed array of all added LengthElement elements
     * 
     * @group   content
     */
    public function testGetLengthElements(): void
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getLengthElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementHasParentFalse1TimeMock());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementHasParentFalse1TimeMock());
        $this->sut->addMinLengthElement($this->createMinLengthElementHasParentFalse1TimeMock());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementHasParentFalse1TimeMock());
        $this->sut->addEnumerationElement($this->createEnumerationElementHasParentFalse1TimeMock());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementHasParentFalse1TimeMock());
        $this->sut->addPatternElement($this->createPatternElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getLengthElements(), 'Added elements but no LengthElement element.');
        
        $elements[] = $this->createLengthElementHasParentFalse1TimeMock();
        $this->sut->addLengthElement($elements[0]);
        self::assertSame($elements, $this->sut->getLengthElements(), 'Added 1 LengthElement element.');
        
        $this->sut->addMinLengthElement($this->createMinLengthElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getLengthElements(), 'Added 1 element between.');
        
        $elements[] = $this->createLengthElementHasParentFalse1TimeMock();
        $this->sut->addLengthElement($elements[1]);
        self::assertSame($elements, $this->sut->getLengthElements(), 'Added 2 LengthElement elements.');
    }
    
    /**
     * Tests that getMinLengthElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no MinLengthElement element has been added
     * - an indexed array of all added MinLengthElement elements
     * 
     * @group   content
     */
    public function testGetMinLengthElements(): void
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getMinLengthElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementHasParentFalse1TimeMock());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementHasParentFalse1TimeMock());
        $this->sut->addLengthElement($this->createLengthElementHasParentFalse1TimeMock());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementHasParentFalse1TimeMock());
        $this->sut->addEnumerationElement($this->createEnumerationElementHasParentFalse1TimeMock());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementHasParentFalse1TimeMock());
        $this->sut->addPatternElement($this->createPatternElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getMinLengthElements(), 'Added elements but no MinLengthElement element.');
        
        $elements[] = $this->createMinLengthElementHasParentFalse1TimeMock();
        $this->sut->addMinLengthElement($elements[0]);
        self::assertSame($elements, $this->sut->getMinLengthElements(), 'Added 1 MinLengthElement element.');
        
        $this->sut->addMaxLengthElement($this->createMaxLengthElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getMinLengthElements(), 'Added 1 element between.');
        
        $elements[] = $this->createMinLengthElementHasParentFalse1TimeMock();
        $this->sut->addMinLengthElement($elements[1]);
        self::assertSame($elements, $this->sut->getMinLengthElements(), 'Added 2 MinLengthElement elements.');
    }
    
    /**
     * Tests that getMaxLengthElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no MaxLengthElement element has been added
     * - an indexed array of all added MaxLengthElement elements
     * 
     * @group   content
     */
    public function testGetMaxLengthElements(): void
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getMaxLengthElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementHasParentFalse1TimeMock());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementHasParentFalse1TimeMock());
        $this->sut->addLengthElement($this->createLengthElementHasParentFalse1TimeMock());
        $this->sut->addMinLengthElement($this->createMinLengthElementHasParentFalse1TimeMock());
        $this->sut->addEnumerationElement($this->createEnumerationElementHasParentFalse1TimeMock());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementHasParentFalse1TimeMock());
        $this->sut->addPatternElement($this->createPatternElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getMaxLengthElements(), 'Added elements but no MaxLengthElement element.');
        
        $elements[] = $this->createMaxLengthElementHasParentFalse1TimeMock();
        $this->sut->addMaxLengthElement($elements[0]);
        self::assertSame($elements, $this->sut->getMaxLengthElements(), 'Added 1 MaxLengthElement element.');
        
        $this->sut->addEnumerationElement($this->createEnumerationElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getMaxLengthElements(), 'Added 1 element between.');
        
        $elements[] = $this->createMaxLengthElementHasParentFalse1TimeMock();
        $this->sut->addMaxLengthElement($elements[1]);
        self::assertSame($elements, $this->sut->getMaxLengthElements(), 'Added 2 MaxLengthElement elements.');
    }
    
    /**
     * Tests that getEnumerationElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no EnumerationElement element has been added
     * - an indexed array of all added EnumerationElement elements
     * 
     * @group   content
     */
    public function testGetEnumerationElements(): void
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getEnumerationElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementHasParentFalse1TimeMock());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementHasParentFalse1TimeMock());
        $this->sut->addLengthElement($this->createLengthElementHasParentFalse1TimeMock());
        $this->sut->addMinLengthElement($this->createMinLengthElementHasParentFalse1TimeMock());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementHasParentFalse1TimeMock());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementHasParentFalse1TimeMock());
        $this->sut->addPatternElement($this->createPatternElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getEnumerationElements(), 'Added elements but no EnumerationElement element.');
        
        $elements[] = $this->createEnumerationElementHasParentFalse1TimeMock();
        $this->sut->addEnumerationElement($elements[0]);
        self::assertSame($elements, $this->sut->getEnumerationElements(), 'Added 1 EnumerationElement element.');
        
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getEnumerationElements(), 'Added 1 element between.');
        
        $elements[] = $this->createEnumerationElementHasParentFalse1TimeMock();
        $this->sut->addEnumerationElement($elements[1]);
        self::assertSame($elements, $this->sut->getEnumerationElements(), 'Added 2 EnumerationElement elements.');
    }
    
    /**
     * Tests that getWhiteSpaceElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no WhiteSpaceElement element has been added
     * - an indexed array of all added WhiteSpaceElement elements
     * 
     * @group   content
     */
    public function testGetWhiteSpaceElements(): void
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getWhiteSpaceElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementHasParentFalse1TimeMock());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementHasParentFalse1TimeMock());
        $this->sut->addLengthElement($this->createLengthElementHasParentFalse1TimeMock());
        $this->sut->addMinLengthElement($this->createMinLengthElementHasParentFalse1TimeMock());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementHasParentFalse1TimeMock());
        $this->sut->addEnumerationElement($this->createEnumerationElementHasParentFalse1TimeMock());
        $this->sut->addPatternElement($this->createPatternElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getWhiteSpaceElements(), 'Added elements but no WhiteSpaceElement element.');
        
        $elements[] = $this->createWhiteSpaceElementHasParentFalse1TimeMock();
        $this->sut->addWhiteSpaceElement($elements[0]);
        self::assertSame($elements, $this->sut->getWhiteSpaceElements(), 'Added 1 WhiteSpaceElement element.');
        
        $this->sut->addPatternElement($this->createPatternElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getWhiteSpaceElements(), 'Added 1 element between.');
        
        $elements[] = $this->createWhiteSpaceElementHasParentFalse1TimeMock();
        $this->sut->addWhiteSpaceElement($elements[1]);
        self::assertSame($elements, $this->sut->getWhiteSpaceElements(), 'Added 2 WhiteSpaceElement elements.');
    }
    
    /**
     * Tests that getPatternElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no PatternElement element has been added
     * - an indexed array of all added PatternElement elements
     * 
     * @group   content
     */
    public function testGetPatternElements(): void
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getPatternElements(), 'No element has been added.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMinExclusiveElement($this->createMinExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxExclusiveElement($this->createMaxExclusiveElementHasParentFalse1TimeMock());
        $this->sut->addMaxInclusiveElement($this->createMaxInclusiveElementHasParentFalse1TimeMock());
        $this->sut->addTotalDigitsElement($this->createTotalDigitsElementHasParentFalse1TimeMock());
        $this->sut->addFractionDigitsElement($this->createFractionDigitsElementHasParentFalse1TimeMock());
        $this->sut->addLengthElement($this->createLengthElementHasParentFalse1TimeMock());
        $this->sut->addMinLengthElement($this->createMinLengthElementHasParentFalse1TimeMock());
        $this->sut->addMaxLengthElement($this->createMaxLengthElementHasParentFalse1TimeMock());
        $this->sut->addEnumerationElement($this->createEnumerationElementHasParentFalse1TimeMock());
        $this->sut->addWhiteSpaceElement($this->createWhiteSpaceElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getPatternElements(), 'Added elements but no PatternElement element.');
        
        $elements[] = $this->createPatternElementHasParentFalse1TimeMock();
        $this->sut->addPatternElement($elements[0]);
        self::assertSame($elements, $this->sut->getPatternElements(), 'Added 1 PatternElement element.');
        
        $this->sut->addMinInclusiveElement($this->createMinInclusiveElementHasParentFalse1TimeMock());
        self::assertSame($elements, $this->sut->getPatternElements(), 'Added 1 element between.');
        
        $elements[] = $this->createPatternElementHasParentFalse1TimeMock();
        $this->sut->addPatternElement($elements[1]);
        self::assertSame($elements, $this->sut->getPatternElements(), 'Added 2 PatternElement elements.');
    }
    
    /**
     * Tests that getFacetElements() returns:
     * - an empty array when no element has been added
     * - an indexed array of all added facet elements in container 2 ((minExclusive | minInclusive | maxExclusive | maxInclusive | totalDigits | fractionDigits | length | minLength | maxLength | enumeration | whiteSpace | pattern)*)
     * 
     * @group   content
     */
    public function testGetFacetElements(): void
    {
        self::assertSame([], $this->sut->getFacetElements(), 'No element has been added.');
        
        self::assertSame($this->fillSutContainer2(), $this->sut->getFacetElements(), 'Added facet elements.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 2 ((minExclusive | minInclusive | maxExclusive | maxInclusive | totalDigits | fractionDigits | length | minLength | maxLength | enumeration | whiteSpace | pattern)*).
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOfContainer2(): void
    {
        self::assertSame($this->fillSutContainer2(), $this->sut->getElements(), 'Elements in container 2.');
    }
    
    /**
     * Fills the container 2 ((minExclusive | minInclusive | maxExclusive | maxInclusive | totalDigits | fractionDigits | length | minLength | maxLength | enumeration | whiteSpace | pattern)*) 
     * of the SUT with a set of elements.
     * 
     * @return  ProphecySubjectInterface[]  An indexed array of all the created elements.
     */
    private function fillSutContainer2(): array
    {
        $elements = [];
        $elements[] = $this->createMinExclusiveElementHasParentFalse1TimeMock();
        $elements[] = $this->createMinInclusiveElementHasParentFalse1TimeMock();
        $elements[] = $this->createMaxExclusiveElementHasParentFalse1TimeMock();
        $elements[] = $this->createMaxInclusiveElementHasParentFalse1TimeMock();
        $elements[] = $this->createTotalDigitsElementHasParentFalse1TimeMock();
        $elements[] = $this->createFractionDigitsElementHasParentFalse1TimeMock();
        $elements[] = $this->createLengthElementHasParentFalse1TimeMock();
        $elements[] = $this->createMinLengthElementHasParentFalse1TimeMock();
        $elements[] = $this->createMaxLengthElementHasParentFalse1TimeMock();
        $elements[] = $this->createEnumerationElementHasParentFalse1TimeMock();
        $elements[] = $this->createWhiteSpaceElementHasParentFalse1TimeMock();
        $elements[] = $this->createPatternElementHasParentFalse1TimeMock();
        $elements[] = $this->createMinExclusiveElementHasParentFalse1TimeMock();
        $elements[] = $this->createMinInclusiveElementHasParentFalse1TimeMock();
        $elements[] = $this->createMaxExclusiveElementHasParentFalse1TimeMock();
        $elements[] = $this->createMaxInclusiveElementHasParentFalse1TimeMock();
        $elements[] = $this->createTotalDigitsElementHasParentFalse1TimeMock();
        $elements[] = $this->createFractionDigitsElementHasParentFalse1TimeMock();
        $elements[] = $this->createLengthElementHasParentFalse1TimeMock();
        $elements[] = $this->createMinLengthElementHasParentFalse1TimeMock();
        $elements[] = $this->createMaxLengthElementHasParentFalse1TimeMock();
        $elements[] = $this->createEnumerationElementHasParentFalse1TimeMock();
        $elements[] = $this->createWhiteSpaceElementHasParentFalse1TimeMock();
        $elements[] = $this->createPatternElementHasParentFalse1TimeMock();
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
}