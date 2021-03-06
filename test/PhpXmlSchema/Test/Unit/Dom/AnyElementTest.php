<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\AnyElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\AnyElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AnyElementTest extends AbstractAnnotatedElementTestCase
{
    use MaxOccursAttributeTestCaseTrait;
    use MinOccursAttributeTestCaseTrait;
    use NamespaceAttributeTestCaseTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new AnyElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetLocalNameReturnsSpecificString(): void
    {
        self::assertSame('any', $this->sut->getLocalName());
    }
    
    /**
     * Tests that hasProcessContents() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasProcessContents(): void
    {
        self::assertFalse($this->sut->hasProcessContents(), 'The attribute has not been set.');
        
        $this->sut->setProcessContents($this->createProcessingModeTypeDummy());
        self::assertTrue($this->sut->hasProcessContents(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getProcessContents() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetProcessContents(): void
    {
        self::assertNull($this->sut->getProcessContents(), 'The attribute has not been set.');
        
        $pm1 = $this->createProcessingModeTypeDummy();
        $this->sut->setProcessContents($pm1);
        self::assertSame($pm1, $this->sut->getProcessContents(), 'Set the attribute with a value: ProcessingModeType.');
        
        $pm2 = $this->createProcessingModeTypeDummy();
        $this->sut->setProcessContents($pm2);
        self::assertSame($pm2, $this->sut->getProcessContents(), 'Set the attribute with another value: ProcessingModeType.');
    }
}
