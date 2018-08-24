<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\NCNameType;
use PhpXmlSchema\Datatype\QNameType;

/**
 * Represents the XML schema "attribute" element.
 * 
 * Attributes (version 1.0):
 * - default = string
 * - fixed = string
 * - id = ID
 * - name = NCName
 * - type = QName
 * 
 * Content (version 1.0):
 * (annotation?, simpleType?)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AttributeElement extends AbstractSimpleTypedElement implements AttributeDeclarationElementInterface
{
    /**
     * The value of the "default" attribute.
     * @var string|NULL
     */
    private $defaultAttr;
    
    /**
     * The value of the "fixed" attribute.
     * @var string|NULL
     */
    private $fixedAttr;
    
    /**
     * The value of the "name" attribute.
     * @var NCNameType|NULL
     */
    private $nameAttr;
    
    /**
     * The value of the "type" attribute.
     * @var QNameType|NULL
     */
    private $typeAttr;
    
    /**
     * Returns the value of the "default" attribute.
     * 
     * @return  string|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getDefault()
    {
        return $this->defaultAttr;
    }
    
    /**
     * Sets the value of the "default" attribute.
     * 
     * @param   string  $value  The value to set.
     */
    public function setDefault(string $value)
    {
        $this->defaultAttr = $value;
    }
    
    /**
     * Indicates whether the "default" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasDefault():bool
    {
        return $this->defaultAttr !== NULL;
    }
    
    /**
     * Returns the value of the "fixed" attribute.
     * 
     * @return  string|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getFixed()
    {
        return $this->fixedAttr;
    }
    
    /**
     * Sets the value of the "fixed" attribute.
     * 
     * @param   string  $value  The value to set.
     */
    public function setFixed(string $value)
    {
        $this->fixedAttr = $value;
    }
    
    /**
     * Indicates whether the "fixed" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasFixed():bool
    {
        return $this->fixedAttr !== NULL;
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
     * Returns the value of the "type" attribute.
     * 
     * @return  QNameType|NULL  The value of the attribute if it has been set, otherwise NULL.
     */
    public function getType()
    {
        return $this->typeAttr;
    }
    
    /**
     * Sets the value of the "type" attribute.
     * 
     * @param   QNameType   $value  The value to set.
     */
    public function setType(QNameType $value)
    {
        $this->typeAttr = $value;
    }
    
    /**
     * Indicates whether the "type" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasType():bool
    {
        return $this->typeAttr !== NULL;
    }
}
