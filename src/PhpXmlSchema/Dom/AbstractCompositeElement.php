<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\IDType;

/**
 * Represents the base class for all the XML schema elements that contain a 
 * sequence of XML schema elements as content.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractCompositeElement extends AbstractElement implements CompositeElementInterface
{
    /**
     * The value of the "id" attribute.
     * @var IDType|NULL
     */
    private $idAttr;
    
    /**
     * The sequence of containers that hold the child elements.
     * Each entry can be:
     * - a container that holds multiple elements, or
     * - a container that holds a single element
     * @var array
     */
    private $sequence = [];
    
    /**
     * Returns the value of the "id" attribute.
     * 
     * @return  IDType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getId()
    {
        return $this->idAttr;
    }
    
    /**
     * Sets the value of the "id" attribute.
     * 
     * @param   IDType  $value  The value to set.
     */
    public function setId(IDType $value)
    {
        $this->idAttr = $value;
    }
    
    /**
     * Indicates whether the "id" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasId():bool
    {
        return $this->idAttr !== NULL;
    }
    
    /**
     * Adds an element to the container located at the specified index.
     * 
     * If the container does not exist then it is created.
     * 
     * @param   int                 $index      The index of the container.
     * @param   AbstractElement     $element    The element to add.
     */
    protected function addChildElement(int $index, AbstractElement $element)
    {
        $element->setParent($this);
        
        // Creates the container (that holds multiple elements) if it does not exist.
        if (!$this->hasContainer($index)) {
            $this->sequence[$index] = [];
            
            // Sorts the containers by index.
            \ksort($this->sequence);
        }
        
        // Adds the element to the container.
        $this->sequence[$index][] = $element;
    }
    
    /**
     * Returns a set of elements, from the container located at the 
     * specified index, which match a class or an interface name.
     * 
     * If the container does not exist then it returns an empty array.
     * 
     * @param   int     $index  The index of the container.
     * @param   string  $type   The class or the interface name that the elements must match.
     * @return  ElementInterface[]
     */
    protected function getChildElementsByType(int $index, string $type):array
    {
        return $this->hasContainer($index) ?
            \array_values(\array_filter($this->sequence[$index], function($element) use ($type) {
                return $element instanceof $type;
            })) :
            [];
    }
    
    /**
     * Returns the element of the container located at the specified index.
     * 
     * If the container does not exist then it returns NULL.
     * 
     * @param   int $index  The index of the container.
     * @return  ElementInterface|NULL   The instance of the element, otherwise NULL.
     */
    protected function getChildElement(int $index)
    {
        return $this->hasContainer($index) ? $this->sequence[$index] : NULL;
    }
    
    /**
     * Sets an element to the container located at the specified index.
     * 
     * If the container does not exist then it is created.
     * 
     * @param   int                 $index      The index of the container.
     * @param   AbstractElement     $element    The element to set.
     */
    protected function setChildElement(int $index, AbstractElement $element)
    {
        $element->setParent($this);
        
        if (!$this->hasContainer($index)) {
            // Creates and initializes a container that holds a single element.
            $this->sequence[$index] = $element;
            
            // Sorts the containers by index.
            \ksort($this->sequence);
        } else {
            $this->sequence[$index] = $element;
        }
    }
    
    /**
     * Indiates whether an element has been set in the container located at 
     * the specified index.
     * 
     * @param   int $index  The index of the container.
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    protected function isChildElementSet(int $index):bool
    {
        return $this->hasContainer($index) && $this->sequence[$index] instanceof ElementInterface;
    }
    
    /**
     * Indicates whether a container is present in the sequence at the 
     * specified index.
     * 
     * @param   int $index  The index of the container.
     * @return  bool    TRUE if a container is present, otherwise FALSE.
     */
    private function hasContainer(int $index):bool
    {
        return \array_key_exists($index, $this->sequence);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getElements():array
    {
        $children = [];
        
        foreach ($this->sequence as $container) {
            // Is it a container that holds multiple elements?
            if (\is_array($container)) {
                foreach ($container as $element) {
                    $children[] = $element;
                }
            } else {
                // It is container that holds a single element.
                $children[] = $container;
            }
        }
        
        return $children;
    }
}
