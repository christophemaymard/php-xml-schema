<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Validation;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Validation\DFA;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Validation\DFA} class.
 * 
 * @group   fa
 * @group   validation
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DFATest extends TestCase
{
    /**
     * Tests that __construct() initializes the current state with the 
     * initial state.
     */
    public function test__constructInitializeCurrentStateWithInitialState()
    {
        $sut = new DFA(-1);
        self::assertSame(-1, $sut->getCurrentState());
    }
    
    /**
     * Tests that getCurrentState() returns NULL when adding a symbol whereas 
     * there is no defined transition.
     */
    public function testGetCurrentStateReturnsNullWhenAddingSymbolWithNoTransition()
    {
        $sut = new DFA(-1);
        $sut->addSymbol(0);
        self::assertNull($sut->getCurrentState(), 'No transition.');
    }
    
    /**
     * Tests that getCurrentState() returns the next state of the transition 
     * that matches the current state and the adding symbol.
     */
    public function testGetCurrentStateReturnsIntWhenAddingSymbolMatchesTransitionStateSymbol()
    {
        $sut = new DFA(-1);
        $sut->addTransition(-1, 100, 1);
        $sut->addSymbol(100);
        self::assertSame(1, $sut->getCurrentState());
    }
    
    /**
     * Tests that addTransition() updates the next state of the transition 
     * that matches the state and the symbol.
     */
    public function testAddTransitionUpdatesTransitionNextStateWhenAddingTransitionWithSameStateSameSymbolAndOtherNextState()
    {
        $sut = new DFA(0);
        $sut->addTransition(0, 100, 1);
        $sut->addTransition(0, 100, 2);
        $sut->addSymbol(100);
        self::assertSame(2, $sut->getCurrentState());
    }
    
    /**
     * Tests that getCurrentState() returns NULL when:
     * - the current state is valid and there is no matching transition, or
     * - the current state is invalidated
     */
    public function testGetCurrentStateReturnsNullWhenAddingSymbolDoesNotMatchTransition()
    {
        $sut = new DFA(0);
        $sut->addTransition(0, 100, 1);
        $sut->addSymbol(-1);
        self::assertNull($sut->getCurrentState(), 'No matching transition.');
        $sut->addSymbol(100);
        self::assertNull($sut->getCurrentState(), 'The current state is invalidated.');
    }
    
    /**
     * Tests that acceptSymbol() returns TRUE when there is, at least, 
     * 1 transition defined with the current state.
     */
    public function testAcceptSymbolReturnsTrue()
    {
        $sut = new DFA(0);
        $sut->addTransition(0, 100, 1);
        self::assertTrue($sut->acceptSymbol(100), '1 transition.');
        $sut->addSymbol(100);
        $sut->addTransition(1, 1000, 2);
        $sut->addTransition(1, 2000, 2);
        $sut->addTransition(1, 3000, 0);
        self::assertTrue($sut->acceptSymbol(3000), '3 transitions.');
    }
    
    /**
     * Tests that acceptSymbol() returns FALSE when:
     * - there is no transition, or
     * - there is a transition with the current state but not the symbol, or
     * - the current state is invalidated
     */
    public function testAcceptSymbolReturnsFalse()
    {
        $sut = new DFA(0);
        self::assertFalse($sut->acceptSymbol(200), 'No transition.');
        $sut->addTransition(0, 100, 1);
        self::assertFalse($sut->acceptSymbol(200), 'Transition with the current state but not the symbol.');
        $sut->addSymbol(-1);
        self::assertFalse($sut->acceptSymbol(200), 'The current state is invalidated.');
    }
    
    /**
     * Tests that getAcceptedSymbols() returns an empty array when:
     * - there is no defined transition with the current state, or
     * - the current state is invalidated
     */
    public function testGetAcceptedSymbolsReturnsEmptyArray()
    {
        $sut = new DFA(0);
        self::assertSame([], $sut->getAcceptedSymbols(), 'No transition.');
        $sut->addSymbol(-1);
        self::assertSame([], $sut->getAcceptedSymbols(), 'The current state is invalidated.');
    }
    
    /**
     * Tests that getAcceptedSymbols() returns an indexed array of integers 
     * when there is, at least, 1 transition defined with the current state.
     */
    public function testGetAcceptedSymbolsReturnsIndexedArrayIntegers()
    {
        $sut = new DFA(0);
        $sut->addTransition(0, 10, 1);
        $sut->addTransition(0, 20, 2);
        $sut->addTransition(0, 30, 3);
        self::assertSame([ 10, 20, 30, ], $sut->getAcceptedSymbols(), '3 transitions.');
        $sut->addSymbol(10);
        $sut->addTransition(1, 400, 4);
        self::assertSame([ 400, ], $sut->getAcceptedSymbols(), '1 transition.');
    }
    
    /**
     * Tests that isValid() returns FALSE when:
     * - the final state set is empty, or
     * - the current state is not part of the final state set, or
     * - the current state is invalidated
     */
    public function testIsValidReturnsFalseWhenCurrentStateDoesNotMatchFinalState()
    {
        $sut = new DFA(0);
        self::assertFalse($sut->isValid(), 'Final state set empty.');
        $sut->addFinalState(1);
        $sut->addFinalState(2);
        $sut->addFinalState(3);
        self::assertFalse($sut->isValid(), 'The current state is not part of the final state set.');
        $sut->addSymbol(100);
        self::assertFalse($sut->isValid(), 'The current state is invalidated.');
    }
    
    /**
     * Tests that isValid() returns TRUE when the current state is part of 
     * the final state set.
     */
    public function testIsValidReturnsTrueWhenCurrentStateMatchesFinalState()
    {
        $sut = new DFA(0);
        $sut->addFinalState(0);
        self::assertTrue($sut->isValid());
        $sut->addTransition(0, 1, 10);
        $sut->addFinalState(10);
        $sut->addSymbol(1);
        self::assertTrue($sut->isValid());
    }
}
