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
 * Represents a factory of specifications.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SpecificationFactory
{
    /**
     * The map that associates a context ID with an initial state.
     * An associative where:
     * - the key is the context ID, and
     * - the value is the initial state.
     * @var int[]
     */
    private $initialStates = [
        ContextId::ELT_ROOT => 0, 
    ];
    
    /**
     * The map that associates a state and a symbol with an element name.
     * @var array[]
     */
    private $transitionElementNames = [
        ContextId::ELT_ROOT => [
            0 => [
                ContextId::ELT_SCHEMA => 'schema', 
            ], 
        ], 
    ];
    
    /**
     * Creates the specification for the specified context ID.
     * 
     * @param   int $cid    The context ID to create the specification for.
     * @return  Specification   The created instance of Specification.
     * 
     * @throws  InvalidOperationException   When the context ID is not supported.
     */
    public function create(int $cid):Specification
    {
        if (!isset($this->initialStates[$cid])) {
            throw new InvalidOperationException(\sprintf(
                'The specification cannot be created because the context ID %s is not supported.',
                $cid
            ));
        }
        
        $spec = new Specification($cid);
        
        // Initializes the initial state.
        $spec->setInitialState($cid, $this->initialStates[$cid]);
        
        // Associates transitions with element names.
        foreach ($this->transitionElementNames[$cid] as $state => $symNameMap) {
            foreach ($symNameMap as $sym => $name) {
                $spec->setTransitionElementName($state, $sym, $name);
            }
        }
        
        return $spec;
    }
}
