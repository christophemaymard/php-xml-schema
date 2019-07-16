<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\NCNameType;
use PhpXmlSchema\Datatype\QNameType;

/**
 * Represents the XML schema "attributeGroup" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * - name = NCName
 * - ref = QName
 * 
 * Content (version 1.0):
 * (annotation?, ((attribute | attributeGroup)*, anyAttribute?))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AttributeGroupElement extends AbstractAttributeNamingElement implements AttributeDeclarationElementInterface
{
    /**
     * The value of the "name" attribute.
     * @var NCNameType|NULL
     */
    private $nameAttr;
    
    /**
     * The value of the "ref" attribute.
     * @var QNameType|NULL
     */
    private $refAttr;
    
    /**
     * {@inheritDoc}
     */
    public function getElementId():int
    {
        return ElementId::ELT_ATTRIBUTEGROUP;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName():string
    {
        return 'attributeGroup';
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
     * Returns the value of the "ref" attribute.
     * 
     * @return  QNameType|NULL  The value of the attribute if it has been set, otherwise NULL.
     */
    public function getRef()
    {
        return $this->refAttr;
    }
    
    /**
     * Sets the value of the "ref" attribute.
     * 
     * @param   QNameType   $value  The value to set.
     */
    public function setRef(QNameType $value)
    {
        $this->refAttr = $value;
    }
    
    /**
     * Indicates whether the "ref" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasRef():bool
    {
        return $this->refAttr !== NULL;
    }
}
