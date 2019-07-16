<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\QNameType;

/**
 * Represents the XML schema "list" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * - itemType = QName
 * 
 * Content (version 1.0):
 * (annotation?, simpleType?)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ListElement extends AbstractSimpleTypedElement implements SimpleTypeDerivationElementInterface
{
    /**
     * The value of the "itemType" attribute.
     * @var QNameType|NULL
     */
    private $itemTypeAttr;
    
    /**
     * {@inheritDoc}
     */
    public function getElementId():int
    {
        return ElementId::ELT_LIST;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName():string
    {
        return 'list';
    }
    
    /**
     * Returns the value of the "itemType" attribute.
     * 
     * @return  QNameType|NULL  The value of the attribute if it has been set, otherwise NULL.
     */
    public function getItemType()
    {
        return $this->itemTypeAttr;
    }
    
    /**
     * Sets the value of the "itemType" attribute.
     * 
     * @param   QNameType   $value  The value to set.
     */
    public function setItemType(QNameType $value)
    {
        $this->itemTypeAttr = $value;
    }
    
    /**
     * Indicates whether the "itemType" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasItemType():bool
    {
        return $this->itemTypeAttr !== NULL;
    }
}
