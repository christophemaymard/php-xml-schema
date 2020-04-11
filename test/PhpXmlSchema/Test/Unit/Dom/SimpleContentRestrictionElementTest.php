<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
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
    use AttributeNamingElementTestCaseTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new SimpleContentRestrictionElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetLocalNameReturnsSpecificString(): void
    {
        self::assertSame('restriction', $this->sut->getLocalName());
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
     * @group   content
     */
    public function testGetElementsReturnsElementsOrderedByContainer01234(): void
    {
        $children = [];
        $children[] = $this->createAnnotationElementHasParentFalse1TimeMock();
        $children[] = $this->createSimpleTypeElementHasParentFalse1TimeMock();
        $children[] = $this->createMinExclusiveElementHasParentFalse1TimeMock();
        $children[] = $this->createMinInclusiveElementHasParentFalse1TimeMock();
        $children[] = $this->createMaxExclusiveElementHasParentFalse1TimeMock();
        $children[] = $this->createMaxInclusiveElementHasParentFalse1TimeMock();
        $children[] = $this->createTotalDigitsElementHasParentFalse1TimeMock();
        $children[] = $this->createFractionDigitsElementHasParentFalse1TimeMock();
        $children[] = $this->createLengthElementHasParentFalse1TimeMock();
        $children[] = $this->createMinLengthElementHasParentFalse1TimeMock();
        $children[] = $this->createMaxLengthElementHasParentFalse1TimeMock();
        $children[] = $this->createEnumerationElementHasParentFalse1TimeMock();
        $children[] = $this->createWhiteSpaceElementHasParentFalse1TimeMock();
        $children[] = $this->createPatternElementHasParentFalse1TimeMock();
        $children[] = $this->createMinExclusiveElementHasParentFalse1TimeMock();
        $children[] = $this->createMinInclusiveElementHasParentFalse1TimeMock();
        $children[] = $this->createMaxExclusiveElementHasParentFalse1TimeMock();
        $children[] = $this->createMaxInclusiveElementHasParentFalse1TimeMock();
        $children[] = $this->createTotalDigitsElementHasParentFalse1TimeMock();
        $children[] = $this->createFractionDigitsElementHasParentFalse1TimeMock();
        $children[] = $this->createLengthElementHasParentFalse1TimeMock();
        $children[] = $this->createMinLengthElementHasParentFalse1TimeMock();
        $children[] = $this->createMaxLengthElementHasParentFalse1TimeMock();
        $children[] = $this->createEnumerationElementHasParentFalse1TimeMock();
        $children[] = $this->createWhiteSpaceElementHasParentFalse1TimeMock();
        $children[] = $this->createPatternElementHasParentFalse1TimeMock();
        $children[] = $this->createAttributeElementHasParentFalse1TimeMock();
        $children[] = $this->createAttributeGroupElementHasParentFalse1TimeMock();
        $children[] = $this->createAttributeElementHasParentFalse1TimeMock();
        $children[] = $this->createAttributeGroupElementHasParentFalse1TimeMock();
        $children[] = $this->createAnyAttributeElementHasParentFalse1TimeMock();
        
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
}
