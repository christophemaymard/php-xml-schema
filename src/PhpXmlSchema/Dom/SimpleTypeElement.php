<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\NCNameType;

/**
 * Represents the XML schema "simpleType" element.
 * 
 * Attributes (version 1.0):
 * - final = (#all | List of (list | union | restriction))
 * - id = ID
 * - name = NCName
 * 
 * Content (version 1.0):
 * (annotation?, (restriction | list | union))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleTypeElement extends AbstractAnnotatedElement implements TypeElementInterface
{
    /**
     * The value of the "final" attribute.
     * @var DerivationType|NULL
     */
    private $finalAttr;
    
    /**
     * The value of the "name" attribute.
     * @var NCNameType|NULL
     */
    private $nameAttr;
    
    /**
     * Returns the value of the "final" attribute.
     * 
     * @return  DerivationType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getFinal()
    {
        return $this->finalAttr;
    }
    
    /**
     * Sets the value of the "final" attribute.
     * 
     * @param   DerivationType  $value  The value to set.
     */
    public function setFinal(DerivationType $value)
    {
        $this->finalAttr = $value;
    }
    
    /**
     * Indicates whether the "final" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasFinal():bool
    {
        return $this->finalAttr !== NULL;
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
     * Returns the derivation element.
     * 
     * @return  SimpleTypeDerivationElementInterface|NULL   The instance of the element if it has been set, otherwise NULL.
     */
    public function getDerivationElement()
    {
        return $this->getChildElement(1);
    }
    
    /**
     * Sets the derivation element.
     * 
     * @param   SimpleTypeDerivationElementInterface    $element    The element to set.
     */
    public function setDerivationElement(SimpleTypeDerivationElementInterface $element)
    {
        $this->setChildElement(1, $element);
    }
    
    /**
     * Indicates whether a derivation element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasDerivationElement():bool
    {
        return $this->isChildElementSet(1);
    }
}
