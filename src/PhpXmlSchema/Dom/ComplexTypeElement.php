<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the XML schema "complexType" element.
 * 
 * Attributes (version 1.0):
 * - abstract = boolean
 * - mixed = boolean
 * 
 * Content (version 1.0):
 * (annotation?, (simpleContent | complexContent | ((group | all | choice | sequence)?, ((attribute | attributeGroup)*, anyAttribute?))))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ComplexTypeElement extends AbstractTypeNamingElement implements TypeElementInterface
{
    /**
     * The value of the "abstract" attribute.
     * @var bool|NULL
     */
    private $abstractAttr;
    
    /**
     * The value of the "mixed" attribute.
     * @var bool|NULL
     */
    private $mixedAttr;
    
    /**
     * Returns the value of the "abstract" attribute.
     * 
     * @return  bool|NULL   The value of the attribute if it has been set, otherwise NULL.
     */
    public function getAbstract()
    {
        return $this->abstractAttr;
    }
    
    /**
     * Sets the value of the "abstract" attribute.
     * 
     * @param   bool    $value  The value to set.
     */
    public function setAbstract(bool $value)
    {
        $this->abstractAttr = $value;
    }
    
    /**
     * Indicates whether the "abstract" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasAbstract():bool
    {
        return $this->abstractAttr !== NULL;
    }
    
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
     * Returns the content element.
     * 
     * @return  ContentElementInterface|NULL    The instance of the element if it has been set, otherwise NULL.
     */
    public function getContentElement()
    {
        return $this->getChildElement(1);
    }
    
    /**
     * Sets the content element.
     * 
     * @param   ContentElementInterface $element    The element to set.
     */
    public function setContentElement(ContentElementInterface $element)
    {
        $this->setChildElement(1, $element);
    }
    
    /**
     * Indicates whether a content element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasContentElement():bool
    {
        return $this->isChildElementSet(1);
    }
}
