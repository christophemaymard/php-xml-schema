<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the unit tests for the "final" attribute in a XML schema 
 * element.
 * 
 * It must be used in a class that extends the {@see PhpXmlSchema\Test\Unit\Dom\AbstractAbstractElementTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait FinalAttributeTestCaseTrait
{
    /**
     * Tests that hasFinal() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasFinal(): void
    {
        self::assertFalse($this->sut->hasFinal(), 'The attribute has not been set.');
        
        $this->sut->setFinal($this->createDerivationTypeDummy());
        self::assertTrue($this->sut->hasFinal(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getFinal() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetFinal(): void
    {
        self::assertNull($this->sut->getFinal(), 'The attribute has not been set.');
        
        $derivation1 = $this->createDerivationTypeDummy();
        $this->sut->setFinal($derivation1);
        self::assertSame($derivation1, $this->sut->getFinal(), 'Set the attribute with a value: DerivationType.');
        
        $derivation2 = $this->createDerivationTypeDummy();
        $this->sut->setFinal($derivation2);
        self::assertSame($derivation2, $this->sut->getFinal(), 'Set the attribute with another value: DerivationType.');
    }
}
