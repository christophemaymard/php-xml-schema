<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\IDType;

/**
 * Interface for a XML schema element that contains a sequence of XML schema 
 * elements as content.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface CompositeElementInterface extends ElementInterface
{
    /**
     * Returns the value of the "id" attribute.
     * 
     * @return  IDType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getId(): ?IDType;
    
    /**
     * Sets the value of the "id" attribute.
     * 
     * @param   IDType  $value  The value to set.
     */
    public function setId(IDType $value): void;
    
    /**
     * Indicates whether the "id" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasId(): bool;
    
    /**
     * Returns all the child elements that belong to this element.
     * 
     * @return  ElementInterface[]
     */
    public function getElements(): array;
}
