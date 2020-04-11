<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\NCNameType;

/**
 * Represents the XML schema "complexType" element.
 * 
 * Attributes (version 1.0):
 * - abstract = boolean
 * - block = (#all | List of (extension | restriction))
 * - final = (#all | List of (extension | restriction))
 * - id = ID
 * - mixed = boolean
 * - name = NCName
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
     * The value of the "block" attribute.
     * @var DerivationType|NULL
     */
    private $blockAttr;
    
    /**
     * The value of the "final" attribute.
     * @var DerivationType|NULL
     */
    private $finalAttr;
    
    /**
     * The value of the "mixed" attribute.
     * @var bool|NULL
     */
    private $mixedAttr;
    
    /**
     * The value of the "name" attribute.
     * @var NCNameType|NULL
     */
    private $nameAttr;
    
    /**
     * {@inheritDoc}
     */
    public function getElementId(): int
    {
        return ElementId::ELT_COMPLEXTYPE;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName(): string
    {
        return 'complexType';
    }
    
    /**
     * Returns the value of the "abstract" attribute.
     * 
     * @return  bool|NULL   The value of the attribute if it has been set, otherwise NULL.
     */
    public function getAbstract(): ?bool
    {
        return $this->abstractAttr;
    }
    
    /**
     * Sets the value of the "abstract" attribute.
     * 
     * @param   bool    $value  The value to set.
     */
    public function setAbstract(bool $value): void
    {
        $this->abstractAttr = $value;
    }
    
    /**
     * Indicates whether the "abstract" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasAbstract(): bool
    {
        return $this->abstractAttr !== NULL;
    }
    
    /**
     * Returns the value of the "block" attribute.
     * 
     * @return  DerivationType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getBlock(): ?DerivationType
    {
        return $this->blockAttr;
    }
    
    /**
     * Sets the value of the "block" attribute.
     * 
     * @param   DerivationType  $value  The value to set.
     */
    public function setBlock(DerivationType $value): void
    {
        $this->blockAttr = $value;
    }
    
    /**
     * Indicates whether the "block" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasBlock(): bool
    {
        return $this->blockAttr !== NULL;
    }
    
    /**
     * Returns the value of the "final" attribute.
     * 
     * @return  DerivationType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getFinal(): ?DerivationType
    {
        return $this->finalAttr;
    }
    
    /**
     * Sets the value of the "final" attribute.
     * 
     * @param   DerivationType  $value  The value to set.
     */
    public function setFinal(DerivationType $value): void
    {
        $this->finalAttr = $value;
    }
    
    /**
     * Indicates whether the "final" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasFinal(): bool
    {
        return $this->finalAttr !== NULL;
    }
    
    /**
     * Returns the value of the "mixed" attribute.
     * 
     * @return  bool|NULL   The value of the attribute if it has been set, otherwise NULL.
     */
    public function getMixed(): ?bool
    {
        return $this->mixedAttr;
    }
    
    /**
     * Sets the value of the "mixed" attribute.
     * 
     * @param   bool    $value  The value to set.
     */
    public function setMixed(bool $value): void
    {
        $this->mixedAttr = $value;
    }
    
    /**
     * Indicates whether the "mixed" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasMixed(): bool
    {
        return $this->mixedAttr !== NULL;
    }
    
    /**
     * Returns the value of the "name" attribute.
     * 
     * @return  NCNameType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getName(): ?NCNameType
    {
        return $this->nameAttr;
    }
    
    /**
     * Sets the value of the "name" attribute.
     * 
     * @param   NCNameType  $value  The value to set.
     */
    public function setName(NCNameType $value): void
    {
        $this->nameAttr = $value;
    }
    
    /**
     * Indicates whether the "name" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasName(): bool
    {
        return $this->nameAttr !== NULL;
    }
    
    /**
     * Returns the content element.
     * 
     * @return  ContentElementInterface|NULL    The instance of the element if it has been set, otherwise NULL.
     */
    public function getContentElement(): ?ContentElementInterface
    {
        return $this->getChildElement(1);
    }
    
    /**
     * Sets the content element.
     * 
     * @param   ContentElementInterface $element    The element to set.
     */
    public function setContentElement(ContentElementInterface $element): void
    {
        $this->setChildElement(1, $element);
    }
    
    /**
     * Indicates whether a content element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasContentElement(): bool
    {
        return $this->isChildElementSet(1);
    }
}
