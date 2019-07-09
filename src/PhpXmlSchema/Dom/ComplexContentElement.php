<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "complexContent" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * - mixed = boolean
 * 
 * Content (version 1.0):
 * (annotation?, (restriction | extension))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ComplexContentElement extends AbstractAnnotatedElement implements ContentElementInterface
{
    /**
     * The value of the "mixed" attribute.
     * @var bool|NULL
     */
    private $mixedAttr;
    
    /**
     * Returns the value of the "mixed" attribute.
     * 
     * @return  bool|NULL   The value of the attribute if it has been set, otherwise NULL.
     */
    public function getMixed()
    {
        return $this->mixedAttr;
    }
    
    /**
     * Sets the value of the "mixed" attribute.
     * 
     * @param   bool    $value  The value to set.
     */
    public function setMixed(bool $value)
    {
        $this->mixedAttr = $value;
    }
    
    /**
     * Indicates whether the "mixed" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasMixed():bool
    {
        return $this->mixedAttr !== NULL;
    }
    
    /**
     * Returns the derivation element.
     * 
     * @return  ComplexContentDerivationElementInterface|NULL   The instance of the element if it has been set, otherwise NULL.
     */
    public function getDerivationElement()
    {
        return $this->getChildElement(1);
    }
    
    /**
     * Sets the derivation element.
     * 
     * @param   ComplexContentDerivationElementInterface    $element    The element to set.
     */
    public function setDerivationElement(ComplexContentDerivationElementInterface $element)
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
