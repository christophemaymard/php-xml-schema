<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Validation\DFA;

/**
 * Represents the context when the parser processes an element.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParserContext
{
    /**
     * The specification used in this context.
     * @var Specification
     */
    private $spec;
    
    /**
     * The instance of DFA used for a composite element. 
     * @var DFA|NULL
     */
    private $fa;
    
    /**
     * Constructor.
     * 
     * @param   Specification   $spec   The specification to use in this context.
     */
    public function __construct(Specification $spec)
    {
        $this->spec = $spec;
        
        // Initializes a DFA if an initial state is present.
        // It implies that this context is defined for a composite element.
        if ($this->spec->hasInitialState()) {
            $this->initDFA();
        }
    }
    
    /**
     * Initializes a DFA.
     */
    private function initDFA()
    {
        $this->fa = new DFA($this->spec->getInitialState());
    }
    
    /**
     * Indicates whether this context is defined for a composite element.
     * 
     * @return  bool    TRUE if this context is defined for a composite element, otherwise FALSE for a leaf element.
     */
    public function isComposite():bool
    {
        return $this->fa !== NULL;
    }
    
    /**
     * Indicates whether an element, with the specified local name, is 
     * accepted in the current state.
     * 
     * If this context is defined for a leaf element then it always returns 
     * FALSE.
     * 
     * @param   string  $name   The local name of the element to check.
     * @return  bool    TRUE if the element with the specified local name is accepted, otherwise FALSE.
     */
    public function isElementAccepted(string $name):bool
    {
        return $this->isComposite() && 
            $this->spec->findTransitionElementNameSymbol(
                $this->fa->getCurrentState(), $name
            ) !== NULL;
    }
    
    /**
     * Returns all the local names of the elements that are accepted in the 
     * current state.
     * 
     * If this context is defined for a leaf element then it always returns 
     * an empty array.
     * 
     * @return  string[]    An indexed array of all the local names of the accepted elements.
     */
    public function getAcceptedElements():array
    {
        return ($this->isComposite()) ? 
            $this->spec->getTransitionElementNames($this->fa->getCurrentState()) : 
            [];
    }
}
