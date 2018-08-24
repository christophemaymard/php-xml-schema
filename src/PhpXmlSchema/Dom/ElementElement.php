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
 * Represents the XML schema "element" element.
 * 
 * Attributes (version 1.0):
 * - abstract = boolean
 * - default = string
 * - fixed = string
 * - id = ID
 * - name = NCName
 * - nillable = boolean
 * - type = QName
 * 
 * Content (version 1.0):
 * (annotation?, ((simpleType | complexType)?, (unique | key | keyref)*))
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ElementElement extends AbstractAnnotatedElement implements ParticleElementInterface
{
    /**
     * The value of the "abstract" attribute.
     * @var bool|NULL
     */
    private $abstractAttr;
    
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
     * The value of the "nillable" attribute.
     * @var bool|NULL
     */
    private $nillableAttr;
    
    /**
     * The value of the "type" attribute.
     * @var QNameType|NULL
     */
    private $typeAttr;
    
    /**
     * Returns the value of the "nillable" attribute.
     * 
     * @return  bool|NULL   The value of the attribute if it has been set, otherwise NULL.
     */
    public function getNillable()
    {
        return $this->nillableAttr;
    }
    
    /**
     * Sets the value of the "nillable" attribute.
     * 
     * @param   bool    $value  The value to set.
     */
    public function setNillable(bool $value)
    {
        $this->nillableAttr = $value;
    }
    
    /**
     * Indicates whether the "nillable" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasNillable():bool
    {
        return $this->nillableAttr !== NULL;
    }
    
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
    
    /**
     * Returns the type element.
     * 
     * @return  TypeElementInterface|NULL   The instance of the element if it has been set, otherwise NULL.
     */
    public function getTypeElement()
    {
        return $this->getChildElement(1);
    }
    
    /**
     * Sets the type element.
     * 
     * @param   TypeElementInterface    $element    The element to set.
     */
    public function setTypeElement(TypeElementInterface $element)
    {
        $this->setChildElement(1, $element);
    }
    
    /**
     * Indicates whether a type element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasTypeElement():bool
    {
        return $this->isChildElementSet(1);
    }
    
    /**
     * Adds an "unique" element to this element.
     * 
     * @param   UniqueElement   $element    The element to add.
     */
    public function addUniqueElement(UniqueElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "unique" child elements.
     * 
     * @return  UniqueElement[] An indexed array of UniqueElement instances.
     */
    public function getUniqueElements():array
    {
        return $this->getChildElementsByType(2, UniqueElement::class);
    }
    
    /**
     * Adds a "key" element to this element.
     * 
     * @param   KeyElement  $element    The element to add.
     */
    public function addKeyElement(KeyElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "key" child elements.
     * 
     * @return  KeyElement[]    An indexed array of KeyElement instances.
     */
    public function getKeyElements():array
    {
        return $this->getChildElementsByType(2, KeyElement::class);
    }
    
    /**
     * Adds a "keyref" element to this element.
     * 
     * @param   KeyRefElement   $element    The element to add.
     */
    public function addKeyRefElement(KeyRefElement $element)
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "keyref" child elements.
     * 
     * @return  KeyRefElement[] An indexed array of KeyRefElement instances.
     */
    public function getKeyRefElements():array
    {
        return $this->getChildElementsByType(2, KeyRefElement::class);
    }
    
    /**
     * Returns all the identity-constraint child elements.
     * 
     * @return  IdentityConstraintElementInterface[]    An indexed array of IdentityConstraintElementInterface instances.
     */
    public function getIdentityConstraintElements():array
    {
        return $this->getChildElementsByType(2, IdentityConstraintElementInterface::class);
    }
}
