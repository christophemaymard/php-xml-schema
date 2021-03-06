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
use PhpXmlSchema\Datatype\StringType;

/**
 * Represents the XML schema "element" element.
 * 
 * Attributes (version 1.0):
 * - abstract = boolean
 * - block = (#all | List of (extension | restriction | substitution))
 * - default = string
 * - final = (#all | List of (extension | restriction))
 * - fixed = string
 * - form = (qualified | unqualified)
 * - id = ID
 * - maxOccurs = (nonNegativeInteger | unbounded)
 * - minOccurs = nonNegativeInteger
 * - name = NCName
 * - nillable = boolean
 * - ref = QName
 * - substitutionGroup = QName
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
     * The value of the "block" attribute.
     * @var DerivationType|NULL
     */
    private $blockAttr;
    
    /**
     * The value of the "default" attribute.
     * @var StringType|NULL
     */
    private $defaultAttr;
    
    /**
     * The value of the "final" attribute.
     * @var DerivationType|NULL
     */
    private $finalAttr;
    
    /**
     * The value of the "fixed" attribute.
     * @var string|NULL
     */
    private $fixedAttr;
    
    /**
     * The value of the "form" attribute.
     * @var FormType|NULL
     */
    private $formAttr;
    
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
     * The value of the "nillable" attribute.
     * @var bool|NULL
     */
    private $nillableAttr;
    
    /**
     * The value of the "ref" attribute.
     * @var QNameType|NULL
     */
    private $refAttr;
    
    /**
     * The value of the "substitutionGroup" attribute.
     * @var QNameType|NULL
     */
    private $substitutionGroupAttr;
    
    /**
     * The value of the "type" attribute.
     * @var QNameType|NULL
     */
    private $typeAttr;
    
    /**
     * {@inheritDoc}
     */
    public function getElementId(): int
    {
        return ElementId::ELT_ELEMENT;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName(): string
    {
        return 'element';
    }
    
    /**
     * Returns the value of the "nillable" attribute.
     * 
     * @return  bool|NULL   The value of the attribute if it has been set, otherwise NULL.
     */
    public function getNillable(): ?bool
    {
        return $this->nillableAttr;
    }
    
    /**
     * Sets the value of the "nillable" attribute.
     * 
     * @param   bool    $value  The value to set.
     */
    public function setNillable(bool $value): void
    {
        $this->nillableAttr = $value;
    }
    
    /**
     * Indicates whether the "nillable" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasNillable(): bool
    {
        return $this->nillableAttr !== NULL;
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
     * Returns the value of the "default" attribute.
     * 
     * @return  StringType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getDefault(): ?StringType
    {
        return $this->defaultAttr;
    }
    
    /**
     * Sets the value of the "default" attribute.
     * 
     * @param   StringType  $value  The value to set.
     */
    public function setDefault(StringType $value): void
    {
        $this->defaultAttr = $value;
    }
    
    /**
     * Indicates whether the "default" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasDefault(): bool
    {
        return $this->defaultAttr !== NULL;
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
     * Returns the value of the "fixed" attribute.
     * 
     * @return  StringType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getFixed(): ?StringType
    {
        return $this->fixedAttr;
    }
    
    /**
     * Sets the value of the "fixed" attribute.
     * 
     * @param   StringType  $value  The value to set.
     */
    public function setFixed(StringType $value): void
    {
        $this->fixedAttr = $value;
    }
    
    /**
     * Indicates whether the "fixed" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasFixed(): bool
    {
        return $this->fixedAttr !== NULL;
    }
    
    /**
     * Returns the value of the "form" attribute.
     * 
     * @return  FormType|NULL   The value of the attribute if it has been set, otherwise NULL.
     */
    public function getForm(): ?FormType
    {
        return $this->formAttr;
    }
    
    /**
     * Sets the value of the "form" attribute.
     * 
     * @param   FormType    $value  The value to set.
     */
    public function setForm(FormType $value): void
    {
        $this->formAttr = $value;
    }
    
    /**
     * Indicates whether the "form" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasForm(): bool
    {
        return $this->formAttr !== NULL;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getMaxOccurs(): ?NonNegativeIntegerLimitType
    {
        return $this->maxOccursAttr;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setMaxOccurs(NonNegativeIntegerLimitType $value): void
    {
        $this->maxOccursAttr = $value;
    }
    
    /**
     * {@inheritDoc}
     */
    public function hasMaxOccurs(): bool
    {
        return $this->maxOccursAttr !== NULL;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getMinOccurs(): ?NonNegativeIntegerType
    {
        return $this->minOccursAttr;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setMinOccurs(NonNegativeIntegerType $value): void
    {
        $this->minOccursAttr = $value;
    }
    
    /**
     * {@inheritDoc}
     */
    public function hasMinOccurs(): bool
    {
        return $this->minOccursAttr !== NULL;
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
     * Returns the value of the "ref" attribute.
     * 
     * @return  QNameType|NULL  The value of the attribute if it has been set, otherwise NULL.
     */
    public function getRef(): ?QNameType
    {
        return $this->refAttr;
    }
    
    /**
     * Sets the value of the "ref" attribute.
     * 
     * @param   QNameType   $value  The value to set.
     */
    public function setRef(QNameType $value): void
    {
        $this->refAttr = $value;
    }
    
    /**
     * Indicates whether the "ref" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasRef(): bool
    {
        return $this->refAttr !== NULL;
    }
    
    /**
     * Returns the value of the "substitutionGroup" attribute.
     * 
     * @return  QNameType|NULL  The value of the attribute if it has been set, otherwise NULL.
     */
    public function getSubstitutionGroup(): ?QNameType
    {
        return $this->substitutionGroupAttr;
    }
    
    /**
     * Sets the value of the "substitutionGroup" attribute.
     * 
     * @param   QNameType   $value  The value to set.
     */
    public function setSubstitutionGroup(QNameType $value): void
    {
        $this->substitutionGroupAttr = $value;
    }
    
    /**
     * Indicates whether the "substitutionGroup" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasSubstitutionGroup(): bool
    {
        return $this->substitutionGroupAttr !== NULL;
    }
    
    /**
     * Returns the value of the "type" attribute.
     * 
     * @return  QNameType|NULL  The value of the attribute if it has been set, otherwise NULL.
     */
    public function getType(): ?QNameType
    {
        return $this->typeAttr;
    }
    
    /**
     * Sets the value of the "type" attribute.
     * 
     * @param   QNameType   $value  The value to set.
     */
    public function setType(QNameType $value): void
    {
        $this->typeAttr = $value;
    }
    
    /**
     * Indicates whether the "type" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasType(): bool
    {
        return $this->typeAttr !== NULL;
    }
    
    /**
     * Returns the type element.
     * 
     * @return  TypeElementInterface|NULL   The instance of the element if it has been set, otherwise NULL.
     */
    public function getTypeElement(): ?TypeElementInterface
    {
        return $this->getChildElement(1);
    }
    
    /**
     * Sets the type element.
     * 
     * @param   TypeElementInterface    $element    The element to set.
     */
    public function setTypeElement(TypeElementInterface $element): void
    {
        $this->setChildElement(1, $element);
    }
    
    /**
     * Indicates whether a type element has been set.
     * 
     * @return  bool    TRUE if an element has been set, otherwise FALSE.
     */
    public function hasTypeElement(): bool
    {
        return $this->isChildElementSet(1);
    }
    
    /**
     * Adds an "unique" element to this element.
     * 
     * @param   UniqueElement   $element    The element to add.
     */
    public function addUniqueElement(UniqueElement $element): void
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "unique" child elements.
     * 
     * @return  UniqueElement[] An indexed array of UniqueElement instances.
     */
    public function getUniqueElements(): array
    {
        return $this->getChildElementsByType(2, UniqueElement::class);
    }
    
    /**
     * Adds a "key" element to this element.
     * 
     * @param   KeyElement  $element    The element to add.
     */
    public function addKeyElement(KeyElement $element): void
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "key" child elements.
     * 
     * @return  KeyElement[]    An indexed array of KeyElement instances.
     */
    public function getKeyElements(): array
    {
        return $this->getChildElementsByType(2, KeyElement::class);
    }
    
    /**
     * Adds a "keyref" element to this element.
     * 
     * @param   KeyRefElement   $element    The element to add.
     */
    public function addKeyRefElement(KeyRefElement $element): void
    {
        $this->addChildElement(2, $element);
    }
    
    /**
     * Returns all the "keyref" child elements.
     * 
     * @return  KeyRefElement[] An indexed array of KeyRefElement instances.
     */
    public function getKeyRefElements(): array
    {
        return $this->getChildElementsByType(2, KeyRefElement::class);
    }
    
    /**
     * Returns all the identity-constraint child elements.
     * 
     * @return  IdentityConstraintElementInterface[]    An indexed array of IdentityConstraintElementInterface instances.
     */
    public function getIdentityConstraintElements(): array
    {
        return $this->getChildElementsByType(2, IdentityConstraintElementInterface::class);
    }
}
