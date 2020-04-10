<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\AnyUriType;
use PhpXmlSchema\Datatype\NCNameType;
use PhpXmlSchema\Datatype\TokenType;

/**
 * Represents the XML schema "notation" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * - name = NCName
 * - public = token
 * - system = anyURI
 * 
 * Content (version 1.0):
 * (annotation?)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NotationElement extends AbstractAnnotatedElement
{
    /**
     * The value of the "name" attribute.
     * @var NCNameType|NULL
     */
    private $nameAttr;
    
    /**
     * The value of the "public" attribute.
     * @var TokenType|NULL
     */
    private $publicAttr;
    
    /**
     * The value of the "system" attribute.
     * @var AnyUriType|NULL
     */
    private $systemAttr;
    
    /**
     * {@inheritDoc}
     */
    public function getElementId():int
    {
        return ElementId::ELT_NOTATION;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName():string
    {
        return 'notation';
    }
    
    /**
     * Returns the value of the "name" attribute.
     * 
     * @return  NCNameType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getName()
    {
        return $this->nameAttr;
    }
    
    /**
     * Sets the value of the "name" attribute.
     * 
     * @param   NCNameType  $value  The value to set.
     */
    public function setName(NCNameType $value)
    {
        $this->nameAttr = $value;
    }
    
    /**
     * Indicates whether the "name" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasName():bool
    {
        return $this->nameAttr !== NULL;
    }
    
    /**
     * Returns the value of the "public" attribute.
     * 
     * @return  TokenType|NULL  The value of the attribute if it has been set, otherwise NULL.
     */
    public function getPublic()
    {
        return $this->publicAttr;
    }
    
    /**
     * Sets the value of the "public" attribute.
     * 
     * @param   TokenType   $value  The value to set.
     */
    public function setPublic(TokenType $value)
    {
        $this->publicAttr = $value;
    }
    
    /**
     * Indicates whether the "public" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasPublic():bool
    {
        return $this->publicAttr !== NULL;
    }
    
    /**
     * Returns the value of the "system" attribute.
     * 
     * @return  AnyUriType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getSystem()
    {
        return $this->systemAttr;
    }
    
    /**
     * Sets the value of the "system" attribute.
     * 
     * @param   AnyUriType  $value  The value to set.
     */
    public function setSystem(AnyUriType $value)
    {
        $this->systemAttr = $value;
    }
    
    /**
     * Indicates whether the "system" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasSystem():bool
    {
        return $this->systemAttr !== NULL;
    }
}
