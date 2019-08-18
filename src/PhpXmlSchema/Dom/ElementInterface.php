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
 * Interface for a XML schema element.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface ElementInterface
{
    /**
     * Returns the identifier of this element.
     * 
     * @return  int
     */
    public function getElementId():int;
    
    /**
     * Returns the local name of this element.
     * 
     * @return  string
     */
    public function getLocalName():string;
    
    /**
     * Returns the instance of the element that holds this element.
     * 
     * @return  ElementInterface|NULL   The instance of the element that holds this element, otherwise NULL.
     */
    public function getParent();
    
    /**
     * Indicates whether this element belongs to another element.
     * 
     * @return  bool    TRUE if this element belongs to another element, otherwise FALSE.
     */
    public function hasParent():bool;
    
    /**
     * Binds the specified prefix to the specified namespace.
     * 
     * @param   string  $prefix     The prefix.
     * @param   string  $namespace  The namespace to bind to.
     * 
     * @throws  InvalidOperationException   When 'xml' prefix is bound to a namespace other than XML 1.0 namespace.
     * @throws  InvalidOperationException   When the prefix, other than 'xml', is bound to the XML 1.0 namespace.
     * @throws  InvalidOperationException   When the prefix is 'xmlns'.
     * @throws  InvalidOperationException   When the prefix, other than 'xmlns', is bound to the XML NS 1.0 namespace.
     */
    public function bindNamespace(string $prefix, string $namespace);
    
    /**
     * Returns the namespace that is associated with the specified prefix.
     * 
     * @param   string  $prefix The prefix 
     * @return  string|NULL The namespace that is associated with prefix if found, otherwise NULL.
     */
    public function lookupNamespace(string $prefix);
}
