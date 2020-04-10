<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\NCNameType;
use PhpXmlSchema\Datatype\NonNegativeIntegerType;
use PhpXmlSchema\Datatype\QNameType;

/**
 * Represents the XML schema "group" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * - maxOccurs = (nonNegativeInteger | unbounded)
 * - minOccurs = nonNegativeInteger
 * - name = NCName
 * - ref = QName
 * 
 * Content (version 1.0):
 * (annotation?, (all | choice | sequence)?)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class GroupElement extends AbstractAnnotatedElement implements
    ParticleElementInterface, 
    TypeDefinitionParticleElementInterface
{
    /**
     * The value of the "maxOccurs" attribute.
     * @var NonNegativeIntegerLimitType|NULL
     */
    private $maxOccursAttr;
    
    /**
     * The value of the "minOccurs" attribute.
     * @var NonNegativeIntegerType|NULL
     */
    private $minOccursAttr;
    
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
        return ElementId::ELT_GROUP;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName():string
    {
        return 'group';
    }
    
    /**
     * {@inheritDoc}
     */
    public function getMaxOccurs()
    {
        return $this->maxOccursAttr;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setMaxOccurs(NonNegativeIntegerLimitType $value)
    {
        $this->maxOccursAttr = $value;
    }
    
    /**
     * {@inheritDoc}
     */
    public function hasMaxOccurs():bool
    {
        return $this->maxOccursAttr !== NULL;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getMinOccurs()
    {
        return $this->minOccursAttr;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setMinOccurs(NonNegativeIntegerType $value)
    {
        $this->minOccursAttr = $value;
    }
    
    /**
     * {@inheritDoc}
     */
    public function hasMinOccurs():bool
    {
        return $this->minOccursAttr !== NULL;
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
    
    /**
     * Returns the model group element.
     * 
     * @return  ModelGroupElementInterface|NULL The instance of the element if it has been set, otherwise NULL.
     */
    public function getModelGroupElement()
    {
        return $this->getChildElement(1);
    }
    
    /**
     * Sets the model group element.
     * 
     * @param   ModelGroupElementInterface  $element    The element to set.
     */
    public function setModelGroupElement(ModelGroupElementInterface $element)
    {
        $this->setChildElement(1, $element);
    }
    
    /**
     * Indicates whether a model group element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasModelGroupElement():bool
    {
        return $this->isChildElementSet(1);
    }
}
