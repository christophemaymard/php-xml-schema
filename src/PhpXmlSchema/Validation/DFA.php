<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Validation;

/**
 * Represents a Deterministic Finite Automaton (DFA).
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DFA
{
    /**
     * The current state.
     * NULL means that the current state has been invalidated.
     * @var int|NULL
     */
    private $currentState;
    
    /**
     * The state transition table.
     * @var array[]
     */
    private $transitions = [];
    
    /**
     * The final states.
     * @var int[]
     */
    private $finalStates = [];
    
    /**
     * Constructor.
     * 
     * @param   int $initialState   The state to initialize the current state with.
     */
    public function __construct(int $initialState)
    {
        $this->currentState = $initialState;
    }
    
    /**
     * Defines a transition that associates a state and a symbol with a next 
     * state.
     * 
     * If a transition is already defined with the specified state and symbol 
     * then the next state will be updated with the new one.
     * 
     * @param   int $state      The state of the transition.
     * @param   int $symbol     The symbol of the transition.
     * @param   int $nextState  The next state to associate with.
     */
    public function addTransition(int $state, int $symbol, int $nextState)
    {
        $this->transitions[$state][$symbol] = $nextState;
    }
    
    /**
     * Adds the specified state to the final state set.
     * 
     * @param   int $state  The state to add.
     */
    public function addFinalState(int $state)
    {
        $this->finalStates[] = $state;
    }
    
    /**
     * Finds a transition with the current state and the specified symbol.
     * 
     * If a transition is defined then the current state is updated with the 
     * associated next state, otherwise the current is invalidated (i.e. set 
     * to NULL).
     * 
     * @param   int $symbol The symbol to add.
     */
    public function addSymbol(int $symbol)
    {
        $this->currentState = ($this->acceptSymbol($symbol)) ? 
            $this->transitions[$this->currentState][$symbol] : 
            NULL;
    }
    
    /**
     * Indicates whether a transition is defined with the current state and 
     * the specified symbol.
     * 
     * @param   int $symbol The symbol to check.
     * @return  bool    TRUE if the symbol is accpeted in the current state, otherwis FALSE.
     */
    public function acceptSymbol(int $symbol):bool
    {
        return isset($this->transitions[$this->currentState][$symbol]);
    }
    
    /**
     * Returns all the symbols that are accepted in the current state.
     * 
     * If the current state is NULL or there is no accepted symbol in the 
     * current state then an empty array is returned.
     * 
     * @return  int[]   An indexed array of accpeted symbols.
     */
    public function getAcceptedSymbols():array
    {
        return (isset($this->transitions[$this->currentState])) ? 
            \array_keys($this->transitions[$this->currentState]) : 
            [];
    }
    
    /**
     * Returns the value of the current state.
     * 
     * @return  int|NULL    The value of the current state, otherwise NULL if it has been invalidated.
     */
    public function getCurrentState()
    {
        return $this->currentState;
    }
    
    /**
     * Indicates whether the current is a final state.
     * 
     * @return  bool    TRUE if the current state is a final state, otherwise FALSE.
     */
    public function isValid():bool
    {
        return \in_array($this->currentState, $this->finalStates, TRUE);
    }
}
