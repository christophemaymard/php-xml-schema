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
 * Represents the XML schema "keyref" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * - name = NCName
 * - refer = QName
 * 
 * Content (version 1.0):
 * (annotation?, (selector, field+))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class KeyRefElement extends AbstractIdentityConstraintElement
{
    /**
     * The value of the "refer" attribute.
     * @var QNameType|NULL
     */
    private $referAttr;
    
    /**
     * Returns the value of the "refer" attribute.
     * 
     * @return  QNameType|NULL  The value of the attribute if it has been set, otherwise NULL.
     */
    public function getRefer()
    {
        return $this->referAttr;
    }
    
    /**
     * Sets the value of the "refer" attribute.
     * 
     * @param   QNameType   $value  The value to set.
     */
    public function setRefer(QNameType $value)
    {
        $this->referAttr = $value;
    }
    
    /**
     * Indicates whether the "refer" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasRefer():bool
    {
        return $this->referAttr !== NULL;
    }
}
