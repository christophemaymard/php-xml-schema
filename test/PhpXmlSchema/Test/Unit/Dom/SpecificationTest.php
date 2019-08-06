<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\Specification;
use PhpXmlSchema\Exception\InvalidOperationException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\Specification} 
 * class.
 * 
 * @group   specification
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SpecificationTest extends TestCase
{
    /**
     * @var SpecificationRegistry
     */
    private $sut;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new Specification(9);
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that hasInitialState() returns a boolean.
     */
    public function testHasInitialStateReturnsBool()
    {
        self::assertFalse($this->sut->hasInitialState());
        
        $this->sut->setInitialState(0);
        self::assertTrue($this->sut->hasInitialState());
    }
    
    /**
     * Tests that getInitialState() returns the initial state that has been 
     * set.
     */
    public function testGetInitialStateReturnsInt()
    {
        $this->sut->setInitialState(10);
        self::assertSame(10, $this->sut->getInitialState());
        
        $this->sut->setInitialState(100);
        self::assertSame(100, $this->sut->getInitialState());
    }
    
    /**
     * Tests that getInitialState() throws an exception when no initial state 
     * has been set.
     */
    public function testGetInitialStateThrowsExceptionWhenNotSet()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('There is no initial state for the context ID 9.');
        
        $this->sut->getInitialState();
    }
    
    /**
     * Tests that hasTransitionElementName() returns a boolean.
     */
    public function testHasTransitionElementNameReturnsBool()
    {
        self::assertFalse($this->sut->hasTransitionElementName(1, 0));
        
        $this->sut->setTransitionElementName(1, 0, 'foo');
        self::assertTrue($this->sut->hasTransitionElementName(1, 0));
    }
    
    
    /**
     * Tests that getTransitionElementName() returns the name that is 
     * associated with a state and a symbol.
     */
    public function testGetTransitionElementNameReturnsString()
    {
        $this->sut->setTransitionElementName(1, 2, 'foo');
        self::assertSame('foo', $this->sut->getTransitionElementName(1, 2));
        
        $this->sut->setTransitionElementName(1, 4, 'bar');
        self::assertSame('bar', $this->sut->getTransitionElementName(1, 4));
        
        $this->sut->setTransitionElementName(1, 2, 'newFoo');
        self::assertSame('newFoo', $this->sut->getTransitionElementName(1, 2));
    }
    
    /**
     * Tests that getTransitionElementName() throws an exception when no name 
     * is associated with the transition.
     */
    public function testGetTransitionElementNameThrowsExceptionWhenNotSet()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('There is no name associated with the '.
            'transition with the state 1 and the symbol 2 in the context ID 9.');
        
        $this->sut->getTransitionElementName(1, 2);
    }
    
    /**
     * Tests that findTransitionElementNameSymbol() returns NULL when no 
     * transition with the state is associated with the name.
     */
    public function testFindTransitionElementNameSymbolReturnsNull()
    {
        self::assertNull($this->sut->findTransitionElementNameSymbol(0, 'foo'));
    }
    
    /**
     * Tests that findTransitionElementNameSymbol() returns the first 
     * integer when a transition with the state is associated with the name.
     */
    public function testFindTransitionElementNameSymbolReturnsInt()
    {
        $this->sut->setTransitionElementName(0, 2, 'foo');
        self::assertSame(2, $this->sut->findTransitionElementNameSymbol(0, 'foo'));
        
        $this->sut->setTransitionElementName(0, 5, 'bar');
        $this->sut->setTransitionElementName(0, 8, 'bar');
        $this->sut->setTransitionElementName(0, 14, 'bar');
        self::assertSame(5, $this->sut->findTransitionElementNameSymbol(0, 'bar'));
    }
    
    /**
     * Tests that getTransitionElementNames() returns an array of strings.
     */
    public function testGetTransitionElementNamesReturnsArrayOfStrings()
    {
        self::assertSame([], $this->sut->getTransitionElementNames(0));
        
        $this->sut->setTransitionElementName(0, 5, 'foo');
        $this->sut->setTransitionElementName(1, 8, 'bar');
        $this->sut->setTransitionElementName(0, 14, 'baz');
        $this->sut->setTransitionElementName(0, 5, 'qux');
        self::assertSame(['qux', 'baz'], $this->sut->getTransitionElementNames(0));
    }
    
    
}
