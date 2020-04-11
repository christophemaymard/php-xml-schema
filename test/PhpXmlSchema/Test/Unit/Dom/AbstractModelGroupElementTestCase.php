<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the base class to unit test a XML schema element that directly 
 * extends the {@see PhpXmlSchema\Dom\AbstractModelGroupElement} class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractModelGroupElementTestCase extends AbstractAnnotatedElementTestCase
{
    use MaxOccursAttributeTestCaseTrait;
    use MinOccursAttributeTestCaseTrait;
    
    /**
     * Tests that getElementElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no ElementElement element has been added
     * - an indexed array of all added ElementElement elements
     */
    abstract public function testGetElementElements(): void;
    
    /**
     * Tests that getParticleElements() returns:
     * - an empty array when no element has been added
     * - an indexed array of all added particle elements in container 1 (element*)
     * 
     * @group   content
     */
    public function testGetParticleElements(): void
    {
        self::assertSame([], $this->sut->getParticleElements(), 'No element has been added.');
        
        self::assertSame($this->fillSutContainer1(), $this->sut->getParticleElements(), 'Added particle elements.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 1.
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOfContainer1(): void
    {
        self::assertSame($this->fillSutContainer1(), $this->sut->getElements(), 'Elements in container 1.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in that order:
     * - elements from container 0 (annotation?)
     * - elements from container 1
     */
    abstract public function testGetElementsReturnsElementsOrderedByContainer01(): void;
    
    /**
     * Fills the container 1 of the SUT with a set of elements.
     * 
     * @return  ProphecySubjectInterface[]  An indexed array of all the created elements.
     */
    abstract protected function fillSutContainer1(): array;
}