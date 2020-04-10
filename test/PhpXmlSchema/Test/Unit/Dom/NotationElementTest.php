<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\NotationElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\NotationElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NotationElementTest extends AbstractAnnotatedElementTestCase
{
    use NameAttributeTestCaseTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new NotationElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetLocalNameReturnsSpecificString()
    {
        self::assertSame('notation', $this->sut->getLocalName());
    }
    
    /**
     * Tests that hasPublic() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasPublic()
    {
        self::assertFalse($this->sut->hasPublic(), 'The attribute has not been set.');
        
        $this->sut->setPublic($this->createTokenTypeDummy());
        self::assertTrue($this->sut->hasPublic(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getPublic() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetPublic()
    {
        self::assertNull($this->sut->getPublic(), 'The attribute has not been set.');
        
        $token1 = $this->createTokenTypeDummy();
        $this->sut->setPublic($token1);
        self::assertSame($token1, $this->sut->getPublic(), 'Set the attribute with a value: TokenType.');
        
        $token2 = $this->createTokenTypeDummy();
        $this->sut->setPublic($token2);
        self::assertSame($token2, $this->sut->getPublic(), 'Set the attribute with another value: TokenType.');
    }
    
    /**
     * Tests that hasSystem() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasSystem()
    {
        self::assertFalse($this->sut->hasSystem(), 'The attribute has not been set.');
        
        $this->sut->setSystem($this->createAnyUriTypeDummy());
        self::assertTrue($this->sut->hasSystem(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getSystem() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetSystem()
    {
        self::assertNull($this->sut->getSystem(), 'The attribute has not been set.');
        
        $value1 = $this->createAnyUriTypeDummy();
        $this->sut->setSystem($value1);
        self::assertSame($value1, $this->sut->getSystem(), 'Set the attribute with a value: AnyUriType.');
        
        $value2 = $this->createAnyUriTypeDummy();
        $this->sut->setSystem($value2);
        self::assertSame($value2, $this->sut->getSystem(), 'Set the attribute with another value: AnyUriType.');
    }
}
