<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Dom\SchemaBuilderInterface;
use PhpXmlSchema\Exception\InvalidOperationException;
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
    private function initDFA(): void
    {
        $this->fa = new DFA($this->spec->getInitialState());
        
        foreach ($this->spec->getNextStateTransitions() as list($state, $sym)) {
            $this->fa->addTransition(
                $state, 
                $sym, 
                $this->spec->getTransitionNextState($state, $sym)
            );
        }
        
        // Adds the final states.
        foreach ($this->spec->getFinalStates() as $state) {
            $this->fa->addFinalState($state);
        }
    }
    
    /**
     * Indicates whether this context is defined for a composite element.
     * 
     * @return  bool    TRUE if this context is defined for a composite element, otherwise FALSE for a leaf element.
     */
    public function isComposite(): bool
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
    public function isElementAccepted(string $name): bool
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
    public function getAcceptedElements(): array
    {
        return ($this->isComposite()) ? 
            $this->spec->getTransitionElementNames($this->fa->getCurrentState()) : 
            [];
    }
    
    /**
     * Creates the element with the specified local name.
     * 
     * @param   string                  $name       The local name of the element to create.
     * @param   SchemaBuilderInterface  $builder    The instance used to build the element.
     * @return  int The symbol of the element that has been created.
     * 
     * @throws  InvalidOperationException   When this context is defined for a leaf element.
     * @throws  InvalidOperationException   When the element to create is not supported in the current state.
     * @throws  InvalidOperationException   When the method to create the element is not part of the builder instance.
     */
    public function createElement(string $name, SchemaBuilderInterface $builder): int
    {
        if (!$this->isComposite()) {
            throw new InvalidOperationException(\sprintf(
                'The "%s" element cannot be created because this context is defined for a leaf element.',
                $name
            ));
        }
        
        $cs = $this->fa->getCurrentState();
        $sym = $this->spec->findTransitionElementNameSymbol($cs, $name);
        
        if (NULL === $sym || !$this->spec->hasTransitionElementBuilder($cs, $sym)) {
            throw new InvalidOperationException(\sprintf(
                'The "%s" element cannot be created because it is not supported in the current state.',
                $name
            ));
        }
        
        $methodName = $this->spec->getTransitionElementBuilder($cs, $sym);
        $builderDirector = [ $builder, $methodName ];
        
        if (!\is_callable($builderDirector)) {
            throw new InvalidOperationException(\sprintf(
                'The "%s" element cannot be created because the "%s" method is not part of the builder instance.',
                $name, 
                $methodName
            ));
        }
        
        // Creates the element.
        $builderDirector();
        
        $this->fa->addSymbol($sym);
        
        return $sym;
    }
    
    /**
     * Indicates whether the content is valid.
     * 
     * If this context is defined for a leaf element then it always returns 
     * TRUE.
     * 
     * @return  bool
     */
    public function isContentValid(): bool
    {
        return !$this->isComposite() || $this->fa->isValid();
    }
    
    /**
     * Determines whether the attribute with the specified local name and 
     * namespace is supported.
     * 
     * @param   string  $name  The local name of the attribute.
     * @param   string  $ns    The namespace of the attribute.
     * @return  bool    TRUE if the attribute is supported, otherwise FALSE.
     */
    public function isAttributeSupported(string $name, string $ns): bool
    {
        return $this->spec->hasAttributeBuilder($name, $ns);
    }
    
    /**
     * Creates an attribute.
     * 
     * @param   string                  $name       The local name of the attribute.
     * @param   string                  $ns         The namespace of the attribute.
     * @param   string                  $value      The value of the attribute.
     * @param   SchemaBuilderInterface  $builder    The instance used to build the attribute.
     * 
     * @throws  InvalidOperationException   When the attribute is not supported.
     */
    public function createAttribute(
        string $name, 
        string $ns, 
        string $value, 
        SchemaBuilderInterface $builder
    ): void
    {
        if (!$this->spec->hasAttributeBuilder($name, $ns)) {
            throw new InvalidOperationException(\sprintf(
                'The attribute with the local name "%s" and the namespace '.
                '"%s" cannot be created because it is not supported.', 
                $name, 
                $ns
            ));
        }
        
        $methodName = $this->spec->getAttributeBuilder($name, $ns);
        $builderDirector = [ $builder, $methodName ];
        
        if (!\is_callable($builderDirector)) {
            throw new InvalidOperationException(\sprintf(
                'The attribute with the local name "%s" and the namespace '.
                '"%s" cannot be created because the "%s" method is not '.
                'part of the builder instance.',
                $name, 
                $ns, 
                $methodName
            ));
        }
        
        // Creates the attribute.
        $builderDirector($value);
    }
}
