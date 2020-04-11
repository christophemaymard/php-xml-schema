<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the base class for all the composite element test cases.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractCompositeElementTestCase extends AbstractAbstractElementTestCase
{
    use ElementMockFactoryTrait;
    
    /**
     * Tests that getElements() returns an empty array when no element has 
     * been added.
     * 
     * @group   content
     */
    public function testGetElementsReturnsEmptyArrayWhenNoElementHasBeenAdded(): void
    {
        self::assertSame([], $this->sut->getElements(), 'No element has been added.');
    }
    
    /**
     * Tests that hasId() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasId(): void
    {
        self::assertFalse($this->sut->hasId(), 'The attribute has not been set.');
        
        $this->sut->setId($this->createIDTypeDummy());
        self::assertTrue($this->sut->hasId(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getId() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetId(): void
    {
        self::assertNull($this->sut->getId(), 'The attribute has not been set.');
        
        $value1 = $this->createIDTypeDummy();
        $this->sut->setId($value1);
        self::assertSame($value1, $this->sut->getId(), 'Set the attribute with a value: IDType.');
        
        $value2 = $this->createIDTypeDummy();
        $this->sut->setId($value2);
        self::assertSame($value2, $this->sut->getId(), 'Set the attribute with another value: IDType.');
    }
}
