<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
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
     * The final states (default to an empty array).
     * @var int[]
     */
    private $finalStates = [];
    
    /**
     * The map that associates a state and a symbol with an element name.
     * @var array[]
     */
    private $transitionElementNames = [];
    
    /**
     * The map that associates a state and a symbol with a next state.
     * @var array[]
     */
    private $transitionNextStates = [];
    
    /**
     * The map that associates a state and a symbol with a method name.
     * @var array[]
     */
    private $transitionElementBuilders = [];
    
    /**
     * The map that associates an attribute with a method name.
     * @var array[]
     */
    private $attributeBuilders = [];
    
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
    public function getInitialState(): int
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
    public function setInitialState(int $state): void
    {
        $this->initialState = $state;
    }
    
    /**
     * Indicates whether an initial state has been set.
     * 
     * @return  bool    TRUE if an initial state has been set, otherwise FALSE.
     */
    public function hasInitialState(): bool
    {
        return $this->initialState !== NULL;
    }
    
    /**
     * Adds a final state.
     * 
     * @param   int $state  The final state to add.
     */
    public function addFinalState(int $state): void
    {
        if (!\in_array($state, $this->finalStates, TRUE)) {
            $this->finalStates[] = $state;
        }
    }
    
    /**
     * Returns all the final states.
     * 
     * @return  int[]   An indexed array of all the final states.
     */
    public function getFinalStates(): array
    {
        return $this->finalStates;
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
    public function getTransitionElementName(int $state, int $sym): string
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
    public function setTransitionElementName(int $state, int $sym, string $name): void
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
    public function hasTransitionElementName(int $state, int $sym): bool
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
    public function getTransitionElementNames(int $state): array
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
    public function findTransitionElementNameSymbol(int $state, string $name): ?int
    {
        return (isset($this->transitionElementNames[$state]) && 
            (FALSE !== $sym = \array_search($name, $this->transitionElementNames[$state], TRUE))) ? 
            $sym : 
            NULL;
    }
    
    /**
     * Returns the next state associated with the transition with the 
     * specified state and symbol.
     * 
     * @param   int $state  The state of the transition.
     * @param   int $sym    The symbol of the transition.
     * @return  int The next state associated with the transition.
     * 
     * @throws  InvalidOperationException   When no next state is associated with the transition.
     */
    public function getTransitionNextState(int $state, int $sym): int
    {
        if (!$this->hasTransitionNextState($state, $sym)) {
            throw new InvalidOperationException(\sprintf(
                'There is no next state associated with the transition with the state %s and the symbol %s in the context ID %s.', 
                $state, 
                $sym, 
                $this->cid
            ));
        }
        
        return $this->transitionNextStates[$state][$sym];
    }
    
    /**
     * Associates a next state with a transition.
     * 
     * @param   int $state      The state of the transition.
     * @param   int $sym        The symbol of the transition.
     * @param   int $nextState  The next state to associate with the transition.
     */
    public function setTransitionNextState(int $state, int $sym, int $nextState): void
    {
        $this->transitionNextStates[$state][$sym] = $nextState;
    }
    
    /**
     * Indicates whether a next state is associated with a transition with 
     * the specified state and symbol.
     * 
     * @param   int $state  The state of the transition.
     * @param   int $sym    The symbol of the transition.
     * @return  bool    TRUE if a next state is associated with a transition, otherwise FALSE.
     */
    public function hasTransitionNextState(int $state, int $sym): bool
    {
        return isset($this->transitionNextStates[$state][$sym]);
    }
    
    /**
     * Returns all the transitions that are associated with next states.
     * 
     * @return  array[] An indexed array of indexed array of 2 values: the first is the state, the second is the symbol.
     */
    public function getNextStateTransitions(): array
    {
        $transitions = [];
        
        foreach ($this->transitionNextStates as $state => $symNextMap) {
            foreach (\array_keys($symNextMap) as $sym) {
                $transitions[] = [ $state, $sym, ];
            }
        }
        
        return $transitions;
    }
    
    /**
     * Returns the method name associated with the transition with the 
     * specified state and symbol.
     * 
     * @param   int $state  The state of the transition.
     * @param   int $sym    The symbol of the transition.
     * @return  string  The method name associated with the transition.
     * 
     * @throws  InvalidOperationException   When no method name is associated with the transition.
     */
    public function getTransitionElementBuilder(int $state, int $sym): string
    {
        if (!$this->hasTransitionElementBuilder($state, $sym)) {
            throw new InvalidOperationException(\sprintf(
                'There is no method name associated with the transition with the state %s and the symbol %s in the context ID %s.', 
                $state, 
                $sym, 
                $this->cid
            ));
        }
        
        return $this->transitionElementBuilders[$state][$sym];
    }
    
    /**
     * Associates a method name with a transition.
     * 
     * @param   int     $state  The state of the transition.
     * @param   int     $sym    The symbol of the transition.
     * @param   string  $name   The method name to associate with the transition.
     */
    public function setTransitionElementBuilder(int $state, int $sym, string $name): void
    {
        $this->transitionElementBuilders[$state][$sym] = $name;
    }
    
    /**
     * Indicates whether a method name is associated with a transition with 
     * the specified state and symbol.
     * 
     * @param   int $state  The state of the transition.
     * @param   int $sym    The symbol of the transition.
     * @return  bool    TRUE if a method name is associated with a transition, otherwise FALSE.
     */
    public function hasTransitionElementBuilder(int $state, int $sym): bool
    {
        return isset($this->transitionElementBuilders[$state][$sym]);
    }
    
    /**
     * Returns the method name associated with the attribute with the 
     * specified local name and namespace.
     * 
     * @param   string  $name   The local name of the attribute.
     * @param   string  $ns     The namespace of the attribute.
     * @return  string  The method name associated with the attribute.
     * 
     * @throws  InvalidOperationException   When no method name is associated with the attribute.
     */
    public function getAttributeBuilder(string $name, string $ns): string
    {
        if (!$this->hasAttributeBuilder($name, $ns)) {
            throw new InvalidOperationException(\sprintf(
                'There is no method name associated with the attribute with '.
                'the local name "%s" and the namespace "%s" in the context ID 9.', 
                $name, 
                $ns, 
                $this->cid
            ));
        }
        
        return $this->attributeBuilders[$ns][$name];
    }
    
    /**
     * Associates a method name with an attribute.
     * 
     * @param   string  $name   The local name of the attribute.
     * @param   string  $ns     The namespace of the attribute.
     * @param   string  $method The method name to associate with the attribute.
     */
    public function setAttributeBuilder(string $name, string $ns, string $method): void
    {
        $this->attributeBuilders[$ns][$name] = $method;
    }
    
    /**
     * Indicates whether a method name is associated with an attribute with 
     * the specified local name and namespace.
     * 
     * @param   string  $name  The local name of the attribute.
     * @param   string  $ns    The namespace of the attribute.
     * @return  bool    TRUE if a method name is associated with an attribute, otherwise FALSE.
     */
    public function hasAttributeBuilder(string $name, string $ns): bool
    {
        return isset($this->attributeBuilders[$ns][$name]);
    }
}
