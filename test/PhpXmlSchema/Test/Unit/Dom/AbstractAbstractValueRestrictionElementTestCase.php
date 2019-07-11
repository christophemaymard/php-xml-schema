<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
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
     * @group   content
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
     * @group   content
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
     * @group   content
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
     * @group   content
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
     * @group   content
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
     * @group   content
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
     * @group   content
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
     * @group   content
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
     * @group   content
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
     * @group   content
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
     * @group   content
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
     * @group   content
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
     * @group   content
     */
    public function testGetElementsReturnsElementsOfContainer2()
    {
        self::assertSame($this->fillSutContainer2(), $this->sut->getElements(), 'Elements in container 2.');
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
}