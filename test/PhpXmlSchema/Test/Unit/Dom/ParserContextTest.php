<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\ParserContext;
use PhpXmlSchema\Dom\Specification;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\ParserContext} 
 * class.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParserContextTest extends TestCase
{
    /**
     * Tests that isComposite() returns FALSE when the context is for a leaf 
     * element.
     */
    public function testIsCompositeReturnsFalseWhenLEC()
    {
        $specMock = $this->createLESpecificationProphecy()->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertFalse($sut->isComposite());
    }
    
    /**
     * Tests that isComposite() returns TRUE when the context is for a 
     * composite element.
     */
    public function testIsCompositeReturnsTrueWhenCEC()
    {
        $specMock = $this->createCESpecificationProphecy(0)->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertTrue($sut->isComposite());
    }
    
    /**
     * Tests that isElementAccepted() returns FALSE when the defined context 
     * is for leaf element.
     */
    public function testIsElementAcceptedReturnsFalseWhenLEC()
    {
        $specMock = $this->createLESpecificationProphecy()->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertFalse($sut->isElementAccepted('foo'));
    }
    
    /**
     * Tests that isElementAccepted() returns FALSE when:
     * - the defined context is for a composite element, and 
     * - findTransitionElementNameSymbol() returns NULL.
     */
    public function testIsElementAcceptedReturnsFalseWhenCECFindTransitionElementNameSymbolReturnsNull()
    {
        $specProphecy = $this->createCESpecificationProphecy(0);
        $specProphecy->findTransitionElementNameSymbol(0, 'foo')->willReturn(NULL)->shouldBeCalled();
        $specMock = $specProphecy->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertFalse($sut->isElementAccepted('foo'));
    }
    
    /**
     * Tests that isElementAccepted() returns TRUE when:
     * - the defined context is for a composite element, and 
     * - findTransitionElementNameSymbol() returns an integer.
     */
    public function testIsElementAcceptedReturnsTrueWhenCECFindTransitionElementNameSymbolReturnsInt()
    {
        $specProphecy = $this->createCESpecificationProphecy(0);
        $specProphecy->findTransitionElementNameSymbol(0, 'foo')->willReturn(TRUE)->shouldBeCalled();
        $specMock = $specProphecy->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertTrue($sut->isElementAccepted('foo'));
    }
    
    /**
     * Tests that getAcceptedElements() returns an empty array when the 
     * defined context is for leaf element.
     */
    public function testGetAcceptedElementsReturnsEmptyArrayWhenLEC()
    {
        $specMock = $this->createLESpecificationProphecy()->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertSame([], $sut->getAcceptedElements());
    }
    
    /**
     * Tests that isElementAccepted() returns FALSE when:
     * - the defined context is for a composite element, and 
     * - findTransitionElementNameSymbol() returns NULL.
     */
    public function testGetAcceptedElementsReturnsArrayOfStrings()
    {
        $specProphecy = $this->createCESpecificationProphecy(0);
        $specProphecy->getTransitionElementNames(0)->willReturn([ 'foo', 'bar', ])->shouldBeCalled();
        $specMock = $specProphecy->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertSame([ 'foo', 'bar', ], $sut->getAcceptedElements());
    }
    
    /**
     * Creates a prophecy of the {@see PhpXmlSchema\Dom\Specification} class, 
     * for the sepcification of a leaf element, where:
     * - hasInitialState() will return FALSE and should be called.
     * 
     * @return  ObjectProphecy
     */
    private function createLESpecificationProphecy():ObjectProphecy
    {
        $prophecy = $this->prophesize(Specification::class);
        $prophecy->hasInitialState()->willReturn(FALSE)->shouldBeCalled();
        
        return $prophecy;
    }
    
    /**
     * Creates a prophecy of the {@see PhpXmlSchema\Dom\Specification} class, 
     * for the sepcification of a leaf element, where:
     * - hasInitialState() will return TRUE and should be called, and 
     * - getInitialState() will return the specified value and should be 
     * called.
     * 
     * @param   int $initialState   The value that getInitialState() will return.
     * @return  ObjectProphecy
     */
    private function createCESpecificationProphecy(int $initialState):ObjectProphecy
    {
        $prophecy = $this->prophesize(Specification::class);
        $prophecy->hasInitialState()->willReturn(TRUE)->shouldBeCalled();
        $prophecy->getInitialState()->willReturn($initialState)->shouldBeCalled();
        
        return $prophecy;
    }
}
