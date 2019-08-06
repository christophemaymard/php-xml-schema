<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Exception\InvalidOperationException;

/**
 * Represents a set of specifications related to an element in a context ID.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class Specification
{
    /**
     * The context ID of this specification.
     * @var int
     */
    private $cid;
    
    /**
     * The initial state (default to NULL).
     * @var int|NULL
     */
    private $initialState;
    
    /**
     * The map that associates a state and a symbol with an element name.
     * @var array[]
     */
    private $transitionElementNames = [];
    
    /**
     * Constructor.
     * 
     * @param   int $cid    The context ID of this specification.
     */
    public function __construct(int $cid)
    {
        $this->cid = $cid;
    }
    
    /**
     * Returns the initial state.
     * 
     * @return  int The initial state.
     * 
     * @throws  InvalidOperationException   When no initial state has been set.
     */
    public function getInitialState():int
    {
        if (!$this->hasInitialState()) {
            throw new InvalidOperationException(\sprintf(
                'There is no initial state for the context ID %s.',
                $this->cid
            ));
        }
        
        return $this->initialState;
    }
    
    /**
     * Sets the initial state.
     * 
     * @param   int $state  The initial state to set.
     */
    public function setInitialState(int $state)
    {
        $this->initialState = $state;
    }
    
    /**
     * Indicates whether an initial state has been set.
     * 
     * @return  bool    TRUE if an initial state has been set, otherwise FALSE.
     */
    public function hasInitialState():bool
    {
        return $this->initialState !== NULL;
    }
    
    /**
     * Returns the name associated with the transition with the specified 
     * state and symbol.
     * 
     * @param   int $state  The state of the transition.
     * @param   int $sym    The symbol of the transition.
     * @return  string  The name associated with the transition.
     * 
     * @throws  InvalidOperationException   When no name is associated with the transition.
     */
    public function getTransitionElementName(int $state, int $sym):string
    {
        if (!$this->hasTransitionElementName($state, $sym)) {
            throw new InvalidOperationException(\sprintf(
                'There is no name associated with the transition with the state %s and the symbol %s in the context ID %s.', 
                $state, 
                $sym, 
                $this->cid
            ));
        }
        
        return $this->transitionElementNames[$state][$sym];
    }
    
    /**
     * Associates a name with a transition.
     * 
     * @param   int     $state  The state of the transition.
     * @param   int     $sym    The symbol of the transition.
     * @param   string  $name   The name to associate with the transition.
     */
    public function setTransitionElementName(int $state, int $sym, string $name)
    {
        $this->transitionElementNames[$state][$sym] = $name;
    }
    
    /**
     * Indicates whether a name is associated with a transition with the 
     * specified state and symbol.
     * 
     * @param   int $state  The state of the transition.
     * @param   int $sym    The symbol of the transition.
     * @return  bool    TRUE if a name is associated with a transition, otherwise FALSE.
     */
    public function hasTransitionElementName(int $state, int $sym):bool
    {
        return isset($this->transitionElementNames[$state][$sym]);
    }
    
    /**
     * Returns all the names associated with the transitions with the 
     * specified state.
     * 
     * @param   int $state  The state of the transitions.
     * @return  string[]    An indexed array of names.
     */
    public function getTransitionElementNames(int $state):array
    {
        return isset($this->transitionElementNames[$state]) ? 
            \array_values($this->transitionElementNames[$state]) : 
            [];
    }
    
    /**
     * Finds the symbol that the specified name is associated with and 
     * belongs to the transition with the specified state.
     * 
     * @param   int     $state  The state of the transition.
     * @param   string  $name   The name associated with the transition.
     * @return  int|NULL    An integer if the symbol has been found, otherwise NULL.
     */
    public function findTransitionElementNameSymbol(int $state, string $name)
    {
        return (isset($this->transitionElementNames[$state]) && 
            (FALSE !== $sym = \array_search($name, $this->transitionElementNames[$state], TRUE))) ? 
            $sym : 
            NULL;
    }
}
